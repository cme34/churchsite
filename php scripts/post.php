<?php
class Post {
	private $title;
	private $imageLink;
	private $text;
	private $creator;
	private $creatorTimestamp;
	private $lastEditor;
	private $lastEditTimestamp;
	
	public function display($imageOnRight) {
		echo "	<div class='post'>";
		echo "		<h3 class='centerText'>$this->title</h3>";
		echo "		<div class='row'>";
		if ($imageOnRight == 1) {
			echo "		<img class='postImage right' src='$this->imageLink' alt='$this->imageLink' />";
		}
		else {
			echo "		<img class='postImage left' src='$this->imageLink' alt='$this->imageLink' />";
		}
		echo "			<p>$this->text</p>";
		echo "		</div>";
		if (isset($_SESSION["username"])) {
			if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
				echo "<div class='editBar postBar'>";
				echo "  <a class='barOption' href=''>[edit]</a>";
				echo "  <a class='barOption' href=''>[delete]</a>";
				echo "  <a class='barOption' href=''>[move up]</a>";
				echo "  <a class='barOption' href=''>[move down]</a>";
				echo "</div>";
			}
		}
		echo "	</div>";
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function setImageLink($imageLink) {
		$this->imageLink = $imageLink;
	}
	
	public function setText($text) {
		$this->text = $text;
	}
	
	public function setCreator($creator) {
		$this->creator = $creator;
	}
	
	public function setCreatorTimestamp($creatorTimestamp) {
		$this->creatorTimestamp = $creatorTimestamp;
	}
	
	public function setLastEditor($lastEditor) {
		$this->lastEditor = $lastEditor;
	}
	
	public function setLastEditTimestamp($lastEditTimestamp) {
		$this->lastEditTimestamp = $lastEditTimestamp;
	}
}
?>