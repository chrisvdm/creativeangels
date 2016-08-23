<?php require('inc-public-pre-doctype.php'); ?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | CMS Log in</title>

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
         <h2>CMS Log in</h2>

         <!-- First article -->
         <article>
           <?php if(isset($_GET['kpwupdate']) && $_GET['kpwupdate'] === 'success') { ?>
           <div >Your login details have been updated. Sign in with your new details<br><br></div>
           <?php } ?>

           <?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === 'invdet') { ?>

             <div class="warning_msg">Please enter a valid username and password. <br><br></div>

           <?php } ?>

           <?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === 'incdet') { ?>

             <div class="warning_msg">Your login details were incorrect. Please try again. <br><br></div>

           <?php } ?>

           <form action="<?php echo DOMAIN; ?>/cms-signin-process.php" method="post">

             <label>
               Username<br><br>
               <input type="email" name="txtEmail" autofocus>
             </label>

               <br><br>

             <label>
               Password<br><br>
               <input type="password" name="txtPassword">
             </label>

               <br><br>

               <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

             <button>Sign in</button>

             <a style="font-size: 80%; margin: 5px;" href="<?php echo PATH; ?>/cms-pw-lost.php">Forgot your password?</a>

           </form>


         </article>
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
