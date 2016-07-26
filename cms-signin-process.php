<?php session_start(); ?>
<?php
//---------------------------- SECURITY CHECK --------------------------------
  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    // Variable that is used to check for vvalidation.
    $vvalidation = 0;

    // ------------------------- EMAIL VALIDATION ---------------------------
    if (isset($_POST['txtEmail'])) {

      // Create a variable, and assign it a value equal to the sent username, trimmed.
      $vemail = trim($_POST['txtEmail']);

      // If sent username is not blank.
      if ($vemail != '') {

        //sanitize email address(Remove harmful characters)
        $vemail = filter_var($vemail, FILTER_SANITIZE_EMAIL);

        if ($vemail != ''){

          // Validate email address(Check that email has correct structure)
          if(!filter_var($vemail, FILTER_VALIDATE_EMAIL)){

            // If email does not validate
            $vvalidation++;

          }

        } else {

          // if $vemail is empty after sanitisation
          $vvalidation++;

        }

      } else {

        // if $vemail is empty on arrival
        $vvalidation++;

      }

    } // END OF EMAIL VALIDATION

    // ------------------------ PASSWORD VALIDATION --------------------------
    if (isset($_POST['txtPassword'])) {

      $vpassword = trim($_POST['txtPassword']);

      if ($vpassword != '') {

        // Remove harmful characters from password
        $vpassword = filter_var($vpassword, FILTER_SANITIZE_STRING);

        if ($vpassword === '') {

          // If password is empty after sanitisation
          $vvalidation++;

        }

      } else {

        // If password is empty on arrival
        $vvalidation++;

      }

    } // END OF PASSWORD VALIDATION

    // If any validation errors occured, the validation variable will be higher than 0, in which case the sessions is destroyed, and the user is redirected back to the signin page, with a GET value appended that will cause and error message to display for the user.
    if ($vvalidation > 0) {

      session_destroy();

      header('Location: cms-signin.php?valfailed=1');
      exit();

    } else {

      require('inc-conn.php');

      require('inc-function-escapestring.php');

      $sql_cms_signin = sprintf("SELECT * FROM tblcms WHERE cemail = %s AND cpassword = %s AND cstatus = 'a'",
      escapestring($vconn_creativeangels, $vemail, 'text'),
      escapestring($vconn_creativeangels, sha1($vpassword), 'text')
      );

      $rs_cms_signin = mysqli_query($vconn_creativeangels, $sql_cms_signin);

      $rs_cms_signin_total = mysqli_num_rows($rs_cms_signin);

      $rs_cms_rows = mysqli_fetch_assoc($rs_cms_signin);

      if ($rs_cms_signin_total === 1) {

        // create session var
        $_SESSION['svcid'] = $rs_cms_rows['cid'];
        $_SESSION['svccreated'] = $rs_cms_rows['ccreated'];
        $_SESSION['svcupdated'] = $rs_cms_rows['cupdated'];
        $_SESSION['svcstatus'] = $rs_cms_rows['cstatus'];
        $_SESSION['svcaccesslevel'] = $rs_cms_rows['caccesslevel'];
        $_SESSION['svcname'] = $rs_cms_rows['cname'];
        $_SESSION['svcsurname'] = $rs_cms_rows['csurname'];
        $_SESSION['svcemail'] = $rs_cms_rows['cemail'];
        $_SESSION['svcmobile'] = $rs_cms_rows['cmobile'];

        header('Location: cms/cms-homepage.php');
        exit();

      } else {

        // Kills session and avoids adding unnnecesary strain on server
        session_destroy();

        $qs = '?kmatch=0';
        header('Location: cms-signin.php' . $qs);
        exit();

      }

    }

  } else {

    header('Location: signout.php');
    exit();

  }

 ?>
