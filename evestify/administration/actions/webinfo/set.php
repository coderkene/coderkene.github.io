<?php 
if(isset($_POST['btn-set']))
{
$iid = $_POST['iid'];
$investors = $_POST['investors'];
$earnings = $_POST['earnings'];
$withdrawals = $_POST['withdrawals'];
$support = $_POST['support'];

       if($actionParam->set($iid,$investors,$earnings,$withdrawals,$support))
       {
         header("Location: websiteinfo?set");
         exit;
       }
}

if(isset($_POST['btn-deposit']))
{
$email = $_POST['email'];
$amount = $_POST['amount'];
$date = date('d/m/Y');
    
$stmt = $actionParam->runQuery("INSERT INTO tbl_deposite(email,amount,date)
    VALUES(:email, :amount, :date)");
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":amount",$amount);
   $stmt->bindparam(":date",$date);
   $stmt->execute();
    
 header("Location: websiteinfo?set");
 exit;
}

if(isset($_POST['btn-withdraw']))
{
$email = $_POST['email'];
$amount = $_POST['amount'];
$status = 1;
$orderID = USER::Numeric(5);
$date = date('d/m/Y');
    
$stmt = $actionParam->runQuery("INSERT INTO tbl_withdrawal(email,amount,orderID,status,date)
    VALUES(:email, :amount, :oid, :stats, :date)");
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":amount",$amount);
   $stmt->bindparam(":oid",$orderID);
   $stmt->bindparam(":stats",$status);
   $stmt->bindparam(":date",$date);
   $stmt->execute();
    
 header("Location: websiteinfo?set");
 exit;
}

?>