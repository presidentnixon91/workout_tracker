<?php
	include('php-global.php');
	include("php-auth.php");
	date_default_timezone_set('Australia/Sydney');
	$TodayDate = date("Y-m-d");
	$Date = date("Y-m-d",strtotime($TodayDate));

	// Connect to database
	require('db.php');

	// Set values based on most recent submission
	$sqlGetLatestWorkout = "SELECT * FROM $workoutTable WHERE Date='$Date' ORDER BY $workoutsID DESC LIMIT 1";
	$resultLatestWorkout = $conn->query($sqlGetLatestWorkout);
	while($rowWorkout = $resultLatestWorkout->fetch_assoc()) {
		$MuscleGroup = $rowWorkout["MuscleGroup"];
		$Exercise = $rowWorkout["Exercise"];
		$Set = $rowWorkout["SetNumber"];
		$Reps = $rowWorkout["Reps"];
		$Weight = $rowWorkout["Weight"];
		$WeightType = $rowWorkout["WeightType"];
	}

	// Increase set number
	++$Set;

	// Upload values to workouts table
	$stmt = $conn->prepare("insert into $workoutTable(Date,MuscleGroup,Exercise,SetNumber,Reps,Weight,WeightType)
	values(?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sssiiss",$Date,$MuscleGroup,$Exercise,$Set,$Reps,$Weight,$WeightType);
	$stmt->execute();
	$stmt->close();

	// Close connection
	$conn->close();

	header("Location: /new-set");
	exit();

?>