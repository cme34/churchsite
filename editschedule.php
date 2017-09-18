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
	<title>Emmanuel Lutheran Church Eastmont Edit Weekly Schedule</title>
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
	<?php include "../config/config.php"?>
</head>
<body>
	<div id="wrapper">
		<div class="content">
			<div class="sectionTitleContainer">
				<p class="sectionTitle">Edit Weekly Schedule</p>
			</div>
			<div class="containerGroup">
				<div class="container">
					<?php
					//Connect to database
					$db = new mysqli($_db_host, $_db_username, $_db_password, "emmanuel");
					if ($db->connect_error) {
						echo "<p class='errorText'>Connection with database failed. Please try again later.</p>";
						die();
					}
					
					//Check if credentials are valid
					$query = "SELECT * FROM schedule WHERE schedule.id = 1";
					$result = $db->query($query);
					if ($db->query($query)) {
						if (isset($row["sunday"])) { $sunday = $row["sunday"]; } else { $sunday = ""; }
						if (isset($row["monday"])) { $monday = $row["monday"]; } else { $monday = ""; }
						if (isset($row["tuesday"])) { $tuesday = $row["tuesday"]; } else { $tuesday = ""; }
						if (isset($row["wednesday"])) { $wednesday = $row["wednesday"]; } else { $wednesday = ""; }
						if (isset($row["thursday"])) { $thursday = $row["thursday"]; } else { $thursday = ""; }
						if (isset($row["friday"])) { $friday = $row["friday"]; } else { $friday = ""; }
						if (isset($row["saturday"])) { $saturday = $row["saturday"]; } else { $saturday = ""; }
						
						if ($result->num_rows == 1) {
							$row = $result->fetch_assoc();
							$sunday = $row["sunday"];
							$monday = $row["monday"];
							$tuesday = $row["tuesday"];
							$wednesday = $row["wednesday"];
							$thursday = $row["thursday"];
							$friday = $row["friday"];
							$saturday = $row["saturday"];
						}
						else {
							$sunday = "";
							$monday = "";
							$tuesday = "";
							$wednesday = "";
							$thursday = "";
							$friday = "";
							$saturday = "";
						}
						echo "<form class='inputForm' Action='php scripts/editschedulescript.php' Method='POST'>";
						echo "	Sunday: <input class='inputTextFeild' id='sunday' name='sunday' type='text'></input></br>";
						echo "	Monday: <input class='inputTextFeild' id='monday' name='monday' type='text'></input></br>";
						echo "	Tuesday: <input class='inputTextFeild' id='tuesday' name='tuesday' type='text'></input></br>";
						echo "	Wednesday: <input class='inputTextFeild' id='wednesday' name='wednesday' type='text'></input></br>";
						echo "	Thursday: <input class='inputTextFeild' id='thursday' name='thursday' type='text'></input></br>";
						echo "	Friday: <input class='inputTextFeild' id='friday' name='friday' type='text'></input></br>";
						echo "	Saturday: <input class='inputTextFeild' id='saturday' name='saturday' type='text'></input></br>";
						echo "	<div class='small-6 columns'><button class='button inputButton yes'>Submit</button></div>";
						echo "	<div class='small-6 columns'><a href='home.php'><div class='button inputButton no'>Cancel</div></a></div>";
						if (isset($_SESSION["error"])) {
							$err = $_SESSION["error"];
							unset($_SESSION["error"]);
							echo "<p class='errorText'>$err<br/></p>";
						}
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
				var sunday = <?php echo json_encode($sunday); ?>;
				var monday = <?php echo json_encode($monday); ?>;
				var tuesday = <?php echo json_encode($tuesday); ?>;
				var wednesday = <?php echo json_encode($wednesday); ?>;
				var thursday = <?php echo json_encode($thursday); ?>;
				var friday = <?php echo json_encode($friday); ?>;
				var saturday = <?php echo json_encode($saturday); ?>;
				$('#sunday').val(sunday);
				$('#monday').val(monday);
				$('#tuesday').val(tuesday);
				$('#wednesday').val(wednesday);
				$('#thursday').val(thursday);
				$('#friday').val(friday);
				$('#saturday').val(saturday);
			});
		})();
	</script>
</body>
</html>