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
            <h2>Add New Team Member</h2>
          </div>

        </header>

        <!--################# MAIN CONTENT SECTION ########################-->

        <section id="main-content" class="base">

          <!--##################### ADD NEW FORM ##########################-->

          <!-- Executes instructions in 'admin-add-process.php' on submit and sends form data using get -->
          <form id="form" class="form" action="team-add-process.php" method="post" onsubmit="return valForm()" enctype="multipart/form-data">

            <!-- FIRST NAME -->
            <label>First name*</label>

            <!-- Displays warning message above empty field -->
            <?php echo errorMsg('kname', 'name'); ?>

            <input type="text" name="txtName" autocomplete="off" autofocus value="<?php echo displayTxt('kname'); ?>">

            <!-- SURNAME -->
            <label>Surname*</label>

            <?php echo errorMsg('ksurname', 'surname'); ?>

            <input type="text" name="txtSurname" autocomplete="off" value="<?php echo displayTxt('ksurname'); ?>">

            <!-- COMPANY NAME -->
            <label>Company name</label>

            <!-- Company name validation error msg -->
            <?php echo errorMsg('kcompname', 'company name'); ?>

            <input type="text" name="txtCompName" autocomplete="off" value="<?php echo displayTxt('kcompname'); ?>">


            <!-- JOB TITLE -->
            <label>Job title</label>

            <!-- Job title validation error msg -->
            <?php echo errorMsg('kjobtitle', 'job title'); ?>
            <input type="text" name="txtJobTitle" autocomplete="off" value="<?php echo displayTxt('kjobtitle'); ?>">

            <!-- BIO -->
            <label>Bio</label>

            <!-- Bio validation error msg -->
            <?php echo errorMsg('kbio', 'bio'); ?>
            <textarea type="text" name="txtBio" autocomplete="off" placeholder="Type short descriptive paragraph about the team member."><?php echo displayTxt('kbio'); ?></textarea>

            <label>Profile Picture</label>
            <input type="file" name="txtImg">

            <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">


            <!-- Button set -->
            <div class="button-set">

              <!-- submit form -->
              <button type="submit" name="btnAddNew">Add New</button>

              <a class="button danger-btn" href="team-details-display.php" name="btnCancel">Cancel</a>

            </div>


            <div id="subErr" class="warning_msg"></div>

          </form>

        </section>


      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    // creates initial data obj
    function initData(){
      return {
        name: '',
        surname: '',
        jobtitle: '',
        valid: true
      }
    }

    function render(data, dispatch){

      $('input[name="btnAddNew"]')
      .mouseover( function(){

      })

      $('input[name="txtName"]')
      .keyup( function (){
        changeName(dispatch, $(this).val());
      });

      $('input[name="txtSurname"]')
      .keyup( function (){
        changeSurname(dispatch, $(this).val());
      });

      $('input[name="txtJobTitle"]')
      .keyup( function (){
        changeJobTitle(dispatch, $(this).val());
      });

    } // end of bind events

    // Creates new data object based on action to
    /*function reduce(data, action){
      switch(action.type){

        case 'CHANGE_NAME':
        $.extend({}, data, {
          name: action.value
        });
        break;

        case 'CHANGE_SURNAME':
        $.extend({}, data, {
          surname: action.value
        });
        break;
      }
    }

    // main function in which all things happen
    function main(){

      var data = initData();

      function dispatch(action){
        var newData = reduce(data, action);
        render(newData, dispatch);
      }

      render(data, dispatch);
    }

    // Actions
    function changeName(dispatch, value){
      dispatch({
        type: 'CHANGE_NAME',
        value: value
      });
    }

    function changeSurname(dispatch, value){
      dispatch({
        type: 'CHANGE_SURNAME',
        value: value
      });
    } */


    // OLD CODE-------------------------------------------------------------

    $('input[name="btnAddNew"]').mouseover(valInput);

      function valInput() {

        var name = $('input[name="txtName"]').val();
        var surname = $('input[name="txtSurname"]').val();
        var jobtitle = $('input[name="txtJobTitle"]').val();
        var valid = 0;
        var uinput =[name, surname, jobtitle];

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

        var submitForm = valInput();

        if(!submitForm){

          $('#subErr').html('Fill all fields to submit form');

          var name = $('input[name="txtName"]');
          var surname = $('input[name="txtSurname"]');
          var surname = $('input[name="txtJobTitle"]');
          var uinput =[name, surname, jobtitle];

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

    </script>
  </body>
</html>
