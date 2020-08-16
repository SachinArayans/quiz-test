<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require('conn.php');
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script>
		$(document).ready(function(){
			$('#s-detail').DataTable({"aaSorting":[[0,'desc']]});
		})
		</script>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1><i class="fa fa-clipboard-list"></i></h1>
				<a href="javascript:void(0)"><?=$_SESSION['parti_name']?></a>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Dashboard</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Name:</td>
						<td><?=$_SESSION['parti_name']?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
				<?php
				require('conn.php');
				$sql="select * FROM `tests` INNER JOIN `testresult` ON tests.testid = testresult.testid WHERE tests.adminid =".$_SESSION['id'];
				$result = mysqli_query($con,$sql);
				$details="";
				if(mysqli_num_rows($result)>0){
					//echo '<table class="table"><tbody>';
					while($row = mysqli_fetch_assoc($result)){
						$qm="";
						for($i=1;$i<=50;$i++){
							if($row["q".$i]!=""){
								$qm .= $row["q".$i]."<br>";
							}
						}
						$details .= '<tr><td>'.$row["testid"].'</td><td>'.$row["name"].'</td><td> '.$qm.' </td><td>'.$row["tm"].'</td><td>'.$row["reg_date"].'</td><td><a href="delete.php?id='.$row['id'].'"><i class="fa fa-trash-alt"></i> Delete</a></td></tr>';
					}
					//echo '</tbody></table>';
				}else{ echo "Zero Result";}
				mysqli_close($con);
				?>
			</div>
		</div>
		<div class="container" style="background:#fff;padding:50px">
						<h5>Your Recent Test Participants:</h5><br>
						<table id="s-detail" class="table table-striped table bordered" style="width:100%">
				<thead><tr><th>Test ID</th><th>Participant Name</th><th>Question:Ans:Marks</th><th>Marks Obtained</th><th>Date & Time</th><th> Action </th></tr></thead>
				<tbody>
				<?php
				echo $details;
				?>

				</tbody>
				<tfoot>
				<tr><th>Test ID</th><th>Participant Name</th><th>Question:Ans:Marks</th><th>Marks Obtained</th><th>Date & Time</th><th> Action </th></tr>
				</tfoot>

				</table>
		</div>
	</body>
</html>