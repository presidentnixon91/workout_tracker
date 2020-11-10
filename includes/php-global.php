<?php 
	session_start();

	if(!isset($_SESSION['WorkoutBegins'])) {
		$_SESSION["WorkoutStarted"] = false;
	}
	if(!isset($_SESSION['workoutPlanned'])) {
		$_SESSION["workoutPlanned"] = false;
	}
	if(isset($_SESSION['username'])) {
		$_SESSION['userLoggedIn'] = true;

		// Create table names using username
		$recordsTable = 'records_' . $_SESSION['username'];
		$workoutTable = 'workouts_' . $_SESSION['username'];
		$savedTable = 'saved_' . $_SESSION['username'];

		// Add username to ID columns
		$recordsID = 'r_ID_' . $_SESSION['username'];
		$workoutsID = 'w_ID_' . $_SESSION['username'];
		$savedID = 's_ID_' . $_SESSION['username'];
	} else {
		$_SESSION['userLoggedIn'] = false;
	}

	date_default_timezone_set('Australia/Sydney');
?>