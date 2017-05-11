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
$directions = $_POST["directions"];

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../editdirections.php");
	die();
}

//Sterilize Inputs
$directions = $db->real_escape_string($directions);

//First try to insert, if fails, try update
//Insert
$query = "INSERT INTO directions (directions) VALUES ('$directions')";
if (!$db->query($query)) {
	//Update
	$query = "UPDATE directions SET directions.directions='$directions' WHERE id=1";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../editdirections.php");
		die();
	}
}

$_SESSION["message"] = "Directions updated successfully.";
header("Location: ../message.php");
?>