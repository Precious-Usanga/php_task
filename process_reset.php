<?php
 session_start();
 $error = [];
 $data = $_POST;
 $formData = [];

 if($data){
    if(!isset($data['token']) || $data['token'] === ""){
        $token_error = "invalid reset token";
        $error['token_error'] = $token_error;
        // header("Location: reset_password.php");
        // die();
    } else {
        $formData['token']  = $data['token'];
    }
    
    if(!isset($data['email'])|| $data['email'] === ""){
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

    if(!isset($data['password']) || $data['password'] === ""){
        $password_error = 'Password cannot be empty';
        $error['password_error'] = $password_error;
    } else {
        $formData['password']  = $data['password'];
    }
 }



 if (!empty($error)) {
    $_SESSION['reset_error'] = $error;
    $_SESSION['formData'] = $data;
    header("Location: reset_password.php");
    die();
 } else {
    $reset_passsword_tokens = scandir('db/tokens');
    for($i = 0; $i < count($reset_passsword_tokens); $i++){
        if($formData['email'].'.json' == $reset_passsword_tokens[$i]){
            $tokenFile = file_get_contents('db/tokens/'.$reset_passsword_tokens[$i]);
            $tokenObject = json_decode($tokenFile);
            if($formData['token'] == $tokenObject->token) {

                $newPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
                $all_users = scandir('db/users');
                for($i = 0; $i < count($all_users); $i++){
                    if($formData['email'].'.json' == $all_users[$i]) {
                        $userFile = file_get_contents('db/users/'.$all_users[$i]);
                        $userData = json_decode($userFile);
                        $userData->password = $newPassword;
                        unlink('db/users/'.$all_users[$i]);
                    }
                };
                file_put_contents('db/users/'.$formData['email'].'.json', json_encode($userData, JSON_PRETTY_PRINT));
                unlink('db/tokens/'.$reset_passsword_tokens[$i]);
                $_SESSION['success'] = "Password reset successful. Please Login.";
                header("Location: login.php");
                die();
            } else {
                $_SESSION['error'] = "Password reset failed. Invalid token or email.";
                header("Location: login.php");
                die();
            }
        }
    }
 }
?>