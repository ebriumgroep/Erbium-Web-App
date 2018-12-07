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
	$active_token = $_POST["token"];
	//$active_token = 0;
	$active_description = $_POST["description"];
	$active_type = $_POST['type'];
	$active_uploadInterval = $_POST['upload_interval'];
    $active_sensingInterval = $_POST['sensing_interval'];
	//new
	$active_lat = $_POST['trapLat'];
	$active_long = $_POST['trapLong'];


	//just need to add the lat and long and hardware id to the location table as well
	$sql = "INSERT INTO device(client_id, token, description, trap_group, Upload_Interval, Sensing_Interval,caught,
            tempCount,latitude,longitude)
			VALUES ('$active_client','$active_token', '$active_description', '$active_type','$active_uploadInterval',
			'$active_sensingInterval', 0, 0,'$active_lat','$active_long')";

	$fullname = $_SESSION['fullname'];

	if($conn->query($sql) === true){
		$conn->close();
		header("Location:main.html");
		// echo "<script>
		// window.location.href = 'main.php';
	  // </script>";
		die();
	}
	else{
		$conn->close();
		echo "Please fill all fields.....!!!!!!!!!!!!";
        echo "Error: " . $sql . "<br>" . $conn->error;
		// echo "<script>
		// window.location.href = 'addTrap.html';
	  // </script>";
		die();
	}

?>