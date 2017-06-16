<?php
include "../../config/config.php";

session_start();

//Obtain form data
$email = $_POST["email"];	
$username = $_POST["username"];	
$password = $_POST["password"];	
$passwordConfirm = $_POST["passwordConfirm"];	
$newsletter;
$hash;

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

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["error"] = "Connection with database failed. Please try again later.";
	header("Location: ../createaccount.php");
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
	header("Location: ../createaccount.php");
	die();
}

//Hash password
$password = hash("sha512", $password);
$hash = md5(rand(0, 1000));
$hashesc = $db->real_escape_string($hash);

//Add new entry to database
$query = "INSERT INTO emmanuelaccountinfo (username, password, email, admin, newsletter, verified, hash) VALUES ('$username', '$password', '$email', 0, '$newsletter', 0, '$hashesc')";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../createaccount.php");
	die();
}

//Create Email
$username = $_POST["username"];	
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
$mail->addAddress($_POST["email"]);
$mail->Subject = "Emmanuel Lutheran Church - Email Verification";
$mail->Body = "Thank you for creating an account on our website please click the following link to verifiy your account. 
				http://$_site_url/php%20scripts/verify.php?username=$username&hash=$hash";

//Send Email
if(!$mail->send()) {
	$_SESSION["error"] = "An error occured when sending your verification email. Please try again.";
	header("Location: ../createaccount.php");
	die();
} 

//Set session message and navigate to message.php
$_SESSION["message"] = "You have created your account successfully. Before you can log in, please accept the verification email sent to your provided email address." . "$rtn";
header("Location: ../message.php");
?>