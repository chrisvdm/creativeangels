<?php
session_start();

session_destroy();

header('Location: ' . DOMAIN . 'cms-signin.php');
exit();
?>
