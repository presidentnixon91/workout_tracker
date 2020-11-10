<?php 
	include('php-global.php');
	require('db.php');
	$returnUrl = "activity";
	if(isset($_REQUEST["returnUrl"])) {
		$returnUrl = $_REQUEST["returnUrl"];
	}

	$id=$_REQUEST['id'];

	$idColumn = $workoutsID;
	$datatable = $workoutTable;
	$planWorkout = false;

	if($returnUrl == 'plan-workout' || $returnUrl == 'manage-workouts') {
		$idColumn = $savedID;
		$datatable = $savedTable;
		$planWorkout = true;
	}
	// Get the ExNumber
	if($planWorkout) {
		$sqlExNumber = "SELECT MAX(exNumber) FROM $savedTable WHERE $idColumn='$id'";
		$resultExNumber = $conn->query($sqlExNumber);
		$deletedExNumber = max($resultExNumber->fetch_assoc());
	}
	
	$query = "DELETE FROM $datatable WHERE $idColumn='$id'";
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$deleteResult = mysqli_query($conn,$query);

		if($planWorkout) {
			// Update other results in CURRENT workout
			$sql = "SELECT * FROM $savedTable WHERE SavedName='CURRENT'";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$exNumber = $row["exNumber"];
					$exID = $row["$idColumn"];
					if($exNumber > $deletedExNumber) {
						$newExNumber = $exNumber - 1;
						// Update exNumber on database
						$sqlUpdate = "UPDATE $savedTable SET exNumber='$newExNumber' WHERE $idColumn='$exID'";
						$updateSet = mysqli_query($conn,$sqlUpdate);
					}
				}
			}
			// Update session variables

			// Get total numbers from saved workout
			$sqlExNumber = "SELECT MAX(exNumber) FROM $savedTable WHERE SavedName='CURRENT'";
			$resultExNumber = $conn->query($sqlExNumber);
			$maxExNumber = max($resultExNumber->fetch_assoc());
			$_SESSION["currentEx"] = $maxExNumber;
			$sqlSSGroup = "SELECT MAX(ssGroup) FROM $savedTable WHERE SavedName='CURRENT'";
			$resultSSGroup = $conn->query($sqlSSGroup);
			$maxSSGroup = max($resultSSGroup->fetch_assoc());
			$_SESSION["ssGroups"] = $maxSSGroup;
		}

		header("Location: /" . $returnUrl . "?setDeleted=true");
    	exit();
	}
?>