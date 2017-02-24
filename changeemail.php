<?php
//If the user is not signed in, prevent them from accessing this page
session_start();
if (!isset($_SESSION["username"])) {
	header("Location: home.php");
}
?>

<!doctype html>
<html>
<head>
	<title>Change Email</title>
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
			<h1>Change Email</h1>
			<div class="containerGroup">
				<div class="container">
					<form Action="php scripts/changeemailscript.php" Method="POST">
						Old Email: <input class="textFeild" id="oldemail" name="oldemail" type="text" maxlength=256></input>
						<p class="characterLimitText">Character Limit: 256</p>
						New Email: <input class="textFeild" id="newemail" name="newemail" type="text" maxlength=256></input>
						<p class="characterLimitText">Character Limit: 256</p>
						Password: <input class="textFeild" id="password" name="password" type="password" maxlength=256></input>
						<p class="characterLimitText">Character Limit: 256</p>
						</br>
						<button class="medium success button" id="buttonCreateaccountSubmit">Change Email</button>
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
		$('form').on('submit', function() {
			var oldemail = $('#oldemail').val();
			var newemail = $('#newemail').val();
			var password = $('#password').val();
			
			//Is any feild empty
			if (!oldemail || !newemail || !password) {
				$('.error-text').remove();
				$('form').append('<p class="error-text">Feilds must be filled.</br></p>');
				return false;
			}
		});
	</script>
</body>
</html>