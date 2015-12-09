<?php
	require_once("./functions.php");
	$movie =  $_GET['movie'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Rancid Tomatoes - Movie Review</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

<?php
	if( !isset( $_SESSION['username'] ) )
   	{
		$_SESSION['username'] = "Not logged in";
	}

	$username = $_SESSION['username'];
	echo $username;
	echo $movie;
	if( isset( $_SESSION['message'] ) )
    {
        echo "<script type=\"text/javascript\">alert(\"" . $_SESSION['message'] . "\");</script>";
        unset( $_SESSION['message']);
    }
    $_SESSION['movie'] = $movie;
?>

<div class="banner">
		<img class="banner-centered" src="images/rancidbanner.png"
			alt="Rancid Tomatoes">
	</div>
	
	<?=getHeader($movie)?>

	<!-- The big box -->
	<div class="big-container">

		<div class="left-section">
			<!-- RATING STUFF -->
			<div class="rating-box">
				<?=getRatingStuff($movie)?>
			</div>
			<!-- REVIEWS -->
			<div class="reviews-box">
				<?=getReviews($movie, $username)?>
			</div>	
		</div>
			<?=getOverviewContent($movie)?>
	</div>

		<div class="footer">
			<p><a href="index.php">Return to Home Page</a></p>
		</div>
		<!-- Big box end -->
	</div>

<br>



</body>


</html>