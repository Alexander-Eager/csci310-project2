<?php

include ('../src/googleScholarSearch.php');

// class to test the GoogleScholar class
class GoogleScholarTest extends PHPUnit_Framework_TestCase {
	/* Black-Box Test Cases */

	// tests getting the correct number of articles
	public function testNumArticles1() {
		$articles = GoogleScholar::retrieveArticles('halfond', 10);
		$this->assertEquals(10, count($articles));
	}

	public function testNumArticles2() {
		$articles = GoogleScholar::retrieveArticles('artificial intelligence', 17);
		$this->assertEquals(17, count($articles));
	}

	public function testNumArticles3() {
		$articles = GoogleScholar::retrieveArticles('technology', 1);
		$this->assertEquals(1, count($articles));
	}

	// tests getting correct articles for authors
	public function testValidArticlesAuthor1() {
		// author's first name
		$searchTerms = "William";
		$numResults = 1;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	public function testValidArticlesAuthor2() {
		// author's first and last name
		$searchTerms = "Barry Boehm";
		$numResults = 10;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	public function testValidArticlesAuthor3() {
		// author's first and last name, with initials
		$searchTerms = "William G. J. Halfond";
		$numResults = 20;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	public function testValidArticlesAuthor4() {
		// author's last name
		$searchTerms = "Halfond";
		$numResults = 1;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	// tests getting correct articles for titles
	public function testValidArticlesTitle1() {
		// one word searches
		$searchTerms = "preventing";
		$numResults = 10;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	public function testValidArticlesTitle2() {
		// two word searches
		$searchTerms = "runtime monitoring";
		$numResults = 20;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}
	
	public function testValidArticlesTitle3() {
		// one word searches
		$searchTerms = "analysis and monitoring";
		$numResults = 1;

		// now just make sure every article has $searchTerms in it
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		foreach ($articles as $article) {
			// it must be true that $searchTerms exists in $article
			$this->assertTrue(strpos($article, $searchTerms));
		}
	}

	// tests getting no articles for invalid author names (typos)
	public function testInvalidArticlesAuthor1() {
		// author's first name
		$searchTerms = "Willliam";
		$numResults = 20;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesAuthor2() {
		// author's first and last name
		$searchTerms = "Barryx Boehmx";
		$numResults = 1;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesAuthor3() {
		// author's first and last name, with initials
		$searchTerms = "Williamj O. G. Halfondy";
		$numResults = 10;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesAuthor4() {
		// author's last name
		$searchTerms = "Halfondy";
		$numResults = 20;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	// tests invalid title searches for words that are not in titles
	public function testInvalidArticlesTitle1() {
		$searchTerms = "N/A";
		$numResults = 1;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesTitle2() {
		$searchTerms = "silly beaver";
		$numResults = 10;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesTitle3() {
		$searchTerms = "many silly beavers";
		$numResults = 20;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	// tests invalid title searches for non-words
	public function testInvalidArticlesTitle4() {
		$searchTerms = "blahblahblahmeh";
		$numResults = 1;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesTitle5() {
		$searchTerms = "blahblahblahmeh di";
		$numResults = 10;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	public function testInvalidArticlesTitle6() {
		$searchTerms = "blahblahblahmeh di do";
		$numResults = 20;

		// make sure that no results are obtained
		$articles = GoogleScholar::retrieveArticles($searchTerms, $numResults);
		$this->assertEquals(0, count($articles));
	}

	/* White Box Test Cases */

	// The above black box test cases cover all conditional branching of the code
	// The tests on invalid input cover the first two if statements in the source file
	// The other if statements inside of the while loop are covered with all of the test
	// cases covering valid input. Thus these above cases are actually valid white box
	// test cases as well.
}

?>
