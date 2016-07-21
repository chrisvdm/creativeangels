<?php
  session_start();
  // Security check
  if(isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity']) {

    $vId = $_GET['txtId'];
    //Connect to MYSQL Server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // Select all data from entry where cid is the same as $vId
    // The specifier changed because of the datatype
    $sql_cms = sprintf("DELETE FROM tblcms WHERE cid = %u",
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    //Execute SQL statement
    // Will return either true or false based on whether the query string was correctly executed
    $delete_result = mysqli_query($vconn_creativeangels, $sql_cms);

    // Returns a key/value pair in the GET global Super Array according to the success of the query
    if($delete_result) {

      header('Location: admin-display.php?kdeleted=yes');
      exit();

    } else {

      header('Location: admin-display.php?kdeleted=no');
      exit();

    }

  } else {

    header('Location: signout.php');
    exit();

  }
?>
