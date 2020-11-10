<?php 
	include('includes/php-global.php');
	include("includes/php-auth.php");
	$CURRENT_PAGE = "New Set";
	$returnUrl = "new-set";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>New Set<?php print $SITE_TITLE;?></title>
</head>
<body id="new-set">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-new-set">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<?php 
						// Update values if form submitted
						$formSubmitted = false;

						// Set defaults to be overwritten
						$newMax = false;
						$MuscleGroup = "Back";
						$WeightType = "kg";

						if(isset($_POST['submit'])) {
							$formSubmitted = true;
						}
						if($formSubmitted) {
							include("includes/new-set-submit.php");
						}

						// Connect to database
						require('includes/db.php');

						// Check if there are any exercises planned
						$sqlWorkoutPlan = "SELECT * FROM $savedTable WHERE SavedName='CURRENT'";
						$resultWorkoutPlan = $conn->query($sqlWorkoutPlan);
						if($resultWorkoutPlan->num_rows > 0) {
							$exercisesPlanned = true;
							$totalPlannedExercises = $resultWorkoutPlan->num_rows;
						} else {
							$exercisesPlanned = false;
						}
						// Is this part of a superset?
						$Superset = false;

						// Get exercise from workout plan
						if($exercisesPlanned) {
							$sqlCurrentEx = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' AND exNumber='1'";
							$resultCurrentEx = $conn->query($sqlCurrentEx);
							if($resultCurrentEx->num_rows > 0) {
								while($rowCurrentEx = $resultCurrentEx->fetch_assoc()) {
									$Exercise = $rowCurrentEx["Exercise"];
									$MuscleGroup = $rowCurrentEx["MuscleGroup"];
									$ssGroup = $rowCurrentEx["ssGroup"];
									$ssOrder = $rowCurrentEx["ssOrder"];
									if($ssGroup > 0) {
										$Superset = true;
									}
								}
							}
						}

						// Change to next workout if a superset was just submitted
						if($formSubmitted && $Superset) {
							include("includes/next-workout-submit.php");
							// Get exercise from workout plan
							$sqlCurrentEx = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' AND exNumber='1'";
							$resultCurrentEx = $conn->query($sqlCurrentEx);
							if($resultCurrentEx->num_rows > 0) {
								while($rowCurrentEx = $resultCurrentEx->fetch_assoc()) {
									$Exercise = $rowCurrentEx["Exercise"];
									$MuscleGroup = $rowCurrentEx["MuscleGroup"];
								}
							}
						}

						// Alert users if they set a new record
						if($formSubmitted && $newMax) {
							echo 
								'<div class="alert alert-primary" role="alert"> <span class="glyphicon glyphicon-fire" aria-hidden="true"></span> <b>Beast mode!!</b><br>
								You hit a new personal best for those amount of reps.</div>';
						}

						// Was set deleted
						$setDeleted = false;
						if(isset($_REQUEST["setDeleted"])) {
							$setDeleted = $_REQUEST["setDeleted"];
						}

						if($setDeleted) {
							echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Set removed</div>';
						}

						// Was set updated
						$setUpdated = false;
						if(isset($_REQUEST["setUpdated"])) {
							$setUpdated = $_REQUEST["setUpdated"];
						}

						if($setUpdated) {
							echo '<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Set updated</div>';
						}

					?>
					<div class="widget ss-<?php if($Superset){echo $ssGroup;}?>">
						<h3>Enter in your set:</h3>
						<form class="form-md" action="" method="post">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="musclegroup">Muscle Group</label>
									<!-- Set muscle group -->
									<select class="form-control" id="musclegroup" name="musclegroup">
										<option value="Back">Back</option>
										<option value="Legs" <?php if($MuscleGroup == "Legs") {echo "selected";}?>>Legs</option>
										<option value="Chest" <?php if($MuscleGroup == "Chest") {echo "selected";}?>>Chest</option>
										<option value="Shoulders" <?php if($MuscleGroup == "Shoulders") {echo "selected";}?>>Shoulders</option>
										<option value="Arms" <?php if($MuscleGroup == "Arms") {echo "selected";}?>>Arms</option>
										<option value="Core" <?php if($MuscleGroup == "Core") {echo "selected";}?>>Core</option>
										<option value="Full Body" <?php if($MuscleGroup == "Full Body") {echo "selected";}?>>Full Body</option>
									</select>
								</div>
								<div class="form-group col-sm-6">
									<label for="exercise">Exercise</label>
									<!-- Set exercise -->
									<select class="form-control exercise-selection" id="exercise" name="exercise">
										<?php 
											require('includes/db.php');
											if($formSubmitted || $exercisesPlanned) {
												$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='$MuscleGroup'";
											} else {
												$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Back'";
											}
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													if($formSubmitted || $exercisesPlanned) {
														if($row["Exercise"] == $Exercise){
															echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '" selected>' . $row["Exercise"] . '</option>';
														} else {
															echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
														}
													} else {
														echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
													}
												}
											}
										?>
									</select>
									<?php include("includes/exercise-options.php");?>
	 							</div>
							</div>
							<div class="form-row">
								<!-- Set reps -->
								<div class="form-group col-sm-6 col-md-4">
									<label for="reps">Reps</label>
									<input class="form-control" placeholder="Reps" type="number" id="reps" name="reps" required="True" />
								</div>
								<!-- Set weight -->
								<div class="form-group col-sm-6 col-md-4">
									<label for="weight">Weight</label>
									<input class="form-control" step="0.01" placeholder="Weight" type="number" id="weight" name="weight" required="True" />
								</div>
								<?php
									// Get weight type from most recent submission
								if(isset($Exercise)) {
									$sqlGetWeightType = "SELECT * FROM $workoutTable WHERE Exercise='$Exercise' ORDER BY $workoutsID DESC LIMIT 1";
									$resultGetWeightType = $conn->query($sqlGetWeightType);
									if ($resultGetWeightType->num_rows > 0) {
										while($rowWeightType = $resultGetWeightType->fetch_assoc()) {
											$WeightType = $rowWeightType["WeightType"];
										}
									}
								}
								?>
								<div class="form-group col-md-4">
									<!-- Set weight type -->
									<label for="weighttype">Weight Type</label>
									<select class="form-control" id="weighttype" name="weighttype">
										<option value="kg" <?php if($WeightType == "kg") {echo "selected";}?>>Kg</option>
										<option value="lbs" <?php if($WeightType == "lbs") {echo "selected";}?>>Lbs</option>
										<option value="plate" <?php if($WeightType == "plate") {echo "selected";}?>>Plates</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="float-left mr-2"><input class="btn btn-primary" type="submit" name="submit" /></div>
			<?php
				// Anything submitted today
				$TodayDate = date("Y-m-d");
				$date = date("Y-m-d",strtotime($TodayDate));

				$sqlGetWorkout = "SELECT * FROM $workoutTable WHERE Date='$date' ORDER BY $workoutsID DESC";
				$resultWorkout = $conn->query($sqlGetWorkout);
				$showActivityLog = false;
				if ($resultWorkout->num_rows > 0) {
					$showActivityLog = true;
				}
				if($showActivityLog) {
			?>					
								<div class="float-left"><a role="button" class="btn btn-secondary" href="includes/same-set-submit.php">Same again</a></div>
			<?php 
				}
			?>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php

				// SHOW LAST SET
				$sqlGetLatestWorkout = "SELECT * FROM $workoutTable WHERE Date='$date' ORDER BY $workoutsID DESC LIMIT 1";
				$resultLatestWorkout = $conn->query($sqlGetLatestWorkout);
				if($showActivityLog) {
					echo '<div class="row">
					<div class="col-lg-9 col-xl-8 mx-auto margin-b-1"><div class="widget">';
					echo '<h3>Latest set submitted</h3><ul>';
					// Get the elapsed time since start of workout
					if(empty($_SESSION["StartTime"])) {
						$_SESSION["StartTime"] = microtime(true);
					}
					$CurrentTime = microtime(true);
					$ElapsedTime = $CurrentTime - $_SESSION["StartTime"];
					function secondsToTime($s) {
					    $h = floor($s / 3600);
					    $s -= $h * 3600;
					    $m = floor($s / 60);
					    $s -= $m * 60;
					    return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
					}
					while($rowWorkout = $resultLatestWorkout->fetch_assoc()) {
						echo '<li>Exercise: '. $rowWorkout["Exercise"] .'</li>
						<li>Set: '. $rowWorkout["SetNumber"] .'</li>
						<li>Reps: '. $rowWorkout["Reps"] .'</li>
						<li>Weight: '. $rowWorkout["Weight"] .' '. $rowWorkout["WeightType"] . '</li>';
					}
					// Calculate total number of sets
					$sql = "SELECT COUNT(SetNumber) FROM $workoutTable WHERE Date='$date'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						$TotalSets = max($result->fetch_assoc());
					} else {
						$TotalSets = 0;
					}
					$_SESSION["WorkoutSets"] = $TotalSets;
					echo '</ul><p>Total sets: '. $TotalSets .'<br>
					Time Elapsed: '. secondsToTime($ElapsedTime) .'</p>
					</div></div></div>';
				}

				if(empty($Exercise)) {
					$Exercise = "Bent Over Barbell Rows";
				}
				include("includes/check-records-submit.php");
				
				// TODAYS WORKOUT
				
				if($formSubmitted || $exercisesPlanned || $showActivityLog) {
					// Start row
					echo '<div class="row">
					<div class="col-lg-9 col-xl-8 mx-auto">';
				}
				if($showActivityLog) {
			?>
			
					<!-- Build results able to be toggled open -->
					<div class="toggle-cards card activity-card today-workout">
						<a data-toggle="collapse" href="#todayWorkout" role="button" aria-expanded="false" aria-controls="todayWorkout"><div class="card-header">Activity Log</div></a>
						<div class="collapse multi-collapse" id="todayWorkout">
							<!-- Build table of day's workout -->
							<?php 

								echo "<table class='table table-responsive-sm'><tr><th class='thead-light'>Exercise</th><th class='thead-light'>Set</th><th class='thead-light'>Reps</th><th class='thead-light'>Weight</th><th class='thead-light activity-icon-cell'>Edit</th><th class='thead-light activity-icon-cell'>Delete</th></tr>";
								while($rowWorkout = $resultWorkout->fetch_assoc()) {
									$exercise = $rowWorkout["Exercise"];
									$setNumber = $rowWorkout["SetNumber"];
									$reps = $rowWorkout["Reps"];
									$weight = $rowWorkout["Weight"];
									$weightType = $rowWorkout["WeightType"];
									/* Build table with Data */
									echo "<tr><td>" . $exercise . "</td><td>" . $setNumber . "</td><td>" . $reps . "</td><td>" . $weight . " " . $weightType . "</td><td class='activity-icon-cell'><a title='Edit' href='update-set.php?id=" . $rowWorkout[$workoutsID] . "&returnUrl=new-set'><img width='20px' height='20px' src='/images/edit-icon.gif' alt='Pencil' /></a></td><td class='activity-icon-cell'><a title='Delete' href='includes/delete-set-submit.php?id=" . $rowWorkout[$workoutsID] . "&returnUrl=new-set'><img width='20px' height='20px' src='/images/delete-icon.gif' alt='Pencil' /></a></td></tr>";
								}
								echo "</table>";
							?>
						</div>
					</div>
					<?php
				}
						if($exercisesPlanned) {

						// WORKOUT PLAN
					?>
							<div class="toggle-cards card activity-card workout-plan">
								<a data-toggle="collapse" href="#workoutPlan" role="button" aria-expanded="false" aria-controls="workoutPlan"><div class="card-header">Workout plan</div></a>
								<div class="collapse multi-collapse" id="workoutPlan">
									<table class='table table-responsive-xs'>
										<tr>
											<th class='thead-light'>Exercise</th>
											<th class='thead-light activity-icon-cell'>Edit</th>
										</tr>
									<?php 
										$sqlWorkoutPlan = "SELECT * FROM $savedTable WHERE SavedName='CURRENT'";
										$resultWorkoutPlan = $conn->query($sqlWorkoutPlan);
										if($resultWorkoutPlan->num_rows > 0) {
											while($rowPlannedWorkout = $resultWorkoutPlan->fetch_assoc()) {
												echo '<tr class="ss-' . $rowPlannedWorkout["ssGroup"]. '"><td>' . $rowPlannedWorkout["Exercise"];
												if($rowPlannedWorkout["ssGroup"] > 0) {
													echo '<img class="float-right" height="20px" alt="Superman symbol" title="Superset ' . $rowPlannedWorkout["ssGroup"] . '" src="/images/super-icon.gif" />';
												}
												echo '</td><td class="activity-icon-cell"><a title="Edit" href="update-workout.php?id=' . $rowPlannedWorkout[$savedID] . '&returnUrl=new-set"><img width="20px" height="20px" src="/images/edit-icon.gif" alt="Pencil" /></a></td></tr>';
											}
										}
									?>
									</table>
								</div>
							</div>
					<?php
						}
					// Check for  YouTube video
					$showVideo = false;
					$YouTubeLink = $recordsRow["YouTubeLink"];
					if(isset($YouTubeLink)) {
						$showVideo = true;
					}

					if($showVideo) {
						// Strip out YouTube link to get just code
						$YTCode = str_replace("watch?v=", "embed/", $YouTubeLink);
					?>
						<div class="toggle-cards card activity-card workout-video">
							<a data-toggle="collapse" href="#workoutVideo" role="button" aria-expanded="false" aria-controls="workoutVideo"><div class="card-header">Workout video</div></a>
							<div class="collapse multi-collapse" id="workoutVideo">
								<iframe id="ytplayer" type="text/html" width="100%" height="405" src="<?php echo $YTCode;?>?controls=1&playsinline=1" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					<?php 
					}

				if($formSubmitted || $exercisesPlanned || $showActivityLog) {
					// End row
					echo '</div>
					</div>';
				}
					?>
		</div>
	</div>
	<?php 
		if($formSubmitted) {
			echo '<script>
				window.onload = function() {
				  var input = document.getElementById("reps").focus();
				}
			</script>';
		}

	include("includes/footer.php");
	?>

</body>
</html>