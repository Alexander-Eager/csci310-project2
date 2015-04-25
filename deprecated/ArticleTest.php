<?php

//include('../src/Article.php');

class ArticleTest extends PHPUnit_Framework_TestCase {

	// example of titles: including empty string, non-exist titles, other normal
	// titles
	// testcase for empty string
	public function testGetTitle1() {
		$articleData = "Title ";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getTitle());
	}

	// testcase for non-exist title
	public function testGetTitle2() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getTitle());
	}

	// testcase for normal title 1
	public function testGetTitle3() {
		$articleData = "Title really cool article";
		$article = new Article($articleData);
		$this->assertEquals("really cool article", $article->getTitle());
	}

	// testcase for normal title 2 
	public function testGetTitle4() {
		$articleData = "Title doesn't matter";
		$article = new Article($articleData);
		$this->assertEquals("doesn't matter", $article->getTitle());
	}

	// TODO  testcase for authors
	// should include no-authors, no-author-tag, one author, multiple authors
	// testcase for no-author
	public function testGetAuthors1() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(array(), $article->getAuthors());
	}

	// testcase for no-author-tag
	public function testGetAuthors2() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getAuthors());
	}

	// testcase for one-author
	public function testGetAuthors3() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(array("halfond"), $article->getAuthors());
	}

	// testcase for multiple author
	public function testGetAuthors4() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(array("halfond", "sonal"), $article->getAuthors());
	}

	// should include: no-data, no-date-tag, normal date
	// testcase for no-date
	public function testGetPublishDate1() {
		$articleData = "Date ";
		$article = new Article($articleData);
		$this->assertEquals("unknown", $article->getPublishDate());
	}

	// testcase for no-date-tag
	public function testGetPublishDate2() {
		$articleData = " ";
		$article = new Article($articleData);
		$this->assertEquals("", $article->getPublishDate());
	}

	// testcase for normal date
	public function testGetPublishDate3() {
		//not sure about the format yet
		$articleData = "Date 4-4-15";
		$article = new Article($articleData);
		$this->assertEquals("4-4-15", $article->getPublishDate());
	}

	// should include: no-excerpt, no-excerpt-tag, excerpt that include "...", 
	// excerpt that do not have "..."
	// testcase for no-excerpt
	public function testGetExcerpt1() {
		$articleData = "Excerpt ";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getPublishDate());
	}

	// testcase for no-excerpt-tag
	public function testGetExcerpt2() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getPublishDate());
	}

	// testcase for excerpt that include "...", 
	public function testGetExcerpt3() {
		$articleData = "Excerpt paragraph sth...";
		$article = new Article($articleData);
		$this->assertEquals("paragraph sth", $article->getPublishDate());
	}

	// testcase for excerpt that do not include "...", 
	public function testGetExcerpt4() {
		$articleData = "Excerpt paragraph sth";
		$article = new Article($articleData);
		$this->assertEquals("paragraph sth", $article->getPublishDate());
	}

	// including  no-conference, no-conference-tag, normal conference
	// testcase for no-conference
	public function testGetConference1() {
		$articleData = " Conference ";
		$article = new Article($articleData);
		$this->assertEquals("Unspecified", $article->getConference());
	}

	// testcase for no-conference-tag
	public function testGetConference2() {
		$articleData = "";
		$article = new Article($articleData);
		$this->assertEquals(null, $article->getConference());
	}

	// testcase for normal conference
	public function testGetConference3() {
		$articleData = " Conference sth";
		$article = new Article($articleData);
		$this->assertEquals("sth", $article->getConference());
	}
}

?>