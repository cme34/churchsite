<?php
function createFooter() {
	include "../config/config.php";
	echo "<div id='footerbuffer'></div>";
	echo "<div id='footer'>";
	echo "    <div class='small-4 columns'>";
	echo "        <div class='floatLeft'>";
	echo "            <h6>Worship Time:</h6>";
	echo "            <ul class='noWrap'>";
	echo "                <li>Sunday: 10:00am - 11:15am</li>";
	echo "                <li>Second Tuesday of the Month: 6:30pm - 7:15pm</li>";
	echo "            </ul>";
	echo "            <h6>Address: </h6>";
	echo "            <ul class='noWrap'>";
	echo "                <li>$_site_address_street</li>";
	echo "                <li>$_site_address_city</li>";
	echo "            </ul>";
	echo "            <h6>Contact:</h6>";
	echo "            <ul class='noWrap'>";
	echo "                <li>Phone: $_site_phone</li>";
	echo "                <li>Email: $_site_email</li>";
	echo "            </ul>";
	echo "        </div>";
	echo "    </div>";
	echo "    <div class='small-5 columns'>";
	echo "        <div id='footerImageContainer'>";
	echo "            <a href='https://www.google.com/maps/place/Emmanuel+Lutheran+Church+of+Eastmont/@40.441999,-79.8151877,17z/data=!3m1!4b1!4m5!3m4!1s0x8834ebe94cd95457:0x1ad5d653dd6ce35b!8m2!3d40.441999!4d-79.812999'>";
	echo "                <img id='footerImage' src='img/map.png' alt='Map'>";
	echo "            </a>";
	echo "        </div>";
	echo "		  <p id='footerMapText'>(Click the image to go to google maps)</p>";
	echo "    </div>";
	echo "    <div class='small-3 columns'>";
	echo "        <div class='floatRight clear'>";
	echo "            <a href='https://www.facebook.com/emmanueleastmont/'><img src='img/facebook.png' alt='Facebook'></a>";
	echo "        </div>";
	echo "        <div class='footerText right'>";
	echo "            <div class='floatRight clear'>Lead Site Developer:</div>";
	echo "            <div class='floatRight clear'>Cory Estock</div>";
	echo "            <div class='floatRight clear'>&nbsp;</div>";
	echo "            <div class='floatRight clear'>Assistant Developer:</div>";
	echo "            <div class='floatRight clear'>Brian Estock</div>";
	echo "            <div class='floatRight clear'>&nbsp;</div>";
	echo "            <div class='floatRight clear'>Copyright © 2017</div>";
	echo "        </div>";
	echo "    </div>";
	echo "</div>";
}
?>