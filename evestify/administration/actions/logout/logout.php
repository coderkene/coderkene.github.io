<?php
if(isset($_GET['logout']))
{
session_start();
unset($_SESSION['adminSession']);
session_unset();
session_destroy();
header("Location: ".$_SERVER['PHP_SELF']."");
exit;
}
?>