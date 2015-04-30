<?php

include_once("../src/autoload_manager.php");

class Article {
	private $title = "";
	private $authors = array("");
	private $publishYear = 0;
	private $abstract = "";
	private $pubTitle = "";
	private $articleNumber = 0;
	private $pubNumber = 0;
	private $pdfLink = "";

	// returns a string of the title
	// return null if the string is empty
	public function getTitle() {
		return $this->title;
	}

	// returns an array of author names as strings
	public function getAuthors() {
		return $this->authors;
	}

	// returns a string of publish date
	// should return "unknown" if the date is empty
	// return null if no date
	public function getPublishYear() {
		return $this->publishYear;
	}

	// returns a string of excerpt
	// return null if no excerpt
	public function getAbstract() {
		return $this->abstract;
	}

	// return a string of conference
	// return "Unspecified" if no-conference
	// return null if no conference
	public function getPubTitle() {
		return $this->pubTitle;
	}

	// gets the unique identifying article number for this article
	public function getArticleNumber() {
		return $this->articleNumber;
	}

	// gets the unique identifying publication number for this article
	public function getPubNumber() {
		return $this->pubNumber;
	}

	// gets the link to the PDF of the article online
	public function getPdfLink() {
		return $this->pdfLink;
	}
	
	// constructor
	// authors is an array
	public function __construct($title, $authors, $publishYear, $abstract,
			$pubTitle, $articleNumber, $pubNumber, $pdfLink) {
		$this->title = $title;
		$this->authors = $authors;
		$this->publishYear = $publishYear;
		$this->abstract = $abstract;
		$this->pubTitle = $pubTitle;
		$this->articleNumber = $articleNumber;
		$this->pubNumber = $pubNumber;
		$this->pdfLink = $pdfLink;
	}
}

?>