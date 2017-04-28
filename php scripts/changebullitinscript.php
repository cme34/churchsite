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

//
$file = "../data/bulletin.docx";
if (!move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
	$_SESSION['message'] = "Error uploading bulletin.";
	header("Location: ../message.php");
}

$_SESSION['message'] = "Bulletin uploaded successfully.";
header("Location: ../message.php");
?>