<?php
if(isset($_GET['mark']) && isset($_GET['id']))
{
    $id = base64_decode($_GET['id']);
	$stat = 1;
	//update withdrawal list
    $stmt = $actionParam->runQuery("UPDATE tbl_withdrawal SET status=:stats WHERE userID=:id");
    $stmt->bindparam(":id",$id);
    $stmt->bindparam(":stats",$stat);
    $stmt->execute();
    
    header("Location: withdrawal?marked");
    exit;
}
?>