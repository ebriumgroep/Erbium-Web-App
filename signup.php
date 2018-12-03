<?php
/**
 * Created by PhpStorm.
 * User: hulis
 * Date: 2018/10/09
 * Time: 22:27
 */

include 'dbConnect.php';
$conn = connect_database();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$active_fullname = $_POST['fullname'];
$active_username = $_POST['username'];
$active_password = $_POST['password'];
$active_latitude = $_POST['clientLat'];
$active_longitude = $_POST['clientLong'];

if(strlen($active_password)<8){
    echo 'The password should be at least 8 characters long';
    exit();
}

$escapedPW = mysqli_real_escape_string($conn, $active_password);
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW = $escapedPW.$salt;
$hashedPW = hash('sha256', $saltedPW);

$sql = "INSERT INTO client(full_name, username, password, salt, latitude, longitude, Admin)
		VALUES ('$active_fullname', '$active_username', '$hashedPW', '$salt','$active_latitude','$active_longitude', 0)";

//echo $active_fullname.'-'.$active_username.'-'.$hashedPW.'-'.$salt;

if($conn->query($sql) === true){
    $conn->close();
    echo "New user successfully added!";
}
else{
    echo $conn->error;
    $conn->close();
}