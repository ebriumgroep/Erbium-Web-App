<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/11/09
 * Time: 11:52
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sum = 0.0;
$deviceID = $_POST["device_id"];

$sql = "SELECT  * from temp_humid where device_id = '$deviceID'";
$result = $conn->query($sql);
$size = $result->num_rows;
if($size > 0)
{
    while ($row = $result->fetch_assoc()) {
        $sum += $row["temperature"];
    }
    $conn->close();
    echo $sum/$size;

}else{
    $conn->close();
    echo $sum;
}
return;