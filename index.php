<?php
// Start the session
session_start();

   if( isset( $_SESSION['counter'] ) )
   {
      $_SESSION['counter'] += 1;
   }
   else
   {
      $_SESSION['counter'] = 1;
   }

   	if( !isset( $_SESSION['username'] ) )
   	{
		$_SESSION['username'] = "undefined";
	}
   $msg = "You have visited this page ".  $_SESSION['counter'];
   $msg .= " in this session.<br>";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Index</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

	<?php
	// Set session variables
	$_SESSION['favanimal'] = "cat";
	echo "Session variables are set.<br>";
	echo $msg;
	$username = "username: " . $_SESSION['username'];
	echo $username;
	?>

<h1>Index</h1>
<a href="title.html">Title</a><br>
<a href="review.html">Review Page</a><br>
<a href="login-register.php">Login/Register Reviewer</a><br>
<a href="new-review.html">Make/Update Review</a><br>
<a href="new-movie.html">Make/Update Movie</a><br>
<a href="clear-session.php">Clear session data</a><br>

	<div class="search">
			Search <input type="text" id="text-search" oninput="getTitles()" onkeypress="getReview(event)">
	</div>
	<br><br>
	<p>Suggested titles: </p>
	<br>
	<div id="movie-titles" class="title-box"></div>
	<div id="test-data" class="title-box"></div>

	<script>

		var titlesArray = [];

	    function getReview(e){

	    	document.getElementById("test-data").innerHTML= "<?php echo ($_SESSION["username"]) ?>";
	    	document.getElementById("movie-titles").innerHTML = "(No movie titles match this search)";
        	if(e.keyCode === 13){
        		var review2get = document.getElementById("text-search").value;
        		var titlesArrayAsString = titlesArray.toString();

        		//alert(titlesArray.indexOf(review2get)); // + titlesArray.indexof(review2get));
        		if (titlesArray.indexOf(review2get)==-1){
        			alert("This movie as typed does not yet exist in our database.");
        		} else {
        			alert("Movie found: " + review2get);
        		}
        	}

        	return false;
    	}

		function getTitles(){
			 var titleString = document.getElementById("text-search").value;
			 var xhttp = new XMLHttpRequest();

			 // This anonymous callback will execute when the server responds
			 xhttp.onreadystatechange = function() {

			 var response = "" + xhttp.responseText.toString();

			 // States 0 1 2 3 4 (4 means success)
			 // 404 would be bad xhttp.status, 200 is good
			 if (xhttp.readyState == 4 && xhttp.status == 200) {
					var resultArray = JSON.parse(response);

					var resultString = "";
					titlesArray = [];

					if (resultArray.length==0){
						document.getElementById("movie-titles").innerHTML = "(No movie titles match this search)";
					}
					else{
						for ( i = 0; i<resultArray.length; i++){
							resultString = resultString + resultArray[i] + "<br>";
							titlesArray.push(resultArray[i]);
						}

						//Values for first box
						var first10 = "";
						for ( i = 0; i<resultArray.length; i++){
							if (i>=10){
								 break;
							}
							first10 = first10 + resultArray[i] + "<br>";
						}
						document.getElementById("movie-titles").innerHTML = first10;
					}
			 }
		 }
		// Can use POST or GET
		xhttp.open("GET", "movieSearchController.php?titleString=" + titleString, true);
		xhttp.send();
		 }
	</script>


</body>


</html>