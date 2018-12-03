<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/11/14
 * Time: 18:13
 */

include '../dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$token = file_get_contents("php://input");
$sql = "SELECT token, device_id
FROM device
WHERE token = '$token';";
$result = $conn->query($sql);
$size = $result->num_rows;

if($size > 0){
    $row = $result->fetch_assoc();
    $conn->close();
    echo '{'.$row["device_id"].'}';
}
else{
    $conn->close();
    echo '{FAILURE}';
}