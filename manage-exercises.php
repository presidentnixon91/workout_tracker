<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Manage Exercises";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Manage Exercises<?php print $SITE_TITLE;?></title>
</head>
<body id="manage-exercises">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-manage-exercises">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Manage Exercises</h1>
					<?php 
						$exerciseAdded = false;
						if(isset($_REQUEST['exerciseAdded'])) {
							$exerciseAdded = true;
						}
						$exerciseUpdated = false;
						if(isset($_REQUEST['exerciseUpdated'])) {
							$exerciseUpdated = true;
						}
						$exerciseDeleted = false;
						if(isset($_REQUEST['exerciseDeleted'])) {
							$exerciseDeleted = true;
						}

						// Alert users if a new exercise was added
						if($exerciseAdded) {
							echo '<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> New Exercise added</div>';
						}
						// Alert users if a new exercise was updated
						if($exerciseUpdated) {
							echo '<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Exercise updated</div>';
						}
						// Alert users if a new exercise was deleted
						if($exerciseDeleted) {
							echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Exercise deleted</div>';
						}
					?>
					<div class="widget">
						<h3>Add Exercise</h3>
						<form class="form-md" action="includes/manage-exercises-submit" method="post">
							<div class="form-group">
								<label for="musclegroup">Muscle Group</label>
								<!-- Set muscle group -->
								<select class="form-control" id="musclegroup" name="musclegroup">
									<option value="Back">Back</option>
									<option value="Legs">Legs</option>
									<option value="Chest">Chest</option>
									<option value="Shoulders">Shoulders</option>
									<option value="Arms">Arms</option>
									<option value="Core">Core</option>
									<option value="Full Body">Full Body</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exercise">Exercise</label>
								<input class="form-control" type="text" placeholder="Enter exercise name" id="exercise" name="exercise" required="True" />
							</div>
							<div class="form-group">
								<label for="exercise-video">Exercise Video (optional)</label>
								<p><small>Enter in a YouTube link to attach to the exercise to watch i.e. https://www.youtube.com/watch?v=op9kVnSso6Q.</small></p>
								<input class="form-control" type="text" placeholder="Enter YouTube link" id="exercise-video" name="exercise-video" />
							</div>
							<div class="form-group">
								<input class="btn btn-success" id="btn-add-exercise" type="submit" value="Add Exercise" name="submit"></input>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<h3>Currently available exercises</h3>
						<p>Change the name of existing exercises or delete any. This will not affect your already submitted workout activity.</p>
						<?php 
						require('includes/db.php');
						$datatable = $recordsTable;

						// Pull all exercises from records
						$sql = "SELECT * FROM $datatable ORDER BY MuscleGroup, Exercise";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							echo "<table class='table table-responsive-sm table-striped'>";
							echo "<tr><th class='thead-light'>Muscle Group</th><th class='thead-light'>Exercise</th><th class='thead-light'>Edit</th><th class='thead-light'>Delete</th></tr>";
							while($row = $result->fetch_assoc()) {
								$MuscleGroup = $row["MuscleGroup"];
								$Exercise = $row["Exercise"];
								$ID = $row[$recordsID];

								/* Build table with Data */
								echo "<tr><td>" . $MuscleGroup . "</td><td>" . $Exercise . "</td><td class='activity-icon-cell'><a title='Edit' href='update-exercise?id=" . $ID . "'><img width='20px' height='20px' src='/images/edit-icon.gif' alt='Pencil' /></a></td><td class='activity-icon-cell'><a title='Delete' href='includes/delete-exercise-submit?id=" . $ID . "'><img width='20px' height='20px' src='/images/delete-icon.gif' alt='Pencil' /></a></td></tr>";
							}
							echo "</table>";
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