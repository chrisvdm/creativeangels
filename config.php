<?php
define('PATH', __DIR__);
// finds the path to current file

// Local
define('DOMAIN', 'http://localhost:8888/christinenyman/projects/creativeangels');
// to be added to html

// Live
// define('DOMAIN', 'http://christinenyman.com/projects/creativeangels/');

// Local
define('THIS_PAGE_URL', 'http://localhost' . $_SERVER['PHP_SELF']); // file path from the html_public to the root

// Live
// define('THIS_PAGE_URL', 'http://christinenyman.com' . $_SERVER['PHP_SELF']);
?>
