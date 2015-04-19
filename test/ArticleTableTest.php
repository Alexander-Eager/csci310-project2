<?php

// given an article, do i make the correct row?
// now that i have a list of articles, do i have the correct table?

include('../src/ArticleTable.php');

class ArticleTableTest extends PHPUnit_Framework_TestCase {
	// test createrowforarticle function
	// test title
	public function testCreateRowForArticle1() {
		$article = new Article("title","","","","","");
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td>title</td><td></td><td></td><td></td><td>"
		."</td><td></td></tr>";
		$this->assertEquals($row,$ans);
	}
	// test publish year
	public function testCreateRowForArticle2() {
		$article = new Article("","","2010","","","");
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td></td><td></td><td>2010</td><td></td><td></td>"
		."<td></td></tr>";
		$this->assertEquals($row,$ans);
	}
	// test article number
	public function testCreateRowForArticle3() {
		$article = new Article("","","","","","10101010");
		$ans = ArticleTable::createRowForArticle($article);
		$row = "<tr><td></td><td></td><td></td><td></td><td></td>"
		."<td>10101010</td></tr>";
		$this->assertEquals($row,$ans);
	}
	// test generatearticletable function
	// test1
	public function testGenerateArticleTable1(){

		$article_1 = new Article("title1","","","","","");
		$article_2 = new Article("title2","","","","","");
		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);
		$table = "<table><tr><th>Title</th><th>Author(s)</th>"
		."<th>Publication Year</th><th>Publication Title</th>"
		."<th>Article Number</th></tr>"
		."<tr><td>title1</td><td></td><td></td><td></td><td>"
		."</td><td></td></tr>"
		."<tr><td>title2</td><td></td><td></td><td></td><td>"
		."</td><td></td></tr>"
		."</table>";
		$this->assertEquals($table,$ans);
	}
	// test2
	public function testGenerateArticleTable2(){

		$article_1 = new Article("","halfond","","","","");
		$article_2 = new Article("","sonal","","","","");
		$articles = array($article_1, $article_2);
		$ans = ArticleTable::generateArticleTable("halfond", $articles);
		$table = "<table><tr><th>Title</th><th>Author(s)</th>"
		."<th>Publication Year</th><th>Publication Title</th>"
		."<th>Article Number</th></tr>"
		."<tr><td></td><td>halfond</td><td></td><td></td><td>"
		."</td><td></td></tr>"
		."<tr><td>title2</td>sonal<td></td><td></td><td></td><td>"
		."</td><td></td></tr>"
		."</table>";
		$this->assertEquals($table,$ans);
	}

}

?>
