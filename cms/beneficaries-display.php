<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblbeneficaries
$sql_beneficaries = "SELECT * FROM tblbeneficaries";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_beneficaries = mysqli_query($vconn_creativeangels, $sql_beneficaries);

//Create associative Array
$rs_beneficaries_rows = mysqli_fetch_assoc($rs_beneficaries);

//Count the entries into the record set
$rs_beneficaries_rows_total = mysqli_num_rows($rs_beneficaries);

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
            <h2>Beneficaries</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <?php if($rs_beneficaries_rows_total > 0) { ?>

          <?php do { ?>
            <div class="team-card" id="beneficaries<?php echo $rs_beneficaries_rows['bid']; ?>">

              <table cellspacing="0" class="tbldatadisplay">

                <tr class="tbl-heading">

                  <td colspan="5">
                    <strong><?php echo $rs_beneficaries_rows['bname']; ?></strong>
                  </td>

                  <!-- BUTTON SET -->
                  <td class=button-set >

                    <!-- Edit -->
                    <form method="post" action="beneficaries-update-display.php">
                      <button>Edit <span class="fa fa-pencil"></span></button>
                      <input type="hidden" name="txtId" value="<?php echo $rs_beneficaries_rows['bid'];?>">
                      <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
                    </form>

                    <!-- Archive -->
                    <button type="button" name="btnArc" data-security="<?php echo $_SESSION['svSecurity']; ?>" data-status="<?php echo $rs_beneficaries_rows['bstatus']?>" data-id="<?php echo $rs_beneficaries_rows['bid']; ?>"><?php if($rs_beneficaries_rows['bstatus'] === 'a') {echo 'Archive <span class="fa fa-archive"></span>';} elseif($rs_beneficaries_rows['bstatus'] === 'i'){echo 'Unarchive <span class="fa fa-upload"></span>';}?></button>
                  </td>

                </tr>
                <tr>
                  <td rowspan="7" width="250" style="text-align: center">
                    <?php
                      $img_str = $rs_beneficaries_rows['bimg'];
                      $img_arr = explode(', ', $img_str);

                      if($img_arr) {
                        echo '<img src="../assets/uploads/beneficaries/large/' . reset($img_arr) .'">';
                      } else {
                        echo '<img src="../assets/uploads/beneficaries/large/' . $img_str .'">';
                      }
                    ?>
                  </td>
                  <td width="100" class="accent"><strong>Description</strong></td>
                  <td colspan="4">
                    <?php echo $rs_beneficaries_rows['bdescription']; ?>
                  </td>
                </tr>
                <tr>
                  <td class="accent"><strong>Beneficary Website</strong></td>
                  <td colspan="4">
                    <a class="link" href="<?php echo $rs_beneficaries_rows['blink']; ?>" title="Link to event webpage"><?php echo $rs_beneficaries_rows['blink']; ?></a>

                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="4">
                    <small><i>Last Modified:  <?php echo $rs_beneficaries_rows['bmodified']; ?></i></small>
                  </td>
                </tr>

              </table>

            </div>

          <?php } while($rs_beneficaries_rows = mysqli_fetch_assoc($rs_beneficaries)) ?>

          <div class="clearfix"></div>

          <?php } else {?>

            <h2 class="accent">There are no beneficaries to display</h2>
            <p>Add a beneficary by navigating to <a href="beneficaries-add-new.php" title="Create a new event"><i>Beneficaries > Add New</i></a>.

          <?php }?>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
    <script>

    $(document).ready(function() {

      $(':button[name="btnArc"]').click(function() {

        var btn = $(this);
        var info = btn.data();

        $.ajax({
          type: 'POST',
          url: 'beneficaries-archive-ajax-process.php',
          data: {
            'txtId': info.id,
            'txtStatus': info.status,
            'txtSecurity': info.security
          },
          success: function(result) {

            if(result === 'a'){
              // Change button text and data attribute
              btn.attr('data-status', result);
              btn.html('Archive <span class="fa fa-archive"></span>');

            } else if(result === 'i'){

              // Change button text and data attribute
              btn.attr('data-status', result);
              btn.html('Unarchive <span class="fa fa-upload"></span>');

            } else {

              // Display toast to notify user if archiving was unsuccessful
              mw.deleteToast('Beneficary status could not be changed', '#main-content');
            }

          }
        });
      });

    });

    </script>
  </body>
</html>
