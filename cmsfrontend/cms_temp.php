<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- META DATA -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="PRAGMA" content="NO-CACHE">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
    <meta name="description" content ="" />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <![endif]-->

    <!-- ########  FAVICON  ########### -->
    <link rel="icon" href="sources/favicon/favicon.gif" />
    <script src="js/jquery.min.js" charset="utf-8"></script>
    <script src="https://use.fontawesome.com/53998a24cf.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <title>Creative Angels | Content Management System</title>

    <script src="ckeditor/ckeditor.js"></script>
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
            <li>Overview</li>
            <li>Traffic</li>
            <li>User Log</li>
          </ul>
          <li>User Accounts</li>
          <ul class="submenu">
            <li>Display</li>
            <li>Add Users</li>
          </ul>
          <li>News</li>
          <li>Manage events</li>
          <li>Contact</li>
          <li>Log out</li>
        </ul>
        <!-- end of sidebar menu -->

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER ------>
        <section class="right-content-wrapper">

          <!-- HEADER ----------------------------------->
          <header class="base">

            <div class="page-header">
              <h2>Template</h2>
            </div>

            <!-- Branding container -->
            <div class="branding-container">
              <a  class="branding-trigger" href="../index.php" title="View Profile">Jane Doe</a>
              <a  class="branding-trigger" href="../signout.php" title="Log out">Log out</a>
            </div>

          </header>

          <section class="base">

            <h1>This page's heading</h1>

          </section>

          <!-- FOOTER ------------------------------------>
          <footer class="base">
            <span><small>
               &copy; 2016 <strong><a href="http://www.christinenyman.com">Christine Nyman</a></strong>
            </small></span>
          </footer>

        </section>
        <!-- end of right column content container -->


        <div class="clearfix"></div>

    </div>
    <!-- page wrapper end -->

    <script src="js/accordian.js"></script>
  </body>
</html>
