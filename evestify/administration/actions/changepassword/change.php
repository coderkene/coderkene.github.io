<?php
if(isset($_POST['btn-change']))
{
	$password = trim($_POST['newpassword']);
	$password_old = trim($_POST['oldpassword']);
	
	if($actionParam->change_password($aid,$password,$password_old))
     {
       header("Location: changepassword?password-changed");
       exit;
     }
	
}
?>