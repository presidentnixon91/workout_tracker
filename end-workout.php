<?php 
	include('includes/php-global.php');
	include("includes/php-auth.php");
	$CURRENT_PAGE = "Workout Results";
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head-tag-contents.php");?>

	<meta name="description" content="" />
	<meta name="keywords" content="" />

	<title>Workout Results<?php print $SITE_TITLE;?></title>
</head>
<body id="workout-results">

	<?php include("includes/design-top.php");?>

	<div class="main-content" id="content-workout-results">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-xl-8 mx-auto">
					<h1>Workout Results</h1>
					<?php
						require('includes/db.php');

						// Show a poll for whether people are stretching or not
						$pollSubmitted = false;
						// Check if they have already voted today
						$votedToday = false;
						date_default_timezone_set('Australia/Sydney');
						$TodayDate = date("Y-m-d");
						$date = date("Y-m-d",strtotime($TodayDate));
						$datatable = "users_gym";
						$username = $_SESSION["username"];
						$sql = "SELECT * FROM $datatable WHERE username='$username'";
						$result = $conn->query($sql);
						if($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								$lastVoteDate = $row["last_vote"];
								if($lastVoteDate == $date) {
									$pollSubmitted = true;
									$votedToday = true;
									$lastVoteOption = $row["last_vote_option"];
									if($lastVoteOption == "stretch"){
										$pollVote = 1;
									} elseif ($lastVoteOption == "nah") {
										$pollVote = 2;
									}
								}
							}
						}
						// Check if they just voted
						if(isset($_REQUEST["vote"]) && !$votedToday) {
							$pollSubmitted = true;
							$pollVoteResult = $_REQUEST["vote"];
							if($pollVoteResult == "stretch") {
								$pollVote = 1;
							} elseif ($pollVoteResult == "nah") {
								$pollVote = 2;
							}
							// Set last voted date in database
							$lastVoteDate = $date;
							$query = "UPDATE $datatable SET last_vote='$lastVoteDate',last_vote_option='$pollVoteResult' WHERE username='$username'";
							$updateDate = mysqli_query($conn,$query);
							// Update poll results
							$datatable = "stretch_poll";
							$sql = "SELECT * FROM $datatable WHERE stretch_poll_ID='1'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()) {
								$stretchVoteCount = $row["stretch"];
								$nahVoteCount = $row["nah"];
								$timesSubmitted = $row["timesSubmitted"];
							}
							// Update if stretch
							if($pollVoteResult == "stretch") {
								$stretchVoteCount = $stretchVoteCount + 1;
								$timesSubmitted = $timesSubmitted + 1;
								$query = "UPDATE $datatable SET stretch='$stretchVoteCount',timesSubmitted='$timesSubmitted' WHERE stretch_poll_ID='1'";
								$updateStretchCount = mysqli_query($conn,$query);

							} elseif($pollVoteResult == "nah") {
							// Update if nah
								$nahVoteCount = $nahVoteCount + 1;
								$timesSubmitted = $timesSubmitted + 1;
								$query = "UPDATE $datatable SET nah='$nahVoteCount',timesSubmitted='$timesSubmitted' WHERE stretch_poll_ID='1'";
								$updateNahCount = mysqli_query($conn,$query);
							}
						}

						if(!$pollSubmitted) {
					?>
					<div id="strech-poll" class="poll poll-instant margin-b-1">
						<h2>Need to stretch?</h2>
						<div class="poll-vote-container">
							<a href="?vote=stretch" title="Love a stretch" id="poll-option-stretch" class="poll-option poll-option-1">
								Stretch
							</a>
							<a href="?vote=nah" title="Not today" id="poll-option-nah" class="poll-option poll-option-2">
								Nah
							</a>
						</div>
					</div>
					<?php
						} else {
							// Calculate width of each div based on results in database
							$datatable = "stretch_poll";
							$sql = "SELECT * FROM $datatable WHERE stretch_poll_ID='1'";
							$result = $conn->query($sql);
							while($row = $result->fetch_assoc()) {
								$stretchVoteCount = $row["stretch"];
								$nahVoteCount = $row["nah"];
								$timesSubmitted = $row["timesSubmitted"];
							}

							$pollOption1 = round(($stretchVoteCount / $timesSubmitted) * 100);
							$pollOption2 = 100 - $pollOption1;
					?>
					<div id="strech-poll" class="poll poll-instant margin-b-1">
						<h2>Need to stretch?</h2>
						<div class="poll-results-container">
							<div style="width: <?php echo $pollOption1;?>%; <?php if($pollVote==1){echo 'background:rgba(0,0,0,0.1);';}?>" href="?vote=stretch" title="Love a stretch" id="poll-option-stretch" class="poll-option poll-option-1">
								<div class="poll-result-label">
									Stretch
								</div>
								<div class="poll-result-percentage">
									<?php echo $pollOption1;?>%
								</div>
							</div>
							<div style="width: <?php echo $pollOption2;?>%; <?php if($pollVote==2){echo 'background:rgba(0,0,0,0.1);';}?>" href="?vote=nah" title="Not today" id="poll-option-nah" class="poll-option poll-option-2">
								<div class="poll-result-label">
									Nah
								</div>
								<div class="poll-result-percentage">
									<?php echo $pollOption2;?>%
								</div>
							</div>
						</div>
					</div>
					<?php
						}
					?>
					<div class="widget margin-b-1">
						<h2>Overall Results</h2>
						<div class="margin-b-1">
							<?php 
								echo '<ul><li>Start time: ' . $_SESSION["WorkoutBegins"] . '</li>
								</li><li>End time: ' . $_SESSION["WorkoutEnds"] . '</li>
								<li>Total Sets: ' . $_SESSION["WorkoutSets"] . '</li>
								<li>Total Reps: ' . $_SESSION["WorkoutReps"] . '</li></ul>';
							?>
						</div>
						<div>
							<!-- Build table of day's workout -->
							<?php
								$datatable = $workoutTable;

								date_default_timezone_set('Australia/Sydney');
								$TodayDate = date("Y-m-d");
								$date = date("Y-m-d",strtotime($TodayDate));

								$sqlGetWorkout = "SELECT * FROM ".$datatable." WHERE Date='$date'";
								$resultWorkout = $conn->query($sqlGetWorkout);
								if ($resultWorkout->num_rows > 0) {
									echo "<h2>Sets:</h2><table class='table table-responsive-sm'><tr><th class='thead-light'>Exercise</th><th class='thead-light'>Set</th><th class='thead-light'>Reps</th><th class='thead-light'>Weight</th></tr>";
									while($rowWorkout = $resultWorkout->fetch_assoc()) {
										$exercise = $rowWorkout["Exercise"];
										$setNumber = $rowWorkout["SetNumber"];
										$reps = $rowWorkout["Reps"];
										$weight = $rowWorkout["Weight"];
										$weightType = $rowWorkout["WeightType"];
										/* Build table with Data */
										echo "<tr><td>" . $exercise . "</td><td>" . $setNumber . "</td><td>" . $reps . "</td><td>" . $weight . " " . $weightType . "</td></tr>";
									}
									echo "</table>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include("includes/footer.php");?>

</body>
</html>