<?php require('inc-public-pre-doctype.php'); ?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels Template</title>

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
         <h2>Insert Page Title here</h2>

         <!-- First article -->
         <article>

           <h3>I am an article with an h3 heading</h3>

           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

         </article>

         <!-- Second article -->
         <article>

           <h3>I am an article with an h3 heading</h3>

           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
           <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

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
