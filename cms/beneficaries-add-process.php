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

  if($vImg_str === '') {

    $vImg_str = img_upload('img', '../assets/uploads/beneficaries/large/');
    $vImg_strThumb = img_upload('img', '../assets/uploads/beneficaries/thumb/', 180);

  }

  // --------------------- CHECK VALIDATION -----------------------
  if($vImg_str && $vName && $vDescription) {

    // Connect to mysql server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // Connect to mysql server
    require('inc-conn.php');

    // The proper way to insert sql statement (SQL Injection)
    // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
    $sql_insert = sprintf("INSERT INTO tblbeneficaries (bname, bdescription, blink, bimg, bstatus) VALUES (%s, %s, %s, %s, 'a')",
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
      echo 'db';
      //header('Location: signout.php');
      exit();

    }

  } else {

    // Validation failed
    $qs = "?kval=failed";
    $qs .= "&kname=".urlencode($vTitle);
    $qs .= "&kdescription=".urlencode($vDescription);
    $qs .= "&kimg=".urlencode($vImg_str);

    header('location: beneficaries-add-new.php' . $qs);
    exit();
  }


} else {
  echo 'Token';
  // Initial security check failed
  //header("Location: signout.php");
  exit();
}
?>
