<!DOCTYPE html>
<html>

<body>

<?php

// this represents a distribution of words in papers
class WordCloudArray {

	public $map = array();

	// makes the map from word -> number of occurences
	public function returnWords($input){
		//most common words from wikipedia
		$commonWords = array("the","be","to","of","and","a","in","that","have","i","it",
		"for","not","on","with","he","as","you","do","at","this","but","his","by","from",
		"they","we","say","her","she","or","an","will","my","one","all","would","there","their",
		"what","so","up","out","if","about","who","get","which","go","me","when","make","can",
		"like","time","no","just","him","know","take","people","into","year","your","good","some",
		"could","them","see","other","than","then","now","look","only","come","its","over","think",
		"also","back","after","use","two","how","our","work","first","well","way","even","new","want",
		"because","any","these","give","day","most","us","s","m","ll","ve","is","am");


		//remove tags
		$input = preg_replace("/<[^>]*>/", " ", $input);
		$input = str_replace("<br />", " ", $input);
		$input = str_replace(",", " ", $input);
		$input = str_replace(".", " ", $input);
		$input = str_replace("?", " ", $input);
		$input = str_replace("!", " ", $input);
		$input = str_replace(":", " ", $input);
		$input = str_replace(";", " ", $input);
		$input = str_replace("\"", " ", $input);
		$input = str_replace("(", " ", $input);
		$input = str_replace(")", " ", $input);
		$input = str_replace("\n", " ", $input);
		$input = str_replace("'", " ", $input);
		$input = str_replace("-", " ", $input);
		$input = str_replace("*", " ", $input);
		$input = strtolower($input);
		//replace all multiple spaces into single space
		$output = preg_replace('!\s+!', ' ', $input);
		//split into string
		$output = trim($output);
		$wordArray = explode(" ",$output);

		//remove common words

		for($i = count($wordArray) - 1 ; $i > -1; $i--){
			for($j = 0; $j < count($commonWords); $j++){
				if($wordArray[$i] == $commonWords[$j]){
					unset($wordArray[$i]);
					break;
				}
			}
		}
		
		$wordArray = array_count_values($wordArray);
		foreach($wordArray as $key => $value){
			if($key == "")
				unset($wordArray[$key]);
		}
		return $wordArray;

	}

	// make the word cloud array from the given set of lyrics
	public function __construct($lyrics) {
		$this->map = $this->returnWords($lyrics);
	}

	// get the map
	public function getMap() {
		return $this->map;
	}

	// yields the combination of two word cloud arrays
	public function combination($array2) {
		$ans = new WordCloudArray("");
		$array1 = $this;

		// add everything from array1
		foreach ($array1->map as $word => $numTimes) {
			// if the word is in both, then add the numtimes together
			if (array_key_exists($word, $array2->map)) {
				$ans->map[$word] = $array1->map[$word] + $array2->map[$word];
			}
			// otherwise just add it to the combined array
			else{ 
				$ans->map[$word] = $numTimes;
			}
		}

		// add everything not in array1, but in array2
		foreach ($array2->map as $word => $numTimes) {
			// if the word is in both, it is already in the combined one
			// otherwise, add it to the combined one
			if (!array_key_exists($word, $array1->map)) {
				$ans->map[$word] = $numTimes;
			}
		}
		

		return $ans;
	}

	public function generatewordcloud(){

				include("UrlGenerator.php");
				$authors = getAuthorsFromURL();
				$result = new WordCloudArray("");
				foreach ($authors as $artist) {
					$result = $result->combination( $authors->getWordCloudArray() );
				}

				$max = 0;
				$map = $result->getMap();
				$cuttedResult = array();
				//check if words are more than 250
				if(count($map) > 250){
					arsort($map);
					$i = 0;
					foreach($map as $word => $numTimes){
						if($i < 250){
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
			
				foreach ($cuttedResult as $word => $numTimes){
					if($numTimes > $max)
						$max = $numTimes;
				}
				$output = "";
				foreach ($cuttedResult as $word => $numTimes) {
					$size = $numTimes;
					$percent = $size / $max ;
					$r = 200 + (1 - $percent) * 50;
					$g = 120 + (1 - $percent) * 50;
					$b = 80 + (1 - $percent) * 50;
					$modifiedSize = 15 + $percent * 55;
					$fontSize = "$modifiedSize" . "px";
					$output .= "<a href=\"/songlistpage.php?artists=" . $_GET["artists"] . "&word=" . $word .
							"\"><span style = \"color: rgb($r,$g,$b); font-size: $fontSize\">$word</span></a>";
					$output .= "  "; 
				}
				return $output;
		}
}

?>

</body>
</html>