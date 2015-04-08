<?php

//include ('src/googleScholarSearch.php');
class ArticleTest extends PHPUnit_Framework_TestCase
{
	public function testRetrieveArticles()
	{
		$articles = new Articles( 'halfond', 15 );
		$this->assertEquals( count($articles), 15 );		
	}
	// phpunit --bootstrap googleScholarSearch.php googleScholarSearchTest.php;
}
?>