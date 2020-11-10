<?php 
// This is where I will put my code to create the correct databases
	if($userCreated) {

		require('includes/db.php');

		// Add username to records, workouts and saved
		$newRecordsTable = 'records_' . $newUsername;
		$newWorkoutsTable = 'workouts_' . $newUsername;
		$newSavedTable = 'saved_' . $newUsername;

		// Add username to ID columns
		$recordsID = 'r_ID_' . $newUsername;
		$workoutsID = 'w_ID_' . $newUsername;
		$savedID = 's_ID_' . $newUsername;

		/* Create Workouts table */

		$sql = "CREATE TABLE $newWorkoutsTable (
		  $workoutsID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `Date` date NOT NULL,
		  `MuscleGroup` varchar(50) NOT NULL,
		  `Exercise` varchar(50) NOT NULL,
		  `SetNumber` tinyint(2) NOT NULL,
		  `Reps` tinyint(2) NOT NULL,
		  `Weight` decimal(10,2) NOT NULL,
		  `WeightType` varchar(10) NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		  
		} else {
		  echo "Something went wrong: " . $conn->error;
		}

		/* Create Saved table */

		$sql = "CREATE TABLE $newSavedTable (
		  $savedID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `SavedName` varchar(20) NOT NULL,
		  `MuscleGroup` varchar(50) NOT NULL,
		  `Exercise` varchar(50) NOT NULL,
		  `exNumber` tinyint(2) NOT NULL,
		  `ssGroup` tinyint(2) NOT NULL,
		  `ssOrder` tinyint(2) NOT NULL
		)";

		if ($conn->query($sql) === TRUE) {
		  
		} else {
		  echo "Something went wrong: " . $conn->error;
		}

		$sqlInsert = "INSERT INTO $newSavedTable ($savedID, `SavedName`, `MuscleGroup`, `Exercise`, `exNumber`, `ssGroup`, `ssOrder`) VALUES
			(23, 'Example Workout', 'Back', 'Bent Over Barbell Rows', 1, 1, 1),
			(24, 'Example Workout', 'Back', 'Chin Ups', 2, 1, 2),
			(25, 'Example Workout', 'Legs', 'Back Squat', 3, 0, 0),
			(26, 'Example Workout', 'Chest', 'Bench Press', 4, 2, 1),
			(27, 'Example Workout', 'Chest', 'Incline Bench Press', 5, 2, 2),
			(28, 'Example Workout', 'Shoulders', 'Barbell Shoulder Press', 6, 0, 0),
			(29, 'Example Workout', 'Arms', 'Tricep Pull-Downs', 7, 3, 1),
			(30, 'Example Workout', 'Arms', 'Seated Tricep Extensions', 8, 3, 2),
			(31, 'Example Workout', 'Full Body', 'Cleans', 9, 0, 0)";

		if ($conn->query($sqlInsert) === TRUE) {
		  
		} else {
		  echo "Something went wrong: " . $conn->error;
		}
		
		/* Create Records table */

		$sql = "CREATE TABLE $newRecordsTable (
		  $recordsID int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `ExOrder` tinyint(2) NOT NULL DEFAULT '100',
		  `MuscleGroup` varchar(50) NOT NULL,
		  `Exercise` varchar(50) NOT NULL,
		  `r20` decimal(10,2) DEFAULT NULL,
		  `r15` decimal(10,2) DEFAULT NULL,
		  `p50` decimal(10,2) DEFAULT NULL,
		  `p65` decimal(10,2) DEFAULT NULL,
		  `p70` decimal(10,2) DEFAULT NULL,
		  `p80` decimal(10,2) DEFAULT NULL,
		  `p85` decimal(10,2) DEFAULT NULL,
		  `p90` decimal(10,2) DEFAULT NULL,
		  `p95` decimal(10,2) DEFAULT NULL,
		  `p100` decimal(10,2) DEFAULT NULL,
		  `p101` decimal(10,2) DEFAULT NULL,
		  `TimesCompleted` tinyint(3) NOT NULL DEFAULT '0',
		  `YouTubeLink` varchar(50) DEFAULT NULL
		)";

		if ($conn->query($sql) === TRUE) {

		} else {
		  echo "Something went wrong: " . $conn->error;
		}

		$sqlInsert = "INSERT INTO $newRecordsTable ($recordsID, `ExOrder`, `MuscleGroup`, `Exercise`, `r20`, `r15`, `p50`, `p65`, `p70`, `p80`, `p85`, `p90`, `p95`, `p100`, `p101`, `TimesCompleted`, `YouTubeLink`) VALUES
			(52, 100, 'Back', 'Chin Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(53, 100, 'Back', 'Cable Straight-Arm Pull Downs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(54, 100, 'Back', 'Face Pulls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=V8dZ3pyiCBo'),
			(55, 100, 'Arms', 'Seated Dumbbell Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(56, 100, 'Arms', 'Dips', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(57, 100, 'Arms', 'Skull Crushers', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(58, 100, 'Arms', 'Close-Grip EZ Bar Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(59, 100, 'Arms', 'EZ Bar Bicep Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(60, 100, 'Chest', 'Dumbbell Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(61, 100, 'Chest', 'Incline Dumbbell Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(62, 100, 'Chest', 'Decline Smith Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(63, 100, 'Chest', 'Chest Dips', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(64, 100, 'Chest', 'Pec Decks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(65, 100, 'Chest', 'Cable Flies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(66, 100, 'Chest', 'Cable Chest Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(67, 100, 'Chest', 'Cable Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(51, 100, 'Back', 'Bent Over Barbell Rows', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=Nq7GQxyMrW4'),
			(50, 100, 'Legs', 'Leg Extensions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(49, 100, 'Legs', 'Dumbbell Lunges', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(48, 100, 'Legs', 'Overhead Squat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=pn8mqlG0nkE'),
			(47, 100, 'Chest', 'Machine Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(44, 100, 'Chest', 'Decline Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=LfyQBUKR8SE'),
			(45, 100, 'Chest', 'Incline Smith Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(46, 100, 'Chest', 'Incline Dumbbell Flies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(1, 100, 'Legs', 'Back Squat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=SW_C1A-rejs'),
			(2, 100, 'Legs', 'Front Squat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=uYumuL_G_V0'),
			(3, 100, 'Legs', 'Leg Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=IZxyjW7MPJQ'),
			(4, 100, 'Legs', 'Lying Leg Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(5, 100, 'Legs', 'Calf Raise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(6, 100, 'Legs', 'Overhead Barbell Lunges', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(7, 100, 'Arms', 'Tricep Pull-Downs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(8, 100, 'Arms', 'Seated Tricep Extensions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(9, 100, 'Arms', 'Ring Dips', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(10, 100, 'Arms', 'Machine Tricep Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(11, 100, 'Arms', 'Dumbbell Bicep Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(12, 100, 'Arms', 'Seated Close-Grip Barbell Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(13, 100, 'Arms', 'Seated Dumbbell Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(14, 100, 'Arms', '21s', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(15, 100, 'Arms', 'Seated Row Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(16, 100, 'Arms', 'Cable Bicep Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(17, 100, 'Arms', 'Machine Bicep Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(18, 100, 'Arms', 'Behind the Back Wrist Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(19, 100, 'Arms', 'Seated Palms-Up Wrist Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(20, 100, 'Shoulders', 'Barbell Shoulder Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=2yjwXTZQDDI'),
			(21, 100, 'Shoulders', 'Dumbbell Shoulder Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=qEwKCR5JCog'),
			(22, 100, 'Shoulders', 'Arnold Shoulder Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=6Z15_WdXmVw'),
			(23, 100, 'Shoulders', 'Dumbbell Shrugs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(24, 100, 'Shoulders', 'Machine Shoulder Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(25, 100, 'Shoulders', 'Machine Rear Delts', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(26, 100, 'Shoulders', 'Front Lateral Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(27, 100, 'Shoulders', 'Side Lateral Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(28, 100, 'Shoulders', 'Side Cable Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(29, 100, 'Shoulders', 'Bent Over Rear Delt Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(30, 100, 'Shoulders', 'Upright Row', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(31, 100, 'Shoulders', 'Seated Side Dumbbell Raise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(32, 100, 'Shoulders', 'Smith Shoulder Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=4Mw8r3df65o'),
			(33, 100, 'Full Body', 'Cleans', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=Ty14ogq_Vok'),
			(34, 100, 'Full Body', 'Snatch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=9xQp2sldyts'),
			(35, 100, 'Full Body', 'Chest To Bars', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(36, 100, 'Full Body', 'Toes To Bars', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(37, 100, 'Full Body', 'Knees to Elbows', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(38, 100, 'Full Body', 'Kettlebell Swings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(39, 100, 'Full Body', 'Double Unders', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(40, 100, 'Full Body', 'Handstand Push-Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(41, 100, 'Full Body', 'Burpees', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(42, 100, 'Chest', 'Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=SCVCLChPQFY'),
			(43, 100, 'Chest', 'Incline Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=dynoKEIcpoU'),
			(68, 100, 'Chest', 'Cable Crossover', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(69, 100, 'Chest', 'Decline Smith Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(70, 100, 'Chest', 'Single-Arm Cable Flies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(71, 100, 'Chest', 'Push-Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(72, 100, 'Chest', 'Dumbbell Flies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(73, 100, 'Back', 'Deadlift', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=op9kVnSso6Q'),
			(74, 100, 'Back', 'Lat Pull-Downs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(75, 100, 'Back', 'Seated Row', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(76, 100, 'Back', 'Wide Grip Chin Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(77, 100, 'Back', 'Close Grip Chin Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(78, 100, 'Back', 'Stiff-Legged Barbell Good Mornings', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(79, 100, 'Back', 'Machine Row', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(80, 100, 'Back', 'Cable Flies', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(81, 100, 'Back', 'One-Arm Dumbbell Row', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(82, 100, 'Back', 'T-Bar Row', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(83, 100, 'Back', 'Close-Grip Lat Pull-Downs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(84, 100, 'Core', 'Sit Ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(85, 100, 'Core', 'V Sit-ups', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(86, 100, 'Back', 'Bicycle Kicks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(87, 100, 'Core', 'Bicycle Kicks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(88, 100, 'Core', 'Russian Twists', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(89, 100, 'Full Body', 'Dumbbell Snatch', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(90, 100, 'Core', 'Ab Roller ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(91, 100, 'Core', 'Plank', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(92, 100, 'Core', 'Side Plank', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(93, 100, 'Core', 'Back Plank', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(94, 100, 'Legs', 'Split Squats', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=VncTA2oFMuo'),
			(95, 100, 'Core', 'Knee Raises', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(96, 100, 'Arms', 'Tricep Press-downs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(97, 100, 'Legs', 'Bulgarian Split Squats ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=2C-uNgKwPLE'),
			(98, 100, 'Legs', 'Single Leg Deadlifts ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=tZfxXdilG_M'),
			(99, 100, 'Legs', 'One-legged Leg Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(100, 100, 'Chest', 'Smith Flat Bench Press', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(101, 100, 'Legs', 'Dumbbell Bulgarian Split Squats', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=2C-uNgKwPLE'),
			(102, 100, 'Arms', 'Hammer Curls', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(103, 100, 'Arms', 'Overhead Triceps Extensions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(104, 100, 'Arms', 'Cable Overhead Tricep Extensions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
			(105, 100, 'Legs', 'Romanian Deadlift', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'https://www.youtube.com/watch?v=JCXUYuzwNrM'),
			(106, 100, 'Arms', 'Ez Bar Tricep Extensions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL)";

		if ($conn->query($sqlInsert) === TRUE) {

		} else {
		  echo "Something went wrong: " . $conn->error;
		}

		// Send email notifying new user

	    $recipient = "drew@dnwebdesigns.com.au";
	    $from_email = "web@dnwebdesigns.com.au";
	    $email_title = "New Gym registration";

	    $in_testing = 0;
	    if($in_testing) {
	        $recipient = "drewanix@yahoo.com";
	    }
	    
	    $headers = 'From: '.$from_email . "\r\n" .
	    'Reply-To: '.$from_email . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	    $email_body = "New user on Gym website: " . $newUsername . "." . "\n\n" ;

	    mail($recipient, $email_title, $email_body, $headers);

	}

	$conn->close();
?>