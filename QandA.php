<!DOCTYPE html>
<html>

<!-- import bootstrap.css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- import style.css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- import Q&A.css -->
<link rel="stylesheet" type="text/css" href="css/QandA.css">
<!-- import Q&A.js -->
<script src="../javascript/QandA.js">
</script>
<!-- import admin default script.js -->
<script type="text/javascript" src="javascript/admin_default_script.js"></script>
<!-- import userpage .js -->
<script type="text/javascript" src="javascript/userpage.js">  </script>


<head>
    <title>Q&A</title>
	<link rel="shortcut icon" href="images/Logo.jpg" />
</head>

<body>
    <!-- navbar(bootstrap 4) -->
    <?php
		include 'NavgationBar.php';
	?>
    <!-- end of nav bar -->
    <section class="subpage_banner">
    </section>

    <section class="content_bg">
        <section>
<?php 
$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
$sql  = "SELECT * FROM fqa";
$stmt = $pdo->query($sql);
foreach($stmt as $n => $row){
    if($row["fqaid"] == 1){
        echo "<input class='animate' type='radio' name='question' id='q".$row["fqaid"]."' checked />"; 
    }
    else {
        echo "<input class='animate' type='radio' name='question' id='q".$row["fqaid"]."' />"; 
    }
    echo "<label class='animate' for='q".$row["fqaid"]."'>Q".($n+1).":".$row["question"]."</label>";
    echo "<p class='response animate'>".$row["answer"]."</p>";
}
?> 
        </section>
    </section>
    <footer class="nav-down py-3">
        Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>