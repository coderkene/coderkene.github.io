<?php
if(isset($_POST['btn-send']))//customise shope
{
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email_address = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
	
$message = "
           Hello,<br> You have a new message from $firstname $lastname. Users email is $email_address<br><br>MESSAGE:<br>$message
         ";

 $subject = "$subject";

 $email = 'maduikep@gmail.com';
 $actionParam->send_mail($email,$message,$subject);
$msg = "
      <div class='alert alert-suc'>
      <button class='close' data-dismiss='alert'>&times;</button>
      <span class='alert-text'>Your message has been sent, expect our reply soon.</span>
      </div>
      ";
return true;	
}
?>