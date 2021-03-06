<?php
	include 'dbConnect.php';
	$conn = connect_database();
	// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	session_start();
    $sql = "SELECT  device_id,client_id,token,description,trap_group,Upload_Interval,Battery_Percent,latitude,longitude from device ORDER BY client_id ASC";
    $result = $conn->query($sql);
	
	if($result->num_rows > 0)
	{
        $trap_array = array();
		while ($row = $result->fetch_assoc()) {
            $trap_array[] = array($row["device_id"],$row["client_id"],
			$row["token"],$row["description"],$row["trap_group"],$row["Upload_Interval"],
			$row["Battery_Percent"],$row["latitude"],$row["longitude"]);
		}
	}
	$conn->close();
	$json = json_encode($trap_array,JSON_UNESCAPED_UNICODE);
	if ($json)
		echo $json;
	else
		echo json_last_error_msg();
	return;
?>