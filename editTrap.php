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
$active_hardware = $_POST["hardware"];
$active_token = $_POST["token"];
$active_type = $_POST['type'];
$active_uploadInterval = $_POST['upload_interval'];

$sql = "UPDATE device
        SET hardware_id = '$active_hardware',
            token = '$active_token',
            type = '$active_type',
            Upload_Interval = '$active_uploadInterval'
        WHERE device_id = '$deviceID';";

if($conn->query($sql) === true){
    $conn->close();
    echo 1;
}else{
    $conn->close();
    echo 0;
}