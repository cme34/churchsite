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
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<h1>Edit Weekly Schedule</h1>
			<div class="containerGroup">
				<div class="container">
					<form Action="php scripts/editschedulescript.php" Method="POST">
						Sunday: <input class="textFeild" id="sunday" name="sunday" type="text"></input></br>
						Monday: <input class="textFeild" id="monday" name="monday" type="text"></input></br>
						Tuesday: <input class="textFeild" id="tuesday" name="tuesday" type="text"></input></br>
						Wednesday: <input class="textFeild" id="wednesday" name="wednesday" type="text"></input></br>
						Thursday: <input class="textFeild" id="thursday" name="thursday" type="text"></input></br>
						Friday: <input class="textFeild" id="friday" name="friday" type="text"></input></br>
						Saturday: <input class="textFeild" id="saturday" name="saturday" type="text"></input></br>
						<button class="medium success button" id="buttonLogin">Submit</button>
						<a href="home.php"><div class="medium secondary button" id="buttonCreateaccountCancel">Cancel</div></a>
						<?php
							if (isset($_SESSION["error"])) {
								$err = $_SESSION["error"];
								unset($_SESSION["error"]);
								echo "<p class='error-text'>$err</br></p>";
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