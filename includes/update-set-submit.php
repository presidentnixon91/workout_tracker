<?php 
	include("php-global.php");
	require('db.php');
	$returnUrl = "activity";
	if(isset($_REQUEST["returnUrl"])) {
		$returnUrl = $_REQUEST["returnUrl"];
	}

	// Get ID from update set page
	$id=$_REQUEST['id'];

	$idColumn = $workoutsID;
	$datatable = $workoutTable;
	$planWorkout = false;

	if($returnUrl == 'plan-workout' || $returnUrl == 'manage-workouts') {
		$planWorkout = true;
	}
	// Are we updating a set from the workout plan
	if(isset($_REQUEST["workoutPlan"])) {
		$planWorkout = true;
	}

	if($planWorkout) {
		$idColumn = $savedID;
		$datatable = $savedTable;
	}

	// Set values based on form
	$MuscleGroup = $_POST['musclegroup'];
	$Exercise = $_POST['exercise'];
	if($planWorkout) {
		$query = "UPDATE $datatable SET MuscleGroup='$MuscleGroup', Exercise='$Exercise' WHERE $idColumn='$id'";
	} else {
		$Set = $_POST['set'];
		$Reps = $_POST['reps'];
		$Weight = $_POST['weight'];
		$WeightType = $_POST['weighttype'];
		$Date = $_POST['date'];

		$query = "UPDATE $datatable SET Date='$Date', MuscleGroup='$MuscleGroup', Exercise='$Exercise', SetNumber='$Set', Reps='$Reps', Weight='$Weight', WeightType='$WeightType' WHERE $idColumn='$id'";
	}

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$updateSet = mysqli_query($conn,$query);
		header("Location: /" . $returnUrl . "?setUpdated=true");
    	exit();
	}
?>