
<html>
    <!-- import style.css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- import bootstrap.css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- import index.css -->
    <link rel="stylesheet" href="css/index.css">

    <style>
            * { padding: 0; margin: 0; }
            canvas { background: rgba(0,0,0,0.5); display: block; margin: 0 auto; }
        </style>
    <!-- import jquery.js -->
    <script type="text/javascript" src="javascript/jquery.min.js"></script>
    <!-- import global.js -->
    <script src="javascript/global.js">
</script>
    <head>
        <title>Mental Health Care Center</title>
        <link rel="shortcut icon" href="images/Logo.jpg" />
    </head>
    <!-- navbar(bootstrap 4) -->
    <?php
	include 'NavgationBar.php';
	?>
    <!-- popup dim background -->
    <div class="dim d-none"></div>
    <!-- end of nav bar -->
    <!-- banner section -->
    <section id="Game">
        <section class="banner">
            <div class="container">
                <div class="row banner_center">
                    <div id="main_banner" class="row">
                        <h1 class="w-100 text-center">MHCC Game Centre</h1>
                        <canvas id="myCanvas" width="1150" height="600"></canvas>
                        <p class="m-2 shadow  bg-white rounded"><strong>Game operation:</strong><br/>
                                Using arrow keys(← & →) move .</p>
                        </div></div></div></section></section>
        <footer class="nav-down py-3">
            Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights
            reserved.
        </footer>
    </body>


    <script>
        var canvas = document.getElementById("myCanvas");
        var ctx = canvas.getContext("2d");
        var ballRadius = 10;
        var x = canvas.width/2;
        var y = canvas.height-30;
        var dx = 2;
        var dy = -2;
        var paddleHeight = 10;
        var paddleWidth = 90;
        var paddleX = (canvas.width-paddleWidth)/2;
        var rightPressed = false;
        var leftPressed = false;
        var brickRowCount = 13;
        var brickColumnCount = 5;
        var brickWidth = 75;
        var brickHeight = 30;
        var brickPadding = 10;
        var brickOffsetTop = 30;
        var brickOffsetLeft = 30;
        var score = 0;
        var lives = 5;
        
        var bricks = [];
        for(c=0; c<brickColumnCount; c++) {
            bricks[c] = [];
            for(r=0; r<brickRowCount; r++) {
                bricks[c][r] = { x: 0, y: 0, status: 1 };
            }
        }
        
        
        
        document.addEventListener("keydown", keyDownHandler, false);
        document.addEventListener("keyup", keyUpHandler, false);
        
        function keyDownHandler(e) {
            if(e.keyCode == 39) {
                rightPressed = true;
            }
            else if(e.keyCode == 37) {
                leftPressed = true;
            }
        }
        function keyUpHandler(e) {
            if(e.keyCode == 39) {
                rightPressed = false;
            }
            else if(e.keyCode == 37) {
                leftPressed = false;
            }
        }

        function collisionDetection() {
        
            for(c=0; c<brickColumnCount; c++) {
                for(r=0; r<brickRowCount; r++) {
                    
                    var b = bricks[c][r];
                    if(b.status == 1) {
                        if(x > b.x && x < b.x+brickWidth && y > b.y && y < b.y+brickHeight) {
                            dy = -dy;
                            b.status = 0;
                            score++;

                            if(score == brickRowCount*brickColumnCount) {
                                alert("YOU WIN, Hope You Enjoy This Game!");
                                document.location.reload();
                            }
                        }
                    }
                }
            }
        }
        
        function drawBall() {
            ctx.beginPath();
            ctx.arc(x, y, ballRadius, 0, Math.PI*2);
            ctx.fillStyle = "#f00";
            ctx.fill();
            ctx.closePath();
        }
        function drawPaddle() {
            ctx.beginPath();
            ctx.rect(paddleX, canvas.height-paddleHeight, paddleWidth, paddleHeight);
            ctx.fillStyle = "#000";
            ctx.fill();
            ctx.closePath();
        }
        function drawBricks() {
            for(c=0; c<brickColumnCount; c++) {
                for(r=0; r<brickRowCount; r++) {
                    if(bricks[c][r].status == 1) {
                        var brickX = (r*(brickWidth+brickPadding))+brickOffsetLeft;
                        var brickY = (c*(brickHeight+brickPadding))+brickOffsetTop;
                        bricks[c][r].x = brickX;
                        bricks[c][r].y = brickY;
                        ctx.beginPath();
                        ctx.rect(brickX, brickY, brickWidth, brickHeight);
                        ctx.fillStyle = "#007bff";
                        ctx.fill();
                        ctx.closePath();
                    }
                }
            }
        }
        function drawScore() {
            ctx.font = "26px Arial";
            ctx.fillStyle = "#0095DD";
            ctx.fillText("Score: "+score, 8, 25);
        }
        function drawLives() {
            ctx.font = "26px Arial";
            ctx.fillStyle = "#000";
            ctx.fillText("Lives: "+lives, canvas.width-95, 25);
        }
        
        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawBricks();
            drawBall();
            drawPaddle();
            drawScore();
            drawLives();
            collisionDetection();
            
            if(x + dx > canvas.width-ballRadius || x + dx < ballRadius) {
                dx = -dx;
            }
            if(y + dy < ballRadius) {
                dy = -dy;
            }
            else if(y + dy > canvas.height-ballRadius) {
                if(x > paddleX && x < paddleX + paddleWidth) {
                    dy = -dy;
                }
                else {
                    lives--;
                    if(!lives) {
                        alert("Too close to the win this game, your score is:"+score);
                        document.location.reload();
                    }
                    else {
                        x = canvas.width/2;
                        y = canvas.height-30;
                        dx = 3;
                        dy = -3;
                        paddleX = (canvas.width-paddleWidth)/2;
                    }
                }
            }
            
            if(rightPressed && paddleX < canvas.width-paddleWidth) {
                paddleX += 7;
            }
            else if(leftPressed && paddleX > 0) {
                paddleX -= 7;
            }
            
            x += dx;
            y += dy;
            requestAnimationFrame(draw);
        }
        
        draw();
        </script>
</html>