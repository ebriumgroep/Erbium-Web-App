<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/12/13
 * Time: 11:17
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function dateExists($date, $array2D){
    for ($i = 0; $i < count($array2D); $i++){
        if($array2D[$i]['label'] == $date)
            return true;
    }
    return false;
}

session_start();
//$active_client = 21;
$active_client = $_SESSION['clientId'];

//Get Device ID's of the current user
$sql = "SELECT device_id FROM device where client_id= '$active_client'";
$result = $conn->query($sql);
$deviceIDS = array();
$finalArray = array();
for ($i = 0; $i < $result->num_rows; $i++) {
    $row = $result->fetch_assoc();
    $deviceIDS[$i] = (int)$row['device_id'];
}
$deviceIDS_countable = $deviceIDS;
$deviceIDS = implode(', ', $deviceIDS);

//Get data from each tuple
if(count($deviceIDS_countable)>0){
    $sql = "SELECT * FROM temp_humid 
                where device_id IN ($deviceIDS)";
    $result = $conn->query($sql);

    //Run through each humidity row
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();

        $date = gmdate("d-m-Y", $row['time_stamp']);
        if(dateExists($date, $finalArray)){
            for ($j = 0; $j < count($finalArray); $j++) {
                if ($finalArray[$j]['label'] == $date) {
                    $finalArray[$j]['value']+= $row['humidity'];
                    $finalArray[$j]['numHumid']++;
                    break;
                }
            }
        }else{
            $tempArray = array();
            $tempArray['label'] = $date;
            $tempArray['value'] = $row['humidity'];
            $tempArray['numHumid'] = 1;
            array_push($finalArray, $tempArray);
        }
    }
}

//Compute Average
for ($i = 0; $i < count($finalArray); $i++){
    $finalArray[$i]['value'] = $finalArray[$i]['value']/$finalArray[$i]['numHumid'];
}


echo json_encode($finalArray);
$conn->close();
//	echo json_encode($jsonArray);
return;