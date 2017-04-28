<?php
function createNavigator() {
	echo "<div id='nav'>";
	echo "    <a href='home.php'><div class='button buttonNav left'>Home</div></a>";
	echo "    <a href='news.php'><div class='button buttonNav left'>News</div></a>";
	echo "    <a href='activities.php'><div class='button buttonNav left'>Activities</div></a>";
	echo "    <a href='churchyear.php'><div class='button buttonNav left'>Church Year</div></a>";
	echo "    <a href='youth.php'><div class='button buttonNav left'>Youth</div></a>";
	echo "    <a href='outreach.php'><div class='button buttonNav left'>Outreach</div></a>";
	echo "    <a href='directions.php'><div class='button buttonNav left'>Directions</div></a>";
	if (!isset($_SESSION["username"])) {
		echo "<a href='createaccount.php'><div class='button buttonNav right'>Create Account</div></a>";
		echo "<a href='login.php'><div class='button buttonNav right'>Login</div></a>";
	}
	else {
		echo "<div id='toolBoxButton' class='button buttonNav right'>Account</div>";
		echo "<div id='toolBox' class='border' hidden>";
		echo "    <a href='php scripts/logoutscript.php'><div class='button buttonToolbox'>Logout</div></a>";
		echo "    <a href='changeemail.php'><div class='button buttonToolbox'>Change Email</div></a>";
		echo "    <a href='changepassword.php'><div class='button buttonToolbox'>Change Password</div></a>";
		if ($_SESSION["admin"] == 2) {
			echo "<a href='massemail.php'><div class='button buttonToolbox'>Send Mass Email</div></a>";
			echo "<a href='manageadmins.php'><div class='button buttonToolbox'>Manage Admins</div></a>";
		}
		if ($_SESSION["newsletter"] == 0) {
			echo "<a href='php scripts/switchnewsletter.php'><div class='button buttonToolbox'>Start Receiving Newsletter</div></a>";
		}
		else {
			echo "<a href='php scripts/switchnewsletter.php'><div class='button buttonToolbox'>Stop Receiving Newsletter</div></a>";
		}
		echo "</div>";
	}
	echo "</div>";
}
?>