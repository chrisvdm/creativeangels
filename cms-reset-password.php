<?php require('inc-public-pre-doctype.php'); ?>
<?php
$_SESSION['svSecurity'] = sha1(date('YmdHis'));
?>
<?php
// TEST TO CONFIRM THAT A GET ARRAY IS PRESENT ON THIS PAGE
if ($_SERVER['REQUEST_METHOD'] == 'GET'){

	//EXTRACT ONLY THE VALUES FROM THE GET ARRAY AND ASSIGN THEM TO A NEW BASIC ARRAY
	$vqsvalues = array_values($_GET);

	// EXTRACT THE VALUES FROM THE BASIC ARRAY BY REFERING TO THE INDEX POSITIONS AND ASSIGN THE VALUES TO GLOBAL VARIABLES
	if (isset($vqsvalues[0]) && $vqsvalues[0] !== ''){
		$vid = base64_decode($vqsvalues[0]);
	}

	if (isset($vqsvalues[1]) && $vqsvalues[1] !== '') {
		$vemail = base64_decode($vqsvalues[1]);
	}
}
?>
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
				<article id="content_left_article_2">
					<h1>Reset Your Password</h1>
					<p>&nbsp;</p>

					<form method="post" action="cms-reset-password-process.php" onsubmit="return matchpws()">

						<p class="msgwarning" id="pwnomatch"></p>

						<?php if(isset($_GET['kvalidation']) && $_GET['kvalidation'] === 'failed') {?>

							<div class="msgwarning">Please complete both fields</div>
							<br>
						<?php } ?>

						<label>New Password:</label><br>
						<input type="text" name="txtPw1" required autofocus placeholder="New password">
						<p>&nbsp;</p>
						<label>Re-type Password:</label><br>
						<input type="text" name="txtPw2" placeholder="Retype password">
						<p>&nbsp;</p>

						<input type="hidden" name="txtSecurity" value="<?php echo $_SESSION['svSecurity']; ?>">

						<input type="hidden" name="txtId" value="<?php if(isset($vid) && $vid !== '') { echo $vid; } ?>">

							<input type="hidden" name="txtEmail" value="<?php if(isset($vemail) && $vid !== '') { echo $vemail; } ?>">

						<input type="submit" name="btnsubmit" value="Reset password">
					</form>


				</article>

			</section>

			<!-- RIGHT SIDEBAR -->
				<?php require('inc-public-right-sidebar.php'); ?>


		</section>

		<!-- FOOTER -->
		<?php require('inc-public-footer.php'); ?>

		<div class="clear_float"></div>

	</section>

	<script>
	// Client-side validation
	function matchpws(){

		var password1 = document.getElementsByName('txtPw1')[0].value;
		var password2 = document.getElementsByName('txtPw2')[0].value;

		if(password1 !== password2){

			document.getElementById('pwnomatch').innerHTML = "Passwords do not match";
			document.getElementsByName('txtPw2')[0].value = "";

			return false;

		} else {

			document.getElementById('pwnomatch').innerHTML = "";

			return true;
		}

	}
	</script>

</body>
</html>
