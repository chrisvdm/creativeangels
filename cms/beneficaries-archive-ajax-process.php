<?php require('inc-cms-pre-doctype.php'); ?>
<?php

  // Security check
  if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId'])) {

    $vId = $_POST['txtId'];
    $vStatus = $_POST['txtStatus'];

    if($vStatus === 'a') {
      $vNewStatus = 'i';
    } elseif($vStatus === 'i') {
      $vNewStatus = 'a';
    }

    //Connect to MYSQL Server
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    $sql_archive = sprintf("UPDATE tblbeneficaries SET bstatus = %s WHERE bid = %u",
    escapestring($vconn_creativeangels, $vNewStatus, 'text'),
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    //Execute SQL statement
    $archive_result = mysqli_query($vconn_creativeangels, $sql_archive);

    if($archive_result) {

      echo $vNewStatus;
      exit();

    } else {

      echo 'Record could not be archived';
      exit();

    }

  } else {
    header('Location: signout.php');
    exit();

  }
?>
