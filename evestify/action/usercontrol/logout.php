<?php
if(isset($_GET['logout']))
{
session_start();
unset($_SESSION['userSession']);
session_unset();
session_destroy();
header("Location: ../../../../login");
exit;
}
?>