<?php
include "../../config/config.php";

session_start();
//If the user is not signed in, prevent them from accessing this page
if (!isset($_SESSION["username"])) {
	header("Location: home.php");
}

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

//If info is not set, prevent them from accessing this page
if (!(isset($_GET["loc"]))) {
	header("Location: home.php");
}
$loc = $_GET["loc"];

if (!isset($_GET["postid"])) {
	header("Location: $loc.php");
}
$postid = $_GET["postid"];

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../message.php");
	die();
}

//Get db name
$dbloc = str_replace(" ", "", $loc);
$dbloc = "posts$dbloc";

//Get image path
$query = "SELECT * FROM $dbloc WHERE $dbloc.postid = '$postid'";
$result = $db->query($query);
if ($result->num_rows < 1) {
	//Set error message and go to login page
	$_SESSION["message"] = "An error occured when reading data from the database. Please try again." . mysqli_error($db);
	header("Location: ../message.php");
	die();
}
$row = $result->fetch_assoc();
$img = $row["image"];

if ($img == null || $img == "") {
	$_SESSION["message"] = "There was no image found for this post. Image removal failed.";
	header("Location: ../message.php");
	die();
}

//Remove image from file system
if (!unlink("../$img")) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../message.php");
	die();
}

//Remove image from db
$query = "UPDATE $dbloc SET image='' WHERE postid='$postid'";
if (!$db->query($query)) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../message.php");
	die();
}

$_SESSION["message"] = "Image removed successfully";
header("Location: ../message.php");
?>