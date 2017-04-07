<?php
//If message is not set in session, then navigate to home.php 
session_start();
if (!isset($_SESSION["message"])) {
	header("Location: home.php");
}
?>

<!doctype html>
<html>
<head>
	<title>Message</title>
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
		<?php
		//Get variable from SESSION
		$message = $_SESSION["message"];
		unset($_SESSION["message"]);
		
		echo "<div class='content'>";
		echo "    <p class='success-text'>$message</p>";
		echo "    <a href='home.php'><div class='medium success button'>Back to home page</div></a>";
		echo '</div>';
		
		createFooter();    //Create the footer at the bottom of the page. This is defined in footer.php
		createNavigator(); //Create the navigator at the top of the page. This is defined in navigator.php
		?>
	</div>
	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</body>
</html>