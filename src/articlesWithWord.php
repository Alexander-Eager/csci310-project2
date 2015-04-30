<html>
<head>

    <title>
        Scholar Search -- Tables for
        <?php
        	echo $_GET["searchTerms"] . " => " . $_GET["word"];
        ?>
    </title>

    <style>
    	table {
    		border-collapse: collapse;
    	}
    	table, th, td {
    		border: 1px solid black;
    	}
	
		body {
			color: #FFCC00;
		}

		.table {
			background-color: gray;
			border: 1px solid #FAFAF2;
			font-size: 1em;
			margin: 2em;
		}

		/* change table later so that only the td/tr shows background color, include padding */

	</style>

    <link href="ut2style.css" rel="stylesheet" type="text/css" />

</head>

<body>
	<h1 style = "text-align:center; color: black">
		Table for
		<span style="text-decoration:underline;">
			<?php
				echo $_GET["searchTerms"];
			?></span> <!-- Had to put on one line to fix underlining issue -->
		=&gt;
		<span style="text-decoration:underline;">
			<?php
				echo $_GET["word"];
			?>
		</span>
	</h1>
	<div class = "table">
		<?php

			include_once("../src/autoload_manager.php");

			$searchTerms = $_GET["searchTerms"];
			$numResults = $_GET["numResults"];
			
			// retrieve all articles for query, and remove any that don't have
			// $word
			$articles = IeeeSearch::search($searchTerms, $numResults);
			for ($i = 0; $i < count($articles); $i ++) {
				if (strpos($articles[$i]->getAbstract(), $word) === false) {
					unset($articles[$i]);
				}
			}
			$table = ArticleTable::generateArticleTable($_GET["word"],
				$articles);

			echo $table;

		?>

	</div>
	<input action="action" type="button" value="Back" onclick="history.go(-1);" />

</body>

</html>