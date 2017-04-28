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
	<title>Edit Weekly Schedule</title>
	<meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/foundation.css" />
	<link rel='stylesheet' media='screen and (max-width: 800px)' href='css/mobile.css' />
	<link rel='stylesheet' media='screen and (min-width: 801px)' href='css/app.css' />
	<?php include 'php scripts/navigator.php';?>
	<?php include 'php scripts/footer.php';?>
	<?php include 'php scripts/textprocessor.php';?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<h2 class="strongText  centerText">Edit Weekly Schedule</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/editschedulescript.php" Method="POST">
						Sunday: <input class="inputTextFeild" id="sunday" name="sunday" type="text"></input></br>
						Monday: <input class="inputTextFeild" id="monday" name="monday" type="text"></input></br>
						Tuesday: <input class="inputTextFeild" id="tuesday" name="tuesday" type="text"></input></br>
						Wednesday: <input class="inputTextFeild" id="wednesday" name="wednesday" type="text"></input></br>
						Thursday: <input class="inputTextFeild" id="thursday" name="thursday" type="text"></input></br>
						Friday: <input class="inputTextFeild" id="friday" name="friday" type="text"></input></br>
						Saturday: <input class="inputTextFeild" id="saturday" name="saturday" type="text"></input></br>
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
	<script type="text/javascript">
		(function()	{
			var rawFile = new XMLHttpRequest();
			rawFile.open("GET", 'data/weeklyschedule.txt', false);
			rawFile.onreadystatechange = function ()
			{
				if(rawFile.readyState === 4)
				{
					if(rawFile.status === 200 || rawFile.status == 0)
					{
						var text = rawFile.responseText.split(/\r\n|\n/);
						$('#sunday').val(text[0]);
						$('#monday').val(text[1]);
						$('#tuesday').val(text[2]);
						$('#wednesday').val(text[3]);
						$('#thursday').val(text[4]);
						$('#friday').val(text[5]);
						$('#saturday').val(text[6]);
					}
				}
			}
			rawFile.send(null);
		})();
	</script>
</body>
</html>