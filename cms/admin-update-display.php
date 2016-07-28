<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php //require("inc-cms-pre-doctype.php"); ?>
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
            <h2>Template</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <h2> Add New </h2>

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form action="admin-add-process.php" method="post" onsubmit="return">

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <!-- PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field  -->

            <label>First name:</label>
            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php echo displayTxt('kname'); ?>">
            <br><br>

            <?php echo errorMsg('ksurname', 'surname'); ?>

            <label>Surname:</label>
            <input type="text" name="txtSurname" autocomplete="off" value="<?php echo displayTxt('ksurname'); ?>">
            <br><br>

            <!-- Reminds user to enter password on validation fail -->
            <?php echo errorMsg('kpassword','password'); ?>

            <div id="pwrdErr" class="warning_msg"></div>
            <label>Password:</label>
            <input type="password" name="txtPassword1" autocomplete="off" value="">
            <br><br>

            <label>Re-enter password:</label>
            <input type="password" name="txtPassword2" autocomplete="off" value="" onblur="matchCheck(this.value)" >
            <br><br>

            <?php echo errorMsg('kemail', 'email'); ?>
            <?php echo errorMsg('kemaildup', 'emaildup'); ?>

            <label>Email:</label>
            <input type="email" name="txtEmail" autocomplete="off" value="<?php echo displayTxt('kemail'); ?>">
            <br><br>

            <?php echo errorMsg('kmobile', 'mobile number'); ?>

            <label>Mobile:</label>
            <input type="text" name="txtMobile" autocomplete="off" value="<?php echo displayTxt('kmobile'); ?>">
            <br><br>

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <input type="submit" value="Add New" name="btnAddNew">
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

        <!-- FOOTER -->
        <?php require('inc-cms-footer.php'); ?>

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
