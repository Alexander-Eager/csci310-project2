<html>

Temporary Output to prove that the search functionality works. <br/>
We will connect it to the word cloud and implement the remainder of the project in future sprints. <br/><br/>

<?php

include("googleScholarSearch.php");

// the number of results and the search terms are sent via HTTP GET
$numResults = $_GET["numResults"];
$searchTerms = $_GET["searchTerms"];

// get the results from googleScholarSearch.php
$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
echo "Number of articles: ";
echo count($articles);
echo "<br/><br/>";

// output the articles that resulted from the search
$numArticles = count($articles);
for ($i = 1; $i <= $numArticles; $i ++) {
	echo "Article $i" . "<br/>";
	echo "----------" . "<br/>";
	echo htmlspecialchars($articles[$i - 1]);
	echo "<br/><br/>";
}

?>

</html>