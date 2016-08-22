<?php require('inc-cms-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_about = "SELECT * FROM tblabout";

//Connect to MYSQL Server
require('inc-conn.php');

//Execute SQL statement
$rs_about = mysqli_query($vconn_creativeangels, $sql_about);

//Create associative Array
$rs_about_rows = mysqli_fetch_assoc($rs_about);

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
            <h2>About Details</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <table cellspacing="0" class="tbldatadisplay">

              <!--On all of these tds I placed an if statement that echos a "not Available" clause to avoid the page displaying "na" when the content is not available. This was optional, however this must not be displayed on the contact page of the contact us page on the front end of the website.-->
              <tr id="record<?php echo $rs_about_rows['cid']; ?>">
              <td  class="accent" width=100 valign="top"><strong>Mission Statement:</strong></td>
              <td><?php echo nl2br($rs_about_rows['amission']); ?></td>
              </tr>

             <tr>
             <td class="accent" valign="top"><strong>Description:</strong></td>
             <td>
               <?php echo nl2br($rs_about_rows['adescription']); ?>
             </td>
           </tr>
         </table>

         <div class="button-set">



           <form method="get" action="about-details-update-display.php">
             <button>Update</button>
             <input type="hidden" name="txtId" value="<?php echo $rs_about_rows['aid'];?>">
             <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">
           </form>

         </div>

         <p>
              <small><i>Last Modified:  <?php echo $rs_about_rows['amodified']; ?></i></small>
         </p>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
