<?php 
 /*
    Programmer: Kris Cabulong $ Adrianna Ortiz-Flores
	CSC 337: Final Project	

 */

	include 'DatabaseAdaptor.php';
	//grants access to $moviesArray = $myDatabaseFunctions->getAllMoviesAsArray();
	session_start();

 /*
    Generates an h1 header
 */
function getHeader($movie){
//	$file = file_get_contents('movie_files/'.$film.'/info.txt');
//	$array = explode(PHP_EOL,$file);
	$myDatabaseAdaptor = new DatabaseAdaptor();
	$title = $movie;
	$year =  "" . $myDatabaseAdaptor->getMovieYear($title);

	$header = '<h1>' . $movie . ' (' . $year . ')</h1>';


	return $header;
}



/*
	Let's consolidate the rating stuff!
*/
function getRatingStuff($film){
	$myDatabaseAdaptor = new DatabaseAdaptor();
	$freshness = $myDatabaseAdaptor->getMovieFreshness($film);
	$image = "";

	if ($freshness<60){
		$image = '<img class="bottom" src="movie_files/images/rottenlarge.png" alt="Rotten" />';
	} else{
		$image = '<img class="bottom" src="movie_files/images/freshlarge.png" alt="Fresh" />';
	}
	//return getRatingImage($film).rating.'%';
	return $image.$freshness.'%';
}


/*
	Gets the poster for the movie
*/
function getOverviewImage($film){

	if(strcmp($film,"The Princess Bride")==0){

	}

	return '<img src="movie_files/'.$film.'/overview.png" alt="general overview" />';
}

/*
	Regardless of differences in other dt's this will ensure that they
	will all be printed. Why is it called "getTheRest"? Well, I originally had
	three other brilliant functions to get the stars, directors, producers, but
	THEN I found out what semicolons do. 
*/
function getTheRest($film){

	$myDatabaseAdaptor = new DatabaseAdaptor();
	$record = $myDatabaseAdaptor->getMovieRecord($film);

	$result = "";
	$result = $result . "<dt>Title</dt>";
		$result = $result . "<dd>" . $record[2] . "</dd>";
	$result = $result . "<dt>Director</dt>";
		$result = $result . "<dd>" . $record[4] . "</dd>";
	$result = $result . "<dt>Year</dt>";
		$result = $result . "<dd>" . $record[5] . "</dd>";
	$result = $result . "<dt>Rating</dt>";
		$result = $result . "<dd>" . $record[6] . "</dd>";
	$result = $result . "<dt>Runtime</dt>";
		$result = $result . "<dd>" . $record[7] . "</dd>";

	$result = $result . "<dt>Box Office</dt>";
		$result = $result . "<dd>$ " . number_format($record[8]) . "</dd>";
	
	return $result;
}

/*
	A clean function that uses other functions to enerate the whole overview box
*/
function getOverviewContent($film){
	return '<div class="overview">
			<div>'.
				getOverviewImage($film).
			'</div>

			<div class="overview-text">

				<dl>
					'.
						getTheRest($film)
					.'
				</dl>

			</div>';

}

/*
	Was feeling a lot more confident with php by then, here is
	where I generate each review.
*/
function getReviews($film){
	$myDatabaseAdaptor = new DatabaseAdaptor();
	$reviewsArray = $myDatabaseAdaptor->getAllReviewsAsArrayByMovie($film);
	

//	$files = glob('movie_files/'.$film.'/review*.txt');
	$i = 0;
	$half = 1000;	/* arbitrarily high */

	if(sizeof($reviewsArray)>=2){			/*catches where there is only one review*/
		$half = sizeof($reviewsArray)/2;	/*well, the opposite, but you get what I'm doing.*/
	}

	$result = '<div class="col-reviews">';

	foreach ($reviewsArray as $row){

		$string_version = implode('#', $row);
		$array = explode('#', $string_version);

	
		$review = $array[2];
		
		/*If at the halfway point, start the second column*/
		if ($i>=$half){
			$result = $result .'</div><div class="col-reviews">';
		}

		$result = $result . '<p class="quote">';
			if (strcmp($array[3],"ROTTEN")==0){
				$result = $result . '<img class="bottom" src="movie_files/images/rotten.gif" alt="Rotten" />';
			} else{
				$result = $result . '<img class="bottom" src="movie_files/images/fresh.gif" alt="Fresh" />';
			}
		$result = $result . '<q>'. $review .'</q>';
		$result = $result . '</p>';
		
		$result = $result . '<p> <img class="icon bottom" src="images/critic.gif" alt="Critic" />'.
					$array[4].
					'<br/><i>'.
					$array[5].
					'</i></p>';

		 $i++;
	}

	$result = $result . '</div>';
	return $result;
}


?>