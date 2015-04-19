<html>
<head>

    <title>
        Scholar Search
    </title>

    <link href="ut2style.css" rel="stylesheet" type="text/css" />

</head>

<body>


<?php


	include("ArticleTable.php");

	$table = generateArticleTable($word);

	echo $table;

?>




 
</body>

</html>