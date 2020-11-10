<?php 
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
				<div class="col-1"></div>
				<div class="col-lg-6">
					<h2>Activity Log</h2>
					<?php 
						require('includes/db.php');

						$sql = "SELECT Date, MuscleGroup FROM workouts_dn ORDER BY Date DESC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							echo "<table class='table table-striped'><tr><th class='thead-light'>Date</th><th class='thead-light'>Day</th><th class='thead-light'>Muscle Group</th></tr>";
							$x = 0;							
							$previousDate = '';
							$previousMG = '';
							$resultsPerPage = 3;
							
							// Set page for showing results
							if (isset($_GET["page"])) {
								$page  = $_GET["page"];
							} else {
								$page=1;
							};
							$tableName = "workouts_dn";
							$startFrom = ($page-1) * $resultsPerPage;
							$pagedSql = "SELECT * FROM ".$tableName." ORDER BY Date LIMIT $startFrom, ".$resultsPerPage;
							$pagedResult = $conn->query($pagedSql); 
							/* Show latest 7 rows */
							while($row = $pagedResult->fetch_assoc()) {
								$currentDate = $row["Date"];
								$currentMG = $row["MuscleGroup"];
								if ($currentDate != $previousDate) {
									/* Get the day */
									$dateDay = date('l', strtotime($currentDate));

									/* Build table with Date and Day */
									echo "<tr><td>" . $row["Date"] . "</td><td>" . $dateDay . "</td><td>";

									/* Find and show all the muscle groups that were trained that day */
									$sql2 = "SELECT DISTINCT MuscleGroup FROM workouts_dn WHERE Date='$currentDate'";
									$result2 = $conn->query($sql2);
									$totalRows = $result2->num_rows;
									while($row2 = $result2->fetch_assoc()) {
										echo $row2["MuscleGroup"];
										if($x != $totalRows) {
											echo '<span class="mg-comma">, </span>';
										}
									}

									echo "</td></tr>";
									$previousDate = $currentDate;
									$previousMG = $currentMG;
									$x++;
								}
							}
							echo "</table>";
						}

						// Close database connection

						mysqli_close($conn);
					?>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>