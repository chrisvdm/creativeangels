<?php require('inc-cms-pre-doctype.php'); ?>
<?php

// Create SQL statement to fetch all records from tblcontactdetails
$sql_test = "SELECT * FROM tbltestimonials";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_test = mysqli_query($vconn_creativeangels, $sql_test);

//Create associative Array
$rs_test_rows = mysqli_fetch_assoc($rs_test);

//Count the entries into the record set
$rs_test_rows_total = mysqli_num_rows($rs_test);

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
            <h2>Testimonials</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

        <?php do { ?>
          <div class="team-card">

            <table cellspacing="0" class="tbldatadisplay">

              <tr class="tbl-heading">

                <td colspan="5">
                  <strong><?php echo $rs_test_rows['tcontributor']; ?></strong>
                </td>
                <td class=button-set width="600">

                  <form method="get" action="testimonials-update-display.php">
                    <button>Update</button>
                    <input type="hidden" name="txtId" value="<?php echo $rs_test_rows['tid'];?>">
                    <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                  </form>

                  <input type="button" class="danger-btn" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-img="<?php echo $rs_test_rows['timg']; ?>" data-id="<?php echo $rs_test_rows['tid']; ?>">

                </td>

              </tr>
              <tr>
                <td rowspan="4" width="250" style="text-align: center">
                  <?php if($rs_test_rows['timg'] === 'na') { echo 'No Image uploaded'; } else {?>
                    <figure><img src="../assets/uploads/testimonials/thumb/<?php echo $rs_test_rows['timg']; ?>"></figure>
                  <?php } ?>
                </td>
                <td width="100" class="accent" ><strong>Testimonial</strong></td>
                <td colspan="4">
                  <?php echo $rs_test_rows['ttestimonial']; ?>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4">
                  <small><i>Last Modified:  <?php echo $rs_test_rows['tmodified']; ?></i></small>
                </td>
              </tr>

           </table>

         </div>

         <?php } while($rs_test_rows = mysqli_fetch_assoc($rs_test)) ?>
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
          url: 'testimonials-delete-ajax-process.php',
          data: {
            'txtSecurity': info.sec,
            'txtId': info.id,
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
