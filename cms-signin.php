<?php require('inc-public-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<!DOCTYPE HTML>

<html>

	<head>

		<!-- HEAD CONTENT -->
		<?php require('inc-public-head-content.php'); ?>

		<title>CAFB CMS Signin</title>

	</head>

	<body>
		<!-- WRAPPER -->
		<section id="wrapper">

			<!-- HEADER -->
			<?php require('inc-public-header.php'); ?>

			<!-- Appear only on tablet layout and higher. Replaces mobile nav bar -->
			<!-- NAVBAR TABLET AND  WIDESCREEN -->
			<?php require('inc-public-navbar-widescreen.php'); ?>

			<!-- NAVBAR MOBILE -->
			<?php require('inc-public-navbar-mobile.php'); ?>

			<!-- CONTENT CONATINER MAIN -->
			<section id="content_container">

				<!-- CONTENT CONATAINER LEFT -->
				<section id="content_left">

					<!-- CONTENT CONTAINER LEFT ARTICLE 1 -->
					<article id="content_left_article_1">

						<h1>CMS Login</h1>



						<?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === 'invdet') { ?>

							<div class="warning_msg">Please enter a valid username and password. <br><br></div>

						<?php } ?>

						<?php if (isset($_GET['valfailed']) && $_GET['valfailed'] === 'incdet') { ?>

							<div class="warning_msg">Your login details were incorrect. Please try again. <br><br></div>

						<?php } ?>

						<form action="cms-signin-process.php" method="post">

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

							<a style="font-size: 80%; margin: 5px;" href="cms-pw-lost.php">Forgot your password?</a>

						</form>


					</article>

					<!-- CONTENT CONTAINER LEFT ARTICLE 2 -->
					<article id="content_left_article_2">Content</article>

				</section>

				<!-- RIGHT SIDEBAR-->
				<?php require('inc-public-right-sidebar.php'); ?>

			</section>

			<!-- FOOTER -->
			<?php require('inc-public-footer.php'); ?>

			<div class="clear_float"></div>

		</section>

	</body>

</html>
