    <html>
        <!-- import style.css -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- import bootstrap.css -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <!-- import index.css -->
        <link rel="stylesheet" href="css/index.css">
        <!-- import jquery.js -->
        <script type="text/javascript" src="javascript/jquery.min.js"></script>
        <!-- import global.js -->
        <script src="javascript/global.js"></script>
        <link rel="stylesheet" href="css/events.css">


        <head>
            <title>Mental Health Care Center</title>
            <link rel="shortcut icon" href="images/Logo.jpg" />
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
            <section id="main_page">
                <section class="banner">
                    <div class="container">
                        <div class="row banner_center">
                      <div class="col-8">
<h2>Doctor Events</h2>

<div class="tabs" id="tabbar">
<?php
	$sql  = "	SELECT * FROM events,Doctor
				WHERE Doctor.username = events.Doctor
				ORDER BY dateOfpost DESC LIMIT 5 ";
				$stmt = $conn->query($sql);
	foreach($stmt as $n => $row){
		$doctorname[$n]=$row['fname'].' '.$row['lname'];
		$eventsname[$n]=$row['eventname'];
		$event[$n]=$row['eventdetail'];
		$date[$n]=$row['dateOfpost'];
	// Echo $doctorname[$n],$eventsname[$n],$event[$n],$date[$n];
	}
				
	for($t=0; $t<5 ;$t++)
	{
	  if($t==0){
		echo '<button class="tablink" onclick="openCity(event, \''.$doctorname[$t].'\')"id="defaultOpen">'.$eventsname[$t].'</button>' ;
	}else{
	  echo '<button class="tablink" onclick="openCity(event, \''.$doctorname[$t].'\')">'.$eventsname[$t].'</button>' ;
	}}
?>

</div>
<?php
for($t=0; $t<5 ;$t++)
{
  echo'<div id="'.$doctorname[$t].'" class="tabcontent p-3">
  <h3>'.$eventsname[$t].'</h3>  <p>'.$event[$t].'<br/><br/><b>Posted on '.$date[$t].'<br>by DR.'.$doctorname[$t].'</b></p></div>';
}
?>
</div>
                        </div>
                    </div>
                </section>
            </section>

                    <footer class="nav-down py-3">
                        Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights
                        reserved.
                    </footer>
                </body>

                <script>
function openCity(evt, cityName) {
  var i, tabcontent, tablink;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablink = document.getElementsByClassName("tablink");
  for (i = 0; i < tablink.length; i++) {
    tablink[i].className = tablink[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function setHeight() {
  var Newheight = document.getElementById("tabbar").style.height ;
    console.log(Newheight);
  for(var i = 0; i<5 ; i++){
document.getElementsByClassName("tabcontent")[i].style.height = Newheight;
}
return true;
}
setHeight();
</script>
            </html>