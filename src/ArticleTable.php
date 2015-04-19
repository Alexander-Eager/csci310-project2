<?php

// A table which contains the Articles that contain $word

	class ArticleTable {

		public static function generateTable($word) {

			// API call to find articles with $word
			// 

			// Declaration of output variable

			$output = '<table class="table table-striped table-bordered table-hover">';
			$output = $output . '<tr>
					    <th>Article Name</th>
					    <th>Author Name</th> 
					    
					  </tr>';

			// for each article after the api call
			// foreach ($xmlAuthor->children() as $document) {
		
			// Each of these should eventually be <a href>.... inside the <td></td> brackets
					  /* for example :

							$output = $output . "<tr>" . "<td> <a href = "LINK HERE"> article name </td>"
				 					. "<td> <a href = "LINK HERE"> author name </td>" 
									. "</tr>";
				

					  */

				$output = $output . "<tr>" . "<td> article name </td>"
				 					. "<td> author name </td>" 
									. "</tr>";


			// }					

			$output = $output . "</table>";

			return $output;

		}

	}



?>



