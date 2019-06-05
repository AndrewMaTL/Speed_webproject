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
    <title>Edit QandA</title>
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
			Edit QandA
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
		echo'<meta http-equiv="Refresh" content="0; url=editQandA.php" />';
		}		
		
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";	
	$opt = array(PDO::ATTR_PERSISTENT => TRUE);
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	if (isset($_POST['addquestion'])){
		$inquestion=$_POST['addquestion'];
		$inanswer=$_POST['addanswer'];
		$sql = "INSERT INTO fqa (question, answer)
				VALUES ('$inquestion','$inanswer'); ";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		echo'<meta http-equiv="Refresh" content="0; url=editQandA.php" />';
	}
	
	if (isset($_POST['delete'])){ //#delete record
		$sql = "DELETE FROM fqa where fqaid=:name;";
		$stmt = $conn->prepare($sql);
		$stmt->execute(array(':name'=>$_POST["delete"]));		
		echo '<script>alert("You have deleted the Question");</script>';
		}		
		
	if (!isset($_POST["editfqa"])){ //display <all> faq record
		echo '<script>
				function hide() {
					if (document.getElementById("addQ").style.display === "none") {
						document.getElementById("addQ").style.display = "block";
						document.getElementById("displayAC").style.display = "none";
						document.getElementById("addQB").firstChild.data="Show Question";
					}else{
						document.getElementById("addQ").style.display = "none";
						document.getElementById("displayAC").style.display = "block";
						document.getElementById("addQB").firstChild.data="Add Question";
					}
				}
				</script>	';
		echo '<div class="row"><div class="container"><button id="addQB" onclick="hide()" class="btn w-100 my-3 add-button">+Add Question</button>';
		echo '<div id="addQ" style="display:none"><form method="post"><table border=1 align=center >
			<tr>
				<th>Question</th>
				<td><textarea rows="3" cols="50%" name="addquestion" required></textarea></td>
				<td rowspan="2"><input type="submit" class="btn gray text-white" value="Add"></td>
			</tr>
			<tr>
				<th>Answer</th>
				<td><textarea rows="3" cols="50%" name="addanswer" required></textarea></td>
			</tr></table></form></div>';
			
		echo '<table border=1 align=center id="displayAC">
			<tr>
				<th></th>
				<th>Question</th>
				<th>Answer</th>
				<th></th>
			</tr>';
		$i=0;	
		
		$sql = "SELECT * FROM fqa";
		$stmt = $conn->prepare($sql);
		$stmt->execute();		
		foreach ($stmt as $row) {
				$i++;
				echo '<tr><td>'.$i.'</td><td>'.$row['question'].'</td><td>'.$row['answer'].'</td><td>';
				echo '<form method="post"><input type="hidden" name="editfqa" value="'.$row['fqaid'].'">';
				echo '<input type="submit" value="Edit" class="btn gray text-white"></form></td></tr>';
			}
		if ($i==0){
			echo '<tr><td colspan=4>0 record found!</td></tr>';
		}			
		echo'</table>';
		
	}else{	// choosed faq record
		$currentfqaID=$_POST["editfqa"];
		$submitted = isset($_POST["question"]) && isset($_POST["answer"]);
		if ($submitted){ // submitted edit form
			$inquestion=$_POST["question"];
			$inanswer=$_POST["answer"];
			
			try {
				$opt = array(PDO::ATTR_PERSISTENT => TRUE);
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);					
				$sql = "UPDATE fqa
						SET question='$inquestion', answer='$inanswer'
						WHERE fqaid=:id;";
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':id'=>$currentfqaID));
				echo '<script>alert("You have updated the QandA");</script>';
				echo'<meta http-equiv="Refresh" content="0; url=editQandA.php" />';
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}
			
		}else{ //display choosed faq record					
		
			$sql = "SELECT * FROM fqa
					WHERE fqaid=:id;";
		
			$stmt = $conn->prepare($sql);
			$stmt->execute(array(':id'=>$currentfqaID));
			foreach ($stmt as $row) {
				echo '<table id="tbforMenu" align=center>';
				echo '<tr><th><form method="post" class="sbutton"><input type="hidden" value="true" name="goback"><input type="submit" value="Back"  class="btn gray text-white button_Broder"></form></th>';
				echo '<th><form method="post" class="sbutton"><input type="hidden" value="'.$currentfqaID.'" name="delete"><input type="submit" value="Delete"  class="btn gray text-white button_Broder"></form></th></tr>';
				echo '<form method="post">';
				echo '<tr><th>Question</th><td><textarea rows="3" cols="50%" name="question" required>'.$row['question'].'</textarea></td></tr>';
				echo '<tr><th>Answer</th><td><textarea rows="8" cols="50%" name="answer" required>'.$row['answer'].'</textarea></td></tr>';
				
				echo '<tr class="noBorder"><td><input type="submit" value="Change"  class="btn gray text-white button_Broder"></td><td><input type="reset" value="Reset"  class="btn gray text-white button_Broder"></td></tr>';
				echo '<input type="hidden" name="editfqa" value="'.$currentfqaID.'"></form></table>';
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
                        Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights
                        reserved.
                    </footer>
</body>

</html>