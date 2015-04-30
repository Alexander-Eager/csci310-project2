<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Scholar Search Word Cloud Page</title>
	<style>
		body {
			float: center;
			/* Center align */
			font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif, clavo, adelle, 
			font-weight: bold;
			/* Several fonts allows backup ones to be chosen if the first ones are not found */
			color: #FFCC00;
		}

		a:link {
			text-decoration: none;
			color: 000014;
		}

		a:hover {
			text-decoration: underline;
			/* Improved UI, allow use to see the word underline */
			color: #0000FF;
			/* Change colors to custom, previous was too basic*/
		}

		a:visited {
			text-decoration: none;
			color: #330080;
			/* These ones too*/
		}

		#websitetitle {
			margin-left: 51px;
			text-align: center;
		}
		
		#logo {
			/* Original postioning was off and no professional*/
			width: 141px;
			height: 141px;
		}

		#cloudBox {
  			position: absolute; 
			top: 145px;
			left:21%;
		}

		#submit {
			clear:left;
   			position: absolute; 
			bottom: 3em;
			left: 31%;
		}

		#backButton {
			clear:left;
  			position: absolute; 
			left: 13em;
			bottom: 1em;
			width:101px;
			height:41px;
		}

		#downloadButton {
			/* Download not implemented set for next iteration */
			clear:left;
  			position: absolute; 
			left: 39em;
			bottom: 1em;
			width:101px;
			height:41px;
		}

		#wordCloud {
			/* Tweaked some values */
			height: 601px;
			width: 76%;
  			position: absolute; 
			top: 96px;
			left:16%;
			overflow-y: scroll;
			padding: 11px;
			line-height: 31px;
			background-color: gray;
			border: 1px solid #FAFAF2;
		}
	</style>
</head>
<body>
	<div id = "websitetitle">
		<img src="searchlogo.jpg" id="logo" />
	</div>

		<p id = "wordCloud" style = "background-color:white;">
			<?php
				include_once("autoload_manager.php");

				// gets all of the text from the articles and uses it to make
				// a word cloud
				$searchTerms = urldecode($_GET["searchTerms"]);
				$numResults = urldecode($_GET["numResults"]);
				$articles = IeeeSearch::search($searchTerms, $numResults);
				$text = "";
				foreach ($articles as $article) {
					$text .= $article->getAbstract() . " ";
					$text .= implode(" ", $article->getAuthors()) . " ";
				}
				$content = new WordCloudArray($text);
				echo $content->generateWordCloud($content->getMap());
			?>
		</p>
		
		</textarea>
		<div id = "submit">
				<br>
				<br>
				<button type = "button" id = "backButton"
							onClick = "location.href = '/index.php'">
						Back
				</button>
				<button type = "button" id = "downloadButton"
							onClick = "alert('Not Implemented Yet')">
					Download
				</button>
		</div>
</body>
</html>