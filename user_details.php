<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/10/17
 * Time: 12:06
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$active_client = $_SESSION['clientId'];

$sql = "SELECT  client_id, full_name, username, latitude, longitude from client WHERE client_id='$active_client'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$output = array();
$output[0] = $row["full_name"];
$output[1] = $row["username"];
$output[2] = $row["latitude"];
$output[3] = $row["longitude"];

echo json_encode($output);