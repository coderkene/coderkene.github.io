<?php
$actionParam = new USER();
//user class stored in variable actionParam
if(empty($_GET['id']) && empty($_GET['code']))
{
 $actionParam->redirect('index');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];
 
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id AND token_code=:code");
 $stmt->execute(array(":id"=>$id,":code"=>$code));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 $email = $row['email'];
 if($stmt->rowCount() == 1)
 {
  if(isset($_POST['btn-reset']))
  {
   $password = trim($_POST['password']);
   $password_encoded = md5($password);
 
    $stmt = $actionParam->runQuery("UPDATE tbl_user SET password=:password WHERE email=:email");
    $stmt->execute(array(":password"=>$password_encoded,":email"=>$email));
    
    $msg = "
	        <div class='alert' style='background-color: #3CB371; color: #fff; border-left-color: #fff;'>
            Your password has been successfully changed. You will soon be logged in
            </div>";
            header("refresh:5;login?email=$email&password=$password");
   
  } 
 }
 else
 {
  $actionParam->redirect('index');   
 }
 
 
}

?>