<?php

include_once("../src/autoload_manager.php");

class IeeeSearchTest extends PHPUnit_Framework_TestCase {
	// test the retrieve article function
	// test title retrieve
	public function testRetrieveArticle1() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("sample title", $b->getTitle());
	}

	// test empty title
	public function testRetrieveArticle2() {
		$doc = array("title" => "", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getTitle());
	}

	// test author retrieve for empty author
	public function testRetrieveArticle3() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("");
		$this->assertEquals($c, $b->getAuthors());
	}

	// test author retrieve for single author
	public function testRetrieveArticle4() {
		$doc = array("title" => "sample title", "authors" => "halfond",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("halfond");
		$this->assertEquals($c, $b->getAuthors());
	}

	// test author retrieve for multiple authors
	public function testRetrieveArticle5() {
		$doc = array("title" => "sample title", "authors" => "halfond; sonal",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$c = array("halfond", "sonal");
		$this->assertEquals(2, count(array_intersect($c, $b->getAuthors())));
	}

	// test date retrieve
	public function testRetrieveArticle6() {
	$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "2012", "abstract" => "",
			"arnumber" => "", "punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals(2012, $b->getPublishYear());
	}

	// test date retrieve empty
	public function testRetrieveArticle7() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals(0, $b->getPublishYear());
	}

	// test excerpt retrieve
	public function testRetrieveArticle8() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "halfond is great",
			"arnumber" => "", "punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("halfond is great", $b->getAbstract());
	}

	// test excerpt retrieve empty
	public function testRetrieveArticle9() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getAbstract());
	}

	// test pubtitle retrieve
	public function testRetrieveArticle10() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "Software engineering", "py" => "", "abstract" => "",
			"arnumber" => "", "punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("Software engineering", $b->getPubTitle());
	}

	// test pubtitle retrieve empty
	public function testRetrieveArticle11() {
		$doc = array("title" => "sample title", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("", $b->getPubTitle());
	}

	// test publisher number retrieval and PDF
	public function testRetrieveArticle12() {
		$doc = array("title" => "", "authors" => "",
			"pubtitle" => "", "py" => "", "abstract" => "", "arnumber" => "",
			"punumber" => "19374", "pdf" => "http://pdf.com");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals(19374, $b->getPubNumber());
		$this->assertEquals("http://pdf.com", $b->getPdfLink());
	}

	// test author if it is an array
	public function testRetrieveArticle13() {
		$doc = array("title" => "sample title", "authors" => array(),
			"pubtitle" => "Software engineering", "py" => "", "abstract" => "",
			"arnumber" => "", "punumber" => "0", "pdf" => "");
		$b = IeeeSearch::retrieveArticle($doc);
		$this->assertEquals("Software engineering", $b->getPubTitle());
	}


	// test search function
	// test if the number of search result is correct
	public function testSearch1() {
		$a = IeeeSearch::search("halfond", 10);
		$b = count($a);
		$this->assertEquals(10, $b);
	}

	// test if the keyword is in title or author names
	public function testSearch2() {
		$a = IeeeSearch::search("halfond", 10);
		$b = true;
		for($i = 0; $i < 10; $i ++){
			if ( strpos($a[$i]->getTitle(), 'halfond') === false 
				&& !in_array("halfond", $a[$i]->getAuthors())) {
				$b = false;
			}
		}
		$this->assertEquals(false, $b);
	}

	// whitebox test that specifically aims to check the case when the search
	// comes up empty
	public function testSearch3() {
		$a = IeeeSearch::search("asdfasfgibqwejascnp", 1);
		$this->assertEquals(0, count($a));
	}

	// tests the case where the search results cannot match the desired number
	// of results
	public function testSearch4() {
		$a = IeeeSearch::search("halfond", 10000);
		$this->assertEquals(true, count($a) < 10000);
	}

	//test that searchterm is in title no author
	public function testSearch5() {
		$a = IeeeSearch::search("computer", 10);
		$b = true;
		for($i = 0; $i < 10; $i ++){
			if ( strpos($a[$i]->getTitle(), 'halfond') === false 
				&& !in_array("halfond", $a[$i]->getAuthors())) {
				$b = false;
			}
		}
		$this->assertEquals(false, $b);
	}

	// test searchConference function
	// test on getting the correct articles with pubNumber
	public function testSearchConference1() {
		$a = IeeeSearch::searchConference(5004);
		$flag = true;
		for($i = 0; $i < count($a); $i++){
			if($a[$i]->getPubNumber() != 5004)
				$flag = false;
		}
		$this->assertEquals(true, $flag);
	}

	// test if pubNumber matches the conference
	public function testSearchConference2() {
		$a = IeeeSearch::searchConference(5004);
		$b = "Frontiers in Education Conference, 1997. 27th Annual Conference."
			." Teaching and Learning in an Era of Change. Proceedings.";
		$this->assertEquals($b, $a[0]->getPubTitle());
	}
}

?>