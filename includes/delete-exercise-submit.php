<?php 
	include('php-global.php');
	require('db.php');

	$id=$_REQUEST['id'];
	$datatable = $recordsTable;
	$query = "DELETE FROM $datatable WHERE $recordsID=$id";
	if($conn->connect_error){
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$deleteResult = mysqli_query($conn,$query);
		header("Location: /manage-exercises?exerciseDeleted=true");
    	exit();
	}
?>