<?php 
if(isset($_POST['btn-save'])){
$uid = $_POST['uid'];
$fname = $_POST['fullname'];
$email = $_POST['email'];
$refemail = $_POST['refemail'];
$phone = $_POST['phone'];
$state = $_POST['state'];
$country = $_POST['country'];
$wallet = $_POST['wallet'];
$receive = $_POST['receive'];
$ltcadd = $_POST['ltcadd'];
$ethadd = $_POST['ethadd'];
$usdtadd = $_POST['usdtadd'];
$bnbadd = $_POST['bnbadd'];
$bal = $_POST['bal'];
$profit = $_POST['profit'];
$profit_total = $_POST['profit_total'];
$lastdeposite = $_POST['lastdeposite'];
$verification = $_POST['verification'];
$lastwithdraw = $_POST['lastwithdraw'];
$date = $_POST['date'];
$password = $_POST['pass'];
$uid = base64_decode($uid);
$stmt = $actionParam->runQuery("SELECT * FROM tbl_user WHERE userID=:id");
$stmt->execute(array(":id"=>$uid));
$urow = $stmt->fetch(PDO::FETCH_ASSOC);

if($password != $urow['password']){
    
    $password = md5($password);
    
    }
    
if($actionParam->edit_user($uid,$fname,$email,$refemail,$state,$country,$phone,$wallet,$receive,$ltcadd,$ethadd,$usdtadd,$bnbadd,$password,$bal,$profit,$profit_total,$lastdeposite,$verification,$lastwithdraw,$date)){    
    header("Location: registeredusers?edited");    
    exit;
    }
}
?>