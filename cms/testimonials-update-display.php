<?php require('inc-cms-pre-doctype.php'); ?>
<?php if( isset($_REQUEST['txtSecurity']) && $_REQUEST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_REQUEST['txtId']) && $_REQUEST['txtId'] !== ''){

  $vid = $_GET['txtId'];

  // Create SQL statement to fetch all records from tblcontactdetails
  $sql_test = "SELECT * FROM tbltestimonials WHERE tid = $vid";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_test = mysqli_query($vconn_creativeangels, $sql_test);

  //Create associative Array
  $rs_test_rows = mysqli_fetch_assoc($rs_test);

  //Count the entries into the record set
  $rs_test_rows_total = mysqli_num_rows($rs_test);
} else {

  header('location:signout.php');
  exit();

}

?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

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
            <h2>Update Testimonial <?php echo $rs_test_rows['tcontributor']; ?></h2>
          </div>

        </header>

        <!--################# MAIN CONTENT SECTION ########################-->

        <section id="main-content" class="base">

          <!--##################### ADD NEW FORM ##########################-->

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form id="form" class="form" action="testimonials-update-process.php" method="post" onsubmit="return valForm()" enctype="multipart/form-data">
            <h3 class="accent">Testimonial Content</h3>
            <!-- CONTRIBUTOR NAME -->
            <label>Contributor*</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kcontributor', 'contributor name'); ?>

            <input type="text" name="txtContributor" autocomplete="off" autofocus value="<?php if(isset($_GET['kcontributor'])){ echo displayTxt('kcontributor'); } elseif (isset($rs_test_rows['tcontributor']) && $rs_test_rows['tcontributor'] !== 'na'){ echo $rs_test_rows['tcontributor']; } ?>">

            <!-- DESCRIPTION -->
            <label>Testimonial*</label>

            <?php echo errorMsg('ktestimonial', 'testimonial'); ?>

            <textarea type="text" name="txtTestimonial" autocomplete="off"><?php if(isset($_GET['ktestimonial'])){ echo displayTxt('ktestimonial'); } elseif (isset($rs_test_rows['ttestimonial']) && $rs_test_rows['ttestimonial'] !== 'na'){ echo $rs_test_rows['ttestimonial']; } ?></textarea>

            <h3 class="accent">Image</h3>
            <!-- LOGO -->
            <label>Upload an image</label>

            <input type="file" name="txtImg" >

            <p><small>Logo size may not exceed 2Mb  and must have either a .jpg or .jpeg file extension</small></p>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
            <input type="hidden" name="txtId" value="<?php echo $vid; ?>">

            <!-- Button set -->
            <div class="button-set">

              <!-- submit form -->
              <button name="btnUpdate">Update</button>

              <a class="button danger-btn" href="testimonials-display.php" name="btnCancel">Cancel</a>

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
