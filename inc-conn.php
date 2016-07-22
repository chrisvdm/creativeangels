<?php
$vServer = 'localhost';
$vUsername = 'dev';
$vPassword = 'Ramfest2014';
$vDatabase = 'dbcreativeangels';

//Connect to MYSQL server
$vconn_creativeangels = mysqli_connect($vServer, $vUsername, $vPassword, $vDatabase);

if (!$vconn_creativeangels) {

	//REDIRECT TO ERROR PAGE WHEN CONNECTION FAILS
	header('Location: signout.php');
	exit();

    } else {

		//INDICATE WHICH DATABASE YOU WANT TO WORK WITH
		mysqli_select_db($vconn_creativeangels, $vDatabase);

	}
?>
