<?php

if(isset($_GET['delete']) && isset($_GET['user']))
{
	$uid = base64_decode($_GET['user']);
    if($actionParam->delete_user($uid))
     {
      $actionParam->redirect('registeredusers?deleted');
     }
}
?>