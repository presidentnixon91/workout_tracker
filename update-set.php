<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Update Set";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Update Set<?php print $SITE_TITLE;?></title>
</head>
<body id="update-set">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-update-set">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Update Set</h1>
					<div class="widget">
						
						<?php 
							require('includes/db.php');
							$datatable = $workoutTable;
							// Get ID from activity page
							$id=$_REQUEST['id'];

							// Set return URL
							$returnUrl = "activity";
							if(isset($_REQUEST["returnUrl"])) {
								$returnUrl = $_REQUEST["returnUrl"];
							}

							// Find and set all values based on ID
							$sql="SELECT * FROM $datatable WHERE $workoutsID=$id";
							$result = $conn->query($sql);
							// Use ID to get values for the other fields
							$row = $result->fetch_assoc();
							$MuscleGroupSelection = $row["MuscleGroup"];
							$ExerciseSelection = $row["Exercise"];
							$SetSelection = $row["SetNumber"];
							$RepsSelection = $row["Reps"];
							$WeightSelection = $row["Weight"];
							$WeightTypeSelection = $row["WeightType"];
							// Get date and convert it
							$dateSelection = $row["Date"];
						?>
						<form class="form-md" action="includes/update-set-submit.php?id=<?php echo $id;?>&returnUrl=<?php echo $returnUrl;?>" method="post">
							<div class="form-group">
								<label for="date">Date</label><br />
								<input class="form-control" type="date" id="date" name="date" value="<?php echo $dateSelection;?>" />
							</div>
							<div class="form-group">
								<label for="musclegroup">Muscle Group</label>
								<!-- Set muscle group -->
								<select class="form-control" id="musclegroup" name="musclegroup">
									<option value="Back" <?php if($MuscleGroupSelection == "Back") {echo "selected";}?>>Back</option>
									<option value="Legs" <?php if($MuscleGroupSelection == "Legs") {echo "selected";}?>>Legs</option>
									<option value="Chest" <?php if($MuscleGroupSelection == "Chest") {echo "selected";}?>>Chest</option>
									<option value="Shoulders" <?php if($MuscleGroupSelection == "Shoulders") {echo "selected";}?>>Shoulders</option>
									<option value="Arms" <?php if($MuscleGroupSelection == "Arms") {echo "selected";}?>>Arms</option>
									<option value="Core" <?php if($MuscleGroupSelection == "Core") {echo "selected";}?>>Core</option>
									<option value="Full Body" <?php if($MuscleGroupSelection == "Full Body") {echo "selected";}?>>Full Body</option>
								</select>
							</div>
							<div class="form-group">
								<label for="exercise">Exercise</label>
								<select class="form-control exercise-selection" id="exercise" name="exercise">
									<?php 
										$sqlGetExercise = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='$MuscleGroupSelection'";
										$resultExercise = $conn->query($sqlGetExercise);

										if ($resultExercise->num_rows > 0) {
											while($rowExercise = $resultExercise->fetch_assoc()) {
												if($rowExercise["Exercise"] == $ExerciseSelection){
													echo '<option class="' . $rowExercise["MuscleGroup"] . '" value="' . $rowExercise["Exercise"] . '" selected>' . $rowExercise["Exercise"] . '</option>';
												} else {
													echo '<option class="' . $rowExercise["MuscleGroup"] . '" value="' . $rowExercise["Exercise"] . '">' . $rowExercise["Exercise"] . '</option>';
												}
											}
										}
									?>
								</select>
								<?php include("includes/exercise-options.php");?>
							</div>
							<div class="form-group">
								<div class="form-row">
									<div class="col">
										<label for="set">Set</label>
									</div>
									<div class="col">
										<label for="reps">Reps</label>
									</div>
								</div>
								<div class="form-row">
									<div class="col">
										<input class="form-control" placeholder="Set" type="number" id="set" name="set" required="True" min="1" value=<?php echo $SetSelection;?> />
									</div>
									<div class="col">
										<input class="form-control" placeholder="Reps" type="number" id="reps" name="reps" value="<?php echo $RepsSelection;?>" required="True" />
									</div>
								</div>
							</div>
							<label for="weight">Weight</label>
							<div class="form-group">
								<div class="form-row">
									<div class="col">
										<input class="form-control" step="0.01" placeholder="Weight" type="number" id="weight" name="weight" value="<?php echo $WeightSelection;?>" required="True" />
									</div>
									<div class="col">
										<select class="form-control" id="weighttype" name="weighttype">
											<option value="kg" <?php if($WeightTypeSelection == "kg") {echo "selected";}?>>Kgs</option>
											<option value="lbs" <?php if($WeightTypeSelection == "lbs") {echo "selected";}?>>Lbs</option>
											<option value="plate" <?php if($WeightTypeSelection == "plate") {echo "selected";}?>>Plates</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input class="btn btn-primary" type="submit" value="Update" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>