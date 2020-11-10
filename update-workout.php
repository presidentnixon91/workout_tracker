<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Update Workout";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Update Workout<?php print $SITE_TITLE;?></title>
</head>
<body id="update-workout">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-update-workout">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Update Set</h1>
					<div class="widget">
						<p>Choose a new exercise for your workout plan.</p>
						<?php 
							require('includes/db.php');

							$datatable = $recordsTable;

							// Get ID from activity page
							$id=$_REQUEST['id'];

							// Set return URL
							$returnUrl = "plan-workout";
							if(isset($_REQUEST["returnUrl"])) {
								$returnUrl = $_REQUEST["returnUrl"];
							}

							// Get Muscle Group and Exercise
							$MuscleGroup = $_REQUEST["musclegroup"];
							$Exercise = $_REQUEST["exercise"];
						?>
						<form class="form-md" action="includes/update-set-submit?id=<?php echo $id;?>&workoutPlan&returnUrl=<?php echo $returnUrl;?>" method="post">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="musclegroup">Muscle Group</label>
									<!-- Set muscle group -->
									<select class="form-control" id="musclegroup" name="musclegroup">
										<option value="Back" <?php if($MuscleGroup == "Back") {echo "selected";}?>>Back</option>
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
											$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='$MuscleGroup'";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													if($row["Exercise"] == $Exercise){
														echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '" selected>' . $row["Exercise"] . '</option>';
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
								<input class="btn btn-primary" type="submit" value="Change Exercise" />
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