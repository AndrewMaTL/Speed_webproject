<?php
	ob_start();
?>
<html>
<!-- import bootstrap.css -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- import swiper.css -->
<link rel="stylesheet" href="css/swiper.min.css">
<!-- import style.css -->
<link rel="stylesheet" href="css/style.css">
<!-- import aboutus.css -->
<link rel="stylesheet" href="css/aboutus.css">
<!-- import index.css -->
<link rel="stylesheet" href="css/index.css">
<style>
.box input[type="button"], .box input[type="submit"], .box input[type="reset"] {
	width: 70%;
	}</style>

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
									<span id="infoName"><?php echo $_COOKIE['user']; ?></span>
								</p>
							</div>
						</div>
						<!-- room and data of the information -->
						
						<!-- log out button in text-align:right -->
						<div class="row">
							<div class="col-12 text-right">				
								<!-- find #logout for php code -->
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
			Profile Edit
			</div>
			<br>		
<?php 	
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";	
	
if (isset($_COOKIE['user'])){
	
	if (isset($_POST['loginsatge'])){ //#logout
			setcookie('logined','false');
			setcookie('user','');
			setcookie('Questionnairestatus','');
			setcookie('QuestionnaireScore','');
			setcookie('Questionnairelevel','');
			echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
			}
			
	try{
		$sql = "SELECT * FROM account where Account = :name";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_COOKIE['user']));
		$currentUserType='';
		foreach($stmt as $row) {
			$currentUserType=$row["AccountType"];				
		}
		$submitted = isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cpassword"]) &&
						isset($_POST["fname"]) && isset($_POST["lname"]) &&	isset($_POST["DoB"]) &&	
						isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["contactno"]) &&
						isset($_POST["address"]) && (($currentUserType!='User')? isset($_POST["job_position"]):true);

		
	}catch (PDOException $e){
		echo "Error: ".$e->getMessage();
		}		
	
	// display form
	try {	
		$sql = "SELECT * FROM account where Account = :name";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_COOKIE['user']));
		$pleaseGiveMePassword='';
		foreach ($stmt as $row) {
			$pleaseGiveMePassword=$row["Password"];
		}
		if ($currentUserType=='User'){
			$sql = "SELECT * FROM user where username = :name";
		}else 
			$sql = "SELECT * FROM doctor where username = :name";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_COOKIE['user']));
		foreach($stmt as $row) {
			echo '<script>	document.getElementById("infoName").innerHTML ="'.$row["fname"].' '.$row["lname"].'";</script>	';
			
			// edit form generation
			echo '<div class="container profile_bg"><div class="row"><div class="offset-2 col-8">';
			echo '<form name="patientReg" method="post" onSubmit="submitDone()" class="box">';
			echo '<table id="tbforMenu" class="w-100">';
			echo '<tr><th>UserName:</th><td><input type="text" disabled value="'.$row["username"].'" placeholder="AcountID" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
			echo '<input type="hidden" value="'.$row["username"].'" name="username">';
			echo '<tr><th>Password:</th><td><input type="password" value="'.$pleaseGiveMePassword.'" name="password" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
			echo '<tr><th>Confirm Password:</th><td><input type="password" value="'.$pleaseGiveMePassword.'" name="cpassword" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" ></td></tr>';
			if ($currentUserType!='User'){
				echo '<tr><th>Job Position:</th><td><input type="text" value="'.$row["job_position"].'" placeholder="psychiatry" name="job_position" required></td></tr>';
			}
			echo '<tr><th>First Name:</th><td><input type="text" value="'.$row["fname"].'" name="fname" placeholder="Chan" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
			echo '<tr><th>Last Name:</th><td><input type="text" value="'.$row["lname"].'" name="lname" placeholder="Tai Man" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
			$maxDate = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")-18)); //calculate the minimum pickup date
			echo '<tr><th>Brithday:</th><td><input type="date" value="'.$row["DateOfbrith"].'" name="DoB" max="'.$maxDate.'"  required="required"></td></tr>';	
			if ($row["gender"]=="Male"){
				echo '<tr><th>Gender:</th><td class="text-center w-100">Male<input type="radio" id="genderM" name="gender" value="Male" checked />';
				echo 'Female <input type="radio" id="genderF" name="gender" value="Female" required /></td></tr>';
			}else{
				echo '<tr><th>Gender:</th><td class="text-center w-100">Male<input type="radio" id="genderM" name="gender" value="Male"/>';
				echo 'Female <input type="radio" id="genderF" name="gender" value="Female" required checked/></td></tr>';
			}
			echo '<tr><th>Email:</th><td><input type="text" value="'.$row["email"].'" name="email" placeholder="sample@test.com" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$" required="required"></td></tr>';
			echo '<tr><th>Contact:</th><td><input type="text" value="'.$row["contactno"].'" name="contactno" placeholder="26998386" pattern="[0-9]{8}" maxlength="8" required="required"></td></tr>';
			echo '<tr><th>Address:</th><td class="text-center"><textarea rows="3" cols="50%" name="address" required>'.(($currentUserType=='User')? ($row["address"]):($row["officeaddress"])).'</textarea/></td></tr>';
			echo '<tr><td colspan="2" class="p-3"><div class="row"><div class="col-6 text-right"><input type="reset" value="reset"></div><div class="col-6 "><input type="submit" value="Change"></div></div></td></tr></table></form></div></div></div>';	
		}
	}catch (PDOException $e){
		echo "Error: ".$e->getMessage();
		}
	
	
	if ($submitted){		
		$inusername=$_POST["username"];
		$inpassword=$_POST["password"];
		$infname=$_POST["fname"];
		$inlname=$_POST["lname"];
		$inDoB=$_POST["DoB"];
		$ingender=$_POST["gender"];
		$inemail=$_POST["email"];
		$incontactno=$_POST["contactno"];
		$inaddress=$_POST["address"];
		$injob_position=(($currentUserType!='User')? $_POST["job_position"]:NULL);
		
		try {
			$sql = "SELECT * FROM account where Account=:name";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':name'=>$inusername));
			$nRows=0;
			$cuurentUser = $_COOKIE['user'];
			// output data of each row		
			foreach($stmt as $row) {
				$nRows++;
				if ($row["Account"]==$cuurentUser)
					$nRows--;
			}
			
			if ($nRows==0){
				if  ($_POST["password"]==$_POST["cpassword"]){
					if ($currentUserType=='User'){
						$sql = "UPDATE user
								SET username='$inusername', fname='$infname', lname= '$inlname', DateOfbrith='$inDoB',
								gender='$ingender',email='$inemail',contactno='$incontactno',address='$inaddress'
								WHERE username=:name;
								UPDATE account
								SET Account='$inusername',Password='$inpassword'
								WHERE Account=:name;";
					}else
						$sql = "UPDATE Doctor
								SET username='$inusername', fname='$infname', lname= '$inlname',job_position='$injob_position', DateOfbrith='$inDoB',
								gender='$ingender',email='$inemail',contactno='$incontactno',officeaddress='$inaddress'
								WHERE username=:name;
								UPDATE account
								SET Account='$inusername',Password='$inpassword'
								WHERE Account=:name;";
					
					$stmt = $conn->prepare($sql);
					$stmt->execute(array(':name'=>$cuurentUser));		
					echo '<script>alert("You have successfully edited your information.");location.href ="memberProfile.php"</script>';
					
					//header("Location: memberProfile.php");
					}else {
						echo '<script>alert("Please input the same password twice.");</script>';
					} 
				
			}else{
				echo '<script>alert("The username have been used.");</script>';
			}
			
		}catch (PDOException $e){
			echo "Error: ".$e->getMessage();
		}
		
	}	
		
}else {
	echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
?>
		</div>
		<footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>