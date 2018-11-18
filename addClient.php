<?php

	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	function phpAlert($msg){
		echo '<script type = "text/javascript">alert("'.$msg.'")</script>';
	}

	function phpLog($msg){
		echo '<script type = "text/javascript">console.log("'.$msg.'")</script>';
	}

	session_start();
	$active_client = $_SESSION['clientId'];
	$active_fullname = $_POST['fullname'];
	$active_username = $_POST['username']; 
	$active_password = $_POST['password'];
	//new
	$active_lat = $_POST['clientLat'];
	$active_long = $_POST['clientLong'];


	//just need to add the lat and long and hardware id to the location table as well
	$sql = "INSERT INTO client(full_name, username, password, latitude, longitude)
			VALUES ('$active_fullname','$active_username','$active_password','$active_lat','$active_long')";
			
	if ($conn->query($sql) === TRUE) {
    header("Location:viewClients.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>