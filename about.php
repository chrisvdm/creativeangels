<?php require('inc-public-pre-doctype.php'); ?>
<?php
// Create SQL statement to fetch all records from tblcontactdetails
$sql_about = "SELECT * FROM tblabout";

//Connect to MYSQL Server
require(PATH . '/inc-conn.php');

//Execute SQL statement
$rs_about = mysqli_query($vconn_creativeangels, $sql_about);

//Create associative Array
$rs_about_rows = mysqli_fetch_assoc($rs_about);

?>
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

					<h1>Mission</h1>

					<p><?php echo nl2br($rs_about_rows['amission']); ?></p>

				</article>

				<article id="content_left_article_2">
					<h1>Description</h1>

					<p><?php echo nl2br($rs_about_rows['adescription']); ?></p>

				</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require(PATH . '/inc-public-right-sidebar.php'); ?>


		</section>

		<!-- FOOTER -->
		<?php require(PATH . '//inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

</body>
</html>
