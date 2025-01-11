<?php

if(isset($_GET['confirm']) && isset($_GET['pay']))
{
	$uid = base64_decode($_GET['pay']);
	
	$stmt = $actionParam->runQuery("SELECT * FROM invoices WHERE userID=:id");
$stmt->execute(array(":id"=>$uid));
$inrow=$stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:id");
$stmt->execute(array(":id"=>$inrow['email']));
$inr=$stmt->fetch(PDO::FETCH_ASSOC);
$email = $inr['email'];
    if($actionParam->confirm($uid))
     {
         
         $message = '
                 Hello your deposit has been confirmed and your account credited.
                 ';

                 $subject = "Amount received";

                 $actionParam->send_maill($email,$message,$subject);
      $actionParam->redirect('confirm?confirmed');
     }
}
?>