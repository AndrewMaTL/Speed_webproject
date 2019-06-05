<!DOCTYPE html>
<html>
<!-- import bootstrap.css -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- import swiper.css -->
<link rel="stylesheet" href="css/swiper.min.css">
<!-- import style.css -->
<link rel="stylesheet" href="css/style.css">
<!-- import aboutus.css -->
<link rel="stylesheet" href="css/aboutus.css">

<?php 	
	if (isset($_POST['loginsatge'])){ //#logout
		setcookie('logined','false');
		setcookie('user','');
		setcookie('Questionnairestatus','');
		setcookie('QuestionnaireScore','');
		setcookie('Questionnairelevel','');
		echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
		}
	$user = $_COOKIE['user'];
	$name ='';
	$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
	$sql  = "SELECT Score,issueslevel FROM user where username = '$user'";
	$stmt = $pdo->query($sql);
	foreach($stmt as $row){
		$Score = $row['Score'];
		$IssuesLevel=$row['issueslevel'];			
	}
?>

<head>
    <!-- page title -->
    <title>Profile</title>
		<link rel="shortcut icon" href="images/Logo.jpg" />
</head>


<body>
    <!-- navbar(bootstrap 4) -->
    <?php
		include 'NavgationBar.php';
	?>
    <!-- end of nav bar -->

    <!-- end of nav bar -->    
		<section class="subpage_banner">
			<!-- bootstrap container -->
			<div class="container">
				<!-- first row  -->
				<div class="row subpage_banner_center">
					<!-- icon col -->
					<div class="col-2">
						<img src="images/icon.png" class="d-block w-100 icon">
					</div>
					<!-- information col -->
					<div class="col-10">
						<!-- name and data of the information  -->
						<div class="row">
							<div class="btn no_cursor text-white  bg-secondary">
								<p class="m-0 p-0">User:
									<span id="infoName"><?php 
										$sql  = "SELECT * FROM user where username = '$user'";
										$stmt = $pdo->query($sql);										
										foreach($stmt as $row){											
											$name = $row['fname']." ".$row['lname'];
										}
									echo $name  ?></span>
								</p>
							</div>
						</div>
						<!-- room and data of the information -->
						
						<!-- log out button in text-align:right -->
						<div class="row">
							<div class="col-12 text-right">
							<form method="post" class='sbutton'>
								<input type="hidden" value="false" name="loginsatge">
								<input class="btn blue button" type="submit" value="LogOut" name="LogOut">			
							</form>
							</div>
						</div>
					</div>
				</div>
		</section>
		<div class="main">
			<div class="tab">
			Recommendation
			</div>
			<br>						
					<h1 align=center><?php
					 if($Score!=''){
					 echo 'Your Score: '.$Score;
					}
					 else{
						 echo 'You have not completed the questionnaire!<br/>';
						 echo '<a href="Questionnaire.php"><input class="button btn blue" type="button" value="Click"></a>';
					 } 
					 ?></h1>


				<table <?php if ($Score=='') echo "style='display:none';";?> id="viewRecord" align=center width=40%>
							<tr>
								<th>Recommendation</th>
							</tr>
							<tr>
								<td>
									<ul>
									<?php 
									$user = $_COOKIE['user'];
									$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
									$sql  = "SELECT tip FROM tips where issueslevel = '$IssuesLevel'";
									$stmt = $pdo->query($sql);

									foreach($stmt as $row){
									echo '<li>'.$row['tip'].'</li>';
								}
						Echo '<br/><h4>Recommend Site:</h5>'; 
						$sql  = "SELECT * FROM recommend_site where issueslevel = '$IssuesLevel'";
						$stmt = $pdo->query($sql);
						foreach($stmt as $row){
						echo '<li><a href="'.$row['web_address'].'">'.$row['webname'].'</a></li>';
					}
									?>
									</ul>
								</td>
							</tr>
							
						</table>
			</div>
			<footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>