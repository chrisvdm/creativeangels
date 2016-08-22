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
         <h2>Connection failed</h2>

         <!-- First article -->
         <article>

           <h3>I am an article with an h3 heading</h3>

           <p>Our database servers are currently down. Please try again in a few minutes.</p>
   					<p>We appologise for the inconvenience.</p>

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
