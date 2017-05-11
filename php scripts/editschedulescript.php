<?php
include "../../config/config.php";

session_start();

//If the user is not signed in, prevent them from accessing this page
if (!isset($_SESSION["username"])) {
	header("Location: ../home.php");
}

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2)) {
	header("Location: ../home.php");
}

//Obtain form data
$sunday = $_POST["sunday"];
$monday = $_POST["monday"];
$tuesday = $_POST["tuesday"];
$wednesday = $_POST["wednesday"];
$thursday = $_POST["thursday"];
$friday = $_POST["friday"];
$saturday = $_POST["saturday"];

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../editschedule.php");
	die();
}

//Sterilize Inputs
$sunday = $db->real_escape_string($sunday);
$monday = $db->real_escape_string($monday);
$tuesday = $db->real_escape_string($tuesday);
$wednesday = $db->real_escape_string($wednesday);
$thursday = $db->real_escape_string($thursday);
$friday = $db->real_escape_string($friday);
$saturday = $db->real_escape_string($saturday);

//First try to insert, if fails, try update
//Insert
$query = "INSERT INTO schedule (sunday, monday, tuesday, wednesday, thursday, friday, saturday) VALUES ('$sunday', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday')";
if (!$db->query($query)) {
	//Update
	$query = "UPDATE schedule SET sunday='$sunday', monday='$monday', tuesday='$tuesday', wednesday='$wednesday', thursday='$thursday', friday='$friday', saturday='$saturday' WHERE id=1";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../editschedule.php");
		die();
	}
}

$_SESSION["message"] = "Schedule updated successfully.";
header("Location: ../message.php");
?>