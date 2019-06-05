<?php
	try{
	$servername = "localhost";
	$username = "root";
	$password = "hkcc1234";
	$dbname = "spd4517";	
	$opt = array(PDO::ATTR_PERSISTENT => TRUE);
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,$opt);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
			}	
	$type=0;
	if (isset($_COOKIE['user'])){
		if (isset($_POST['loginsatge'])){ //#logout
			setcookie('logined','false');
			setcookie('user','');
			setcookie('Questionnairestatus','');
			setcookie('QuestionnaireScore','');
			setcookie('Questionnairelevel','');
		echo'<meta http-equiv="Refresh" content="0; url=index.php" />';
		}
		
		if ($_COOKIE['user']!='admin'){
			try {					
				$sql = "SELECT * FROM account where Account = :name";
				$stmt = $conn->prepare($sql);
				$stmt->execute(array(':name'=>$_COOKIE['user']));
				$currentUserType='';
				foreach($stmt as $row) {
					$currentUserType=$row["AccountType"];				
				}
			}catch (PDOException $e){
				echo "Error: ".$e->getMessage();
				}	
			if ($currentUserType=='User')
				$type=1;
			else
				$type=2;
		}else $type=3;		
	}
	
		function outLogoutB($type){				
			echo '<li class="nav-item">
					<div class="dropdown">
						<button class="dropbtn nav-link">Member Area ▼</button>
						<div class="dropdown-content">';
							switch ($type){
								case 1: echo '	<a class="nav-link" href="recommendation.php">Recommendation</a>
												<a class="nav-link" href="memberProfile.php">User Profile</a>';
										break;
								case 2:	echo '	<a class="nav-link" href="editRecommendation.php">Edit Recommend Site</a>
												<a class="nav-link" href="editevent.php">Post Event</a>
												<a class="nav-link" href="memberProfile.php">User Profile</a>';
										break;
								case 3:	echo '	<a class="nav-link" href="editProfile.php">Edit Profile</a>
												<a class="nav-link" href="editTips.php">Edit Tips</a>
												<a class="nav-link" href="editRecommendation.php">Edit Recommend Site</a>';	
										break;
								default:echo '	<a class="nav-link" href="login.php">Login</a>
												<a class="nav-link" href="Registration.php">Registration</a>';
										break;
							}
		if ($type!=0){
			echo'			<a class="nav-link" disable>			
								<form method="post" class="sbutton m-0">
									<input type="hidden" value="false" name="loginsatge">
									<input class="temp" id="submitB" type="submit" value="LogOut" name="LogOut">
									<label class="m-0" for="submitB">Logout</label>
								</form>
							</a>';
				}
			echo'		</div>
					</div>
				</li>';
		}
		
	echo '<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
        <!-- Logo and the href of home page -->
        <a class="navbar-brand" href="index.php">
            <img src="images/Logo.jpg" height="50" class="p-2" />M.H.C.C.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
		<!-- right href item  -->
        <div class="collapse navbar-collapse right" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">';
			
				
		
		switch ($type){
			
		case 1: //user
				echo '	<li class="nav-item ">
							<a class="nav-link" href="Questionnaire.php	">Questionnaire </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="game.php">Game</a>
						</li>				
						<li class="nav-item">
							<a class="nav-link" href="event.php">Event</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Doctor_list.php">Doctor List</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="QandA.php">Q&A</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="AboutUs.php">About us</a>
						</li>';									
						
						outLogoutB(1);
				break;	
				
		case 2: //doctor
				echo '	<li class="nav-item">
							<a class="nav-link" href="event.php">Event</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="game.php">Game</a>
						</li>						
						<li class="nav-item ">	
							<a class="nav-link" href="QandA.php">Q&A</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="AboutUs.php">About us</a>
						</li>';			
						outLogoutB(2);		
				break;
				
		case 3: //admin
				echo '	
						<li class="nav-item">
							<a class="nav-link" href="event.php">Event</a>
						</li>
						<li class="nav-item ">				
							<a class="nav-link" href="editevent.php">Edit Event</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="QandA.php">Q&A</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="editQandA.php">Edit Q&A</a>
						</li>';			
						outLogoutB(3);
				break;
				
		default: // guest
				echo '	<li class="nav-item ">
							<a class="nav-link" href="Questionnaire.php	">Questionnaire </a>
						</li>						
						<li class="nav-item">
							<a class="nav-link" href="game.php">Game</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="event.php">Event</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="Doctor_list.php">Doctor List</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="QandA.php">Q&A</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="AboutUs.php">About us</a>
						</li>';	
						outLogoutB(0);
				break;		
		}
    echo '</ul></div></nav>';
	
?>
<html>
<head>
<style>
.dropbtn {
  background-color: #f8f9fa;
  color: white;
  /* padding: 16px; */
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #f8f9fa;}

	.temp{
		display: none;
	}

</style>
</head>
</html>