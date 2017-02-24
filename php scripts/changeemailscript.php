<?php
session_start();

//Obtain form data
$oldemail = $_POST["oldemail"];	
$newemail = $_POST["newemail"];	
$password = $_POST["password"];	

$oldemail = rtrim($oldemail);
$newemail = rtrim($newemail);
$password = rtrim($password);

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../changeemail.php");
	die();
}

//Sterilize Inputs
$username = $_SESSION["username"];
$username = $db->real_escape_string($username);
$oldemail = $db->real_escape_string($oldemail);
$newemail = $db->real_escape_string($newemail);
$password = $db->real_escape_string($password);

//Hash passwords
$password = hash("sha256", $password);

//Check if email matches
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.email = '$oldemail'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows < 1) {
	//Set error message and go to login page
	$_SESSION["error"] = "Old email is incorrect.";
	header("Location: ../changeemail.php");
	die();
}

//Check if password matches
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.password = '$password'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows < 1) {
	//Set error message and go to login page
	$_SESSION["error"] = "Password is incorrect.";
	header("Location: ../changeemail.php");
	die();
}

//Change email in database
$query = "UPDATE emmanuelaccountinfo SET email='$newemail' WHERE username='$username'";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when changing email. Please try again.";
	header("Location: ../changeemail.php");
	die();
}

$_SESSION["message"] = "You have changed your email successfully.";
header("Location: ../message.php");
?>