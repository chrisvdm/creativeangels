<?php require('inc-cms-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php //require("inc-cms-pre-doctype.php"); ?>
<?php
  // Function for printing out error messages
  function errorMsg($keyName, $label) {

    // PHP checks whether certain keys have been returned with values in the GET Global Super Array, if it has then echo the value into the input field

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
            <h2>Add New User</h2>
          </div>

        </header>

        <!--################# MAIN CONTENT SECTION ########################-->

        <section id="main-content" class="base">

          <!--##################### ADD NEW FORM ##########################-->

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form id="form" class="form" action="admin-add-process.php" method="post" onsubmit="return valForm()">

            <!-- FIRST NAME -->
            <label>First name:</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php echo displayTxt('kname'); ?>">

            <!-- SURNAME -->
            <label>Surname:</label>

            <?php echo errorMsg('ksurname', 'surname'); ?>

            <input type="text" name="txtSurname" autocomplete="off" value="<?php echo displayTxt('ksurname'); ?>">

            <!-- PASSWORD -->
            <label>Password:</label>

            <!-- Reminds user to enter password on validation fail -->
            <?php echo errorMsg('kpassword','password'); ?>
            <div id="pwErr" class="warning_msg"></div>

            <input type="password" name="txtPw1" autocomplete="off" value="">

            <label>Retype password:</label>
            <input type="password" name="txtPw2" autocomplete="off" value="" onblur="matchPw()" >

            <!-- EMAIL -->
            <label>Email:</label>

            <!-- Email validation error msg -->
            <?php echo errorMsg('kemail', 'email'); ?>
            <?php echo errorMsg('kemaildup', 'emaildup'); ?>

            <input type="email" name="txtEmail" autocomplete="off" value="<?php echo displayTxt('kemail'); ?>">


            <!-- MOBILE -->
            <label>Mobile:</label>

            <!-- Mobile validation error msg -->
            <?php echo errorMsg('kmobile', 'mobile number'); ?>
            <input type="text" name="txtMobile" autocomplete="off" value="<?php echo displayTxt('kmobile'); ?>">

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <!-- submit form -->
            <input class="wait-btn" type="submit" value="Add New" name="btnAddNew">

            <div id="subErr" class="warning_msg"></div>

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

        <!--########################### FOOTER ###########################-->
        <?php require('inc-cms-footer.php'); ?>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    // creates initial data obj
    // function initData(){
    //   return {
    //     name: '',
    //     surname: '',
    //     email: '',
    //     mobile: '',
    //     valid: true
    //   }
    // }
    //
    // function bindEvents(){
    //
    //   $('input[name="btnAddNew"]')
    //   .mouseover( function(){
    //     dispatch({'CHANGE_BUTTON', data})
    //   })
    //
    //   $('input[name="txtName"]')
    //   .keyup( function (){
    //
    //   });
    // } // end of bind events
    //
    // // main function in which all things happen
    // function main(){
    //
    //   var data = initData();
    //
    //   bindEvents();
    //
    //   function dispatch(action){
    //     reduce(action, data);
    //     render(reduce);
    //   }
    //
    // }




    $('input[name="btnAddNew"]').mouseover(valInput);

      function valInput() {

        var name = $('input[name="txtName"]').val();
        var surname = $('input[name="txtSurname"]').val();
        var email = $('input[name="txtEmail"]').val();
        var mobile = $('input[name="txtMobile"]').val();
        var valid = 0;
        var uinput =[name, surname, email, mobile];

        // Check if all fields are filled in
        for(var i = 0; i <= 3; i++){

          if(uinput[i] === ''){
            valid++;
          }

        }

        if(valid === 0){

          // If all fields are filled in then change the button colour
          $('input[name="btnAddNew"]').addClass('proceed-btn').removeClass('wait-btn');

          // Display error message
          $('#subErr').html('');

          return true;

        } else {

          // If all fields are filled in then change the button colour
          $('input[name="btnAddNew"]').removeClass('proceed-btn').addClass('wait-btn');

          return false;

        }

      } // end of valInput function

      function valForm(){

        matchPw();

        var submitForm = valInput();

        if(!submitForm){

          $('#subErr').html('Fill all fields to submit form');

          var name = $('input[name="txtName"]');
          var surname = $('input[name="txtSurname"]');
          var email = $('input[name="txtEmail"]');
          var mobile = $('input[name="txtMobile"]');
          var uinput =[name, surname, email, mobile];

          var j = 0;


          while(uinput[j].val() !== ''){
            j++;
          } // end while

          uinput[j].focus();

          for(var s = 0; s <= 3; s++){

            if(uinput[s].val() === ''){

              uinput[s].addClass('error-bg');

              // Removes error class
              uinput[s].blur(function(){

                var obj = $(this);

                if(obj.val() !== '') {
                    obj.removeClass('error-bg');
                }

              });
            } else {

              uinput[s].removeClass('error-bg');

            }

          } // end for loop

          return false;

        } else {

          return true;

        }

      }

      // Removes error class
      $('.correctVal').blur(function(){
        var obj = $(this);

        if(obj.val() !== '') {
            obj.removeClass('error-bg');
        }

      });

        // Password client-side validation
        function matchPw(){

          var pw1 = $('input[name="txtPw1"]').val();
          var pw2 = $('input[name="txtPw2"]').val();
          var errMsg = '';
          var pwVal = false;

          if(pw1 === '' || pw2 == ''){

               errMsg = 'Please fill in both passwords';

          } else if(pw1 !== pw2){

            $('input[name="txtPw1"]').focus();
            errMsg = 'Passwords do not match';

          } else {

            pwVal = true;
            errMsg = '';

          }

          // display error message
          $("#pwErr").html(errMsg);

          if(!pwVal){

            $('input[name="txtPw1"], input[name="txtPw2"]').addClass('error-bg');

            document.getElementsByName('txtPw2')[0].value = "";

            return false;

          } else {

            $('input[name="txtPw1"], input[name="txtPw2"]').removeClass('error-bg');

            return true;
          }


        }


    </script>
  </body>
</html>
