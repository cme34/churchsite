<?php
session_start();

include "../config/config.php";

$highlightLimit = 5;
$pageLimit = 20;

if (isset($_GET["page"])) {
	$page = $_GET["page"];
}
else {
	header("Location: news.php?page=1");
}

//Connect to database
$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
if ($db->connect_error) {
	echo "<p class='error-text'>Connection with database failed. Please try again later.</p>";
	die();
}

//Get count
$query = "SELECT COUNT(*) FROM postsnews";
$result = $db->query($query);
if (!$result) {
	echo "<p class='error-text'>Error obtaining news information. Please try again.</p>";
	die();
}
$count = $result->fetch_assoc()["COUNT(*)"];

//Determine news to display
$lastPage = ceil($count / $pageLimit);
if ($count == 0) {
		$lastPage = 1;
}
if ($page < 1 || $page > $lastPage || $page != floor($page)) {
	header("Location: news.php?page=1");
}
$firstPostOfPage = $pageLimit * ($page - 1);
?>

<!doctype html>
<html>
<head>
	<title>News - Emmanuel Lutheran Church Eastmont</title>
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
		<div class='content'>
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Highlighted News</p>
			</div>
			<div class="container">
				<div class='noHighlight'>
					<div class="small-4 columns noWrap overflowHidden strongText newsTitle">Title</div>
					<div class="small-4 columns noWrap overflowHidden strongText newsTime">Time Created</div>
					<div class="small-4 columns noWrap overflowHidden strongText newsTime">Time Last Edited</div>
				</div>
				<?php
				//Get top $highlightLimit highlighted news
				$query = "SELECT * FROM postsnews WHERE postsnews.highlight = '1' ORDER BY postid DESC LIMIT $highlightLimit";
				$result = $db->query($query);
				if (!$result) {
					echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
					die();
				}
				$highlightCount = $result->num_rows;
				
				if ($highlightCount > $highlightLimit) {
					$highlightCount = $highlightLimit;
				}
				
				//Display highlighted news
				for ($i = 0; $i < $highlightCount; $i++) {
					$row = $result->fetch_assoc();
					$postid = $row["postid"];
					$title = $row["title"];
					$creatortimestamp = $row["creatortimestamp"];
					$lastedittimestamp = $row["lastedittimestamp"];
					echo "<div class='highlight'>";
					echo "<a href='newsview.php?postid=$postid'><div class='small-4 columns newsTitle'>$title</div></a>";
					echo "<div class='small-4 columns noWrap overflowHidden newsTime'>[$creatortimestamp]</div>";
					echo "<div class='small-4 columns noWrap overflowHidden newsTime'>[$lastedittimestamp]</div>";
					echo "</div>";
				}
				?>
			</div>
			<div class="sectionTitleContainer">
				<p class="sectionTitle">News</p>
				<?php
					//Show addBar if signed in as admin
					if (isset($_SESSION["username"])) {
						if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
							echo "<div class='editBar addBar'>";
							echo "    <a class='barOption' href='createpost.php?loc=news'>[add new post]</a>";
							echo "</div>";
						}
					}
				?>
			</div>
			<div class="container">
				<div class='noHighlight'>
					<div class="small-4 columns noWrap overflowHidden strongText newsTitle">Title</div>
					<div class="small-4 columns noWrap overflowHidden strongText newsTime">Time Created</div>
					<div class="small-4 columns noWrap overflowHidden strongText newsTime">Time Last Edited</div>
				</div>
				<?php		
				//Get Posts to display
				$query = "SELECT * FROM postsnews ORDER BY postid DESC LIMIT $firstPostOfPage, $pageLimit";
				$result = $db->query($query);
				if (!$result) {
					echo "<p class='error-text'>Error obtaining thread information. Please try again.</p>";
					die();
				}
				
				while ($row = $result->fetch_assoc()) {
					$postid = $row["postid"];
					$title = $row["title"];
					$creatortimestamp = $row["creatortimestamp"];
					$lastedittimestamp = $row["lastedittimestamp"];
					$highlight = $row["highlight"];
					if ($highlight == 1) {
						echo "<div class='highlight'>";
					}
					else {
						echo "<div class='noHighlight'>";
					}
					echo "<a href='newsview.php?postid=$postid'><div class='small-4 columns newsTitle'>$title</div></a>";
					echo "<div class='small-4 columns noWrap overflowHidden newsTime'>[$creatortimestamp]</div>";
					echo "<div class='small-4 columns noWrap overflowHidden newsTime'>[$lastedittimestamp]</div>";
					echo "</div>";
				}
				?>
				<div class="newsPageNav">
					<?php
					//Generate First and Prev buttons
					if ($page == 1) {
						echo "[First]&emsp;";
						echo "[Prev]&emsp;";
					}
					else {
						$pageminus = $page - 1;
						echo "<a href='news.php?page=1'>[First]&emsp;</a>";
						echo "<a href='news.php?page=$pageminus'>[Prev]&emsp;</a>";
					}
					
					//Generate Number buttons - Display up to 9 direct page links
					if ($lastPage > 9) {
						//This is a little confusing, but it is to make the page navigator work with greater than 9 pages
						$shift = 0;
						if ($page - 4 > 0 && $page + 4 <= $lastPage) {
							$shift = 0;
						}
						else if ($page - 4 <= 0) {
							$shift = 0 - (($page - 4) - 1);
						}
						else if ($page + 4 > $lastPage) {
							$shift = $lastPage - ($page + 4);
						}
						for ($i = ($page - 4) + $shift; $i <= ($page + 4) + $shift; $i++) {
							if ($i == $page) {
								echo "$i&emsp;";
							}
							else {
								echo "<a href='news.php?page=$i'>$i&emsp;</a>";
							}
						}
					}
					else {
						for ($i = 1; $i < $lastPage + 1; $i++) {
							if ($i == $page) {
								echo "$i&emsp;";
							}
							else {
								echo "<a href='news.php?page=$i'>$i&emsp;</a>";
							}
						}
					}
					
					//Generate First and Prev buttons
					if ($page == $lastPage) {
						echo "[Next]&emsp;";
						echo "[Last]";
					}
					else {
						$pageplus = $page + 1;
						echo "<a href='news.php?page=$pageplus'>[Next]&emsp;</a>";
						echo "<a href='news.php?page=$lastPage'>[Last]</a>";
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
</body>
</html>