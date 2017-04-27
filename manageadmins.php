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
	<title>Manage Admins</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel='stylesheet' media='screen and (max-width: 800px)' href='css/mobile.css' />
	<link rel='stylesheet' media='screen and (min-width: 801px)' href='css/app.css' />
	<?php include 'php scripts/navigator.php';?>
	<?php include 'php scripts/footer.php';?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText centerText">Manage Admins</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/addnewadminscript.php" Method="POST" enctype="multipart/form-data">
						<div>Enter the username of a new admin here:</div>
						<input class="inputBox" id="username" name="username" type="text"></input>
						<button class="inputButton yes" type="text">Submit New Admin</button>
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
					$db = new mysqli('localhost', 'root', '', 'emmanuel');
					if ($db->connect_error) {
						echo "<p class='errorText'>Error loading admins</p>";
					}
					else
					{
						//Check if credentials are valid
						$query = "SELECT * FROM emmanuelaccountinfo WHERE emmanuelaccountinfo.admin = 1";
						$result = $db->query($query);
						$rows = $result->num_rows;
						if ($rows < 1) {
							echo "<p class='centerText'>No admins found</p>";
						}
						
						while ($row = $result->fetch_assoc()) {
							$username = $row["username"];
							echo "<div class='maxWidth'>";
							echo "	<div class='adminName'>$username</div>";
							echo "	<div class='adminRemoveLink'><a href='php scripts/removeadminscript.php?username=$username'>Remove Admin</a></div>";
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