<?php require('inc-cms-pre-doctype.php'); ?>
<?php

  // Security check
  if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity'] && isset($_POST['txtId'])) {

    $vId = $_POST['txtId'];

    //Connect to MYSQL Server
    require('inc-conn.php');
    require('inc-function-escapestring.php');

    $sql_delete = sprintf("DELETE FROM tblevents WHERE eid = %u",
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    //Execute SQL statement
    $delete_result = mysqli_query($vconn_creativeangels, $sql_delete);

    if($delete_result) {

      $img_str = $_POST['txtImgStr'];

      $img_arr = explode(', ', $img_str);

      foreach ($img_arr as $key => $value) {
        $dir = "../assets/uploads/events/";
        
        unlink($dir . "large/" . $value);
        unlink($dir . "thumb/" . $value);
      }
      exit();

    } else {

      echo 'Record could not be deleted';
      exit();

    }

  } else {
    echo "token";
    //header('Location: signout.php');
    exit();

  }
?>
