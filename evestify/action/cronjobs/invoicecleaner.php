<?php
require_once '../../classconn/class.user.php';
//calculating users investment earnings
$actionParam = new USER();
//user class stored in variable actionParam
$today = strtotime("now");
//1. FIRST CODE
//retrieve users investment data
$stmt = $actionParam->runQuery("SELECT * FROM invoices");
$stmt->execute(array(":email"));
$invoiceRow=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($invoiceRow as $irow)
{
    $date = $irow['date'];
    $day1 = 86400;
    $stayedlong = $date + ($day1 * 2);
    $invoiceID = $irow['userID'];
    $address = $irow['address'];
    
    if($today >= $stayedlong)//code will execute if invoice is 2 days old
    {
        $stmt = $actionParam->runQuery("DELETE FROM invoices WHERE userID=:id");
        $stmt->execute(array(":id"=>$invoiceID));
        //delete 2 days old invoices
    }
}
?>