<?php 
	session_start();
	//Hulisani db
	//$db = mysqli_connect('localhost', 'id7227985_root', 'erbium', 'id7227985_erbium');
    //Anrich db
    $db = mysqli_connect('localhost', 'root', '', 'id7227985_erbium');
//$db = mysqli_connect('localhost', 'id7227985_root', 'erbium', 'id7227985_erbium'); //for actual db
	// initialize variables
	$client_id = 0;
	$token = "";
	$description = 0;
	$type = "";
	$Upload_Interval = "";
	$caught = 0;
	$tempCount = 0;
	$Battery_Percent = 0;
	$device_id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		
	}


	if (isset($_POST['update'])) {
		$device_id = $_POST['device_id'];
		$client_id = $_POST['client_id'];
		$token = $_POST['token'];
		$description = $_POST['description'];
		$type = $_POST['type'];
		$Upload_Interval = $_POST['Upload_Interval'];
		$caught = $_POST['caught'];
		$tempCount = $_POST['tempCount'];
		$Battery_Percent = $_POST['Battery_Percent'];

		mysqli_query($db, "UPDATE device SET client_id='$client_id', 
		description='$description', 
		token='$token', 
		trap_group='$type',
		Upload_Interval='$Upload_Interval',
		caught='$caught',
		tempCount='$tempCount',	
		Battery_Percent='$Battery_Percent'		
		WHERE device_id=$device_id");
		$_SESSION['message'] = "Trap updated!"; 
		header('location: viewTraps.php');
	}

if (isset($_GET['del'])) {
	$client_id = $_GET['del'];
	mysqli_query($db, "DELETE FROM device WHERE device_id=$device_id");
	$_SESSION['message'] = "Trap deleted!"; 
	header('location: viewTraps.php');
}


	$results = mysqli_query($db, "SELECT * FROM device");


?>