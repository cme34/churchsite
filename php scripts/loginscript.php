<?php
session_start();

//Obtain form data
$username = $_POST["username"];
$password = $_POST["password"];
$username = rtrim($username);
$password = rtrim($password);

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["message"] = "Invalid login credentials";
	header("Location: ../login.php");
	die();
}

//Sterilize Inputs
$username = $db->real_escape_string($username);
$password = $db->real_escape_string($password);

//Hash password
$password = hash("sha256", $password);

//Check if credentials are valid
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username' AND emmanuelaccountinfo.password = '$password'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows < 1) {
	//Set error message and go to login page
	$_SESSION["message"] = "Invalid login credentials";
	header("Location: ../login.php");
	die();
}

//Get admin level
$row = $result->fetch_assoc();
$admin = $row["admin"];

//Set session data and go to home page
$_SESSION["username"] = $username;
$_SESSION["admin"] = $admin;
header("Location: ../home.php");
?>