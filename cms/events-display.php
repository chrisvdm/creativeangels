<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_partners = "SELECT * FROM tblpartners";

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
            <div class="team-card" id="partners<?php echo $rs_events_rows['eid']; ?>">

              <table cellspacing="0" class="tbldatadisplay">

                <tr class="tbl-heading">

                  <td colspan="5">
                    <strong><?php echo $rs_events_rows['etitle']; ?></strong>
                  </td>
                  <td class=button-set width="600">
                    <form method="get" action="events-update-display.php">
                      <button>Update</button>
                      <input type="hidden" name="txtId" value="<?php echo $rs_events_rows['eid'];?>">
                      <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                    </form>

                      <input type="button" class="danger-btn" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-id="<?php echo $rs_events_rows['eid']; ?>">
                    </td>

                </tr>
                <tr>
                  <td rowspan="4" width="250" style="text-align: center">
                    <?php if($rs_events_rows['eimg'] === 'na') { echo 'No Image uploaded'; } else {?>
                      <figure>
                        <?php
                          $img_str = $rs_events_rows['eimg'];
                          $img_arr = explode(', ', $img_str);

                          echo '<img src="../assets/uploads/events/large/' . reset($img_arr) .'">';
                        ?></figure>
                    <?php } ?>
                  </td>
                  <td width="100" class="accent"><strong>Description</strong></td>
                  <td colspan="4">
                    <?php echo $rs_events_rows['edescription']; ?>
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

          <?php } while($rs_events_rows = mysqli_fetch_assoc($rs_partners)) ?>
          <div class="clearfix"></div>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
