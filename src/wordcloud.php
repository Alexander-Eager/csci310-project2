<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Word Cloud Page</title>

	<style>
		body {
			float: center;
			font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
			font-weight: bold;
		}

		a:link {
			text-decoration: none;
			color: black;
		}

		a:hover {
			text-decoration: underline;
			color: blue;
		}

		a:visited {
			text-decoration: none;
			color: purple;
		}

		#websitetitle {
			margin-left: 50px;
			text-align: center;
		}
		
		#logo {
			width: 140px;
			height: 140px;

		}

		#cloudBox {
  			position: absolute; 
			top: 145px;
			left:22%;
		}

		#submit {
			clear:left;
   			position: absolute; 
			bottom: 3em;
			left: 30%;
		}

		#backButton {
			clear:left;
  			position: absolute; 
			left: 13em;
			bottom: 1em;
			width:100px;
			height:40px;
		}

		#downloadButton {
			clear:left;
  			position: absolute; 
			left: 39em;
			bottom: 1em;
			width:100px;
			height:40px;
		}

		#wordCloud {
			height: 600px;
			width: 75%;
  			position: absolute; 
			top: 145px;
			left:15%;
			overflow-y: scroll;
			padding: 10px;
		}
	</style>
</head>
<body>
	<div id = "websitetitle">
		<img src="searchlogo.jpg" id="logo" />
	</div>

		<?php
			include("wordCloudArray.php");
			include("IeeeSearch.php");
		?>

		<p id = "wordCloud" style = "background-color:white;">
			<?php
				// gets all of the text from the articles and uses it to make
				// a word cloud
				$searchTerms = $_GET["searchTerms"];
				$numResults = $_GET["numResults"];
				$articles = IeeeSearch::search($searchTerms, $numResults);
				$text = "";
				foreach ($articles as $article) {
					$text .= $article->getAbstract();
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
							onClick = "location.href = '/src/index.php'">
						Back
				</button>
				<button type = "button" id = "downloadButton"
							onClick = "alert('Not Implemented Yet')">
					Download
				</button>
		</div>
</body>
</html>