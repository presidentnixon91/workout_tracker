<?php 
	include('includes/php-global.php');
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Plan Workout";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Plan Workout<?php print $SITE_TITLE;?></title>
</head>
<body id="plan-workout">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-plan-workout">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Plan Workout</h1>
					<?php 
						// Update values if form submitted
						$formSubmitted = false;

						if(isset($_POST['submit'])) {
							$formSubmitted = true;
						}

						// Check if a new superset was submitted
						$newSuperset = false;
						if(isset($_POST['newSuperset'])) {
							if(isset($_POST['superset'])) {
								$newSuperset = true;
								$formSubmitted = true;
								$_SESSION["ssGroups"]++;
							}
						}

						// Set current number of exercises
						if(!isset($_SESSION["currentEx"])) {
							$_SESSION["currentEx"] = 0;
						}
						// Set the group of supersets
						$Superset = false;
						if(!isset($_SESSION["ssGroups"])) {
							$_SESSION["ssGroups"] = 0;
						}
						// Set current number of supersets
						if(!isset($_SESSION["currentSS"])) {
							$_SESSION["currentSS"] = 0;
						}

						// Clear workout if no exercises remaining
						$exercisesPlanned = false;
						$sqlWorkoutPlan = "SELECT * FROM $savedTable WHERE SavedName='CURRENT'";
						$resultWorkoutPlan = $conn->query($sqlWorkoutPlan);
						if($resultWorkoutPlan->num_rows > 0) {
							$exercisesPlanned = true;
						}
						if(!$exercisesPlanned) {
							$_SESSION["ssGroups"] = 0;
							$_SESSION["currentSS"] = 0;
							$_SESSION["currentEx"] = 0;
						}	

						if($formSubmitted) {
							// Connect to database
							require('includes/db.php');

							// Increase exercise number
							$_SESSION["currentEx"]++;

							// Set values based on form
							$MuscleGroup = $_POST['musclegroup'];
							$Exercise = $_POST['exercise'];
							if(isset($_POST['superset'])) {
								$Superset = $_POST['superset'];
							}
							// Set name as current
							$SavedName = "CURRENT";
							// Set exercise number
							$exNumber = $_SESSION["currentEx"];
							// Before increase, set ssOrder
							$ssOrder = $_SESSION["currentSS"];
							$ssGroup = $_SESSION["ssGroups"];
							// Set superset group and number
							if($Superset) {
								if($ssOrder == 0) {
									$ssGroup++;
									$_SESSION["ssGroups"]++;
								}
								$ssOrder++;
							} else {
								$ssGroup = 0;
								$ssOrder = 0;
							}
							$_SESSION["currentSS"] = $ssOrder;

							// Upload values to saved table
							$stmt = $conn->prepare("insert into $savedTable(SavedName,MuscleGroup,Exercise,exNumber,ssGroup,ssOrder)
							values(?, ?, ?, ?, ?, ?)");
							$stmt->bind_param("sssiii",$SavedName,$MuscleGroup,$Exercise,$exNumber,$ssGroup,$ssOrder);
							$stmt->execute();
							$stmt->close();
						} else {
							$MuscleGroup = "Back";
						}
					?>
					<div class="widget">
						<h2>Add Exercise</h2>
						<p>Choose what exercises you'll be doing today. This will just pre-load your options when creating a new set but you will still be able to change them. If you just want to skip this and start tracking your workout, click Start Workout.</p>
						<?php 
							echo '<form class="form-md" action="plan-workout" method="post">';
						?>
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
											if($formSubmitted) {
												$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='$MuscleGroup'";
											} else {
												$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Back'";
											}
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													if($formSubmitted) {
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
							<div class="form-group">
								<input type="checkbox" name="superset" <?php if($Superset){echo "checked";}?> id="superset" value="superset"> <label for="superset">Superset</label>
							</div>
							<div class="form-group">
								<div class="float-left mr-2"><input class="btn btn-primary" type="submit" value="Add Exercise" name="submit" /></div>
								<?php if($Superset || $_SESSION["currentSS"] > 0) {
									echo '<div class="float-left"><input type="submit" value="New Superset" name="newSuperset" class="btn btn-outline-secondary" /></div>';
									}
								?>
							</div>
						</form>
					</div>
				</div>
			</div>					
			<?php 
			// Check if there are any exercises planned
			$sqlWorkoutPlan = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' ORDER BY exNumber ASC";
			$resultWorkoutPlan = $conn->query($sqlWorkoutPlan);
			if($resultWorkoutPlan->num_rows > 0) {
				$exercisesPlanned = true;
				$totalPlannedExercises = $resultWorkoutPlan->num_rows;
			} else {
				$exercisesPlanned = false;
			}
			if($exercisesPlanned) {

			// WORKOUT PLAN

			?>
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<h2>Workout Plan:</h2>
						<?php 
							// Was workout cleared
							$workoutCleared = false;
							if(isset($_REQUEST["workoutCleared"])) {
								$setDeleted = $_REQUEST["workoutCleared"];
							}
							if($workoutCleared) {
								echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Workout cleared</div>';
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
							// Is the name CURRENT
							$nameCurrent = false;
							if(isset($_REQUEST["nameCurrent"])) {
								$setDeleted = $_REQUEST["nameCurrent"];
							}
							if($nameCurrent) {
								echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Workout name cannot be CURRENT.</div>';
							}
						?>
						<table class='table table-responsive-xs'>
							<tr>
								<th class='thead-light'>Exercise</th>
								<th class='thead-light activity-icon-cell'>Edit</th>
								<th class='thead-light activity-icon-cell'>Delete</th>
							</tr>
						<?php 
							while($rowPlannedWorkout = $resultWorkoutPlan->fetch_assoc()) {
								echo '<tr class="ss-' . $rowPlannedWorkout["ssGroup"]. '"><td>' . $rowPlannedWorkout["Exercise"];
								if($rowPlannedWorkout["ssGroup"] > 0) {
									echo '<img class="float-right" height="20px" alt="Superman symbol" title="Superset ' . $rowPlannedWorkout["ssGroup"] . '" src="/images/super-icon.gif" />';
								}
								echo '</td><td class="activity-icon-cell"><a title="Edit" href="update-workout.php?id=' . $rowPlannedWorkout[$savedID] . '&musclegroup=' . $rowPlannedWorkout["MuscleGroup"] . '&exercise=' . $rowPlannedWorkout["Exercise"] . '&returnUrl=plan-workout"><img width="20px" height="20px" src="/images/edit-icon.gif" alt="Pencil" /></a></td><td class="activity-icon-cell"><a title="Delete" href="includes/delete-set-submit.php?id=' . $rowPlannedWorkout[$savedID] . '&returnUrl=plan-workout"><img width="20px" height="20px" src="/images/delete-icon.gif" alt="Trash can" /></a></td></tr>';
							}
						?>
						</table>
						<p>If you want to save this workout, give it a name and click Save.</p>
						<form class="form-md" action="includes/save-workout-submit" method="post">
							<div class="form-group">
								<?php 
									// Display error message if name exists
									$nameExists = false;
									if(isset($_REQUEST['nameExists'])) {
										$nameExists = true;
									}
									if($nameExists) {
										echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only">Error:</span> Name already exists.</div>';
									}
								?>
								<label for="name">Workout Name (max 20 characters)</label>
								<input class="form-control" type="text" placeholder="Name" id="name" name="name" required="True" maxlength="20" />
							</div>
							<div class="form-group">
								<div class="float-left mr-2"><input class="btn btn-primary" id="btn-add-exercise" type="submit" value="Save Workout" name="submit"></input></div>
								<div class="float-left"><a class="btn btn-outline-secondary" href="includes/clear-workout-submit" role="button">Clear Workout</a></div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php 
				}

				// Load Workout form
				$sqlLoadWorkouts = "SELECT DISTINCT SavedName FROM $savedTable WHERE NOT SavedName='CURRENT' ORDER BY SavedName ASC";
				$resultLoadWorkouts = $conn->query($sqlLoadWorkouts);
				if($resultLoadWorkouts->num_rows > 0) {
			?>
				<div class="row">
					<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
						<div class="widget">
							<h2>Load Workout</h2>
							<p>Choose from a previously saved workout. Manage your workouts on the <a href="manage-workouts">Manage Workout</a> page.</p>
							<form class="form-md" action="includes/load-workout-submit" method="post">
								<div class="form-group">
									<!-- Load workouts from DB -->
									<select class="form-control" id="workouts" name="workouts">
									<?php 
										while($rowWorkout = $resultLoadWorkouts->fetch_assoc()) {
											echo '<option value="' . $rowWorkout["SavedName"] . '">' . $rowWorkout["SavedName"] . '</option>';
										}
									?>
									</select>
								</div>
								<div class="form-group">
									<div class="float-left mr-2"><p><input class="btn btn-primary" type="submit" value="Load Workout" name="submit"></p></div>
									<div class="float-left"><a class="btn btn-outline-secondary" href="includes/manage-workouts" role="button">Manage Workouts</a></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			<?php 
				}
			?>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>