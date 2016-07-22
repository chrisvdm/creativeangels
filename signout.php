<?php
session_start();

session_destroy();

header('Location: cms-signin.php');
exit();
?>
