<?php
$actionParam = new USER();
if (isset($_POST['btn_reg'])) {

  
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $account_id = USER::AlphaNumeric(5);
  $date = date("d/m/Y");
  $uemail = $email;
  
  if (isset($_POST['refemail'])) {
    // code...
    $refemail = $_POST['refemail'];
  }
  
  # check if referrer email exist

  if(!empty($refemail)){
  
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:remail");
    $stmt->execute(array(":remail" => $refemail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() == 0){
   
      header("Location: register?referral-email-error");
      
    }
  }

  # check if user email already exist
  $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
  $stmt->execute(array(":email" => $email));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($stmt->rowCount() > 0) {
    header("Location: register?register-email-error");
    exit;
  } else {
    # check if user accountID exist
    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE accountID=:acctid");
    $stmt->execute(array(":acctid" => $account_id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
      # if it exist create a new account_id
      $account_id = USER::AlphaNumeric(5);
    }
  }

  if ($actionParam->register_user($fullname, $email, $refemail, $password, $account_id, $date)){

    $stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE email=:email");
    $stmt->execute(array(":email" => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $id = base64_encode($row['userID']);

    $message = '
                 Hello '.$fullname.',<br> Your registration was successful. You have received a bonus of $10 which will be available in your wallet for 48 hours.
                 ';

    $subject = "Registration successful!";

    $actionParam->send_mail($email, $message, $subject);


    header("Location: login?email=$uemail&password=$password");
    exit;
  }

}
?>