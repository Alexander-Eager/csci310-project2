<html>
<head>

    <title>
        Scholar Search -- Tables for <?php $_GET["word"]; ?>
    </title>

    <style>
    	table {
    		border-collapse: collapse;
    	}
    	table, th, td {
    		border: 1px solid black;
    	}
    </style>

    <link href="ut2style.css" rel="stylesheet" type="text/css" />

</head>

<body>

	<?php

		include("ArticleTable.php");
		include("IeeeSearch.php");

		$searchTerms = $_GET["searchTerms"];
		$numResults = $_GET["numResults"];
		
		// retrieve all articles for query, and remove any that don't have $word
		$articles = IeeeSearch::search($searchTerms, $numResults);
		for ($i = 0; $i < count($articles); $i ++) {
			if (strpos($articles[$i]->getAbstract(), $word) === false) {
				unset($articles[$i]);
			}
		}

		$table = ArticleTable::generateArticleTable($_GET["word"], $articles);

		echo $table;

	?>

</body>

</html>