<?php

include_once("../src/autoload_manager.php");

// this represents a distribution of words in paper
class WordCloudArray {
 
	public $map = array();

	// makes the map from word -> number of occurences
	public function returnWords($input) {
		// most common words from wikipedia
		$commonWords = array("the","be","to","of","and","a","in","that","have",
		"i","it","for","not","on","with","he","as","you","do","at","this","but",
		"his","by","from","they","we","say","her","she","or","an","will","my",
		"one","all","would","there","their","what","so","up","out","if","about",
		"who","get","which","go","me","when","make","can","like","time","no",
		"just","him","know","take","people","into","year","your","good","some",
		"could","them","see","other","than","then","now","look","only","come",
		"its","over","think","also","back","after","use","two","how","our",
		"work","first","well","way","even","new","want","because","any","these",
		"give","day","most","us","s","m","ll","ve","is","am");

		// remove tags
		$input = preg_replace("/<[^>]*>/", " ", $input);
		$input = preg_replace("/\W/", " ", $input);
		$input = strtolower($input);
		// replace all multiple spaces into single space
		$output = preg_replace('!\s+!', ' ', $input);
		//split into string
		$output = trim($output);
		$wordArray = explode(" ",$output);

		// remove common words

		for($i = count($wordArray) - 1 ; $i > -1; $i--) {
			for($j = 0; $j < count($commonWords); $j++) {
				if($wordArray[$i] == $commonWords[$j]) {
					unset($wordArray[$i]);
					break;
				}
			}
		}
		
		$wordArray = array_count_values($wordArray);
		foreach($wordArray as $key => $value) {
			if($key == "")
				unset($wordArray[$key]);
		}
		return $wordArray;

	}

	// make the word cloud array from the given set of lyrics
	public function __construct($text) {
		$this->map = $this->returnWords($text);
	}

	// get the map
	public function getMap() {
		return $this->map;
	}

	// get word size
	public function wordSize($numTimes,$max) {
		$size = $numTimes;
		$percent = $size / $max ;
		$modifiedSize = 15 + $percent * 55;
		$fontSize = "$modifiedSize" . "px";
		return $fontSize;
	}
	
	// generate word cloud. input from url
	public function generateWordCloud($map, $searchTerms, $numResults) {
		$cuttedResult = array();
		// check if words are more than 100
		if(count($map) > 100) {
			arsort($map);
			$i = 0;
			foreach($map as $word => $numTimes) {
				if($i < 100) {
					$cuttedResult[$word] = $numTimes;
				}
				$i ++;
			}
			$keys = array_keys($cuttedResult); 
			shuffle($keys); 
			$random = array(); 
			foreach ($keys as $key) { 
				$random[$key] = $cuttedResult[$key]; 
			}
			$cuttedResult = $random; 					
		}
		else {
			$cuttedResult = $map;
		}
		$max = 0;
		foreach ($cuttedResult as $word => $numTimes) {
			if($numTimes > $max) {
				$max = $numTimes;
			}
		}
		$output = "";
		foreach ($cuttedResult as $word => $numTimes) {
			$size = $this->wordSize($numTimes, $max);
			$output .= "<a href=\"/articlesWithWord.php?word=" 
				. $word . "&searchTerms=" . $searchTerms
				. "&numResults=" . $numResults 
				. "\"><span style = \""
				. "font-size: $size\">$word</span></a>  ";

		}
		return $output;
	}
}

?>
