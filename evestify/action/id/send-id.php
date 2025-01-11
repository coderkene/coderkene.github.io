<?php

if(isset($_POST['btn-verify'])){
    
    $front = $_FILES['front']['tmp_name'];
    $back = $_FILES['back']['tmp_name'];
    $selfie = $_FILES['selfie']['tmp_name'];
    $user = $_POST['user'];
    $message = 'Verification files from "'.$user.'"';
    
if($actionParam->send_verification($front,$back,$selfie,$user,$message)){
    
    $stmt = $actionParam->runQuery("UPDATE verification=1 FROM tbl_user WHERE email=:id");
    $stmt->execute(array(":id"=>$user));
 
 header("Location: profilesettings?upload-successful");
 exit;
}
}
?>    
    