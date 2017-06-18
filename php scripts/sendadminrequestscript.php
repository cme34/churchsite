<?php
include "../../config/config.php";

session_start();

//If the user is not a master, prevent them from accessing this page
if (!($_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

//Obtain form data
$email = $_POST["email"];
$email = rtrim($email);

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../manageadmins.php");
	die();
}

//Sterilize Inputs
$emailesc = $db->real_escape_string($email);

//Check if email exists
$query = "SELECT * FROM emmanuelpendinginfo WHERE emmanuelpendinginfo.email = '$emailesc'";
$result = $db->query($query);
$rows = $result->num_rows;
if ($rows > 0) {
	$_SESSION["message"] = "Email $email is already pending.";
	header("Location: ../manageadmins.php");
	die();
}

//Create hash
$hash = md5(rand(0, 1000));
$hashesc = $db->real_escape_string($hash);

//Create email
require '../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'localhost';
$mail->port = 25;
$mail->SMTPAuth = false;
$mail->SMTPSecure = false;
$mail->SetFrom('noreply@emmanuellutheraneastmont.org');
$mail->IsHTML(true);
$mail->SMTPOptions = array(
		'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->addAddress($email);
$mail->Subject = "Emmanuel Lutheran Church - Email Verification";
$mail->Body = "You have been requested to be an admin for $_site_url.  
				<a href='http://$_site_url/createaccount.php?email=$email&hash=$hash'>Click here</a> 
				to create an account.";

//Send Email
if(!$mail->send()) {
	$_SESSION["message"] = "An error occured when sending your verification email. Please try again.";
	header("Location: ../manageadmins.php");
	die();
} 

//Submit
$query = "INSERT INTO emmanuelpendinginfo (email, hash) VALUES ('$emailesc', '$hashesc')";
if (!$db->query($query)) {
	$_SESSION["message"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../manageadmins.php");
	die();
}

//Set session message and redirect
$email = $_POST["email"];	
$email = rtrim($email);
$_SESSION["message"] = "A create account request was sent to $email.";
header("Location: ../manageadmins.php");
?>