<?php 
	include("includes/php-global.php");
	$CURRENT_PAGE = "Logout";

	$_SESSION['userLoggedIn'] = false;
	unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Logout<?php print $SITE_TITLE;?></title>
</head>
<body id="logout">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<?php 
							if($_SESSION['userLoggedIn'] == false) {
								echo '<h1>You are now logged out.</h1><br />
								<p class="link"><a href="login">Click here to log back in.</p>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>