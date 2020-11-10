<?php 
	// Connect to database
	require('db.php');

	// Is superset?
	if(!isset($Superset)) {
		$Superset = false;
	}

	if(!$Superset) {
		require('php-global.php');
		$queryDelete = "DELETE FROM $savedTable WHERE SavedName='CURRENT' AND exNumber='1'";

		// Move all values down
		$queryUpdate = "UPDATE $savedTable SET exNumber=exNumber - 1 WHERE SavedName='CURRENT'";
		if($conn->connect_error){
			die("Connection Failed : ". $conn->connect_error);
		}else{
			$deleteSet = mysqli_query($conn,$queryDelete);
			$updateSets = mysqli_query($conn,$queryUpdate);

			header("Location: /new-set");
    		exit();
		}

	} else {
	
		// Stay in a loop of exercises if it is a superset

		// Decrease the exercise number for everything in this 
		$sqlGetSSGroup = "SELECT * FROM $savedTable WHERE SavedName='CURRENT' AND ssGroup='$ssGroup'";
		$resultSSGroup = $conn->query($sqlGetSSGroup);
		if($resultSSGroup->num_rows > 0) {
			$x = $resultSSGroup->num_rows;
			while($rowSSGroup = $resultSSGroup->fetch_assoc()) {
				$i = $rowSSGroup[$savedID];
				$queryUpdate = "UPDATE $savedTable SET exNumber = exNumber - 1 WHERE $savedID='$i'";
				$updateSet = mysqli_query($conn,$queryUpdate);
			}
		}
		$queryUpdate = "UPDATE $savedTable SET exNumber='$x' WHERE SavedName='CURRENT' AND exNumber='0'";
		$updateSet = mysqli_query($conn,$queryUpdate);
	}
?>