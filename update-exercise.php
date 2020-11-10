<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Update Exercise";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Update Exercise<?php print $SITE_TITLE;?></title>
</head>
<body id="update-exercise">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-update-exercise">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<h3>Update Set</h3>
						<?php 
							require('includes/db.php');

							$datatable = $recordsTable;
							// Get ID from activity page
							$id=$_REQUEST['id'];

							// Find and set all values based on ID
							$sql="SELECT * FROM $datatable WHERE $recordsID=$id";
							$result = $conn->query($sql);
							// Use ID to get values for the other fields
							$row = $result->fetch_assoc();
							$MuscleGroup = $row["MuscleGroup"];
							$Exercise = $row["Exercise"];
						?>
						<form class="form-md" action="/includes/update-exercise-submit?id=<?php echo $id;?>" method="post">
							<div class="form-group">
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
							<div class="form-group">
								<label for="exercise">Exercise</label>
								<input class="form-control" type="text" value="<?php echo $Exercise;?>" id="exercise" name="exercise" required="True" />
							</div>
							<div class="form-group">
								<label for="exercise-video">Exercise Video (optional)</label>
								<p><small>Enter in a YouTube link to attach to the exercise to watch i.e. https://www.youtube.com/watch?v=op9kVnSso6Q.</small></p>
								<input class="form-control" type="text" placeholder="Enter YouTube link" id="exercise-video" name="exercise-video" />
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