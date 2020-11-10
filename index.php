<?php 
	include('includes/php-global.php');
	$CURRENT_PAGE = "Home";

	// Send user to public facing home if not logged in
	if(!isset($_SESSION['username'])) {
		header("Location: home-public");
		exit();
	}
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
							<?php 
								if((!$_SESSION['WorkoutStarted']) && (!isset($_SESSION['WorkoutBegins']))) {
									echo '<div class="float-left mr-2"><a role="button" href="includes/start-workout-submit" class="btn btn-success">Start Workout</a></div>
										<div class="float-left"><a role="button" href="plan-workout" class="btn btn-primary">Plan Workout</a></div>';
								} else {
									echo '<div class="float-left mr-2"><a role="button" href="new-set" class="btn btn-primary">New Set</a></div>';
									echo '<div><a role="button" href="/includes/end-workout-submit" class="btn btn-secondary">End Workout</a></div>';
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="run-bg" class="widget widget-img widget-hero">
						<div class="widget-content">
							<h2>Activity Log</h2>
							<p>See your previous activity by days that have been logged so far using the tracker. Allows you to click through to see the full workout as a table.</p>
							<p><a role="button" href="activity" class="btn btn-light">Activity Log</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="chin-up-bg" class="widget widget-img widget-hero">
						<div class="widget-content">
							<h2>Check Records</h2>
							<p>Choose an exercise to check your workout records.</p>
							<p><a role="button" href="check-records" class="btn btn-info">Check Records</a></p>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-xl-6 mx-auto margin-b-1">
					<div id="dumbbells-bg" class="widget widget-img widget-hero">
						<div class="widget-content">
							<h2>Manage Exercises</h2>
							<p>Add, edit or delete any exercises available for workouts.</p>
							<p><a role="button" href="manage-exercises" class="btn btn-warning">Manage Exercises</a></p>
						</div>
					</div>
				</div>
			</div>
			<!-- 
			<div class="row">
				<div class="col">
					<p><a role="button" href="" class="btn btn-primary">Manage Exercises</a></p>
					<p><a role="button" href="" class="btn btn-primary">Change Settings</a></p>
					<p><a role="button" href="" class="btn btn-primary">Leave Feedback</a></p>
					<p><a role="button" href="" class="btn btn-primary">Log Out</a></p>
				</div>
			</div> 
			--> 
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>