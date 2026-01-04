<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require __DIR__ . '/../vendor/autoload.php';
$mail = new PHPMailer(true);
//$mail->SMTPDebug  = 1;
$mail->isSMTP();
$mail->Host = 'raltera-be.mail.protection.outlook.com';
$mail->Port       = 25;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = false;
$mail->Username = 'bob.claerhout@raltera.be';
$mail->SetFrom('info@raltera.be', 'Contact form Raltera');
$mail->addReplyTo($_POST['email'], $_POST['name']);
$mail->addAddress('info@raltera.be', 'Raltera info');
//$mail->SMTPDebug  = 3;
//$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
$mail->IsHTML(true);

$mail->Subject = $_POST['subject'];
$mail->Body    = $_POST['message'];

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'OK';
}