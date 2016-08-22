<?php require('inc-public-pre-doctype.php'); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | Lost Password</title>

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
         <h2>Lost Password</h2>

         <form action="<?php echo DOMAIN; ?>/cms-pw-lost-process.php" method="post">
           <p>&nbsp;</p>

           <?php if(isset($_GET['kval']) && $_GET['kval'] === 'failed') {?>
           <div class="warning_msg" >Please enter a valid Email<br><br></div>
           <?php } ?>

           <?php if(isset($_GET['kpwupdate']) && $_GET['kpwupdate'] === 'failed') {?>
           <div class="warning_msg" >Password could not be updated. Please try again<br><br></div>
           <?php } ?>

           <label>
             Please enter your email address<br><br>
             <input type="email" name="txtEmail">
           </label>

           <br><br>

           <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

           <button>Send</button>

         </form>


       </section>

       <!--========================= SIDEBAR ========================-->
       <?php require( PATH . '/inc-public-sidebar.php'); ?>

       <div class="clearfix"></div>
      </div>


     <!--========================== FOOTER ========================-->
     <?php require( PATH . '/inc-public-footer.php'); ?>

    </div>

    <script src="<?php echo PATH; ?>/js/custom.js" charset="utf-8"></script>

  </body>
</html>
