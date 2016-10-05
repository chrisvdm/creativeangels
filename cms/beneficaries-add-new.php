<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
// Function for printing out error messages
function errorMsg($keyName, $label) {

  // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field
  if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

    return "<div class='warning_msg'>Please enter " . $label . ".</div>";

  } //end if statement

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
            <h2>Add New Beneficary</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!--#################### ADD NEW FORM #########################-->

          <form id="form" class="form" action="beneficaries-add-process.php" method="post" enctype="multipart/form-data">

            <p><small>Beneficaries are organisations that profit from some of Creative Angels' events and initiatives</small></p>

            <!-- BENEFICARY NAME -->
            <label>Beneficary name</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php echo displayTxt('kname'); ?>" required="">

            <!-- DESCRIPTION -->
            <label>Description</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea name="txtDescription" required=""><?php echo displayTxt('kdescription'); ?></textarea>

            <!-- LINK TO FACEBOOK EVENT PAGE -->
            <label>Beneficary Website <span class="fa fa-globe"></span></label>

            <?php echo errorMsg('klink', 'link'); ?>
            <input type="url" name="txtLink" value="<?php echo displayTxt('klink'); ?>">

            <!-- IMAGES FOR BENEFICARIES -->
            <label>Upload Images <span class="fa fa-picture-o"></span></label>
            <p>Upload at least one image</p>

            <?php echo errorMsg('kimg', 'image'); ?>
            <input type="file" name="img[]" multiple="" required="">

            <p><small>Logo size may not exceed 2Mb  and must have either a .jpg or .jpeg file extension</small></p>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <!-- BUTTON SET -->
            <div class="button-set">

              <!-- submit form -->
              <button type="submit" name="btnAddNew">Save <span class="fa fa-check"></span></button>

              <a class="button danger-btn" href="beneficaries-display.php" name="btnCancel">Cancel <span class="fa fa-times"></span></a>

            </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
