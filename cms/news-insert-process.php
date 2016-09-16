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

$img_arr = array();

if(isset($_FILES['images'])) {

      $vmemory = ini_set('memory_limit', '128M');

      $errors= array();

      foreach($_FILES['images']['tmp_name'] as $key => $tmp_name ){

      $images = $_FILES['images'];
      $img_name = $key.$images['name'][$key];
      $img_size = $images['size'][$key];
      $img_tmp  = $images['tmp_name'][$key];

      // Check file is a a jpeg
      // return mime type ala mimetype extension
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $ext = finfo_file($finfo, $img_tmp);
      finfo_close($finfo);

      if($ext !== 'image/jpeg'){

        $errors[]='Extension not allowed';

      } else {

        // Check file size
        if($img_size > 2097152){

          $errors[]='File size must be less than 2 MB';

        } else {

          // Create new image from file to manipulate
          $img_src = imagecreatefromjpeg($img_tmp);

          // Get original image dimensions
          list($img_width, $img_height) = getimagesize($img_tmp);

          // Specify new image dimensions
          //300px wide
          $img_new_width = 300;
          $img_new_height = ($img_height/$img_width) * $img_new_width;

           // Create blank image with the new dimensions
          $img_new = imagecreatetruecolor($img_new_width, $img_new_height);

          // Copy and resize via resampling
          imagecopyresampled($img_new, $img_src, 0, 0, 0, 0, $img_new_width, $img_new_height, $img_width, $img_height);

          // File upload directory
          $path_dir = '../assets/uploads/news/large/';

          $img_new_name = 'img' . date('YmdHis') . $key . '.jpg';

          $img_upload_path = $path_dir . $img_new_name;

          // Upload image to server
          $img_uploaded = imagejpeg($img_new, $img_upload_path, 100);

          // Push img to array
          if($img_uploaded) {
              // push the images to the array.
              array_push($img_arr, $img_new_name);

          }

        } // End of size

      } // End of ext

    } // End of foreach loop

    // implode the array
    $images_str = implode(', ', $img_arr);

  } // End isset

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
  $sql_insert = sprintf("INSERT INTO tblnews (nheading, nsummary, nbody, ndatepublished, nstatus, nimages) VALUES (%s, %s, %s, %d, %s, %s)",
    escapestring($vconn_creativeangels, $vHeading, 'text'),
    escapestring($vconn_creativeangels, $vSummary, 'text'),
    escapestring($vconn_creativeangels, $vBody, 'text'),
    escapestring($vconn_creativeangels, $vDate, 'date'),
    escapestring($vconn_creativeangels, $vStatus, 'text'),
    escapestring($vconn_creativeangels, $images_str, 'text')
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
