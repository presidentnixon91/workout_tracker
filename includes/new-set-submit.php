<?php
	date_default_timezone_set('Australia/Sydney');
	$TodayDate = date("Y-m-d");
	$Date = date("Y-m-d",strtotime($TodayDate));

	// Connect to database
	require('includes/db.php');

	// Set values based on form
	$MuscleGroup = $_POST['musclegroup'];
	$Exercise = $_POST['exercise'];
	// $Set = $_POST['set'];
	$Reps = $_POST['reps'];
	$Weight = $_POST['weight'];
	$WeightType = $_POST['weighttype'];

	// Set the set number if can't find one
	$datatable = $workoutTable;
	$sql = "SELECT * FROM $datatable WHERE Date='$Date' AND Exercise='$Exercise'";
	$result = $conn->query($sql);
	if ($result->num_rows <= 0) {
		$Set = 1;
	} else {
		while($row = $result->fetch_assoc()) {
			if($row["Exercise"] == $Exercise){
				$sqlGetSet = "SELECT MAX(SetNumber) FROM $datatable WHERE Date='$Date' AND Exercise='$Exercise'";
				$resultGetSet = $conn->query($sqlGetSet);
				$Set = max($resultGetSet->fetch_assoc());
				// Increase set number
				++$Set;
			}
		}
	}

	// Upload values to workouts table
	$stmt = $conn->prepare("insert into $workoutTable(Date,MuscleGroup,Exercise,SetNumber,Reps,Weight,WeightType)
	values(?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssiiss",$Date,$MuscleGroup,$Exercise,$Set,$Reps,$Weight,$WeightType);
	$stmt->execute();
	$stmt->close();

	// Upload values to records table

	// Pull records using exercise
	$recordsSql="SELECT * FROM $recordsTable WHERE Exercise='$Exercise'";
	$recordsResult = $conn->query($recordsSql);
	$recordsRow = $recordsResult->fetch_assoc();

	// Set percentages
	$r20 = $recordsRow["r20"];
	$r15 = $recordsRow["r15"];
	$p50 = $recordsRow["p50"];
	$p65 = $recordsRow["p65"];
	$p70 = $recordsRow["p70"];
	$p80 = $recordsRow["p80"];
	$p85 = $recordsRow["p85"];
	$p90 = $recordsRow["p90"];
	$p95 = $recordsRow["p95"];
	$p100 = $recordsRow["p100"];

	// Increase the times completed for that exercise
	$timesCompleted = $recordsRow["TimesCompleted"] + 1;
	$queryIncreaseTimesCompeted = "UPDATE $recordsTable SET TimesCompleted='$timesCompleted' WHERE Exercise='$Exercise'";
	$updateTimesCompleted = mysqli_query($conn,$queryIncreaseTimesCompeted);

	// Register if there is a new maximum reached
	$newMax = false;
	if($Reps > 19) {
		if($r20 < $Weight) {
			$query = "UPDATE $recordsTable SET r20='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($r20 != 0) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 14) {
		if($r15 < $Weight) {
			$query = "UPDATE $recordsTable SET r15='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($r15 != 0) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif($Reps > 11) {
		if($p50 < $Weight) {
			$query = "UPDATE $recordsTable SET p50='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p50 != 0) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 7) {
		if($p65 < $Weight) {
			$query = "UPDATE $recordsTable SET p65='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p65 != 0 && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 5) {
		if($p70 < $Weight) {
			$query = "UPDATE $recordsTable SET p70='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p70 != 0 && $p65 < $Weight && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 4) {
		if($p80 < $Weight) {
			$query = "UPDATE $recordsTable SET p80='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p80 != 0 && $p70 < $Weight && $p65 < $Weight && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 3) {
		if($p85 < $Weight) {
			$query = "UPDATE $recordsTable SET p85='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p85 != 0 && $p80 < $Weight && $p70 < $Weight && $p65 < $Weight && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 2) {
		if($p90 < $Weight) {
			$query = "UPDATE $recordsTable SET p90='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p90 != 0 && $p85 < $Weight && $p80 < $Weight && $p70 < $Weight && $p65 < $Weight && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps > 1) {
		if($p95 < $Weight) {
			$query = "UPDATE $recordsTable SET p95='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p95 != 0 && $p90 < $Weight && $p85 < $Weight && $p80 < $Weight && $p70 < $Weight && $p65 < $Weight && $p50 < $Weight) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	} elseif ($Reps == 1) {
		if($p100 < $Weight) {
			$query = "UPDATE $recordsTable SET p100='$Weight' WHERE Exercise='$Exercise'";
			// If the record was not 0, set the new maximum
			if($p100 != 0) {
				$newMax = true;
			}
			$updateSet = mysqli_query($conn,$query);
		}
	}

	// Close connection
	$conn->close();

?>