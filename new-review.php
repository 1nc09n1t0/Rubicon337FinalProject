<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Create a Review</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<div class="banner">
		<img class="banner-centered" src="images/rancidbanner.png"
			alt="Rancid Tomatoes">
</div>

<h1>Create Review</h1>

<br>

<form action = "new-review.php">
	<h4>Movie Title: 
	<input type = "text" name = "movie_title">
	</h4>

	<h4>Name: 
	<input type = "text" name = "user_name">
	</h4>

	<h4>Publication: 
	<input type = "text" name = "user_publication">
	</h4>

	<h4>Review <textarea name = "review_body" rows = "5" cols = "30" required></textarea></h4>

	<h4>Rating 
	<input type = "radio" name = "user_rating" value = "rotten" required> Rotten
	<br>
	<input type = "radio" name = "user_rating" value = "fresh" required> Fresh
	</h4>

	<input type = "submit" value = "Add Review"
</form>

<br><br>
<a href = "title.html">Cancel</a>

</body>


</html>