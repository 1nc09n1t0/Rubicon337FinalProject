<?php
 	session_start();
 	$reviewId = $_SESSION['reviewId']; 
 	$movie = $_SESSION['movie'];
 	$author = $_SESSION['author'];
 	$publication = $_SESSION['publication'];
 	$review = $_SESSION['review'];
 	$isFresh = $_SESSION['isFresh'];
 	echo "publication: " . $publication;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Create a Review</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

	<header>
    	<img src="images/rancidbanner.png" alt="Rancid Tomatoes">
	</header>

	<div class = "newReview_container">
		<h1>Create Review</h1>

		<br>
		<div class = "review">

		<div class = "review-form">
		<form id = "review-form" action = "login-controller.php">
			<h4>Movie Title: 
				<input type = "text" name = "movie_title"  value="<?=$movie?>" readonly>
			</h4>

			<h4>Name: 
				<input type = "text" name = "author"  value="<?=$author?>" readonly>
			</h4>

			<h4>Publication: 
				<input type = "text" name = "user_publication"  value="<?=$publication?>" readonly>
			</h4>

			<h4>Review: 
				<textarea name = "review_body" rows = "5" cols = "30" required><?=$review?></textarea></h4>

			<h4>Rating: 
				<div class = "rate">
					<input id="rotten" type = "radio" name = "user_rating" value = "rotten" required> Rotten
				</div>
				<div class = "rate">
					<input id="fresh" type = "radio" name = "user_rating" value = "fresh" required> Fresh
				</div>
			</h4>


			<input type = "hidden" name ="reviewId" value = "<?=$reviewId?>">

			<input type = "hidden" name ="action" value = "finishReview">

			<input type = "submit" value = "Add Review">
		</form>
		</div>

		
		<br>
		</div>
		<div class = "cancel">
			<a href = "review.php?movie=<?=$movie?>" >Cancel</a>
		</div>

<script type="text/javascript">
if (("ROTTEN").localeCompare("<?=$isFresh?>")==0){
	document.getElementById("rotten").checked = true;
}

if (("FRESH").localeCompare("<?=$isFresh?>")==0){
	document.getElementById("fresh").checked = true;
}


</script>

</div>

</body>


</html>