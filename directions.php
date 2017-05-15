<?php
session_start();
?>

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
	<?php include "../config/config.php"?>
	
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText centerText">Directions</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<div class="small-8 columns noMargin noPadding">
						<div id="map"></div>
					</div>
					<div class="small-4 columns noMargin noPadding">
						<div id="address">
							<h5>Address:</h5>
							<ul>
								<li><?php echo "$_site_address_street";?></li>
								<li><?php echo "$_site_address_city";?></li>
							</ul>
							<h5>Phone:</h5>
							<ul>
								<li><?php echo "$_site_phone";?></li>
							</ul>
							<h5>Email:</h5>
							<ul>
								<li><?php echo "$_site_email";?></li>
							</ul>
							<a class="centerText" href='https://www.google.com/maps/place/Emmanuel+Lutheran+Church+of+Eastmont/@40.441999,-79.8151877,17z/data=!3m1!4b1!4m5!3m4!1s0x8834ebe94cd95457:0x1ad5d653dd6ce35b!8m2!3d40.441999!4d-79.812999'>
								<h5>Click here to go to Google Maps</h5>
							</a>
						</div>
					</div>
				</div>
				<div class="container">
					<div id="directionsContainer">
						<?php
						//Connect to database
						$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
						if ($db->connect_error) {
							echo "<p class='errorText'>Connection with database failed. Please try again later.</p>";
							die();
						}
						
						//Check if credentials are valid
						$query = "SELECT * FROM directions WHERE directions.id = 1";
						$result = $db->query($query);
						if ($db->query($query)) {
							$row = $result->fetch_assoc();
							if (isset($row["directions"])) { $directions = $row["directions"]; } else { $directions = ""; }
							$directions = convertText($directions);
							echo "<p class='postText'>$directions</p>";
						}
						else {
							echo "<p>An error has occured. Please try again later.</p>";
							echo "<a href='home.php'><div class='button inputButton'>Back to home page</div></a>";
						}
						
						if (isset($_SESSION["username"])) {
							if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
								echo "<div class='editBar directionsBar'>";
								echo "    <a class='barOption' href='editdirections.php'>[edit directions]</a>";
								echo "</div>";
							}
						}
						?>
					</div>
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
	<?php
	echo "<script async defer src = 'https://maps.googleapis.com/maps/api/js?key=$_map_key&callback=initMap'></script>";
	?>
</body>