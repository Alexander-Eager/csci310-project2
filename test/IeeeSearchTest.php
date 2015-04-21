<?php
include('../src/IeeeSearch.php');
class ArticleTest extends PHPUnit_Framework_TestCase {
	// test the retrieve article function
	// test title retrieve
	public function testRetrieveArticle1() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("sample title", $b->getTitle());
	}
	// test empty title
	public function testRetrieveArticle2() {
		$doc = array("title" => "", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getTitle());
	}
	// test author retrieve for empty author
	public function testRetrieveArticle3() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("");
		$this->assertEquals($c, $b->getAuthors());
	}
	// test author retrieve for single author
	public function testRetrieveArticle4() {
		$doc = array("title" => "sample title", "authors" =>"halfond",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("halfond");
		$this->assertEquals($c, $b->getAuthors());
	}
	// test author retrieve for multiple authors
	public function testRetrieveArticle5() {
		$doc = array("title" => "sample title", "authors" =>"halfond; sonal",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("halfond", "sonal");
		$this->assertEquals("2", count(array_intersect($c, $b->getAuthors())));
	}
	// test date retrieve
	public function testRetrieveArticle6() {
	$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"2012","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("2012", $b->getPublishYear());
	}
	// test date retrieve empty
	public function testRetrieveArticle7() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals(0, $b->getPublishYear());
	}
	// test excerpt retrieve
	public function testRetrieveArticle8() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"halfond is great","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("halfond is great", $b->getAbstract());
	}
	// test excerpt retrieve empty
	public function testRetrieveArticle9() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getAbstract());
	}
	// test pubtitle retrieve
	public function testRetrieveArticle10() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"Software engineering","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("Software engineering", $b->getPubTitle());
	}
	// test pubtitle retrieve empty
	public function testRetrieveArticle11() {
		$doc = array("title" => "sample title", "authors" =>"",
			"pubtitle"=>"","py"=>"","abstract"=>"","arnumber"=>"");
		//$a = new Article($title, $author, $date, $excerpt, $conference);
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getPubTitle());
	}
	// test search function
	// test if the number of search result is correct
	public function testSearch1() {
		$a = IeeeSearch::search("halfond", "10");
		$b = count($a);
		$this->assertEquals(10, $b);
	}
	// test if the keywork is in title or author names
	public function testSearch2() {
		$a = IeeeSearch::search("halfond", "10");
		$b = "true";
		for($i = 0; $i < 10; $i ++){
			if ( strpos($a[$i]->getTitle(),'halfond') == false 
				&& !in_array("halfond", $a[$i]->getAuthors()))
				$b = "false";
		}
		$this->assertEquals("false", $b);
	}
}
?>