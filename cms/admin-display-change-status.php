<?php require('inc-cms-pre-doctype.php'); ?>
<?php
  // Security check
  if(isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity']) {

    // Gets the entry id from the GET Global Super Array
    $vId = $_GET['txtId'];
    $vCurrStatus = $_GET['txtStatus'];

    /*
    if($vCurrStatus === 'Activate'){
      $vNewStatus = 'a';
    } elseif ($vCurrStatus === 'Deactivate'){
      $vNewStatus = 'i';
    }*/

    //Connect to MYSQL Server
    require('inc-conn.php');

    // Calls the file where the user defined function escapestring receives its instructions
    require('inc-function-escapestring.php');

   $sql_status_req =sprintf("SELECT cstatus FROM tblcms WHERE cid = %u",
    escapestring($vconn_creativeangels, $vId, 'int')
    );

    $old_status_result = mysqli_query($vconn_creativeangels, $sql_status_req);

    $old_status = mysqli_fetch_assoc($old_status_result);

    if($old_status){

    // If statement responsible for toggling the status
      if($old_status['cstatus'] === 'i'){

          $vNewStatus = 'a';

        } elseif ($old_status['cstatus'] === 'a'){

          $vNewStatus = 'i';

        }

     // Update cstatus from entry where cid is the same as $vId
         $sql_cms = sprintf("UPDATE tblcms SET cstatus = %s WHERE cid = %u",
         escapestring($vconn_creativeangels, $vNewStatus, 'text'),
         escapestring($vconn_creativeangels, $vId, 'int')
      );

      //Execute SQL statement
       $status_result = mysqli_query($vconn_creativeangels, $sql_cms);

     // Returns a key/value pair in the GET Global Super Array (GGSA)
      // relative to the success of the query
       if($status_result) {

         if($vNewStatus === 'i'){

           echo 'Activate';
           exit();

         } elseif($vNewStatus === 'a') {

           echo 'Deactivate';
           exit();

         }

       } else {

          echo 'status not updated';
          exit();

        }

     } else {

      echo 'status not found';
      exit;

    }

  } else {

    header('Location: signout.php');

  }
?>
