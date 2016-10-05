<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_SERVER['REQUEST_METHOD'] == 'POST') {
  // --------------- USER INPUT VALIDATION -------------------------
  include('inc-fn-sanitize.php');

  $vName = ucfirst(strtolower(sanitize('txtName')));
  $vDescription = ucfirst(sanitize('txtDescription'));
  $vLink = strtolower(sanitize('txtLink', 'url'));

  if(!$vLink) {
    $vLink = 'na';
  }

  // ---------------------- IMAGE UPLOAD --------------------------
  include('inc-fn-img-upload.php');

  $vImg_str = multi_img_upload('img', '../assets/uploads/beneficaries/large/');
  $vImg_strThumb = multi_img_upload('img', '../assets/uploads/beneficaries/thumb/', 180);

  $vOldImg = $_POST['txtOldImg'];

  if(!$vImg_str || $vImg_str === '') {
    $vImg_str = $vOldImg;
  } else {
    $vImg_str .= ", " . $vOldImg;
  }

  // --------------------- CHECK VALIDATION -----------------------
  if($vName && $vDescription) {

    // Connect to mysql server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // Connect to mysql server
    require('inc-conn.php');

    // The proper way to insert sql statement (SQL Injection)
    // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
    $sql_insert = sprintf("UPDATE tblbeneficaries SET bname = %s, bdescription = %s, blink = %s, bimg = %s WHERE bid = $vId",
      escapestring($vconn_creativeangels, $vName, 'text'),
      escapestring($vconn_creativeangels, $vDescription, 'text'),
      escapestring($vconn_creativeangels, $vLink, 'text'),
      escapestring($vconn_creativeangels, $vImg_str, 'text')
    );

    // Execute insert statement
    $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

    if($vinsert_results) {

      header('Location: beneficaries-display.php');
      exit();

    } else {

      header('Location: signout.php');
      exit();

    }

  } else {

    // Validation failed
    $qs = "?kval=failed";
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&kdescription=".urlencode($vDescription);
    $qs .= "&kimg=".urlencode($vImg_str);

    header('location: beneficaries-update-display.php' . $qs);
    exit();
  }


} else {

  // Initial security check failed
  header("Location: signout.php");
  exit();
}
?>
