<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/07
 * Time: 14:52
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$active_client = $_SESSION['clientId'];
//$active_client = 21;
$newInterval = $_POST['newSensing'];

$sql = "UPDATE device
SET Sensing_Interval = '$newInterval'
WHERE client_id = '$active_client';";
$result = $conn->query($sql);

if($result === true){
    echo 'Successful';
}else{
    echo $conn->error;
}

$conn->close();