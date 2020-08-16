<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><i class="fa fa-clipboard-list"></i></h1>
				<a href="javascript:void(0)"><?=$_SESSION['parti_name']?></a>
				<a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<center>
			<a href="index.php"><div><i class="fa fa-plus"></i> <br>Join Test</div></a>
			<a href="schedule.php"><div><i class="fa fa-calendar-plus"></i><br> Schedule Test</div></a>
			</center>
		</div>
	</body>
</html>