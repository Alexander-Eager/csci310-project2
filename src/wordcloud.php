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

		#websitetitle {
			margin-left: 50px;
		}
		
		#logo {
			width: 140px;
			height: 140px;
		}

		#cloudBox{
  			position: absolute; 
			top: 13em;
			left:22%;
		}
		#submit{
			clear:left;
   			position: absolute; 
			bottom: 3em;
			left: 30%;
		}

		#backButton{
			clear:left;
  			position: absolute; 
			left: 8em;
			width:100px;
			height:40px;
		}
		#downloadButton{
			clear:left;
  			position: absolute; 
			left: 30em;
			width:100px;
			height:40px;
		}
		#wordCloud{
			height: 300px;
			width: 66%;
  			position: absolute; 
			top: 40%;
			left:19%;
			size: <?php echo "$size"; ?>;
			overflow-y: scroll;
			padding: 10px;
		}
		</style>
</head>
<body>
	<div id = "websitetitle"><img src="searchlogo.jpg" id="logo" /></div>

			<?php
				include("wordCloudArray.php");
			?>

				<p id = "wordCloud" style = "background-color:white;">
					<?php
					$text = $_GET["text"];
					$content = new WordCloudArray($text);
					echo $content->generatewordcloud($content->getMap());
					?>
				</p>
		
		
		</textarea>
		<div id = "submit">
				<br>
				<br>
				<form action:"/index.php">
					<button type = "button" id = "backButton">Back</button>
				<form>
					<button type = "button" id = "downloadButton">Download</button>
		</div>
</body>
</html>