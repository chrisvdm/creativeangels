<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

  $vcreated = date('Y-m-d');
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
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kpassword=".urlencode($vpswmatch);
    $qs .= "&kemail=".urlencode($vEmail);
    $qs .= "&kmobile=".urlencode($vMobile);

    header('Location: admin-add-new.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

    $sql_dup_email = "SELECT cemail FROM tblcms WHERE cemail = '$vEmail'";

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
      header('Location: admin-add-new.php' . $qs);
      exit();

    } else {

      // Connect to mysql server
      require('inc-conn.php');

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      // Connect to mysql server
      require('inc-conn.php');

      // The proper way to insert sql statement (SQL Injection)
      // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
      $sql_insert = sprintf("INSERT INTO tblcms (ccreated, caccesslevel, cname, csurname, cpassword, cemail, cmobile) VALUES (%s, %s, %s, %s, %s, %s, %s)",
        escapestring($vconn_creativeangels, $vcreated, 'date'),
        escapestring($vconn_creativeangels, 'b', 'text'),
        escapestring($vconn_creativeangels, $vName, 'text'),
        escapestring($vconn_creativeangels, $vSurname, 'text'),
        escapestring($vconn_creativeangels, sha1($vPassword1), 'text'),
        escapestring($vconn_creativeangels, $vEmail, 'text'),
        escapestring($vconn_creativeangels, $vMobile, 'text')
      );

      // Execute insert statement
      $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

      if($vinsert_results) {

        header('Location: admin-display.php');
        exit();

      } else {

        header('Location: signout.php');
        exit();

      }

    }

  } // END OF VALIDATION METHOD

} else {

  header('Location:signout.php');
  exit();
}
?>
