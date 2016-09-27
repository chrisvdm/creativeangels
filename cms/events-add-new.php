<?php require('inc-cms-pre-doctype.php'); ?>
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
            <h2>Add new Event</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!--#################### ADD NEW FORM #########################-->

          <form id="form" class="form" action="events-add-process.php" method="post" onsubmit="return valForm()">

            <!-- EVENT TITLE -->
            <label>Event Title</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('ktitle', 'title'); ?>

            <input type="text" name="txtTitle" autocomplete="off" autofocus value="<?php echo displayTxt('ktitle'); ?>" required="">

            <!-- DESCRIPTION -->
            <label>Description</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea name="txtDescription" required=""><?php echo displayTxt('kdescription'); ?></textarea>

            <!-- DATE -->
            <label>Date</label>

            <?php echo errorMsg('kdate', 'date'); ?>
            <input type="date" name="txtDate" value="<?php echo displayTxt('kdate'); ?>" required="">

            <!-- LINK TO FACEBOOK EVENT PAGE -->
            <label>Link to Facebook event page</label>

            <?php echo errorMsg('klink', 'link'); ?>
            <input type="url" name="txtLink" value="<?php echo displayTxt('klink'); ?>">

            <!-- IMAGES FOR EVENT -->
            <label>Upload Images to Events page</label>
            <p>Images need to be jpegs and no larger than 2MB</p>
            <input type="file" name="txtImg[]">

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">


            <!-- Button set -->
            <div class="button-set">

              <!-- submit form -->
              <button type="submit" name="btnAddNew">Add New</button>

              <a class="button danger-btn" href="cms-homepage.php" name="btnCancel">Cancel</a>

            </div>


            <div id="subErr" class="warning_msg"></div>



        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
