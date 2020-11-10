<?php
	include('php-global.php');
	// Connect to database
	require('db.php');

	$returnUrl = "plan-workout";

	// Set values based on form
	$Name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	if($Name == "CURRENT") {
		header("Location: /plan-workout?nameCurrent=true");
		exit();
	}

	// Check for name already existing in database
	$sql = "SELECT DISTINCT SavedName FROM $savedTable WHERE SavedName='$Name'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		// Back to Save Workout page
		header("Location: /plan-workout?nameExists=true");
		exit();
	}

	// Get values from CURRENT
	$sqlWorkoutPlan = "SELECT * FROM $savedTable WHERE SavedName='CURRENT'";
	$resultWorkoutPlan = $conn->query($sqlWorkoutPlan);
	while($rowPlannedWorkout = $resultWorkoutPlan->fetch_assoc()) {
		$MuscleGroup = $rowPlannedWorkout["MuscleGroup"];
		$Exercise = $rowPlannedWorkout["Exercise"];
		$exNumber = $rowPlannedWorkout["exNumber"];
		$ssGroup = $rowPlannedWorkout["ssGroup"];
		$ssOrder = $rowPlannedWorkout["ssOrder"];
		// Insert values as CURRENT
		$stmt = $conn->prepare("insert into $savedTable(SavedName,MuscleGroup,Exercise,exNumber,ssGroup,ssOrder)
values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssiii",$Name,$MuscleGroup,$Exercise,$exNumber,$ssGroup,$ssOrder);
		$stmt->execute();
	}
	$stmt->close();

	// Back to Plan Workout page
	header("Location: /" . $returnUrl . "?workoutLoaded=true");
	exit();
?>