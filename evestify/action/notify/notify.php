<?php

$sendemail = $_GET['email'];
$amt = $_GET['amount'];
$coin = $_GET['coin'];


$message = "Hello admin,
            <br /><br />
            $sendemail wants to deposit $".number_format($amt)." $coin.<br>
            <br><br>
			Confirm when received.";
            $subject = "New deposit";
            $email = 'info@investmentmasters.org';
            $actionParam->send_mail_cron3($email,$message,$subject);//send mail to user





?>