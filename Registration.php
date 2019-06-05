<?php
	ob_start();
	$UserFormsubmitted = isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cpassword"]) &&
						isset($_POST["fname"]) && isset($_POST["lname"]) &&	isset($_POST["DoB"]) &&	
						isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["contactno"]) &&
						isset($_POST["address"]);
	$DoctorFormsubmitted = isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["cpassword"]) &&
						isset($_POST["fname"]) && isset($_POST["lname"]) &&	isset($_POST["DoB"]) &&	
						isset($_POST["gender"]) && isset($_POST["email"]) && isset($_POST["contactno"]) &&
						isset($_POST["address"]) && isset($_POST["job_position"]);
	
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";			
		
	if ($UserFormsubmitted || $DoctorFormsubmitted){	
		$inusername=$_POST["username"];
		$inpassword=$_POST["password"];
		$infname=$_POST["fname"];
		$inlname=$_POST["lname"];
		$inDoB=$_POST["DoB"];
		$ingender=$_POST["gender"];
		$inemail=$_POST["email"];
		$incontactno=$_POST["contactno"];
		$inaddress=$_POST["address"];
		
		try {
			$opt = array(PDO::ATTR_PERSISTENT => TRUE);
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM account where Account=:name";
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':name'=>$inusername));
			$nRows=0;
			// output data of each row		
			foreach($stmt as $row) {
				$nRows++;
			}
			
			if ($nRows==0){
				if  ($_POST["password"]==$_POST["cpassword"]){
					if ($DoctorFormsubmitted){
						$injob_position=$_POST["job_position"];
						$sql = "INSERT INTO Doctor(username, fname, lname,job_position,DateOfbrith,gender , email, contactno, officeaddress)
							VALUES ('$inusername','$infname', '$inlname','$injob_position','$inDoB', '$ingender', '$inemail', '$incontactno','$inaddress');
							INSERT INTO account(Account, Password, AccountType)
							VALUES ('$inusername','$inpassword','Dotor');";
					}else {
						$sql = "INSERT INTO user(username, fname, lname,DateOfbrith,gender , email, contactno, address)
							VALUES ('$inusername','$infname', '$inlname', '$inDoB', '$ingender', '$inemail', '$incontactno','$inaddress');
							INSERT INTO account(Account, Password, AccountType)
							VALUES ('$inusername','$inpassword','User');";
					}	
					$stmt = $conn->prepare($sql);
					$stmt->execute();	
					if (isset($_COOKIE['Questionnairestatus']) && isset($_COOKIE['QuestionnaireScore']) 
							&& isset($_COOKIE['Questionnairelevel']) && $UserFormsubmitted){
						$inScore=$_COOKIE['QuestionnaireScore'];
						$inLevel=$_COOKIE['Questionnairelevel'];												
						$sql = "UPDATE user
								SET issueslevel=$inLevel , Score=$inScore
								WHERE username=:id;";
						
						$stmt = $conn->prepare($sql);
						$stmt->execute(array(':id'=>$inusername));	
						setcookie('Questionnairestatus','');
						setcookie('QuestionnaireScore','');
						setcookie('Questionnairelevel','');
					}						
					echo '<script>alert("You have successfully register the account.");</script>';
					echo'<meta http-equiv="Refresh" content="0; url=memberProfile.php" />';
					setcookie('logined','true');
					setcookie('user',$inusername);
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
<style>
.tabcontent{
    display: block;
    background-color: rgba(0,0,0,0.1);
    border-radius: 15px;
	box-shadow: 0 10px 25px rgba(0,0,0,0.05), 0 20px 48px rgba(0,0,0,0.05), 0 1px 4px rgba(0,0,0,0.1);
}
.box{
	background-color:unset;
}
</style>
<!-- import global.js -->
<script src="javascript/global.js">
</script>


<head>
    <title>Mental Health Care Center</title>
	<link rel="shortcut icon" href="images/Logo.jpg" />
    <style>
        html {
      scroll-behavior: smooth;
    }
	.secrectCode input[type="checkbox"],.secrectCode input[type="Submit"]{	
		display: none;
		
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
    <section id="registration">
        <section class="banner">
            <div class="container">
                <div class="row banner_center">                    
                    
					<div class="offset-2 col-8 p-3">							
						<div class='tabcontent' id="NormalUserRegistration">
							<form class="secrectCode pt-4" method="post">
							<h1 align="center">
									<input type="checkbox" name="scode[]" value="R" id='RB' required><label for='RB'>R</label><input type="checkbox" name="scode[]" value="E" id='EB' ><label for='EB'>E</label><input type="checkbox" name="scode[]" value="G" id='GB' ><label for='GB'>G</label><input type="checkbox" name="scode[]" value="I" id='IB' ><label for='IB'>I</label><input type="checkbox" name="scode[]" value="S" id='SB' ><label for='SB'>S</label><input type="checkbox" name="scode[]" value="T" id='TB' ><label for='TB'>T</label><input type="checkbox" name="scode[]" value="R" id='R2B' ><label for='R2B'>R</label><input type="checkbox" name="scode[]" value="A" id='AB' ><label for='AB'>A</label><input type="checkbox" name="scode[]" value="T" id='TB' ><label for='TB'>T</label><input type="checkbox" name="scode[]" value="I" id='I2B' ><label for='I2B'>I</label><input type="checkbox" name="scode[]" value="O" id='OB' ><label for='OB'>O</label><input type="submit" value="N" id='NB' ><label for='NB'>N</label>
							</h1>									
							</form>
                            <form class="box p-0" method="post">
								
                                <!-- role menu  -->              
								<table class="mx-auto">
									<tr>
										<th>Username:</th> 
										<td><input type="text" name="username" placeholder="AcountID" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>	
									</tr>
									<tr>
										<th>Password:</th>
										<td><input type="password" name="password" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Confirm Password:</th>
										<td><input type="password" name="cpassword" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>First Name:</th>
										<td><input type="text" name="fname" placeholder="Chan" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Last Name:</th>
										<td><input type="text" name="lname" placeholder="Tai Man" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Date Of brith:</th>
										<?php 	
										$maxDate = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")-18)); //calculate the minimum pickup date
										?>
										<td><input type="date" name="DoB" max="<?php echo $maxDate; ?>"  required="required"></td>
									</tr>
									<tr>
										<th>Gender:</th>
										<td class="text-center">Male<input type="radio" name="gender" value="Male" />
											Female <input type="radio" name="gender" value="Female" required />
										</td>
									</tr>
									<tr>
										<th>Email Address:</th>
										<td><input type="text" name="email" placeholder="sample@test.com" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" required="required"></td>
									</tr>
									<tr>
										<th>Contact:</th>
										<td><input type="text" name="contactno" placeholder="26998386" pattern="[0-9]{8}" maxlength="8" required="required"></td>
									</tr>
									<tr>
										<th>Address:</th>
										<td><textarea rows="3" cols="50%" name="address" required></textarea/></td>
									</tr>
									<tr><td colspan="2" class="text-center p-3">
										<input type="submit" value="submit">
										<input type="reset" value="reset"></td>
									</tr>	
								</table>								
                            </form>
						</div>
						<div class='tabcontent pt-4' id="DoctorRegistration">
							<h1 align="center">REGISTRATION</h1><br>
							<form class="box p-0" method="post">
                                
                                <!-- role menu  -->              
								<table class="mx-auto">
									<tr>
										<th>Username:</th> 
										<td><input type="text" name="username" placeholder="AcountID" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>	
									</tr>
									<tr>
										<th>Password:</th>
										<td><input type="password" name="password" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Confirm Password:</th>
										<td><input type="password" name="cpassword" placeholder="Password" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Job Position:</th>
										<td><input type='text' placeholder="psychiatry" name="job_position" required></td>
									</tr>
									<tr>
										<th>Frist Name:</th>
										<td><input type="text" name="fname" placeholder="Chan" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Last Name:</th>
										<td><input type="text" name="lname" placeholder="Tai Man" pattern="[A-Za-z\s]{1-20}" maxlength="20" required="required"></td>
									</tr>
									<tr>
										<th>Date Of brith:</th>
										<?php 	
										$maxDate = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d"), date("Y")-18)); //calculate the minimum pickup date
										?>
										<td><input type="date" name="DoB" max="<?php echo $maxDate; ?>"  required="required"></td>
									</tr>
									<tr>
										<th>Gender:</th>
										<td class="text-center">Male<input type="radio" name="gender" value="Male" />
											Female <input type="radio" name="gender" value="Female" required />
										</td>
									</tr>
									<tr>
										<th>Email:</th>
										<td><input type="text" name="email" placeholder="sample@test.com" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" required="required"></td>
									</tr>
									<tr>
										<th>Contact:</th>
										<td><input type="text" name="contactno" placeholder="26998386" pattern="[0-9]{8}" maxlength="8" required="required"></td>
									</tr>
									<tr>
										<th>Office Address:</th>
										<td><textarea rows="3" cols="50%" name="address" required></textarea></td>
									</tr>
									<tr><td colspan="2" class="text-center p-3">
										<input type="submit" value="submit">
										<input type="reset" value="reset"></td>
									</tr>	
								</table>								
                            </form>
                        </div>
												
                    </div> 
                    
                </div>
            </div>
            <!--Result div of success login-->
            <div id="boxs" class="divbox">
                <h1>Registration success!</h1>
                <p class="close" id="link"><a href="memberProfile.php">Go</a></p>
            </div>
            <!--Result div of fail login-->
            <div id="boxf" class="divbox">
                <h1>Registration Failed!</h1>
				<p id="errmsg">I am error message</p>
                <input type="button" value="Retry" class="close" onclick="location.reload();">
            </div>       
        </section>
		
        <script>
			function openTab(evt, tabName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(tabName).style.display = "block";
				evt.currentTarget.className += " active";
			}
			openTab(event, 'NormalUserRegistration');
		</script>
		<?php			
			$serectCodeSummitted = isset($_POST["scode"]);
			if ($serectCodeSummitted){
				$code = $_POST["scode"];
				$incode='';
				foreach ($code as $temp){ 
					$incode.=$temp;
				}
				if ($incode=="RGI"){
					echo "<script>openTab(event, 'DoctorRegistration');</script>";
				}
			}
		?>
    </section>
    <footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>