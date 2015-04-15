<html>
<head>

    <title>
        Scholar Search
    </title>

    <link href="ut2style.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="maincontent">

    <!-- This is the main logo that you see front and center on the web page. -->
    <div id="header">
        <img src="searchlogo.jpg" />
    </div>

    <!-- Everything in here is the form that the user interacts with -->
    <div id="search-box">
        Results:
        <!-- Drop down box for the number of results to obtain -->
        <select id="resultN" >
            <option value="1">
                1
            </option>
            <option value="2">
                2
            </option>
            <option value="3">
                3
            </option>
            <option value="4">
                4
            </option>
            <option value="5">
                5
            </option>
            <option value="6">
                6
            </option>
            <option value="7">
                7
            </option>
            <option value="8">
                8
            </option>
            <option value="9">
                9
            </option>
            <option value="10" selected="selected">
                10
            </option>
            <option value="11">
                11
            </option>
            <option value="12">
                12
            </option>
            <option value="13">
                13
            </option>
            <option value="14">
                14
            </option>
            <option value="15">
                15
            </option>
            <option value="16">
                16
            </option>
            <option value="17">
                17
            </option>
            <option value="18">
                18
            </option>
            <option value="19">
                19
            </option>
            <option value="20">
                20
            </option>
        </select>

        <!-- This has the input bar and the submit button -->
        <div id="search-box2" style="display:inline">
            Search:
            <input type="text" id="search-term">
            <button id="search-btn" onClick="doSearch($('#search-term').val().toLowerCase(), $('#resultN').val())">
                Search
            </button>
        </div>

        <!-- Script that the submit button from above uses -->
        <script language="javascript">
            // executes the user's requested search for searchTerm, with a maximum of numResults
            function doSearch(searchTerm, numResults) {
                location.href = 'http://localhost/search.php?searchTerms=' + searchTerm + '&numResults=' + numResults;
            }
        </script>

        <!-- This script is necessary for our above script to work -->
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    </div>

    </div>
</body>

</html>