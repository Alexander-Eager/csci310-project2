<?php
	class Article {
		//returns a string of the title
		//return null if the string is empty
		public function getTitle();
		//returns an array of author names as strings
		public function getAuthors();
		//returns a string of publish date
		//should return "unknown" if the date is empty
		//return null if no date
		public function getPublishDate();
		//returns a string of excerpt
		//return null if no excerpt
		public function getExcerpt();
		//return a string of conference
		//return "Unspecified" if no-conference
		//return null if no conference
		public function getConference();
		//constructor
		public function __construct($articleData);

	}

?>