<?php
//user timer
if(!isset($_SESSION['countdown'])){
    //Set the countdown to 1800 seconds i.e 30mins.
    $_SESSION['countdown'] = 1800;
    //Store the timestamp of when the countdown began.
    $_SESSION['time_started'] = time();
}
 
//Get the current timestamp.
$now = time();
 
//Calculate how many seconds have passed since
//the countdown began.
$timeSince = $now - $_SESSION['time_started'];
 
//How many seconds are remaining?
$remainingSeconds = abs($_SESSION['countdown'] - $timeSince);
 
//Print out the countdown.
//Check if the countdown has finished.
if($remainingSeconds > 1800){
//Finished! Do something.
 session_start();
 if (!isset($_SESSION['adminSession'])) {
  header("Location: login");
 } else if(isset($_SESSION['adminSession'])!="") {
  header("Location: login");
 }
 
  unset($_SESSION['adminSession']);
  session_unset();
  session_destroy();
  header("Location: login");
  exit;
}
//end timer
?>