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

//Obtain form data
$sunday = $_POST["sunday"];
$monday = $_POST["monday"];
$tuesday = $_POST["tuesday"];
$wednesday = $_POST["wednesday"];
$thursday = $_POST["thursday"];
$friday = $_POST["friday"];
$saturday = $_POST["saturday"];

//Write to file
$file = "../data/home/weeklyschedule.txt";
$handle = fopen($file, "w");
fwrite($handle, "$sunday\r\n");
fwrite($handle, "$monday\r\n");
fwrite($handle, "$tuesday\r\n");
fwrite($handle, "$wednesday\r\n");
fwrite($handle, "$thursday\r\n");
fwrite($handle, "$friday\r\n");
fwrite($handle, "$saturday\r\n");
fclose($handle);

header("Location: ../home.php");
?>