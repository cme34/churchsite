<?php
function convertText($text) {
	$tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	$text = $tab . $text;
	$text = str_replace("\n", "\n\t", $text);
	$text = str_replace("\n", "<br />", $text);
	$text = str_replace("\t", $tab, $text);
	return $text;
}
?>