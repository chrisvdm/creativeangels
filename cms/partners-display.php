<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_partners = "SELECT * FROM tblpartners";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_partners = mysqli_query($vconn_creativeangels, $sql_partners);

//Create associative Array
$rs_partners_rows = mysqli_fetch_assoc($rs_partners);

//Count the entries into the record set
$rs_partners_rows_total = mysqli_num_rows($rs_partners);

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
            <h2>Partners Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <?php do { ?>
            <div class="team-card" id="partners<?php echo $rs_partners_rows['pid']; ?>">

              <table cellspacing="0" class="tbldatadisplay">

                <tr class="tbl-heading">

                  <td colspan="5">
                    <strong><?php echo $rs_partners_rows['pcompany']; ?></strong>
                  </td>
                  <td class=button-set width="600">
                    <form method="get" action="partners-update-display.php">
                      <button>Update</button>
                      <input type="hidden" name="txtId" value="<?php echo $rs_partners_rows['pid'];?>">
                      <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                    </form>

                      <input type="button" class="danger-btn" name="btnDel" value="Delete" data-sec="<?php echo $_SESSION['svSecurity']; ?>" data-id="<?php echo $rs_partners_rows['pid']; ?>" data-logo="<?php echo $rs_partners_rows['plogo']; ?>">
                    </td>

                </tr>
                <tr>
                  <td rowspan="4" width="250" style="text-align: center">
                    <?php if($rs_partners_rows['plogo'] === 'na') { echo 'No Image uploaded'; } else {?>
                      <figure><img src="../assets/uploads/partners/thumb/<?php echo $rs_partners_rows['plogo']; ?>"></figure>
                    <?php } ?>
                  </td>
                  <td width="100" class="accent"><strong>Description</strong></td>
                  <td colspan="4">
                    <?php echo $rs_partners_rows['pdescription']; ?>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4">
                    <small><i>Last Modified:  <?php echo $rs_partners_rows['pmodified']; ?></i></small>
                  </td>
                </tr>

             </table>

           </div>

           <?php } while($rs_partners_rows = mysqli_fetch_assoc($rs_partners)) ?>
           <div class="clearfix"></div>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>
    $(document).ready(function() {

      $(':button[name="btnDel"]').on('click', function() {

        var btn = $(this);
        var info = btn.data();

        $.ajax({
          type: 'POST',
          url: 'partners-delete-ajax-process.php',
          data: {
            'txtSecurity': info.sec,
            'txtId': info.id,
            'txtLogo': info.logo
          },
          success: function(result) {

            $('#partners' + info.id).remove();
            mw.deleteToast('Record has been deleted', '#main-content');

          }
        });

      });


    });

    </script>
  </body>
</html>
