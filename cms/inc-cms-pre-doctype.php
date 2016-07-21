<?php session_start(); ?>
<?php
// User authentication code
if (empty($_SESSION['svcid'])) {
	header("Location: signout.php");
	exit();
}
?>
