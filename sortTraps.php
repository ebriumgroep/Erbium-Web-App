<?php
include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//session_start();
//    $active_client = $_SESSION['clientId'];
$active_client = 21;
$sortBy = $_POST['sortBy'];

//TODO

if($sortBy == 0)
    $sql = "SELECT  client_id, hardware_id, token, type, Upload_Interval, caught from device ORDER BY caught DESC;";
else if($sortBy == 1)
    $sql = "SELECT  client_id, hardware_id, token, type, Upload_Interval, caught , tempCount from device ORDER BY tempCount DESC;";

$result = $conn->query($sql);
$counter = 0;

if($result->num_rows > 0)
{
    $result_array = array();
    while ($row = $result->fetch_assoc()) {
        # code...
        if($row["client_id"] == $active_client)
        {
            $result_array[] = array($row["hardware_id"],$row["caught"],$row["type"],$row["Upload_Interval"]);
            //$returnedString .=  $row["hardware_id"].' '.$row["type"]."\n";
        }
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
