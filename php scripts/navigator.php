<?php
function createNavigator() {
	echo "<div id='nav'>";
	echo "    <a href='home.php'><div class='button buttonNav left'>Home</div></a>";
	echo "    <a href='aboutus.php'><div class='button buttonNav left'>About Us</div></a>";
	echo "    <a href='news.php'><div class='button buttonNav left'>News</div></a>";
	echo "    <a href='popularactivities.php'><div class='button buttonNav left'>Popular Activities</div></a>";
	echo "    <a href='churchyear.php'><div class='button buttonNav left'>Church Year</div></a>";
	echo "    <a href='youth.php'><div class='button buttonNav left'>Youth</div></a>";
	echo "    <a href='outreach.php'><div class='button buttonNav left'>Outreach</div></a>";
	echo "    <a href='directions.php'><div class='button buttonNav left'>Directions</div></a>";
	echo "    <a href='createaccount.php'><div class='button buttonNav right'>Create Account</div></a>";
	echo "    <div id='buttonLogin' class='button buttonNav right'>Login</div>";
	echo "</div>";
	echo "<div id='loginBox' class='border' hidden>";
	echo "    <form Action='php scripts/loginScript.php' Method='POST'>";
	echo "        <div class='loginBoxRow'>";
	echo "            <div class='loginBoxText'>Username:</div>";
	echo "            <input id='username' class='textFeild login' name='username' type='text' maxlength=64></input>";
	echo "        </div>";
	echo "        <div class='loginBoxRow'>";
	echo "            <div class='loginBoxText'>Password:</div>";
	echo "            <input id='password' class='textFeild login' name='password' type='password' maxlength=256></input>";
	echo "        </div>";
	echo "        <button id='buttonLoginBox' class='success button'>Login</button>";
	echo "    </form>";
	echo "</div>";
}
?>