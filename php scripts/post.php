<?php
class Post {
	private $title;
	private $imageLink;
	private $text;
	private $creator;
	private $creatorTimestamp;
	private $lastEditor;
	private $lastEditTimestamp;
	
	public function display() {
		echo "	<div>";
		echo "		<p>$this->text</p>";
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