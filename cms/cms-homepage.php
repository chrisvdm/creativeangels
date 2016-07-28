<?php require('inc-cms-pre-doctype.php'); ?>
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

          <h2> Hi there <?php echo $_SESSION['svcname']; ?></h2>

            <div id="body_column_right">
                <p>&nbsp;</p>
                <table cellspacing="0" class="tbldatadisplay">
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
                </table>
            </div>

        </section>

        <!-- FOOTER -->
        <?php require('inc-cms-footer.php'); ?>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
