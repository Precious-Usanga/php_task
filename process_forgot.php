<?php  
    session_start();
    $error = [];
    $data = $_POST;
    $formData = [];
    // print_r($data); exit;
    if($data){
        if(!isset($data['email']) || $data['email'] === ""){
            $email_error = 'Email cannot be empty';
            $error['email_error'] = $email_error;
        } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $email_error = 'Enter valid email';
            $error['email_error'] = $email_error;
        } elseif(strlen($data['email']) < 5) {
            $email_error = 'Email cannot be less than 5 letters';
            $error['email_error'] = $email_error;
        }  else {
            $formData['email']  = $data['email'];
        }
    }

    if (!empty($error)) {
        $_SESSION['forgot_error'] = $error;
        $_SESSION['formData'] = $data;
        header("Location: forgot_password.php");
        die();
    } else {
        $all_users = scandir('db/users');

        for($i = 0; $i < count($all_users); $i++){
            if($formData['email'].'.json' == $all_users[$i]){
                $userFile = file_get_contents('db/users/'.$all_users[$i]);
                $userData = json_decode($userFile);
                if($formData['email'] === $userData->email) {
                    // generate token
                    $token = "";
                    $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','m',
                                 'n','o','p','q','r', 's', 't','u','v','w','x','y','z'];
                    for($i = 0; $i < 26; $i++) {
                        $index = mt_rand(0, count($alphabet)-1);
                        $token .= $alphabet[$index];
                    } 
                    
                    // set email parameters
                    $to = $formData['email'];
                    $subject = "Reset Password Link";
                    $message = "A password reset request was initiated from your account.\n Please ignore if you do not recognize this activity.\n Otherwise, visit: localhost/php_task/reset_password.php?token=".$token;
                    $headers = "From: no-reply@snh.org";
                    
                    // save token to db
                    $resetToken = [ 'token' => $token];
                    file_put_contents('db/tokens/'.$formData['email'].'.json', json_encode($resetToken, JSON_PRETTY_PRINT));

                    // send mail
                    $try = mail($to,$subject,wordwrap($message, 70),$headers);
                    if($try){
                        $_SESSION['success'] = "Password reset link sent to " .$formData['email'] ;
                        header("Location: login.php");
                    } else{
                        $_SESSION['error'] = "Sorry, an error occured. Password reset link not sent to " .$formData['email'] ;
                        $_SESSION['formData'] = $data;
                        header("Location: forgot_password.php");
                    }
                    die();
                } else {
                    $_SESSION['error'] = "User Doesn't exist";
                    $_SESSION['formData'] = $data;
                    header("Location: forgot_password.php");
                    die();
                }
            }
        };
        $_SESSION['error'] = "User doesn't exist";
        $_SESSION['formData'] = $data;
        header("Location: forgot_password.php");
        exit;
    }