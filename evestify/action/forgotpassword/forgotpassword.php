<?php

$actionParam = new USER();
//user class stored in variable actionParam
if(isset($_POST['btn-forgotpw']))
{
 $email = $_POST['email'];
 
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $code = md5(uniqid(rand()));
  $id = base64_encode($row['userID']);
  $fullname = $row['fullname'];
	 
  $stmt = $actionParam->runQuery("UPDATE tbl_user SET token_code=:code WHERE email=:email");
  $stmt->execute(array(":code"=>$code,"email"=>$email));
  
  $message= "
       Hello , $fullname
       <br /><br />
       Hello, we got a request to reset your password. If you made this request<br />
       please click the following link to reset your password, ignore if you did not make<br>
       this request.
       <br /><br />
       <a href='https://bitclubinvest.net/passwordreset?id=$id&code=$code'>click here to reset your password</a>
       <br />
       ";
  $subject = "Password reset";
  
  $actionParam->send_mail($email,$message,$subject);
  
  $msg = "<div class='alert' style='background-color: #3CB371; color: #fff; border-left-color: #fff;'>
	     We've sent a mail to $email.
         Please click on the password reset link in the email to generate a new password.
         </div>";
 }
 else
 {
  $msg = "
       <div class='alert' style='background-color: #DC143C; color: #fff; border-left-color: #fff;'>
	   Sorry, this email does not exist.
       </div>";
 }
}

?>