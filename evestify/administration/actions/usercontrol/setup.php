<?php
$actionParam = new USER();
//user class stored in variable actionParam 

if($actionParam->admin_is_logged_in() !="")
{
    $user_id = $_SESSION['adminSession'];
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_admin WHERE userID=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $aid=$userRow['userID'];//taking the id to be used in some places
}
else
{
	$actionParam->redirect('login');
}
?>