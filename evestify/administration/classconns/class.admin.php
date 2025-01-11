<?php

require_once 'dbconfig.php';

class USER
{

 private $conn;

 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }

 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }

 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }


 public function login_admin($username,$password)//login admin
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_admin WHERE username=:uname");
   $stmt->execute(array(":uname"=>$username));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

   if($stmt->rowCount() == 1)
   {
     if($userRow['password']==md5($password))
     {
      $_SESSION['adminSession'] = $userRow['userID'];
      return true;
     }
     else
     {
      header("Location: login?login-password-error");
      exit;
     }
   }
   else
   {
    header("Location: login?login-username-error");
    exit;
   }
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }

 public function admin_is_logged_in()
 {
  if(isset($_SESSION['adminSession']))
  {
   return true;
  }
 }

 public function redirect($url)
 {
  header("Location: $url");
 }

 public function logout_admin()
 {
  session_destroy();
  $_SESSION['adminSession'] = false;
 }
	
public static function Numeric($length)
 {
   $chars = "123456789";
   $clen   = strlen( $chars )-1;
   $id  = '';

   for ($i = 0; $i < $length; $i++) {
        $id .= $chars[mt_rand(0,$clen)];
       }
      return ($id);
 }
	
  public static function AlphaNumeric($length)
  {
          $chars = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
          $clen   = strlen( $chars )-1;
          $id  = '';

          for ($i = 0; $i < $length; $i++) {
                  $id .= $chars[mt_rand(0,$clen)];
          }
          return ($id);
  }
	
public function create_user($fname,$email,$refemail,$state,$country,$phone,$wallet,$password,$bal,$date,$account_id)//create a new user
 {
  try
  {
   $password=md5($password);
   $confirm=1;
   $stmt = $this->conn->prepare("INSERT INTO tbl_user(fullname,email,ref_email,state,country,phone,wallet_address,password,balance,accountID,date,confirm)
    VALUES(:fname, :email, :remail, :state, :country, :phone, :wallet, :pass, :bal, :acct, :date, :cfm)");
   $stmt->bindparam(":fname",$fname);
   $stmt->bindparam(":email",$email);
   $stmt->bindparam(":remail",$refemail);
   $stmt->bindparam(":state",$state);
   $stmt->bindparam(":country",$country);
   $stmt->bindparam(":phone",$phone);
   $stmt->bindparam(":wallet",$wallet);
   $stmt->bindparam(":pass",$password);
   $stmt->bindparam(":bal",$bal);
   $stmt->bindparam(":acct",$account_id);
   $stmt->bindparam(":date",$date);
   $stmt->bindparam(":cfm",$confirm);
   $stmt->execute();
   
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
	
public function edit_user($uid,$fname,$email,$refemail,$state,$country,$phone,$wallet,$receive,$ltcadd,$ethadd,$usdtadd,$bnbadd,$password,$bal,$profit,$profit_total,$lastdeposite,$verification,$lastwithdraw,$date)//edit an existing user
    {
        try
        {
            $stmt = $this->conn->prepare("UPDATE tbl_user SET fullname=:fname,email=:email,ref_email=:remail,state=:state,country=:country,phone=:phone,wallet_address=:wallet,address_given=:receive,ltc_given=:ltc,eth_given=:eth,usdt_given=:usdt,bnb_given=:bnb,password=:pass,balance=:bal,profit=:profit,profit_total=:profittotal,last_deposite=:lastdep,verification =:verification,last_withdrawal=:lastwith,date=:date WHERE userID=:id");
            $stmt->bindparam(":id",$uid);
            $stmt->bindparam(":fname",$fname);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":remail",$refemail);
            $stmt->bindparam(":state",$state);
            $stmt->bindparam(":country",$country);
            $stmt->bindparam(":phone",$phone);
            $stmt->bindparam(":wallet",$wallet);
            $stmt->bindparam(":receive",$receive);
            $stmt->bindparam(":ltc",$ltcadd);
            $stmt->bindparam(":eth",$ethadd);
            $stmt->bindparam(":usdt",$usdtadd);
            $stmt->bindparam(":bnb",$bnbadd);
            $stmt->bindparam(":pass",$password);
            $stmt->bindparam(":bal",$bal);
            $stmt->bindparam(":profit",$profit);
            $stmt->bindparam(":profittotal",$profit_total);
            $stmt->bindparam(":lastdep",$lastdeposite);
            $stmt->bindparam(":verification",$verification);
            $stmt->bindparam(":lastwith",$lastwithdraw);
            $stmt->bindparam(":date",$date);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
	
 public function delete_user($uid)//delete a user
    {
        try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_user WHERE userID=:id");
            $stmt->execute(array(":id"=>$uid));

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
public function confirm($uid)//delete a user
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM invoices WHERE userID=:id");
           $stmt->execute(array(":id"=>$uid));
           $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
           $tnxid = $userRow['email'];
           $email = $userRow['email'];
           $itemAmount = $userRow['price_in_usd'];

       //update users deposite here
       $stmt = $this->conn->prepare("UPDATE tbl_user SET last_deposite=:last WHERE email=:email");
       $stmt->bindparam(":last",$itemAmount);
       $stmt->bindparam(":email",$email);
       $stmt->execute();
       
       $pa = 1;
       //update users deposite here
       $stmt = $this->conn->prepare("UPDATE invoices SET paid=:paid WHERE userID=:id");
       $stmt->bindparam(":paid",$pa);
       $stmt->bindparam(":id",$uid);
       $stmt->execute();
     
       $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
       $stmt->execute(array(":email"=>$email));
       $uRow=$stmt->fetch(PDO::FETCH_ASSOC);
       $refemail = $uRow['ref_email'];
       $refpay = $uRow['ref_pay'];
       //get users profit first then add daily profit to it
       $bal = $uRow['balance'];
       $newbal = $bal + $itemAmount;
       //update users balance here
       $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:bal WHERE email=:email");
       $stmt->bindparam(":bal",$newbal);
       $stmt->bindparam(":email",$email);
       $stmt->execute();
       //insert deposite into deposite history
       $date = date("d/m/Y");
       $stmt = $this->conn->prepare("INSERT INTO tbl_deposite(email,amount,date)
       VALUES(:email, :amt, :date)");
       $stmt->bindparam(":email",$email);
       $stmt->bindparam(":amt",$itemAmount);
       $stmt->bindparam(":date",$date);
       $stmt->execute();
       //reward user's referrer if user has a referrer
       if(!empty($refemail))
        {
          if($refpay == 0)
           {
	          $pay = 1;
              $percent = 10/100;
	          $pay_amt = $percent * $itemAmount;
	          //select the exact referrer
              $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
              $stmt->execute(array(":email"=>$refemail));
              $refrow = $stmt->fetch(PDO::FETCH_ASSOC);
	          $bal = $refrow['balance'];
              $newbal = $bal + $pay_amt;
	          //calculate and update referrer's account balance
              $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:amt WHERE email=:email");
              $stmt->execute(array(":email"=>$refemail,":amt"=>$newbal));
	          //set users ref pay to 0, referral bonus is continuous
	          $stmt = $this->conn->prepare("UPDATE tbl_user SET ref_pay=:pay WHERE email=:email");
              $stmt->execute(array(":email"=>$email,":pay"=>$pay));
              
              $date = date("d/m/Y");
              $type = 'Referral bonus';
              //insert earnings into earning history
              $stmt = $this->conn->prepare("INSERT INTO tbl_earning(email,amount,type,date)
              VALUES(:email, :amt, :type, :date)");
              $stmt->bindparam(":email",$refemail);
              $stmt->bindparam(":amt",$pay_amt);
              $stmt->bindparam(":type",$type);
              $stmt->bindparam(":date",$date);
              $stmt->execute();
           }
        }
   
   return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

public function change_password($aid,$password,$password_old)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_admin WHERE userID=:id");
   $stmt->execute(array(":id"=>$aid));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	  
   if($userRow['password'] == md5($password_old))
    {
	     $password = md5($password);
	     $stmt = $this->conn->prepare("UPDATE tbl_admin SET password=:password WHERE userID=:id");
         $stmt->execute(array(":password"=>$password,":id"=>$aid));
    }
   else
    {
	   header("Location: changepassword?incorrect-password");
       exit;
    }
       return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }	
    
public function create_post($image,$title,$text,$date)//create a new blog post
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_blog WHERE title=:title");
   $stmt->execute(array(":title"=>$title));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

   if($stmt->rowCount() == 1)
   {
	   header("Location: createpost?post-already-exist");
       exit;
   }
   else
   {
	   $stmt = $this->conn->prepare("INSERT INTO tbl_blog(image,title,text,date)
       VALUES(:img, :title, :text, :date)");
       $stmt->bindparam(":img",$image);
       $stmt->bindparam(":title",$title);
       $stmt->bindparam(":text",$text);
       $stmt->bindparam(":date",$date);
       $stmt->execute();
   }

   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
    
 public function delete_post($uid)//delete a blog post
    {
        try
        {
            $stmt = $this->conn->prepare("DELETE FROM tbl_blog WHERE userID=:id");
            $stmt->execute(array(":id"=>$uid));

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
public function edit_post($uid,$image,$title,$text,$views,$date)//edit an existing post
    {
        try
        {
            $stmt = $this->conn->prepare("UPDATE tbl_blog SET image=:image,title=:title,text=:text,views=:views,date=:date WHERE userID=:id");
            $stmt->bindparam(":id",$uid);
            $stmt->bindparam(":image",$image);
            $stmt->bindparam(":title",$title);
            $stmt->bindparam(":text",$text);
            $stmt->bindparam(":views",$views);
            $stmt->bindparam(":date",$date);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
public function set($iid,$investors,$earnings,$withdrawals,$support)//set website information
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_info");
   $stmt->execute(array(":investors"));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   if($userRow)
   {
        $stmt = $this->conn->prepare("UPDATE tbl_info SET investors=:inv,earnings=:ern,withdrawals=:wit,support=:sup WHERE userID=:id");
        $stmt->bindparam(":id",$iid);
        $stmt->bindparam(":inv",$investors);
        $stmt->bindparam(":ern",$earnings);
        $stmt->bindparam(":wit",$withdrawals);
        $stmt->bindparam(":sup",$support);
        $stmt->execute();
   }
   else
   {
	   $stmt = $this->conn->prepare("INSERT INTO tbl_info(investors,earnings,withdrawals,support)
       VALUES(:inv, :ern, :wit, :sup)");
       $stmt->bindparam(":inv",$investors);
       $stmt->bindparam(":ern",$earnings);
       $stmt->bindparam(":wit",$withdrawals);
       $stmt->bindparam(":sup",$support);
       $stmt->execute();
   }

   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
	
    function send_mail($email,$message,$subject)
    {
        require_once('vendor/autoload.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username="info@investmentmasters.org";
        $mail->Password="$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org','Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org","Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
    
    function send_maill($email,$message,$subject)
    {
        require_once('../vendor/autoload.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username="info@investmentmasters.org";
        $mail->Password="$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org','Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org","Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
    
    
}
