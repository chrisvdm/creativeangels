<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <script src="js/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Creative Angels | Content Management System</title>
  </head>
  <body>
    <!-- PAGE WRAPPER ----------------------------->
    <div id="page-wrapper">

      <!-- HEADER ----------------------------------->
      <header class="base">
        <div class="main-header">
          <h1>Creative Angels Template</h1>
        </div>

        <!-- Branding container -->
        <div class="branding-container">
          <a  class="branding-trigger" href="cms-dashboard.php" title="View Dashboard">Dashboard</a>
          <a  class="branding-trigger" href="../logout.php" title="Log out">Log out</a>
          <span id="view-acc" class="branding-trigger">Person's name</span>
        </div>

        <div class="clearfix"></div>
        </div>
      </header>

      <!-- MAIN CONTENT ----------------------------->
      <div class="content-wrapper">

        <!-- SIDEBAR MAIN MENU ------------------------>
        <ul id="main-menu" class="menu base">
          <li></li>
          <li></li>
        </ul>
        <!-- end of sidebar menu -->

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER ------>
        <section class="right-content-wrapper base">

          <h1>This page's heading</h1>

        </section>
        <!-- end of right column content container -->

      </div>
      <!-- content wrapper end -->

      <footer class="base">
        <p><small>
          Content Management System by <a href="http://www.christinenyman.com">Christine Nyman</a> | &copy; Cape Town 2016
        </small></p>
      </footer>

    </div>
    <!-- page wrapper end -->
  </body>
</html>
