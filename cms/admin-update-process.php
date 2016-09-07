<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if( isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_POST['txtId'] !== ''){

  $vid = $_POST['txtId'];
  $validation = 0;

  // ---------------------- INPUT VALIDATION AND SANITISATION ----------------
  include_once('inc-fn-sanitize.php');

  $vName = ucfirst(strtolower(sanitize('txtName')));
  $vSurname = ucfirst(strtolower(sanitize('txtSurname')));
  $vEmail = strtolower(sanitize('txtEmail'));
  $vMobile = sanitize('txtMobile', 'int');

  if($vName && $vid === $_SESSION['svcid']){
    $_SESSION['svcname'] = $vName;
  }

  $vPassword1 = '';

  // -------------------- PASSWORD VALIDATION ----------------------------------
  if($_SESSION['svcid'] === $vid){

    $vPassword1= sanitize('txtPw1');
    $vPassword2= sanitize('txtPw2');

    // Check if passwords entered match
    if ($vPassword1 !== $vPassword2) {

      $validation++;
      $vpswmatch = 'failed';

    }
  } // End PW validation


  // ----------------------- VALIDATION FUNCTIONS --------------------------
  if(!$vName || !$vSurname || !$vEmail || !$vMobile || !$vPassword1 || $validation !== 0) {

    $qs = '?kval=failed';
    $qs .= '&txtSecurity=' . $_SESSION['svSecurity'];
    $qs .= '&txtId=' . $vid;
    $qs .= '&txtpw=' . $vpswmatch;
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kemail=".urlencode($vEmail);
    $qs .= "&kmobile=".urlencode($vMobile);

   header('Location: admin-update-display.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

    // ------------------------- EMAIL DUPLICATE CHECK -----------------------

    $sql_dup_email = "SELECT cemail FROM tblcms WHERE cemail = '$vEmail' AND cid != $vid";

    // Connect to mysql server
    require('inc-conn.php');

    $rs_dup_email = mysqli_query($vconn_creativeangels, $sql_dup_email);

    // Count how many rows have the same email
    $rs_dup_email_rows = mysqli_num_rows($rs_dup_email);

    // Single quotations makes everything inside a string doubles used with variables
    if($rs_dup_email_rows > 0) {
      $qs = '?kemaildup=emaildup';
      $qs .= "&kname=".urlencode($vName);
      $qs .= "&ksurname=".urlencode($vSurname);
      $qs .= "&kpassword=".urlencode($vpswmatch);
      $qs .= "&kmobile=".urlencode($vMobile);

      // Redirect back to admin-add-new.php
      header('Location: admin-update-display.php' . $qs);
      exit();

    } else {

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      // ---------------------- UPDATE DATABASE --------------------------

      // The proper way to insert sql statement (SQL Injection)
      // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
      $sql_admin_update = sprintf("UPDATE tblcms SET cname = %s, csurname = %s, ",
        escapestring($vconn_creativeangels, $vName, 'text'),
        escapestring($vconn_creativeangels, $vSurname, 'text')
      );

      // Check if password was changed
      if ($vPassword1 !== ''){

         $sql_admin_update .= sprintf("cpassword = %s, ",
           escapestring($vconn_creativeangels, sha1($vPassword1), 'text')
         );

       }

      $sql_admin_update .= sprintf("cemail = %s, cmobile = %s WHERE cid = $vid",
        escapestring($vconn_creativeangels, $vEmail, 'text'),
        escapestring($vconn_creativeangels, $vMobile, 'text')
      );

      // Execute insert statement
      $vadmin_update_results = mysqli_query($vconn_creativeangels, $sql_admin_update);

      if($vadmin_update_results) {


        // ------------------- PW OR EMAIL CHECK ----------------------------

        // Create query string to check if the password and email has changed

        if($_SESSION['svcemail'] !== $vEmail || $vPassword1 !== '' && $vid === $_SESSION['svcid']) {

          session_destroy();
          header('Location: ../cms-signin.php?kpwupdate=success');
          exit();

        } else {

          // query to trigger notification
          $qs = 'kupdate=success';

          header('Location: admin-display.php?' . $qs );
          exit();

        }

      } else {

        header('Location: signout.php');
        exit();

      }

    } // END OF EMAIL & PW  DB METHODS

  } // END OF VALIDATION METHOD

} else { // END OF PROCESS

  header('Location:signout.php');
  exit();
}
?>
