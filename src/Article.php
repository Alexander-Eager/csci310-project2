<?php
	class Article {
		private $title;
		private $authors;
		private $publishDate;
		private $abstract;
		private $pubTitle;
		private $articleNumber;
		//returns a string of the title
		//return null if the string is empty
		public function getTitle(){
			return $this->title;
		}
		//returns an array of author names as strings
		public function getAuthors(){
			return $this->authors;
		}
		//returns a string of publish date
		//should return "unknown" if the date is empty
		//return null if no date
		public function getPublishYear(){
			return $this->publishDate;
		}
		//returns a string of excerpt
		//return null if no excerpt
		public function getAbstract(){
			return $this->abstract;
		}
		//return a string of conference
		//return "Unspecified" if no-conference
		//return null if no conference
		public function getPubTitle(){
			return $this->pubTitle();
		}
		//
		public function getArticleNumber(){
			return $this-?articleNumber();
		}
		//constructor
		//authors is an array
		public function __construct($title, $authors, $publishYear, $abstract, $pubTitle, $articleNumber){
			$this->title = $title;
			$this->authors = $authors;
			$this->publishYear = $publishYear;
			$this->abstract = $abstract;
			$this->pubTitle = $pubTitle;
			$this->articleNumber = $articleNumber;
		}

	}

?>