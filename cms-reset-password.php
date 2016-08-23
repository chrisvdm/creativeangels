<?php require('inc-public-pre-doctype.php'); ?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | Reset password</title>

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
         <h2>Reset Password</h2>

         <!--=================== ENTER NEW PASSWORD ================-->
         <form method="post" action="<? echo PATH; ?>/cms-reset-password-process.php" onsubmit="return matchpws()">

           <p class="msgwarning" id="pwnomatch"></p>

           <!-- Warning messages -->
           <?php if(isset($_GET['kvalidation']) && $_GET['kvalidation'] === 'failed') {?>

             <div class="msgwarning">Please complete both fields</div>
             <br>
           <?php } ?>

           <label>New Password:</label><br>
           <input type="password" name="txtPw1" required autofocus placeholder="New password">
           <p>&nbsp;</p>

           <label>Re-type Password:</label><br>
           <input type="password" name="txtPw2" placeholder="Retype password">
           <p>&nbsp;</p>

           <!-- Hidden fields for reusable data -->
           <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

           <input type="hidden" name="txtId" value="<?php if(isset($vid) && $vid !== '') { echo $vid; } ?>">

             <input type="hidden" name="txtEmail" value="<?php if(isset($vemail) && $vemail !== '') { echo $vemail; } ?>">

             <input type="hidden" name="txtName" value="<?php if(isset($vname) && $vname !== '') { echo $vname; } ?>">

           <input type="submit" name="btnsubmit" value="Reset password">
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
