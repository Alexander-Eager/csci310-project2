<?php

include("../src/autoload_manager.php");

class ArticleTableTest extends PHPUnit_Framework_TestCase {
	// test retrieving the word frequency for an article
	// test1: no words
	public function testCountNumTimes1() {
		$abstract = "";
		$word = "hello";
		$article = new Article("", array(), 0, $abstract, "", 0, 0, "");
		$this->assertEquals(0, ArticleTable::countNumTimes($article, $word));
	}

	// test2: no words, but the abstract has content
	public function testCountNumTimes2() {
		$abstract = "This line is mostly filler";
		$word = "Halfond";
		$article = new Article("", array(), 0, $abstract, "", 0, 0, "");
		$this->assertEquals(0, ArticleTable::countNumTimes($article, $word));
	}

	// test3: test to see that it occurs the correct number of times
	// also tests for case insensitivity
	public function testCountNumTimes3() {
		$abstract = "hello world. Hello Halfond.";
		$word = "hello";
		$article = new Article("", array(), 0, $abstract, "", 0, 0, "");
		$this->assertEquals(2, ArticleTable::countNumTimes($article, $word));
	}

	// test4: test to see that it occurs the correct number of times
	// also tests for case insensitivity and author
	public function testCountNumTimes4() {
		$abstract = "Sonal is a great TA. Here, I am using random "
			. "capitalization: sONal. SONAL";
		$word = "Sonal";
		$article = new Article("", array("SOnal"), 0, $abstract, "", 0, 0, "");
		$this->assertEquals(4, ArticleTable::countNumTimes($article, $word));
	} 

	// test createRowforarticle function
	// test title
	public function testCreateRowForArticle1() {
		$article = new Article("title", array(), 0, "", "", 0, 0, "");
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr>"
					. "<td>"
						. "<a href='/wordCloud.php?searchTerms=title"
							. "&numResults=10'>"
							. "title"
						. "</a>"
					. "</td>"
					. "<td></td>"
					. "<td>0</td>"
					. "<td><a href='articlesWithConference.php?conference=0'>"
						. "</a></td>"
					. "<td>0</td>"
					. "<td><a href=''>0</a></td>"
				. "</tr>";
		$this->assertEquals($row, $ans);
	}
	
	// test publish year
	public function testCreateRowForArticle2() {
		$article = new Article("", array("only author"), 2010, "", "", 0, 0,
			"");
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr><td></td><td><a href='/wordCloud.php?searchTerms=only&numResults=10'>only</a> <a href='/wordCloud.php?searchTerms=author&numResults=10'>author</a></td><td>2010</td><td><a href='articlesWithConference.php?conference=0'></a></td><td>0</td><td><a href=''>0</a></td></tr>";
		$this->assertEquals($row, $ans);
	}

	// test article number
	public function testCreateRowForArticle3() {
		$article = new Article("", array(), 0, "", "", 10101010, 0, "");
		$ans = ArticleTable::createRowForArticle($article, 0);
		$row 	= "<tr><td></td><td></td><td>0</td><td><a href='articlesWithConference.php?conference=0'></a></td><td>0</td><td><a href=''>10101010</a></td></tr>";
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
			12345, 5004, "pdf.com");
		$ans = ArticleTable::createRowForArticle($article, 57);
		$row	= "<tr><td><a href='/wordCloud.php?searchTerms=Command&numResults=10'>Command</a>-<a href='/wordCloud.php?searchTerms=Form&numResults=10'>Form</a> <a href='/wordCloud.php?searchTerms=Coverage&numResults=10'>Coverage</a> <a href='/wordCloud.php?searchTerms=for&numResults=10'>for</a> <a href='/wordCloud.php?searchTerms=Testing&numResults=10'>Testing</a> <a href='/wordCloud.php?searchTerms=Database&numResults=10'>Database</a> <a href='/wordCloud.php?searchTerms=Applications&numResults=10'>Applications</a></td><td><a href='/wordCloud.php?searchTerms=Halfond&numResults=10'>Halfond</a>, <a href='/wordCloud.php?searchTerms=W&numResults=10'>W</a>.<a href='/wordCloud.php?searchTerms=G&numResults=10'>G</a>.<a href='/wordCloud.php?searchTerms=J&numResults=10'>J</a>.; <a href='/wordCloud.php?searchTerms=Orso&numResults=10'>Orso</a>, <a href='/wordCloud.php?searchTerms=A&numResults=10'>A</a>.</td><td>2006</td><td><a href='articlesWithConference.php?conference=5004'>Automated Software Engineering, 2006. ASE '06. 21st IEEE/ACM International Conference on</a></td><td>57</td><td><a href='pdf.com'>12345</a></td></tr>";
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
			1999, "halfond H-ALFOND", "pub1", 1, 0, "");
		$article_2 = new Article("title2", array("author2", "halfond"),
			2007, "Halfond ~halfffond. --Halfond==", "pub2", 123, 0, "");

		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);

		$table	= "<table><tr><th>Title</th><th>Author(s)</th><th>Publication Year</th><th>Publication Title</th><th>Frequency of Word</th><th>Article Number</th></tr><tr><td><a href='/wordCloud.php?searchTerms=title2&numResults=10'>title2</a></td><td><a href='/wordCloud.php?searchTerms=author2&numResults=10'>author2</a>; <a href='/wordCloud.php?searchTerms=halfond&numResults=10'>halfond</a></td><td>2007</td><td><a href='articlesWithConference.php?conference=0'>pub2</a></td><td>3</td><td><a href=''>123</a></td></tr><tr><td><a href='/wordCloud.php?searchTerms=title1&numResults=10'>title1</a></td><td><a href='/wordCloud.php?searchTerms=halfond&numResults=10'>halfond</a>; <a href='/wordCloud.php?searchTerms=author1&numResults=10'>author1</a></td><td>1999</td><td><a href='articlesWithConference.php?conference=0'>pub1</a></td><td>2</td><td><a href=''>1</a></td></tr></table>";

		$this->assertEquals($table, $ans);
	}
}

?>
