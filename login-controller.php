<?php
 	session_start();


	include 'DatabaseAdaptor.php';
	
	$action =  $_GET['action'];
	
	//login
	$username = $_GET['username'];
	$password = $_GET['password'];

	$first_name = $_GET['first_name'];
	$last_name = $_GET['last_name'];
	$publication = $_GET['publication'];


	if(strcmp($action,"login")==0){

		if ($myDatabaseFunctions->verifiedUserName ($username, $password)){
			$_SESSION['username'] = "" . $username;
			header ( "Location: index.php" );
		} else {
			$_SESSION['loginError'] = "Invalid User/Password";
			header ( "Location: login-register.php");
		}
	}
	elseif(strcmp($action,"register")==0){
		$myDatabaseFunctions->registerUserName($username, $password, $first_name, $last_name, $publication);
		header ( "Location: index.php" );
	}
	elseif(strcmp($action,"decrement")==0){
//		$model->decQuoteRating($ID);
	}
	elseif(strcmp($action,"flag")==0){
//		$model->flagQuote($ID);
	}

	
?>
