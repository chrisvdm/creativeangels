<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check whether form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

  $vId = $_POST['txtId'];

  // --------------------- USER INPUT SANiTIZATION --------------------------
  include_once('inc-fn-sanitize.php');

  $vCompany = sanitize('txtCompany');
  $vDescription = sanitize('txtDescription');

  //------------------------- IMAGE UPLOAD ----------------------------------
  include('inc-fn-img-upload.php');

  $vImg = img_upload('txtLogo', '../assets/uploads/partners/large/');
  $vImgThumb = img_upload('txtLogo', '../assets/uploads/partners/thumb/', 180);

  //------------------------ VALIDATION CHECK -------------------------------
  if($vImg && $vImgThumb && $vCompany && $vDescription) {

    // Validation passed
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    // insert query
    $sql_insert = sprintf("UPDATE tblpartners SET pcompany = %s, pdescription = %s, plogo = %s WHERE pid = $vId",
      escapestring($vconn_creativeangels, $vCompany, 'text'),
      escapestring($vconn_creativeangels, $vDescription, 'text'),
      escapestring($vconn_creativeangels, $vImg, 'text')
    );

    // Execute insert statement
    $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

    if($vinsert_results) {

      header('Location: partners-display.php');
      exit();

    } else {
      header('Location: signout.php');
      exit();

    } // DB end

  } else {

    $qs = '?kval=failed';
    $qs .= '&kcomp=' . $vCompany;
    $qs .= '&vdescription=' . $vDescription;

    header('location: partners-add-new.php' . $qs);
    exit();
  } // Validation end


} else {
  header('location: signout.php');
  exit();
}

?>
