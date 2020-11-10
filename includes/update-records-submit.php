<?php 
	include("php-global.php");
	require('db.php');
	$returnUrl = "check-records";
	if(isset($_REQUEST["returnUrl"])) {
		$returnUrl = $_REQUEST["returnUrl"];
	}

	// Get ID from update set page
	$id=$_REQUEST['id'];

	$idColumn = $recordsID;
	$datatable = $recordsTable;

	if($_POST["p50"] != 0.00 && $_POST["p50"] != NULL) {
		$p50 = $_POST["p50"];
		$query = "UPDATE $datatable SET p50='$p50' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p60"] != 0.00) {
		$p60 = $_POST["p60"];
		$query = "UPDATE $datatable SET p60='$p60' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p70"] != 0.00) {
		$p70 = $_POST["p70"];
		$query = "UPDATE $datatable SET p70='$p70' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p80"] != 0.00) {
		$p80 = $_POST["p80"];
		$query = "UPDATE $datatable SET p80='$p80' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p85"] != 0.00) {
		$p85 = $_POST["p85"];
		$query = "UPDATE $datatable SET p85='$p85' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p90"] != 0.00) {
		$p90 = $_POST["p90"];
		$query = "UPDATE $datatable SET p90='$p90' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p95"] != 0.00) {
		$p95 = $_POST["p95"];
		$query = "UPDATE $datatable SET p95='$p95' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}
	if($_POST["p100"] != 0.00) {
		$p100 = $_POST["p100"];
		$query = "UPDATE $datatable SET p100='$p100' WHERE $idColumn='$id'";
		$updateSet = mysqli_query($conn,$query);
	}

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		header("Location: /" . $returnUrl . "?recordUpdated=true");
    	exit();
	}
?>