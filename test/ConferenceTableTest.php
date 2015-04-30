<?php

include("../src/autoload_manager.php");

class ConferenceTableTest extends PHPUnit_Framework_TestCase {

	// test createrowforarticle function
	// test title
	public function testCreateRowForArticle1() {
		$article = new Article("title",array(),0,"","","");
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td>title</td><td></td><td>0</td><td></td><td>"
		."</td></tr>";
		$this->assertEquals($row,$ans);
	}
	
	// test publish year
	public function testCreateRowForArticle2() {
		$article = new Article("",array(),2010,"","","");
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td></td><td></td><td>2010</td><td></td><td></td>"
		."</tr>";
		$this->assertEquals($row,$ans);
	}

	// test article number
	public function testCreateRowForArticle3() {
		$article = new Article("",array(),0,"","",10101010);
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td></td><td></td><td>0</td><td></td>"
		."<td>10101010</td></tr>";
		$this->assertEquals($row,$ans);
	}

	// test generatearticletable function
	// test1
	public function testGenerateConferenceTable1() {
		$article_1 = new Article("title1",array(),"","","","");
		$article_2 = new Article("title2",array(),"","","","");
		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);
		$table = "<table><tr><th>Title</th><th>Author(s)</th>"
		."<th>Publication Year</th><th>Publication Title</th>"
		."<th>Article Number</th></tr>"
		."</table>";
		$this->assertEquals($table,$ans);
	}

	// test2
	public function testGenerateConferenceTable2() {

		$article_1 = new Article("",array("halfond"),"","","","");
		$article_2 = new Article("",array("sonal"),"","","","");
		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);
		$table = "<table><tr><th>Title</th><th>Author(s)</th>"
		."<th>Publication Year</th><th>Publication Title</th>"
		."<th>Article Number</th></tr>"
		."</table>";
		$this->assertEquals($table,$ans);
	}
}

?>