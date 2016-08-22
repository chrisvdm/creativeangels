<?php require('inc-public-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_about = "SELECT * FROM tblabout";

//Connect to MYSQL Server
require(PATH . '/inc-conn.php');

//Execute SQL statement
$rs_about = mysqli_query($vconn_creativeangels, $sql_about);

//Create associative Array
$rs_about_rows = mysqli_fetch_assoc($rs_about);

?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | About</title>

  </head>
  <body>

    <!-- Website wrapper -->
    <div class="site-wrapper">

      <!--========================== HEADER ======================-->
      <?php require( PATH . '/inc-public-header.php'); ?>

      <!--===================== CONTENT WRAPPER ===================-->
      <div class="content-wrapper lav-skin">

        <!--===================== MAIN CONTENT ====================-->
        <section class="main-content-wrapper col-2-3">
         <h2>About</h2>

         <!-- First article -->
         <article>

           <h3>Mission Statement</h3>

           <p><?php echo nl2br($rs_about_rows['amission']); ?></p>

         </article>

         <!-- Second article -->
         <article>

           <h3>Description</h3>

           <p><?php echo nl2br($rs_about_rows['adescription']); ?></p>

         </article>
       </section>

       <!--========================= SIDEBAR ========================-->
       <?php require( PATH . '/inc-public-sidebar.php'); ?>

       <div class="clearfix"></div>
      </div>


     <!--========================== FOOTER ========================-->
     <?php require( PATH . '/inc-public-footer.php'); ?>

    </div>

    <script src="js/custom.js" charset="utf-8"></script>

  </body>
</html>
