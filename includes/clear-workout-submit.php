<?php 
	include('php-global.php');
	require('db.php');

	$returnUrl = "plan-workout";

	// Clear everything
	$query = "DELETE FROM $savedTable WHERE SavedName='CURRENT'";

	$_SESSION["ssGroups"] = 0;
	$_SESSION["currentSS"] = 0;
	$_SESSION["currentEx"] = 0;

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$deleteResult = mysqli_query($conn,$query);
		header("Location: /" . $returnUrl . "?workoutCleared=true");
    	exit();
	}

?>