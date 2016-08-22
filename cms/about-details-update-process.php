<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if( isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

  $vid = $_POST['txtId'];

  $validation = 0;

  // ================================== VALIDATION CHECKS ====================================

  // ------------------------ MISSION STATEMENT VALIDATION --------------------------

  if (isset($_POST['txtmission'])) {

    $vMission = trim($_POST['txtmission']);

    if ($vMission !== '') {

      // Remove harmful characters from name
      $vMission = filter_var($vMission, FILTER_SANITIZE_STRING);

      if ($vMission === '') {

        $validation++;

      }

    } else {

      // If name is empty on arrival
      $validation++;
    }

  } else {

    // If txtName is not set
    $validation++;
  } // END OF MISSION STATEMENT VALIDATION

  // ------------------------ DESCRIPTION VALIDATION --------------------------

  if (isset($_POST['txtdescription'])) {

    $vDescription = trim($_POST['txtdescription']);

    if ($vDescription !== '') {

      // Remove harmful characters from name
      $vDescription = filter_var($vDescription, FILTER_SANITIZE_STRING);

      if ($vDescription === '') {

        $validation++;

      }

    } else {

      // If name is empty on arrival
      $validation++;
    }

  } else {

    // If txtName is not set
    $validation++;
  } // END OF DESCRIPTION VALIDATION

  //------------------------------- VALIDATION CHECK -------------------------------------

  // VALIDATION FAILED
  if($validation > 0) {

    $qs = '?kval=failed';
    $qs .= '&txtSecurity=' . $_SESSION['svSecurity'];
    $qs .= '&txtId=' . $vid;
    $qs .= "&kmission=".urlencode($vMission);
    $qs .= "&kdescription=".urlencode($vDescription);

    $qs .= '&kid=' . $vid;

    header('Location: about-details-update-display.php' . $qs);
    exit();

    // validation pass
    } else if ($validation === 0) {

      //========================== UPDATE DATABASE ==========================================

      // Connect to mysql server
      require('inc-conn.php');

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      $sql_about_update = sprintf("UPDATE tblabout SET amission = %s, adescription = %s WHERE aid = $vid",
        escapestring($vconn_creativeangels, $vMission, 'text'),
        escapestring($vconn_creativeangels, $vDescription, 'text')
      );

      // Execute insert statement
      $about_update_results = mysqli_query($vconn_creativeangels, $sql_about_update);

      // Update success
      if($about_update_results) {

        $qs = '&kupdate=success';

        header('Location: about-details-display.php?' . $qs );
        exit();

      } else {
        // Update not successful
        header('Location: signout.php');
        exit();
      }
    } // End of successul validation

  } else {
    // If security token invalid
    header('location: signout.php');
    exit();

  }
?>
