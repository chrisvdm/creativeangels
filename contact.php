<?php require('inc-public-pre-doctype.php'); ?>
<!DOCTYPE HTML>
<html>
<head>

	<!-- HEAD CONTENT -->
	<?php require('inc-public-head-content.php'); ?>

<script src="js/hamburger-icon-animate.js" charset="utf-8"></script>
	<link rel="stylesheet" href="css/hamburger-icon-animate.css">

	<title>Creative Angels | Contact us</title>
</head>

<body>

	<!-- WRAPPER -->
	<section id="wrapper">

		<!-- HEADER -->
		<?php require('inc-public-header.php'); ?>

		<!-- NAVBAR WIDESCREEN -->
		<?php require('inc-public-navbar-widescreen.php'); ?>

		<!-- NAVBAR MOBILE-->
		<?php require('inc-public-navbar-mobile.php'); ?>

		<!-- CONTENT CONTAINER MAIN-->
		<section id="content_container">

			<!-- CONTENT CONTAINER LEFT -->
			<section id="content_left">

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
				<article id="content_left_article_1">

					<h1>CONTACT US</h1>

				</article>

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
				<article id="content_left_article_2">
					<h1>WRITE TO US</h1>
				</article>

				<article id="content_left_article_3">
					<h1>FIND US</h1>
				</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require('inc-public-right-sidebar.php'); ?>

				<div class="clear_float"></div>

		</section>




		</section>

		<div class="clear_float"></div>

		<!-- FOOTER -->
		<?php require('inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

	<script src="js/jquery.min.js" charset="utf-8"></script>
	<script>
		hamburgerIcon({
			showMenu: function() {
				$('#mobile_nav').slideDown();
			},
			hideMenu: function() {
				$('#mobile_nav').slideUp();
			}
		});

	</script>

	</script>

</body>
</html>
