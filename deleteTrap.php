<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/10/17
 * Time: 13:53
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hardwareID = $_GET["token"];
$sql = "DELETE FROM device WHERE token='$hardwareID'";
$result = $conn->query($sql);

echo $result;