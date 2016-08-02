<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if( isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity']){

// COLLECT ID FROM EDIT BUTTON field
$vid = $_GET['txtId'];

//FORMULATE SQL STATEMENT
$sql_admin_update = "SELECT * FROM tblcms WHERE cid = $vid";

// CONNECT
require('inc-conn.php');

// EXECUTE
$rs_admin_update = mysqli_query($vconn_creativeangels, $sql_admin_update);

// CREATE ASSOCIATIVE ARRAY
$rs_admin_update_rows = mysqli_fetch_assoc($rs_admin_update);

} else {

  header('Location: signout.php');
  exit();

}

?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    if(isset($_GET[$keyName]) && $_GET[$keyName] === '') {

      return "<div class='warning_msg'>Please enter " . $label . ".</div>";

    } elseif (isset($_GET[$keyName]) && $_GET[$keyName] === '0'){

      return "<div class='warning_msg'>Passwords do not match</div>";

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'failed'){

      return '<div class="warning_msg">Please enter passwords!</div>';

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'emaildup'){

      return '<div class="warning_msg">Email already in use</div>';

    }//end if statement

  } // End of function errorMsg

  // Displays values already entered in for input field
  function displayTxt($keyValue){

    if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

      return $_GET[$keyValue];

    } //End if statement

  } // End of function displayTxt

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>

  </head>
  <body>
    <!-- PAGE WRAPPER -->
    <div id="page-wrapper">

      <!-- SIDEBAR MAIN MENU -->
      <?php require('inc-cms-sidebar.php'); ?>

        <!-- RIGHT COLUMN MAIN CONTENT CONTAINER -->
      <section class="right-content-wrapper">

        <!-- HEADER -->
        <header class="base">

          <!-- Branding container -->
          <?php require('inc-cms-branding-container.php'); ?>

          <!-- Page title -->
          <div class="page-header">
            <h2>Edit User Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form class="form" action="admin-add-process.php" method="post" onsubmit="return">

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <label>First name:</label>
            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php if (isset($rs_admin_update_rows['cname']) && $rs_admin_update_rows['cname'] !== 'na'){ echo $rs_admin_update_rows['cname']; } else { echo displayTxt('kname'); } ?>">

            <?php echo errorMsg('ksurname', 'surname'); ?>

            <label>Surname:</label>
            <input type="text" name="txtSurname" autocomplete="off" value="<?php if (isset($rs_admin_update_rows['csurname']) && $rs_admin_update_rows['csurname'] !== 'na'){ echo $rs_admin_update_rows['csurname']; } else { echo displayTxt('ksurname'); } ?>">

            <?php if ($_SESSION['svcaccesslevel']=== 'a'  && $_SESSION['svcid'] === $rs_admin_update_rows['cid']) {?>

            <!-- Reminds user to enter password on validation fail -->
            <?php echo errorMsg('kpassword','password'); ?>

            <div id="pwrdErr" class="warning_msg"></div>
            <label>Password:</label>
            <input type="text" name="txtPassword1" autocomplete="off" value="<?php if (isset($rs_admin_update_rows['cpassword']) && $rs_admin_update_rows['cpassword'] !== 'na'){ echo $rs_admin_update_rows['cpassword']; }?>">

            <label>Re-enter password:</label>
            <input type="text" name="txtPassword2" autocomplete="off" value="<?php if (isset($rs_admin_update_rows['cpassword']) && $rs_admin_update_rows['cpassword'] !== 'na'){ echo $rs_admin_update_rows['cpassword']; }?>" onblur="matchCheck(this.value)" >

            <?php } ?>

            <?php echo errorMsg('kemail', 'email'); ?>
            <?php echo errorMsg('kemaildup', 'emaildup'); ?>

            <label>Email:</label>
            <input type="email" name="txtEmail" autocomplete="off" value="<?php if (isset($rs_admin_update_rows['cemail']) && $rs_admin_update_rows['cemail'] !== 'na'){ echo $rs_admin_update_rows['cemail']; } else { echo displayTxt('kemail'); } ?>">

            <?php echo errorMsg('kmobile', 'mobile number'); ?>

            <label>Mobile:</label>
            <input type="text" name="txtMobile" autocomplete="off" value="<?php if (isset($rs_admin_update_rows['cmobile']) && $rs_admin_update_rows['cmobile'] !== 'na'){ echo $rs_admin_update_rows['cmobile']; } else { echo displayTxt('kmobile'); } ?>">

            <!-- Security hidden field -->
            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <!-- Submit button -->
            <button class="wait-btn" type="submit" name="btnUpdate">Update</button>

            <a class="button danger-btn" href="admin-display.php" name="btnCancel">Cancel</a>

          </form>

          <p>
            <?php

            // Waits for confirmation response
            if (isset($result_created)) {

              echo 'Table created';

            }

            ?>
          </p>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

      // Client-side validation
      function matchCheck(password2){

        var password1 = document.getElementsByName('txtPassword1')[0].value;

        if(password1 !== password2){

          document.getElementById('pwrdErr').innerHTML = "Passwords do not match";
          document.getElementsByName('txtPassword2')[0].value = "";

        } else {

          document.getElementById('pwrdErr').innerHTML = "";

        }

      }

    </script>
  </body>
</html>
