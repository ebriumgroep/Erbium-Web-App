<?php
    include '../dbConnect.php';
    $conn = connect_database();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //echo 'Value:'.$HTTP_RAW_POST_DATA;
    //data = <data-loss-flag>,<signal-strength>,<bit-error-rate>, <battery-percentage>,<device-id>,<date>
    $data = explode(",", file_get_contents("php://input"));

    if(count($data) != 6){
        echo '{FAILURE}';
        exit();
    }

    $data_loss_flag = $data[0];
    $signal_strength = $data[1];
    $bit_error_rate = $data[2];
    $battery_percentage = $data[3];
    $deviceID = $data[4];
    $timeStamp = $data[5];

    $sql = "INSERT INTO trap_count
            (time_stamp, device_id, data_loss_flag, signal_strength, bit_error_rate, battery_percentage) 
            VALUES ('$timeStamp', '$deviceID', '$data_loss_flag', '$signal_strength', '$bit_error_rate', '$battery_percentage')";

    if($conn->query($sql) === true){
        $sql = "UPDATE device
                SET caught = caught + 1
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