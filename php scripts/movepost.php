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

if (!isset($_GET['postid'])) {
	header("Location: $loc.php");
}
$postid = $_GET['postid'];

if (!(isset($_GET["direction"]))) {
	header("Location: $loc.php");
}
$direction = $_GET["direction"];

if ($direction != "up" && $direction != "down") {
	header("Location: $loc.php");
}

//Connect to database
$db = new mysqli("localhost", $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../message.php");
	die();
}

//Get db name
$dbloc = str_replace(" ", "", $loc);
$dbloc = "posts$dbloc";

//Get count
$query = "SELECT COUNT(*) As count FROM $dbloc";
$result = $db->query($query);
if (!$result) {
	$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../createpost.php?loc=$loc");
	die();
}
$count = mysqli_fetch_array($result);
$count = $count["count"];

//Get orderid
$query = "SELECT * FROM $dbloc WHERE $dbloc.postid = '$postid'";
$result = $db->query($query);
if ($result->num_rows < 1) {
	//Set error message and go to login page
	$_SESSION["message"] = "An error occured when reading data from the database. Please try again.";
	header("Location: ../message.php");
	die();
}
$row = $result->fetch_assoc();
$orderid = $row["orderid"];

if ($direction == "up") {
	if ($orderid == 1) {
		//Get orderid
		$query = "UPDATE $dbloc SET $dbloc.orderid=orderid-1 WHERE $dbloc.postid!='$postid'; UPDATE $dbloc SET $dbloc.orderid='$count' WHERE $dbloc.postid='$postid';";
		if (!$db->multi_query($query)) {
			$_SESSION["message"] = "An error occured when submitting data to the database. Please try again." . mysqli_error($db);
			header("Location: ../message.php");
			die();
		}
	}
	else {
		$orderid2 = $orderid - 1;
		
		//Get post to swap with
		$query = "SELECT * FROM $dbloc WHERE $dbloc.orderid = '$orderid2'";
		$result = $db->query($query);
		if ($result->num_rows < 1) {
			//Set error message and go to login page
			$_SESSION["message"] = "An error occured when reading data from the database. Please try again.";
			header("Location: ../message.php");
			die();
		}
		$row = $result->fetch_assoc();
		$postid2 = $row["postid"];
		
		//Get orderid
		$query = "UPDATE $dbloc SET $dbloc.orderid='$orderid' WHERE $dbloc.postid='$postid2'; UPDATE $dbloc SET $dbloc.orderid='$orderid2' WHERE $dbloc.postid='$postid';";
		if (!$db->multi_query($query)) {
			$_SESSION["message"] = "An error occured when submitting data to the database. Please try again." . mysqli_error($db);
			header("Location: ../message.php");
			die();
		}
	}
}
else if ($direction == "down") {
	if ($orderid == $count) {
		//Get orderid
		$query = "UPDATE $dbloc SET $dbloc.orderid=orderid+1 WHERE $dbloc.postid!='$postid'; UPDATE $dbloc SET $dbloc.orderid='1' WHERE $dbloc.postid='$postid';";
		if (!$db->multi_query($query)) {
			$_SESSION["message"] = "An error occured when submitting data to the database. Please try again." . mysqli_error($db);
			header("Location: ../message.php");
			die();
		}
	}
	else {
		$orderid2 = $orderid + 1;
		
		//Get post to swap with
		$query = "SELECT * FROM $dbloc WHERE $dbloc.orderid = '$orderid2'";
		$result = $db->query($query);
		if ($result->num_rows < 1) {
			//Set error message and go to login page
			$_SESSION["message"] = "An error occured when reading data from the database. Please try again.";
			header("Location: ../message.php");
			die();
		}
		$row = $result->fetch_assoc();
		$postid2 = $row["postid"];
		
		//Get orderid
		$query = "UPDATE $dbloc SET $dbloc.orderid='$orderid' WHERE $dbloc.postid='$postid2'; UPDATE $dbloc SET $dbloc.orderid='$orderid2' WHERE $dbloc.postid='$postid';";
		if (!$db->multi_query($query)) {
			$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
			header("Location: ../message.php");
			die();
		}
	}
}

$_SESSION["message"] = "Post moved successfully";
header("Location: ../message.php");
?>