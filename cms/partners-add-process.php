<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// check if the form was submitted
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_SERVER['REQUEST_METHOD'] == 'POST') {

  // ---------------------- USER INPUT SANITISATION -------------------------
  include_once('inc-fn-sanitize.php');

  $vCompany = sanitize('txtCompany');
  $vDescription = sanitize('txtDescription');

  //------------------------- IMAGE UPLOAD ----------------------------------

  include('inc-fn-img-upload.php');

  $vLogo = img_upload('txtLogo', '../assets/uploads/partners/large/' );
  $vLogoThumb = img_upload('txtLogo', '../assets/uploads/partners/thumb/', 180);

  if($vLogo && $vLogoThumb && $vCompany && $vDescription) {
    // Validation passed
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    // insert query
    $sql_insert = sprintf("INSERT INTO tblpartners (pcompany, pdescription, plogo) VALUES (%s, %s, %s)",
      escapestring($vconn_creativeangels, $vCompany, 'text'),
      escapestring($vconn_creativeangels, $vDescription, 'text'),
      escapestring($vconn_creativeangels, $vLogo, 'text')
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
