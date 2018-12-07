<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/07
 * Time: 14:15
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
$newLatitude = $_POST['newLatitude'];
$newLongitude = $_POST['newLongitude'];

$sql = "UPDATE client
SET latitude = '$newLatitude',
    longitude = '$newLongitude'
WHERE client_id = '$active_client';";
$result = $conn->query($sql);

if($result === true){
    echo 'Successful';
}else{
    echo $conn->error;
}

$conn->close();