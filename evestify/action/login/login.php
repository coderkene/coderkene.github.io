        <?php

        $actionParam = new USER();
        //user class stored in variable actionParam
        //get login details after registration to execute direct login
        if(isset($_GET['email']) && isset($_GET['password']))
        {
            $email = $_GET['email'];
            $password = $_GET['password'];
            if($actionParam->login_user($email,$password))
            {
            $actionParam->redirect('account/index.php');
            }
            else
            {
            $msg = "
            <div class='alert' style='background-color: #DC143C; color: #fff; border-left-color: #fff;'>
            <span class='alert-text'>sorry, incorrect username or password</span>
            </div>
            ";
            }
        }
        //account is email, id is password
        //get account and id to send 2FA to user email
        if(isset($_GET['account']) && isset($_GET['id']))
        {
            $email = base64_decode($_GET['account']);//email
            $password = base64_decode($_GET['id']);//password
            
        }
        //account is email, id is password
        //decode get values and login user again
        if(isset($_GET['resend']) && isset($_GET['account']) && isset($_GET['id']))
        {
            $email = base64_decode($_GET['account']);//email
            $password = base64_decode($_GET['id']);//password
            $authcode = USER::AlphaNumeric(6);
            if($actionParam->send_auth($email,$password,$authcode))
            {
            $message = "Your 2 Factor Authentication Code: $authcode";
            $subject = "Authentication Code";
            $actionParam->send_mail($email,$message,$subject);
            $email = base64_encode($email);
            $password = base64_encode($password);
            header("Location: login?account=$email&id=$password");
            exit;
            }
            else
            {
            $msg = "
                <div class='alert' style='background-color: #DC143C; color: #fff; border-left-color: #fff;'>
                <span class='alert-text'>sorry, incorrect username or password</span>
                </div>
                ";
            }
        }

        if(isset($_POST['btn-login']))//sends authcode
        {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        if($actionParam->login_user($email,$password))
        {
            $actionParam->redirect('account/index.php');
            header("Location: login?account=$email&id=$password");
            exit;
        }
        else
        {
        $msg = "
            <div class='alert' style='background-color: #DC143C; color: #fff; border-left-color: #fff;'>
            <span class='alert-text'>sorry, incorrect username or password</span>
            </div>
            ";
        }
        }


        ?>

