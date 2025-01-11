<?php
$actionParam = new USER();
//user class stored in variable actionParam
if(empty($_GET['id']))
{
 $actionParam->redirect('index');
}

if(isset($_GET['id']))
{
 $id = base64_decode($_GET['id']);
 
 $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id");
 $stmt->execute(array(":id"=>$id));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 $email = $row['email'];
 if($stmt->rowCount() == 1)
 {
   if($actionParam->confirm_email($email))
   {
     $msg = "
	        <div class='alert' style='background-color: seagreen; color: #fff; border-left-color: #fff;'>
	        <button class='close' data-dismiss='alert'>&times;</button>
            $email has been confirmed as your mail. You will be redirected to login
            </div>";
            header("refresh:5;login");
   }
 }
 else
 {
  $actionParam->redirect('index');   
 }
 
 
}

?>