<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	session_start();
	$active_client = $_SESSION['clientId'];
    $sql = "SELECT description, caught FROM device where client_id= '$active_client'";
    $result = $conn->query($sql);
	$jsonArray = array();
	if($result->num_rows > 0)
	{
        
		while ($row = $result->fetch_assoc()) {
			$trap_array = array();
			$trap_array['label'] = $row['description'];
			$trap_array['value'] = $row['caught'];
			array_push($jsonArray, $trap_array);
		}
	}
	$conn->close();
	
		echo json_encode($jsonArray);
	return;
?>
