<?php
session_start();
?>

<!doctype html>
<html>
<head>
	<title>Privacy Policy</title>
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
	<?php include "php scripts/post.php";?>
	<?php include "../config/config.php"?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Privacy Policy</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<?php
					$text = "";
					$fp = @fopen("data/privacypolicy.txt", "r");
					if ($fp) {
						while(!feof($fp)) {
							$text .= fgets($fp);
						}
						fclose($fp);
					}
					else {
						echo "<p class='errorText'>Error loading the privacy policy. Please try again.</p>";
					}
					$text = convertText($text);
					echo "<p class='postText'>$text</p>";
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
</html>