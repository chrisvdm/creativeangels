<?php  session_start();

  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    $vvalidation = 0;

  // -------------------- PASSWORDS VALIDATION --------------------------------

  // PASSWORD 1 VALIDATION
    if (isset($_POST['txtPw1']) && $_POST['txtPw1'] !== '') {

      $vPassword1 = trim($_POST['txtPw1']);

      if ($vPassword1 !== '') {

        // Remove harmful characters from password
        $vPassword1 = filter_var($vPassword1, FILTER_SANITIZE_STRING);

        if($vPassword1 === ''){

          // If Password 1 is empty after sanitisation
          $vvalidation++;
          //$vpswmatch = 'failed';
        }

      } else {

        // If password 1 is empty on arrival
        $vvalidation++;
        //$vpswmatch = 'failed';

      }

    } else {

      // If one of the passwords weren't set
      $vvalidation++;
      //$vpswmatch = 'failed';

    } // END OF PASSWORD 1 VALIDATION

    // PASSWORD 2 VALIDATION
    if(isset($_POST['txtPw2']) && $_POST['txtPw2'] !== ''){

      $vPassword2 = trim($_POST['txtPw2']);

      if ($vPassword2 !== '') {

        // Remove harmful characters from password
        $vPassword2 = filter_var($vPassword2, FILTER_SANITIZE_STRING);

        if ($vPassword2 === '') {

          // If Password 2 is empty after sanitisation
          $vvalidation++;
        }

      } else {

        // If password 2 is empty on arrival
        $vvalidation++;

      }

    } else {

      // If one of the passwords weren't set
      $vvalidation++;

    } // END OF PASSWORD 2 VALIDATION


    // Check if passwords entered match
    if ($vPassword1 !== $vPassword2) {

      $vvalidation++;

    } elseif ( $vPassword1 === '' && $vPassword2 === '' ) {

      $vvalidation++;

    } // END OF PASSWORD MATCH VAL


    // ------------------------- EMAIL VALIDATION -----------------------------

    if (isset($_POST['txtEmail']) && $_POST['txtEmail'] !== '') {

      $vemail = trim($_POST['txtEmail']);

      if ($vemail !== '') {

        $vemail = filter_var($vemail, FILTER_SANITIZE_EMAIL);

        if ($vemail !== '') {

          if (!filter_var($vemail, FILTER_VALIDATE_EMAIL)) {

            $vvalidation++;

          }

        } else {

          $vvalidation++;

        }

      } else {

        $vvalidation++;

      }

    }
    // EMAIL VALIDATION END

    // ----------------------- ID VALIDATION START ---------------------------

    if (isset($_POST['txtId']) && $_POST['txtId'] !== '') {

      $vid = $_POST['txtId'];

      } else {

        $vvalidation++;

      }

    // ID VALIDATION END

    //----------------------- VALIDATION ACTIONS -------------------------------

    if ($vvalidation !== 0) {
      //VALIDATION FAILED

      $kid = base64_encode('kid');
      $vid = base64_encode($vid);

      $kemail = base64_encode('kemail');
      $vemail = base64_encode($vemail);

      header('Location: cms-reset-password.php?' . $kid . '=' . $vid . '&' . $kemail . '=' . $vemail . '&kvalidation=failed');

      exit();

    } else {
      // VALIDATION

      echo $vid;
      echo $vemail;
      echo $vpassword2;

    } // END OF VALIDATION ACTIONS

  } else {

    // ------------------------ SECURITY CHECK FAILED -------------------------

    session_destroy();

    header('Location: signout.php');
    exit();

  }

 ?>
