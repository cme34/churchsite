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
$image = $_FILES["image"];
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
$text = $db->real_escape_string($text);
$username = $db->real_escape_string($username);
$timestamp = $db->real_escape_string($timestamp);
	
//News works differently from the others
if ($loc == "news") {
	$highlight = $_POST["highlight"];
	
	$imagePath = "";
	if ($_FILES['image']['tmp_name'] != "") {
		//Process image
		$query = "SHOW TABLE STATUS LIKE 'postsnews'";
		$result = $db->query($query);
		if (!$result) {
			$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
			header("Location: ../createpost.php?loc=$loc");
			die();
		}
		$nextid = mysqli_fetch_array($result);
		$nextid = $nextid["Auto_increment"];

		$imagePath = "img/upload/postsnews$nextid.png";
		$imagePath = $db->real_escape_string($imagePath);
		if (move_uploaded_file($_FILES['image']['tmp_name'], "../$imagePath")) {
			
		}
		else {
			$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
			header("Location: ../createpost.php?loc=$loc");
			die();
		}
	}
	
	if ($highlight == "on") {
		$highlight = 1;
	}
	else {
		$highlight = 0;
	}
	//Add new entry to database
	$query = "INSERT INTO postsnews (title, image, text, creator, creatortimestamp, lasteditor, lastedittimestamp, highlight) VALUES ('$title', '$imagePath', '$text', '$username', '$timestamp', '$username', '$timestamp', '$highlight')";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../createpost.php?loc=$loc");
		die();
	}
}
else {
	$dbloc = str_replace(' ', '', $loc);
	$dbloc = "posts$dbloc";
	
	$imagePath = "";
	if ($_FILES['image']['tmp_name'] != "") {
		//Process image
		$query = "SHOW TABLE STATUS LIKE '$dbloc'";
		$result = $db->query($query);
		if (!$result) {
			$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
			header("Location: ../createpost.php?loc=$loc");
			die();
		}
		$nextid = mysqli_fetch_array($result);
		$nextid = $nextid["Auto_increment"];

		$imagePath = "img/upload/$dbloc" . "$nextid.png";
		if (move_uploaded_file($_FILES['image']['tmp_name'], "../$imagePath")) {
			echo "File is valid, and was successfully uploaded.\n";
		}
		else {
			$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
			header("Location: ../createpost.php?loc=$loc");
			die();
		}
	}
	
	//Find orderid
	$query = "SELECT COUNT(*) As count FROM $dbloc";
	$result = $db->query($query);
	if (!$result) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../createpost.php?loc=$loc");
		die();
	}
	$orderid = mysqli_fetch_array($result);
	$orderid = $orderid["count"];
	$orderid++;
	
	//Add new entry to database
	$query = "INSERT INTO $dbloc (orderid, title, image, text, creator, creatortimestamp, lasteditor, lastedittimestamp) VALUES ('$orderid', '$title', '$imagePath', '$text', '$username', '$timestamp', '$username', '$timestamp')";
	if (!$db->query($query)) {
		$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
		header("Location: ../createpost.php?loc=$loc");
		die();
	}
}

header("Location: ../$loc.php");
?>