<?php  session_start();

  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    // -------------------- PASSWORD VALIDATION ----------------------------------

    if (isset($_POST['txtPw1'])) {

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

      } // END OD PASSWORD1 VALIDATION

    } else {

      // If one of the passwords weren't set
      $vvalidation++;
      //$vpswmatch = 'failed';

    } // END OF PASSWORD VALIDATION


    if(isset($_POST['txtPw2'])){

      $vPassword2 = trim($_POST['txtPw2']);

      if ($vPassword2 !== '') {

        // Remove harmful characters from password
        $vPassword2 = filter_var($vPassword2, FILTER_SANITIZE_STRING);

        if ($vPassword2 === '') {

          // If Password 2 is empty after sanitisation
          $vvalidation++;
        //  $vpswmatch = 'failed';
        }

      } else {

        // If password 2 is empty on arrival
        $vvalidation++;
        //$vpswmatch = 'failed';

      }

    } else {

      // If one of the passwords weren't set
      $vvalidation++;
      //$vpswmatch = 'failed';

    } // END OF PASSWORD VALIDATION


    // Check if passwords entered match
    if ($vPassword1 !== $vPassword2) {

      $vvalidation++;
      //$vpswmatch = '0';

    } elseif ( $vPassword1 === '' && $vPassword2 === '' ) {

      $vvalidation++;

    }



    // EMAIL VALIDATION START -----------------------------------------------
    if (isset($_POST['txtEmail'])) {

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

    } else {
      $vvalidation++;
    }
    // USERNAME VALIDATION END

    // ID VALIDATION START
    if (isset($_POST['txtId'])) {

      $vid = trim($_POST['txtId']);

      if ($vid !== '') {

        $vid = filter_var($vid, FILTER_SANITIZE_STRING);

        if ($vid === '') {

            $vvalidation++;

          }

        } else {

          $vvalidation++;

        }

      } else {

        $vvalidation++;


    }
    // USERNAME VALIDATION END

    if ($vvalidation > 0) {

      session_destroy();

      header('Location: cms-reset-password.php');
      exit();

    } else {

      echo 'Id ' . $vid . '<br>' . 'Email: ' . $vemail;

    }

  } else {
    // SESSION NOT VALID
    session_destroy();

    header('Location: signout.php');
    exit();

  }

 ?>
