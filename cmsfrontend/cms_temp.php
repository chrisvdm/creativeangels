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

        <!-- SIDEBAR MAIN MENU ------------------------>
        <ul id="main-menu" class="menu">
          <div class="main-header base">
            <h1>Creative Angels</h1>
          </div>
          <li>Dashboard</li>
          <ul class="submenu">
            <li>Views</li>
            <li>Traffic</li>
          </ul>
          <li>Administrators</li>
          <ul class="submenu">
            <li>Display</li>
            <li>Add Users</li>
          </ul>
          <li>News</li>
          <li>Events</li>
          <li>Contact</li>
        </ul>
        <!-- end of sidebar menu -->

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER ------>
        <section class="right-content-wrapper">
          <!-- HEADER ----------------------------------->
          <header class="base">
            <div class="page-header">
              <h2>John Doe</h2>
            </div>

            <!-- Branding container -->
            <div class="branding-container">
              <a  class="branding-trigger" href="cms-dashboard.php" title="View Dashboard">Dashboard</a>
              <a  class="branding-trigger" href="../logout.php" title="Log out">Log out</a>
            </div>

          </header>

          <section class="base">

            <h1>This page's heading</h1>

          </section>


        </section>
        <!-- end of right column content container -->


        <div class="clearfix"></div>


      <!-- FOOTER ------------------------------------>
      <footer class="base">
        <span><small>
           &copy; 2016 <strong><a href="http://www.christinenyman.com">Christine Nyman</a></strong>
        </small></span>
      </footer>

    </div>
    <!-- page wrapper end -->

    <script>
      <!--

      $(document).ready(function() {

        // menu accordian
        $('ul.menu>li').click(function(){

          $('ul.submenu').not(':hidden').slideUp();

          $(this).next('ul.submenu').not(':visible').slideDown();
        })


      });


      -->
    </script>
  </body>
</html>
