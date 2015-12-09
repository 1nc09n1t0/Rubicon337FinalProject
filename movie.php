<!-- 
Kristoffer Cabulong
CSc 337 Final Project: Rancid Tomatoes Redux

 -->

<?php 
  require_once("./functions.php");
 $film = $_GET["film"];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Rancid Tomatoes</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

	<div class="banner">
		<img class="banner-centered" src="images/rancidbanner.png"
			alt="Rancid Tomatoes">
	</div>
	
	<?=getHeader($film)?>

	<!-- The big box -->
	<div class="big-container">

		<div class="left-section">
			<!-- RATING STUFF -->
			<div class="rating-box">
				<?=getRatingStuff($film)?>
			</div>
			<!-- REVIEWS -->
			<div class="reviews-box">
				<?=getReviews($film)?>
			</div>	
		</div>
			<?=getOverviewContent($film)?>
		</div>

		<div class="footer">
			<p>ADVERTISEMENT GOES HERE</p>
		</div>
		<!-- Big box end -->
	</div>

</body>
</html>
