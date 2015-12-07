<?php
 	session_start();


	// include 'model.php';
	// $model = new Model();
	$action =  $_GET['action'];
	$username = $_GET['username'];
	$password = $_GET['password'];

	if(strcmp($action,"login")==0){

		   if( isset( $_SESSION['counter'] ) )
		   {
		      $_SESSION['counter'] += 10;
		   }
		   else
		   {
		      $_SESSION['counter'] = 10;
		   }


			$_SESSION['username'] = "" . $username;

	}
	elseif(strcmp($action,"increment")==0){
//		$model->incQuoteRating($ID);
	}
	elseif(strcmp($action,"decrement")==0){
//		$model->decQuoteRating($ID);
	}
	elseif(strcmp($action,"flag")==0){
//		$model->flagQuote($ID);
	}

	header ( "Location: index.php" );
?>
