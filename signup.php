<?php
session_start();
if(isset($_SESSION['loggedin'])){
header('Location: home.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sign Up</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Sign Up</h1>
			<form action="register.php" method="post">
				<label for="email">
					<i class="fa fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<label for="name">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="name" placeholder="Name" id="name" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				

				<input type="submit" value="SignUp">
			</form>
			<p style="text-align:center;">Already Have account <a href="login.php">Log In</a><br>&nbsp;</p>
		</div>
	</body>
</html>