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
</head>
<body>
	<?php
	session_start();
	createNavigator(); //Create the navigator at the top of the page. This is defined in navigator.php
	?>
	<div id="nav">
		<a href="home.php">
			<div class="button navButton">
				Home
			</div>
		</a>
		<a href="aboutus.php">
			<div class="button navButton">
				About Us
			</div>
		</a>
		<a href="news.php">
			<div class="button navButton">
				News
			</div>
		</a>
		<a href="popularactivities.php">
			<div class="button navButton">
				Popular Activities
			</div>
		</a>
		<a href="churchyear.php">
			<div class="button navButton">
				Church Year
			</div>
		</a>
		<a href="youth.php">
			<div class="button navButton">
				Youth
			</div>
		</a>
		<a href="outreach.php">
			<div class="button navButton">
				Outreach
			</div>
		</a>
		<a href="directions.php">
			<div class="button navButton">
				Directions
			</div>
		</a>
	</div>
	
	<div class="section">
		<div id="newsFeed" class="small-6 columns">
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
		<div id="weeklySchedule" class="small-6 columns">
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
	<div class="site-container">
		<div class="center">
			<a href="https://www.google.com/maps/place/Emmanuel+Lutheran+Church+of+Eastmont/@40.441999,-79.8151877,17z/data=!3m1!4b1!4m5!3m4!1s0x8834ebe94cd95457:0x1ad5d653dd6ce35b!8m2!3d40.441999!4d-79.812999">
				<img src="img/map.png" alt="Map" style="width:100%;height:auto;">
			</a>
		</div>
	</div>
	<div id="footer">
		<div class="floatleft">
			Worship</br>
			Contact</br>
			Address
		</div>
		<div class="floatright">
			<a href="https://www.facebook.com/emmanueleastmont/">
				<img src="img/facebook.jpeg" alt="Facebook" style="width:50%;height:50%;"></br>
			</a>
			Copyright © 2017
		</div>
	</div>
	<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
	
</body>
</html>