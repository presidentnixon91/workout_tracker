<?php 
	include('php-global.php');
	
	// Connect to database
	require('db.php');
	$datatable = $recordsTable;

	// Set values based on form
	$MuscleGroup = filter_var($_POST['musclegroup'], FILTER_SANITIZE_STRING);
	$Exercise = filter_var($_POST['exercise'], FILTER_SANITIZE_STRING);
	$ExerciseVideo = $_POST['exercise-video'];

	// Set values to sentence case
	$MuscleGroupLower = strtolower($MuscleGroup);
	$ExerciseLower = strtolower($Exercise);
	$MuscleGroupSentence = ucwords($MuscleGroupLower);
	$ExerciseSentence = ucwords($ExerciseLower);

	// Upload values to records table
	$stmt = $conn->prepare("insert into $recordsTable(MuscleGroup,Exercise,YouTubeLink)
	values(?, ?, ?)");
	$stmt->bind_param("sss",$MuscleGroupSentence,$ExerciseSentence,$ExerciseVideo);
	$stmt->execute();

	$stmt->close();
	$conn->close();
	
	header("Location: /manage-exercises?exerciseAdded=true");
    exit();
?>