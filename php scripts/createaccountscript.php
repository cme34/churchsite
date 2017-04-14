<?php
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
$db = new mysqli('localhost', 'root', '', 'emmanuel');
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
$password = hash("sha256", $password);
$hash = md5(rand(0, 1000));
$hashesc = $db->real_escape_string($hash);

//Add new entry to database
$query = "INSERT INTO emmanuelaccountinfo (username, password, email, admin, newsletter, verified, hash) VALUES ('$username', '$password', '$email', 0, '$newsletter', 0, '$hashesc')";
if (!$db->query($query)) {
	$_SESSION["error"] = "An error occured when submitting data to the database. Please try again.";
	header("Location: ../createaccount.php");
	die();
}

//Send verification email
$email = $_POST["email"];	
$username = $_POST["username"];	
$to = $email;
$subject = "Emmanuel Lutheran Church - Email Verification";
$txt = "Thank you for creating an account on our website please click the following link to verifiy your account. 
http://localhost/churchsite/php%20scripts/verify.php?username=$username&hash=$hash";
$headers = array("From: ",
    "Reply-To: ",
    "X-Mailer: PHP/" . PHP_VERSION
);
$headers = implode("\r\n", $headers);
//mail($to, $subject, $txt,$headers);

//Set session message and navigate to message.php
$_SESSION["message"] = "You have created your account successfully. Before you can log in, please accept the verification email sent to your provided email address.";
header("Location: ../message.php");
?>