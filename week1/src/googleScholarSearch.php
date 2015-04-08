<?php

// This function retrieves $numberOfResults articles that match $searchTerms,
//	either in the document title or in the author
// $searchTerms = title or author to search for
// $numberOfResults = number of articles to return
//						if less than this are returned, it should be because
//						there weren't enough results
// returns an array of the metadata for each article, in the form of a string
//	we may later change this to be some kind of article objects, as required for the table.
//	for now, the feature we are implementing is just retrieving relevant documents.
	function retrieveArticles($searchTearms, $numberOfResults) {
		// search by title and author separately
		$authorHandle = popen('scholar.py -c $numberOfResults --author "$searchTerms"', "");
		$titleHandle = popen('scholar.py -c $numberOfResults --phrase "$searchTerms"', "");

		// the output, as formatted by scholar.py https://github.com/ckreibich/scholar.py
		$authorOutput = file_get_contents($authorHandle);
		$titleOutput = file_get_contents($titleHandle);

		// separating individual articles
		$authorArticles = explode("\n\n", $authorOutput);
		$titleArticles = explode("\n\n", $titleOutput);

		// going through, getting out the articles we will use
		$i = 0;
		$authorLen = count($authorArticles);
		$titleLen = count($titleArticles);
		$articlesWeWillUse = array();
		$numArticlesTaken = 0;
		while ($numArticlesTaken < $numberOfResults) {
			// potentially change to article id later, instead of just straight
			// 
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
?>