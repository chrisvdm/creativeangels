<?php
// UPLOAD DIRECTORY WITH WRITE PROTECTION SET
// folder the file gets saved in
$vuploaddir = 'uploads/';
$vuploadfile = $vuploaddir . basename($_FILES['txtimg'] ['name']);

// Upload file by moving it from the temp dir to its new permanent location stipulated above
$vupload_success = move_uploaded_file($_FILES['txtimg'] ['tmp_name'], $vuploadfile);

// CHeck if file was uploaded
if ($vupload_success){

  echo 'File uploaded';

} else {

  echo 'File not uploaded';

}
?>
