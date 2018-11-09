<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	session_start();
	
	//$active_client = $_SESSION['clientId'];

//TODO

    $sql = "SELECT  client_id, full_name, username,latitude, longitude from client";
    $result = $conn->query($sql);
	
	if($result->num_rows > 0)
	{
        $client_array = array();
		while ($row = $result->fetch_assoc()) {
			# code...
			//echo $correct;
            $client_array[] = array($row["client_id"],
			$row["full_name"],$row["username"],$row["latitude"],
			$row["longitude"]);
		}
	}
	$conn->close();
	$json = json_encode($client_array,JSON_UNESCAPED_UNICODE);
	if ($json)
		echo $json;
	else
		echo json_last_error_msg();
	return;
?>