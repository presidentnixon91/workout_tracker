<select style="display: none;" class="form-control exercise-selection" id="exercise-Back">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Back'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Legs">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Legs'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Chest">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Chest'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Shoulders">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Shoulders'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Arms">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Arms'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Core">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Core'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>
<select style="display: none;" class="form-control exercise-selection" id="exercise-Full-Body">
	<?php 
		require('includes/db.php');
		$sql = "SELECT DISTINCT * FROM $recordsTable WHERE MuscleGroup='Full Body'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<option class="' . $row["MuscleGroup"] . '" value="' . $row["Exercise"] . '">' . $row["Exercise"] . '</option>';
			}
		}
	?>
</select>

<script>
	var muscleGroupField = document.getElementById("musclegroup");
	muscleGroupField.onchange = function() {
		var divsToHide = document.getElementsByClassName("exercise-selection"); //divsToHide is an array
	    for(var i = 0; i < divsToHide.length; i++){
	        divsToHide[i].style.display = "none"; // depending on what you're doing
	        divsToHide[i].removeAttribute("name");
	    }
		var muscleGroupValue = document.getElementById("musclegroup").value;
		if (muscleGroupValue == "Full Body") {
			var fullBodyExercise = document.getElementById("exercise-Full-Body");
			fullBodyExercise.style.display = "block";
			fullBodyExercise.setAttribute("name","exercise");
		} else {
			var newExerciseSelection = document.getElementById("exercise-"+muscleGroupValue);
			newExerciseSelection.style.display = "block";
			newExerciseSelection.setAttribute("name","exercise");
		}
	}
</script>