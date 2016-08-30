<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_team = "SELECT * FROM tblteam";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_team = mysqli_query($vconn_creativeangels, $sql_team);

//Create associative Array
$rs_team_rows = mysqli_fetch_assoc($rs_team);

//Count the entries into the record set
$rs_team_rows_total = mysqli_num_rows($rs_team);

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
            <h2>Team Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

        <?php do { ?>
          <div class="team-card">

            <table cellspacing="0" class="tbldatadisplay">

              <tr class="tbl-heading">

                <td colspan="5">
                  <strong><?php echo $rs_team_rows['tname'] . ' ' . $rs_team_rows['tsurname']; ?></strong>
                </td>
                <td class=button-set width="600">
                  <form method="get" action="team-update-display.php">
                    <button>Update</button>
                    <input type="hidden" name="txtId" value="<?php echo $rs_team_rows['tid'];?>">
                    <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                  </form>

                    <input type="button" class="danger-btn" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-img="<?php echo $rs_team_rows['tphotograph']; ?>" data-entry-id="<?php echo $rs_team_rows['tid']; ?>">
                  </td>

              </tr>
              <tr>
                <td rowspan="4" width="250" style="text-align: center">
                  <?php if($rs_team_rows['tphotograph'] === 'na') { echo 'No Image uploaded'; } else {?>
                    <figure><img src="../assets/uploads/team/thumb/<?php echo $rs_team_rows['tphotograph']; ?>"></figure>
                  <?php } ?>
                </td>
                <td width="100" class="accent"><strong>Company Name</strong></td>
                <td colspan="4">
                  <?php echo $rs_team_rows['tcompname']; ?>
                </td>
              </tr>
              <tr>
                <td width="100" class="accent"><strong>Job Title</strong></td>
                <td colspan="4">
                  <?php echo $rs_team_rows['tjobtitle']; ?>
                </td>
              </tr>
              <tr>
                <td width="100" class="accent"><strong>Bio</strong></td>
                <td colspan="4">
                  <?php echo $rs_team_rows['tbio']; ?>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4">
                  <small><i>Last Modified:  <?php echo $rs_team_rows['tmodified']; ?></i></small>
                </td>
              </tr>

           </table>

         </div>

         <?php } while($rs_team_rows = mysqli_fetch_assoc($rs_team)) ?>
         <div class="clearfix"></div>
        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>
    $(document).ready(function() {

      // confirm dialogue for delete 'form'
      $(':input[name = "btnDel"]').on('click', function(){

        var btn = $(this);
        var info = $(btn).data();

        mw.delete('Deleting a record is a permanent action.\nDo you wish to proceed?', '#main-content', function(result) {

          if (result) {
            deleteRecord(btn, info);
          }

        });

      function deleteRecord(btn, info) {

        $.ajax({
          type: 'POST',
          url: 'team-delete-ajax-process.php',
          data: {
            'txtSecurity': info.sec,
            'txtId': info.entryId,
            'txtImg': info.img
          },
          success: function(result) {

            $(btn).parent().parent().parent().remove();
            mw.deleteToast('Record has been deleted', '#main-content');

          }
        });
      } // end of ajax deleteRecord

      });
    });

    </script>
  </body>
</html>
