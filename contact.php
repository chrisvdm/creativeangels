<?php require('inc-public-pre-doctype.php'); ?>
<?php

     // Create SQL statement to fetch all records from tblcontactdetails
     $sql_contact_details = "SELECT * FROM tblcontactdetails";

     //Connect to MYSQL Server
     require('inc-conn.php');

     //Execute SQL statement
     $rs_contact_details = mysqli_query($vconn_creativeangels, $sql_contact_details);

     //Create associative Array
     $rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details);

 ?>
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

					<h2>CONTACT US</h2>

					<br>
					<br>

					<p><?php if ($rs_contact_details_rows['cemail'] !== "na") {
						echo $rs_contact_details_rows['cemail'];
					} ?></p>

					<?php do { ?>
						<div class="location">

							<!-- city -->
							<h4><?php echo $rs_contact_details_rows['ccity']; ?></h4>
							<br>
							<br>

							<!-- Contact person -->
							<p><?php echo $rs_contact_details_rows['ccontactpersonname'] . ' ' . $rs_contact_details_rows['ccontactpersonsurname'] . '<br>'; ?></p>
							<br>

							<!-- Landline -->
							<p><?php if ($rs_contact_details_rows['clandline'] !== "na") { echo $rs_contact_details_rows['clandline'] . '<br><br>'; } else { echo ""; } ?></p>

							<!-- Address -->
							<p><?php if ($rs_contact_details_rows['caddress1'] === 'na' || $rs_contact_details_rows['caddress2'] === 'na' || $rs_contact_details_rows['caddress3'] === 'na' || $rs_contact_details_rows['csuburb'] === 'na') {

								echo $rs_contact_details_rows['ccity'];

							} elseif ($rs_contact_details_rows['caddress1'] !== 'na' || $rs_contact_details_rows['caddress2'] !== 'na' || $rs_contact_details_rows['caddress3'] !== 'na' || $rs_contact_details_rows['csuburb'] !== 'na') {
								echo $rs_contact_details_rows['caddress1'] . ', ' . $rs_contact_details_rows['caddress2'] . ', ' . $rs_contact_details_rows['caddress3'] . ', ' . $rs_contact_details_rows['csuburb'] . ', ' . $rs_contact_details_rows['ccity'];
							} ?>
						</p>

					</div>

					<!-- Display details of both durban and cape town details -->
					<?php } while ($rs_contact_details_rows = mysqli_fetch_assoc($rs_contact_details)) ?>

					<!-- Email -->
					<p><?php if ($rs_contact_details_rows['cemail'] !== "na") { echo $rs_contact_details_rows['cemail']; } ?></p>


				</article>

				<!-- CONTENT CONTAINER RIGHT ARTICLE 1 -->
				<article id="content_left_article_2">
					<h1>WRITE TO US</h1>

					<br>
					<br>

					<p><?php if ($rs_contact_details_rows['cemail'] !== "na") { echo $rs_contact_details_rows['cemail']; } ?></p>
				</article>

				<article id="content_left_article_3">
					<h1>FIND US</h1>

					<br>
					<br>
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
