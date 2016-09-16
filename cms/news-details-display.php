<?php require("inc-cms-pre-doctype.php"); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php

  $vId = $_POST['txtId'];
  // Create SQL statement
  $sql_news = "SELECT * FROM tblnews WHERE nid = $vId";

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
            <h2>News Article > <?php echo $rs_news_rows['nheading']; ?></h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <article><?php echo $rs_news_rows['nbody']; ?></article>

          <div class="gallery">
            <?php
              $img_str = $rs_news_rows['nimages'];
              $img_arr = explode(', ', $img_str);

              foreach($img_arr as $key => $value) {
                echo '<img src="../assets/uploads/news/large/' . $value .'">';
              }
            ?>
          </div>


          <div class="button-set">
            <!-- Edit -->
            <form method="get" action="news-update-display.php">
              <input type="hidden" name="txtId" value="<?php echo $rs_news_rows['nid']; ?>">
              <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
              <input class="button" type="submit" value="Edit">
            </form>

            <!-- Publish -->
            <input type="button" name="pubBtn" data-status="<?php echo $rs_news_rows['nstatus']; ?>" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-id="<?php echo $rs_news_rows['nid']; ?>" value="<?php if($rs_news_rows['nstatus'] === 'i'){echo 'Publish';} else {echo 'Archive';} ?>">

            <a class="button" href="news-display.php">Cancel</a>
          </div>
        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    $(document).ready(function() {

      $(':button[name="pubBtn"]').on('click', function() {

        var btn = $(this);
        var info = btn.data();

        if(info.status === 'i') {
          info.status = 'a';
        } else if(info.status === 'a') {
          info.status = 'i';
        }

        $.ajax({
          type: 'POST',
          url: 'news-ajax-publish-process.php',
          data: {
            'txtSecurity': info.sec,
            'txtId': info.id,
            'txtStatus': info.status
          },
          success: function(result) {

            if (result === 'success') {

              if(info.status === 'i') {
                btn.val('Publish');
              } else if(info.status === 'a') {
                btn.val('Archive');
              }
            }

          }
        });
      });

    });

    </script>
  </body>
</html>
