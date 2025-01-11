<?php
require_once 'dbconfig.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



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


    public function register_user($fullname, $email, $refemail, $password, $account_id, $date) //register a new user
{
    try {
        $password = md5($password);
        $start = strtotime('now');
        $bal = 10;

        $stmt = $this->conn->prepare("INSERT INTO tbl_user(fullname,email,ref_email,password,accountID,date,start,balance)
        VALUES(:fname, :email, :remail, :pass, :acct, :date, :start, :bal)");
        $stmt->bindparam(":fname", $fullname);
        $stmt->bindparam(":email", $email);
        $stmt->bindparam(":remail", $refemail);
        $stmt->bindparam(":pass", $password);
        $stmt->bindparam(":acct", $account_id);
        $stmt->bindparam(":date", $date);
        $stmt->bindparam(":start", $start);
        $stmt->bindparam(":bal", $bal);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

    public function confirm_email($email)
    //confirm a new user's email address
    {
        try {
            $confirm = 1;
            $stmt = $this->conn->prepare("UPDATE tbl_user SET confirm=:cfm WHERE email=:email");
            $stmt->bindparam(":cfm", $confirm);
            $stmt->bindparam(":email", $email);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_user($uid, $wallet, $state, $phone) //update an existing user details
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_user SET wallet_address=:wallet,state=:state,phone=:ph WHERE userID=:id");
            $stmt->bindparam(":id", $uid);
            $stmt->bindparam(":wallet", $wallet);
            $stmt->bindparam(":state", $state);
            $stmt->bindparam(":ph", $phone);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function login_user($email, $password) //direct login after registration
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
            $stmt->execute(array(":email" => $email));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) {
                if ($userRow['password'] == md5($password)) {
                    $_SESSION['userSession'] = $userRow['userID'];
                    return true;
                } else {
                    header("Location: login?login-password-error");
                    exit;
                }
            } else {
                header("Location: login?login-email-error");
                exit;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function user_is_logged_in()
    {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout_user()
    {
        session_destroy();
        $_SESSION['userSession'] = false;
    }

    public static function Numeric($length)
    {
        $chars = "123456789";
        $clen = strlen($chars) - 1;
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0, $clen)];
        }
        return ($id);
    }

    public static function AlphaNumeric($length)
    {
        $chars = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $clen = strlen($chars) - 1;
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0, $clen)];
        }
        return ($id);
    }

    public function change_password($uid, $password, $password_old, $phone, $address)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE userID=:id");
            $stmt->execute(array(":id" => $uid));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userRow['password'] == md5($password_old)) {
                $password = md5($password);
                $stmt = $this->conn->prepare("UPDATE tbl_user SET password=:password,phone=:phone,address=:address WHERE userID=:id");
                $stmt->execute(array(":password" => $password, ":id" => $uid, ":phone" => $phone, ":address" => $address));
            } else {
                header("Location: profilesettings?incorrect-password");
                exit;
            }
            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function withdraw_funds($uemail, $amount, $desc, $coin, $coin_bal, $orderID, $date)
    {
        try {

            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:uemail");
            $stmt->execute(array(":uemail" => $uemail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            //get users balance first then subtract amount from it



            //update users balance here

            if ($coin == 'btc') {
                $coin_row = 'btc_balance';
            } elseif ($coin == 'ltc') {
                $coin_row = 'litecoin_balance';
            } elseif ($coin == 'eth') {
                $coin_row = 'ethereum_balance';
            } elseif ($coin == 'usdt') {
                $coin_row = 'usdt_balance';
            } elseif ($coin == 'bnb') {
                $coin_row = 'bnb_balance';
            }


            //Convert usd balances to cryto

            $getnewprice = file_get_contents("https://pro-api.coinmarketcap.com/v1/tools/price-conversion?CMC_PRO_API_KEY=f6131ba0-3b47-4d22-8166-e4b80eb07a14&symbol=USD&convert=$coin&amount=" . $userRow[".$coin_row."]);

            $coin_price = json_decode($getnewprice, true);


            if ($coin == 'btc') {

                $coin_bal = $coin_price['data']['quote']['BTC']['price'];
            } elseif ($coin == 'ltc') {

                $coin_bal = $coin_price['data']['quote']['LTC']['price'];
            } elseif ($coin == 'eth') {

                $coin_bal = $coin_price['data']['quote']['ETH']['price'];
            } elseif ($coin == 'usdt') {

                $coin_bal = $coin_price['data']['quote']['USDT']['price'];
            } elseif ($coin == 'bnb') {

                $coin_bal = $coin_price['data']['quote']['BNB']['price'];
            }

            $newbal = $coin_bal - $amount;
            $stmt = $this->conn->prepare("UPDATE tbl_user SET " . $coin_row . "=:bal WHERE email=:uemail");
            $stmt->bindparam(":bal", $coin_bal);
            $stmt->bindparam(":uemail", $uemail);
            $stmt->execute();

            $stats = 0;
            //first insert info into withdrawal list
            $stmt = $this->conn->prepare("INSERT INTO tbl_withdrawal(email,orderID,amount,coin,description,status,date) VALUES(:uemail, :order, :amt, :coin, :desc, :stats, :date)");
            $stmt->bindparam(":uemail", $uemail);
            $stmt->bindparam(":order", $orderID);
            $stmt->bindparam(":amt", $amount);
            $stmt->bindparam(":coin", $coin);
            $stmt->bindparam(":desc", $desc);
            $stmt->bindparam(":stats", $stats);
            $stmt->bindparam(":date", $date);

            $stmt->execute();

            //add to user last withdrawal

            $stmt = $this->conn->prepare("UPDATE tbl_user SET last_withdrawal=:last WHERE email=:uemail");
            $stmt->bindparam(":uemail", $uemail);
            $stmt->bindparam(":last", $amount);
            $stmt->execute();


            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function invest_funds($uemail, $amount, $orderID, $date, $start, $end, $plan) //invest funds
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:uemail");
            $stmt->execute(array(":uemail" => $uemail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            //get users balance first then subtract amount from it
            $bal = $userRow['balance'];
            $newbal = $bal - $amount;
            //update users balance here
            $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:bal WHERE email=:uemail");
            $stmt->bindparam(":bal", $newbal);
            $stmt->bindparam(":uemail", $uemail);
            $stmt->execute();

            $stats = 0;
            if ($plan == 'starter') {
                $percentage = 7 / 100;
            } elseif ($plan == 'premium') {
                $percentage = 9 / 100;
            } elseif ($plan == 'gold') {
                $percentage = 12 / 100;
            } elseif ($plan == 'platinum') {
                $percentage = 15 / 100;
            }
            $earn = $percentage * $amount; //amount to earn
            $dailyprofit = $earn / 30; //daily profits
            //first insert info into withdrawal list
            $stmt = $this->conn->prepare("INSERT INTO tbl_investment(email,orderID,amount_invested,amount_to_earn,daily_profit,status,date,start,end,plan)
    VALUES(:uemail, :order, :amt, :earn, :prof, :stats, :date, :start, :end, :plan)");
            $stmt->bindparam(":uemail", $uemail);
            $stmt->bindparam(":order", $orderID);
            $stmt->bindparam(":amt", $amount);
            $stmt->bindparam(":earn", $earn);
            $stmt->bindparam(":prof", $dailyprofit);
            $stmt->bindparam(":stats", $stats);
            $stmt->bindparam(":date", $date);
            $stmt->bindparam(":start", $start);
            $stmt->bindparam(":end", $end);
            $stmt->bindparam(":plan", $plan);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //this function runs on a cron job
    public function end_invest($investID) //end an investment schedule
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_investment WHERE userID=:id");
            $stmt->execute(array(":id" => $investID));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $userRow['email'];
            $amount = $userRow['amount_invested'];
            $earn = $userRow['amount_to_earn'];

            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
            $stmt->execute(array(":email" => $email));
            $uRow = $stmt->fetch(PDO::FETCH_ASSOC);
            //get users balance first then add amount and earn to it
            $bal = $uRow['balance'];
            $newbal = $bal + $amount + $earn;
            //update users balance here
            $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:bal WHERE email=:email");
            $stmt->bindparam(":bal", $newbal);
            $stmt->bindparam(":email", $email);
            $stmt->execute();

            $stats = 1;
            //update status of the investment to complete
            $stmt = $this->conn->prepare("UPDATE tbl_investment SET status=:stats WHERE userID=:id");
            $stmt->bindparam(":stats", $stats);
            $stmt->bindparam(":id", $investID);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //this function runs on a cron job
    public function update_earnings($email, $investID, $orderID) //update users earnings
    {
        try {
            $date = date("d/m/Y");
            //check if earnings for that day has been added
            //this prevents the code running more than once for a user with multiple investments running
            $stmt = $this->conn->prepare("SELECT * FROM tbl_earning WHERE email=:email AND date=:date");
            $stmt->execute(array(":email" => $email, ":date" => $date));
            $existRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 0) {
                $stats = 0;
                $stmt = $this->conn->prepare("SELECT SUM(daily_profit) FROM tbl_investment WHERE email=:email AND status=:stats");
                $stmt->execute(array(":email" => $email, ":stats" => $stats));
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $dailyprofit = $userRow['SUM(daily_profit)'];

                $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
                $stmt->execute(array(":email" => $email));
                $uRow = $stmt->fetch(PDO::FETCH_ASSOC);
                //get users profit first then add daily profit to it
                $profit = $uRow['profit'];
                $newprofit = $profit + $dailyprofit;
                //update users profit here
                $stmt = $this->conn->prepare("UPDATE tbl_user SET profit=:prof WHERE email=:email");
                $stmt->bindparam(":prof", $newprofit);
                $stmt->bindparam(":email", $email);
                $stmt->execute();

                $type = 'Investment profit';
                //insert earnings into earning history
                $stmt = $this->conn->prepare("INSERT INTO tbl_earning(email,amount,type,date)
     VALUES(:email, :amt, :type, :date)");
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":amt", $dailyprofit);
                $stmt->bindparam(":type", $type);
                $stmt->bindparam(":date", $date);
                $stmt->execute();

                return $stmt;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function create_invoice($uemail, $invoice_id, $price_in_usd, $price_in_coin, $coin, $date) //create a new invoice
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO invoices(email,invoice_id,price_in_usd,price_in_coin,coin,date)
    VALUES(:email, :invoice, :usd, :coinamt, :cointype, :date)");
            $stmt->bindparam(":email", $uemail);
            $stmt->bindparam(":invoice", $invoice_id);
            $stmt->bindparam(":usd", $price_in_usd);
            $stmt->bindparam(":coinamt", $price_in_coin);
            $stmt->bindparam(":cointype", $coin);
            $stmt->bindparam(":date", $date);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function deposite_funds($email, $itemAmount, $txnid) //deposite funds to user
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE addressID=:id");
            $stmt->execute(array(":id" => $txnid));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 0) {
                //update users deposite here
                $stmt = $this->conn->prepare("UPDATE tbl_user SET last_deposite=:last WHERE email=:email");
                $stmt->bindparam(":last", $itemAmount);
                $stmt->bindparam(":email", $email);
                $stmt->execute();

                $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
                $stmt->execute(array(":email" => $email));
                $uRow = $stmt->fetch(PDO::FETCH_ASSOC);
                $refemail = $uRow['ref_email'];
                $refpay = $uRow['ref_pay'];
                //get users profit first then add daily profit to it
                $bal = $uRow['balance'];
                $newbal = $bal + $itemAmount;
                //update users balance here
                $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:bal,addressID=:txn WHERE email=:email");
                $stmt->bindparam(":bal", $newbal);
                $stmt->bindparam(":txn", $txnid);
                $stmt->bindparam(":email", $email);
                $stmt->execute();
                //insert deposite into deposite history
                $date = date("d/m/Y");
                $stmt = $this->conn->prepare("INSERT INTO tbl_deposite(email,amount,date)
       VALUES(:email, :amt, :date)");
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":amt", $itemAmount);
                $stmt->bindparam(":date", $date);
                $stmt->execute();
                //reward user's referrer if user has a referrer
                if (!empty($refemail)) {
                    if ($refpay == 0) {
                        $pay = 1;
                        $percent = 10 / 100;
                        $pay_amt = $percent * $itemAmount;
                        //select the exact referrer
                        $stmt = $this->conn->prepare("SELECT * FROM tbl_user WHERE email=:email");
                        $stmt->execute(array(":email" => $refemail));
                        $refrow = $stmt->fetch(PDO::FETCH_ASSOC);
                        $bal = $refrow['balance'];
                        $newbal = $bal + $pay_amt;
                        //calculate and update referrer's account balance
                        $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:amt WHERE email=:email");
                        $stmt->execute(array(":email" => $refemail, ":amt" => $newbal));
                        //set users ref pay to 0, referral bonus is continuous
                        $stmt = $this->conn->prepare("UPDATE tbl_user SET ref_pay=:pay WHERE email=:email");
                        $stmt->execute(array(":email" => $email, ":pay" => $pay));

                        $date = date("d/m/Y");
                        $type = 'Referral bonus';
                        //insert earnings into earning history
                        $stmt = $this->conn->prepare("INSERT INTO tbl_earning(email,amount,type,date)
              VALUES(:email, :amt, :type, :date)");
                        $stmt->bindparam(":email", $refemail);
                        $stmt->bindparam(":amt", $pay_amt);
                        $stmt->bindparam(":type", $type);
                        $stmt->bindparam(":date", $date);
                        $stmt->execute();
                    }
                }
            }

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function remove_bonus($email, $userID, $empty) //remove bonus
    {
        try {
            $null = 0;
            //update users balance here
            $stmt = $this->conn->prepare("UPDATE tbl_user SET balance=:bal, start=:stt WHERE userID=:id");
            $stmt->bindparam(":bal", $null);
            $stmt->bindparam(":stt", $empty);
            $stmt->bindparam(":id", $userID);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function remove_start($email, $userID, $empty) //remove start
    {
        try {
            $null = 0;
            //update start
            $stmt = $this->conn->prepare("UPDATE tbl_user SET start=:stt WHERE userID=:id");
            $stmt->bindparam(":stt", $empty);
            $stmt->bindparam(":id", $userID);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    function send_mail($email, $message, $subject)
    {
        require_once('vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail_in($email, $message, $subject)
    {
        require_once('../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail_cron($email, $message, $subject)
    {
        require_once('../../../../../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail_cron3($email, $message, $subject)
    {
        require_once('../../../../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail_cron2($email, $message, $subject)
    {
        require_once('../../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "investmentmasters.org";
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail_cron4($email2, $message2, $subject2)
    {
        require_once('../../../../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->AddAddress($email2);
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = $subject2;
        $mail->MsgHTML($message2);
        $mail->Send();
    }

    function send_verification($front, $back, $selfie, $user, $message)
    {
        require_once('../../../../vendor/autoload.php');
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host       = "investmentmasters.org";
        $mail->Port       = 465;
        $mail->Username = "info@investmentmasters.org";
        $mail->Password = "$20Squadgoals";
        $mail->AddAddress('info@investmentmasters.org');
        $mail->AddAttachment($front);
        $mail->AddAttachment($back);
        $mail->AddAttachment($selfie);
        $mail->SetFrom('info@investmentmasters.org', 'Investment Masters');
        $mail->AddReplyTo("support@investmentmasters.org", "Investment Masters");
        $mail->Subject    = 'verification files';
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
