<?php

include("../src/autoload_manager.php");

class ArticleTableTest extends PHPUnit_Framework_TestCase {
	// test retrieving the word frequency for an article
	// test1: no words
	public function testCountNumTimes1() {
		$abstract = "";
		$word = "hello";
		$article = new Article("", array(), 0, $abstract, "", 0);
		$this->assertEquals(0, ArticleTable::countNumTimes($article, $word));
	}

	// test2: no words, but the abstract has content
	public function testCountNumTimes2() {
		$abstract = "This line is mostly filler";
		$word = "Halfond";
		$article = new Article("", array(), 0, $abstract, "", 0);
		$this->assertEquals(0, ArticleTable::countNumTimes($article, $word));
	}

	// test3: test to see that it occurs the correct number of times
	// also tests for case insensitivity
	public function testCountNumTimes3() {
		$abstract = "hello world. Hello Halfond.";
		$word = "hello";
		$article = new Article("", array(), 0, $abstract, "", 0);
		$this->assertEquals(2, ArticleTable::countNumTimes($article, $word));
	}

	// test4: test to see that it occurs the correct number of times
	// also tests for case insensitivity and author
	public function testCountNumTimes4() {
		$abstract = "Sonal is a great TA. Here, I am using random capitalization: sONal. SONAL";
		$word = "Sonal";
		$article = new Article("", array("SOnal"), 0, $abstract, "", 0);
		$this->assertEquals(4, ArticleTable::countNumTimes($article, $word));
	} 

	// test createRowforarticle function
	// test title
	public function testCreateRowForArticle1() {
		$article = new Article("title", array(), 0, "", "", 0);
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr>"
					. "<td>title</td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td>0</td>"
				. "</tr>";
		$this->assertEquals($row, $ans);
	}
	
	// test publish year
	public function testCreateRowForArticle2() {
		$article = new Article("", array("only author"), 2010, "", "", 0);
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr>"
					. "<td></td>"
					. "<td>only author</td>"
					. "<td>2010</td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td>0</td>"
				. "</tr>";
		$this->assertEquals($row, $ans);
	}

	// test article number
	public function testCreateRowForArticle3() {
		$article = new Article("", array(), 0, "", "", 10101010);
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr>"
					. "<td></td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td>10101010</td>"
				. "</tr>";
		$this->assertEquals($row, $ans);
	}

	// test authors, word frequency, publication title, and others
	// simultaneously
	public function testCreateRowForArticle4() {
		$article = new Article(
			"Command-Form Coverage for Testing Database Applications",
			array("Halfond, W.G.J.", "Orso, A."),
			2006, "",
			"Automated Software Engineering, 2006. ASE '06. "
				. "21st IEEE/ACM International Conference on",
			12345);
		$ans = ArticleTable::createRowForArticle($article, 57);
		$row	= "<tr>"
					. "<td>Command-Form Coverage for Testing Database "
						. "Applications</td>"
					. "<td>Halfond, W.G.J.; Orso, A.</td>"
					. "<td>2006</td>"
					. "<td>Automated Software Engineering, 2006. ASE '06. 21st "
						. "IEEE/ACM International Conference on</td>"
					. "<td>57</td>"
					. "<td>12345</td>"
				. "</tr>";
		$this->assertEquals($row, $ans);
	}

	// basically just tests that the header of the table is correct.
	public function testGenerateArticleTable1() {
		$articles = array();
		$ans = ArticleTable::generateArticleTable("halfond", $articles);

		$table 	= "<table><tr>"
					. "<th>Title</th>"
					. "<th>Author(s)</th>"
					. "<th>Publication Year</th>"
					. "<th>Publication Title</th>"
					. "<th>Frequency of Word</th>"
					. "<th>Article Number</th>"
				. "</tr></table>";
		$this->assertEquals($table, $ans);
	}

	// test generatearticletable function,
	// which tests the overall functionality of the entire class
	// test2
	public function testGenerateArticleTable2() {
		$article_1 = new Article("title1", array("halfond", "author1"),
			1999, "halfond HALFOND", "pub1", 1);
		$article_2 = new Article("title2", array("author2", "halfond"),
			2007, "Halfond ~halfffond.", "pub2", 123);

		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);

		$table	= "<table>"
					. "<tr>"
						. "<th>Title</th>"
						. "<th>Author(s)</th>"
						. "<th>Publication Year</th>"
						. "<th>Publication Title</th>"
						. "<th>Frequency of Word</th>"
						. "<th>Article Number</th>"
					. "</tr>"
					. "<tr>"
						. "<td>title1</td>"
						. "<td>halfond; author1</td>"
						. "<td>1999</td>"
						. "<td>pub1</td>"
						. "<td>3</td>"
						. "<td>1</td>"
					. "</tr>"
					. "<tr>"
						. "<td>title2</td>"
						. "<td>author2; halfond</td>"
						. "<td>2007</td>"
						. "<td>pub2</td>"
						. "<td>2</td>"
						. "<td>123</td>"
					. "</tr>"
				. "</table>";

		$this->assertEquals($table, $ans);
	}
}

?>
