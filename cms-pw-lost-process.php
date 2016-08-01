<?php session_start(); ?>
<?php
  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    // Variable that is used to check for validation.
    $vvalidation = 0;

    // ------------------------- EMAIL VALIDATION ----------------------------

      if (isset($_POST['txtEmail']) && $_POST['txtEmail'] !== '') {

        $vemail = trim($_POST['txtEmail']);

        // If sent email is not blank.
        if ($vemail !== '') {

          // Sanitize email address(Remove harmful characters)
          $vemail = filter_var($vemail, FILTER_SANITIZE_EMAIL);

          if ($vemail !== ''){

            // Validate email address (Check that email has correct structure)
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

      // ------------------------ VALIDATION PASSED --------------------------
      // Get connection file
      require('inc-conn.php');

      require('inc-function-escapestring.php');

      // Create query string (sprintf = Convert this into a basic string and assign it to a variable. )
      $sql_pw_lost = sprintf("SELECT * FROM tblcms WHERE cemail = %s AND cstatus = 'a'",
      escapestring($vconn_creativeangels, $vemail, 'text')
      );

      // Execute SQL statement (database, sql statement)
      $rs_pw_lost = mysqli_query($vconn_creativeangels, $sql_pw_lost);

      // Counts the relative entries
      $rs_pw_lost_total = mysqli_num_rows($rs_pw_lost);

      // Extract first recordset from database that matches the criteria and stores it in an associative array
      $rs_pw_lost_rows = mysqli_fetch_assoc($rs_pw_lost);

      // if there is only one entry with the entered email
      if ($rs_pw_lost_total === 1) {

        // Assign key/value pairs to variables
        $vid = $rs_pw_lost_rows['cid'];
        $vname = $rs_pw_lost_rows['cname'];
        $vsurname = $rs_pw_lost_rows['csurname'];
        $vemail = $rs_pw_lost_rows['cemail'];

        // ENCODE QUERY STRING
        // Both the keys and values need to be encoded
        $vencqs = urlencode(base64_encode('kid'));
        $venqs .= '=';
        $venqs .= urlencode(base64_encode($vid));
        $venqs .= '&';
        $venqs .= urlencode(base64_encode('kemail'));
        $venqs .= '=';
        $venqs .= urlencode(base64_encode($vemail));



        //------------------------- SEND AUTO EMAIL --------------------------

        // User to whom the email confirmation should be sent
        $vto = 'nymanchristine@gmail.com';

        // Subject
        $vsubject = 'Password Reset';

        // HTML email message
        $vmessage = '
        <html>
          <head>
            <meta charset="utf-8">
            <title>Creative Angels | Reset Password </title>
          </head>
          <body>
            <table style="background-color: #ffffff; font-family: Arial, Verdana, Tahoma; font-size: 14px; letter-spacing: 0.03em; word-spacing: 0.2em; line-height: 1.6em;" cellspacing="0" width="600">
              <tr>
                <td>
                  <img style="text-align: center" src="http://www.christinenyman.com/projects/creativeangels/sources/logos/creative-angels-email-logo.gif">
                </td>
              </tr>
              <tr>
                <td style="padding: 6px">
                  <p><br><strong>Dear ' . $vname . '</strong></p>
                  <p>To reset your password please click on this link: <a href="http://www.christinenyman.com/projects/creativeangels/cms-reset-password.php?' . $vencqs . '">Reset your password</a></p>
                  <p>Alternatively you can copy the following link and paste into your browser\'s address bar.</p>
                  <p><a href="http://www.christinenyman.com/projects/creativeangels/cms-reset-password.php?' . $vencqs . '">http://www.christinenyman.com/projects/creativeangels/cms-reset-password.php?' . $vencqs . '</a>
                  <p>Yours faithfully</p>
                  <p><strong>The All Powerful Webmaster</strong></p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  </td>
              </tr>
            </table>
          </body>
        </html>
        ';

        // To send HTML mail you can set the Content-type header
        // Must be in double-quotes
        $vheaders = "MIME-Version: 1.0\r\n";
        $vheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $vheaders .= "From: christinenyman.com<info@christinenyman.com>\r\n";

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

        $qs = '?kval=failed';
        header('Location: cms-pw-lost.php' . $qs);
        exit();

      }

    }

  } else {

    // If security check fails
    header('Location: signout.php');
    exit();

  }

 ?>
