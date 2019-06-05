<!DOCTYPE html>
<html>

<!-- import bootstrap.css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- import style.css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- import Q&A.css -->
<link rel="stylesheet" type="text/css" href="css/QandA.css">
<!-- import Doctor_list.css -->
<link rel="stylesheet" type="text/css" href="css/Doctor_list.css">
<!-- import Q&A.js -->
<script src="../javascript/QandA.js">
</script>
<!-- import admin default script.js -->
<script type="text/javascript" src="javascript/admin_default_script.js"></script>
<!-- import userpage .js -->
<script type="text/javascript" src="javascript/userpage.js">  </script>
<style>
::-webkit-input-placeholder {
   text-align: center;
}

:-moz-placeholder { /* Firefox 18- */
   text-align: center;  
}

::-moz-placeholder {  /* Firefox 19+ */
   text-align: center;  
}

:-ms-input-placeholder {  
   text-align: center; 
}
</style>

<head>
    <title>Doctor list</title>
	<link rel="shortcut icon" href="images/Logo.jpg" />
</head>

<body>
    <!-- navbar(bootstrap 4) -->
    <?php
	include 'NavgationBar.php';
	?>
    <!-- end of nav bar -->
    <section class="doctor_banner">
    </section>

    <section class="content_bg text-center">
      <h1>Recommend Doctor</h1>
        <section>
<?php 
$value = 0;
//create list table function
function datatable($stmt)
{
    // decare array
    $cols = array(
        "db" => array(
            "fname",
            "lname",
            "job_position",
            "DateOfbrith",
            "gender",
            "email",
            "contactno",
            "officeaddress"
        ),
        "column" => array(
            "First name",
            "Last name",
            "job Position",
            "Age",
            "Gender",
            "Email",
            "Contact",
            "Office Address"
        )
    );
    
    // table
    echo '<form method="POST"><table border="0">
    <tr><th colspan="2"><input type="text" name="search" placeholder="search" ><input class="btn gray" type="submit" value="&#x1F50D;"></th></tr>
    <tr>';
                    // loop for display the table header
    foreach ($cols['column'] as $key => $col) {
        $case=$key;
        if(isset($_POST['Sortbutton'])){
            switch($_POST['Sortbutton']) {
                case 0:
                $case = 10;
                 break;
                case 1:
                $case = 11;
                 break;
                 case 2:
                $case = 12;
                 break;
                 case 3:
                $case = 13;
                 break;
                 case 4:
                $case = 14;
                 break;
                 case 5:
                $case = 15;
                 break;
                 case 6:
                $case = 16;
                 break;
                 case 7:
                $case = 17;
                 break;
                default:
                 break;
               
            
            }}
        echo '<th>';
        echo' <button class="btn gray text-white" type="submit" class="sort_button" name="Sortbutton" value="'.$case.'">'. $col .'↕</button></th>';

    }

    echo '</tr>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr> ';
        // loop for display table data of each row
        foreach ($cols['db'] as $col) {
            // translat the data to information in store part
            if ($col == "DateOfbrith") {
                echo '<td> ';
        echo intval((strtotime('today')-strtotime($row[$col]))/31556926)."</td>";
            }  else {
                echo '<td> ' . $row[$col] . '</td> ';
            }
        }
        echo ' </tr>';
        
    }
    echo "</table></form>";
}

$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
$sql  = "SELECT * FROM Doctor ";
if(!empty($_POST['search'])){
  $target="%".$_POST['search']."%";
  $sql.=" Where fname LIKE '".$target."'or lname LIKE '".$target."' or email  LIKE '".$target."'or contactno  LIKE '".$target."' or officeaddress LIKE '".$target."'" ;
}
if(isset($_POST['Sortbutton'])){
switch($_POST['Sortbutton']) {
    case 0:
       $sql .= "ORDER BY fname ASC";
     break;
    case 1:
       $sql .= "ORDER BY lname ASC";
     break;
     case 2:
       $sql .= "ORDER BY job_position ASC";
     break;
     case 3:
       $sql .= "ORDER BY DateOfbrith DESC";
     break;
     case 4:
       $sql .= "ORDER BY gender ASC";
     break;
     case 5:
       $sql .= "ORDER BY email ASC";
     break;
     case 6:
       $sql .= "ORDER BY contactno ASC";
     break;
     case 7:
       $sql .= "ORDER BY officeaddress ASC";
     break;
     case 10:
     $sql .= "ORDER BY fname DESC";
   break;
  case 11:
     $sql .= "ORDER BY lname DESC";
   break;
   case 12:
     $sql .= "ORDER BY job_position DESC";
   break;
   case 13:
     $sql .= "ORDER BY DateOfbrith ASC";
   break;
   case 14:
     $sql .= "ORDER BY gender DESC";
   break;
   case 15:
     $sql .= "ORDER BY email DESC";
   break;
   case 16:
     $sql .= "ORDER BY contactno DESC";
   break;
   case 17:
     $sql .= "ORDER BY officeaddress DESC";
   break;
    default:
     break;
   }
}
$stmt = $pdo->query($sql);
datatable($stmt);

?> 
        </section>
    </section>
    <footer class="nav-down py-3">
        Copyright © 2019 Polyu SPEED IW 2019 Group D. All rights reserved.
    </footer>
</body>

</html>