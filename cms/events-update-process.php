<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['txtId'])) {

  $vId = $_POST['txtId'];

  // --------------- USER INPUT VALIDATION -------------------------
  include('inc-fn-sanitize.php');

  $vTitle = ucfirst(strtolower(sanitize('txtTitle')));
  $vDescription = ucfirst(sanitize('txtDescription'));
  $vLink = strtolower(sanitize('txtLink', 'url'));
  $vDate = sanitize('txtDate');

  if(!$vLink) {
    $vLink = 'na';
  }

  // ---------------------- IMAGE UPLOAD --------------------------
  include('inc-fn-img-upload.php');

  $vImg_str = multi_img_upload('img', '../assets/uploads/events/large/');
  $vImg_strThumb = multi_img_upload('img', '../assets/uploads/events/thumb/', 180);

  $vOldImg = $_POST['txtOldImg'];

  if(!$vImg_str || $vImg_str === '') {
    $vImg_str = $vOldImg;
  } else {
    $vImg_str .= ", " . $vOldImg;
  }

  // --------------------- CHECK VALIDATION -----------------------
  if($vImg_str && $vTitle && $vDescription && $vDate) {

    require('inc-function-escapestring.php');

    require('inc-conn.php');

    $sql_update = sprintf("UPDATE tblevents SET etitle = %s, edescription = %s, edate = %s, elink = %s, eimg = %s WHERE eid = $vId",
      escapestring($vconn_creativeangels, $vTitle, 'text'),
      escapestring($vconn_creativeangels, $vDescription, 'text'),
      escapestring($vconn_creativeangels, $vDate, 'text'),
      escapestring($vconn_creativeangels, $vLink, 'text'),
      escapestring($vconn_creativeangels, $vImg_str, 'text')
    );

    // Execute insert statement
    $vupdate_results = mysqli_query($vconn_creativeangels, $sql_update);

    if($vupdate_results) {

      header('Location: events-display.php?kupdate=success');
      exit();

    } else {

      header('Location: signout.php');
      exit();

    }

  } else {

    // Validation failed
    $qs = "?kval=failed";
    $qs .= "&ktitle=".urlencode($vTitle);
    $qs .= "&kdescription=".urlencode($vDescription);
    $qs .= "&kdate=".urlencode($vDate);
    $qs .= "&kimg=".urlencode($vImg_str);

    header('location: events-update-display.php' . $qs);
    exit();
  }


} else {

  // Initial security check failed
  die('Security token');
}
?>
