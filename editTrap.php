<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/10/29
 * Time: 21:40
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$deviceID = $_POST["device_id"];
$active_hardware = $_POST["description"];
$active_type = $_POST['type'];
$active_uploadInterval = $_POST['upload_interval'];
$active_latitude = $_POST["editTrapLat"];
$active_longitude = $_POST["editTrapLong"];

$sql = "UPDATE device
        SET description = '$active_hardware',
            trap_group = '$active_type',
            Upload_Interval = '$active_uploadInterval',
            latitude = '$active_latitude',
            longitude = '$active_longitude'
        WHERE token = '$deviceID';";

if($conn->query($sql) === true){
    $conn->close();
    header("Location:main.html");
}else{
    $conn->close();
    header("Location:main.html");
}