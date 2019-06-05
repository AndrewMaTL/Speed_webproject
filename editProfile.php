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
<!-- import Doctor_list.css -->
<link rel="stylesheet" type="text/css" href="css/Doctor_list.css">
<!-- import Edit.css -->
<link rel="stylesheet" type="text/css" href="css/Edit.css">


<head>
    <!-- page title -->
    <title>Edit Profile</title>
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
									<span id="infoName">Admin</span>
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
									<input type="submit" value="LogOut" name="LogOut" class="btn button blue">			
								</form>		
							</div>
						</div>
					</div>
				</div>
		</section>
	
		<div class="main">
			<div class="tab">
			Edit Profile
			</div>
			<br>		
<?php 	
if (isset($_COOKIE['user'])){
	
	if (isset($_POST['loginsatge'])){ //#logout
		setcookie('logined','false');
		setcookie('user','');
		echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
		}
	if (isset($_POST['goback'])){ //#goback
		echo'<meta http-equiv="Refresh" content="0; url=editProfile.php" />';
		}		
		
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";	
	$opt = array(PDO::ATTR_PERSISTENT => TRUE);
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	if (isset($_POST['delete'])){ //#delete record
		$sql = "DELETE FROM user where username=:name;
				DELETE FROM doctor where username=:name;
				DELETE FROM account where Account=:name;";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_POST["delete"]));	
		echo '<script>alert("You have deleted the Account");</script>';
		}		
		
	if (!isset($_POST["editUserName"])){ //display <all> account record
		echo '<table border=1 align=center id="displayAC">
			<tr>
				<th></th>
				<th>UserName</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Account Type</th>
				<th></th>
			</tr>';
		$i=0;	
		
		$sql = "SELECT * FROM user,account where user.username= account.Account";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['username'].'</td><td>'.$row['fname'].'</td><td>'.$row['lname'].'</td><td>'.$row['AccountType'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="editUserName" value="'.$row['username'].'"><input type="hidden" name="editACType" value="'.$row['AccountType'].'">';
				echo '<input type="submit" value="Edit"  class="btn gray text-white button_Broder"></form></td></tr>';
			}
			
		$sql = "SELECT * FROM doctor,account where doctor.username= account.Account";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['username'].'</td><td>'.$row['fname'].'</td><td>'.$row['lname'].'</td><td>'.$row['AccountType'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="editUserName" value="'.$row['username'].'"><input type="hidden" name="editACType" value="'.$row['AccountType'].'">';
				echo '<input type="submit" value="Edit" class="btn gray text-white button_Broder"></form></td></tr>';
			}
		if ($i==0){
			echo '<tr><td colspan=6>0 record found!</td></tr>';
		}
		echo'</table>';
		
	}else{	// choosed account record
		$currentUserType=$_POST["editACType"];
		$submitted = isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cpassword"]) &&
					isset($_POST["fname"]) && isset($_POST["lname"]) &&	isset($_POST["DoB"]) &&	
					isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["contactno"]) &&
					isset($_POST["address"]) && (($currentUserType!='User')? isset($_POST["job_position"]):true);	
		if ($submitted){ // submitted edit form
			$inusername=$_POST["username"];
			$inpassword=$_POST["password"];
			$checkpass=$_POST["cpassword"];
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
				$cuurentUser = $_POST["editUserName"];
				// output data of each row		
				foreach($stmt as $row) {
					$nRows++;
					if ($row["Account"]==$cuurentUser)
						$nRows--;
				}
			if ($nRows==0){
				if ($inpassword==$checkpass){				
					if ($currentUserType=='User'){
						$sql = "UPDATE user
								SET username='$inusername', fname='$infname', lname= '$inlname', DateOfbrith='$inDoB',
								gender='$ingender',email='$inemail',contactno='$incontactno',address='$inaddress'
								WHERE username=:name;
								UPDATE account
								SET Account='$inusername',Password='$inpassword'
								WHERE Account=:name;";
					}else{
						$sql = "UPDATE Doctor
								SET username='$inusername', fname='$infname', lname= '$inlname',job_position='$injob_position', DateOfbrith='$inDoB',
								gender='$ingender',email='$inemail',contactno='$incontactno',officeaddress='$inaddress'
								WHERE username=:name;
								UPDATE account
								SET Account='$inusername',Password='$inpassword'
								WHERE Account=:name;";
					}
					$stmt = $conn->prepare($sql);
					$stmt->execute(array(':name'=>$_POST["editUserName"]));
					echo '<script>alert("You have updated the Account Record");</script>';
					echo'<meta http-equiv="Refresh" content="0; url=editProfile.php" />';
				}else{
					echo'<script>alert("Please input the same password twice.")</script>';
					echo'<meta http-equiv="Refresh" content="0; url=editProfile.php" />';
				}
			}else{
					echo'<script>alert("The username have been used.")</script>';
					echo'<meta http-equiv="Refresh" content="0; url=editProfile.php" />';
				}
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}
			
		}else{ //display choosed account record
						
			if ($currentUserType=='User'){
				$sql = "SELECT * FROM user,account 
						WHERE user.username= account.Account 
						AND account.Account=:name";
			}else{
				$sql = "SELECT * FROM doctor,account 
						WHERE doctor.username= account.Account
						AND account.Account=:name";
			}
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':name'=>$_POST["editUserName"]));
			foreach ($stmt as $row) {
				echo '<table id="tbforMenu" align=center class="col-5">';
				echo '<tr><th><form method="post" class="sbutton"><input type="hidden" value="true" name="goback"><input type="submit" value="Back" class="btn gray text-white button_Broder"></form></th>';
				echo '<th><form method="post" class="sbutton"><input type="hidden" value="'.$_POST["editUserName"].'" name="delete" ><input type="submit" value="Delete" class="btn gray text-white button_Broder"></form></th></tr>';
				echo '<form method="post">';
				echo '<tr><th>Username:</th><td><input type="text" disabled value="'.$row["username"].'" placeholder="AcountID" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
				echo '<input type="hidden" value="'.$row["username"].'" name="username">';
				echo '<tr><th>Password:</th><td><input type="password" value="'.$row["Password"].'" name="password" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
				echo '<tr><th>Confirm password:</th><td><input type="password" value="'.$row["Password"].'" name="cpassword" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" ></td></tr>';
				if ($currentUserType!='User'){
					echo '<tr><th>Job Position:</th><td><input type="text" value="'.$row["job_position"].'" placeholder="psychiatry" name="job_position" required></td></tr>';
				}
				echo '<tr><th>First name:</th><td><input type="text" value="'.$row["fname"].'" name="fname" placeholder="Chan" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
				echo '<tr><th>Last name:</th><td><input type="text" value="'.$row["lname"].'" name="lname" placeholder="Tai Man" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td></tr>';
				$maxDate = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")-18)); //calculate the minimum pickup date
				echo '<tr><th>brithday</th><td><input type="date" value="'.$row["DateOfbrith"].'" name="DoB" max="'.$maxDate.'"  required="required"></td></tr>';	
				if ($row["gender"]=="Male"){
					echo '<tr><th>Gender:</th><td>Male<input type="radio" id="genderM" name="gender" value="Male" checked />';
					echo 'Female <input type="radio" id="genderF" name="gender" value="Female" required /></td></tr>';
				}else{
					echo '<tr><th>Gender:</th><td>Male<input type="radio" id="genderM" name="gender" value="Male"/>';
					echo 'Female <input type="radio" id="genderF" name="gender" value="Female" required checked/></td></tr>';
				}
				echo '<tr><th>Email:</th><td><input type="text" value="'.$row["email"].'" name="email" placeholder="sample@test.com" pattern="[A-za-z0-9._%+-]+@[A-za-z0-9.-]+\.[a-z]{2,}$" required="required"></td></tr>';
				echo '<tr><th>Contact:</th><td><input type="text" value="'.$row["contactno"].'" name="contactno" placeholder="26998386" pattern="[0-9]{8}" maxlength="8" required="required"></td></tr>';
				echo '<tr><th>Address:</th><td><textarea rows="3" cols="25%" name="address" required>'.(($currentUserType=='User')? ($row["address"]):($row["officeaddress"])).'</textarea/></td></tr>';
				echo '<tr class="noBorder"><td><input type="reset" value="Reset"  class="btn gray text-white button_Broder"></td><td><input type="submit" value="Change"  class="btn gray text-white button_Broder"></td></tr>';
				echo '<input type="hidden" name="editUserName" value="'.$_POST["editUserName"].'"><input type="hidden" name="editACType" value="'.$currentUserType.'"></form></table>';
			}
		}
	}
}else{
	echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
?>
		</div>
		<footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>