<?php

$actionParam = new USER();
//user class stored in variable actionParam 

if(isset($_POST['btn-edit']))
{
 $wallet = trim($_POST['wallet']);
 $state = trim($_POST['state']);
 $phone = trim($_POST['phone']);
 $password = trim($_POST['password']);
 //check if password is correct
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id");
 $stmt->execute(array(":id"=>$uid));
 $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
 if($userRow['password']==md5($password))
 {
	 if($actionParam->update_user($uid,$wallet,$state,$phone))
     {
	   header("Location: profilesettings?updated");
       exit;
     }
 }
 else
 {
	  
    header("Location: profilesettings?incorrect-password");
    exit;
 }
}
?>
