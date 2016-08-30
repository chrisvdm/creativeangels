<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $vid = $_POST['txtId'];
  $validation = 0;

  //------------------------ COMPANY NAME VALIDATION -----------------------
  if(isset($_POST['txtCompany'])) {

    $vCompany = trim($_POST['txtCompany']);

    if($vCompany !== ''){

      $vCompany = filter_var($vCompany, FILTER_SANITIZE_STRING);

      if($vCompany === ''){
        $validation++;
      }

    } else {
      $validation++;
    }

  } else {
    $validation++;
  }

  //------------------------ DESCRIPTION VALIDATION ------------------------
  if(isset($_POST['txtDescription'])) {

    $vDescription = trim($_POST['txtDescription']);

    if($vDescription !== ''){

      $vDescription = filter_var($vDescription, FILTER_SANITIZE_STRING);

      if($vDescription === ''){
        $validation++;
      }

    } else {
      $validation++;
    }
  } else {
    $validation++;
  }

  //-------------------------- LOGO VALIDATION -----------------------------
  if(isset($_POST['txtLogo'])){

  } else {
    $validation++;
  }

  if($validation === 0) {
    // Validation passed

  } else {

  }


} else {
  echo 'No security token';
  exit();
}

?>
