<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	session_start();
	$active_client = $_SESSION['clientId'];

	//TODO

    $sql = "SELECT * from device where client_id = '$active_client'";
    $result = $conn->query($sql);
    $counter = 0;
	
	if($result->num_rows > 0)
	{
        $result_array = array();
		while ($row = $result->fetch_assoc()) {
            $result_array[] = array($row["hardware_id"],$row["caught"],$row["type"],$row["Upload_Interval"],$row["Battery_Percent"], $row["device_id"]);
            //$returnedString .=  $row["hardware_id"].' '.$row["type"]."\n";
            $counter = $counter + 1;
		}
	}
	$conn->close();
	// echo "string";
    echo json_encode($result_array);
	return;
    // echo "data";
    // $json_array = json_encode($result_array);
    // phpLog($returnedString);
	//echo ($returnedString);

?>