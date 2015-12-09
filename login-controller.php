<?php
 	session_start();


	include 'DatabaseAdaptor.php';
	
	$action =  $_GET['action'];
	
	if(strcmp($action,"login")==0){

		$username = $_GET['username'];
		$password = $_GET['password'];

		if ($myDatabaseFunctions->verifiedUserName ($username, $password)){
			$_SESSION['username'] = $username;
			$_SESSION['message'] = "Logged in as " . $username;
			header ( "Location: index.php" );
		} else {
			$_SESSION['loginError'] = "Invalid User/Password";
			header ( "Location: login-register.php");
		}
	}
	elseif(strcmp($action,"register")==0){

		$username = $_GET['username'];
		$password = $_GET['password'];
		$first_name = $_GET['first_name'];
		$last_name = $_GET['last_name'];
		$publication = $_GET['publication'];
		//TODO: Check for pre-existing username (Might just make a new db adaptor function)

		$myDatabaseFunctions->registerUserName($username, $password, $first_name, $last_name, $publication);
		$_SESSION['username'] = $username;
		$_SESSION['message'] = "Logged in as " . $username;
		header ( "Location: index.php" );
	}
	elseif(strcmp($action,"logout")==0){
		$_SESSION['message'] = "Logged out";
		unset( $_SESSION['username']);
		header ( "Location: index.php" );
	}
	elseif(strcmp($action,"createReview")==0){
			$_SESSION['reviewId'] = -99; 
 			$_SESSION['movie'] = $_GET['movie']; 
 			$_SESSION['review'] = ""; 
 			$_SESSION['author'] = $_GET['author']; 
 			$_SESSION['publication'] = $_GET['publication']; 
 			$_SESSION['isFresh'] = "";
		header ( "Location: new-review.php" );
	}
	elseif(strcmp($action,"updateReview")==0){

			$_SESSION['reviewId'] = $_GET['reviewId']; 
 			$_SESSION['movie'] = $_GET['movie']; 
 			$_SESSION['review'] = $_GET['review']; 
 			$_SESSION['author'] = $_GET['author']; 
 			$_SESSION['publication'] = $_GET['publication']; 
 			$_SESSION['isFresh'] = $_GET['isFresh'];

		header ( "Location: new-review.php" );
	}
	elseif(strcmp($action,"finishReview")==0){

		$movie_title = $_GET['movie_title'];
		$author = $_GET['author'];
		$user_publication = $_GET['user_publication'];
		$review_body = $_GET['review_body'];
		$user_rating = strtoupper($_GET['user_rating']);
		$reviewId = $_GET['reviewId'];

		if ($reviewId==-99){
			$myDatabaseFunctions->createReview($movie_title,$review_body,$user_rating,$author,$user_publication);
		}else{
			$myDatabaseFunctions->updateReview($reviewId, $review_body, $user_rating);
		}

		header ( "Location: review.php?movie=". $movie_title);
	}
	elseif(strcmp($action, "deleteReview")==0){
		$reviewId = $_GET['reviewId'];
		$movie = $_GET['movie'];
		$myDatabaseFunctions->deleteReview($reviewId);
		header ( "Location: review.php?movie=". $movie);
	}
	elseif(strcmp($action,"createMovie")==0){
		//TODO
		header ( "Location: new-movie.php" );
	}
	elseif(strcmp($action,"updateMovie")==0){
		//TODO
		header ( "Location: new-movie.php" );
	}

	
?>
