
<?php

	require_once 'DatabaseAdaptor.php';

	$titleString = $_GET ['titleString'];

		$resultArray = [];

		$testString = "[";

		foreach($moviesArray as $record) {
			if ($titleString != '' && strpos($record['title'], $titleString) !== false){
				$resultArray[] = $record['title'];
				if (count($moviesArray)==20){
					break;
				}
			}
		}
		echo json_encode($resultArray);
?>