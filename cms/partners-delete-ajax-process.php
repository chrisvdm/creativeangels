<?php require('inc-cms-pre-doctype.php'); ?>
<?php

  // Security check
  if(isset($_POST['txtSecurity']) && $_POST['txtSecurity'] === $_SESSION['svSecurity']) {

    $vId = $_POST['txtId'];
    //Connect to MYSQL Server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

    // Select all data from entry where cid is the same as $vId
    // The specifier changed because of the datatype
    $sql_partners = sprintf("DELETE FROM tblpartners WHERE pid = %u",
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    //Execute SQL statement
    // Will return either true or false based on whether the query string was correctly executed
    $delete_result = mysqli_query($vconn_creativeangels, $sql_partners);

    // Returns a key/value pair in the GET global Super Array according to the success of the query
    if($delete_result) {

      unlink('../assets/uploads/team/large/' . $_POST['txtLogo']);
      unlink('../assets/uploads/team/thumb/' . $_POST['txtLogo']);

      echo 'Record deleted';
      exit();

    } else {

      echo 'Record could not be deleted';
      exit();

    }

  } else {

    header('Location: signout.php');
    exit();

  }
?>
