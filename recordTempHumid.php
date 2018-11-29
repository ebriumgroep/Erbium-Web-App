<?php
    include 'dbConnect.php';
    $conn = connect_database();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo 'Value:'.$HTTP_RAW_POST_DATA;
    //data = <data-loss-flag>,<signal-strength>,<bit-error-rate>, <battery-percentage>,<device-id>,<date>,<temperature>, [<humidity>]
    $data = explode(",", file_get_contents("php://input"));

    $data_loss_flag = $data[0];
    $signal_strength = $data[1];
    $bit_error_rate = $data[2];
    $battery_percentage = $data[3];
    $deviceID = $data[4];
    $timeStamp = $data[5];
    $temperature = $data[6];
    $humidity = 0;

    if(count($data)>7)
        $humidity = $data[7];

    $sql = "INSERT INTO temp_humid
                (temperature, humidity, time_stamp, device_id, data_loss_flag, signal_strength, bit_error_rate, battery_percentage) 
                VALUES ('$temperature', '$humidity', '$timeStamp', '$deviceID', '$data_loss_flag', '$signal_strength', '$bit_error_rate', '$battery_percentage')";

    if($conn->query($sql) === true){
        $sql = "UPDATE device
                SET tempCount = tempCount + 1
                WHERE device_id = '$deviceID';";
        $conn->query($sql);
        $conn->close();
        //echo "Successful";
        echo '{SUCCESS}';
    }
    else{
        $conn->close();
        //echo "Not Successful";
        echo '{FAILURE}';
    }
?>