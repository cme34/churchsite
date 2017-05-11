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
	<title>Change Password</title>
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
				<h2 class="strongText  centerText">Change Password</h4>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/changepasswordscript.php" Method="POST">
						Old Password: <input class="inputTextFeild" id="oldpassword" name="oldpassword" type="password" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						New Password: <input class="inputTextFeild" id="newpassword" name="newpassword" type="password" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						Confirm Password: <input class="inputTextFeild" id="passwordconfirm" name="passwordconfirm" type="password" maxlength=512></input>
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
			var oldpassword = $('#oldpassword').val();
			var password = $('#newpassword').val();
			var passwordConfirm = $('#passwordconfirm').val();
			
			//Is any feild empty
			if (!oldpassword || !password || !passwordConfirm) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Feilds must be filled.<br/></p>');
				return false;
			}
			//Does password equal passwordConfirm
			else if (password != passwordConfirm) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Password does not match confirm password.<br/></p>');
				return false;
			}
			//Is password too short
			else if (password.length < 8) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Password is too short. Must be at least 8 characters long.<br/></p>');
				return false;
			}
			//Does password fulfill all requirments
			var contains_upper = 0;
			var contains_lower = 0;
			var contains_number = 0;
			var contains_symbol = 0;
			for (var i = 0; i < password.length; i++) {
				//Contians upper case
				if (password.charCodeAt(i) > 64 && password.charCodeAt(i) < 91) {
					contains_upper = 1;
				}
				//Contains lower case
				else if (password.charCodeAt(i) > 96 && password.charCodeAt(i) < 123) {
					contains_lower = 1;
				}
				//Contains number
				else if (password.charCodeAt(i) > 47 && password.charCodeAt(i) < 58) {
					contains_number = 1;
				}
				//Contains symbol
				else if (password.charCodeAt(i) > 32 && password.charCodeAt(i) < 48) {
					contains_symbol = 1;
				}
				else if (password.charCodeAt(i) > 57 && password.charCodeAt(i) < 65) {
					contains_symbol = 1;
				}
				else if (password.charCodeAt(i) > 90 && password.charCodeAt(i) < 97) {
					contains_symbol = 1;
				}
				else if (password.charCodeAt(i) > 122 && password.charCodeAt(i) < 127) {
					contains_symbol = 1;
				}
			}
			var fulfills = contains_upper + contains_lower + contains_number + contains_symbol;
			if (fulfills < 3) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Password is too weak. Make sure it contains 3 of the following: ' + 
					'an upper case letter, lower case letter, number and symbol.<br/></p>');
				return false;
			}
		});
	</script>
</body>
</html>