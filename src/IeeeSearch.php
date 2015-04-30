<?php

include_once("autoload_manager.php");

// class that handles searching the IEEE database
class IeeeSearch {
	// Parses a particular <document> tag and returns the resulting Article
	//	object
	public static function retrieveArticle($documentTag) {
		// all of these are directly obtainable 
		$title = $documentTag["title"];
		$publicationTitle = $documentTag["pubtitle"];
		$publicationNumber = intval($documentTag["punumber"]);
		$pdfLink = $documentTag["pdf"];
		$publicationYear = intval($documentTag["py"]);
		$abstract = $documentTag["abstract"];
		$articleNumber = intval($documentTag["arnumber"]);
		// getting an array of authors is a littler harder; they are separated
		//	by "; "
		// might already be an array
		$authors = array();
		if (gettype($documentTag["authors"]) == "array") {
			$authors = $documentTag["authors"];
		} else {
			$authors = explode("; ", $documentTag["authors"]);
		}


		// now just pass all of these parameters into the constructor for a new
		//	Article
		$ans = new Article($title, $authors, $publicationYear, $abstract,
			$publicationTitle, $articleNumber, $publicationNumber, $pdfLink);
		return $ans;
	}

	// Executes a search query and returns a list of the Articles for that query
	public static function search($searchTerms, $numResults) {
		// run a query on both authors and titles
		$xmlAuthorText = file_get_contents(
			"http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?"
			. "au=" . urlencode($searchTerms) . "&"
			. "hc=" . $numResults);
		$xmlTitleText  = file_get_contents(
			"http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?"
			. "ti=" . urlencode($searchTerms) . "&"
			. "hc=" . $numResults);

		// convert those queries to an XML DOM tree, and then those articles to
		// JSON, and then to arrays.
		// the basis of this code comes from
		// http://stackoverflow.com/questions/8830599/php-convert-xml-to-json
		$authorArray = IeeeSearch::retrieveListOfArticlesFromXML(
			$xmlAuthorText);
		$titleArray = IeeeSearch::retrieveListOfArticlesFromXML($xmlTitleText);

		// now we have $authorArray = list of articles where the author
		//	matches $searchTerms,
		//         and $titleArray = list of articles where the title
		//	matches $searchTerms
		// so combine these two lists into the articles we want to use, ignoring
		//	duplicates
		$i = 0;
		$numArticlesTaken = 0;
		$authorLen = count($authorArray);
		$titleLen  = count($titleArray);
		$ans = array();
		while ($numArticlesTaken < $numResults) {
			// look at adding the next article in $authorArray
			if ($i < $authorLen) {
				// if it is not already in our list, add it
				$articleToConsider = $authorArray[$i];
				if (!IeeeSearch::arrayHasArticle($ans, $articleToConsider)) {
					$ans[] = $articleToConsider;
					$numArticlesTaken ++;
				}
			}
			// look at adding the next article in $titleArray
			if ($i < $titleLen && $numArticlesTaken < $numResults) {
				// if it is not already in our list, add it
				$articleToConsider = $titleArray[$i];
				if (!IeeeSearch::arrayHasArticle($ans, $articleToConsider)) {
					$ans[] = $articleToConsider;
					$numArticlesTaken ++;
				}
			}
			$i ++;
			// in exceptional cases, this may happen because the search terms
			// do not return enough results
			if ($i >= $authorLen && $i >= $titleLen) {
				break;
			}
		}

		// return the answer
		return $ans;
	}

	// Executes a search query and returns a list of the Articles that has
	// the same publication (which we equate to conference)
	public static function searchConference($pubNumber) {
		// get the XML query results
		$xmlText = file_get_contents(
			"http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?"
			. "pn=" . urlencode("$pubNumber"));
		// use that to get an array of articles
		$ans = IeeeSearch::retrieveListOfArticlesFromXML($xmlText);

		return $ans;
	}

	// function that converts a search query result into a list of articles
	public static function retrieveListOfArticlesFromXML($xmlText) {
		$xmlTree = simplexml_load_string($xmlText, null, LIBXML_NOCDATA);
		$ans = array();
		foreach ($xmlTree->children() as $document) {
			// ensure that we are dealing with a "document" tag
			if ($document->getName() !== "document") {
				continue;
			}
			// convert $document to an associative array and add it to the list
			$json = json_encode($document);
			$article = json_decode($json, true);
			$ans[] = IeeeSearch::retrieveArticle($article);
		}
		return $ans;
	}

	// function that determines if the given array contains the given article
	// makes use of the article number
	public static function arrayHasArticle($array, $article) {
		foreach ($array as $otherArticle) {
			if ($article->getArticleNumber() ===
				$otherArticle->getArticleNumber()) {
				return true;
			}
		}
		return false;
	}
}

?>