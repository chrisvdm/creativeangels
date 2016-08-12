<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if( isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_POST['txtId'] !== ''){

  $vid = $_POST['txtId'];

  $validation = 0;

  // ------------------------ FIRST NAME VALIDATION --------------------------

  if (isset($_POST['txtName'])) {

    $vName = ucfirst(strtolower(trim($_POST['txtName'])));

    if ($vName !== '') {

      // Remove harmful characters from name
      $vName = filter_var($vName, FILTER_SANITIZE_STRING);

      if ($vName === '') {

        $validation++;

      }

    } else {

      // If name is empty on arrival
      $validation++;
    }

  } else {

    // If txtName is not set
    $validation++;
  }

// END OF FIRST NAME VALIDATION

  //------------------------- SURNAME VALIDATION ----------------------------
  if (isset($_POST['txtSurname'])) {

    $vSurname = ucfirst(strtolower(trim($_POST['txtSurname'])));

    if ($vSurname !== '') {

      // Remove harmful characters from password
      $vSurname = filter_var($vSurname, FILTER_SANITIZE_STRING);

      if ($vSurname === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF SURNAME VALIDATION

// ------------------------- EMAIL VALIDATION ----------------------------

  if (isset($_POST['txtEmail'])) {

    $vEmail = strtolower(trim($_POST['txtEmail']));

    // If sent username is not blank.
    if ($vEmail !== '') {

      //sanitize email address(Remove harmful characters)
      $vEmail = filter_var($vEmail, FILTER_SANITIZE_EMAIL);

      if ($vEmail !== ''){

        // Validate email address(Check that email has correct structure)
        if(!filter_var($vEmail, FILTER_VALIDATE_EMAIL)) {

          // If email does not validate
          $validation++;

        }

      } else {

        // if $vEmail is empty after sanitisation
        $validation++;

      }

    } else {

      // if $vEmail is empty on arrival
      $validation++;

    }

  } // END OF EMAIL VALIDATION



  //------------------------- MOBILE VALIDATION ----------------------------
  if (isset($_POST['txtMobile'])){

    $vMobile = trim($_POST['txtMobile']);

    if ($vMobile !== '') {

      // Remove harmful characters from password
      $vMobile = filter_var($vMobile, FILTER_SANITIZE_NUMBER_INT);

      if($vMobile === ''){

        // If mobile is empty after sanitisation
        $validation++;
      }

    } else {

      // If mobile is empty on arrival
      $validation++;
    }

  } else {

    // If mobile is not set
    $validation++;

  } // END OF MOBILE VALIDATION

  //------------------------- LANDLINE VALIDATION ----------------------------
  if (isset($_POST['txtLandline'])){

    $vLandline = trim($_POST['txtLandline']);

    if ($vLandline !== '') {

      // Remove harmful characters from password
      $vLandline = filter_var($vLandline, FILTER_SANITIZE_NUMBER_INT);

      if($vLandline === ''){

        // If mobile is empty after sanitisation
        $validation++;
      }

    } else {

      // If mobile is empty on arrival
      $validation++;
    }

  } else {

    // If mobile is not set
    $validation++;

  } // END OF LANDLINE VALIDATION

  // ----------------------- ADDRESS LINE 1 VALIDATION ---------------------

  if (isset($_POST['txtAdd1'])) {
    $vAdd1 = ucfirst(strtolower(trim($_POST['txtAdd1'])));

    if ($vAdd1 !== '') {

      // Remove harmful characters from password
      $vAdd1 = filter_var($vAdd1, FILTER_SANITIZE_STRING);

      if ($vAdd1 === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF ADDRESS LINE 1 VALIDATION

  // ----------------------- ADDRESS LINE 2 VALIDATION ---------------------

  if (isset($_POST['txtAdd2'])) {
    $vAdd2 = ucfirst(strtolower(trim($_POST['txtAdd2'])));

    if ($vAdd2 !== '') {

      // Remove harmful characters from password
      $vAdd2 = filter_var($vAdd2, FILTER_SANITIZE_STRING);

      if ($vAdd2 === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF ADDRESS LINE 2 VALIDATION


  // ----------------------- ADDRESS LINE 3 VALIDATION ---------------------

  if (isset($_POST['txtAdd3'])) {
    $vAdd3 = ucfirst(strtolower(trim($_POST['txtAdd3'])));

    if ($vAdd3 !== '') {

      // Remove harmful characters from password
      $vAdd3 = filter_var($vAdd3, FILTER_SANITIZE_STRING);

      if ($vAdd3 === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF ADDRESS LINE 3 VALIDATION

  // ----------------------- SUBURB VALIDATION ---------------------

  if (isset($_POST['txtSuburb'])) {
    $vSuburb = ucfirst(strtolower(trim($_POST['txtSuburb'])));

    if ($vSuburb !== '') {

      // Remove harmful characters from password
      $tSuburb = filter_var($vSuburb, FILTER_SANITIZE_STRING);

      if ($vSuburb === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF SUBURB VALIDATION

  // ----------------------- CITY VALIDATION ---------------------

  if (isset($_POST['txtCity'])) {
    $vCity = ucfirst(strtolower(trim($_POST['txtCity'])));

    if ($vCity !== '') {

      // Remove harmful characters from password
      $vCity = filter_var($vCity, FILTER_SANITIZE_STRING);

      if ($vCity === ''){
        $validation++;
      }

    } else {

      // If surname is empty on arrival
      $validation++;
    }

  } else {

    // If surname is not set
    $validation++;

  } // END OF CITY VALIDATION


  // ----------------------- VALIDATION FUNCTIONS --------------------------
  if($validation !== 0) {

    $qs = '?kval=failed';
    $qs .= '&txtSecurity=' . $_SESSION['svSecurity'];
    $qs .= '&txtId=' . $vid;
    $qs .= '&txtpw=' . $vpswmatch;
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kemail=".urlencode($vEmail);
    $qs .= "&kmobile=".urlencode($vMobile);

   header('Location: admin-update-display.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

    // ------------------------- EMAIL DUPLICATE CHECK -----------------------

    $sql_dup_email = "SELECT cemail FROM tblcms WHERE cemail = '$vEmail' AND cid != $vid";

    // Connect to mysql server
    require('inc-conn.php');

    $rs_dup_email = mysqli_query($vconn_creativeangels, $sql_dup_email);

    // Count how many rows have the same email
    $rs_dup_email_rows = mysqli_num_rows($rs_dup_email);

    // Single quotations makes everything inside a string doubles used with variables
    if($rs_dup_email_rows > 0) {
      $qs = '?kemaildup=emaildup';
      $qs .= "&kname=".urlencode($vName);
      $qs .= "&ksurname=".urlencode($vSurname);
      $qs .= "&kpassword=".urlencode($vpswmatch);
      $qs .= "&kmobile=".urlencode($vMobile);

      // Redirect back to admin-add-new.php
      header('Location: admin-update-display.php' . $qs);
      exit();

    } else {

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      // ---------------------- UPDATE DATABASE --------------------------

      // The proper way to insert sql statement (SQL Injection)
      // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
      $sql_admin_update = sprintf("UPDATE tblcms SET cname = %s, csurname = %s, ",
        escapestring($vconn_creativeangels, $vName, 'text'),
        escapestring($vconn_creativeangels, $vSurname, 'text')
      );

      // Check if password was changed
      if ($vPassword1 !== ''){

         $sql_admin_update .= sprintf("cpassword = %s, ",
           escapestring($vconn_creativeangels, sha1($vPassword1), 'text')
         );

       }

      $sql_admin_update .= sprintf("cemail = %s, cmobile = %s WHERE cid = $vid",
        escapestring($vconn_creativeangels, $vEmail, 'text'),
        escapestring($vconn_creativeangels, $vMobile, 'text')
      );

      // Execute insert statement
      $vadmin_update_results = mysqli_query($vconn_creativeangels, $sql_admin_update);

      if($vadmin_update_results) {


        // ------------------- PW OR EMAIL CHECK ----------------------------

        // Create query string to check if the password and email has changed

        if($_SESSION['svcemail'] !== $vEmail || $vPassword1 !== '' && $vid === $_SESSION['svcid']) {

          session_destroy();
          header('Location: ../cms-signin.php?kpwupdate=success');
          exit();

        } else {

          // query to trigger notification
          $qs = 'kupdate=success';

          header('Location: admin-display.php?' . $qs );
          exit();

        }

      } else {

        header('Location: signout.php');
        exit();

      }

    } // END OF EMAIL & PW  DB METHODS

  } // END OF VALIDATION METHOD

} else { // END OF PROCESS

  header('Location:signout.php');
  exit();
}
?>
