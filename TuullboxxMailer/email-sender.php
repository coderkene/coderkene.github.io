<?php

/**
 * This example shows how to send a message to a whole list of recipients efficiently.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);

date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';
include 'email-settings.php';

//Passing `true` enables PHPMailer exceptions
$mail = new PHPMailer(true);

$body = file_get_contents('email.html');

$mail->isSMTP();
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$mail->SMTPKeepAlive = true; //SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = $smtp_port;
$mail->SMTPSecure = $smtp_secure;
$mail->Username = $username;
$mail->Password = $password;
$mail->setFrom($set_from_email, $set_from_name);
$mail->addReplyTo($set_reply_email, $set_reply_name);

$mail->Subject = $mail_subject;

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = $mail_altbody;

//open email text file and add all emails to an array

$file = fopen("lists.txt","r");

    $result = array();
    while ($list = fgets($file) ) {
        $result[] = $list;
    }

fclose($file);
foreach ($result as $row) {
    try {
        $mail->addAddress($row);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row);
        continue;
    }
    //if (!empty($row['photo'])) {
        //Assumes the image data is stored in the DB
    //    $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');
    //}

    try {
        $mail->send();
        echo 'Message sent to :'. htmlspecialchars($row);
    } catch (Exception $e) {
        echo 'Mailer Error (' . htmlspecialchars($row) . ') ' . $mail->ErrorInfo;
        //Reset the connection to abort sending this message
        //The loop will continue trying to send to the rest of the list
        $mail->getSMTPInstance()->reset();
    }
    //Clear all addresses and attachments for the next iteration
    $mail->clearAddresses();
    //$mail->clearAttachments();
}
?>