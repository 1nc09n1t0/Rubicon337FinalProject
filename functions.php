<?php 
 /*
    Programmer: Kris Cabulong
	CSC 337 Assignment 5
	A bit of a rush job, was fun though, felt like a hackathon. 
	50 minutes to spare!

 */


 /*
    Generates an h1 header
 */
function getHeader($film){
	$file = file_get_contents('movie_files/'.$film.'/info.txt');
	$array = explode(PHP_EOL,$file);
	$header = '<h1>' . $array[0] . ' (' . $array[1] . ')</h1>';

	return $header;
}

 /*
    Pulls out a rating from the file
 */
function getRating($film){
	$file = file_get_contents('movie_files/'.$film.'/info.txt');
	$array = explode(PHP_EOL,$file);
	return $array[2];
}

/*
	Chooses the appropriate image based on the rating. 
*/
function getRatingImage($film){
	$file = file_get_contents('movie_files/'.$film.'/info.txt');
	$array = explode(PHP_EOL,$file);
	$rating = $array[2];

	if ($rating<60){
		return '<img class="bottom" src="movie_files/images/rottenlarge.png" alt="Rotten" />';
	} else{
		return '<img class="bottom" src="movie_files/images/freshlarge.png" alt="Fresh" />';
	}
}

/*
	Let's consolidate the rating stuff!
*/
function getRatingStuff($film){
	return getRatingImage($film).getRating($film).'%';
}


/*
	Gets the poster for the movie
*/
function getOverviewImage($film){
	return '<img src="movie_files/'.$film.'/overview.png" alt="general overview" />';
}

/*
	Regardless of differences in other dt's this will ensure that they
	will all be printed. Why is it called "getTheRest"? Well, I originally had
	three other brilliant functions to get the stars, directors, producers, but
	THEN I found out what semicolons do. 
*/
function getTheRest($film){
	$result = '';
	$file = file_get_contents('movie_files/'.$film.'/overview.txt');
	$array = explode(PHP_EOL,$file);
	
	for($i=0;$i<count($array);$i++){
		$combo = explode(':',$array[$i]);

		$result = $result . '<dt>'.$combo[0].'</dt><dd>';

		$starArray = explode(';',$combo[1]);

		foreach($starArray as $star){
			$result = $result . $star . '<br>';
		}
	
		$result = $result . '</dd>';
	}
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
	$files = glob('movie_files/'.$film.'/review*.txt');
	$i = 0;
	$half = 1000;	/* arbitrarily high */

	if(count($files>=2)){			/*catches where there is only one review*/
		$half = count($files)/2;	/*well, the opposite, but you get what I'm doing.*/
	}

	$result = '<div class="col-reviews">';

	foreach ($files as $file){
	
		$review = file_get_contents($file);
		$array = explode(PHP_EOL, $review);
		
		/*If at the halfway point, start the second column*/
		if ($i>=$half){
			$result = $result .'</div><div class="col-reviews">';
		}

		$result = $result . '<p class="quote">';
			if (strcmp($array[1],"ROTTEN")==0){
				$result = $result . '<img class="bottom" src="movie_files/images/rotten.gif" alt="Rotten" />';
			} else{
				$result = $result . '<img class="bottom" src="movie_files/images/fresh.gif" alt="Fresh" />';
			}
		$result = $result . '<q>'. $array[0].'</q>';
		$result = $result . '</p>';
		
		$result = $result . '<p> <img class="icon bottom" src="images/critic.gif" alt="Critic" />'.
					$array[2].
					'<br/><i>'.
					$array[3].
					'</i></p>';

		$i++;
	}

	$result = $result . '</div>';
	return $result;
}


?>