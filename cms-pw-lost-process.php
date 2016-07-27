<?php session_start(); ?>
<?php

  if (isset($_POST['txtEmail']) && $_POST['txtEmail'] !== '') {

    // Variable that is used to check for vvalidation.
    $vvalidation = 0;

    // ------------------------- EMAIL VALIDATION ----------------------------

      if (isset($_POST['txtEmail'])) {

        $vemail = trim($_POST['txtEmail']);

        // If sent username is not blank.
        if ($vemail !== '') {

          //sanitize email address(Remove harmful characters)
          $vemail = filter_var($vemail, FILTER_SANITIZE_EMAIL);

          if ($vemail !== ''){

            // Validate email address(Check that email has correct structure)
            if(!filter_var($vemail, FILTER_VALIDATE_EMAIL)) {

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


    // validation fail
    if ($validation > 0) {

      session_destroy();

      header('Location: cms-pw-lost.php?kval=failed');
      exit();

    } else {

      // Validation passed
      require('inc-conn.php');

      require('inc-function-escapestring.php');

      $sql_pw_lost = sprintf("SELECT * FROM tblcms WHERE cemail = %s AND cstatus = 'a'",
      escapestring($vconn_creativeangels, $vemail, 'text')
      );

      $rs_pw_lost = mysqli_query($vconn_creativeangels, $sql_pw_lost);

      $rs_pw_lost_total = mysqli_num_rows($rs_pw_lost);

      $rs_pw_lost_rows = mysqli_fetch_assoc($rs_pw_lost);

      // if there is one entry with the entered email
      if ($rs_pw_lost_total === 1) {

        //------------------------- SEND AUTO EMAIL -------------------------

        // User to whom the email confirmation should be sent
        $vto = 'nymanchristine@gmail.com';

        // Subject
        $vsubject = 'Lost Password';

        // HTML email message
        $vmessage = 'LOL! You lost your password';

        // To send HTML mail you can set the Content-type header
        $vheaders = 'MIME-Version: 1.0\r\n';
        $vheaders .= 'Content-type: text/html; charset=iso-8859-1\r\n';
        $vheaders .= 'From: christinenyman.com<info@christinenyman.com>\r\n';

        // ADDITIONAL HEADERS
        // $vheaders = 'To: Mary<mary@gmail.com>, John<john@gmail.com>\r\n';
        // $vheaders .= 'Cc: peter@gmail.com\r\n';
        // $vheaders .= 'Bcc: sue@gmail.com\r\n';

        // SEND THE MAIL

        $vemailsent = mail($vto, $vsubject, $vmessage, $vheaders);

        // Check if mail has been sent
        if($vemailsent){
          $qs = '?kmail=sent';

          header('Location: cms-pw-lost.php' . $qs);
          exit();

        } else {

          $qs = '?kmail=notsent';

          header('Location: cms-pw-lost.php' . $qs);
          exit();

        }

        exit();

      } else {

        //If more than one entry of an email
        // Kills session and avoids adding unnnecesary strain on server
        session_destroy();

        $qs = '?kmatch=0';
        header('Location: cms-pw-lost.php' . $qs);
        exit();

      }

    }

  } else {

    header('Location: signout.php');
    exit();

  }

 ?>
