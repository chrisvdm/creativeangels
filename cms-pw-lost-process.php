<?php session_start(); ?>
<?php

  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    // Variable that is used to check for vvalidation.
    $vvalidation = 0;

    // If value of 'txtUsername' was sent .
    if (isset($_POST['txtEmail'])) {

      // Create a variable, and assign it a value equal to the sent username, trimmed.
      $vemail = trim($_POST['txtEmail']);

      // If sent email address is blank, increment the validation variable.
      if ($vemail === '') {

        $vvalidation++;

      }

    }

    // If any validation errors occured, the validation variable will be higher than 0, in which case the sessions is destroyed, and the user is redirected back to the signin page, with a GET value appended that will cause and error message to display for the user.
    if ($vvalidation > 0) {

      session_destroy();

      header('Location: cms-pw-lost.php?kval=failed');
      exit();

    } else {

      require('inc-conn.php');

      require('inc-function-escapestring.php');

      $sql_pw_lost = sprintf("SELECT * FROM tblcms WHERE cemail = %s AND cstatus = 'a'",
      escapestring($vconn_creativeangels, $vemail, 'text')
      );

      $rs_pw_lost = mysqli_query($vconn_creativeangels, $sql_pw_lost);

      $rs_pw_lost_total = mysqli_num_rows($rs_pw_lost);

      $rs_pw_lost_rows = mysqli_fetch_assoc($rs_pw_lost);

      if ($rs_pw_lost_total === 1) {

        echo $rs_pw_lost_rows['cname'].' '.$rs_pw_lost_rows['csurname'];
        exit();

      } else {

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
