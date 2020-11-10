<?php 
	include("php-global.php");
	require('db.php');

	// Get ID from update set page
	$id=$_REQUEST['id'];
	$datatable = $recordsTable;

	// Set values based on form
	$MuscleGroup = $_POST['musclegroup'];
	$Exercise = $_POST['exercise'];
	$ExerciseVideo = $_POST['exercise-video'];

	$query = "UPDATE $datatable SET MuscleGroup='$MuscleGroup', Exercise='$Exercise', YouTubeLink='$ExerciseVideo' WHERE $recordsID=$id";

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$updateSet = mysqli_query($conn,$query);
		header("Location: /manage-exercises.php?exerciseUpdated=true");
    	exit();
	}
?>