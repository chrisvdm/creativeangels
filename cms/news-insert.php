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
    <script src="ckeditor/ckeditor.js"></script>

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

          <form class="form news" method="post" action="news-insert-process.php" enctype="multipart/form-data">
            <h3 class="accent">Article content</h3>
              <!-- HEADLINE -->
              <?php echo errorMsg('kheading', 'title'); ?>
              <input class="h2" name="txtHeading" type="text" placeholder="Title" value=<?php echo displayTxt('kheading'); ?>>

              <!-- SUMMARY -->
              <textarea name="txtSummary" type="text" placeholder="Type a short description of the news article."><?php echo displayTxt('ksummary'); ?></textarea>

              <!-- BODY -->
              <label>Body</label>

              <?php echo errorMsg('kbody', 'body'); ?>
              <textarea id="txtBody" name="txtBody"><?php echo displayTxt('kbody'); ?></textarea>
              <script>
                CKEDITOR.replace('txtBody');
              </script>
              <br>
              <br>

              <h3 class="accent">Images</h3>
              <div id="img-Err" class='warning_msg'></div>
              <p>Upload up to 5 jpeg images</p>
              <input type="file" name="images[]" multiple="">

              <h3 class="accent">Article settings</h3>
              <!-- DATE -->
              <label>Article Date<label>
                <!-- TODO Datepicker -->
                <p><i>YYYY-MM-DD</i></p>

                <input type="text" name="txtDate" placeholder="YYYY-MM-DD">

              <label>Status</label><br>
              <input type="radio" name="txtStatus" value="i" checked> Save as Draft<br>
              <input type="radio" name="txtStatus" value="a"> Publish on Save<br>

              <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>"

            <div class="button-set">

              <button type="submit" name="btnSave">Save</button>

              <a class="button danger-btn" href="news-display.php" name="btnCancel">Cancel</a>

            </div>

          </form>

        </section>

      </section>

      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

      _('input[name="images[]"]').onchange = function() {
        if(_('input[name="images[]"]').files.length > 5) {
          _('#img-Err').innerHtml = '<p>You can only select up to 5 images</p>'
        }
      }

    </script>
  </body>
</html>
