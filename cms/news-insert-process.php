<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']){

$validation = 0;

if(isset($_POST['txtHeading'])) {

} else {
  $validation++;
}


// Optional
if(isset($_POST['txtSummary'])) {

}

if(isset($_POST['txtBody'])) {

} else {
  $validation++;
}

if(isset($_POST['txtStatus'])) {

} else {
  $vStatus = 'i';
}

if($validation === 0) {

} else {
  echo 'validation failed';
  exit();
}

} else {
  echo 'Security';
  // header('location: signout.php');
  exit();

?>
