<?php
class Post {
	private $loc;
	private $id;
	private $title;
	private $imageLink;
	private $text;
	private $creator;
	private $creatorTimestamp;
	private $lastEditor;
	private $lastEditTimestamp;
	
	public function display($imageOnRight) {
		echo "	<div class='post'>";
		echo "		<h3 class='strongText centerText'>$this->title</h3>";
		echo "		<div class='row postRow'>";
		if ($imageOnRight == 1) {
			echo "		<img class='postImage right' src='$this->imageLink' alt='$this->imageLink' />";
		}
		else {
			echo "		<img class='postImage left' src='$this->imageLink' alt='$this->imageLink' />";
		}
		$text = convertText($this->text);
		echo "			<p class='postText'>$text</p>";
		echo "		</div>";
		if (isset($_SESSION["username"])) {
			if ($_SESSION["admin"] == 1 || $_SESSION["admin"] == 2) {
				echo "<div class='editBar postBar'>";
				echo "  <a class='barOption' href='editpost.php?loc=$this->loc&id=$this->id'>[edit]</a>";
				echo "  <a class='barOption' href='confirm.php?loc=$this->loc&action=delete&postid=$this->id'>[delete]</a>";
				echo "  <a class='barOption' href='confirm.php?loc=$this->loc&action=removeImage&postid=$this->id'>[remove image]</a>";
				echo "  <a class='barOption' href='php scripts/movepost.php?loc=$this->loc&direction=up&postid=$this->id'>[move up]</a>";
				echo "  <a class='barOption' href='php scripts/movepost.php?loc=$this->loc&direction=down&postid=$this->id'>[move down]</a>";
				echo "</div>";
			}
		}
		echo "	</div>";
	}
	
	public function setLoc($loc) {
		$this->loc = $loc;
	}
	
	public function setId($id) {
		$this->id = $id;
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