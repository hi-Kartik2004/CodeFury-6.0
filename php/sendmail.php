<?php
ob_start(); // Start output buffering
error_reporting(0);

require_once("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


function sendVerificationMail($receiver)
{
    global $mail;
    $mail->SMTPDebug = 0; // Disable debug output
    $mail->SMTPDebug = false;

    // $baseurl = "http://localhost:3000/?verify=";
    $code = rand(1000, 9999);
    $subject = "Digital Clinic | Verification link inside!";
    $_SESSION["verification_code"] = $code;
    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'hi.kartikeyasaini@gmail.com'; // Gmail userid
        $mail->Password   = smtpPassword; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('hi.kartikeyasaini@gmail.com', 'Wardiere | Learn to Trade');
        $mail->addAddress($receiver); // Name is optional

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = 'Your verification Link is for User verification is <b>' . baseurl . $code . '</b> and is valid for the next 10 minutes only.';
        
        $result = $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    if ($result) {
        $_SESSION["err"]["err_msg"] = "Verification mail has been sent to your mail id";
        header("location:../?login");
    }
    return $code;
}

function sendForgotMail($receiver, $password)
{
    global $mail;
    $mail->SMTPDebug = 0; // Disable debug output
    $mail->SMTPDebug = false;

    // $baseurl = "http://localhost:3000/?verify=";
    $code = rand(1000, 9999);
    $subject = "Wardiere | Verification link inside!";
    $_SESSION["forgot_code"] = $code;
    try {
        // Server settings
        $mail->isSMTP(); // Send using SMTP
        $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'hi.kartikeyasaini@gmail.com'; // Gmail userid
        $mail->Password   = smtpPassword; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
        $mail->Port       = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        $mail->setFrom('hi.kartikeyasaini@gmail.com', 'Wardiere | Learn to Trade');
        $mail->addAddress($receiver); // Name is optional

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = 'Your Wardiere account password is <b>' . $password . '</b> If it was not you who generated this mail, contact support!';
        
        $result = $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    if ($result) {
        $_SESSION["err"]["err_msg"] = "Mail has been sent to your mail id";
        header("location:../?login");
    }
}

ob_end_clean(); // Clean the output buffer without displaying it
