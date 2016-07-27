<?php  session_start();

  if (isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    $vvalidation = 0;
    //$vvalidationusername = 0;
    //$vvalidationpassword = 0;


    // USERNAME VALIDATION START
    if (isset($_POST['txtEmail'])) {

      $vusername = trim($_POST['txtEmail']);

      if ($vusername !== '') {

        $vusername = filter_var($vusername, FILTER_SANITIZE_EMAIL);

        if ($vusername !== '') {

          if (!filter_var($vusername, FILTER_VALIDATE_EMAIL)) {

            $vvalidation++;

          }

        } else {

          $vvalidation++;

        }

      } else {

        $vvalidation++;

      }

    }
    // USERNAME VALIDATION END

    // PASSWORD VALIDATION START
    if (isset($_POST['txtPassword'])) {

      $vpassword = trim($_POST['txtPassword']);

      if ($vpassword !== '') {

        $vpassword = filter_var($vpassword, FILTER_SANITIZE_STRING);

        if ($vpassword === '') {

            $vvalidation++;

          }

      } else {

        $vvalidation++;

      }

    }
    // PASSWORD VALIDATION END

    if ($vvalidation > 0) {

      session_destroy();

      header('Location: cms-signin.php?valfailed=invdet');
      exit();

    } else {

      require('inc-conn.php');

      require('inc-function-escapestring.php');

      $sql_cms_signin = sprintf("SELECT * FROM tblcms WHERE cemail = %s AND cpassword = %s AND cstatus = 'a'",
      escapestring($vconn_creativeangels, $vusername, 'text'),
      escapestring($vconn_creativeangels, sha1($vpassword), 'text')
      );

      $rs_cms_signin = mysqli_query($vconn_creativeangels, $sql_cms_signin);

      $rs_cms_signin_total = mysqli_num_rows($rs_cms_signin);

      $rs_cms_details_rows = mysqli_fetch_assoc($rs_cms_signin);

      if ($rs_cms_signin_total === 1) {

        $_SESSION['svcid'] = $rs_cms_details_rows['cid'];
        $_SESSION['svccreated'] = $rs_cms_details_rows['ccreated'];
        $_SESSION['svcmodified'] = $rs_cms_details_rows['cupdated'];
        $_SESSION['svcname'] = $rs_cms_details_rows['cname'];
        $_SESSION['svcsurname'] = $rs_cms_details_rows['csurname'];
        $_SESSION['svcmobile'] = $rs_cms_details_rows['cmobile'];
        $_SESSION['svcaccesslevel'] = $rs_cms_details_rows['caccesslevel'];
        $_SESSION['svcstatus'] = $rs_cms_details_rows['cstatus'];

        header('Location: cms/cms-homepage.php');
        exit();

      } else {

        session_destroy();

        header('Location: cms-signin.php?valfailed=incdet');
        exit();

      }

    }

  } else {

    session_destroy();

    header('Location: signout.php');
    exit();

  }

 ?>
