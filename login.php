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
		<title>Login</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fa fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required><br>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
			<p style="text-align:center;">Create Account <a href="signup.php">Sign up</a><br>&nbsp;</p>
		</div>
	</body>
</html>