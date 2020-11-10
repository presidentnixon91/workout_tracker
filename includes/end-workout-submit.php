<?php 
	include('php-global.php');
	require('db.php');

	date_default_timezone_set('Australia/Sydney');
	$TodayDate = date("Y-m-d");
	$Date = date("Y-m-d",strtotime($TodayDate));
	$CurrentTime = date("h:ia");

	if(($_SESSION['WorkoutStarted']) || ($_SESSION['WorkoutBegins'])) {
		$_SESSION["WorkoutEnds"] = $CurrentTime;
		$_SESSION["WorkoutTime"] = $_SESSION["WorkoutEnds"] - $_SESSION["WorkoutBegins"];
	}

	// Wipe workout plan
	$query = "DELETE FROM $savedTable WHERE SavedName='CURRENT'";

	$_SESSION["ssGroups"] = 0;
	$_SESSION["currentSS"] = 0;
	$_SESSION["currentEx"] = 0;

	// Calculate total number of sets
	$sql = "SELECT COUNT(SetNumber) FROM $workoutTable WHERE Date='$Date'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$TotalSets = max($result->fetch_assoc());
	} else {
		$TotalSets = 0;
	}
	$_SESSION["WorkoutSets"] = $TotalSets;

	// Calculate total number of reps
	$sqlReps = "SELECT Sum(Reps) FROM $workoutTable WHERE Date='$Date'";
	$resultReps = $conn->query($sqlReps);
	if ($resultReps->num_rows > 0) {
		$TotalReps = max($resultReps->fetch_assoc());
	} else {
		$TotalReps = 0;
	}

	$_SESSION["WorkoutReps"] = $TotalReps;	
	$_SESSION["WorkoutSets"] = $TotalSets;

	$_SESSION["WorkoutStarted"] = false;

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$deleteResult = mysqli_query($conn,$query);
		// Go to end workout page
		header("Location: /end-workout");
	    exit();
	}

	
?>