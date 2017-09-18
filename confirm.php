<?php
session_start();

//If the user is not signed in, prevent them from accessing this page
if (!isset($_SESSION["username"])) {
	header("Location: home.php");
}

//If the user is not an admin, prevent them from accessing this page
if (!($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2)) {
	header("Location: home.php");
}

//If info is not set, prevent them from accessing this page
if (!(isset($_GET["loc"]))) {
	header("Location: home.php");
}
$loc = $_GET["loc"];

if (!(isset($_GET["action"]))) {
	header("Location: $loc.php");
}
$action = $_GET["action"];

if ($action != "delete" && $action != "removeImage") {
	header("Location: $loc.php");
}

if (!isset($_GET['postid'])) {
	header("Location: $loc.php");
}
$postid = $_GET["postid"];
?>

<!doctype html>
<html>
<head>
	<title>Emmanuel Lutheran Church Eastmont Confirm</title>
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
</head>
<body>
	<div id="wrapper">
		<div class="content small">
			<div class="container">
				<?php		
				if ($action == "delete") {
					$msg = "Are you sure you want to delete this post?";
					$yes = "php scripts/deletepost.php?loc=$loc&postid=$postid";
					$no = "$loc.php";
				}
				else if ($action == "removeImage") {
					$msg = "Are you sure you want to remove the image from this post? Another image can easily be assigned to the post later by editing it.";
					$yes = "php scripts/removeimagepost.php?loc=$loc&postid=$postid";
					$no = "$loc.php";
				}
				else {
					$msg = "Oops. Something went wrong.";
					$yes = "home.php";
					$no = "home.php";
				}
				echo "<p class='centerText'>$msg</p>";
				echo "<div class='small-6 columns'><a href='$yes'><div class='button inputButton yes'>Yes</div></a></div>";
				echo "<div class='small-6 columns'><a href='$no'><div class='button inputButton no'>No</div></a></div>";
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