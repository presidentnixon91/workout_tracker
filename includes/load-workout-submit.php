<?php
	include('php-global.php');
	// Connect to database
	require('db.php');

	$returnUrl = "plan-workout";

	// Set values based on form
	$LoadName = $_POST['workouts'];
	$SavedName = "CURRENT";

	// Pull records from saved workouts using name
	$sql = "SELECT * FROM $savedTable WHERE SavedName='$LoadName' ORDER BY exNumber ASC";
	$result = $conn->query($sql);
	// Insert records as CURRENT
	if ($result->num_rows > 0) {

		$sqlGetCurrent = "SELECT * FROM $savedTable WHERE SavedName='$SavedName'";
		$resultGetCurrent = $conn->query($sqlGetCurrent);
		// If there is already some exercises added to plan
		if($resultGetCurrent->num_rows > 0) {
			// Get total numbers from saved workout
			$sqlExNumber = "SELECT MAX(exNumber) FROM $savedTable WHERE SavedName='$SavedName'";
			$resultExNumber = $conn->query($sqlExNumber);
			$maxExNumber = max($resultExNumber->fetch_assoc());
			$sqlSSGroup = "SELECT MAX(ssGroup) FROM $savedTable WHERE SavedName='$SavedName'";
			$resultSSGroup = $conn->query($sqlSSGroup);
			$maxSSGroup = max($resultSSGroup->fetch_assoc());
			
		} else {
			$maxExNumber = 0;
			$maxSSGroup = 0;
		}

		while($row = $result->fetch_assoc()) {
			// Set values from saved workout
			$MuscleGroup = $row["MuscleGroup"];
			$Exercise = $row["Exercise"];
			$exNumber = $row["exNumber"] + $maxExNumber;
			if($row["ssGroup"] > 0) {
				$ssGroup = $row["ssGroup"] + $maxSSGroup;
			} else {
				$ssGroup = 0;
			}
			$ssOrder = $row["ssOrder"];
			// Insert values as CURRENT
			$stmt = $conn->prepare("insert into $savedTable(SavedName,MuscleGroup,Exercise,exNumber,ssGroup,ssOrder)
	values(?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssiii",$SavedName,$MuscleGroup,$Exercise,$exNumber,$ssGroup,$ssOrder);
			$stmt->execute();
			// Update session variables as they are being added
			$_SESSION["currentEx"] = $exNumber;
			$_SESSION["ssGroups"] = $ssGroup;
			$_SESSION["currentSS"] = $ssOrder;
		}
		$stmt->close();
	}

	// Back to Plan Workout page
	header("Location: /" . $returnUrl . "?workoutLoaded=true");
	exit();
?>