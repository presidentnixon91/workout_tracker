<?php 
	include('php-global.php');

	// Connect to database
	require('db.php');

	// Get exercise from workout plan
	$sqlCurrentEx = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' AND exNumber='1'";
	$resultCurrentEx = $conn->query($sqlCurrentEx);
	if($resultCurrentEx->num_rows > 0) {
		while($rowCurrentEx = $resultCurrentEx->fetch_assoc()) {
			$ssGroup = $rowCurrentEx["ssGroup"];
		}
	}
	$queryDelete = "DELETE FROM $savedTable WHERE SavedName='CURRENT' AND ssGroup='$ssGroup'";

	// Get number of rows to delete
	$sql = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' AND ssGroup='$ssGroup'";
	$result = $conn->query($sql);
	$rowsDeleted = $result->num_rows;

	// Move all values down by number deleted
	$queryUpdate = "UPDATE $savedTable SET exNumber = exNumber - $rowsDeleted WHERE SavedName='CURRENT'";
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$deleteSet = mysqli_query($conn,$queryDelete);
		$updateSets = mysqli_query($conn,$queryUpdate);
	}
	
	header("Location: /new-set");
    exit();
?>