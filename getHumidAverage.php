<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/11/09
 * Time: 12:04
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sum = 0.0;
$deviceID = $_POST["device_id"];
$validity_time = time() - 86400;

$sql = "SELECT  * from temp_humid where device_id = '$deviceID' AND time_stamp >= '$validity_time'";
$result = $conn->query($sql);
$size = $result->num_rows;
if($size > 0)
{
    while ($row = $result->fetch_assoc()) {
        $sum += $row["humidity"];
    }
    $conn->close();
    echo $sum/$size;

}else{
    $conn->close();
    echo $sum;
}
return;