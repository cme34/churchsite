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
	<div id="wrapper">
		<?php session_start();?>
		
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
			
			<div class="containerGroup">
				<div>
					<div id="newsFeed" class="small-6 columns container">
						<h4 class="centerText">News Feed</h4>
						<h5>Highlighted News</h5>
						<ul>
							<li class="newsFeedText highlighted">Title</li>
							<li class="newsFeedText highlighted">Title</li>
							<li class="newsFeedText highlighted">Title</li>
						</ul>
						<h5>Recent News</h5>
						<ul>
							<li class="newsFeedText recentNews">Title</li>
							<li class="newsFeedText recentNews">Title</li>
							<li class="newsFeedText recentNews">Title</li>
							<li class="newsFeedText recentNews">Title</li>
							<li class="newsFeedText recentNews">Title</li>
						</ul>
					</div>
					<div id="weeklySchedule" class="small-6 columns container">
						<h4 class="centerText">Weekly Schedule</h4>
						<div class="floatleft">
							<ul>
								<li class="weeklyScheduleText">Sunday:</li>
								<li class="weeklyScheduleText">Monday:</li>
								<li class="weeklyScheduleText">Tuesday:</li>
								<li class="weeklyScheduleText">Wednesday:</li>
								<li class="weeklyScheduleText">Thursday:</li>
								<li class="weeklyScheduleText">Friday:</li>
								<li class="weeklyScheduleText">Saturday:</li>
							</ul>
						</div>
						<div class="floatleft">
							<ul>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
								<li class="weeklyScheduleText">Text</li>
							</ul>
						</div>
						<a href="weeklybulletin.php">
							<div class="centerText clear">[View Weekly Bulletin]</div>
						</a>
					</div>
				</div>
				<div class="container">
					<h4 class="centerText">About Emmanuel</h4>
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
	<script type="text/javascript">
		slideShow('slideShow1', 4000, 1000);
	</script>
</body>
</html>