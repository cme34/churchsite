<?php
session_start();
?>

<!doctype html>
<html>
<head>
	<title>Privacy Policy - Emmanuel Lutheran Church Eastmont</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="This is the website for Emmanuel Lutheran Church located in Eastmont Township.">
	<meta name="keywords" content="Emmanuel, Lutheran, Church, Eastmont">
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px) and (max-width: 1250px)" href="css/medium.css" />
	<link rel="stylesheet" media="screen and (min-width: 1251px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
</head>
<body>
	<div id="wrapper">
		<div class="content small">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Privacy Policy</p>
			</div>
			<div class="container">
				<?php
					$f = fopen("data/privacypolicy.txt", "r");
					if ($f) {
						while(!feof($f)) {
							$txt = fgets($f);
							if (substr($txt, 1, 2) == ".") {
							echo "<div class='policyText'>$txt</div>";
							}
							else {
								echo "<div class='policyText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$txt</div>";
							}
						}
						fclose($f);
					}
					else {
						echo "Error displaying Privacy Policy. Please try again later.";
					}
				?>
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