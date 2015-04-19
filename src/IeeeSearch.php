<?php

echo "testing<br/>";
IeeeSearch::search("halfond", 10);

// class that handles searching the IEEE database
class IeeeSearch {
	// Parses a particular <document> tag and returns the resulting Article object
	// returns an Article object
	public static function retrieveArticle($documentTag) {
		// all of these are directly obtainable 
		$title = $documentTag["title"];
		$publicationTitle = $documentTag["pubtitle"];
		$publicationNumber = $documentTag["punumber"];
		$publicationYear = intval($documentTag["py"]);
		$abstract = $documentTag["abstract"];
		$articleNumber = $documentTag["arnumber"];
		// getting an array of authors is a littler harder; they are separated by "; "
		$authors = explode("; ", $documentTag["authors"]);

		// now just pass all of these parameters into the constructor for a new Article
		return new Article($title, $authors, $publishYear, $abstract, $publicationTitle, $publicationNumber,
			$articleNumber);
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
		$authorArray = retrieveListOfArticlesFromXML($xmlAuthorText);
		$titleArray = retrieveListOfArticlesFromXML($xmlTitleText);

		// now we have $authorArray = list of articles where the author matches $searchTerms,
		//         and $titleArray  = list of articles where the title  matches $searchTerms
		// so combine these two lists into the articles we want to use, ignoring duplicates
		$i = 0;
		$numArticlesTaken = 0;
		$authorLen = count($authorArray);
		$titleLen  = count($titleArray);
		$ans = array();
		while ($numArticlesTaken < $numResults) {
			// look at adding the next article in $authorArray
			if ($i < $authorLen) {
				// if it is not already in our list, add it
				$articleToConsider = $authorArray[$i]->getArticleNumber();
				if (!arrayHasArticle($ans, $articleToConsider)) {
					$ans[] = $articleToConsider;
					$numArticlesTaken ++;
				}
			}
			// look at adding the next article in $titleArray
			if ($i < $titleLen && $numArticlesTaken < $numResults) {
				// if it is not already in our list, add it
				$articleToConsider = $titleArray[$i]->getArticleNumber();
				if (!arrayHasArticle($ans, $articleToConsider)) {
					$ans[] = $articleToConsider;
					$numArticlesTaken ++;
				}
			}
			// in exceptional cases, this may happen because the search terms
			// do not return enough results
			if ($i >= $authorLen && $i >= $titleLen) {
				break;
			}
		}

		// return the answer
		return $ans;
	}

	// function that converts a search query result into a list of articles
	private static function retrieveListOfArticlesFromXML($xmlText) {
		$xmlTree = simplexml_load_string($xmlAuthorText, null, LIBXML_NOCDATA);
		$ans = array();
		foreach ($xmlTree->children() as $document) {
			// ensure that we are dealing with a "document" tag
			if ($document->getName() !== "document") {
				continue;
			}
			// convert $document to an associative array and add it to the list
			$json = json_encode($document);
			$article = json_decode($json, true);
			$ans[] = retrieveArticle($article);
		}
	}

	// function that determines if the given array contains the given article
	// makes use of the article number
	private static function arrayHasArticle($array, $article) {
		foreach ($array as $otherArticle) {
			if ($article->getArticleNumber() === $otherArticle->getArticleNumber()) {
				return true;
			}
		}
		return false;
	}
}

?>