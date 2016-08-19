<?php require('inc-public-pre-doctype.php') ?>
<!doctype html>

<html>

<head>

    <!-- HEAD CONTENT -->
	<?php require(PATH . '/includes/inc-public-head-content.php'); ?>

	<title>Creative Angels | template</title>

</head>

<body>

	<!-- PAGE HEADER CONTENT INCLUDING LOGO, WS AND MOBILE NAVBARS -->
	<?php require(PATH . '/includes/inc-public-header-container.php'); ?>

	<div id="wrapper">


        <!-- HEADLINE CONTAINER -->
		<header>

			<h1>Connection failed</h1>

		</header>

		<!-- the main content on the page with the article and the side bar -->
		<div class="row">
			<!-- the story and images -->
			<div class="col-8 leftside">
				<article class="main">
					<h3>
                    Our database servers are currently down. Please try again in a few minutes.
                    </h3>
                    <br>
					<h3>
                    We appologise for the inconvenience.
                    </h3>
				</article> <!-- end of story -->


				<!-- POPULAR STORIES CONTAINER STARTS -->
            	<?php require(PATH . '/includes/inc-public-popular-stories-container.php'); ?>
                <!-- POPULAR STORIES CONTAINER ENDS -->


			</div> <!-- end of left column of page -->


            <!-- RIGHT COLUMN CONTAINER STARTS -->
            <?php require(PATH . '/includes/inc-public-right-column-container.php'); ?>
            <!-- RIGHT COLUMN CONTAINER ENDS -->



		</div> <!-- end of row -->

	</div> <!-- end of wrapper -->

        <!-- PAGE FOOTER CONTAINER STARTS -->
        <?php require(PATH . '/includes/inc-public-footer-container.php'); ?>
        <!-- PAGE FOOTER CONTAINER ENDS -->

</body>

<script src="<?php echo DOMAIN; ?>/jscustom/mobile-hamburger-menu.js"></script>

</html>
