<?php
	
include("../src/autoload_manager.php");

// helper function
// test if two arrays have the same elements, order does not matter
function arrays_are_similar($a, $b) {
	if (count(array_diff_assoc($a, $b))) {
		return false;
	}
	foreach($a as $k => $v) {
		if ($v !== $b[$k]) {
		    return false;
		 }
	 } 
	return true;
}


class WordCloudArrayTest extends PHPUnit_Framework_TestCase{
	// test if common words and tags are ignored
	public function testReturnWords_1() {
		$a = new WordCloudArray("There are lots of common<br> words** in" 
			."this sentence.");
		$b = $a -> returnWords("There are lots of common<br> words** in "
			."this sentence.");
		$c = array("common" => 1, "sentence" => 1, "are" => 1, "lots" => 1, 
			"words" => 1);
		$this->assertTrue(arrays_are_similar($c, $b));
	}

	// test if common words and tags are ignored
	public function testReturnWords_2() {
		$a = new WordCloudArray("There's *******nothing wrong "
			."<span style=\"background-color: yellow\"> with "
			."</span>loving who you are\"
		<br>She said, \"Cause he made you perfect, babe\"
		So hold your head up girl and you'll go far,
		Listen to me when I say nothing");
		$b = $a -> returnWords("There's *******nothing wrong "
			."<span style=\"background-color: yellow\"> with "
			."</span>loving who you are\"
		<br>She said, \"Cause he made you perfect, babe\"
		So hold your head up girl and you'll go far,
		Listen to me when I say nothing");
		$c = array("nothing" => 2, "wrong" => 1, "loving" => 1, "are" => 1, 
			"said" => 1,"cause" => 1, "made" => 1, "perfect" => 1, 
			"babe" => 1, "hold" => 1, "head" => 1, "girl" => 1, "far" => 1, 
			"listen" => 1);
		$this->assertTrue(arrays_are_similar($c, $b));
	}

	// test cnnstruct function
	public function testConstruct() {
		$a = new WordCloudArray("");
		$a -> __construct("There's *******nothing wrong "
			."<span style=\"background-color: yellow\"> with "
			."</span>loving who you are\"
		<br>She said, \"Cause he made you perfect, babe\"
		So hold your head up girl and you'll go far,
		Listen to me when I say nothing");
		$b = array("nothing" => 2, "wrong" => 1, "loving" => 1, "are" => 1, 
			"said" => 1,"cause" => 1, "made" => 1, "perfect" => 1, 
			"babe" => 1, "hold" => 1, "head" => 1, "girl" => 1, "far" => 1, 
			"listen" => 1);
		$c = $a->getMap();
		$this->assertTrue( arrays_are_similar($c, $b) );
	}

	// test getMap function
	// need to make map variable public
	public function testGetWord() {
		$a = new WordCloudArray("There's *******nothing wrong "
			."<span style=\"background-color: yellow\"> with "
			."</span>loving who you are\"
		<br>She said, \"Cause he made you perfect, babe\"
		So hold your head up girl and you'll go far,
		Listen to me when I say nothing");
		$b = array("nothing" => 2, "wrong" => 1, "loving" => 1, "are" => 1, 
			"said" => 1,"cause" => 1, "made" => 1, "perfect" => 1, 
			"babe" => 1, "hold" => 1, "head" => 1, "girl" => 1, "far" => 1, 
			"listen" => 1);
		$c = $a->getMap();
		$this->assertTrue( arrays_are_similar($c, $b) );
	}

	// test word size function
	// should all be in the range of 15-70 
	public function testWordSize1(){
		$a = new WordCloudArray("");
		$fontsize = $a->wordSize(6,6);
		$this->assertEquals( "70px", $fontsize );
	}

	public function testWordSize2(){
		$a = new WordCloudArray("");
		$fontsize = $a->wordSize(3,6);
		$this->assertEquals( "42.5px", $fontsize );
	}

	// test generate word cloud function
	public function testGenerateWordCloud1() {
		$a = new WordCloudArray("hello hello professor halfond");
		$b = $a->generatewordcloud($a->getMap(),"searchTerm",10);
		$this->assertEquals( "<a href=\"/articlesWithWord.php?"
			. "word=hello&searchTerms=searchTerm&numResults=10\">"
			. "<span style = \"font-size: 70px\">hello</span></a>  "
			. "<a href=\"/articlesWithWord.php?"
			. "word=professor&searchTerms=searchTerm&numResults=10\">"
			. "<span style = \"font-size: 42.5px\">professor</span></a>  "
			. "<a href=\"/articlesWithWord.php?"
			. "word=halfond&searchTerms=searchTerm&numResults=10\">"
			. "<span style = \"font-size: 42.5px\">halfond</span></a>  ", $b);
	}
}

?>