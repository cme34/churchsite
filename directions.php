<?php session_start();?>

<!doctype html>
<html>
<head>
	<title>Directions</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText centerText">Directions</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<div id="map"></div>
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
	<script>
		//Map key: AIzaSyAXsHPPYcms1qs7ORGfhGSHHuuzQmP3AWM
		function initMap(){
			var point = new google.maps.LatLng(40.441999, -79.813);

			var map = new google.maps.Map(document.getElementById("map"), {
				center: point,
				zoom: 17,
			});
			
			var marker = new google.maps.Marker({
				position: point,
				map: map
			});
		}
	</script>
	<script async defer src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAXsHPPYcms1qs7ORGfhGSHHuuzQmP3AWM&callback=initMap"></script>
</body>