<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer\src\Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer\src\SMTP.php';
$mail = new PHPMailer(true);

//Send mail using gmail
//if($send_using_gmail){
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "erbiumtest@gmail.com"; // GMAIL username //Must allow less secure apps option on google account to work
    $mail->Password = "erbium123"; // GMAIL password
//}

//Typical mail data
$mail->AddAddress("anrich.moulder@gmail.com", "Anrich");
$mail->SetFrom("erbiumtest@gmail.com", "TEST");
$mail->Subject = "My Subject";
$mail->Body = "Mail contents";

try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    //Something went bad
    echo "Fail - " . $mail->ErrorInfo;
}

?>