<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if( isset($_GET['txtSecurity']) && $_GET['txtSecurity'] === $_SESSION['svSecurity'] && isset($_GET['txtId']) && $_GET['txtId'] !== ''){

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

      return "<br><div class='warning_msg'>Please enter a " . $label ."</div>";

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'emaildup'){

      return '<br><div class="warning_msg">Email already in use</div>';

    } elseif(isset($_GET[$keyName]) && $_GET[$keyName] === 'failed'){

      return '<br><div class="warning_msg">Passwords do not match</div>';

    }//end if statement

  } // End of function errorMsg

  // Displays values already entered in for input field
  function displayTxt($keyValue){

    if(isset($_GET[$keyValue]) && $_GET[$keyValue] !== '') {

      return $_GET[$keyValue];

    }

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
          <form class="form" action="admin-update-process.php" method="post" onsubmit="return">

            <!-- Enter first name -->
            <label>* First name:</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php if(isset($_GET['kname'])){ echo displayTxt('kname'); } elseif (isset($rs_admin_update_rows['cname']) && $rs_admin_update_rows['cname'] !== 'na'){ echo $rs_admin_update_rows['cname']; } ?>">

            <!-- Enter Surname -->
            <label>* Surname:</label>

            <!-- Warning message -->
            <?php echo errorMsg('ksurname', 'surname'); ?>

            <input type="text" name="txtSurname" autocomplete="off" value="<?php if(isset($_GET['ksurname'])){ echo displayTxt('ksurname'); } elseif (isset($rs_admin_update_rows['csurname']) && $rs_admin_update_rows['csurname'] !== 'na'){ echo $rs_admin_update_rows['csurname']; }?>">

            <?php if ($_SESSION['svcaccesslevel']=== 'a'  && $_SESSION['svcid'] === $rs_admin_update_rows['cid']) {?>

              <div id="pwrdErr" class="warning_msg"></div>
              <label>Password: </label>
              <br>
              <i><small>Leave blank to retain existing password</small></i>
              
              <?php echo errorMsg('kpassword', 'password'); ?>

              <input type="text" name="txtPw1" autocomplete="off" value="">

              <label>Re-enter password:</label>
              <input type="text" name="txtPw2" autocomplete="off" value="" onblur="matchCheck(this.value)" >

            <?php } ?>

            <!-- Enter Email -->
            <label>* Email:</label>

            <!-- Warning message -->
            <?php echo errorMsg('kemail', 'email'); ?>
            <?php echo errorMsg('kemaildup', 'emaildup'); ?>
            <input type="email" name="txtEmail" autocomplete="off" value="<?php if(isset($_GET['kemail'])){ echo displayTxt('kemail'); } elseif (isset($rs_admin_update_rows['cemail']) && $rs_admin_update_rows['cemail'] !== 'na'){ echo $rs_admin_update_rows['cemail']; } ?>">


            <!-- Enter Mobile -->
            <label>* Mobile:</label>

            <!-- Warning message -->
            <?php echo errorMsg('kmobile', 'mobile number'); ?>

            <input type="text" name="txtMobile" autocomplete="off" value="<?php if(isset($_GET['kmobile'])){ echo displayTxt('kmobile'); } elseif (isset($rs_admin_update_rows['cmobile']) && $rs_admin_update_rows['cmobile'] !== 'na'){ echo $rs_admin_update_rows['cmobile']; } ?>">

            <!-- Hidden field for id -->
            <input type="hidden" name="txtId" value="<?php echo $rs_admin_update_rows['cid']; ?>">

            <!-- Security hidden field -->
            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <small><i>* These are required fields</i></small>
            <br />

            <!-- Submit button -->
            <button class="proceed-btn" type="submit" name="btnUpdate">Update</button>

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

        var password1 = document.getElementsByName('txtPw1')[0].value;

        if(password1 !== password2){

          document.getElementById('pwrdErr').innerHTML = "Passwords do not match";
          document.getElementsByName('txtPw2')[0].value = "";

        } else {

          document.getElementById('pwrdErr').innerHTML = "";

        }

      }

    </script>
  </body>
</html>
