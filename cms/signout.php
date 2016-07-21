<?php
session_start();

session_destroy();

header('Location: http://localhost:8888/christinenyman/projects/creativeangels/cms-signin.php');
exit();
?>
