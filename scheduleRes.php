<?php
session_start();
header('Content-type: application/json');
$json = file_get_contents('php://input');
$json_decode = json_decode($json); 
$json_encode = json_encode($json_decode);
//echo $json_encode;
$testid=rand(100,999).$_SESSION["id"];
$testlink=strtotime(date("h:i:sa")).$_SESSION["id"];
$file_url=$_SESSION["id"]."/".$testlink.".json";
if( is_dir($_SESSION["id"]) === false )
{
    mkdir($_SESSION["id"]);
}
//echo $file_url;
$myfile = fopen($file_url, "w+") or die("Unable to open file!");
fwrite($myfile, $json_encode);
fclose($myfile);

require('conn.php');
	$sql = "INSERT INTO `tests` (`testid`, `testurl`, `adminid`) VALUES ('".$testid."',  '".$file_url."', '".$_SESSION["id"]."')";
	if (mysqli_query($con, $sql)) {
	  echo $_SESSION["parti_name"]." is inviting you to take a test.\nTest Link: http://".$_SERVER['SERVER_NAME']."/index.php?testid=".$testid."\nTitle: ".$json_decode->testTitle."\nTest Id:".$testid;
	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
?>