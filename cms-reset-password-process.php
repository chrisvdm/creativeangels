<?php  session_start();

  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    $vvalidation = 0;

  // -------------- PASSWORDS VALIDATION ------------------------------

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


    // ------------------------- NAME VALIDATION -----------------------------

    if (isset($_POST['txtName']) && $_POST['txtName'] !== '') {

      $vname = trim($_POST['txtName']);


      } else {

        $vvalidation++;

    }
    // NAME VALIDATION END

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

      $vencqs = urlencode(base64_encode('kid'));
      $vencqs .= '=';
      $vencqs .= urlencode(base64_encode($vid));
      $vencqs .= '&';
      $vencqs .= urlencode(base64_encode('kname'));
      $vencqs .= '=';
      $vencqs .= urlencode(base64_encode($vname));
      $vencqs .= '&';
      $vencqs .= urlencode(base64_encode('kemail'));
      $vencqs .= '=';
      $vencqs .= urlencode(base64_encode($vemail));
      $vencqs .= '&kvalidation=failed';

      header('Location: cms-reset-password.php?' . $vencqs);

      exit();

    } else {
      // VALIDATION PASSED

      // ------------------------- UPDATE PASSWORD ----------------------------

      // Get connection file
      require('inc-conn.php');

      // Get escape function
      require('inc-function-escapestring.php');

      // Creating query string
      $sql_update = sprintf("UPDATE tblcms SET cpassword = %s WHERE cid = $vid",
      escapestring($vconn_creativeangels, sha1($vPassword2), 'text')
      );

      // Execute update statement
      $vupdate_result = mysqli_query($vconn_creativeangels, $sql_update);

      // validate results
      if($vupdate_result){

        // Send email
        require ('inc-function-auto-email.php');

        $vto = 'nymanchristine@gmail.com';
        $vfrom = 'Christine Nyman<info@christinenyman.com>';
        $vsubject = 'Password has been updated';

        $vmessage = '
          <p>Your account password has been updated. Use your new password to signin.</p>
          <a href="http://www.christinenyman.com/projects/creativeangels/cms-signin.php?kpwupdate=success">Go to sign in page</a>
          <p>If you did not change your password please email the admin staff:</p>
          <p>admin@creativeangels.org.za</p>
          ';

        $mail_success = auto_mail($vto, $vname, $vfrom, $vsubject, $vmessage);

        // redirect to signin page on successful sending of email
        if($mail_success){

          header('location: cms-signin.php?kpwupdate=success');
          exit();

        } else {

          // IF PASSWORD UPDATE FAILED
          header('location: cms-reset-password.php?kpwemail=failed');
          exit();

        }


      } else {

        // IF PASSWORD UPDATE FAILED
        header('location: cms-lost-password.php?kpwupdate=failed');
        exit();

      }

    } // END OF VALIDATION ACTIONS

  } else {

    // ------------------------ SECURITY CHECK FAILED -------------------------

    session_destroy();

    header('Location: signout.php');
    exit();

  }

 ?>
