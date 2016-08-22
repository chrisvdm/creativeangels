<?php require('inc-public-pre-doctype.php'); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE html>
<html>
  <head>

    <!--==================== HEAD CONTENTS ======================-->
    <?php require( PATH . '/inc-public-head-content.php'); ?>
    <title>Creative Angels | Email confirmation</title>

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
          <article>
            <h2>Confirmation</h2>
            <p>Email successfully sent. Please check your inbox for further instructions.</p>
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
