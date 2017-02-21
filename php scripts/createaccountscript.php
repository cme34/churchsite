<?php
session_start();

//Obtain form data
$email = $_POST["email"];	
$username = $_POST["username"];	
$password = $_POST["password"];	
$passwordConfirm = $_POST["passwordConfirm"];	
$newsletter;
$admin;

$email = rtrim($email);
$username = rtrim($username);
$password = rtrim($password);
$passwordConfirm = rtrim($passwordConfirm);

if (isset($_POST["newsletter"])) {
	$newsletter = 1;
}
else {
	$newsletter = 0;
}

if (isset($_POST["admin"])) {
	$admin = 1;
}
else {
	$admin = 0;
}

//Connect to database
$db = new mysqli('localhost', 'root', '', 'emmanuel');
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../createaccount.php");
	die();
}

//Sterilize Inputs
$username = mysqli_real_escape_string($username);
$password = mysqli_real_escape_string($password);
$email = mysqli_real_escape_string($email);

//Check if username is taken
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.username = '$username'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows > 0) {
	$_SESSION["error"] = "That username is already in use. Please choose a different one.";
	header("Location: ../createaccount.php");
	die();
}

//Hash password
$password = hash("sha256", $password);

//Add new entry to database
$query = "INSERT INTO emmanuelaccountinfo (username, password, email, admin, newsletter, verified) VALUES ('$username', '$password', '$email', 0, '$newsletter', 0)";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../createaccount.php");
	die();
}

header("Location: ../home.php");

?>