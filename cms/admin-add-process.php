<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity']){

  $vcreated = date('Y-m-d');
  $validation = 0;

  $vName = ucfirst(strtolower(trim($_GET['txtName'])));

    if($vName === ''){
      $validation++;
    }

  $vSurname = ucfirst(strtolower(trim($_GET['txtSurname'])));

    if($vSurname === ''){
      $validation++;
    }

  $vPassword1 = trim($_GET['txtPassword1']);
  $vPassword2 = trim($_GET['txtPassword2']);

  if($vPassword1 === ''){
    $validation++;
    $vpswmatch = 'failed';
  }

  if($vPassword2 === ''){
    $validation++;
    $vpswmatch = 'failed';
  }

  if($vPassword1 !== $vPassword2){
    $validation++;
    $vpswmatch = '0';
  } elseif ( $vPassword1 === '' && $vPassword2 === '' ) {
    $validation++;
  }

  $vEmail = strtolower(trim($_GET['txtEmail']));

  if($vEmail === ''){
    $validation++;
  }

  $vMobile = trim($_GET['txtMobile']);

  if($vMobile === ''){
    $validation++;
  }

  if($validation != 0) {

    $qs = '?kval=failed';
    $qs .= "&kname=$vName";
    $qs .= "&ksurname=$vSurname";
    $qs .= "&kpassword=$vpswmatch";
    $qs .= "&kemail=$vEmail";
    $qs .= "&kmobile=$vMobile";

    header('Location: admin-add-new.php' . $qs);
    exit();
    // validation check
  } else {

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

} else {

  header('Location:signout.php');
  exit();
}
?>
