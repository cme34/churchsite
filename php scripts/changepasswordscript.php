<?php
include "../../config/config.php";

session_start();

//Obtain form data
$oldpassword = $_POST["oldpassword"];	
$password = $_POST["newpassword"];	
$passwordConfirm = $_POST["passwordconfirm"];	

$oldpassword = rtrim($oldpassword);
$password = rtrim($password);
$passwordConfirm = rtrim($passwordConfirm);

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../changepassword.php");
	die();
}

//Sterilize Inputs
$username = $_SESSION["username"];
$username = $db->real_escape_string($username);
$oldpassword = $db->real_escape_string($oldpassword);
$password = $db->real_escape_string($password);

//Hash passwords
$oldpassword = hash("sha512", $oldpassword);
$password = hash("sha512", $password);

//Check if oldpassword matches
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.password = '$oldpassword'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows < 1) {
	//Set error message and go to login page
	$_SESSION["error"] = "Old password is incorrect.";
	header("Location: ../changepassword.php");
	die();
}

//Change password in database
$query = "UPDATE emmanuelaccountinfo SET password='$password' WHERE username='$username'";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when changing password. Please try again.";
	header("Location: ../changepassword.php");
	die();
}

$_SESSION["message"] = "You have changed your password successfully.";
header("Location: ../message.php");
?>