<?php
session_start();
//If the user is not signed in, prevent them from accessing this page
if (!isset($_SESSION["username"])) {
	header("Location: ../home.php");
}

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2)) {
	header("Location: ../home.php");
}

//Obtain forum data
$loc = $_GET["loc"];
$id = $_GET["id"];
$title = $_POST["title"];
$imagePath = $_POST["image"];
$text = $_POST["text"];
$username = $_SESSION["username"];
date_default_timezone_set("EST");
$timestamp = date("m-d-Y h:ia e");

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../createpost.php?loc=$loc");
	die();
}

//Sterilize Inputs
$title = $db->real_escape_string($title);
$imagePath = $db->real_escape_string($imagePath);
$text = $db->real_escape_string($text);
$username = $db->real_escape_string($username);
$timestamp = $db->real_escape_string($timestamp);
	
//News works differently from the others
if ($loc == "news") {
	$highlight = $_POST["highlight"];
	
	//Add new entry to database
	$query = "UPDATE postsnews SET title='$title', image='$imagePath', text='$text', lasteditor='$username', lastedittimestamp='$timestamp', highlight='$highlight' WHERE postid='$id'";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../createpost.php?loc=$loc");
		die();
	}
}
else {
	$dbloc = str_replace(' ', '', $loc);
	
	//Add new entry to database
	$query = "UPDATE posts$dbloc SET title='$title', image='$imagePath', text='$text', lasteditor='$username', lastedittimestamp='$timestamp' WHERE postid='$id'";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../createpost.php?loc=$loc");
		die();
	}
}

header("Location: ../$loc.php");
?>