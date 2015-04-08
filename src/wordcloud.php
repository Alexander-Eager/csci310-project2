<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Word Cloud Page</title>

	<style>
		body {
<<<<<<< HEAD
			background-color: gray;
			padding: 30px;
		}

		#websitetitle {
			color: black;
			font-family: Lucida Handwriting;
			font-size: 50px;	
		}
=======
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

>>>>>>> fcdfde5466696c47fcc7219a4147142e876937dc
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
<<<<<<< HEAD
			background: purple;
=======
>>>>>>> fcdfde5466696c47fcc7219a4147142e876937dc
		}
		#downloadButton{
			clear:left;
  			position: absolute; 
			left: 30em;
			width:100px;
			height:40px;
<<<<<<< HEAD
			background: purple;
=======
>>>>>>> fcdfde5466696c47fcc7219a4147142e876937dc
		}
		#wordCloud{
			height: 300px;
			width: 66%;
  			position: absolute; 
<<<<<<< HEAD
			top: 20%;
=======
			top: 40%;
>>>>>>> fcdfde5466696c47fcc7219a4147142e876937dc
			left:19%;
			size: <?php echo "$size"; ?>;
			overflow-y: scroll;
			padding: 10px;
		}
		</style>
</head>
<body>
<<<<<<< HEAD
<center id = "websitetitle">Scholar Search</center>
=======
<div id = "websitetitle"><img src="searchlogo.jpg" id="logo" /></div>

>>>>>>> fcdfde5466696c47fcc7219a4147142e876937dc
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