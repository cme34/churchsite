<?php
include "../../config/config.php";

session_start();

//Connect to database
$db = new mysqli("localhost", $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	$_SESSION["message"] = "Connection with database failed. Please try again later.";
	header("Location: ../message.php");
}
$msg = "Connection to database successful.<br />";

//Check if emmanuelaccountinfo table exists, if it doesn't then create it
$table = "emmanuelaccountinfo";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( username VARCHAR(64) NOT NULL , password VARCHAR(512) NOT NULL , email VARCHAR(512) NOT NULL , admin INT NOT NULL , newsletter TINYINT(1) NOT NULL , verified TINYINT(1) NOT NULL , hash VARCHAR(32) NOT NULL , PRIMARY KEY (username)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postsnews table exists, if it doesn't then create it
$table = "postsnews";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , highlight TINYINT(1) NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postshome table exists, if it doesn't then create it
$table = "postshome";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , orderid INT NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postsactivities table exists, if it doesn't then create it
$table = "postsactivities";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , orderid INT NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postschurchyear table exists, if it doesn't then create it
$table = "postschurchyear";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , orderid INT NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postsyouth table exists, if it doesn't then create it
$table = "postsyouth";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , orderid INT NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Check if postsoutreach table exists, if it doesn't then create it
$table = "postsoutreach";
$query = "SELECT 1 FROM $table LIMIT 1";
$result = $db->query($query);
if (!$result) {
	$query = "CREATE TABLE emmanuel.$table ( postid INT NOT NULL AUTO_INCREMENT , title VARCHAR(64) NOT NULL , image VARCHAR(2048) NOT NULL , text VARCHAR(8192) NOT NULL , creator VARCHAR(64) NOT NULL , creatortimestamp VARCHAR(64) NOT NULL , lasteditor VARCHAR(64) NOT NULL , lastedittimestamp VARCHAR(64) NOT NULL , orderid INT NOT NULL , PRIMARY KEY (postid)) ENGINE = InnoDB;";
	$result = $db->query($query);
	if (!$result) {
		$msg .= "Error creating table $table.<br />";
	}
	else {
		$msg .= "Table $table created successfully.<br />";
	}
}
else {
	$msg .= "Table $table already exists.<br />";
}

//Set session message and navigate to message.php
$_SESSION["message"] = $msg;
header("Location: ../message.php");
?>