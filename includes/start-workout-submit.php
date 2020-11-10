<?php 
	include('php-global.php');
	$returnUrl = "plan-workout";
	if(isset($_REQUEST["returnUrl"])) {
		$returnUrl = $_REQUEST["returnUrl"];
	}
	
	date_default_timezone_set('Australia/Sydney');
	$TodayDate = date("Y-m-d");
	$Date = date("Y-m-d",strtotime($TodayDate));
	$CurrentTime = date("h:ia");

	$_SESSION["WorkoutStarted"] = true;

	if(!isset($_SESSION['WorkoutBegins'])) {
		$_SESSION["WorkoutBegins"] = $CurrentTime;
		$_SESSION["StartTime"] = microtime(true);
	}
	if(!isset($_SESSION['WorkoutSets'])) {
		$_SESSION["WorkoutSets"] = 0;
	}
	if(!isset($_SESSION['WorkoutReps'])) {
		$_SESSION["WorkoutReps"] = 0;
	}

	// Go to new set or plan workout page
	if($_SESSION["workoutPlanned"]) {
		header("Location: /new-set");
	} else {
		header("Location: /" . $returnUrl);
	}
	
    exit();
?>