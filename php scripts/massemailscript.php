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

//Obtain forum data
$subject = $_POST["subject"];
$text = $_POST["text"];

//Add unsubscribe text
$text .= "

To unsubscribe from these emails, just login at $_site_url and under your account, select Stop Recieving Emails.";

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../massemail.php");
	die();
}

//Get all users that want to recieve emails
$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.newsletter = 1";
$result = $db->query($query);
if (!$result) {
	$_SESSION["error"] = "An error occured when obtaining data to the database. Please try again.";
	header("Location: ../massemail.php");
	die();
}
$rows = $result->num_rows;
if ($rows < 1) {
	$_SESSION["message"] = "There are no users to send an email to.";
	header("Location: ../message.php");
	die();
}

//Create headers
$headers = array("From: eastmontelcsite@gmail.com",
    "Reply-To: eastmontelcsite@gmail.com",
    "X-Mailer: PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);

//Send email to all users who want to recieve emails
while ($row = $result->fetch_assoc()) {
	$to = $row["email"];
	//mail($to, $subject, $text, $headers);
}

//Set session message and navigate to message.php
$_SESSION["message"] = "Email has been sent successfully.";
header("Location: ../message.php");
?>