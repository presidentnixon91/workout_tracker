<script type="text/javascript" src="/js/custom.js"></script>

<?php 
	$footerShow = false;
	$footerFixed = false;

	if ($CURRENT_PAGE == "Plan Workout" || $CURRENT_PAGE == "New Set") {
		$footerShow = true;
		$footerFixed = true;
	}

	if(empty($totalPlannedExercises)) {
		$totalPlannedExercises = 0;
	}

	if($footerShow) { 
		
		// Anything submitted today
		$TodayDate = date("Y-m-d");
		$date = date("Y-m-d",strtotime($TodayDate));

		$activityToday = false;
		$sqlGetWorkout = "SELECT * FROM $workoutTable WHERE Date='$date' ORDER BY $workoutsID DESC";
		$resultWorkout = $conn->query($sqlGetWorkout);
		if ($resultWorkout->num_rows > 0) {
			$activityToday = true;
		}
?>

		<style>
			body {
				padding-bottom: 68px;
			}
		</style>

		<footer<?php if($footerFixed){ echo ' class="footer-fixed"';}?>>
			<div class="container">
				<div class="col-lg-9 col-xl-8 mx-auto">
					<?php 
						if ($CURRENT_PAGE == "Plan Workout") {
							if($_SESSION["WorkoutStarted"] && $activityToday) {
								echo '<div class="float-right"><a role="button" href="new-set" class="btn btn-success">Resume Workout</a></div>';
							} else {
								echo '<div class="float-right"><a role="button" href="includes/start-workout-submit?returnUrl=new-set" class="btn btn-success">Begin Workout</a></div>';
							}
						} elseif ($CURRENT_PAGE == "New Set") {
							// Is this part of a superset?
							echo '<div class="float-left mr-2"><a class="btn btn-outline-secondary" href="includes/end-workout-submit" role="button">End Workout</a></div>';
							if($Superset) {
								echo '<div class="float-right"><a class="btn btn-success" href="includes/end-superset-submit" role="button">Next Workout</a></div>';
							} elseif($totalPlannedExercises > 1) {
								echo '<div class="float-right"><a class="btn btn-success" href="includes/next-workout-submit" role="button">Next Workout</a></div>';
							}
						}
					?>
				</div>
			</div>
		</footer>

<?php
	}
?>