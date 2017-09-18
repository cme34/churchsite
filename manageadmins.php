<?php
session_start();

//If the user is not signed in, prevent them from accessing this page
if (!isset($_SESSION["username"])) {
	header("Location: home.php");
}

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 2)) {
	header("Location: home.php");
}
?>

<!doctype html>
<html>
<head>
	<title>Emmanuel Lutheran Church Eastmont Manage Admins</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px) and (max-width: 1250px)" href="css/medium.css" />
	<link rel="stylesheet" media="screen and (min-width: 1251px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
	<?php include "../config/config.php"?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Manage Admins</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/sendadminrequestscript.php" Method="POST" enctype="multipart/form-data">
						<div>Enter the email of a person you would like to be an admin here. The person will then recieve an email to create an account.</div>
						<input class="inputBox" id="email" name="email" type="text"></input>
						<button class="inputButton yes" type="text">Send Create Account Email</button>
						<br />
						<?php
						if (isset($_SESSION["message"])) {
							$msg = $_SESSION["message"];
							echo "<div class='centerText'>$msg</div>";	
							unset($_SESSION["message"]);
						}
						?>
						<br />
					</form>
				</div>
				<br />
				<div class="container">
					<div class="maxWidth"><h3 class="strongText centerText">List of Admins</h3></div>
					<?php
					//Connect to database
					$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
					if ($db->connect_error) {
						echo "<p class='errorText'>Error loading admins</p>";
					}
					else
					{
						//Get admins
						$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.admin = 1 OR emmanuelaccountinfo.admin = 2";
						$result = $db->query($query);
						$rows = $result->num_rows;
						if ($rows < 1) {
							echo "<p class='centerText'>No admins found</p>";
						}
						
						while ($row = $result->fetch_assoc()) {
							$username = $row["username"];
							$admin = $row["admin"];
							echo "<div class='maxWidth clear'>";
							if ($admin == 1) {
								echo "	<div class='adminName'>$username</div>";
								echo "	<div class='adminRemoveLink'><a href='php scripts/removeadminscript.php?username=$username'>Remove Admin</a></div>";
							}
							else {
								if ($_SESSION["username"] == $username) {
									echo "	<div class='adminName'>$username [You]</div>";
								}
								else {
									echo "	<div class='adminName'>$username [Master Level Account]</div>";
								}
							}
							echo "</div>";
						}
					}
					?>
				</div>
				</br>
				<div class="container">
					<div class="maxWidth"><h3 class="strongText centerText">List of Pending Admins</h3></div>
					<?php
					//Connect to database
					$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
					if ($db->connect_error) {
						echo "<p class='errorText'>Error loading admins</p>";
					}
					else
					{
						//Check if credentials are valid
						$query = "SELECT * FROM emmanuelpendinginfo";
						$result = $db->query($query);
						$rows = $result->num_rows;
						if ($rows < 1) {
							echo "<p class='centerText clear'>No pending admins found</p>";
						}
						
						while ($row = $result->fetch_assoc()) {
							$email = $row["email"];
							echo "<div class='maxWidth'>";
							echo "	<div class='adminName'>$email</div>";
							echo "	<div class='adminRemoveLink'><a href='php scripts/removeadminrequestscript.php?email=$email'>Remove Pending Request</a></div>";
							echo "</div>";
						}
					}
					?>
				</div>
			</div>
		</div>
		
		<?php
		createFooter();    //Create the footer at the bottom of the page. This is defined in footer.php
		createNavigator(); //Create the navigator at the top of the page. This is defined in navigator.php
		?>
	</div>
	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</body>