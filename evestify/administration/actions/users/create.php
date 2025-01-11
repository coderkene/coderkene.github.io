<?php 
if(isset($_POST['btn-create']))
{
$fname = $_POST['fullname'];
$email = $_POST['email'];
$refemail = $_POST['refemail'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$country = $_POST['country'];
$wallet = $_POST['wallet'];
$bal = $_POST['bal'];
$date = date("d/m/Y");
$password = $_POST['password'];
$account_id = USER::AlphaNumeric(5);
 //check if referrer email exist
 if(!empty($refemail))
 {
	 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:remail");
     $stmt->execute(array(":remail"=>$refemail));
     $rrow = $stmt->fetch(PDO::FETCH_ASSOC);
     if($stmt->rowCount() == 0)
       {
         header("Location: createuser?referral-email-error");
         exit;
       }
 }
    
 //check if user email already exist 
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 if($stmt->rowCount() > 0)
   {
     header("Location: createuser?register-email-error");
     exit;
   }
   else
   {
       //check if user accountID exist
	  $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE accountID=:acctid");
      $stmt->execute(array(":acctid"=>$account_id));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  if($stmt->rowCount() > 0) 
      {
        //if it exist create a new account_id
        $account_id = USER::AlphaNumeric(5);
      }
       
       if($actionParam->create_user($fname,$email,$refemail,$state,$country,$phone,$wallet,$password,$bal,$date,$account_id))
       {
         header("Location: createuser?created");
         exit;
       }
   }
}
?>