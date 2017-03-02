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
$title = $_POST["title"];
$imagePath = $_POST["image"];
$text = $_POST["text"];
date_default_timezone_set("EST");
$timestamp = date("m-d-Y h:ia e");

//Process image
$imageType = "";
$image = "";
$imageType = exif_imagetype($imagePath);
if ($imageType == IMAGETYPE_JPEG) {
	$image = imagecreatefromjpeg($imagePath);
}
else if ($imageType == IMAGETYPE_PNG) {
	$image = imagecreatefrompng($imagePath);
}
else if ($imageType == IMAGETYPE_GIF) {
	$image = imagecreatefromgif($imagePath);
}
else {
	$_SESSION["error"] = "Image is not a valid format or the path is incorrect.";
	header("Location: ../post.php?loc=$loc");
	die();
}

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../post.php?loc=$loc");
	die();
}

//Sterilize Inputs
$title = mysql_real_escape_string($title);
$imagePath = mysql_real_escape_string($imagePath);
$text = mysql_real_escape_string($text);

//News works differently from the others
if ($loc == "news") {
	//Add new entry to database
	$query = "INSERT INTO postsnews (title, image, text, creator, creatortimestamp, lasteditor, lastedittimestamp) VALUES ('$title', '$imagePath', '$text', '$username', '$timestamp', '$username', '$timestamp')";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../post.php?loc=$loc");
		die();
	}
}
else {
	$dbloc = str_replace(' ', '', $loc);
	$orderid = 0;
	
	//Find orderid
	$query = "SELECT COUNT(*) FROM posts$dbloc";
	$result = $db->query($query);
	if (!$result) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../views/threadcreate.php?forum=$forum");
		die();
	}
	else {
		$orderid = $result;
	}
	$orderid++;
	
	//Add new entry to database
	$query = "INSERT INTO posts$dbloc (orderid, title, image, text, creator, creatortimestamp, lasteditor, lastedittimestamp) VALUES ($orderid, '$title', '$imagePath', '$text', '$username', '$timestamp', '$username', '$timestamp')";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../post.php?loc=$loc");
		die();
	}
}

header("Location: ../$loc.php");
?>