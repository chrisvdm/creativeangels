<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId'])){

  $vId = $_POST['txtId'];

  include_once('inc-fn-sanitize.php');

  //====================== SANITIZATION and VALIDATION =======================

  $vStatus = sanitize('txtStatus');

  // ======================= VALIDATION FAILED ===============================
  if(!$vStatus) {

    echo 'validation';
    exit();

  } else {
    // ====================== VALIDATION PASSED ===============================

    require('inc-conn.php');
    require('inc-function-escapestring.php');

    // insert query
    $sql_publish = sprintf("UPDATE tblnews SET nstatus = %s WHERE nid = $vId",
      escapestring($vconn_creativeangels, $vStatus, 'text')
    );

    // Execute insert statement
    $vpublish_results = mysqli_query($vconn_creativeangels, $sql_publish);

    if($vpublish_results) {

      echo 'success';
      exit();

    } else {

      echo 'failed';
      exit();

    }

  }

} else {
  echo 'token';
  exit();
}
?>
