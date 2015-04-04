<?php

/* URL Generation */

function getURLForSearchPage() {
	return "/index.html";
}

// makes the URL for a word cloud page with certain artists
function getURLForWordCloudPage($listOfArtistIds) {
	// "artists" is the list of artists that make up the cloud, separated by ','
	$answer = "/wordCloudPage.php?artists=";

	// add each artist id
	foreach ($listOfArtistIds as $artistId) {
		$answer .= $artistId . ",";
	}
	// cut off the last comma
	$answer = substr($answer, 0, count($answer) - 1);

	return $answer;
}


/* Parsing URL GET to obtain parameters */

// gets the list of artists from the url
function getAuthorsFromURL() {
	// get list of ids from the URL
	$authorsIds = $_GET["authors"];
	$listOfIds = explode(',', $authorsIds);

	// make a list of artists from this list of ids
	$answer = array();
	foreach ($listOfIds as $id) {
		//not implemented!!!!!!!!!!!!
		$answer[] = getAuthor($id);
	}

	return $answer;
}

// gets the word the user is checking out (for song list and lyrics page)
function getWordfromURL() {
	return $_GET["word"];
}

// gets the page number (for song list page)
function getPageNumberFromURL() {
	return intval($_GET["page"]);
}


// gets the error from the URL (only useful for error page)
function getErrorFromURL() {
	return $_GET["error"];
}

?>