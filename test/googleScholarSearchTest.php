<?php

include ('src/googleScholarSearch.php');
class articles extends PHPUnit_Framework_TestCase
{
	public function testRetrieveArticles()
	{

		$articles = retrieveArticles( 'halfond', 10 );
		$this->assertEquals( count($articles), 10 );		
	}
	// phpunit --bootstrap googleScholarSearch.php googleScholarSearchTest.php;
}
?>