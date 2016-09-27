<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && $_POST['txtId']) {

  $vcreated = date('Y-m-d');
  $validation = 0;
  $vid = $_POST['txtId'];

  //------------------------- IMAGE UPLOAD ----------------------------------
  include('inc-fn-img-upload.php');

  $vImg = img_upload('txtImg', '../assets/uploads/team/large/');
  $vImgThumb = img_upload('txtImg', '../assets/uploads/team/thumb/', 180);

  if(!$vImg || !$vImgThumb) {
    $vImg = 'na';
  }


    // ------------------ INPUT VALIDATION AND SANITISATION ----------------
    include_once('inc-fn-sanitize.php');

    $vName = ucfirst(strtolower(sanitize('txtName')));
    $vSurname = ucfirst(strtolower(sanitize('txtSurname')));
    $vJobTitle = ucfirst(strtolower(sanitize('txtJobTitle')));
    $vCompany = ucfirst(sanitize('txtCompany'));
    $vBio = ucfirst(sanitize('txtBio'));

  // ----------------------- VALIDATION FUNCTIONS --------------------------
  if(!$vName || !$vSurname || !$vJobTitle || !$vCompany || !$vBio) {

    $qs = '?kval=failed';
    $qs .= "&kname=".urlencode($vName);
    $qs .= "&ksurname=".urlencode($vSurname);
    $qs .= "&kcompname=".urlencode($vCompany);
    $qs .= "&kjobtitle=".urlencode($vJobTitle);
    $qs .= "&kbio=".urlencode($vBio);

    header('Location: team-add-new.php' . $qs);
    exit();

    // validation check
  } else if ($validation === 0) {

      // Connect to mysql server
      require('inc-conn.php');

      // Calls the file where the user defined function escapestring receives its instructions
      require('inc-function-escapestring.php');

      // Connect to mysql server
      require('inc-conn.php');

      // The proper way to insert sql statement (SQL Injection)
      // The first specifier (%s) corresponds to the first escapestring function as so on and so forth
      $sql_insert = sprintf("UPDATE tblteam tname = %s, tsurname = %s, tcompname = %s, tjobtitle = %s, tbio = %s, tphotograph = %s WHERE tid = $vid",
        escapestring($vconn_creativeangels, $vName, 'text'),
        escapestring($vconn_creativeangels, $vSurname, 'text'),
        escapestring($vconn_creativeangels, $vCompany, 'text'),
        escapestring($vconn_creativeangels, $vJobTitle, 'text'),
        escapestring($vconn_creativeangels, $vBio, 'text'),
        escapestring($vconn_creativeangels, $vImg, 'text')
      );

      // Execute insert statement
      $vinsert_results = mysqli_query($vconn_creativeangels, $sql_insert);

      if($vinsert_results) {

        header('Location: team-details-display.php');
        exit();

      }

  } // END OF VALIDATION METHOD
} else {

  header('Location:signout.php');
  exit();
}
?>
