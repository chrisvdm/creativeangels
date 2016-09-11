<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId'])){

  $vId = $_POST['txtId'];

include_once('inc-fn-sanitize.php');

//====================== SANITIZATION and VALIDATION =======================
$vHeading = sanitize('txtHeading');
$vSummary= sanitize('txtSummary');
$vStatus = sanitize('txtStatus');
$vDate = sanitize('txtDate');

if(exists('txtBody', 'POST')) {
  $vBody = $_POST['txtBody'];
} else {
  $vBody = false;
}

// ======================= VALIDATION FAILED ===============================
if(!$vHeading || !$vSummary || !$vBody) {

  $qs = '?kval=failed';
  $qs .= '&kheading=' . urlencode($vHeading);
  $qs .= '&ksummary=' . urlencode($vSummary);
  $qs .= '&kbody=' . urlencode($vBody);
  $qs .= '&kdate=' . urlencode($vDate);

  header('location: news-update-display.php' . $qs);
  exit();

} else {
  // ====================== VALIDATION PASSED ===============================

  require('inc-conn.php');
  require('inc-function-escapestring.php');

  // insert query
  $sql_insert = sprintf("UPDATE tblnews SET nheading = %s, nsummary = %s, nbody = %s, ndatepublished = %d, nstatus = %s WHERE nid = $vId",
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

    echo 'db not updated';
    //header('Location: signout.php');
    exit();

  }

}

} else {
  header('location: signout.php');
  exit();
}
?>
