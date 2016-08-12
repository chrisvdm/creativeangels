<?php
// LOCALHOST
$vconnServer = 'localhost';
$vconnUsername = 'dev';
$vconnPassword = 'Ramfest2014';
$vconnDatabase = 'dbcreativeangels';

// LIVE HOST
 /*$vconnServer = 'sql30.jnb2.host-h.net';
 $vconnUsername = 'creative01x';
 $vconnPassword = 'nNAaJN2Bbg8';
 $vconnDatabase = 'creativeangelsdb';*/
// RW F5UYyMQq948
// RO LW1AF9XxCk8

//Connect to MYSQL server
$vconn_creativeangels = mysqli_connect($vconnServer, $vconnUsername, $vconnPassword, $vconnDatabase);

if (!$vconn_creativeangels) {

	//REDIRECT TO ERROR PAGE WHEN CONNECTION FAILS
	header('Location: signout.php');
	exit();

    } else {

		//INDICATE WHICH DATABASE YOU WANT TO WORK WITH
		mysqli_select_db($vconn_creativeangels, $vconnDatabase);

	}
?>
