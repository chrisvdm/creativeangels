<?php require('inc-public-pre-doctype.php'); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE HTML>
<html>
<head>

	<!-- HEAD CONTENT -->
	<?php require(PATH . '/inc-public-head-content.php'); ?>

	<title>Creative Angels | Template</title>
</head>

<body>

	<!-- WRAPPER -->
	<section id="wrapper">

		<!-- HEADER -->
		<?php require(PATH . '/inc-public-header.php'); ?>

		<!-- NAVBAR WIDESCREEN -->
		<?php require(PATH . '/inc-public-navbar-widescreen.php'); ?>

		<!-- NAVBAR MOBILE-->
		<?php require(PATH . '/inc-public-navbar-mobile.php'); ?>

		<!-- CONTENT CONTAINER MAIN-->
		<section id="content_container">

			<!-- CONTENT CONTAINER LEFT -->
			<section id="content_left">

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
				<article id="content_left_article_1">

					<h1>Confirmation</h1>

                    <br>

                    <p>Email successfully sent. Please check your inbox for further instructions.</p>

				</article>
				<article id="content_left_article_2">Content</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require(PATH . '/inc-public-right-sidebar.php'); ?>


		</section>

		<!-- FOOTER -->
		<?php require(PATH . '/inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

</body>
</html>
