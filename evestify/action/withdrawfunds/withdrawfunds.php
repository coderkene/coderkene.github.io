<?php

if(isset($_POST['btn-withdraw'])){

 $amount = $_POST['amount'];
 $coin = $_POST["coin"];
 $desc = $_POST["coinaddress"];
 $orderID = USER::Numeric(5);
 $date = date("d/m/Y");
 
#
 
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id");
 $stmt->execute(array(":id"=>$uid));
 $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
 
#
 
 $fullname = $userRow['fullname'];
 
 if($amount < 200){
    header("Location: withdraw?withdrawal-limit");
    exit;
 }else{
 
 
//Convert crypto balances to usd

  $btcprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=BTC&convert=USD&amount=" .$userRow['btc_balance']);

  $price_in_btc = json_decode($btcprice, true);

  $ltcprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=LTC&convert=USD&amount=" .$userRow['litecoin_balance']);

  $price_in_ltc = json_decode($ltcprice, true);

  $ethprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=ETH&convert=USD&amount=" .$userRow['ethereum_balance']);

  $price_in_eth = json_decode($ethprice, true);

  $usdtprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=USDT&convert=USD&amount=" .$userRow['usdt_balance']);

  $price_in_usdt = json_decode($usdtprice, true);

  $bnbprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=BNB&convert=USD&amount=" .$userRow['bnb_balance']);

  $price_in_bnb = json_decode($bnbprice, true);

// calculating the total balance in USD

  $total_balance = $userRow['balance'] + $price_in_btc['data']['quote']['USD']['price'] + $price_in_ltc['data']['quote']['USD']['price'] + $price_in_eth['data']['quote']['USD']['price'] + $price_in_usdt['data']['quote']['USD']['price'] + $price_in_bnb['data']['quote']['USD']['price'];

 }
 
 if($coin == 'btc'){
   
   $coin_bal = $price_in_btc['data']['quote']['USD']['price'];
   
 }elseif($coin == 'ltc'){
 
   $coin_bal = $price_in_ltc['data']['quote']['USD']['price'];

 }elseif($coin == 'eth'){
 
   $coin_bal = $price_in_eth['data']['quote']['USD']['price'];
   
 }elseif($coin == 'usdt'){
 
   $coin_bal = $price_in_usdt['data']['quote']['USD']['price'];
 
 }elseif($coin == 'bnb'){
     
   $coin_bal = $price_in_bnb['data']['quote']['USD']['price'];
 }
 
 
 if($amount < 200){
   
       header("Location: withdraw?insufficient-balance");
       exit;
   }else{
   
	   if($actionParam->withdraw_funds($uemail,$amount,$desc,$coin,$coin_bal,$orderID,$date)){
	   
	        $message = "
                     Hello $fullname,
                     <br /><br />
                     You successfully sent $".number_format($amount)." ".$coin.".<br>
                     Receiver: $desc<br>
                     Date sent: $date<br><br>Awaiting confirmation.";

                     $subject = "".$coin." sent";
                     
                     $email = $uemail;
                     
                     $message2 = "Hello admin,
                        <br/><br/>
                        $fullname just sent $".number_format($amount)." ".$coin."<br>
                        Receiver: $desc<br>
                        Date sent: $date<br><br>
		        Please complete the transaction.";

                     $subject2 = "".$coin." sent";
                     
                     $email2 = 'info@investmentmasters.org';
                     
                     
   if($actionParam->send_mail_cron3($email,$message,$subject)||$actionParam->send_mail_cron4($email2,$message2,$subject2)){
       
        header("Location: withdraw?success");
        exit;
        
     }else{
     
     header("Location: withdraw?success");
    exit;
  }
 }
 }
 }
 
 
?>