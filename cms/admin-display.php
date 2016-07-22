<?php require("inc-cms-pre-doctype.php"); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
  // Create SQL statement
  $sql_cms = "SELECT * FROM tblcms ORDER BY ccreated DESC";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_cms = mysqli_query($vconn_creativeangels, $sql_cms);

  //Create associative Array
  $rs_cms_rows = mysqli_fetch_assoc($rs_cms);

  //Count the entries into the record set
  $rs_cms_rows_total = mysqli_num_rows($rs_cms);
?>
<!DOCTYPE HTML>
<html>

<head>
<?php require("inc-cms-head-content.php"); ?>

<style>

  .hide {
    display: none;
  }

  .show {
    display: table-row;
    background-color: #b4ced3;
  }

</style>
</head>

<body>

<div id="main_container">

<div id="branding_bar">
<?php require("inc-cms-branding-bar.php"); ?>
</div>

<div id="body_column_left_container">

    <div id="body_column_left">
        <?php require("inc-cms-accordion_menu.php"); ?>
    </div>

</div>

<div id="body_column_right_container">

    <div id="body_column_right">
        <h2>Administrators</h2>
        <p>&nbsp;</p>

        <!-- Display the table if the tblcms has data has entries -->
        <?php if($rs_cms_rows_total > 0 ) { ?>

        <table cellspacing="0" class="tbldatadisplay">
          <!-- Row 1 -->
          <tr>
            <td colspan="7">Number of Administrators: <?php echo $rs_cms_rows_total; ?></td>
          </tr>
          <!-- Heading Row -->
          <tr>
            <td><strong>Administrator</strong></td>
            <td align="center"><strong>Access Level</strong></td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>

          <!-- Subheading Row 3 -->
          <tr>
            <td>Surname, name</td>
            <td align="center">Access</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>

          <!-- Display all records in the table -->
          <?php do { ?>

            <tr id="record<?php echo $rs_cms_rows['cid']; ?>">

              <td><?php echo $rs_cms_rows['csurname'] . ', ' . $rs_cms_rows['cname']; ?></td>

              <td align="center"><?php echo $rs_cms_rows['caccesslevel']; ?></td>

              <!-- Change status -->
              <td align="center">

                <!-- This is where the ajax method needs to change things -->
                <!-- My thoughts are that ajax will run the data on the process file, therefore we can remove the action or something like that. I could be very wrong -->
                <input type="button" name="statusBtn" value="<?php if($rs_cms_rows['cstatus'] === 'i'){echo 'Activate';} elseif($rs_cms_rows['cstatus'] === 'a'){echo 'Deactivate';} ?>" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-entry-id="<?php echo $rs_cms_rows['cid']; ?>"></td>

              <!-- View details -->
              <td align="center">

                <!-- <form method="get" action="admin-display-details.php">

                  <input type="hidden" name="txtId" value="<?php //echo $rs_cms_rows['cid']; ?>">

                  <input type="hidden" name="txtSecurity" value="<?php //echo $_SESSION['svSecurity']; ?>">

                  <input type="submit" name="btnView" value="View">

                </form> -->

                <input id="btn<?php echo $rs_cms_rows['cid']; ?>" type="button" name="btnView" data-cid="<?php echo $rs_cms_rows['cid']; ?>" value="View Details">

                </td>

              <!-- Edit record -->
              <td align="center">Edit</td>

              <!-- Delete record -->
              <td align="center">

                  <!-- <input type="hidden" name="txtId" value="<?php //echo $rs_cms_rows['cid']; ?>">

                  <input type="hidden" name="txtSecurity" value="<?php //echo $_SESSION['svSecurity']; ?>"> -->

                  <input type="button" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-entry-id="<?php echo $rs_cms_rows['cid']; ?>">

              </td>

            </tr>

            <tr id="row<?php echo $rs_cms_rows['cid']; ?>" class="hide">
              <td colspan="6">

                  <strong>Registered:</strong> <?php echo $rs_cms_rows['ccreated']; ?>
                  <br><br>

                  <strong>Modified: </strong><?php echo $rs_cms_rows['cupdated']; ?>
                  <br><br>

                  <strong>Access Level : </strong><?php echo $rs_cms_rows['caccesslevel']; ?>
                  <br><br>

                  <strong>Status : </strong><span id="stat<?php echo $rs_cms_rows['cid']; ?>"><?php if($rs_cms_rows['cstatus'] === 'i') {echo 'Inactive';} elseif ($rs_cms_rows['cstatus'] === 'a') {echo 'Active';} ?></span>
                  <br><br>

                  <strong>Email: </strong><a href="mailto:<?php echo $rs_cms_rows['cemail']; ?>" title="Send email to Admin"><?php echo $rs_cms_rows['cemail']; ?></a>
                  <br><br>

                  <strong>Username: </strong><?php echo $rs_cms_rows['cusername']; ?>
                  <br><br>

                  <strong>Mobile: </strong><?php echo $rs_cms_rows['cmobile']; ?>

              </td>
            </tr>

            <script>

              $(document).ready(function(){

                // accordian

                $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('collapse');

                  $("#btn<?php echo $rs_cms_rows['cid']; ?>").click(function(){

                    if($("#row<?php echo $rs_cms_rows['cid']; ?>").is(':visible')){

                      $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('hide').removeClass('show');

                    }else {

                      $('.collapse').addClass('hide').removeClass('show');
                      $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('show').removeClass('hide');

                    }

                    $("#row<?php echo $rs_cms_rows['cid']; ?>").toggleClass('hide');

                  });

                }); // end of accordian function ready doc

              </script>

            <!-- End of while loop for displaying all the records -->
            <!-- I asked Matt exactly what this line of code was checking for and apparently it's
            hard to explain. I think that theres a bit of interactivity with the sql server here
            where it automatically moves onto the next entry after an entry is 'fetched'.
            I think it resets the counter/index number (goes back to the first entry) everytime this action ($rs_cms = mysqli_query($vconn_newsreporter,
            $sql_cms);) is performed. Thats my theory. For more information the
            'mysqli_fetch_assoc()' method needs more exploration. -->
            <!-- Else consider this line Black Magic. -->
          <?php } while($rs_cms_rows = mysqli_fetch_assoc($rs_cms)) ?>

          <!-- Last row: YOLO -->
          <tr>
            <td colspan="6">&nbsp;</td>
          </tr>

        </table>

        <?php } else { ?>

          <!-- To display if no records are found -->
          <p>No records found</p>

        <?php } ?>

    </div>

</div>

<div class="clearfloat_both"></div>

</div>

  <script>

    $(document).ready(function() {

      // changes status and updates database table
      $(':button[name = "statusBtn"]').on('click', function() {

        var btn = $(this),
          info = $(btn).data();
          var unicorn = $(btn).val();

          $.ajax({
            type: 'GET',
            url: 'admin-display-change-status.php',
            data: {
              'txtStatus': unicorn,
              'txtSecurity': info.sec,
              'txtId': info.entryId
            },
            success: function(result) {
              $(btn).val(result);

              if(result === 'Activate'){ // 'i' vs 'a'

                $('#stat'+ info.entryId).html('Inactive');

              } else if (result === 'Deactivate'){

                $('#stat' + info.entryId).html('Active');

              }

            }}); //end of ajax method
        }); // end of ()

      // confirm dialogue for delete 'form'
      $(':button[name = "btnDel"]').on('click', function(){

          var delRec = confirm('Deleting a record is a permanent action.\nDo you wish to proceed?');

          if (delRec) {

          var btn = $(this);
          var info = $(btn).data();

          $.ajax({
            type: 'GET',
            url: 'admin-delete-ajax-process.php',
            data: {
              'txtSecurity': info.sec,
              'txtId': info.entryId
            },
            success: function(result) {

              $(btn).parent().addClass('warning_msg').html(result);

            }});

          } // end of if statement

        }); // end of function

    }); //  end of jQuery

  </script>
</body>

</html>
