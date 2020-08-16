<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
else{
	require('conn.php');
	$sql = 'DELETE FROM testresult WHERE id="'.$_GET['id'].'";';
	if($con->query($sql)=== True){
		echo '<script>alert("DELETED Successfully "); location.href="dashboard.php";</script>';
	}
	else{
		echo '<script>alert("Something Went Wrong!\n Try Again!'.$conn->error.'"); location.href="dashboard.php";</script>';
	}
}
?>