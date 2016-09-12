<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php //require("inc-cms-pre-doctype.php"); ?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

    } elseif (isset($_GET[$keyName]) && $_GET[$keyName] === '0'){

      return "<div class='warning_msg'>Passwords do not match</div>";

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'failed'){

      return '<div class="warning_msg">Please enter passwords!</div>';

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'emaildup'){

      return '<div class="warning_msg">Email already in use</div>';

    }//end if statement

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
            <h2>Add New Partner</h2>
          </div>

        </header>

        <!--################# MAIN CONTENT SECTION ########################-->

        <section id="main-content" class="base">

          <!--##################### ADD NEW FORM ##########################-->

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form id="form" class="form" action="partners-add-process.php" method="post" onsubmit="return valForm()" enctype="multipart/form-data">

            <h3 class="accent">Partner Details</h3>

            <!-- COMPANY NAME -->
            <label>Company name*</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kcomp', 'company name'); ?>

            <input type="text" name="txtCompany" autocomplete="off" autofocus value="<?php echo displayTxt('kcomp'); ?>">

            <!-- DESCRIPTION -->
            <label>Description*</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea type="text" name="txtDescription" autocomplete="off" value="<?php echo displayTxt('kdescription'); ?>"></textarea>

            <h3 class="accent">Logo</h3>
            <!-- LOGO -->
            <label>Upload a logo</label>

            <input type="file" name="txtLogo" >

            <p><small>Logo size may not exceed 2Mb  and must have either a .jpg or .jpeg file extension</small></p>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
            
            <!-- Button set -->
            <div class="button-set">

              <!-- submit form -->
              <button name="btnAddNew">Add New</button>

              <a class="button danger-btn" href="partners-details-display.php" name="btnCancel">Cancel</a>

            </div>


            <div id="subErr" class="warning_msg"></div>

          </form>

        </section>


      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    </script>
  </body>
</html>
