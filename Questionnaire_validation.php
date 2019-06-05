<?php 

// Define basic variables and arrays
$finish = true;
$pdo  = new PDO('mysql:host=localhost;dbname=spd4517', 'root', 'hkcc1234');
$sql  = "SELECT * FROM questionnaire";
$stmt = $pdo->query($sql);
$Userans=array()    ;
// for loop to check fullfill all data
foreach($stmt as $row){
$rowdata ='question'.$row["questionid"];
    if(!isset($_POST[$rowdata])){
$finish=false;
echo 'false';
}
} 
// If the fullfill problem, the answer is stored in the array
if ($finish){
$sql  = "SELECT count(*) FROM questionnaire";
$stmt = $pdo->query($sql);
// get the number of question
foreach($stmt as $row){
$NoOfQ=$row[0];
}
for ($x = 1; $x <= $NoOfQ; $x++) {
        $rowdata ='question'.$x;
        $Userans[$x] = $_POST[$rowdata];
        }

//Comparison of
$sql  = "SELECT correctAnswer FROM questionnaire";
$stmt = $pdo->query($sql);
foreach($stmt as $key => $row){
    $QID = $key + 1;
$correctAnswer[$QID] = $row['correctAnswer'];

}
$Score=0;
for ($x = 1; $x <= $NoOfQ; $x++) {
    if($Userans[$x]==$correctAnswer[$x]){
    $Score+=1;
    } 
}
        // New scores and problem levels
        if($Score>19){
            $level = 3;
        }elseif($Score>9){
            $level = 2;
        }else{
            $level = 1;
        }



//user data part
if(isset($_COOKIE['logined'])){
    if($_COOKIE['logined'] == 'true' ){
    $user = $_COOKIE['user'];
    $sql  = "SELECT count(*) as'count'  FROM answer where user='".$user."'";
    $stmt = $pdo->query($sql);
foreach($stmt as $row){
    $numofdata=$row['count'];
}
//If there is a record to update, then insert the table
    if($numofdata==0){
        for($insertTime = 1; $insertTime<= sizeof($Userans); $insertTime++){
    $sql  = "INSERT INTO answer (Questionid,User,answer) Values ('$insertTime','$user','$Userans[$insertTime]]')";
    $stmt= $pdo->prepare($sql);
    $stmt->execute();	
        }
    }else{
        for($insertTime = 1; $insertTime<= sizeof($Userans); $insertTime++){
           $sql  = "UPDATE  answer SET answer = '$Userans[$insertTime]' WHERE Questionid = '$insertTime' and User= '$user'";
            $stmt= $pdo->prepare($sql);
            $stmt->execute();

            }
            
        }

        $sql  = "UPDATE  user SET Score = '$Score',issueslevel ='$level'  WHERE username= '$user'";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
        header("Location: recommendation.php");
    }
    else{
        setcookie('Questionnairestatus','done');
        setcookie('QuestionnaireScore',$Score);
        setcookie('Questionnairelevel',$level);
        header("Location: Questionnaire.php");
    }
}    else{
		setcookie('Questionnairestatus','done');
        setcookie('QuestionnaireScore',$Score);
        setcookie('Questionnairelevel',$level);
		header("Location: Questionnaire.php");
	}
}else header("Location: Questionnaire.php");
?>