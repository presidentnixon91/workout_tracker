<nav class="navbar fixed-top navbar-dark navbar-expand-md">
	<h1><a href="/">Workout Tracker</a></h1>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
  	</button>
  	<div class="collapse navbar-collapse" id="main-nav">
		<ul class="navbar-nav">
		  	<!-- <li class="nav-item <?php if ($CURRENT_PAGE == "Home") {?>active<?php }?>"><a class="nav-link" href="/">Home</a></li> -->
		  	<?php 
			  	if($_SESSION['userLoggedIn']) {
					if($CURRENT_PAGE == "Plan Workout") {
						echo '<li class="nav-item"><a class="nav-link" href="/includes/start-workout-submit?returnUrl=new-set">Start Workout</a></li>';
					} elseif((!$_SESSION['WorkoutStarted']) && (!isset($_SESSION['WorkoutBegins']))) {
						echo '<li class="nav-item"><a class="nav-link" href="/includes/start-workout-submit">Start Workout</a></li>';
					} elseif(isset($_SESSION['WorkoutBegins'])) {
						if ($CURRENT_PAGE == "New Set") {
							echo '<li class="nav-item active"><a class="nav-link" href="/new-set">New Set</a></li>';
						} else {
							echo '<li class="nav-item"><a class="nav-link" href="/new-set">New Set</a></li>';
						}
					} else {
						echo '<li class="nav-item"><a class="nav-link" href="/includes/end-workout-submit">End Workout</a></li>';
					}
			?>
					<li class="nav-item <?php if ($CURRENT_PAGE == "Plan Workout") {?>active<?php }?>"><a class="nav-link" href="/plan-workout">Plan Workout</a></li>
					<li class="nav-item <?php if ($CURRENT_PAGE == "Activity") {?>active<?php }?>"><a class="nav-link" href="/activity">Activity Log</a></li>
				  	<li class="nav-item <?php if ($CURRENT_PAGE == "Check Records") {?>active<?php }?>"><a class="nav-link" href="/check-records">Check Records</a></li>
				  	<li class="nav-item dropdown d-none d-md-block">
				  		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          					Settings
				        </a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				          <?php 
						  	require("db.php");
						  	// Are there workouts saved?
							$sqlLoadWorkouts = "SELECT DISTINCT SavedName FROM $savedTable WHERE NOT SavedName='CURRENT' ORDER BY SavedName ASC";
							$resultLoadWorkouts = $conn->query($sqlLoadWorkouts);
							if($resultLoadWorkouts->num_rows > 0) {
							?>
						  		<a class="dropdown-item" href="/manage-workouts">Manage Workouts</a>
					  		<?php
						  	}
						  	?>
				          <a class="dropdown-item" href="/manage-exercises">Manage Exercises</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="/logout">Log Out</a>
				        </div>
			      	</li>
				  	<?php 
				  	require("db.php");
				  	// Are there workouts saved?
					$sqlLoadWorkouts = "SELECT DISTINCT SavedName FROM $savedTable WHERE NOT SavedName='CURRENT' ORDER BY SavedName ASC";
					$resultLoadWorkouts = $conn->query($sqlLoadWorkouts);
					if($resultLoadWorkouts->num_rows > 0) {
					?>
				  		<li class="nav-item d-md-none <?php if ($CURRENT_PAGE == "Manage Workouts") {?>active<?php }?>"><a class="nav-link" href="/manage-workouts">Manage Workouts</a></li>
			  		<?php
				  	}
				  	?>
				  	<li class="nav-item d-md-none <?php if ($CURRENT_PAGE == "Manage Exercises") {?>active<?php }?>"><a class="nav-link" href="/manage-exercises">Manage Exercises</a></li>
				  	<li class="nav-item d-md-none <?php if ($CURRENT_PAGE == "Log Out") {?>active<?php }?>"><a class="nav-link" href="/logout">Log Out</a></li>
			<?php 
				} else {
			?>
					<li class="nav-item <?php if ($CURRENT_PAGE == "Login") {?>active<?php }?>"><a class="nav-link" href="/check-records">Login</a></li>
					<li class="nav-item <?php if ($CURRENT_PAGE == "Register") {?>active<?php }?>"><a class="nav-link" href="/register">Register</a></li>
			<?php 
				}
			?>
		</ul>
	</div>
</nav>