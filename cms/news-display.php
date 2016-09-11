<?php require("inc-cms-pre-doctype.php"); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
  // Create SQL statement
  $sql_news = "SELECT * FROM tblnews ORDER BY ncreated ASC";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_news = mysqli_query($vconn_creativeangels, $sql_news);

  //Create associative Array
  $rs_news_rows = mysqli_fetch_assoc($rs_news);

  //Count the entries into the record set
  $rs_news_rows_total = mysqli_num_rows($rs_news);
?>
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
            <h2>News Articles</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <table class="tbldatadisplay">
            <tr class="tbl-heading">
              <td class="accent">Title</td>
                <td class="accent">
                  Summary
                </td>
                <td class="accent">
                  Status
                </td>
                <td class="accent">
                  &nbsp;
                </td>
              </tr>

              <?php do{ ?>
            <tr>
              <td><?php echo $rs_news_rows['nheading']; ?></td>
              <td><?php echo $rs_news_rows['nsummary']; ?></td>
              <td><?php echo $rs_news_rows['nstatus']; ?></td>
              <td class="button-set">
                <form method="get" action="news-update-display.php">
                  <input type="hidden" name="txtId" value="<?php echo $rs_news_rows['nid']; ?>">
                  <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                  <input class="button" type="submit" value="Edit">
                </form>
                <button>Publish</button>
                <button>Archive</button>
              </td>
            </tr>

            <?php } while ($rs_news_rows = mysqli_fetch_assoc($rs_news)) ?>
          </table>


        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
