<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

    }
  } // End of function errorMsg

  // Displays values already entered in for input field
  function displayTxt($keyValue){

    if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

      return $_GET[$keyValue];

    } //End if statement

  } // End of function displayTxt

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>
    <scriptsrc="ckeditor/ckeditor.js"></script>
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
            <h2>Post news article</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base col-2-3">

          <form class="form news" method="post" action="news-insert-process.php">

              <!-- HEADLINE -->
              <input class="h2" name="txtHeading" type="text" placeholder="Title">

              <!-- SUMMARY -->
              <textarea name="txtSummary" type="text" placeholder="Type a short description of the news article."></textarea>

              <!-- BODY -->
              <label>Body</label>
              <textarea  id="txtBody" name="txtBody"></textarea>
              <script>
              CKEDITOR.replace('txtBody');
              </script>
              <br>
              <br>

              <h3 class="accent">Article settings</h3>
              <!-- DATE -->
              <label>Article Date<label>

                <input type="text" name="txtDate">

                <!-- TODO Datepicker -->

              <label>Status</label><br>
              <input type="radio" name="txtStatus" value="i" checked> Save as Draft<br>
              <input type="radio" name="txtStatus" value="a"> Publish on Save<br>

              <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>"

            <div class="button-set">

              <!-- submit form -->
              <!-- <a class="button" name="btnDraft">Save as draft</a> -->

              <button type="submit" name="btnSave">Save</button>

              <a class="button danger-btn" href="news-details-display.php" name="btnCancel">Cancel</a>

            </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
