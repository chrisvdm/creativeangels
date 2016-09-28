<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_events = "SELECT * FROM tblevents";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_events = mysqli_query($vconn_creativeangels, $sql_events);

//Create associative Array
$rs_events_rows = mysqli_fetch_assoc($rs_events);

//Count the entries into the record set
$rs_events_rows_total = mysqli_num_rows($rs_events);

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Head contents -->
    <?php require('inc-cms-head-content.php'); ?>
    <script src="js/modal.js"></script>

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
            <h2>Events</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <?php do { ?>
            <div class="team-card" id="events<?php echo $rs_events_rows['eid']; ?>">

              <table cellspacing="0" class="tbldatadisplay">

                <tr class="tbl-heading">

                  <td colspan="5">
                    <strong><?php echo $rs_events_rows['etitle']; ?></strong>
                  </td>
                  <td class=button-set >
                    <form method="post" action="events-update-display.php">
                      <button>Edit <span class="fa fa-pencil"></span></button>
                      <input type="hidden" name="txtId" value="<?php echo $rs_events_rows['eid'];?>">
                      <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                    </form>

                    <button type="button" class="danger-btn" name="btnDel" data-security="<?php echo $_SESSION['svSecurity']; ?>" data-id="<?php echo $rs_events_rows['eid']; ?>" data-img="<?php echo $rs_events_rows['eimg']; ?>">Delete <span class="fa fa-trash-o"></span></button>
                  </td>

                </tr>
                <tr>
                  <td rowspan="4" width="250" style="text-align: center">
                    <?php
                      $img_str = $rs_events_rows['eimg'];
                      $img_arr = explode(', ', $img_str);

                      if($img_arr) {
                        echo '<img src="../assets/uploads/events/large/' . reset($img_arr) .'">';
                      } else {
                        echo '<img src="../assets/uploads/events/large/' . $img_str .'">';
                      }
                    ?>
                  </td>
                  <td width="100" class="accent"><strong>Description</strong></td>
                  <td colspan="4">
                    <?php echo $rs_events_rows['edescription']; ?>
                  </td>
                </tr>
                <tr>
                  <td class="accent"><strong>Date</strong></td>
                  <td colspan="4">
                  <?php echo $rs_events_rows['edate']; ?>
                  </td>
                </tr>
                <tr>
                  <td class="accent"><strong>Event Url</strong></td>
                  <td colspan="4">
                    <a href="<?php echo $rs_events_rows['elink']; ?>"><?php echo $rs_events_rows['elink']; ?></a>

                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4">
                    <small><i>Last Modified:  <?php echo $rs_events_rows['emodified']; ?></i></small>
                  </td>
                </tr>

              </table>

            </div>

          <?php } while($rs_events_rows = mysqli_fetch_assoc($rs_events)) ?>
          <div class="clearfix"></div>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    $(document).ready(function() {

      $(':button[name="btnDel"]').click(function() {

        var btn = $(this);
        var info = btn.data();

        mw.delete('Deleting a record is a permanent action.\nDo you wish to proceed?', '#main-content', function(result) {

          if (result) {
            deleteRecord(info, btn);
          }

        });
      });

      function deleteRecord(info, btn) {
        $.ajax({
          type: 'POST',
          url: 'events-delete-ajax-process.php',
          data: {
            'txtId': info.id,
            'txtSecurity': info.security,
            'txtImgStr' : info.img
          },
          success: function(result) {

            // Remove event record
            btn.parents('.team-card').remove();
            // Toast
            mw.deleteToast('Event was deleted', '#main-content');

          }
        });
      }

    });

    </script>
  </body>
</html>
