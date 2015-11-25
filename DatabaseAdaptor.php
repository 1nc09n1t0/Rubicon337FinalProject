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
			4) removeAllDuckTypedRecords(): Removes reviewers with %ducktyped%
		*/
		
		// 1) getReviewersAsArray(): returns all the reviewers
		//		Use this to verify uniqueness of reviewerID in php
		public function getReviewersAsArray() {
			$stmt = $this->DB->prepare ( "SELECT * FROM reviewers ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		// 2) registerReviewer(): adds a reviewer
		// Registers a new Reviewer given a reviewer's name and password(stored as hash)
		public function registerReviewer($reviewer, $password) {
			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
			$stmt = $this->DB->prepare ( "INSERT INTO reviewers (reviewer, hashed_pwd) values (:reviewer, :hashed_pwd)" );
			$stmt->bindParam ( 'reviewer', $reviewer );
			$stmt->bindParam ( 'hashed_pwd', $hashed_pwd );
			$stmt->execute ();
		}

		//3) verifiedReviewer(): returns boolean, checks matching password
		public function verifiedReviewer($reviewer, $password) {
			$stmt = $this->DB->prepare ( "SELECT * FROM reviewers WHERE reviewer= :reviewer" );
			$stmt->bindParam ( 'reviewer', $reviewer );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			$hashed_pwd = $currentRecord ['hashed_pwd'];
			return password_verify($password, $hashed_pwd);
		}

		//4) removeAllDuckTypedRecords(): Removes reviewers with %ducktyped%
		public function removeAllDuckTypedRecords() {
			$stmt = $this->DB->prepare ( "DELETE FROM reviewers WHERE reviewer LIKE '%duckTyped%'" );
			$stmt->execute ();
		}
		

		/*
			REVIEWS TABLE FUNCTIONS

			1) getAllReviewsAsArray(): Returns EVERY review in the db:
			2) getAllReviewsAsArrayByMovieTitle(movie_title): Returns all reviews for a given movie's 		title
			3) 3) createReview(movie_title,review, author): Insert a new movie review
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

		// 3) createReview(movie_title,review, author): Insert a new movie review
		public function createReview($movie_title, $review, $author) {
			$stmt = $this->DB->prepare ( "INSERT INTO reviews (movie_title, review, author) values (:movie_title, :review, :author)" );
			$stmt->bindParam ( 'movie_title', $movie_title );
			$stmt->bindParam ( 'review', $review );
			$stmt->bindParam ( 'author', $author );
			$stmt->execute ();
		}

		// 4) deleteReview(id): deletes a review given by an id. id should be a hidden value on an element in the html. Hopefully.
		public function deleteReview($id) {
			$stmt = $this->DB->prepare ( "DELETE FROM reviews WHERE id=:id" );
			$stmt->bindParam ( 'id', $id );
			$stmt->execute ();
		}

		// 5) updateReview(id, review):
		public function updateReview($id, $review){
			$stmt = $this->DB->prepare ( "UPDATE reviews SET review=:review WHERE id=:id" );
			$stmt->bindParam ( 'id', $id );
			$stmd->bindParam ('review', $review);
			$stmt->execute ();
		}

		/*
			MOVIES TABLE FUNCTIONS
			1) getAllMoviesAsArray(): Returns an array of all the movies in the database.
			2) createMovie(title, freshness, director, year, rating, runtime, box_office): Creates a new movie in movies table
			3) updateMovie(title, freshness, director, year, rating, runtime, box_office): Updates a movie row in the movies table. Id is unnecessary since titles should be unique
			4) deleteMovie(id): Deletes a movie
		*/

		// 1) getAllMoviesAsArray(): Returns an array of all the movies in the database.
		public function getAllMoviesAsArray(){
			$stmt = $this->DB->prepare ( "SELECT * FROM movies ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}

		// 2) createMovie(title, freshness, director, year, rating, runtime, box_office): Creates a new movie in movies table
		public function createMovie($title, $freshness, $director, $year, $rating, $runtime, $box_office) {
			$stmt = $this->DB->prepare ( "INSERT INTO movies(title, freshness, director, year, rating, runtime, box_office) values  (:title, :freshness, :director, :year, :rating, :runtime, :box_office)" );
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
		
	} // end class DatabaseAdaptor
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// This code below is for testing purposes only. It must be removed before becoming part of a web site.
	// At first, every assert will generate a red warning.  
	$myDatabaseFunctions = new DatabaseAdaptor ();
	
	// Test register and verifyPassword
	assert ( ! $myDatabaseFunctions->verifiedReviewer ( "duckTyped1", "abcdef" ) );
	assert ( ! $myDatabaseFunctions->verifiedReviewer ( "duckTyped2", "123456" ) );
	assert ( ! $myDatabaseFunctions->verifiedReviewer ( "duckTyped3", "sT6_quote_uT1" ) );
	
	// precondition: The user name, the first argument here, is not in table users
	$myDatabaseFunctions->registerReviewer ( "duckTyped1", "abcdef" );
	$myDatabaseFunctions->registerReviewer ( "duckTyped2", "123456" );
	$myDatabaseFunctions->registerReviewer ( "duckTyped3", "sT6_quote_uT1" );
	
	assert ( $myDatabaseFunctions->verifiedReviewer ( "duckTyped1", "abcdef" ) );
	assert ( $myDatabaseFunctions->verifiedReviewer ( "duckTyped2", "123456" ) );
	assert ( $myDatabaseFunctions->verifiedReviewer ( "duckTyped3", "sT6_quote_uT1" ) );
	
	// Remove any records that may have been added by calling this method (or do it from MariaDB [quotes]>
	$myDatabaseFunctions->removeAllDuckTypedRecords ();
	
	?>