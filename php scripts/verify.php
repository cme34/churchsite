<?php
include "../../config/config.php";

session_start();

//Check if verification link is valid
if (!isset($_GET["username"])) {
	$_SESSION["message"] = "Error verifying account.";
	header("Location: ../message.php");
	die();
}
$username = $_GET["username"];	

if (!isset($_GET["hash"])) {
	$_SESSION["message"] = "Error verifying account.";
	header("Location: ../message.php");
	die();
}
$hash = $_GET["hash"];	

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../message.php");
	die();
}

$username = $db->real_escape_string($username);
$hash = $db->real_escape_string($hash);

//Check if already verified
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.verified = '1'";
$result = $db->query($query);
$rows = $result->num_rows;
if (!$rows < 1) {
	$_SESSION["message"] = "This account is already verified.";
	header("Location: ../message.php");
	die();
}

//Check if username and hash match
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.hash = '$hash'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows < 1) {
	$_SESSION["message"] = "Verification failed. Please try again.";
	header("Location: ../message.php");
	die();
}

//Set account to verified
$query = "UPDATE emmanuelaccountinfo SET verified='1' WHERE username='$username'";
if (!$db->query($query)) {
	$_SESSION["message"] = "Verification failed. Please try again.";
	header("Location: ../message.php");
	die();
}

//Set session message and navigate to message.php
$_SESSION["message"] = "Your account has been verified.";
header("Location: ../message.php");
?>