<?php
session_start();

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

$username = $_SESSION["username"];	
$username = rtrim($username);

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../message.php");
	die();
}

//Sterilize Inputs
$username = $db->real_escape_string($username);

//Change newsletter status
$newsletter = $_SESSION["newsletter"];
if ($newsletter == 0) {
	$query = "UPDATE emmanuelaccountinfo SET newsletter = 1 WHERE username = '$username'";
	if (!$db->query($query)) {
		$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../message.php");
		die();
	}
	$_SESSION["newsletter"] = 1;
	$_SESSION["message"] = "You have been set to start receiving the newsletter.";
}
else {
	$query = "UPDATE emmanuelaccountinfo SET newsletter = 0 WHERE username = '$username'";
	if (!$db->query($query)) {
		$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../message.php");
		die();
	}
	$_SESSION["newsletter"] = 0;
	$_SESSION["message"] = "You have been set to stop receiving the newsletter.";
}

header("Location: ../message.php");
?>