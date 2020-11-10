<?php 
	include('includes/php-global.php');
	$CURRENT_PAGE = "Home";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Workout Tracker<?php print $SITE_TITLE;?></title>
</head>
<body id="home">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="enter-workout">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="deadlift-bg" class="widget widget-img widget-hero">
						<div class="widget-content">
							<h2>Workout Tracker</h2>
							<p>This is a basic workout tracker aimed at those that just want to easily keep record of their workouts, understand when they beat their records and have access to performance graphs.</p>
							<div class="float-left mr-2"><a role="button" href="login" class="btn btn-success">Login</a></div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="run-bg" class="widget widget-img widget-hero">
						<div class="widget-content">
							<h2>Register</h2>
							<p>Creating an account is easy and free. Just enter in a simple username and password and you'll be able to track your workouts and customise your exercises.</p>
							<div class="float-left"><a role="button" href="register" class="btn btn-primary">Register</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div class="widget margin-b-1">
						<div class="widget-content">
							<h2>Record your sets</h2>
							<p>Easily enter in your sets as you go. Choose your exercise and then enter in your weight and how many reps completed.</p>
							<p>Percentages will be automatically calculated and the tool will let you know when you beat your record for highest weight for those amount of reps.</p>
						</div>
					</div>
					<div class="widget margin-b-1">
						<div class="widget-content">
							<h2>Activity log</h2>
							<p>Go through your past results and check what you entered in the activity log.</p>
							<p>All your data will be saved here for future reference.</p>
						</div>
					</div>
					<div class="widget margin-b-1">
						<div class="widget-content">
							<h2>Plan your workout</h2>
							<p>Create a plan for your workout by choosing which exercises you're going to do. This will pre-load the exercise when you're adding your sets. If you're doing supersets, just by hitting 'Submit' you'll be taken to the next exercise in your superset.</p>
							<p>You can then save these workouts and load them up later for quick access.</p>
						</div>
					</div>
					<div class="widget margin-b-1">
						<div class="widget-content">
							<h2>Check your records</h2>
							<p>Load up any exercise to check what your current records are set at. Also view the estimated percentages that you can work to accomplish based on how heavy your weights are by the amount of reps.</p>
						</div>
					</div>
					<div class="widget margin-b-1">
						<div class="widget-content">
							<h2>Manage Exercises</h2>
							<p>Once you've created an account, you'll have access to be able to add, edit or delete any exercises available. This means you'll be able to have a customised database of exercises that make sense and are relevant to you.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="screenshotSlider" class="carousel slide" data-ride="carousel">
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="/images/screenshot-new-set.png" alt="Screenshot of adding a new set">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="/images/screenshot-activity-log.png" alt="Screenshot of the activity log of workouts">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="/images/screenshot-plan-workout.png" alt="Screenshot of planning your workout">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="/images/screenshot-check-records.png" alt="Screenshot of form for checking your weight records">
					    </div>
					    <div class="carousel-item">
					      <img class="d-block w-100" src="/images/screenshot-manage-exercises.png" alt="Screenshot of the page for managing avaiable exercises">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#screenshotSlider" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#screenshotSlider" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>