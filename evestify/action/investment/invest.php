<?php
if(isset($_POST['btn-invest']))
{
 $amount = trim($_POST['amount']);
 $orderID = USER::Numeric(5);
 $date = date("d/m/Y");
 $start = strtotime("now");
 $plan = trim($_POST['plan']);


if($plan == 'trial'){

	$end = strtotime("+30 day");

} elseif($plan == 'premium' || $plan == 'crest'){

	$end == strtotime("+180 day");

} elseif($plan == 'essential'){

	$end == strtotime("+270 day");

} elseif ($plan == 'platinum'){

	$end = strtotime("+360 day");

} elseif($plan == 'koniglich'){

	$end = strtotime("+90 day");

}


 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id");
 $stmt->execute(array(":id"=>$uid));
 $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
 $fullname = $userRow['fullname'];

 if($plan == 'trial'){
     if($amount < 200 || $amount > 999){
         header("Location: invest?trial-error");
    exit; 
     }
 }elseif($plan == 'premium'){
     if($amount < 1000 || $amount > 4999){
         header("Location: invest?premium-error");
    exit; 
     }
 }elseif($plan == 'essential'){
     if($amount < 50000 || $amount > 25000){
         header("Location: invest?essential-error");
    exit; 
     }
 }elseif($plan == 'platinum'){
     if($amount < 26000 || $amount > 50000){
         header("Location: invest?platinum-error");
    exit; 
     }
 }elseif($plan == 'crest'){
	if($amount < 55000 || $amount > 499999){
		header("Location: invest?crest-error");
		exit;
	}
}elseif($plan == 'Königlich'){
     if($amount < 10000){
         header("Location: invest?Königlich-error");
    exit; 
     }
 }
    
 if($amount < 100)
 {
    header("Location: invest?invalid");
    exit; 
 }
    
 if($userRow['balance'] >= 100)
 {
   if($amount > $userRow['balance'])
   {
	   header("Location: invest?insufficient-balance");
       exit;
   }
   else
   {
	   if($actionParam->invest_funds($uemail,$amount,$orderID,$date,$start,$end,$plan))
       {
	        $message = "
                     Hello $fullname,
                     <br /><br />
                     You successfully scheduled an investment of $".number_format($amount).".<br>
                     Date placed: $date<br><br>
                     ";

                     $subject = "Investment started";
                     $email = $uemail;
                     $actionParam->send_mail_cron3($email,$message,$subject);//send mail to user
					 
					 header("Location: invest?success");
                     exit;
       }
   }
 }
 else
 {
	 header("Location: invest?low-funds");
     exit;
 }
	
}
?>