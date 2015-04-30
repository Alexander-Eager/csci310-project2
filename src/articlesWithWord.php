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
	
		body{
			color: #FFCC00;
		}

		.table{
			background-color: gray;
			border: 1px solid #FAFAF2;
			font-size: 1em;
			margin: 2em;
		}

	</style>

    <link href="ut2style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<h1 style = "text-align:center; color: black"> Table for <span style="text-decoration:underline;"><?php  echo $_GET["searchTerms"]; ?></span> </h1>
	<div class = "table">
		<?php

			include_once("../src/autoload_manager.php");

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

		<input action="action" type="button" value="Back" onclick="history.go(-1);" />
	</div>

</body>

</html>