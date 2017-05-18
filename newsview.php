<?php
session_start();

if (!isset($_GET["postid"])) {
	header("Location: news.php?page=1");
}
$id = $_GET["postid"];
?>

<!doctype html>
<html>
<head>
	<title>Home</title>
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
			<?php
			//Connect to database
			$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
			if ($db->connect_error) {
				echo "<p class='error-text'>Connection with database failed. Please try again later.</p>";
				die();
			}
			
			$postid = $_GET['postid'];
			$query = "SELECT * FROM postsnews WHERE postsnews.postid = '$postid'";
			$result = $db->query($query);
			if (!$result) {
				echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
				die();
			}
			$row = $result->fetch_assoc();
			if (!empty($row)) {
				$title = $row["title"];
				$image = $row["image"];
				$text = convertText($row["text"]);
				$creator = $row["creator"];
				$creatortimestamp = $row["creatortimestamp"];
				$lasteditor = $row["lasteditor"];
				$lastedittimestamp = $row["lastedittimestamp"];
				$highlight = $row["highlight"];
				echo "<h3 class='strongText centerText'>$title</h3>";
				echo "<div class='container'>";
				echo "	<div class='row postRow'>";
				echo "		<img class='postImage right' src='$image' alt='$image' />";
				echo "		<p class='postText'>$text</p>";
				echo "	</div>";
				if (isset($_SESSION["username"])) {
					if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
						echo "<div class='editBar postBar'>";
						echo "  <a class='barOption' href='editpost.php?loc=news&id=$id'>[edit]</a>";
						echo "  <a class='barOption' href='confirm.php?loc=news&action=delete&postid=$id'>[delete]</a>";
						echo "  <a class='barOption' href='confirm.php?loc=news&action=removeImage&postid=$id'>[remove image]</a>";
						echo "</div>";
					}
				}
				echo "</div>";
			}
			else {
				echo "This post does not exists.";
			}
			?>
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