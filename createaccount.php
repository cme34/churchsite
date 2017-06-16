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
	<title>Create Account</title>
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
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Create Account</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<form class="inputForm" Action="php scripts/createaccountscript.php" Method="POST">
						Username: <input class="inputTextFeild" id="username" name="username" type="text" maxlength=64></input>
						<p class="inputCharacterLimitText">Character Limit: 64</p>
						<br/>
						Email: <input class="inputTextFeild" id="email" name="email" type="text" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						Password: <input class="inputTextFeild" id="password" name="password" type="password" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						Confirm Password: <input class="inputTextFeild" id="passwordConfirm" name="passwordConfirm" type="password" maxlength=512></input>
						<p class="inputCharacterLimitText">Character Limit: 512</p>
						<br/>
						<input class="inputCheckbox" type="checkbox" id="newsletter" name="newsletter" checked><span>I would like to recieve emails from Emmanuel about church related news and events.</span>
						<br/>
						<input class="inputCheckbox" type="checkbox" id="terms" name="terms"><span>By creating an account, you hereby accept the <a href="privacypolicy.php"  target="_blank">Privacy Policy</a> and <a href="termsofuse.php"  target="_blank">Terms of Use</a>.</span>
						<br/>
						<div class="small-6 columns"><button class="button inputButton yes">Create Account</button></div>
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
			var email = $('#email').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var passwordConfirm = $('#passwordConfirm').val();
			var terms = document.getElementById('terms').checked;
			
			//Is terms selected
			if (!terms) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">You must accept to the privacy policy and terms of use.<br/></p>');
				return false;
			}
			//Is any feild empty
			else if (!email || !username || !password || !passwordConfirm) {
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
			//Is username too short
			else if (username.length < 8) {
				$('.errorText').remove();
				$('form').append('<p class="errorText">Username is too short. Must be at least 8 characters long.<br/></p>');
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
