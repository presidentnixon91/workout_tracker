<?php 
	include("includes/php-global.php");
	$CURRENT_PAGE = "Page Not Found";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Page Not Found<?php print $SITE_TITLE;?></title>
</head>
<body id="page-not-found">

	<?php include("includes/design-top.php");?>

	<div class="hero section-blue">
		<div class="container">
			<div class="row">
				<div class="col-xl-8">
					<h2 class="fade-in animation-duration-3">Page Not Found</h2>
					<p class="fade-in animation-duration-4 animation-delay-05">Not sure how you got here but it's time to go <a href="/">Home</a>. Get back to working out!</p>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>