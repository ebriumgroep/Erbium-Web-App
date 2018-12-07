<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/07
 * Time: 13:27
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
//$active_client = $_SESSION['clientId'];
$active_client = 21;
$newEmail = $_POST['newEmail1'];

$sql = "UPDATE client
SET Battery_Percent = '$batteryLevel',
    signal_strength = '$signalStrength',
    data_available = '$bitErrorRate'
WHERE device_id = '$deviceID';";
$result = $conn->query($sql);