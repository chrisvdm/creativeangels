<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if( isset($_REQUEST['txtSecurity']) && $_REQUEST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_REQUEST['txtId']) && $_REQUEST['txtId'] !== ''){


  // COLLECT ID FROM EDIT BUTTON field
  $vid = $_GET['txtId'];

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
    <script src="js/modal.js"></script>

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
          <form class="form" method="post" action="contact-details-update-process.php">

            <div class="half-float">

              <h3 class="tbl-heading accent">Contact Person Details</h3>

              <!-- First Name -->
              <label>First Name</label>

              <?php echo errorMsg('kname', 'name'); ?>
              <input type="text" name="txtName" value="<?php if(isset($_GET['kname'])){ echo displayTxt('kname'); } elseif (isset($rs_contact_details_update_rows['ccontactpersonname']) && $rs_contact_details_update_rows['ccontactpersonname'] !== 'na'){ echo $rs_contact_details_update_rows['ccontactpersonname']; } ?>">

              <!-- Surname -->
              <label>Surname</label>

              <?php echo errorMsg('ksurname', 'surname'); ?>
              <input type="text" name="txtSurname" value="<?php if(isset($_GET['ksurname'])){ echo displayTxt('ksurname'); } elseif (isset($rs_contact_details_update_rows['ccontactpersonsurname']) && $rs_contact_details_update_rows['ccontactpersonsurname'] !== 'na'){ echo $rs_contact_details_update_rows['ccontactpersonsurname']; } ?>">

              <!-- Job title -->
              <label>Job Title</label>

              <?php echo errorMsg('ktitle', 'txtTitle'); ?>
              <input type="text" name="txtTitle" value="<?php if(isset($_GET['ktitle'])){ echo displayTxt('ktitle'); } elseif (isset($rs_contact_details_update_rows['ccontactpersontitle']) && $rs_contact_details_update_rows['ccontactpersontitle'] !== 'na'){ echo $rs_contact_details_update_rows['ccontactpersontitle']; } ?>">

              <!-- landline -->
              <label>Landline</label>

              <input type="text" name="txtLandline" value="<?php if(isset($_GET['klandline'])){ echo displayTxt('klandline'); } elseif (isset($rs_contact_details_update_rows['clandline']) && $rs_contact_details_update_rows['clandline'] !== 'na'){ echo $rs_contact_details_update_rows['clandline']; } ?>">

              <!-- Mobile -->
              <label>Mobile</label>

              <input type="text" name="txtMobile" value="<?php if(isset($_GET['kmobile'])){ echo displayTxt('kmobile'); } elseif (isset($rs_contact_details_update_rows['ccell']) && $rs_contact_details_update_rows['ccell'] !== 'na'){ echo $rs_contact_details_update_rows['ccell']; } ?>">

              <!-- Email -->
              <label>Email</label>

              <input type="text" name="txtEmail" value="<?php if(isset($_GET['kemail'])){ echo displayTxt('kemail'); } elseif (isset($rs_contact_details_update_rows['cemail']) && $rs_contact_details_update_rows['cemail'] !== 'na'){ echo $rs_contact_details_update_rows['cemail']; } ?>">

            </div>

            <div class="half-float">

              <h3 class="accent">Address Details</h3>

              <label>Address Line 1</label>

              <input type="text" name="txtAdd1" value="<?php if(isset($_GET['kadd1'])){ echo displayTxt('kadd1'); } elseif (isset($rs_contact_details_update_rows['caddress1']) && $rs_contact_details_update_rows['caddress1'] !== 'na'){ echo $rs_contact_details_update_rows['caddress1']; } ?>">

              <label>Address Line 2</label>

              <input type="text" name="txtAdd2" value="<?php if(isset($_GET['kadd2'])){ echo displayTxt('kadd2'); } elseif (isset($rs_contact_details_update_rows['caddress2']) && $rs_contact_details_update_rows['caddress2'] !== 'na'){ echo $rs_contact_details_update_rows['caddress2']; } ?>">

              <label>Address Line 3</label>

              <input type="text" name="txtAdd3" value="<?php if(isset($_GET['kadd3'])){ echo displayTxt('kadd3'); } elseif (isset($rs_contact_details_update_rows['caddress3']) && $rs_contact_details_update_rows['caddress3'] !== 'na'){ echo $rs_contact_details_update_rows['caddress3']; } ?>">

              <label>Suburb</label>

              <input type="text" name="txtSuburb" value="<?php if(isset($_GET['ksuburb'])){ echo displayTxt('ksuburb'); } elseif (isset($rs_contact_details_update_rows['csuburb']) && $rs_contact_details_update_rows['csuburb'] !== 'na'){ echo $rs_contact_details_update_rows['csuburb']; } ?>">

              <label>City</label>

              <input type="text" name="txtCity" value="<?php if(isset($_GET['kcity'])){ echo displayTxt('kcity'); } elseif (isset($rs_contact_details_update_rows['ccity']) && $rs_contact_details_update_rows['ccity'] !== 'na'){ echo $rs_contact_details_update_rows['ccity']; } ?>">

              <label>Postal Code</label>

              <input type="text" name="txtPostalCode" value="<?php if(isset($_GET['kpostalcode'])){ echo displayTxt('kpostalcode'); } elseif (isset($rs_contact_details_update_rows['cpostalcode']) && $rs_contact_details_update_rows['cpostalcode'] !== 'na'){ echo $rs_contact_details_update_rows['cpostalcode']; } ?>">

            </div>

            <div class="clearfix"></div>

            <!-- Hidden field for id -->
            <input type="hidden" name="txtId" value="<?php echo $rs_contact_details_update_rows['cid']; ?>">

            <!-- Security hidden field -->
            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <?php
              if($rs_contact_details_update_rows['ccity'] === 'Durban'){
                $intId = base64_encode(1);
              } elseif ($rs_contact_details_update_rows['ccity'] === 'Cape Town') {
                $intId = base64_encode(2);
              }

            ?>

            <!-- Button set for form submission -->
            <div class="button-set">

              <a class="button" href="contact-particulars-display.php<?php echo '?kid=' . $intId ; ?>" name="btnCancel">Cancel</a>

              <button class="proceed-btn" type="submit" name="btnUpdate">Update</button>

            </div>

          </form>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    // Display toast when update successful
    <?php if( isset($_GET['kval']) && $_GET['kval'] === 'failed') {
      echo 'mw.deleteToast("Record could not be updated. Please fill in all required fields","#main-content");';
    }
    ?>

    </script>
  </body>
</html>
