<?php require('inc-cms-pre-doctype.php'); ?>
<?php
if (isset($_GET['kid']) && $_GET['kid'] !== '') {

    //Extract the id from the array.
    $vid = base64_decode($_GET['kid']);
    // Create SQL statement
    $sql_contact_details = "SELECT * FROM tblcontactdetails WHERE cid=$vid";
    //Connect to MYSQL Server
    require('inc-conn.php');
    //Execute SQL statement
    $rs_contact_details = mysqli_query($vconn_creativeangels, $sql_contact_details);
    //Create associative Array
    $rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details);

  } else {

  header("Location: signout.php");
  exit();

}
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
            <h2>Contact Particulars</h2>
          </div>

        </header>

        <!-- MAIN CONTENT SECTION -->
        <section id="main-content" class="base">

          <p>&nbsp;</p>

          <?php if ($vid === '1') { echo '<h3>Durban</h3>'; } elseif ($vid === '2' ) { echo '<h3>Cape Town</h3>'; } ?>

          <table cellspacing="0" class="tbldatadisplay">

              <!--On all of these tds I placed an if statement that echos a "not Available" clause to avoid the page displaying "na" when the content is not available. This was optional, however this must not be displayed on the contact page of the contact us page on the front end of the website.-->
              <tr id="record<?php echo $rs_contact_details_rows['cid']; ?>">
              <td width=100><strong>Name:</strong></td>
              <td><?php echo $rs_contact_details_rows['ccontactpersonname'] . ' ' . $rs_contact_details_rows['ccontactpersonsurname']; ?></td>
              </tr>

              <tr>
              <td width=100><strong>Position:</strong></td>
              <td><?php if ($rs_contact_details_rows['ccontactpersontitle'] !== "na") { echo $rs_contact_details_rows['ccontactpersontitle']; } else { echo "Not Available"; } ?></td>
              </tr>

              <tr>
              <td width=100><strong>Office No:</strong></td>
              <td><?php if ($rs_contact_details_rows['clandline'] !== "na") { echo $rs_contact_details_rows['clandline']; } else { echo "Not Available"; } ?></td>
              </tr>

              <tr>
              <td width=100><strong>Cell No:</strong></td>
              <td><?php if ($rs_contact_details_rows['ccell'] !== "na") { echo $rs_contact_details_rows['ccell']; } else { echo "Not Available"; } ?></td>
              </tr>
              <tr>
             <td width=100><strong>Email:</strong></td>
             <td><?php if ($rs_contact_details_rows['cemail'] !== "na") { echo $rs_contact_details_rows['cemail']; } else { echo "Not Available"; } ?></td>
             </tr>

             <tr>
             <td><strong>Address:</strong></td>
             <td>
                 <!--I wrote this if statement so that when there is no address available, only the relevant cit y is displayed. normally the code looked like this:

                 <?php echo $rs_contact_details_rows['caddress1'] . ', ' . $rs_contact_details_rows['caddress2'] . ', ' . $rs_contact_details_rows['caddress3'] . ', ' . $rs_contact_details_rows['csuburb'] . ', ' . $rs_contact_details_rows['ccity']; ?>
                 However if there is no address available the innerHTML of the td displays na, na, na, na. This if statement is to prevent that from displaying.
                 -->
                 <?php if ($rs_contact_details_rows['caddress1'] === 'na' || $rs_contact_details_rows['caddress2'] === 'na' || $rs_contact_details_rows['caddress3'] === 'na' || $rs_contact_details_rows['csuburb'] === 'na') {

                 echo $rs_contact_details_rows['ccity'];

                 } elseif ($rs_contact_details_rows['caddress1'] !== 'na' || $rs_contact_details_rows['caddress2'] !== 'na' || $rs_contact_details_rows['caddress3'] !== 'na' || $rs_contact_details_rows['csuburb'] !== 'na') {

                 echo $rs_contact_details_rows['caddress1'] . ', ' . $rs_contact_details_rows['caddress2'] . ', ' . $rs_contact_details_rows['caddress3'] . ', ' . $rs_contact_details_rows['csuburb'] . ', ' . $rs_contact_details_rows['ccity'];

                 } ?>
             </td>
             </tr>

         </table>

        </section>

      </section>
      <div class="clearfix"></div>

    </div>

    <script src="js/accordian.js"></script>
  </body>
</html>
