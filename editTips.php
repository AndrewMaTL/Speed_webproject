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
    <title>Edit Tips</title>
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
			Edit Tips
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
		echo'<meta http-equiv="Refresh" content="0; url=editTips.php" />';
		}		
		
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";	
	$opt = array(PDO::ATTR_PERSISTENT => TRUE);
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	if (isset($_POST['addtip'])){
		$intip=$_POST['addtip'];
		$inissueslevel=$_POST['addissueslevel'];
		$sql = "INSERT INTO tips (tip, issueslevel)
				VALUES ('$intip','$inissueslevel'); ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		echo'<meta http-equiv="Refresh" content="0; url=editTips.php" />';
	}
	
	if (isset($_POST['delete'])){ //#delete record
		$sql = "DELETE FROM tips where tipid=:name;";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_POST["delete"]));
		echo '<script>alert("You have deleted the Question");</script>';
		}		
		
	if (!isset($_POST["edittip"])){ //display <all> faq record
		echo '<script>
				function hide() {
					if (document.getElementById("addQ").style.display === "none") {
						document.getElementById("addQ").style.display = "block";
						document.getElementById("displayAC").style.display = "none";
						document.getElementById("addQB").firstChild.data="Show Tips";
					}else{
						document.getElementById("addQ").style.display = "none";
						document.getElementById("displayAC").style.display = "table";
						document.getElementById("addQB").firstChild.data="Add Tip";
					}
				}
				</script>	';
		echo '<div class="row"><div class="container"><button id="addQB" onclick="hide()" class="btn w-100 m-3 add-button">+Add Tip</button></div></div>';
		echo '<div id="addQ" style="display:none"><form method="post"><table border=1 align=center >
			<tr>
				<th>Tip</th>
				<th>Issues Level</th>
				<th></th>
			</tr>
			<tr>
				<td><textarea rows="3" cols="50%" name="addtip" required></textarea></td>
				<td><select name="addissueslevel" required>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					</select></td>
					<td><input type="submit" value="Add" class="btn gray text-white"></td>
			</tr></table></form></div>';
			
		echo '<table border=1 align=center id="displayAC">
			<tr>
				<th></th>
				<th>Tip</th>
				<th>Issues Level</th>
				<th></th>
			</tr>';
		$i=0;	
		
		$sql = "SELECT * FROM tips";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['tip'].'</td><td>'.$row['issueslevel'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="edittip" value="'.$row['tipid'].'">';
				echo '<input type="submit" value="Edit" class="btn gray text-white"></form></td></tr>';
			}
		if ($i==0){
			echo '<tr><td colspan=4>0 record found!</td></tr>';
		}			
		echo'</table>';
		
	}else{	// choosed tips record
		$currenttipid=$_POST["edittip"];
		$submitted = isset($_POST["tip"]) && isset($_POST["issueslevel"]);
		if ($submitted){ // submitted edit form
			$intip=$_POST["tip"];
			$inissueslevel=$_POST["issueslevel"];
			
			try {
				$opt = array(PDO::ATTR_PERSISTENT => TRUE);
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);					
				$sql = "UPDATE tips
						SET tip='$intip', issueslevel='$inissueslevel'
						WHERE tipid=:id;";
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id'=>$currenttipid));
				echo '<script>alert("You have updated the Tip");</script>';
				echo'<meta http-equiv="Refresh" content="0; url=editTips.php" />';
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}
			
		}else{ //display choosed tips record					
		
			$sql = "SELECT * FROM tips
					WHERE tipid=:id;";
		
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':id'=>$currenttipid));
			foreach ($stmt as $row) {
				echo '<table id="tbforMenu" align=center>';
				echo '<tr><th><form method="post" class="sbutton"><input type="hidden" value="true" name="goback"><input type="submit" value="Back" class="btn gray text-white"></form></th>';
				echo '<th><form method="post" class="sbutton"><input type="hidden" value="'.$currenttipid.'" name="delete"><input type="submit" value="Delete" class="btn gray text-white"></form></th></tr>';
				echo '<form method="post">';
				echo '<tr><th>Tip</th><td><textarea rows="3" cols="50%" name="tip" required>'.$row['tip'].'</textarea></td></tr>';
				echo '<tr><th>Issues Level</th><td><select name="issueslevel" id="sel" class="w-25" required>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					</select></td></tr>';
				echo '<script>  document.getElementById("sel").selectedIndex ='.(int)($row['issueslevel']-1).';</script>';
				echo '<tr class="noBorder"><td><input type="submit" value="Change" class="btn gray text-white"></td><td><input type="reset" value="Reset" class="btn gray text-white"></td></tr>';
				echo '<input type="hidden" name="edittip" value="'.$currenttipid.'"></form></table>';
			}
		}
	}
}else {
	echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
?>
		</div>
</body>
<footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</html>