<?php
require_once '../../classconn/class.user.php';
//calculating users investment earnings
$actionParam = new USER();
//user class stored in variable actionParam
$today = strtotime("now");
//1. FIRST CODE
//retrieve users investment data
$stmt = $actionParam->runQuery("SELECT * FROM tbl_investment");
$stmt->execute(array(":email"));
$calculatorRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($calculatorRow as $crow)
{
    $start = $crow['start'];
    $daily = 86400;
    $day1 = $start + $daily;
    $investID = $crow['userID'];
    $orderID = $crow['orderID'];
    $email = $crow['email'];
    $profit = $crow['daily_profit'];
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
    $stmt->execute(array(":email"=>$email));
    $useRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $fullname = $useRow['fullname'];
    if($crow['status'] == 0)
    {
       if($today >= $day1)//code will start running after day investment was started
       {
          if($actionParam->update_earnings($email,$investID,$orderID))
          {
               $message = "
                      Hello $fullname,
                      <br /><br />
                      The investment you placed has yielded profit of <br> $".number_format($profit)." today.<br>
                      Login to your dashboard to see your daily profit.<br>
                      You keep earning daily until your investment is <br> complete.<br><br>
                     ";

                     $subject = "Your profit today";
                     $actionParam->send_mail_cron2($email,$message,$subject);//send mail to user
          }
       }
    }
}

//2. SECOND CODE
//retrieve all users investment data
$stmt = $actionParam->runQuery("SELECT * FROM tbl_investment");
$stmt->execute(array(":email"));
$monitorRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($monitorRow as $mrow)
{
    $investID = $mrow['userID'];
    $orderID = $mrow['orderID'];
    $email = $mrow['email'];
    $amount = $mrow['amount_invested'];
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
    $stmt->execute(array(":email"=>$email));
    $useRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $fullname = $useRow['fullname'];
    if($mrow['status'] == 0)//running investments
    {
        if($today >= $mrow['end'])
        {
           if($actionParam->end_invest($investID))
           {
               $message = "
                     Hello $fullname,
                     <br /><br />
                     Your scheduled investment of $".number_format($amount)."<br>
                     is complete. Your capital and profit has both been added<br>
                     back to your wallet.<br>
                     ORDER ID: $orderID<br><br>
                     ";

                     $subject = "Investment schedule complete";
                     $actionParam->send_mail_cron2($email,$message,$subject);//send mail to user
           }
        }
    }
}

//3. THIRD CODE
//this code is to remove $5 bonus if no deposit within 2 days
$stmt = $actionParam->runQuery("SELECT * FROM tbl_user");
$stmt->execute(array(":email"));
$userRow=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($userRow as $crow)
{
    $start = $crow['start'];
    $daily = 86400;
    $daily2 = $daily * 2; 
    $day2 = $start + $daily2;
    $userID = $crow['userID'];
    $email = $crow['email'];
    $empty = 0;
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
    $stmt->execute(array(":email"=>$email));
    $useRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $fullname = $useRow['fullname'];
    
    //first check if start is empty
   if($crow['start'] != 0)
   {
       if($today >= $day2)//code will run after 2 days
       {
          if($crow['balance'] <= 5) 
          {
              if($actionParam->remove_bonus($email,$userID,$empty))
              {
                   $message = "
                          Hello $fullname,
                          <br /><br />
                          In respect to your delay in funding your wallet, your bonus of $5 has been removed.<br>
                          You can still fund your wallet to start an investment plan or to store your bitcoin.
                         ";

                         $subject = "Bonus removed";
                         $actionParam->send_mail_cron2($email,$message,$subject);//send mail to user
              }
          }
          else
          {
               $actionParam->remove_start($email,$userID,$empty);
          }
       }
   }
}
?>