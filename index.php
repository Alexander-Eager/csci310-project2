<html>
<head>

<title>Scholar Search</title>

<link href="ut2style.css"
rel="stylesheet" type="text/css" />

</head>
<body>

<div id="maincontent">

<div id="header">
<img src="searchlogo.jpg" />
</div>



	<div id="search-box">
Results:
<select id="resultN" >
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10" selected="selected">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
</select>

<script language="javascript">
function send()
{document.theform.submit()}
</script>

<form action="/search" method="get" class="sfm" name="theform" style="display:inline;">
    <input type="text" name="q" value="" id="sf"/>
</form>
	</div>

</div>


</body>
</html>