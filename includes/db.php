<?php
	$servername = "localhost";
	$serverUsername = "dnixon";
	$serverPassword = "DaRuckus91!";

	// Connect to database

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	$conn = new mysqli('localhost',$serverUsername,$serverPassword,'dn_gym');
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}
?>