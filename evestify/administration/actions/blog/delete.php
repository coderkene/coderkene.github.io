<?php

if(isset($_GET['delete']) && isset($_GET['post']))
{
	$uid = base64_decode($_GET['post']);
    if($actionParam->delete_post($uid))
     {
      $actionParam->redirect('viewpost?deleted');
     }
}
?>