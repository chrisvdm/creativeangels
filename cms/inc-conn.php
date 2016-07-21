<?php
	$vServer = 'localhost';
	$vDbUsername = 'dev';
	$vDbPassword = 'Ramfest2014';
	$vDatabase = 'dbcreativeangels';

	//Connect to MYSQL server
	$vconn_creativeangels = mysqli_connect($vServer, $vDbUsername, $vDbPassword, $vDatabase);

	if (!$vconn_creativeangels) {

		//REDIRECT TO ERROR PAGE WHEN CONNECTION FAILS
		header('Location: cms-conn-failed.php');
		exit();

	} else {

		//INDICATE WHICH DATABASE YOU WANT TO WORK WITH
		mysqli_select_db($vconn_creativeangels, $vDatabase);

	}
?>
