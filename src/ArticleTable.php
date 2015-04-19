<?php

// A table which contains the Articles that contain $word

	class ArticleTable {

		public static function generateTable($word) {

			// API call to find articles with $word
			// 

			// Declaration of output variable

			$output = '<table class="table table-striped table-bordered table-hover">';

			// for each article after the api call
			// foreach ($xmlAuthor->children() as $document) {
		
				$output = $output . "<tr>" . "<td> article name </td>"
				 					. "<td> author name </td>" 
									. "</tr>"


			// }					

			$output = $output . "</table>";

			return $output;

		}

	}



?>



