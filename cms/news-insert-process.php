<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']){

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

echo $_FILES['files']['name'][0];
exit();

if(isset($_FILES['images'])) {
  $errors = array();
  $path_large = '../assets/uploads/news/large/';
  $path_thumb = '../assets/uploads/news/thumb/';

  foreach($_FILES['images']['tmp_name'] as $key => $tmp_name ) {

    // Create new image name
    $key.$_FILES['images']['name'][$key] = 'img' . date('YmdHis') . '.jpg';

    $image_name = $key.$_FILES['images']['name'][$key];
    $image_size = $_FILES['images']['size'][$key];
    $image_tmp = $_FILES['images']['tmp_name'][$key];
    echo $image_name;
    exit();
    // checks the file extension
    $ext = mime_content_type($image_tmp);

    if($ext !== 'image/jpeg') {
    	$errors[]="extension not allowed";
    }

    // checks the image size
    if($file_size > 2097152){
      $errors[]='File size must be less than 2 MB';
    }




  }
}

// ======================= VALIDATION FAILED ===============================
if(!$vHeading || !$vSummary || !$vBody) {

  $qs = '?kval=failed';
  $qs .= '&kheading=' . urlencode($vHeading);
  $qs .= '&ksummary=' . urlencode($vSummary);
  $qs .= '&kbody=' . urlencode($vBody);
  $qs .= '&kdate=' . urlencode($vDate);

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
