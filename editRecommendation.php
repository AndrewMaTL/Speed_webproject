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
    <title>Edit Recommendation Site</title>
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
			Edit Recommendation Site
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
		echo'<meta http-equiv="Refresh" content="0; url=editRecommendation.php" />';
		}		
	
	if (isset($_POST['addsite'])){
		$insite=$_POST['addsite'];
		$inweb_address=$_POST['addweb_address'];
		$inissueslevel=$_POST['addissueslevel'];
		$sql = "INSERT INTO recommend_site (webname, web_address,issueslevel)
				VALUES ('$insite','$inweb_address','$inissueslevel'); ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();				
		echo '<script>alert("You have added a Recommend Site");</script>';
		echo'<meta http-equiv="Refresh" content="0; url=editRecommendation.php" />';
	}
	
	if (isset($_POST['delete'])){ //#delete record
		$sql = "DELETE FROM recommend_site where webid=:name;";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_POST["delete"]));
		echo '<script>alert("You have deleted the Recommend Site");</script>';
		}		
		
	if (!isset($_POST["editside"])){ //display <all> faq record
		echo '<script>
				function hide() {
					if (document.getElementById("addQ").style.display === "none") {
						document.getElementById("addQ").style.display = "block";
						document.getElementById("displayAC").style.display = "none";
						document.getElementById("addQB").firstChild.data="Show Sites";
					}else{
						document.getElementById("addQ").style.display = "none";
						document.getElementById("displayAC").style.display = "table";
						document.getElementById("addQB").firstChild.data="+Add Site";
					}
				}
				</script>	';
		echo '<div class="row"><div class="container"><button id="addQB" onclick="hide()" class="btn w-100 m-3 add-button">+Add Site</button></div></div>';
		echo '<div id="addQ" style="display:none"><form method="post"><table border=1 align=center >
		<tr>
    <th>Column</th>
    <th>Data</th>
<th></th>
		</tr>
<tr>
    <td>Site Name<br></td>
		<td><input type="text" name="addsite" required class="w-100"></td>
		<td rowspan="3"><input type="submit" value="Add" class="btn gray text-white"></th>

</tr>
<tr>
    <td>URL</td>
    <td><input type="url" name="addweb_address" size="50%"
            required></td>
</tr>
<tr>
    <td>IssuesLevel</td>
    <td><select name="addissueslevel" required class="w-25">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select></td>
</tr></table></form></div>';
			
		echo '<table border=1 align=center id="displayAC">
			<tr>
				<th>Id</th>
				<th>Site Name</th>
				<th>URL</th>
				<th>Issues Level</th>
				<th></th>
			</tr>';
		$i=0;	
		
		$sql = "SELECT * FROM recommend_site";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['webname'].'</td><td>'.$row['web_address'].'</td><td>'.$row['issueslevel'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="editside" value="'.$row['webid'].'">';
				echo '<input type="submit" value="Edit" class="btn gray text-white"></form></td></tr>';
			}
		if ($i==0){
			echo '<tr><td colspan=5>0 record found!</td></tr>';
		}			
		echo'</table>';
		
	}else{	// choosed recommend_site record
		$currentwebid=$_POST["editside"];
		$submitted = isset($_POST["webname"])&& isset($_POST["web_address"]) && isset($_POST["issueslevel"]);
		if ($submitted){ // submitted edit form
			$insite=$_POST["webname"];
			$inaddress=$_POST["web_address"];
			$inissueslevel=$_POST["issueslevel"];
			
			try {						
				$sql = "UPDATE recommend_site
						SET webname='$insite',web_address='$inaddress', issueslevel='$inissueslevel'
						WHERE webid=:id;";
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id'=>$currentwebid));
				echo '<script>alert("You have updated the Recommend Site");</script>';
				echo'<meta http-equiv="Refresh" content="0; url=editRecommendation.php" />';
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}
			
		}else{ //display choosed recommend_site record					
		
			$sql = "SELECT * FROM recommend_site
					WHERE webid=:id;";
		
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':id'=>$currentwebid));
			foreach ($stmt as $row) {
				echo '<table id="tbforMenu" align=center>';
				echo '<tr><th><form method="post" class="sbutton"><input type="hidden" value="true" name="goback"><input type="submit" value="Back" class="btn gray text-white button_Broder"></form></th>';
				echo '<th><form method="post" class="sbutton"><input type="hidden" value="'.$currentwebid.'" name="delete" ><input type="submit" value="Delete" class="btn gray text-white button_Broder"></form></th></tr>';
				echo '<form method="post">';
				echo '<tr><th>Site Name</th><td><textarea rows="3" cols="50%" name="webname" required>'.$row['webname'].'</textarea></td></tr>';
				echo '<tr><th>URL</th><td><input type="url" name="web_address" value="'.$row['web_address'].'" size="50%" required></td></tr>';
				echo '<tr><th>Issues Level</th><td><select name="issueslevel" id="sel" class="w-25	" required >
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					</select></td></tr>';
				echo '<script>  document.getElementById("sel").selectedIndex ='.(int)($row['issueslevel']-1).';</script>';
				echo '<tr class="noBorder"><td><input type="reset" value="Reset" class="btn gray text-white"></td><td><input type="submit" value="Change" class="btn gray text-white"></td></tr>';
				echo '<input type="hidden" name="editside" value="'.$currentwebid.'"></form></table>';
			}
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