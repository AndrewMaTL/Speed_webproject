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
    <title>Edit Event</title>
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
									$name=$_COOKIE['user'];
									if ($name!='admin'){
										$sql  = "SELECT * FROM doctor where username = '$name'";
										$stmt = $conn->query($sql);										
										foreach($stmt as $row){											
											$name = $row['fname']." ".$row['lname'];
										}
									}else $name="Admin";
									echo $name  ?></span>
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
			Edit Event
			</div>
			<br>	
		
<?php 	
if (isset($_COOKIE['user'])){
	date_default_timezone_set('Asia/Hong_Kong');
	$minDate = date("Y-m-d H:i:s"); //calculate the minimum pickup date
	if (isset($_POST['loginsatge'])){ //#logout
		setcookie('logined','false');
		setcookie('user','');
		echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
		}
	if (isset($_POST['goback'])){ //#goback
		echo'<meta http-equiv="Refresh" content="0; url=editevent.php" />';
		}		
		
	if (isset($_POST['addevent'])){
		$inname=$_POST['addname'];
		$inevent=$_POST['addevent'];
		$inevnet_detail=$_POST['addevnet_detail'];
		$indateOfpost=$_POST['adddateOfpost'];
		$sql = "INSERT INTO events (Doctor,eventname,eventdetail,dateOfpost)
				VALUES ('$inname','$inevent','$inevnet_detail','$indateOfpost'); ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();				
		echo '<script>alert("You have added a Event");</script>';
		echo'<meta http-equiv="Refresh" content="0; url=editevent.php" />';
	}
	
	if (isset($_POST['delete'])){ //#delete record
		$sql = "DELETE FROM events where eventid=:name;";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_POST["delete"]));
		echo '<script>alert("You have deleted the Event");</script>';
		}		
		
	if (!isset($_POST["editevent"])){ //display <all> faq record
		echo '<script>
				function hide() {
					if (document.getElementById("addQ").style.display === "none") {
						document.getElementById("addQ").style.display = "block";
						document.getElementById("displayAC").style.display = "none";
						document.getElementById("addQB").firstChild.data="Show Events";
					}else{
						document.getElementById("addQ").style.display = "none";
						document.getElementById("displayAC").style.display = "table";
						document.getElementById("addQB").firstChild.data="+Add Event";
					}
				}
				</script>	';
		echo '<div class="row"><div class="container"><button id="addQB" onclick="hide()" class="btn w-100 my-3 add-button">+Add Event</button>';
		echo '<div id="addQ" style="display:none"><form method="post"><table border=1 align=center >
			<tr>
				<th>Column</th>
				<th>Data</th>
				<th></th>
			</tr> 
			<tr>
				<td>Doctor Name<br></td>';
		if ($name=="Admin"){
			echo '<td><select required name="addname"><option disabled selected value>-- Doctor Name List --</option>';  
			$sql = "SELECT * FROM events,Doctor 
					WHERE Doctor.username = events.Doctor;";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			foreach ($stmt as $row) {
				echo '<option value='.$row['Doctor'].'>'.$row['fname'].' '.$row['lname'].'</option>';
			}
			echo '</select></td>';
		}else{
			echo '<td><input type="text" value="'.$name.'"disabled required class="w-100">
					<input type="hidden" name="addname" value="'.$_COOKIE['user'].'"></td>';
		}
		echo '
			<td rowspan="4"><input type="submit" value="Add" class="btn gray text-white"></td>
			</tr>
			<tr>
				<td>Event Name<br></td>
				<td><input type="text" name="addevent" required class="w-100"></td>
			</tr>
			<tr>
				<td>Event Detail</td>
				<td><textarea rows="3" cols="50%" name="addevnet_detail" required></textarea></td>
			</tr>
			<tr>
				<td>Post Date</td>
				<td><input type="text" value="'.$minDate.'" disabled required></td>
				<input type="hidden" name="adddateOfpost" value="'.$minDate.'">
			</tr></table></form></div>';
			
		echo '<table border=1 align=center id="displayAC">
			<tr>
				<th>Id</th>
				<th>Responsible Person</th>
				<th>Event Name</th>
				<th>Event Detail</th>
				<th>Post Date</th>
				<th></th>
			</tr>';
		$i=0;	
		if ($_COOKIE['user']!="admin"){
			$sql = "SELECT * FROM events,Doctor 
					WHERE Doctor.username = events.Doctor
					AND events.Doctor=:name";			
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':name'=>$_COOKIE['user']));	
		}else{
			$sql = "SELECT * FROM events,Doctor 
					WHERE Doctor.username = events.Doctor";
			$stmt = $conn->prepare($sql);
			$stmt->execute();	
		}	
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['fname'].' '.$row['lname'].'</td><td>'.$row['eventname'].'</td><td>'.$row['eventdetail'].'</td><td>'.$row['dateOfpost'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="editevent" value="'.$row['eventid'].'">';
				echo '<input type="submit" value="Edit" class="btn gray text-white"></form></td></tr>';
			}
		if ($i==0){
			echo '<tr><td colspan=6>0 record found!</td></tr>';
		}			
		echo'</table>';
		
	}else{	// choosed events record
		$currenteventid=$_POST["editevent"];
		$submitted = isset($_POST["eventname"])&& isset($_POST["eventdetail"]);
		if ($submitted){ // submitted edit form
			$inevent=$_POST["eventname"];
			$inevnet_detail=$_POST["eventdetail"];
			
			try {		
				$sql = "UPDATE events
						SET eventname='$inevent',eventdetail='$inevnet_detail'
						WHERE eventid=:id;";
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id'=>$currenteventid));
				echo '<script>alert("You have updated the Event");</script>';
				echo'<meta http-equiv="Refresh" content="0; url=editevent.php" />';
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}
			
		}else{ //display choosed events record					
		
			$sql = "SELECT * FROM events,Doctor 
					WHERE Doctor.username = events.Doctor
					AND eventid=:id;";
		
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':id'=>$currenteventid));
			foreach ($stmt as $row) {
				echo '<table id="tbforMenu" align=center>';
				echo '<tr><th><form method="post" class="sbutton"><input type="hidden" value="true" name="goback"><input type="submit" value="Back" class="btn gray text-white button_Broder"></form></th>';
				echo '<th><form method="post" class="sbutton"><input type="hidden" value="'.$currenteventid.'" name="delete" ><input type="submit" value="Delete" class="btn gray text-white button_Broder"></form></th></tr>';
				echo '<form method="post">';
				echo '<tr><th>Doctor Name</th><td><input type="text" value="'.$row['fname'].' '.$row['lname'].'"disabled ></td></tr>';
				echo '<input type="hidden" name="doctorname"  value="'.$row['Doctor'].'">';
				echo '<tr><th>Event Name</th><td><textarea rows="3" cols="50%" name="eventname" required>'.$row['eventname'].'</textarea></td></tr>';
				echo '<tr><th>Detail</th><td><textarea rows="3" cols="50%" name="eventdetail" required>'.$row['eventdetail'].'</textarea></td></tr>';

				echo '<tr><th>Post Date</th><td><input type="text" disabled value="'.$row['dateOfpost'].'"></td></tr>';
				echo '<tr class="noBorder"><td><input type="reset" value="Reset" class="btn gray text-white button_Broder"></td><td><input type="submit" value="Change" class="btn gray text-white button_Broder"></td></tr>';
				echo '<input type="hidden" name="editevent" value="'.$currenteventid.'"></form></table>';
			}
		}
	}
}else {
	echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
	echo '</div></div>';
?>
		</div>
		<footer class="nav-down py-3">
        Copyright © 2018 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>