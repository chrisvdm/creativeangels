<?php require('inc-public-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_partners = "SELECT * FROM tblpartners ORDER BY pid DESC";

//Connect to MYSQL Server
require(PATH . '/inc-conn.php');

//Execute SQL statement
$rs_partners = mysqli_query($vconn_creativeangels, $sql_partners);

//Create associative Array
$rs_partners_rows = mysqli_fetch_assoc($rs_partners);

$rs_partners_rows_total = mysqli_num_rows($rs_partners);

?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels Partners</title>

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
         <h2>Our Partners</h2>

           <?php do {?>

             <article>

               <h3><?php echo $rs_partners_rows['pcompany']; ?></h3>

               <figure class="partners-img">
                 <img src="<?php echo 'assets/uploads/partners/large/' . $rs_partners_rows['plogo'];?>" >
               </figure>

               <p><?php echo $rs_partners_rows['pdescription']; ?></p>

             </article>
             <?php } while ($rs_partners_rows = mysqli_fetch_assoc($rs_partners))?>

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
