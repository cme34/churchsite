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
	<title>Create Post</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText  centerText">Create Post</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<?php
					$loc = $_GET["loc"];
					echo "<form class='inputForm' Action='php scripts/createpostscript.php?loc=$loc' Method='POST' enctype='multipart/form-data'>";
					?>
						Title: <input class="inputTextFeild" id="title" name="title" type="text"></input>
						<br/>
						Image: <input class="inputFileFeild" id="image" name="image" type="file" accept=".png, .jpg, gif, .bmp"></input>
						<p>Only .png, .jpg, .gif and .bmp files supported</p>
						Text: <textarea class="inputTextFeild" id="text" name="text" type="text" rows=12></textarea>
						<br/>
						<?php
						$loc = $_GET["loc"];
						if ($loc == "news") {
							echo "<input class='inputCheckbox' type='checkbox' id='highlight' name='highlight'><span>Highlight Post</span><br/>";
						}
						?>
						<div class="small-6 columns"><button class="button inputButton yes">Submit</button></div>
						<div class="small-6 columns"><a href="home.php"><div class="button inputButton no">Cancel</div></a></div>
						<?php
							if (isset($_SESSION["error"])) {
								$err = $_SESSION["error"];
								unset($_SESSION["error"]);
								echo "<p class='errorText'>$err<br/></p>";
							}
						?>
					</form>
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