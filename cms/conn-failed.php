<?php require('inc-cms-pre-doctype.php'); ?>
<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>

  </head>
  <body>
    <!-- PAGE WRAPPER -->
    <div id="page-wrapper">

      <!-- SIDEBAR MAIN MENU -->
      <?php require('inc-cms-sidebar.php'); ?>

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER -->
      <section class="right-content-wrapper">

        <!-- HEADER -->
        <header class="base">

          <!-- Branding container -->
          <?php require('inc-cms-branding-container.php'); ?>

          <!-- Page title -->
          <div class="page-header">
            <h2>Template</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <h3>Our database servers are currently down. Please try again in a few minutes.</h3>
          <br>
          <h3>We appologise for the inconvenience.</h3>

        </section>

        <!-- FOOTER -->
        <?php require('inc-cms-footer.php'); ?>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
