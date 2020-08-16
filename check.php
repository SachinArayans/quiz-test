<?php
error_reporting(E_ERROR);
session_start();
$answer = $_GET['ans'];
$qno = (int)$_GET['qno'];
$testid=$_GET['testid'];
?>

<?php
require('conn.php');
if ($stmt = $con->prepare('SELECT testurl FROM tests WHERE testid = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_GET['testid']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($testurl);
	$stmt->fetch();
	//echo $testurl;
	}
	$stmt->close();
	

}
$myFile=fopen("$testurl","r") or die("Unable to Open File| Database Error! <br>Contact website adiministration");
$job=fread($myFile,filesize("qa.json"));
fclose($myFile);

$obj=json_decode($job);

$rans = $obj->q[$qno]->question->right;
if($answer == $rans){
	$resObj->result="true";
	$qmark="RIGHT";
	$resObj->rightAns=$rans;
	$_SESSION['score']++;
	
}
else{
	$resObj->result="false";
	$qmark="WRONG";
	$resObj->rightAns=$rans;
}
echo json_encode($resObj);
	if($_GET['qno']==0){
		$sql = "INSERT INTO `testresult` (`name`,`testid`,`q".($qno+1)."`) VALUES ('".$_SESSION['parti_name']."','$testid','<b>Q: </b>".$obj->q[$qno]->question->question."<b> Ans: </b>$answer <b>($qmark) </b>')";
				if (mysqli_query($con, $sql)) {
				  //echo "New record created successfully";
				} else {
				  //echo "Error: " . $sql . "<br>" . mysqli_error($con);
				}
		$_SESSION['lastid'] = mysqli_insert_id($con);
	}
	else{
	$sql = "UPDATE `testresult` SET `q".($qno+1)."`= ' <br><b>Q: </b> ".$obj->q[$qno]->question->question." <b>Ans:</b> $answer <b>($qmark) </b>' WHERE id=".$_SESSION['lastid'];
				if (mysqli_query($con, $sql)) {
				  //echo "New record created successfully";
				} else {
				  //echo "Error: " . $sql . "<br>" . mysqli_error($con);
				}
	}
	
	$con->close();
?>