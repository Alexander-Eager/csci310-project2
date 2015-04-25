<?php

include("IeeeSearch.php");
class ArticleTable {

	// new Article("title", ...)
	// this function makes "<tr><td>title</td>...<td>"
	public static function createRowForArticle($article) {
		$ans = "<tr>";
		// goes title, authors, pub year, pub title, arnumber
		$ans .= "<td>" . $article->getTitle() . "</td>";
		// authors are in an array
		if(count($article->getAuthors()) > 1){
			$ans .= "<td>" . implode("; ", $article->getAuthors());
			$ans .="</td>";
		}
		else if (count($article->getAuthors() == 1)){
			$array = $article->getAuthors();
			$ans .= "<td>" . $array[0];
			$ans .="</td>";
		}
		else if(count($article->getAuthors() == 0)){
			$ans .= "<td>" . "";
			$ans .="</td>";
		}
		// these are direct
		$ans .= "<td>" . $article->getPublishYear() . "</td>";
		$ans .= "<td>" . $article->getPubTitle() . "</td>";
		$ans .= "<td>" . $article->getArticleNumber() . "</td>";
		$ans .= "</tr>";
		return $ans;
	}
	public static function generateArticleTable($word, $articles) {
		// make the table
		$output = '<table>';
		$output .= "<tr><th>Title</th>"
					.	"<th>Author(s)</th>"
					.	"<th>Publication Year</th>"
					.	"<th>Publication Title</th>"
					.	"<th>Article Number</th>"
					. 	"</tr>";
		foreach ($articles as $article) {
			if (strpos($article->getAbstract(), $word) !== false) {
				$output .= ArticleTable::createRowForArticle($article);
			}
		}
		$output .= "</table>";
		return $output;
	}
}
?>