<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Manage Workouts";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Manage Workouts<?php print $SITE_TITLE;?></title>
</head>
<body id="manage-workouts">

	<?php 
		include("includes/design-top.php");

		// Connect to database
		require('includes/db.php');

		// Check if we are editing/loading workout
		$editWorkout = false;
		if(isset($_POST['edit'])) {
			$editWorkout = true;
		}
		// Check if we are deleting workout
		$deleteWorkout = false;
		if(isset($_POST['delete'])) {
			$deleteWorkout = true;
		}

		$changeName = false;
		$sameName = false;
		$nameExists = false;
		$nameCurrent = false;
		$nameChanged = false;
		$workoutDeleted = false;

		// Set the Load Name if it has one
		if($nameChanged) {
			$LoadName = $newName;
		}
		if($editWorkout || $deleteWorkout) {
			$LoadName = $_POST['workouts'];
		}

		// Delete workout
		if($deleteWorkout) {
			$query = "DELETE FROM $savedTable WHERE SavedName='$LoadName'";
			if($conn->connect_error){
				die("Connection Failed : ". $conn->connect_error);
			}else{
				$deleteResult = mysqli_query($conn,$query);
				$workoutDeleted = true;
			}
		}

		// Check if a change name request was sent
		if(isset($_POST['Submit'])) {
			$changeName = true;
		}
		// Attempt to change the name of the workout
		if($changeName) {
			$newName = $_POST['name'];
			$oldName = $_POST['oldName'];

			if($newName == $oldName) {
				$sameName = true;
			}
			if($newName == 'CURRENT') {
				$nameCurrent = true;
			}
			// Check for new name already existing in database
			$sqlCheckName = "SELECT DISTINCT SavedName FROM $savedTable WHERE SavedName='$newName'";
			$resultCheckName = $conn->query($sqlCheckName);
			if ($resultCheckName->num_rows > 0) {
				$nameExists = true;
			}
			if($sameName == false && $nameCurrent == false && $nameExists == false) {
				if($conn->connect_error){
					die("Connection Failed : ". $conn->connect_error);
				}else{
					$query = "UPDATE $savedTable SET SavedName='$newName' WHERE SavedName='$oldName'";
					$updateChangeName = mysqli_query($conn,$query);
					$nameChanged = true;
				}
			}
		}
	?>

	<div class="main-content" id="content-manage-workouts">
		<div class="container">
			<!-- LOAD OR DELETE WORKOUT FORM -->
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<?php 
						// DISPLAY ALERTS

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

						// Was workout deleted
						if($workoutDeleted) {
							echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Workout deleted</div>';
						}
					?>
					<h1>Manage Workouts</h1>
					<div class="widget">
						<?php 
							$sqlLoadWorkouts = "SELECT DISTINCT SavedName FROM $savedTable WHERE NOT SavedName='CURRENT' ORDER BY SavedName ASC";
							$resultLoadWorkouts = $conn->query($sqlLoadWorkouts);
							if($resultLoadWorkouts->num_rows > 0) {
						?>
								<p>Choose from a previously saved workout.</p>
								<form class="form-md" action="" method="post">
									<div class="form-group">
										<!-- Load workouts from DB -->
										<select class="form-control" id="workouts" name="workouts">
										<?php 
											while($rowWorkout = $resultLoadWorkouts->fetch_assoc()) {
												if($nameChanged || $editWorkout) {
													if($rowWorkout["SavedName"] == $LoadName) {
														echo '<option value="' . $rowWorkout["SavedName"] . '" selected>' . $rowWorkout["SavedName"] . '</option>';
													} else {
														echo '<option value="' . $rowWorkout["SavedName"] . '">' . $rowWorkout["SavedName"] . '</option>';
													}
												} else {
													echo '<option value="' . $rowWorkout["SavedName"] . '">' . $rowWorkout["SavedName"] . '</option>';
												}
											}
										?>
										</select>
									</div>
									<div class="form-group">
										<div class="float-left mr-2"><input class="btn btn-primary" type="submit" value="Load Workout" name="edit"></div>
										<div class="float-left"><input class="btn btn-danger" type="submit" value="Delete Workout" name="delete"></div>
									</div>
								</form>
						<?php 
							}
						?>
					</div>
				</div>
			</div>
			<?php 
				// If we have loaded a workout or tried to change the workout name
				if($editWorkout || $nameChanged) {
					$sqlWorkout = "SELECT * FROM $savedTable WHERE SavedName='$LoadName'";
					$resultWorkout = $conn->query($sqlWorkout);
			?>
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<form class="form-md" action="manage-workouts" method="post">
							<?php 
								// Display error message if name exists
								if($nameExists) {
									echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <span class="sr-only">Error:</span> Name already exists.</div>';
								}
								// Display error if name is CURRENT
								if($nameCurrent) {
									echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Workout name cannot be CURRENT.</div>';
								}
								// Display error if name is the same
								if($sameName) {
									echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No change in name.</div>';
								}
								// Display message if changed
								if($nameChanged) {
									echo '<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Name changed.</div>';
								}
							?>
							<!-- CHANGE NAME FORM -->
							<div class="form-group">
								<input class="form-control" type="hidden" id="oldName" name="oldName" required="True" value="<?php echo $LoadName;?>" maxlength="20" >
								<label for="name">Change Name (max 20 characters)</label>
								<input class="form-control" type="text" id="name" name="name" required="True" value="<?php echo $LoadName;?>" maxlength="20"/>
							</div>
							<div class="form-group">
								<p><input class="btn btn-primary" id="btn-add-exercise" type="submit" value="Submit" name="Submit"></input></p>
							</div>
						</form>
						<!-- WORKOUT PLAN TABLE -->
						<table class='table table-responsive-xs'>
							<tr>
								<th class='thead-light'>Muscle Group</th>
								<th class='thead-light'>Exercise</th>
								<th class='thead-light activity-icon-cell'>Edit</th>
								<th class='thead-light activity-icon-cell'>Delete</th>
							</tr>
						<?php 
							while($rowWorkout = $resultWorkout->fetch_assoc()) {
								echo '<tr class="ss-' . $rowWorkout["ssGroup"]. '"><td>' . $rowWorkout["MuscleGroup"];
								if($rowWorkout["ssGroup"] > 0) {
									echo '<img class="float-right" height="20px" alt="Superman symbol" title="Superset ' . $rowWorkout["ssGroup"] . '" src="/images/super-icon.gif" />';
								}
								echo '</td><td>' . $rowWorkout["Exercise"] . '<td class="activity-icon-cell"><a title="Edit" href="update-workout.php?id=' . $rowWorkout[$savedID] . '&returnUrl=manage-workouts"><img width="20px" height="20px" src="/images/edit-icon.gif" alt="Pencil" /></a></td><td class="activity-icon-cell"><a title="Delete" href="includes/delete-set-submit.php?id=' . $rowWorkout[$savedID] . '&returnUrl=manage-workouts"><img width="20px" height="20px" src="/images/delete-icon.gif" alt="Trash can" /></a></td></tr>';
							}
						?>
						</table>
					</div>
				</div>
			</div>
			<?php 
				}
			?>
		</div>

	<?php include("includes/footer.php");?>

</body>
</html>