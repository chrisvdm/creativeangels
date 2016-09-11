<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $vid = $_POST['txtId'];

  include_once('inc-fn-sanitize.php');

  $vCompany = sanitize('txtCompany');
  $vDescription = sanitize('txtDescription');

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
