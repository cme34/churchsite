<?php
session_start();

//If the user is signed in, prevent them from accessing this page
if (isset($_SESSION["username"])) {
	header("Location: home.php");
}
?>

<!doctype html>
<html>
<head>
	<title>Login - Emmanuel Lutheran Church Eastmont</title>
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
		<div class="content small">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Login</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/loginscript.php" Method="POST">
						Username: <input class="inputTextFeild" id="username" name="username" type="text" maxlength=64></input>
						<br/>
						Password: <input class="inputTextFeild" id="password" name="password" type="password" maxlength=256></input>
						<br/>
						<button class="button inputButton yes">Login</button>
						<?php
							if (isset($_SESSION["error"])) {
								$err = $_SESSION["error"];
								unset($_SESSION["error"]);
								echo "<p class='errorText'>$err</br></p>";
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
			if (!$('#username').val() || !$('#password').val()) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Feilds must be filled.<br/></p>');
				return false;
			}
		});
	</script>
</body>
</html>