<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/07
 * Time: 23:37
 */

include '../dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo 'Value:'.$HTTP_RAW_POST_DATA;
$token = file_get_contents("php://input");

$sql = "INSERT INTO device(token) VALUES ('$token')";

if($conn->query($sql) === true){
    echo '{SUCCESS}';
}
else{
    echo $conn->error;
}
$conn->close();
