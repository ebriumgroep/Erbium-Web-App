<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/08
 * Time: 00:12
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
$active_token = $_POST["token"];

$active_description = $_POST["description"];
$active_trapGroup = $_POST['type'];
$active_uploadInterval = $_POST['upload_interval'];
$active_sensingInterval = $_POST['sensing_interval'];
$active_lat = $_POST['trapLat'];
$active_long = $_POST['trapLong'];


$sql = "UPDATE device
SET client_id = '$active_client',
    description = '$active_description',
    trap_group = '$active_trapGroup',
    latitude = '$active_lat', 
    longitude = '$active_long',
    Upload_Interval = '$active_uploadInterval',
    Sensing_Interval = '$active_sensingInterval'
WHERE token = '$active_token';";
$result = $conn->query($sql);

if($conn->affected_rows>0){
    echo "Linking successful!";
}else{
    echo "Token entered has no match!";
}