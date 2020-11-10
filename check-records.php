<?php 
	include("includes/php-global.php");
	$CURRENT_PAGE = "Check Records";
	$returnUrl = "check-records";
	include("includes/php-auth.php");
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Check Workout Records<?php print $SITE_TITLE;?></title>
</head>
<body id="check-records">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-check-records">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<div class="widget">
						<h2>Check Records</h2>
						<p>Choose an exercise to check your workout records. These are automatically updated based on what your highest weight has been recorded for the amount of reps. These get recorded at 12, 8, 6, 5, 4, 3, 2 and 1 reps. Based on these numbers, it will also use them to calculate what your percentages might be including 101%.</p>
						<form class="form-md" action="" method="post">
							<div class="form-group">
								<div class="form-row">
									<select class="form-control" id="exercise-check" name="exercise-check">
										<?php 
											// Connect to database
											require('includes/db.php');

											// Check if exercise was just checked
											$formSubmitted = false;
											if(isset($_POST['submit'])) {
											   $formSubmitted = true;
											}
											if($formSubmitted) {
												// Set exercise based on form
												$Exercise = $_POST['exercise-check'];
											}
											// Find values for exercise field
											$sql = "SELECT DISTINCT Exercise FROM $recordsTable ORDER BY Exercise ASC";
											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													if($row["Exercise"] == $Exercise){
														echo '<option value="' . $row["Exercise"] . '" selected >' . $row["Exercise"] . '</option>';
													} else {
														echo '<option value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
													}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="form-row">
									<input class="btn btn-primary" id="btn-check-records" type="submit" value="Check Records" name="submit"></input>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php 
				if($formSubmitted) {
					include("includes/check-records-submit.php");
				}
			?>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>