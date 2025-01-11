<?php
$actionParam = new USER();
//user class stored in variable actionParam 

if($actionParam->user_is_logged_in() !="")
{
    $user_id = $_SESSION['userSession'];
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $uid=$userRow['userID'];//taking the id to be used in some places
	$uemail=$userRow['email'];//taking the email to be used in some places
	$ufullname=$userRow['fullname'];//taking the fullname to be used in some places
}
else
{
	$actionParam->redirect('../index');
}
?>