<?php
session_start();
if(isset($_SESSION['loggedin'])){
header('Location: admin.php');
}
// Change this to your connection info.
require('conn.php');
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password'], $_POST['name']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill all the fields!');
}
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['email'];
		$_SESSION['id'] = $id;
		$_SESSION['parti_name'] = $_POST['name'];
		echo 'Welcome ' . $_SESSION['name'] . '!';
		header('Location: admin.php');
	} else {
		echo 'User Already Exist';
	}
} else {
	$sql = "INSERT INTO `accounts` (`name`, `password`, `email`) VALUES ('".$_POST['name']."',  '".password_hash($_POST['password'], PASSWORD_DEFAULT)."', '".$_POST['email']."')";
	if (mysqli_query($con, $sql)) {
	  echo "New record created successfully";
		header('Location: login.php');

	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
	}


	$stmt->close();
}
?>