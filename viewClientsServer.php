<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'id7227985_erbium');

	// initialize variables
	$full_name = "";
	$username = "";
	$latitude = 0;
	$longitude = 0;
	$client_id = 0;
	$admin = 0;
	$update = false;

	if (isset($_POST['save'])) {
		
	}


	if (isset($_POST['update'])) {
		$client_id = $_POST['client_id'];
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$admin = $_POST['admin'];

		mysqli_query($db, "UPDATE client SET full_name='$full_name', username='$username', latitude='$latitude', longitude='$longitude', Admin='$admin' WHERE client_id=$client_id");
		$_SESSION['message'] = "Client updated!"; 
		header('location: viewClients.php');
	}

if (isset($_GET['del'])) {
	$client_id = $_GET['del'];
	mysqli_query($db, "DELETE FROM client WHERE client_id=$client_id");
	$_SESSION['message'] = "Client deleted!"; 
	header('location: viewClients.php');
}


	$results = mysqli_query($db, "SELECT client_id, full_name, username, latitude, longitude, Admin FROM client");


?>