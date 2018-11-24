<?php
    include 'dbConnect.php';
    $conn = connect_database();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo 'Value:'.$HTTP_RAW_POST_DATA;
    $data = explode(",", file_get_contents("php://input"));
    $timeStamp = $data[0];
    $deviceID = $data[1];
    $sql = "INSERT INTO temp_humid(temperature, humidity, time_stamp, device_id) 
            VALUES ('$data[2]','$data[3]','$timeStamp', '$deviceID')";

    if($conn->query($sql) === true){
        $sql = "UPDATE device
                SET tempCount = tempCount + 1
                WHERE device_id = '$deviceID';";
        $conn->query($sql);
        $conn->close();
        //echo "Successful";
        echo 'SUCCESS';
    }
    else{
        $conn->close();
        //echo "Not Successful";
        echo 'FAILURE';
    }
?>