<?php
$vconnServer = 'localhost';
$vconnUsername = 'dev';
$vconnPassword = 'Ramfest2014';
$vconnDatabase = 'dbcreativeangels';

//Connect to MYSQL server
$vconn_creativeangels = mysqli_connect($vconnServer, $vconnUsername, $vconnPassword, $vconnDatabase);

if (!$vconn_creativeangels) {

	//REDIRECT TO ERROR PAGE WHEN CONNECTION FAILS
	header('Location: signout.php');
	exit();

    } else {

		//INDICATE WHICH DATABASE YOU WANT TO WORK WITH
		mysqli_select_db($vconn_creativeangels, $vDatabase);

	}
?>
