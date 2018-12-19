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

$active_password = substr(md5(uniqid(mt_rand(), true)), 0, 8);

$escapedPW = mysqli_real_escape_string($conn, $active_password);
$salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
$saltedPW = $escapedPW.$salt;
$hashedPW = hash('sha256', $saltedPW);

$tempStr = $active_fullname/*.'-'.$active_password*/;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'email\PHPMailer\src\Exception.php';
require 'email\PHPMailer\src\PHPMailer.php';
require 'email\PHPMailer\src\SMTP.php';
$mail = new PHPMailer(true);

//Send mail using gmail
$mail->IsSMTP(); // telling the class to use SMTP
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "erbiumtest@gmail.com"; // GMAIL username //Must allow less secure apps option on google account to work
$mail->Password = "erbium123"; // GMAIL password

//Typical mail data
$mail->AddAddress($active_username, $active_fullname);
$mail->SetFrom("noreply@erbium.com", "Erbium No Reply");
$mail->Subject = "Erbium Registration";
$mail->Body = "Hi ".$active_fullname.".\n\nThis email serves to inform you your auto generated password to use for your initial login.\n"
    ."The password is: ".$active_password."\nLog in with your email and the password that has been provided to you";
try{
    $mail->Send();

    $sql = "INSERT INTO client(full_name, username, password, salt, latitude, longitude, Admin)
		VALUES ('$tempStr', '$active_username', '$hashedPW', '$salt','$active_latitude','$active_longitude', 0)";
    if($conn->query($sql) === true){
        echo "New user successfully added!\n";
    }
    else{
        echo $conn->error;
    }
} catch(Exception $e){
    echo "Fail - " . $mail->ErrorInfo;
}

$conn->close();


return;