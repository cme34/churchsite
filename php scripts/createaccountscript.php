<?php
include "../../config/config.php";

session_start();

//Obtain link data
$linkEmail = $_GET["email"];
$linkHash = $_GET['hash'];

$linkEmail = rtrim($linkEmail);
$linkHash = rtrim($linkHash);

//Obtain form data
$email = $_POST["email"];	
$username = $_POST["username"];	
$password = $_POST["password"];	
$passwordConfirm = $_POST["passwordConfirm"];	

$email = rtrim($email);
$username = rtrim($username);
$password = rtrim($password);
$passwordConfirm = rtrim($passwordConfirm);

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../createaccount.php?email=$linkEmail&hash=$linkHash");
	die();
}

//Sterilize Inputs
$username = $db->real_escape_string($username);
$password = $db->real_escape_string($password);
$email = $db->real_escape_string($email);

//Check if username is taken
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows > 0) {
	$_SESSION["error"] = "That username is already in use. Please choose a different one.";
	header("Location: ../createaccount.php?email=$linkEmail&hash=$linkHash");
	die();
}

//Hash password
$password = hash("sha512", $password);

//Add new entry to database
$query = "INSERT INTO emmanuelaccountinfo (username, password, email, admin) VALUES ('$username', '$password', '$email', 1)";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../createaccount.php?email=$linkEmail&hash=$linkHash");
	die();
}

//Remove from pending
$query = "DELETE FROM emmanuelpendinginfo WHERE email = '$email'";
if (!$db->query($query)) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../manageadmins.php");
	die();
}

//Set session message and navigate to message.php
$_SESSION["message"] = "You have created your account successfully. Before you can log in, please accept the verification email sent to your provided email address." . "$rtn";
header("Location: ../message.php");
?>