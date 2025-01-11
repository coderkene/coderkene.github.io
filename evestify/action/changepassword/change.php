<?php
if(isset($_POST['btn-change']))
{
	$password = trim($_POST['newpassword']);
	$password_old = trim($_POST['oldpassword']);
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
	if($actionParam->change_password($uid,$password,$password_old,$phone,$address))
     {
       header("Location: profilesettings?password-changed");
       exit;
     }
	
}
?>