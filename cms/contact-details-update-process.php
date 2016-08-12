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
  } // END OF FIRST NAME VALIDATION

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

  //------------------------- TITLE VALIDATION ----------------------------
  if (isset($_POST['txtTitle'])) {

    $vTitle = ucfirst(strtolower(trim($_POST['txtTitle'])));

    if ($vTitle !== '') {

      // Remove harmful characters from password
      $vTitle = filter_var($vTitle, FILTER_SANITIZE_STRING);

      if ($vTitle === ''){
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

    }

  } // END OF EMAIL VALIDATION

  //------------------------- MOBILE VALIDATION ----------------------------

  if (isset($_POST['txtMobile'])) {

    $vMobile = trim($_POST['txtMobile']);

    if ($vMobile !== '') {

      // Remove harmful characters from password
      $vMobile = filter_var($vMobile, FILTER_SANITIZE_NUMBER_INT);

    }

  } // END OF MOBILE VALIDATION

  //------------------------- LANDLINE VALIDATION ----------------------------

  if (isset($_POST['txtLandline'])) {

    $vLandline = trim($_POST['txtLandline']);

    if ($vLandline !== '') {

      // Remove harmful characters from password
      $vLandline = filter_var($vLandline, FILTER_SANITIZE_NUMBER_INT);

    }

  } // END OF LANDLINE VALIDATION

  // ----------------------- ADDRESS LINE 1 VALIDATION ---------------------

  if (isset($_POST['txtAdd1'])) {
    $vAdd1 = ucfirst(strtolower(trim($_POST['txtAdd1'])));

    if ($vAdd1 !== '') {

      // Remove harmful characters from password
      $vAdd1 = filter_var($vAdd1, FILTER_SANITIZE_STRING);

    }

  } // END OF ADDRESS LINE 1 VALIDATION

  // ----------------------- ADDRESS LINE 2 VALIDATION ---------------------

  if (isset($_POST['txtAdd2'])) {
    $vAdd2 = ucfirst(strtolower(trim($_POST['txtAdd2'])));

    if ($vAdd2 !== '') {

      // Remove harmful characters from password
      $vAdd2 = filter_var($vAdd2, FILTER_SANITIZE_STRING);
    }

  } // END OF ADDRESS LINE 2 VALIDATION


  // ----------------------- ADDRESS LINE 3 VALIDATION ---------------------

  if (isset($_POST['txtAdd3'])) {
    $vAdd3 = ucfirst(strtolower(trim($_POST['txtAdd3'])));

    if ($vAdd3 !== '') {

      // Remove harmful characters from password
      $vAdd3 = filter_var($vAdd3, FILTER_SANITIZE_STRING);

    }

  } // END OF ADDRESS LINE 3 VALIDATION

  // ----------------------- SUBURB VALIDATION ---------------------

  if (isset($_POST['txtSuburb'])) {
    $vSuburb = ucfirst(strtolower(trim($_POST['txtSuburb'])));

    if ($vSuburb !== '') {

      // Remove harmful characters from password
      $vSuburb = filter_var($vSuburb, FILTER_SANITIZE_STRING);
    }

  } // END OF SUBURB VALIDATION

  // ----------------------- CITY VALIDATION ---------------------

  if (isset($_POST['txtCity'])) {
    $vCity = ucfirst(strtolower(trim($_POST['txtCity'])));

    if ($vCity !== '') {

      // Remove harmful characters from password
      $vCity = filter_var($vCity, FILTER_SANITIZE_STRING);

      if ($vCity === '') {
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

  // ----------------------- POSTAL CODE VALIDATION ---------------------

  if (isset($_POST['txtPostalCode'])) {

    $vPostal = ucfirst(strtolower(trim($_POST['txtPostalCode'])));

    if ($vPostal !== '') {

      // Remove harmful characters from password
      $vPostal = filter_var($vPostal, FILTER_SANITIZE_STRING);

    }

  } // END OF POSTAL CODE VALIDATION


  // ----------------------- VALIDATION FUNCTIONS --------------------------

  // Validation fail
  if($validation !== 0) {

    $qs = '?kval=failed';
    $qs .= '&txtSecurity=' . $_SESSION['svSecurity'];
    $qs .= '&txtId=' . $vid;
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kTitle=".urlencode($vTitle);
    $qs .= "&kemail=".urlencode($vEmail);
    $qs .= "&kmobile=".urlencode($vMobile);
    $qs .= "&klandline=".urlencode($vLandline);
    $qs .= "&kadd1=".urlencode($vAdd1);
    $qs .= "&kadd2=".urlencode($vAdd2);
    $qs .= "&kadd3=".urlencode($vAdd3);
    $qs .= "&ksuburb=".urlencode($vSuburb);
    $qs .= "&kcity=".urlencode($vCity);
    $qs .= "&kpostalcode=".urlencode($vPostalCode);

    // Go to show updated contact
    if($vid === '00000001'){
      $intId = base64_encode(1);
    } elseif ($vid === '00000002') {
      $intId = base64_encode(2);
    }

    $qs .= '&kid=' . $intId;

   header('Location: contact-particulars-display.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

    // ------------------------- UPDATE DATABASE -----------------------

    // Connect to mysql server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // ----------------- CREATE SQL QUERY STRING -------------------------
    $sql_contact_details_update = sprintf("UPDATE tblcontactdetails SET ccontactpersonname = %s, ccontactpersonsurname = %s, ccontactpersontitle = %s",
      escapestring($vconn_creativeangels, $vName, 'text'),
      escapestring($vconn_creativeangels, $vSurname, 'text'),
      escapestring($vconn_creativeangels, $vTitle, 'text')
    );

    // Check if email was changed
    if ($vEmail !== '') {

      $sql_contact_details_update .= sprintf("cemail = %s, ",
        escapestring($vconn_creativeangels, $vEmail, 'text')
      );

    }

    // Check if Mobile number was changed
    if ($vMobile !== '') {

      $sql_contact_details_update .= sprintf("ccell = %s, ",
        escapestring($vconn_creativeangels, $vMobile, 'text')
      );

    }

    // Check if Landline number was changed
    if ($vLandline !== '') {

      $sql_contact_details_update .= sprintf("clandline = %s, ",
        escapestring($vconn_creativeangels, $vLandline, 'text')
      );

    }

    // Check if address line 1 was changed
    if ($vAdd1 !== '') {

      $sql_contact_details_update .= sprintf("caddress1 = %s, ",
        escapestring($vconn_creativeangels, $vAdd1, 'text')
      );

    }

    // Check if address line 2 was changed
    if ($vAdd2 !== '') {

      $sql_contact_details_update .= sprintf("caddress2 = %s, ",
        escapestring($vconn_creativeangels, $vAdd2, 'text')
      );

    }

    // Check if address line 3 was changed
    if ($vAdd3 !== '') {

      $sql_contact_details_update .= sprintf("caddress3 = %s, ",
        escapestring($vconn_creativeangels, $vAdd3, 'text')
      );

    }

    // Check if suburb was changed
    if ($vSuburb !== '') {

      $sql_contact_details_update .= sprintf("csuburb = %s, ",
        escapestring($vconn_creativeangels, $vSuburb, 'text')
      );

    }

    // Update City
    $sql_contact_details_update .= sprintf("ccity = %s, ",
      escapestring($vconn_creativeangels, $vCity, 'text')
    );

    // Check if postal code was changed
    if ($vPostalCode !== '') {

      $sql_contact_details_update .= sprintf("cpostalcode = %s, ",
        escapestring($vconn_creativeangels, $vPostalCode, 'text')
      );

    }

    // END OF SQL QUERY STRING CREATION

    // Execute insert statement
    $vcontact_details_update_results = mysqli_query($vconn_creativeangels, $sql_contact_details_update);

    // ----------------- SUCCESSFUL DATABASE UPDATE-------------------------
    if($vcontact_details_update_results) {

      // Go to show updated contact
      if($vid === '00000001'){
        $intId = base64_encode(1);
      } elseif ($vid === '00000002') {
        $intId = base64_encode(2);
      }

      $qs = 'kid=' . $intId;

      // query to trigger notification
      $qs .= '&kupdate=success';

      header('Location: contact-particulars-display.php?' . $qs );
      exit();

    } else { // END OF SUCCESSFUL UPDATE

      header('Location: signout.php');
      exit();

    }

  } // END OF SUCCESFUL VALIDATION

} else { // END OF PROCESS FILE

  header('Location:signout.php');
  exit();
}
?>
