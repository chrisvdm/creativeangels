<?php require('inc-public-pre-doctype.php'); ?>
<?php $_SESSION['svSecurity'] = sha1(date('YmdHis')); ?>
<!DOCTYPE HTML>
<html>
<head>

	<!-- HEAD CONTENT -->
	<?php require('inc-public-head-content.php'); ?>

	<title>Creative Angels | CMS Sign in</title>
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

					<h1>CMS Sign in</h1>
					<p>&nbsp</p>

					<!-- If valfailed has been sent via GET method and is also equal to '1', display error message to user. -->
					<?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === '1') { ?>

						<div class="warning_msg" >Please enter a valid username and password. <br><br></div>

					<?php } ?>

					<?php if (isset($_GET['kmatch']) && $_GET['kmatch'] === '0') { ?>

						<div class="warning_msg" >Signin failed. The username and password did not match. Please try again <br><br></div>

					<?php } ?>

					<form action="cms-signin-process.php" method="post">

						<label>
							Email address <br><br>
							<input type="email" name="txtEmail">
						</label>

						<br><br>

						<label>
							Password<br><br>
							<input type="password" name="txtPassword">
						</label>

						<br>
						<a href="cms-pw-lost.php">Forgot your password?</a>

							<br><br>

							<input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

						<button>Sign in</button>

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
