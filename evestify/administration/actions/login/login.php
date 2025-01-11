<?php

$actionParam = new USER();
//user class stored in variable actionParam

if(isset($_POST['btn-login']))
{
 $username = trim($_POST['username']);
 $password = trim($_POST['password']);

 if($actionParam->login_admin($username,$password))
 {
     $actionParam->redirect('index');
 }
 else
 {
  $msg = "
      <div class='alert alert-dan'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <span class='alert-text'>sorry, incorrect username or password</span>
      </div>
      ";
 }
}
?>
