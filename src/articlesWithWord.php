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

			$searchTerms = urldecode($_GET["searchTerms"]);
			$numResults = urldecode($_GET["numResults"]);
			
			// retrieve all articles for query
			$articles = IeeeSearch::search($searchTerms, $numResults);
			$table = ArticleTable::generateArticleTable(urldecode($_GET["word"]),
				$articles);

			echo $table;

		?>
	</div>
	<style>
	
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

</body>

</html>