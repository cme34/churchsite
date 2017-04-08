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
	<?php include 'php scripts/post.php';?>
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
				<div style="height: 384px; background-color: #a33030;">
					<div id="newsFeed" class="small-6 columns container">
						<h4 class="strongText centerText">News Feed</h4>
						<?php
						$highlightLimit = 3;
						$recentLimit = 5;
						//Connect to database
						$db = new mysqli('localhost', 'root', '', 'emmanuel');
						if ($db->connect_error) {
							echo "<p class='error-text'>Connection with database failed. Please try again later.</p>";
							die();
						}
						
						//Get top $highlightLimit highlighted news
						$query = "SELECT * FROM postsnews WHERE postsnews.highlight = '1' ORDER BY postid DESC LIMIT $highlightLimit";
						$result = $db->query($query);
						if (!$result) {
							echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
							die();
						}
						$highlightCount = $result->num_rows;
						
						//Display Highlighted News
						echo "<h5 class='strongText'>Highlighted News</h5>";
						echo "<table class='newsFeedTable'>";
						for ($i = 0; $i < $highlightCount; $i++) {
							$row = $result->fetch_assoc();
							$postid = $row["postid"];
							$title = $row["title"];
							$creatortimestamp = $row["creatortimestamp"];
							echo "<tr>";
							echo "<th class='newsFeedCell date'>[$creatortimestamp]</th>";
							echo "<th class='newsFeedCell title'><a href='newsview.php?postid=$postid'>$title</a></th>";
							echo "</tr>";
						}
						for ($i = $highlightCount; $i < $highlightLimit; $i++) {
							echo "<tr>";
							echo "<th class='newsFeedCell date'>------------------------------------</th>";
							echo "<th class='newsFeedCell title'>------------------------------------------------------------------------</th>";
							echo "</tr>";
						}
						echo "</table>";
						
						//Get top $recentLimit recent news
						$query = "SELECT * FROM postsnews ORDER BY postid DESC LIMIT $recentLimit";
						$result = $db->query($query);
						if (!$result) {
							echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
							die();
						}
						$recentCount = $result->num_rows;
						
						//Display Recent News
						echo "<h5 class='strongText'>Recent News</h5>";
						echo "<table class='newsFeedTable'>";
						for ($i = 0; $i < $recentCount; $i++) {
							$row = $result->fetch_assoc();
							$postid = $row["postid"];
							$title = $row["title"];
							$creatortimestamp = $row["creatortimestamp"];
							echo "<tr>";
							echo "<th class='newsFeedCell date'>[$creatortimestamp]</th>";
							echo "<th class='newsFeedCell title'><a href='newsview.php?postid=$postid'>$title</a></th>";
							echo "</tr>";
						}
						for ($i = $recentCount; $i < $recentLimit; $i++) {
							echo "<tr>";
							echo "<th class='newsFeedCell date'>------------------------------------</th>";
							echo "<th class='newsFeedCell title'>------------------------------------------------------------------------</th>";
							echo "</tr>";
						}
						echo "</table>";
						?>
					</div>
					<div id="weeklySchedule" class="small-6 columns container">
						<h4 class='strongText centerText'>Weekly Schedule</h4>
						<?php 
						$day = date('w');
						$week_start = date('m-d-Y', strtotime('-'.$day.' days'));
						echo "<p class='weeklyScheduleText strongText centerText'>For the week of Sunday $week_start</p>";
						?>
						<div>
							<div class="inline-block noPadding">
								<ul>
									<li class="weeklyScheduleText strongText">Sunday:</li>
									<li class="weeklyScheduleText strongText">Monday:</li>
									<li class="weeklyScheduleText strongText">Tuesday:</li>
									<li class="weeklyScheduleText strongText">Wednesday:</li>
									<li class="weeklyScheduleText strongText">Thursday:</li>
									<li class="weeklyScheduleText strongText">Friday:</li>
									<li class="weeklyScheduleText strongText">Saturday:</li>
								</ul>
							</div>
							<div class="inline-block noPadding">
								<ul>
									<?php
									$file = "data/weeklyschedule.txt";
									$handle = fopen($file, "r");
									$schedule = array();							
									while (!feof($handle)) {
										$schedule[] = fgets($handle);
									}
									fclose($handle);
									echo "<li class='weeklyScheduleText'>$schedule[0]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[1]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[2]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[3]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[4]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[5]</li>";
									echo "<li class='weeklyScheduleText'>$schedule[6]</li>";
									?>
								</ul>
							</div>
						</div>
						<div class="centerText clear"><a href="weeklybulletin.php">[View Weekly Bulletin]</a></div>
						<?php
						if (isset($_SESSION["username"])) {
							if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
								echo "<div class='editBar scheduleBar'>";
								echo "    <a class='barOption' href='editschedule.php'>[change weekly bulletin]</a>";
								echo "</div>";
							}
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="sectionTitleContainer">
				<h2 class="strongText centerText">About Emmanuel</h2>
				<?php
					//Show addBar if signed in as admin
					if (isset($_SESSION["username"])) {
						if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
							echo "<div class='editBar addBar'>";
							echo "    <a class='barOption' href='createpost.php?loc=home'>[add new post]</a>";
							echo "</div>";
						}
					}
				?>
			</div>
			<div class="containerGroup">
				<div class="container">
					<?php					
					//Connect to database
					$db = new mysqli('localhost', 'root', '', 'emmanuel');
					if ($db->connect_error) {
						echo "<p class='error-text'>Connection with database failed. Please try again later.</p>";
						die();
					}
					
					//Get all posts
					$query = "SELECT * FROM postshome ORDER BY orderid";
					$result = $db->query($query);
					if (!$result) {
						echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
						die();
					}
					
					//Display Posts
					$imageOnRight = 0;
					while ($row = $result->fetch_assoc()) {
						$post = new Post();
						$post->setLoc("home");
						$post->setId($row["postid"]);
						$post->setTitle($row["title"]);
						$post->setImageLink($row["image"]);
						$post->setText($row["text"]);
						$post->setCreator($row["creator"]);
						$post->setCreatorTimestamp($row["creatortimestamp"]);
						$post->setLastEditor($row["lasteditor"]);
						$post->setLastEditTimestamp($row["lastedittimestamp"]);
						//Causes image to alternate sides every post
						if ($imageOnRight == 0) {
							$imageOnRight = 1;
						}
						else {
							$imageOnRight = 0;
						}
						$post->display($imageOnRight);
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
	<script type="text/javascript">
		slideShow('slideShow1', 4000, 1000);
	</script>
</body>
</html>