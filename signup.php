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
$active_latitude = $_POST['latitude'];
$active_longitude = $_POST['longitude'];

/*if(strlen($active_password)<8){
    echo 'The password should be at least 8 characters long';
    exit();
}*/

$active_password = substr(md5(uniqid(mt_rand(), true)), 0, 8);

$escapedPW = mysqli_real_escape_string($conn, $active_password);
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW = $escapedPW.$salt;
$hashedPW = hash('sha256', $saltedPW);

$mailMessage = 'Hi '.$active_fullname.', your auto generated Erbium password is '.$active_password.'.';
$mailMessage = wordwrap($mailMessage, 70);
if(mail($active_username, "Erbium Registration", $mailMessage))
    echo "Sent";
else
    echo "Not sent";
return;

$tempStr = $active_fullname.'-'.$active_password;

//mail("hulisanimudimeli@gmail.com", "Erbium Something", "Hi bro");
$sql = "INSERT INTO client(full_name, username, password, salt, latitude, longitude, Admin)
		VALUES ('$tempStr', '$active_username', '$hashedPW', '$salt','$active_latitude','$active_longitude', 0)";

//echo $active_fullname.'-'.$active_username.'-'.$hashedPW.'-'.$salt;

if($conn->query($sql) === true){
    $mailMessage = 'Hi '.$active_fullname.', your auto generated Erbium password is '.$active_password.'.';
    $mailMessage = wordwrap($mailMessage, 70);
    mail($active_username, "Erbium Registration", $mailMessage);

    $conn->close();
    echo "New user successfully added!";
}
else{
    echo $conn->error;
    $conn->close();
}
return;