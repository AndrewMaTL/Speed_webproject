<!DOCTYPE html>
<html>

<!-- import bootstrap.css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- import style.css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- import Q&A.css -->
<link rel="stylesheet" type="text/css" href="css/QandA.css">
<!-- import Questionaire.css -->
<link rel="stylesheet" type="text/css" href="css/Questionnaire.css">
<!-- import Questionaire.js -->
<!-- <script src="questionnaire.js"></script> -->
<script>
    function display_none(){
document.getElementById("Guest").style.display = "none";
document.getElementById("QTask").style.display = "block";

}
function Question_none(){
document.getElementById("QTask").style.display = "none";
}
</script>
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


<section class='Question' id="QTask" >
<form method="Post" action="Questionnaire_validation.php">
<div class="qz-wrapper">
    <div class="qz-content">
      <div class="qz-title"><h2>Geriatric Depression Scale</h2></div>
      <?php 

$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
$sql  = "SELECT * FROM questionnaire";
$stmt = $pdo->query($sql);
foreach($stmt as $row){
echo "<div class='qz-item'><div class='qz-text'>".$row["questionid"].") ".$row["question"];
echo '</div>
<div class="qz-action">
  <div class="qz-radio"><input type="radio" name="question'.$row["questionid"].'" id="question'.$row["questionid"].'" value="1" required/> <label for="question'.$row["questionid"].'">Yes</label></div>
  <div class="qz-radio"><input type="radio" name="question'.$row["questionid"].'" id="question'.$row["questionid"].'" value="0"/> <label for="question'.$row["questionid"].'">No</label>';
echo '</div></div></div>';
}
?> 

<div class="w-100 text-right p-3">
      <input class="btn-primary px-3 py-2" type='submit' value='submit' />
      <input class="btn-primary px-3 py-2" type='reset' value='reset' />
    </div>
    </div>
</div>

</form>
</section>
<?php
function alertbox(){
    if (isset($_COOKIE['QuestionnaireScore'])){
		$LastScore = $_COOKIE['QuestionnaireScore'];
		echo '<section id="Guest"><div class="container"><div class="row"><div class="p-3 w-100"><div class="card">
		<div class="card-header">
		  Welcome to join Us!
		</div>
		<div class="card-body">The Last Score you get is:<b>'.$LastScore."</b><br/>";
		echo 'We are highly recommend you registered/sign in our website to get more information and tips.<br/>';
		Echo '<div class="w-100 text-right"><button  class="btn gray m-1" onclick="display_none()">Do again</button>';
		echo '<a href="Registration.php"><button class="btn gray m-1">Go Registered!</button></a></div></div></div></div></div></div></section>';
	}
}

if(isset($_COOKIE['logined']) ){
    if($_COOKIE['logined'] == 'false'){
if(isset($_COOKIE['Questionnairestatus']) ){
    if($_COOKIE['Questionnairestatus']=='done'){
        alertbox();
        echo '<script>Question_none();</script>';
        }
    }
}
}else{
    if(isset($_COOKIE['Questionnairestatus']) ){
        if($_COOKIE['Questionnairestatus']=='done'){
            alertbox();
            echo '<script>Question_none();</script>';
        }
    }
}
?>


    <footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>