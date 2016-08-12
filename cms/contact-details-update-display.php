<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if( isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_POST['txtId'] !== ''){

  // COLLECT ID FROM EDIT BUTTON field
  $vid = $_POST['txtId'];

  //FORMULATE SQL STATEMENT
  $sql_contact_details_update = "SELECT * FROM tblcontactdetails WHERE cid = $vid";

  // CONNECT
  require('inc-conn.php');

  // EXECUTE
  $rs_contact_details_update = mysqli_query($vconn_creativeangels, $sql_contact_details_update);

  // CREATE ASSOCIATIVE ARRAY
  $rs_contact_details_update_rows = mysqli_fetch_assoc($rs_contact_details_update);


} else {

  header('Location: signout.php');
  exit();

}

?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

    } elseif (isset($_GET[$keyName]) && $_GET[$keyName] === 'failed'){

      return "<div class='warning_msg'>Passwords do not match</div>";

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'emaildup'){

      return '<div class="warning_msg">Email already in use</div>';

    }//end if statement

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
            <h2>Update <?php echo $rs_contact_details_update_rows['ccity']; ?> Contact Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!-- FORM --------------------------------------------------------->
          <!-- Used to update the contact details of a particular city -->
          <form class="form" method="get">

            <label>Contact Person Name</label>
            <input type="text" name="txtCPName" />


          </form>

        </section>

        <!-- FOOTER -->
        <?php require('inc-cms-footer.php'); ?>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
