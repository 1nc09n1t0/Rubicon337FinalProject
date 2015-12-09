<?php
	// For Team Rubicon final project
	// Author: Kristoffer Cabulong and Adrianna Ortiz-Flores

	class DatabaseAdaptor {
		
		// The instance variable used in every one of the functions in class DatbaseAdaptor
		private $DB;
		// Make a connection to an existing data based named 'rottenDB' that has
		// tables reviewersm reviews, and movies. 
		public function __construct() {
			$db = 'mysql:dbname=rottenDB;host=127.0.0.1';
			$user = 'root';
			$password = '';
			
			try {
				$this->DB = new PDO ( $db, $user, $password );
				$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch ( PDOException $e ) {
				echo ('Error establishing Connection');
				exit ();
			}
		}

		/*
			REVIEWER TABLE FUNCTIONS
			1) getReviewersAsArray(): returns all the reviewers
			2) registerReviewer(): adds a reviewer
			3) verifiedReviewer(): returns boolean, checks matching password
			4) getAuthor(): returns the concatenation for the first name, space, and lastname for a user_name
			5) getPublication():
			6) removeAllDuckTypedAccounts(): Removes accounts with %ducktyped%
		*/
		
		// 1) getAccountsAsArray(): returns all the user accounts
		//		Use this to verify uniqueness of reviewerID in php
		public function getAccountsAsArray() {
			$stmt = $this->DB->prepare ( "SELECT * FROM accounts ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		// 2) registerUserName(): adds a user
		// Registers a new user_name given a reviewer's name, password(stored as hash), first name, last name, and publication.
		public function registerUserName($user_name, $password, $first_name, $last_name, $publication) {
			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
			$stmt = $this->DB->prepare ( "INSERT INTO accounts (user_name, password, first_name, last_name, publication ) values (:user_name, :hashed_pwd, :first_name, :last_name, :publication)" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->bindParam ( 'hashed_pwd', $hashed_pwd );
			$stmt->bindParam ( 'first_name', $first_name );
			$stmt->bindParam ( 'last_name', $last_name );
			$stmt->bindParam ( 'publication', $publication );
			$stmt->execute ();
		}

		//3) verifiedUserName(): returns boolean, checks matching password
		public function verifiedUserName($user_name, $password) {
			$stmt = $this->DB->prepare ( "SELECT * FROM accounts WHERE user_name= :user_name" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			$hashed_pwd = $currentRecord ['password'];
			return password_verify($password, $hashed_pwd);
		}

		//4)
		public function getAuthor($user_name){
			$stmt = $this->DB->prepare ( "SELECT * FROM accounts WHERE user_name= :user_name" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			$author = $currentRecord ['first_name'] . ' ' . $currentRecord['last_name'];
			return $author;
		} 

		//5)
		public function getPublication($user_name){
			$stmt = $this->DB->prepare ( "SELECT * FROM accounts WHERE user_name= :user_name" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			$publication = $currentRecord ['publication'];
			return $publication;
		}

		//6) removeAllDuckTypedAccounts(): Removes userNames with %ducktyped%
		public function removeAllDuckTypedAccounts() {
			$stmt = $this->DB->prepare ( "DELETE FROM accounts WHERE user_name LIKE '%duckTyped%'" );
			$stmt->execute ();
		}

		// 7) getAccountRecord($user_name): Retrieves an account record given a user_name.
		public function getAccountRecord($user_name){
			$stmt = $this->DB->prepare ( "SELECT * FROM accounts WHERE user_name= :user_name" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			return $currentRecord;
		}
		

		/*
			REVIEWS TABLE FUNCTIONS

			1) getAllReviewsAsArray(): Returns EVERY review in the db:
			2) getAllReviewsAsArrayByMovieTitle(movie_title): Returns all reviews for a given movie's title
			3) createReview(movie_title,review, user_name): Insert a new movie review
			4) deleteReview(id): 
			5) updateReview(id, review):

		*/
		
		//1) getAllReviewsAsArray(): Returns EVERY review in the db:
		public function getAllReviewsAsArray() {
			$stmt = $this->DB->prepare ( "SELECT * FROM reviews ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		//2) getAllReviewsByMovie(movieName): Returns all reviews for a given movieName
		public function getAllReviewsAsArrayByMovie($movie_title) {
			// possible values of flagged are 't', 'f';
			$stmt = $this->DB->prepare ( "SELECT * FROM reviews WHERE movie_title= :movie_title ORDER BY id" );
			$stmt->bindParam ( 'movie_title', $movie_title );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		// 3) createReview(movie_title,review, author: Insert a new movie review
		public function createReview($movie_title, $review, $is_fresh, $author, $publication) {
			$stmt = $this->DB->prepare ( "INSERT INTO reviews (movie_title, review, is_fresh, author, publication) values (:movie_title, :review, :is_fresh, :author, :publication)" );
			$stmt->bindParam ( 'movie_title', $movie_title );
			$stmt->bindParam ( 'review', $review );
			$stmt->bindParam ( 'is_fresh', $is_fresh);
			$stmt->bindParam ( 'author', $author );
			$stmt->bindParam ( 'publication', $publication);
			$stmt->execute ();
		}

		// 4) deleteReview(id): deletes a review given by an id. id should be a hidden value on an element in the html. Hopefully.
		public function deleteReview($id) {
			$stmt = $this->DB->prepare ( "DELETE FROM reviews WHERE id=:id" );
			$stmt->bindParam ( 'id', $id );
			$stmt->execute ();
		}

		// 5) updateReview(id, review):
		public function updateReview($id, $review, $is_fresh){
			$stmt = $this->DB->prepare ( "UPDATE reviews SET review=:review,is_fresh=:is_fresh WHERE id=:id" );
			$stmt->bindParam ( 'id', $id );
			$stmt->bindParam ('review', $review);
			$stmt->bindParam ('is_fresh', $is_fresh);
			$stmt->execute ();
		}

		//6) removeAllDuckTypedReviews(): Removes userNames with %ducktyped%
		public function removeAllDuckTypedReviews() {
			$stmt = $this->DB->prepare ( "DELETE FROM reviews WHERE movie_title LIKE '%duckTyped%'" );
			$stmt->execute ();
		}

		/*
			MOVIES TABLE FUNCTIONS
			1) getAllMoviesAsArray(): Returns an array of all the movies in the database.
			2) createMovie(title, freshness, director, year, rating, runtime, box_office): Creates a new movie in movies table
			3) updateMovie(title, freshness, director, year, rating, runtime, box_office): Updates a movie row in the movies table. Id is unnecessary since titles should be unique
			4) deleteMovie(id): Deletes a movie
			5) getMovieRecord($title): Retrieves a movie record given a movie title.
			6) getMovieYear($title): Returns the year of release for a given movie title.
			7) getMovieRating($title): Returns the year of release for a given movie title.
		*/

		// 1) getAllMoviesAsArray(): Returns an array of all the movies in the database.
		public function getAllMoviesAsArray(){
			$stmt = $this->DB->prepare ( "SELECT * FROM movies ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		// 2) createMovie(title, freshness, director, year, rating, runtime, box_office): Creates a new movie in movies table
		public function createMovie($user_name, $title, $freshness, $director, $year, $rating, $runtime, $box_office) {
			$stmt = $this->DB->prepare ( "INSERT INTO movies(user_name, title, freshness, director, year, rating, runtime, box_office) values  (:user_name, :title, :freshness, :director, :year, :rating, :runtime, :box_office)" );
			$stmt->bindParam ( 'user_name', $user_name );
			$stmt->bindParam ( 'title', $title );
			$stmt->bindParam ( 'freshness', $freshness );
			$stmt->bindParam ( 'director', $director );
			$stmt->bindParam ( 'year', $year );
			$stmt->bindParam ( 'rating', $rating );
			$stmt->bindParam ( 'runtime', $runtime );
			$stmt->bindParam ( 'box_office', $box_office );
			$stmt->execute ();
		}

		// 3) updateMovie(title, freshness, director, year, rating, runtime, box_office): Updates a movie row in the movies table. Id is unnecessary since titles should be unique
		public function updateMovie($title, $freshness, $director, $year, $rating, $runtime, $box_office) {
			$stmt = $this->DB->prepare ( "UPDATE movies SET freshness=:freshness, director=:director, year=:year, rating=:rating, runtime=:runtime, box_office=:box_office WHERE title=:title" );
			$stmt->bindParam ( 'title', $title );
			$stmt->bindParam ( 'freshness', $freshness );
			$stmt->bindParam ( 'director', $director );
			$stmt->bindParam ( 'year', $year );
			$stmt->bindParam ( 'rating', $rating );
			$stmt->bindParam ( 'runtime', $runtime );
			$stmt->bindParam ( 'box_office', $box_office );
			$stmt->execute ();
		}

		// 4) deleteMovie(id): Deletes a movie
		public function deleteMovie($id) {
			$stmt = $this->DB->prepare ( "DELETE FROM movies WHERE id=:id" );
			$stmt->bindParam ( 'id', $id );
			$stmt->execute ();
		}

		// 5) getMovieRecord($title): Retrieves a movie record given a movie title.
		public function getMovieRecord($title){
			$stmt = $this->DB->prepare ( "SELECT * FROM movies WHERE title= :title" );
			$stmt->bindParam ( 'title', $title );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			return $currentRecord;
		}

		// 6) getMovieYear($title): Returns the year of release for a given movie title.
		public function getMovieYear($title){
			$currentRecord = $this -> getMovieRecord($title);
			$year = $currentRecord ['year'];
			return $year;
		}

		// 7) getMovieRating($title): Returns the year of release for a given movie title.
		public function getMovieRating($title){
			$currentRecord = $this -> getMovieRecord($title);
			$rating = $currentRecord ['rating'];
			return $rating;
		}

		// 8) getMovieFreshness($title): Returns the year of release for a given movie title.
		public function getMovieFreshness($title){
			$currentRecord = $this -> getMovieRecord($title);
			$rating = $currentRecord ['freshness'];
			return $rating;
		}
		
	} // end class DatabaseAdaptor
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// // This code below is for testing purposes only. It must be removed before becoming part of a web site.
	// // At first, every assert will generate a red warning.  
	$myDatabaseFunctions = new DatabaseAdaptor ();

	// // Remove any accounts that may have been added by calling this method (or do it from MariaDB [quotes]>
	// $myDatabaseFunctions->removeAllDuckTypedAccounts ();
	
	// // Test register and verifyPassword
	 // assert ( ! $myDatabaseFunctions->verifiedUserName ( "duckTyped1", "abcdef" ) );
	// assert ( ! $myDatabaseFunctions->verifiedUserName ( "duckTyped2", "123456" ) );
	// assert ( ! $myDatabaseFunctions->verifiedUserName ( "duckTyped3", "sT6_quote_uT1" ) );
	
	// // precondition: The user name, the first argument here, is not in table users
	 // $myDatabaseFunctions->registerUserName ( "duckTyped1", "abcdef", "firsty1", "lasty1", "publicationy1");
	// $myDatabaseFunctions->registerUserName ( "duckTyped2", "123456", "firsty2", "lasty2", "publicationy2" );
	// $myDatabaseFunctions->registerUserName ( "duckTyped3", "sT6_quote_uT1", "firsty3", "lasty3", "publicationy3" );
	
	 // assert ( $myDatabaseFunctions->verifiedUserName ( "duckTyped1", "abcdef" ) );
	// assert ( $myDatabaseFunctions->verifiedUserName ( "duckTyped2", "123456" ) );
	// assert ( $myDatabaseFunctions->verifiedUserName ( "duckTyped3", "sT6_quote_uT1" ) );

	// // Test retrieving first and last name given a user_name (to create Firstname lastname concatenation for reviews)
	// assert ( strcmp($myDatabaseFunctions->getAuthor ("duckTyped1"), "firsty1 lasty1")===0 );
	// assert ( strcmp($myDatabaseFunctions->getAuthor ("duckTyped2"), "firsty2 lasty2")===0 );
	// assert ( strcmp($myDatabaseFunctions->getAuthor ("duckTyped3"), "firsty3 lasty3")===0 );

	// // Test retrieving publication given a user_name
	// assert ( strcmp($myDatabaseFunctions->getPublication ("duckTyped1"), "publicationy1")===0 );
	// assert ( strcmp($myDatabaseFunctions->getPublication ("duckTyped2"), "publicationy2")===0 );
	// assert ( strcmp($myDatabaseFunctions->getPublication ("duckTyped3"), "publicationy3")===0 );

	// Tests getAuthor
	// assert ( strcmp($myDatabaseFunctions->getAuthor ("duckTyped1"), "firsty1 lasty1")===0 );

	// // Remove any accounts that may have been added by calling this method (or do it from MariaDB [quotes]>
	// $myDatabaseFunctions->removeAllDuckTypedAccounts ();

	// // Tests for escaped entries. Handled by PDO prepare, apparently.
	// $myDatabaseFunctions->createReview("duckTyped Movie With Quotes in Review", "Isn't it the case that I'm writing a movie's review using quotes?","FRESH" , "myUserName");
	// $myDatabaseFunctions->removeAllDuckTypedReviews();




	///////////////

		$moviesArray = $myDatabaseFunctions->getAllMoviesAsArray();

	?>