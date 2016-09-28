<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId'])){

  $vId = $_POST['txtId'];
  $vImg_str = $_POST['txtImg'];
  $vDir = $_POST['txtDir'];
  $vTbl = $_POST['txtTbl'];
  $vArr_str = $_POST['txtArr'];

  $err = array();

  // ---------------------- MODIFY IMAGE ARRAY --------------------------
  $img_arr = explode(', ', $vArr_str);
  $vIndex = array_search($vImg_str, $img_arr);

  array_splice($img_arr, $vIndex, 1);
  $newArrStr = implode(", ", $img_arr);

  // ------------------------- UPDATE TABLE ----------------------------
  require('inc-conn.php');
  require('inc-function-escapestring.php');

  $sql_update = sprintf("UPDATE $vTbl SET eimg = %s WHERE eid = $vId",
  escapestring($vconn_creativeangels, $newArrStr, 'text')
  );

  $update_results = mysqli_query($vconn_creativeangels, $sql_update);

  if($update_results) {

    unlink($vDir . "large/" . $vImg_str);
    unlink($vDir . "thumb/" . $vImg_str);

    echo true;
    exit();

    // Unlink images
  }

} else {
  echo 'token';
  exit();
}
?>
