<?php
if(isset($_POST['btn-submit']))
{
	$price_in_usd = trim($_POST['amount']);
	$coin = $_POST['coin'];
	$invoice_id = USER::AlphaNumeric(15);
	$price_for_coin = json_decode(file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=USD&convert=$coin&amount=$price_in_usd"), true);
	
	$price_in_coin = $price_for_coin['data']['quote']['"'.$coin.'"']['price'];
	
    $date = strtotime("now");
    $datee = date('d/m/Y'); 
    
    if($price_in_usd < 200)
    {
        header("Location: depositfunds?low-funds");
        exit;
    }
    
	if($actionParam->create_invoice($uemail,$invoice_id,$price_in_usd,$price_in_coin,$coin,$date))
     {
         $message = "
                     Hello admin,
                     <br /><br />
                     $ufullname wants to deposit $".number_format($price_in_usd)." equivalent to ".round(number_format($price_in_coin),4)." BTC.<br>
                     Date sent: $datee<br><br>
					 Confirm when received.
                     ";

                     $subject = "New deposit";
                     $email = 'info@investmentmasters.org';
                     $actionParam->send_mail_cron3($email,$message,$subject);//send mail to user
                     
       header("Location: deposit?amount=$price_in_usd&email=$uemail&coin=$coin");
       exit;
     }
	
}
?>