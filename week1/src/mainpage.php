<html>
<head>
<title>Welcome to Document Finder</title>

<link href="lyricfloatstyle.css"
rel="stylesheet" type="text/css" />

</head>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>


function button() {
  var output = document.getElementById('searchBarID').value;
  console.log(output);

  $.getJSON("http://developer.echonest.com/api/v4/artist/search?api_key=MAXGKMP2FOIUOIZBV&format=json&name="
                +output+"&results=1",
        function(data){

  
            var link = data.response.artists[0].id;
            
            console.log(link);

            location.href='WordCloudPage.php?artists=' + link;
        });

}

function reqListener () {

  obj = JSON.parse(this.responseText);
  //var artistName = obj.results.artists[0].name;
  console.log(obj.results);
}

function clearChildren( parent_id ) {
    var childArray = document.getElementById( parent_id ).children;
    if ( childArray.length > 0 ) {
        document.getElementById( parent_id ).removeChild( childArray[ 0 ] );
        clearChildren( parent_id );
    }
}

function a(){

  var input = document.getElementById('searchBarID').value;

  $.getJSON("http://developer.echonest.com/api/v4/artist/search?api_key=MAXGKMP2FOIUOIZBV&format=json&bucket=images&name="
                +input+"&results=5",
        function(data){

            console.log(document.getElementById('searchBarID').value);
            for (i = 0; i < data.response.artists.length; i++){
                console.log(data.response.artists[i].name);

            } 
            
            var dataList = $("#artists");
            dataList.empty();

            var artists = data.response.artists;
            for(i = 0; i < data.response.artists.length; i++){
              var optionElement = document.createElement("option");
              optionElement.value = data.response.artists[i].name;
              document.getElementById("artists").appendChild(optionElement);
            }

        });

  //console.log(oReq.responseText);

  

}


/*$(document).keypress(function(e) {

  var oReq = new XMLHttpRequest();
  var path="http://developer.echonest.com/api/v4/artist/blogs?api_key=MAXGKMP2FOIUOIZBV&id=ARH6W4X1187B99274F&format=json&results=1&start=0";
  oReq.onload = reqListener;
  oReq.open("GET", path, true);
  oReq.send();
    
});*/
   
</script>

<body style = "text-align: center;">

<div id="websitetitle" style="text-align: center;">
LyricFloat
</div>

</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>

<div class = "anybox" id = "searchBar">
<datalist id="artists"></datalist>
<input list="artists" type="text" id="searchBarID" onkeyup="a()" autocomplete="on">
</div>
<br/>
  <!---grabs data from artists input list-->
<div id="subbutton" class="button" onclick = "button()">
Submit
</div>



  
  <br/><br/>
  








<!---<script>
    var heroes = [
        "Abaddon",
        "Alchemist",
        "Ancient Apparition",
        "Anti-Mage",
        "Axe",
        "Bane",
    ];

    for (var key in heroes) {
        var optionElement = document.createElement("option");
        optionElement.value = heroes[key];
        document.getElementById("heroes").appendChild(optionElement);
    }
</script>-->
  


  
</div>

 </body>

</html>


