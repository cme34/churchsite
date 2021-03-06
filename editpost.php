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
?>

<!doctype html>
<html>
<head>
	<title>Edit Post - Emmanuel Lutheran Church Eastmont</title>
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
	<?php include "../config/config.php"?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Edit Post</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<?php
					$loc = $_GET["loc"];
					$id = $_GET["id"];
					
					//Connect to database
					$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
					if ($db->connect_error) {
						echo "<p class='errorText'>Connection with database failed. Please try again later.</p>";
						die();
					}
					
					//Check if credentials are valid
					$dbloc = str_replace(' ', '', $loc);
					$query = "SELECT * FROM posts$dbloc WHERE posts$dbloc.postid = '$id'";
					$result = $db->query($query);
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc();
						$title = $row["title"];
						$image = $row["image"];
						$text = $row["text"];
						$highlight = 0;
						echo "<form class='inputForm' Action='php scripts/editpostscript.php?loc=$loc&id=$id' Method='POST' enctype='multipart/form-data'>";
						echo "	Title: <input class='inputTextFeild' id='title' name='title' type='text'></input><br/>";
						echo "  Image: <input class='inputFileFeild' id='image' name='image' type='file' accept='.png, .jpg, gif, .bmp'></input>";
						echo "  <p>Only .png, .jpg, .gif and .bmp files supported</p>";
						echo "	Text: <textarea class='inputTextFeild' id='text' name='text' type='text' rows=12></textarea><br/>";
						if ($loc == "news") {
							$highlight = $row["highlight"];
							echo "<input type='checkbox' id='highlight' name='highlight'><span>Highlight Post</span><br/>";
						}
						echo "	<div class='small-6 columns'><button class='button inputButton yes'>Submit</button></div>";
						echo "	<div class='small-6 columns'><a href='home.php'><div class='button inputButton no'>Cancel</div></a></div>";
						if (isset($_SESSION["error"])) {
							$err = $_SESSION["error"];
							unset($_SESSION["error"]);
							echo "<p class='errorText'>$err<br/></p>";
						}
						echo "</form>";
					}
					else {
						echo "<p>An error has occured. Please try again later.</p>";
						echo "<a href='home.php'><div class='button inputButton'>Back to home page</div></a>";
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
		(function()	{
			$(document).on('ready', function() {
				var loc = <?php echo json_encode($loc); ?>;
				var title = <?php echo json_encode($title); ?>;
				var text = <?php echo json_encode($text); ?>;
				if (loc == "news") {
					var highlight = <?php echo $highlight; ?>;
					if (highlight == 1) {
						$('#highlight').prop('checked', true);
					}
				}
				$('#title').val(title);
				$('#text').val(text);
			});
		})();
	</script>
</body>
</html>