<html>
<head>

    <title>
        Scholar Search -- Table by Publication
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
		Table by Publication
	</h1>
	<div class = "table">
		<?php

			include_once("../src/autoload_manager.php");

			$conference = $_GET["conference"];
			
			// retrieve all articles for query, and remove any that don't have $word
			$articles = IeeeSearch::searchConference($conference);
			$table = ConferenceTable::generateConferenceTable($articles);

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