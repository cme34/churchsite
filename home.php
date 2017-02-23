<!doctype html>
<html>
<head>
	<title>Home</title>
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
	<?php session_start(); ?>
	
	<div class="content">
		<div id="slideShow1Frame">
			<div id="slideShow1" class="slideShow">
				<div id="slideShow1slide1" class="slide" hidden>
					<img class="slideImage" src="img/Image 1.png" />
				</div>
				<div id="slideShow1slide2" class="slide" hidden>
					<img class="slideImage" src="img/Image 2.png" />
				</div>
				<div id="slideShow1slide3" class="slide" hidden>
					<img class="slideImage" src="img/Image 3.png" />
				</div>
			</div>
		</div>
		
		<div class="section">
			<div id="newsFeed" class="small-6 columns border">
				<div class="center"><h4>News Feed</h4></div>
				<h5>Highlighted News</h5>
				<ul>
					<li>
						Title 1
					</li>
					<li>
						Title 2
					</li>
				</ul>
				<h5>Recent News</h5>
				<ul>
					<li>
						Title 1
					</li>
					<li>
						Title 2
					</li>
					<li>
						Title 3
					</li>
				</ul>
			</div>
			<div id="weeklySchedule" class="small-6 columns border">
				<div class="center"><h4>Weekly Schedule</h4></div>
				<ul>
					<li>
						Sunday Text
					</li>
					<li>
						Monday Text
					</li>
					<li>
						Tuesday Text
					</li>
					<li>
						Wednesday Text
					</li>
					<li>
						Thursday Text
					</li>
					<li>
						Friday Text
					</li>
					<li>
						Saturday Text
					</li>
				</ul>
			<a href="weeklybulletin.php">
				<div class="center">[View Weekly Bulletin]</div>
			</a>
			</div>
		</div>
	</div>
	
	<?php
	createFooter();    //Create the footer at the bottom of the page. This is defined in footer.php
	createNavigator(); //Create the navigator at the top of the page. This is defined in navigator.php
	?>
	
	<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
	<script type="text/javascript">
		slideShow('slideShow1', 4000, 1000);
	</script>
</body>
</html>