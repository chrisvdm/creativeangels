<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']){

$validation = 0;

//============================= HEADING VALIDATION ============================
if(isset($_POST['txtHeading'])) {

  $vHeading = trim($_POST['txtHeading']);

  $vHeading = filter_var($vHeading, FILTER_SANITIZE_STRING);

  if($vHeading === ''){

    $validation++;

  }

} else {
  $validation++;
}

//============================= SUMMARY VALIDATION ============================
if(isset($_POST['txtSummary'])) {
  $vSummary = trim($_POST['txtSummary']);

  $vSummary = filter_var($vSummary, FILTER_SANITIZE_STRING);
}

//============================= BODY VALIDATION ============================
if(isset($_POST['txtBody'])) {

  $vBody = trim($_POST['txtBody']);

  //$vBody = filter_var($vBody, FILTER_SANITIZE_STRING);

  if($vBody === '') {

    $validation++;

  }

} else {
  $validation++;
}

//============================= DATE VALIDATION ============================
if(isset($_POST['txtDate'])) {

  $vDate = trim($_POST['txtDate']);

} else {
  $vDate = '0000-00-00';
}

//============================= STATUS VALIDATION ============================
if(isset($_POST['txtStatus'])) {

  $vStatus = trim($_POST['txtStatus']);

  $vStatus = filter_var($vStatus, FILTER_SANITIZE_STRING);

} else {
  $vStatus = 'i';
}

// ======================= VALIDATION FAILED ===============================
if($validation > 0) {

  $qs = '?kval=failed';
  $qs .= '&kheading=' . urlencode($vHeading);
  $qs .= '&ksummary=' . urlencode($vSummary);
  $qs .= '&kbody=' . urlencode($vBody);
  $qs .= '&kdate=' . urlencode($vBody);

  header('location: news-insert.php' . $qs);
  exit();
} else {
  // ====================== VALIDATION PASSED ===============================

  require('inc-conn.php');
  require('inc-function-escapestring.php');

  // insert query
  $sql_insert = sprintf("INSERT INTO tblnews (nheading, nsummary, nbody, ndatepublished, nstatus) VALUES (%s, %s, %s, %d, %s)",
    escapestring($vconn_creativeangels, $vHeading, 'text'),
    escapestring($vconn_creativeangels, $vSummary, 'text'),
    escapestring($vconn_creativeangels, $vBody, 'text'),
    escapestring($vconn_creativeangels, $vDate, 'date'),
    escapestring($vconn_creativeangels, $vStatus, 'text')
  );

  // Execute insert statement
  $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

  if($vinsert_results) {

    header('Location: news-display.php');
    exit();

  } else {
    header('Location: signout.php');
    exit();

  }

}

} else {
  
  header('location: signout.php');
  exit();
}
?>
