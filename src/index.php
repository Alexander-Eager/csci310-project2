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

        <div id="search-box" style="display:inline">
            Search: <input type="text" id="search-term">
            <button id="search-btn" onClick="doSearch($('#search-term').val().toLowerCase(), $('#resultN').val())">Search</button>
        </div>

<script language="javascript">
  function doSearch(searchTerm, numResults) {
    location.href = 'http://localhost/csci310-project2/search.php?searchTerms=' + searchTerm + '&numResults=' + numResults;
  }
</script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


</div>

</div>


</body>
</html>