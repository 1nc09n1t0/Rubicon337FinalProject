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
		
		// Returns the all the reviewers in the DB
		public function getReviewersAsArray() {
			// possible values of flagged are 't', 'f';
			$stmt = $this->DB->prepare ( "SELECT * FROM reviewers ORDER BY id" );
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}
		
		// Insert a new quote into the database
		public function addNewQuote($quote, $author) {
			$stmt = $this->DB->prepare ( "INSERT INTO quote (added, quote, author, rating, flagged ) values(now(), :quote, :author, 0, 'f')" );
			$stmt->bindParam ( 'quote', $quote );
			$stmt->bindParam ( 'author', $author );
			$stmt->execute ();
		}
		
		// Raise the rating of the quote with the given $ID by 1
		public function raiseRating($ID) {
			$sql = "UPDATE quote SET rating=rating+1 WHERE id= :ID";
			$stmt->bindParam ( 'ID', $ID );
			$this->DB->exec ( $sql );
		}
		
		// Lower the rating of the quote with the given $ID by 1
		public function lowerRating($ID) {
			$stmt = $this->DB->prepare ( "UPDATE quote SET rating=rating-1 WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
		}
		
		// Set the 'flagged' column of one particular quote to 't' so it will not
		// be shown in the quote collection, until all quotes are unflagged later.
		public function flag($ID) {
			$stmt = $this->DB->prepare ( "UPDATE quote SET flagged = 't' WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
		}
		
		// Used for testing only so far on 9-Nov-2015
		public function isFlagged($ID) {
			$stmt = $this->DB->prepare ( "SELECT * FROM quote WHERE id= :ID" );
			$stmt->bindParam ( 'ID', $ID );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			return $currentRecord ['flagged'] === 't';
		}
		
		// Used for testing only so far on 9-Nov-2015
		public function removeAllDuckTypedRecords() {
			$stmt = $this->DB->prepare ( "DELETE FROM users WHERE username LIKE '%duckTyped%'" );
			$stmt->execute ();
		}
		
		// ////////////////// Implement the next three functions /////////////////////////////
		
		// Change all quote records such that the flagged column is 'f' for every one
		public function unflagAll() {
			$stmt = $this->DB->prepare ( "UPDATE quote SET flagged = 'f' WHERE id=id" );
			$stmt->execute ();
		}
		
		// Add a new user with the given $username and the plain text $password, that will be used in the
		// PHP function password_hash. Before you register new users, you will need this table added to your
		// data base. Run this in mysql (MariaDB) from the command line after the sql command USE quotes:
		//
		// CREATE TABLE users (
		// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		// username varchar(64) NOT NULL default '',
		// hash varchar(255) NOT NULL default ''
		// );
		//
		// precondition: $username is unique. Change this for the final project.
		//
		// Hint: You will need the PHP function
		//    $hash = password_hash($password, PASSWORD_DEFAULT)
		// where you put $hash into a column of the data base of users.
		public function register($username, $password) {
			$hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
			$stmt = $this->DB->prepare ( "INSERT INTO users (username, hash) values (:username, :hashed_pwd)" );
			$stmt->bindParam ( 'username', $username );
			$stmt->bindParam ( 'hashed_pwd', $hashed_pwd );
			$stmt->execute ();
		}
		
		// Return TRUE if the given $username has a plain text $password that works with
		// the hash value stored for that user. 
		// Hint: You will need the PHP function 
		//   $success = password_verify($password, $hash)
		// where $hash is retreived from the data base of users.
		public function verified($username, $password) {

			$stmt = $this->DB->prepare ( "SELECT * FROM users WHERE username= :username" );
			$stmt->bindParam ( 'username', $username );
			$stmt->execute ();
			$currentRecord = $stmt->fetch ();
			$hash = $currentRecord ['hash'];

			return password_verify($password, $hash);
		}
	} // end class DatabaseAdaptor
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// This code below is for testing purposes only. It must be removed before becoming part of a web site.
	// At first, every assert will generate a red warning.  
	$myDatabaseFunctions = new DatabaseAdaptor ();
	
	// Test unFlagAll
	$myDatabaseFunctions->unflagAll ();
	// You need at least three quotes with id = 1, 2, and 3
	$myDatabaseFunctions->flag ( 1 );
	$myDatabaseFunctions->flag ( 2 );
	$myDatabaseFunctions->flag ( 3 );
	assert ( $myDatabaseFunctions->isFlagged ( 1 ) );
	assert ( $myDatabaseFunctions->isFlagged ( 2 ) );
	assert ( $myDatabaseFunctions->isFlagged ( 3 ) );
	
	$myDatabaseFunctions->unflagAll ();
	assert ( ! $myDatabaseFunctions->isFlagged ( 1 ) );
	assert ( ! $myDatabaseFunctions->isFlagged ( 2 ) );
	assert ( ! $myDatabaseFunctions->isFlagged ( 3 ) );
	
	// //////////////////////////////////////////////////////////////////////////////////////////////
	
	// Test register and verifyPassword
	assert ( ! $myDatabaseFunctions->verified ( "duckTyped1", "abcdef" ) );
	assert ( ! $myDatabaseFunctions->verified ( "duckTyped2", "123456" ) );
	assert ( ! $myDatabaseFunctions->verified ( "duckTyped3", "sT6_quote_uT1" ) );
	
	// precondition: The user name, the first argument here, is not in table users
	$myDatabaseFunctions->register ( "duckTyped1", "abcdef" );
	$myDatabaseFunctions->register ( "duckTyped2", "123456" );
	$myDatabaseFunctions->register ( "duckTyped3", "sT6_quote_uT1" );
	
	assert ( $myDatabaseFunctions->verified ( "duckTyped1", "abcdef" ) );
	assert ( $myDatabaseFunctions->verified ( "duckTyped2", "123456" ) );
	assert ( $myDatabaseFunctions->verified ( "duckTyped3", "sT6_quote_uT1" ) );
	
	// Remove any records that may have been added by calling this method (or do it from MariaDB [quotes]>
	$myDatabaseFunctions->removeAllDuckTypedRecords ();
	
	?>