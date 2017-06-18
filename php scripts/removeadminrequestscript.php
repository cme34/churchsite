<?php
include "../../config/config.php";

session_start();

//If the user is not a master, prevent them from accessing this page
if (!($_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

//Obtain form data
$email = $_GET["email"];	
$email = rtrim($email);

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../manageadmins.php");
	die();
}

//Sterilize Inputs
$email = $db->real_escape_string($email);

//Check if email exists
$query = "SELECT * FROM emmanuelpendinginfo WHERE emmanuelpendinginfo.email = '$email'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows <= 0) {
	$_SESSION["message"] = "Email $email doesn't exist.";
	header("Location: ../manageadmins.php");
	die();
}

//Remove admin request
$query = "DELETE FROM emmanuelpendinginfo WHERE email = '$email'";
if (!$db->query($query)) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../manageadmins.php");
	die();
}

//Set session message and redirect
$email = $_GET["email"];	
$email = rtrim($email);
$_SESSION["message"] = "$email has been removed as an admin request.";
header("Location: ../manageadmins.php");
?>