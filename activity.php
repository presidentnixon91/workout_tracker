<?php 
	include("includes/php-global.php");
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Activity";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Activity Log<?php print $SITE_TITLE;?></title>
</head>
<body id="activity">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-activity">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<h1>Activity Log</h1>
					<?php 
						require('includes/db.php');

						// Display message if set was just deleted
						$setDeleted = false;
						if(isset($_REQUEST['setDeleted'])) {
						   $setDeleted = true;
						   echo '<div class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Set removed</div>';
						}
						// Display message if set was just updated
						$setUpdated = false;
						if(isset($_REQUEST['setUpdated'])) {
						   $setUpdated = true;
						   echo '<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Set updated</div>';
						}

						$datatable = $workoutTable;
						$resultsPerPage = 7; // number of results per page
						
						// Create pagination of results
						if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
						$startFrom = ($page-1) * $resultsPerPage;
						$sqlGetPagedDates = "SELECT DISTINCT Date FROM ".$datatable." ORDER BY Date DESC LIMIT $startFrom, ".$resultsPerPage;

						// Get distinct date results
						$dateResults = $conn->query($sqlGetPagedDates);
						
					?>
					<!-- Build results able to be toggled open -->
					<div id="accordionPlatform">
						<div class="accordion" id="togglePlatform">
						<?php 
							 while($row = $dateResults->fetch_assoc()) {
							 	// Set date
								$date = $row["Date"];
								$dateFormatted = date('j-m-y', strtotime($date));
								
							 	// Get the day
								$dateDay = date('D', strtotime($date));
						?> 
									<div class="card activity-card">
										<a class="toggle-link collapsed" data-toggle="collapse" href="#date-<?php echo $date?>" aria-expanded="false" aria-controls="date-<?php echo $date?>">
											<?php 
												echo '<div class="card-header">' . $dateDay . ' - <span class="activity-exercises">';
												// Find and show all the muscle groups that were trained that day
												$sqlGetMuscleGroup = "SELECT DISTINCT MuscleGroup FROM ".$datatable." WHERE Date='$date'";
												$resultMuscleGroup = $conn->query($sqlGetMuscleGroup);
												while($rowMuscleGroup = $resultMuscleGroup->fetch_assoc()) {
													echo $rowMuscleGroup["MuscleGroup"];
													echo '<span class="mg-comma">, </span>';
												}
												echo '</span><span class="activity-date">' . $dateFormatted . '</span></div>';
											?>
										</a>
										<!-- Build table of day's workout -->
										<?php 
											$sqlGetWorkout = "SELECT * FROM ".$datatable." WHERE Date='$date'";
											$resultWorkout = $conn->query($sqlGetWorkout);
											if ($resultWorkout->num_rows > 0) {
												echo "<table id='date-" . $date . "'";
												echo "class='table table-responsive-sm collapse multi-collapse'><tr><th class='thead-light'>Exercise</th><th class='thead-light'>Set</th><th class='thead-light'>Reps</th><th class='thead-light'>Weight</th><th class='thead-light activity-icon-cell'>Edit</th><th class='thead-light activity-icon-cell'>Delete</th></tr>";
												while($rowWorkout = $resultWorkout->fetch_assoc()) {
													$exercise = $rowWorkout["Exercise"];
													$setNumber = $rowWorkout["SetNumber"];
													$reps = $rowWorkout["Reps"];
													$weight = $rowWorkout["Weight"];
													$weightType = $rowWorkout["WeightType"];
													/* Build table with Data */
													echo "<tr><td>" . $exercise . "</td><td>" . $setNumber . "</td><td>" . $reps . "</td><td>" . $weight . " " . $weightType . "</td><td class='activity-icon-cell'><a title='Edit' href='update-set.php?id=" . $rowWorkout[$workoutsID] . "'><img width='20px' height='20px' src='/images/edit-icon.gif' alt='Pencil' /></a></td><td class='activity-icon-cell'><a title='Delete' href='includes/delete-set-submit.php?id=" . $rowWorkout[$workoutsID] . "'><img width='20px' height='20px' src='/images/delete-icon.gif' alt='Pencil' /></a></td></tr>";
												}
												echo "</table>";
											}
										?>
									</div>
						<?php
							}
						?> 
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto margin-b-1">
					<?php 
							$sqlGetTotalDates = "SELECT DISTINCT Date FROM ".$datatable;
							$totalDateResults = $conn->query($sqlGetTotalDates);
							$totalDateRows = $totalDateResults->num_rows;
							$totalPages = ceil($totalDateRows / $resultsPerPage);

							// Add container and previous button
							if($totalDateRows > 0) {
								echo '<div class="paginating-container pagination-solid">
    								<ul class="pagination">';
    							if($page == 1) {
									echo '<li class="prev"><a class="disabled">Prev</a></li>';
								} else {
									$p = $page - 1;
									echo '<li class="prev"><a href="activity.php?page='.$p.'">Prev</a></li>';
								}
							}

							// Create links to other pages
							for ($i=1; $i<=$totalPages; $i++) {
								if($page == $i) {
									echo "<li class='active'><a class='disabled'>".$i." </a></li>";
								} else {
							    	echo "<li><a href='activity.php?page=".$i."'>".$i." </a></li>";
							    }
							}

							// Add next button and end container
							if($totalDateRows > 0) {
								if($page == $totalPages) {
									echo '<li class="next"><a class="disabled">Next</a></li>';
								} else {
							    	$n = $i + 1;
							    	echo '<li class="next"><a href="activity.php?page='.$n.'">Next</a></li>';
							    }
								echo "</ul></div>";
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