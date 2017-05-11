<!doctype html>
<html>
<head>
	<title>Youth</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
	<?php include "php scripts/post.php";?>
	<?php include "../config/config.php"?>
</head>
<body>
	<div id="wrapper">
		<?php session_start();?>
		
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText centerText">Youth</h2>
				<?php
					//Show addBar if signed in as admin
					if (isset($_SESSION["username"])) {
						if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
							echo "<div class='editBar addBar'>";
							echo "    <a class='barOption' href='createpost.php?loc=youth'>[add new post]</a>";
							echo "</div>";
						}
					}
				?>
			</div>
			<div class="container">
				<?php	
				//Connect to database
				$db = new mysqli("localhost", $_db_username, $_db_password, "emmanuel");
				if ($db->connect_error) {
					echo "<p class='error-text'>Connection with database failed. Please try again later.</p>";
					die();
				}
				
				//Get all posts
				$query = "SELECT * FROM postsyouth ORDER BY orderid";
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