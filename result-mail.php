<?php
error_reporting(E_ERROR);
session_start();
$totalMarks = $_GET['tm'];
//echo mail("sachinarayans@gmail.com","My Subject","Hello Sachin");

if (!isset($_SESSION['parti_name'])) {
	header('Location: login.php');
	exit;
}
else{
	require('conn.php');
	$sql = "UPDATE `testresult` SET `tm`= '".$_SESSION['score']."/$totalMarks' WHERE id=".$_SESSION['lastid'];
	if($con->query($sql)=== True){
		echo '<br>Successfuly Sent to Admin<br>';
	}
	else{
		echo '<script>alert("Erro in sending to admin!\n Error->'.$conn->error.'");</script>';
	}
}
echo "You Got ".$_SESSION['score']." out of $totalMarks";
$_SESSION['score']=0;
?>