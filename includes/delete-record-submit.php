<?php 
	include("php-global.php");
	require('db.php');
	$returnUrl = "check-records";
	if(isset($_REQUEST["returnUrl"])) {
		$returnUrl = $_REQUEST["returnUrl"];
	}

	// Get ID from update set page
	$id=$_REQUEST['id'];
	// Get update record ID
	if(isset($_REQUEST["recordUpdate"])) {
		$updateID = $_REQUEST["recordUpdate"];
	}

	$idColumn = $recordsID;
	$datatable = $recordsTable;

	// Get which record to change
	if(isset($_REQUEST["recordDelete"])) {
		$recordDelete = $_REQUEST["recordDelete"];
	}
	
	$query = "UPDATE $datatable SET $recordDelete=NULL WHERE $idColumn='$id'";

	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$updateSet = mysqli_query($conn,$query);
		header("Location: /" . $returnUrl . "?recordUpdated=true&id=" . $updateID);
    	exit();
	}
?>