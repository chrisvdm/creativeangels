<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if( isset($_REQUEST['txtSecurity']) && $_REQUEST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_REQUEST['txtId']) && $_REQUEST['txtId'] !== ''){

  $vid = $_GET['txtId'];

  // Create SQL statement to fetch all records from tblcontactdetails
  $sql_about = "SELECT * FROM tblabout WHERE aid = $vid";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_about = mysqli_query($vconn_creativeangels, $sql_about);

  //Create associative Array
  $rs_about_rows = mysqli_fetch_assoc($rs_about);

} else {

  header('Location: signout.php');
  exit();

}

?>
<?php

  // Error handling fn
  function errorMsg($keyName, $label) {

    // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter a " . $label . ".</div>";

    }

  } // End of function errorMsg

  // Displays values already entered in for input field
  function displayTxt($keyValue){

    if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

      return $_GET[$keyValue];

    }

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
            <h2>Update About Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!-- FORM ---------------------------------------------------------------->
          <form class="form" action="about-details-update-process.php" method="post">

            <!-- Mission Statement -->
            <label>Mission Statement</label>

            <?php echo errorMsg('kmission', 'mission statement'); ?>
            <textarea class="form-textarea" name="txtmission">
              <?php if(isset($_GET['kmission'])){ echo displayTxt('kmission'); } elseif (isset($rs_about_rows['amission']) && $rs_about_rows['amission'] !== 'na'){ echo $rs_about_rows['amission']; } ?>
            </textarea>

            <!-- Description -->
            <label>Description</label>

            <?php echo errorMsg('kdescription', 'description'); ?>

            <textarea class="form-textarea large" name="txtdescription">
              <?php if(isset($_GET['kdescription'])){ echo displayTxt('kdescription'); } elseif (isset($rs_about_rows['adescription']) && $rs_about_rows['adescription'] !== 'na'){ echo $rs_about_rows['adescription']; } ?>
            </textarea>

            <!-- Hidden field for id -->
            <input type="hidden" name="txtId" value="<?php echo $rs_about_rows['aid']; ?>">

            <!-- Security hidden field -->
            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <!-- Button set for form submission -->
            <div class="button-set">

              <a class="button" href="about-details-display.php" name="btnCancel">Cancel</a>

              <button class="proceed-btn" type="submit" name="btnUpdate">Update</button>

            </div>



          </form>


        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
