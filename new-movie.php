<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Make/Update Movie</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<div class="banner">
		<img class="banner-centered" src="images/rancidbanner.png"
			alt="Rancid Tomatoes">
</div>

<h1>Add Movie</h1>

<br>
<form action = "new-movie.php">
	<h4>Title
	<input type = "text" name = "title">
	</h4>

	<h4>Image 
	<input type = "text" name = "image">
	</h4>

	<h4>Director
	<input type = "text" name = "director">
	</h4>

	<h4>Rating 
	<input type = "radio" name = "rating" value = "g"> G
	<br>
	<input type = "radio" name = "rating" value = "pg"> PG
	<br>
	<input type = "radio" name = "rating" value = "r"> R
	</h4>

	<h4>Year 
	<input type = "number" name = "year">
	</h4>

	<h4>Runtime 
	<input type = "number" name = "runtime">
	</h4>

	<h4>Box Office
	<input type = "number" name = "tickets">
	</h4>

	<input type = "submit" value = "Add Movie">
</form>

<br><br>
<a href = "index.php">Cancel</a>

</body>


</html>