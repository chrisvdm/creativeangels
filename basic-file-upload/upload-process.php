<?php
// UPLOAD DIRECTORY WITH WRITE PROTECTION SET
// folder the file gets saved in
$vuploaddir = 'uploads/';

// basename returns the filename without path
$vuploadfile = $vuploaddir . basename($_FILES['txtimg'] ['name']);

// Upload file by moving it from the temporary directory to its new permanent location as stipulated above
$vupload_success = move_uploaded_file($_FILES['txtimg'] ['tmp_name'], $vuploadfile);

// CHeck if file was uploaded
if ($vupload_success) {

  echo 'File uploaded';

} else {

  echo 'File not uploaded';

}
?>
