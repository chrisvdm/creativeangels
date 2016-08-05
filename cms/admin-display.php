<?php require("inc-cms-pre-doctype.php"); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
  // Create SQL statement
  $sql_cms = "SELECT * FROM tblcms ORDER BY ccreated ASC";

  //Connect to MYSQL Server
  require('inc-conn.php');

  //Execute SQL statement
  $rs_cms = mysqli_query($vconn_creativeangels, $sql_cms);

  //Create associative Array
  $rs_cms_rows = mysqli_fetch_assoc($rs_cms);

  //Count the entries into the record set
  $rs_cms_rows_total = mysqli_num_rows($rs_cms);
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
            <h2>User Account Overview</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">


                <!-- DISPLAY NOTIFICATION WHEN TASKS ARE COMPLETED -------------------->
                <?php

                if(isset($_GET['kupdate']) && $_GET['kupdate'] === 'success') {
                  echo '<div class="corner-modal success">
                    <p>
                      Record has been succesfully updated
                    </p>
                  </div>';
                }

                ?>

          <p>&nbsp;</p>

          <!-- Display the table if the tblcms has data has entries -->
          <?php if($rs_cms_rows_total > 0 ) { ?>

          <!-- DISPLAY TABLE ------------------------------------------------->

          <table cellspacing="0" class="tbldatadisplay">
            <!-- Row 1 -->
            <tr>
              <td colspan="7">Number of Users: <?php echo $rs_cms_rows_total; ?></td>
            </tr>

            <!-- HEADING ROW ------------------------------------------------->

            <tr class="tbl-heading">
              <td><strong>User</strong></td>
              <td align="center"><strong>Access Level</strong></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>

            <!-- DATA TO DISPLAY --------------------------------------------->
            <?php do { ?>

              <tr id="record<?php echo $rs_cms_rows['cid']; ?>">

                <!-- Display name -->
                <td><?php echo $rs_cms_rows['csurname'] . ', ' . $rs_cms_rows['cname']; ?></td>

                <!-- Access Level -->
                <td align="center"><?php if ($rs_cms_rows['caccesslevel']==='a'){ echo 'Level A';} elseif ($rs_cms_rows['caccesslevel'] === 'b') {
                  echo 'Level B';
                } ?></td>

                <!-- View details -->
                <td align="center">


                  <input id="btn<?php echo $rs_cms_rows['cid']; ?>" type="button" name="btnView" data-cid="<?php echo $rs_cms_rows['cid']; ?>" value="View Details">

                  </td>

                <!-- Edit record -->
                <td align="center"><?php if ($_SESSION['svcaccesslevel']=== 'a'){?>
                <form action="admin-update-display.php" method="get">

                  <!-- send id to process file -->
                  <input type="hidden" name="txtId" value="<?php echo $rs_cms_rows['cid']; ?>">

                  <!-- send security variable to process file -->
                  <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

                  <input type="submit" name="btnEdit" value="Edit">
                </form>

              </td>

              <?php } else { ?>
                <td>
                  &nbsp;
                </td>
                <td>
                  &nbsp;
                </td>
                <td>
                  &nbsp;
                </td>

                <?php } ?>


                <!-- Change status -->
                <td align="center">
                  <?php if ($_SESSION['svcaccesslevel'] === 'a' && $_SESSION['svcid'] !== $rs_cms_rows['cid']){?>

                  <!-- This is where the ajax method needs to change things -->
                  <!-- My thoughts are that ajax will run the data on the process file, therefore we can remove the action or something like that. I could be very wrong -->
                  <input type="button"name="statusBtn" value="<?php if($rs_cms_rows['cstatus'] === 'i'){echo 'Activate';} elseif($rs_cms_rows['cstatus'] === 'a'){echo 'Deactivate';} ?>"" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-entry-id="<?php echo $rs_cms_rows['cid']; ?>"></td>

                  <?php } else { ?>
                    &nbsp;

                    <?php } ?>

                <!-- Delete record -->
                  <td align="center">
                    <?php if ($_SESSION['svcaccesslevel']=== 'a'  && $_SESSION['svcid'] !== $rs_cms_rows['cid']){?>

                    <input type="button" class="danger-btn" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-entry-id="<?php echo $rs_cms_rows['cid']; ?>">

                </td>
                <?php } else { ?>
                  &nbsp;

                  <?php } ?>

              </tr>

              <!-- VIEW DETAILS TABLE ------------------------------------>
              <tr id="row<?php echo $rs_cms_rows['cid']; ?>" class="hide">
                <td colspan="6">
                  <table cellspacing="0" class="tbldetailsdisplay">
                    <tr>
                      <td>
                        <strong>Registered:</strong>
                      </td>
                      <td>
                        <?php echo $rs_cms_rows['ccreated']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong>Modified: </strong>
                      </td>
                      <td>
                        <?php echo $rs_cms_rows['cupdated']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong>Access Level : </strong>
                      </td>
                      <td>
                        <?php if ($rs_cms_rows['caccesslevel']==='a'){ echo 'Level A';} elseif ($rs_cms_rows['caccesslevel'] === 'b') {
                          echo 'Level B';
                        } ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong>Status: </strong>
                      </td>
                      <td>
                        <span id="stat<?php echo $rs_cms_rows['cid']; ?>"><?php if($rs_cms_rows['cstatus'] === 'i') {echo 'Inactive';} elseif ($rs_cms_rows['cstatus'] === 'a') {echo 'Active';} ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong>Email: </strong>
                      </td>
                      <td>
                        <a href="mailto:<?php echo $rs_cms_rows['cemail']; ?>" title="Send email to Admin"><?php echo $rs_cms_rows['cemail']; ?></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <strong>Mobile:</strong>
                      </td>
                      <td>
                        <?php echo $rs_cms_rows['cmobile']; ?>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <script>

                $(document).ready(function(){

                  // accordian

                  $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('collapse');

                    $("#btn<?php echo $rs_cms_rows['cid']; ?>").click(function(){

                      // If info is visibles
                      if($("#row<?php echo $rs_cms_rows['cid']; ?>").is(':visible')){

                        $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('hide').removeClass('show');

                      } else {

                        $('.collapse').addClass('hide').removeClass('show');
                        $("#row<?php echo $rs_cms_rows['cid']; ?>").addClass('show').removeClass('hide');

                      }

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


        </section>



      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>



      $(document).ready(function() {

        $('div.corner-modal.success').delay(4000).fadeOut(500, function(){
          $(this).remove();
        });

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
