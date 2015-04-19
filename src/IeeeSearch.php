<?php

echo "testing<br/>";
IeeeSearch::search("halfond", 10);

// class that handles searching the IEEE database
class IeeeSearch {
	// Parses a particular <document> tag and returns the resulting Article object
	// returns an Article object
	public static function retrieveArticle($documentTag) {
		// TODO
	}

	// Executes a search query and returns a list of the Articles for that query
	public static function search($searchTerms, $numResults) {
		// run a query on both authors and titles
		$xmlAuthorText = file_get_contents("http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?"
			. "au=" . $searchTerms . "&"
			. "hc=" . $numResults);
		$xmlTitleText  = file_get_contents("http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?"
			. "ti=" . $searchTerms . "&"
			. "hc=" . $numResults);


		// convert those queries to an XML DOM tree, and then those articles to JSON, and then to arrays.
		// the basis of this code comes from http://stackoverflow.com/questions/8830599/php-convert-xml-to-json
		$xmlAuthor = simplexml_load_string($xmlAuthorText, null, LIBXML_NOCDATA);
		$authorArray = array();
		foreach ($xmlAuthor->children() as $document) {
			// ensure that we are dealing with a "document" tag
			if ($document->getName() !== "document") {
				continue;
			}
			// convert $document to an associative array and add it to the list
			$json = json_encode($document);
			echo $json;
			$article = json_decode($json, true);
			$authorArray[] = $article;
			var_dump($article);
		}

		$xmlTitle = simplexml_load_string($xmlTitleText);
		$titleArray = array();
		foreach ($xmlTitle->children() as $document) {
			// ensure that we are dealing with a "document" tag
			if ($document->getName() !== "document") {
				continue;
			}
			// convert $document to an associative array and add it to the list
			$json = json_encode($document);
			$article = json_decode($json, true);
			$titleArray[] = $article;
			var_dump($article);
		}

		var_dump($authorArray);
		var_dump($titleArray);

/*
		// now we have $authorArray = list of articles where the author matches $searchTerms,
		//         and $titleArray  = list of articles where the title  matches $searchTerms
		// so combine these two lists into the articles we want to use, ignoring duplicates
		$i = 0;
		$numArticlesTaken = 0;
		$authorLen = count($authorArray["root"] - 2);
		$titleLen  = count($titleArray);
		$ans = array();
		while ($numArticlesTaken < $numResults) {
			// look at adding the next article in $authorArray
			if ($i < $authorLen) {
				$article = IeeeSearch::retrieveArticle($authorArray[$i]);

			}
		}
*/
	}
}

?>