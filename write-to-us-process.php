<?php
// ----------------------- RECAPCHA VERIFICATION -----------------------------
session_start();
//require_once('recaptchalib.php');
$url = "https://www.google.com/recaptcha/api/siteverify";

$captcha = $_POST['g-recaptcha-response'];

$secret = '6LfaticTAAAAAD_fCrhzljFuMC8WJ3IAzRrj4IDL';

//$response = $_POST['g-recaptcha-response'];

$resp = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);

echo $resp;
exit();

if (!$resp->is_valid) {

  // What happens when the CAPTCHA was entered incorrectly
  die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .

       "(reCAPTCHA said: " . $resp->error . ")");

} else {
  // RECAPCHA VERIFICATION PASSED
  session_start();

  $validation = 0;

  // ------------------------- NAME VALIDATION ---------------------------------

  if(isset($_POST['txtName']) && $_POST['txtName'] !== '') {

    $vName = ucfirst(strtolower(trim($_POST['txtName'])));

    if ($vName !== '') {

      $vName = filter_var($vName, FILTER_SANITIZE_STRING);

      if ( $vName === '') {

        $vName = 'Anonymous';

      }

    } else {

      $vName = 'Anonymous';

    }

  } else {

    $vName = 'Anonymous';

  } // Name Validation

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

  // ---------------------- MESSAGE VALIDATION -------------------------------
  if(isset($_POST['txtMessage']) && $_POST['txtMessage'] !== '') {

    $vMsg = trim($_POST['txtMessage']);

    if ($vMsg !== '') {

      $vMsg = filter_var($vMsg, FILTER_SANITIZE_STRING);

      if ( $vMsg === '') {

        $validation++;

      }

    } else {

      $validation++;

    }

  } else {

    $validation++;

  }

  if ($validation === 0) {

    //------------------------- SEND AUTO EMAIL --------------------------

    $eto = 'nymanchristine@gmail.com';

    $esubject = 'Website Enquiry: ' . $vName;

    // To send HTML mail you can set the Content-type header
    // Must be in double-quotes
    $eheaders = "MIME-Version: 1.0\r\n";
    $eheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $eheaders .= "From: ". $vEmail . "\r\n";

    // ADDITIONAL HEADERS
    // $vheaders = 'To: Mary<mary@gmail.com>, John<john@gmail.com>\r\n';
    // $vheaders .= 'Cc: peter@gmail.com\r\n';
    // $vheaders .= 'Bcc: sue@gmail.com\r\n';

    // SEND THE MAIL
    $eresults = mail($eto, $esubject, $vMsg, $eheaders);

    if($eresults) {

      $qs = '?email=sent';

      header('location: contact.php' . $qs);
      exit();
    }

  } else {

    $qs = '?kval=failed';
    $qs .= '&kemail=' . $vEmail;
    $qs .= '&kmsg' . $vMsg;


    header('location: contact.php' . $qs);
    session_destroy();

    exit();

  }
}
?>
