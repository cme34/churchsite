<?php
session_start();

//If the user is not signed in, prevent them from accessing this page
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
	<link rel="stylesheet" media="screen and (max-width: 800px)" href="css/mobile.css" />
	<link rel="stylesheet" media="screen and (min-width: 801px) and (max-width: 1250px)" href="css/medium.css" />
	<link rel="stylesheet" media="screen and (min-width: 1251px)" href="css/app.css" />
	<?php include "php scripts/navigator.php";?>
	<?php include "php scripts/footer.php";?>
	<?php include "php scripts/textprocessor.php";?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Change Email</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/changeemailscript.php" Method="POST">
						Old Email: <input class="inputTextFeild" id="oldemail" name="oldemail" type="text" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						New Email: <input class="inputTextFeild" id="newemail" name="newemail" type="text" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						Password: <input class="inputTextFeild" id="password" name="password" type="password" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
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
		$('form').on('submit', function() {
			var oldemail = $('#oldemail').val();
			var newemail = $('#newemail').val();
			var password = $('#password').val();
			
			//Is any feild empty
			if (!oldemail || !newemail || !password) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Feilds must be filled.<br/></p>');
				return false;
			}
		});
	</script>
</body>
</html>