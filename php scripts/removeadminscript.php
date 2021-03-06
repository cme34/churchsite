<?php
include "../../config/config.php";

session_start();

//If the user is not a master, prevent them from accessing this page
if (!($_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

//Obtain form data
$username = $_GET["username"];	
$username = rtrim($username);

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../manageadmins.php");
	die();
}

//Sterilize Inputs
$username = $db->real_escape_string($username);

//Check if username exists
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows <= 0) {
	$_SESSION["message"] = "User $username doesn't exist.";
	header("Location: ../manageadmins.php");
	die();
}

//Remove admin
$query = "DELETE FROM emmanuelaccountinfo WHERE username = '$username'";
if (!$db->query($query)) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../manageadmins.php");
	die();
}

//Set session message and redirect
$username = $_GET["username"];	
$username = rtrim($username);
$_SESSION["message"] = "$username has been removed as an admin.";
header("Location: ../manageadmins.php");
?>