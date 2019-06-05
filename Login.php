<?php
	ob_start();
	$submitted = isset($_POST["username"]) && isset($_POST["password"]);
	if ($submitted){	
		$servername = "localhost";
		$username = "root";
		$password = "hkcc1234";
		$dbname = "spd4517";				
		$inusername=$_POST["username"];
		$inpassword=$_POST["password"];
		if ($inusername=='admin'&& $inpassword=='123'){
			setcookie('logined','true');
			setcookie('user','admin');
			echo'<meta http-equiv="Refresh" content="0; url=editProfile.php" />';
		}else
			try {
					$opt = array(PDO::ATTR_PERSISTENT => TRUE);
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);		
					$sql = "SELECT * FROM account where Account=:name and Password=:pw";
					$stmt = $conn->prepare($sql);
					$stmt->execute(array(':name'=>$inusername,':pw'=>$inpassword));
					$nRows=0;
					// output data of each row		
					foreach($stmt as $row) {
						$nRows++;
					}
					
					if ($nRows!=0){
						setcookie('logined','true');
						setcookie('user',$inusername);
						echo'<meta http-equiv="Refresh" content="0; url=memberProfile.php" />';
					}else{
						echo '<script>alert("Username/Password wrong");</script>';	
					}
					
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
				}
	}else {
		setcookie('logined','false');
		setcookie('user','');
	}
?>
<html>
<!-- import style.css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- import bootstrap.css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- import index.css -->
<link rel="stylesheet" href="css/index.css">
<!-- import jquery.js -->
<script type="text/javascript" src="javascript/jquery.min.js"></script>

<!-- import global.js -->
<script src="javascript/global.js">
</script>
<style>
.box{
	background-color:rgba(0,0,0,0.2);
}
</style>

<head>
    <title>Mental Health Care Center</title>
	<link rel="shortcut icon" href="images/Logo.jpg" />
    <style>
        html {
      scroll-behavior: smooth;
    }
    </style>
</head>

<body>
    <!-- navbar(bootstrap 4) -->
    <?php
	include 'NavgationBar.php';
	?>
    <!-- popup dim background -->
    <div class="dim d-none"></div>
    <!-- end of nav bar -->
    <!-- banner section -->
    <section id="main_page">
        <section class="banner">
            <div class="container">
                <div class="row banner_center">                    
                    
					<div class="col-6 p-5">
						
						<div class='tabcontent' id='logins'>
                            <form class="box" action="" method="post">
                                    <h1>login</h1>
                                <!-- role menu  -->                                    
                                <input type="text" name="username" placeholder="User Name" required="required">								
                                <input type="password" name="password" placeholder="Password" required="required">
								<input onclick="location.href = 'Registration.php'" type="button" value="Registration">
								 <input type="submit" value="Login">
                            </form>
                        </div>
												
                    </div>
                    
                </div>
            </div>
            <!--Result div of success login-->
            <div id="boxs" class="divbox">
                <h1>Login success!</h1>
                <p class="close" id="link"><a href="memberProfile.php">Go</a></p>
            </div>
            <!--Result div of fail login-->
            <div id="boxf" class="divbox">
                <h1>Registration Failed!</h1>
				<p id="errmsg">I am error message</p>
                <p class="close" id="link"><a href="Login.php">Retry</a></p>
            </div>            
        </section>
        
    </section>
    <footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>