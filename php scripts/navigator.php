<?php
function createNavigator() {
	echo "<div id='nav'>";
	echo "    <div id='navPages' hidden>";
	echo "        <a href='home.php'><div class='button buttonNav left'>Home</div></a>";
	echo "        <a href='news.php'><div class='button buttonNav left'>News</div></a>";
	echo "        <a href='activities.php'><div class='button buttonNav left'>Activities</div></a>";
	echo "        <a href='churchyear.php'><div class='button buttonNav left'>Church Year</div></a>";
	echo "        <a href='youth.php'><div class='button buttonNav left'>Youth</div></a>";
	echo "        <a href='outreach.php'><div class='button buttonNav left'>Outreach</div></a>";
	echo "        <a href='directions.php'><div class='button buttonNav left'>Directions</div></a>";
	echo "    </div>";
	echo "    <div id='navPagesMobile' hidden>";
	echo "	  	  <div id='toolBoxMobileButton' class='button buttonNav left'>Pages</div>";
	echo "    </div>";
	if (isset($_SESSION["username"])) {
		echo "<div id='toolBoxButton' class='button buttonNav right'>Account</div>";
		echo "<div id='toolBox' class='border' hidden>";
		echo "    <a href='php scripts/logoutscript.php'><div class='button buttonToolbox'>Logout</div></a>";
		echo "    <a href='changeemail.php'><div class='button buttonToolbox'>Change Email</div></a>";
		echo "    <a href='changepassword.php'><div class='button buttonToolbox'>Change Password</div></a>";
		if ($_SESSION["admin"] == 2) {
			echo "<a href='manageadmins.php'><div class='button buttonToolbox'>Manage Admins</div></a>";
		}
		echo "</div>";
	}
	echo "    <div id='toolBoxMobile' hidden>";
	echo "    	  <a href='home.php'><div class='button buttonToolbox'>Home</div></a>";
	echo "    	  <a href='news.php'><div class='button buttonToolbox'>News</div></a>";
	echo "    	  <a href='activities.php'><div class='button buttonToolbox'>Activities</div></a>";
	echo "    	  <a href='churchyear.php'><div class='button buttonToolbox'>Church Year</div></a>";
	echo "    	  <a href='youth.php'><div class='button buttonToolbox'>Youth</div></a>";
	echo "    	  <a href='outreach.php'><div class='button buttonToolbox'>Outreach</div></a>";
	echo " 		  <a href='directions.php'><div class='button buttonToolbox'>Directions</div></a>";
	echo "	  </div>";
	echo "</div>";
	if (!isset($_SESSION["username"])) {
		echo "<a id='loginLink' href='login.php'>Admin Login</a>";
	}
}
?>