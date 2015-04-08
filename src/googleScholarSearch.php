<?php

// wrapper class for all google scholar related functions (all will be static)
class GoogleScholar {
	// This function retrieves $numberOfResults articles that match $searchTerms,
	//	either in the document title or in the author
	// $searchTerms = title or author to search for
	// $numberOfResults = number of articles to return
	//						if less than this are returned, it should be because
	//						there weren't enough results
	// returns an array of the metadata for each article, in the form of a string
	//	we may later change this to be some kind of article objects, as required for the table.
	//	for now, the feature we are implementing is just retrieving relevant documents.
	public static function retrieveArticles($searchTerms, $numberOfResults) {
		// the output, as formatted by scholar.py https://github.com/ckreibich/scholar.py
		$authorOutput = `python '/home/web/Desktop/CSCI 310 Project 2/src/scholar.py' -c $numberOfResults --author="$searchTerms"`;
		$titleOutput = `python '/home/web/Desktop/CSCI 310 Project 2/src/scholar.py' -c $numberOfResults --phrase="$searchTerms" --title-only`;

		// separating individual articles
		// may in the future use CSV form to do this
		$authorArticles = explode("\n\n", $authorOutput);
		$titleArticles = explode("\n\n", $titleOutput);

		// check to make sure there are no empty articles
		if (count($authorArticles) == 1 && $authorArticles[0] == "") {
			$authorArticles = array();
		}
		if (count($titleArticles) == 1 && $titleArticles[0] == "") {
			$titleArticles = array();
		}


		// going through, getting out the articles we will use
		$i = 0;
		$authorLen = count($authorArticles);
		$titleLen = count($titleArticles);
		$articlesWeWillUse = array();
		$numArticlesTaken = 0;
		while ($numArticlesTaken < $numberOfResults) {
			// potentially change to article id later, instead of just straight
			// using all of the info about the article
			if ($i < $authorLen && !in_array($authorArticles[$i], $articlesWeWillUse)) {
				$articlesWeWillUse[] = $authorArticles[$i];
				$numArticlesTaken ++;
			}
			if ($numArticlesTaken < $numberOfResults &&
					$i < $titleLen && !in_array($titleArticles[$i], $articlesWeWillUse)) {
				$articlesWeWillUse[] = $titleArticles[$i];
				$numArticlesTaken ++;
			}
			$i ++;
			if ($i >= $authorLen && $i >= $titleLen) {
				break;
			}
		}

		return $articlesWeWillUse;
	}
}

?>
