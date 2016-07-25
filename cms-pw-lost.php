<?php require('inc-public-pre-doctype.php'); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE HTML>
<html>
<head>

	<!-- HEAD CONTENT -->
	<?php require('inc-public-head-content.php'); ?>

	<title>Creative Angels | Template</title>
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

					<h1>Lost password</h1>

          <form action="cms-pw-lost-process.php" method="post">
            <p>&nbsp;</p>

            <?php if(isset($_GET['kval']) && $_GET['kval'] === 'failed') {?>
            <div class="warning_msg" >Please enter a valid Email<br><br></div>
            <?php } ?>
            <label>
              Please enter your email address<br><br>
              <input type="email" name="txtEmail">
            </label>

            <br><br>

              <input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

            <button>Send</button>

          </form>

				</article>
				<article id="content_left_article_2">Content</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require('inc-public-right-sidebar.php'); ?>


		</section>

		<!-- FOOTER -->
		<?php require('inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

</body>
</html>
