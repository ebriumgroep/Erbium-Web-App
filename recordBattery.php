<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/11/09
 * Time: 12:22
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = explode(",", file_get_contents("php://input"));
$deviceID = $data[0];
$batteryLevel = $data[1];

$sql = "UPDATE device
SET Battery_Percent = '$batteryLevel'
WHERE device_id = '$deviceID';";

if($conn->query($sql) === true){
    $conn->close();
    echo 'SUCCESS';
}
else{
    $conn->close();
    echo 'FAILURE';
}