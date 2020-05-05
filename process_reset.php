<?php
 session_start();
 $error = [];
 $data = $_POST;
 $formData = [];

 if($data){
    //  form error handling
    if(!isset($_SESSION[loggedIn])){
        if(!isset($data['token']) || $data['token'] === ""){
            $token_error = "invalid reset token";
            $error['token_error'] = $token_error;
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
    } else {
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
    
        if(!isset($data['oldPassword']) || $data['oldPassword'] === ""){
            $oldPassword_error = 'Old Password cannot be empty';
            $error['oldPassword_error'] = $oldPassword_error;
        } else {
            $formData['oldPassword']  = $data['oldPassword'];
        }

        if(!isset($data['newPassword']) || $data['newPassword'] === ""){
            $newPassword_error = 'New Password cannot be empty';
            $error['newPassword_error'] = $newPassword_error;
        } else {
            $formData['newPassword']  = $data['newPassword'];
        }
    }
 }



 if (!empty($error)) {
    $_SESSION['reset_error'] = $error;
    $_SESSION['formData'] = $data;
    header("Location: reset_password.php");
    die();
 } else {
    if(!isset($_SESSION['loggedIn'])){
        $reset_password_tokens = scandir('db/tokens');
        for($i = 0; $i < count($reset_password_tokens); $i++){
            if($formData['email'].'.json' == $reset_password_tokens[$i]){
                $tokenFile = file_get_contents('db/tokens/'.$reset_password_tokens[$i]);
                $tokenObject = json_decode($tokenFile);
                if($formData['token'] == $tokenObject->token) {
                    // get, hash and store new password
                    $newPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
                    // get users db 
                    $all_users = scandir('db/users');
                    // fetch exact user file
                    for($i = 0; $i < count($all_users); $i++){
                        if($formData['email'].'.json' == $all_users[$i]) {
                            $userFile = file_get_contents('db/users/'.$all_users[$i]); //read file content in a string
                            $userData = json_decode($userFile); // convert string format to object for easy manipulation
                            $userData->password = $newPassword; // set new user password
                            // delete old user file
                            unlink('db/users/'.$all_users[$i]); 
                        }
                    };
                    // create new file in db to hold updated user data
                    file_put_contents('db/users/'.$formData['email'].'.json', json_encode($userData, JSON_PRETTY_PRINT));

                    // send email informing user of successful password reset activity
                    $to = $formData['email'];
                    $subject = "Password Reset Successful";
                    $message = "Your password reset is successful.\n If you do not recognize this activity please contact the IT team.\n";
                    $headers = "From: no-reply@snh.org";
                    $send = mail($to,$subject,wordwrap($message, 70),$headers);

                    //  delete user password reset token
                    unlink('db/tokens/'.$formData['email'].'.json');
                    
                    // display success message and redirect to login
                    $_SESSION['success'] = "Password reset successful. Please Login.";
                    header("Location: login.php");
                    // die();
                } else {
                    $_SESSION['error'] = "Password reset failed. Invalid token or email.";
                    header("Location: login.php");
                    die();
                }
            }
        }
    } else {
        // get, hash and store new password
        $newPassword = password_hash($formData['newPassword'], PASSWORD_DEFAULT);
        // get users db 
        $all_users = scandir('db/users');
        // fetch exact user file
        for($i = 0; $i < count($all_users); $i++){
            if($formData['email'].'.json' == $all_users[$i]) {
                $userFile = file_get_contents('db/users/'.$all_users[$i]); //read file content into a string
                $userData = json_decode($userFile); // convert string format to object for easy manipulation
                $verifyOldpassword = password_verify($formData['oldPassword'], $userData->password); //verify Old Password
                if($verifyOldpassword){
                    $userData->password = $newPassword; // set new user password
                    // delete old user file
                    unlink('db/users/'.$all_users[$i]); 
                } else {
                    $_SESSION['error'] = "Invalid Old Password.";
                    $_SESSION['formData'] = $data;
                    header("Location: reset_password.php");
                    die();
                }
            }
        };
        // create new file in db to hold updated user data
        file_put_contents('db/users/'.$formData['email'].'.json', json_encode($userData, JSON_PRETTY_PRINT));

        // send email informing user of successful password reset activity
        $to = $formData['email'];
        $subject = "Password Reset Successful";
        $message = "Your password reset is successful.\n If you do not recognize this activity please contact the IT team.\n";
        $headers = "From: no-reply@snh.org";
        $send = mail($to,$subject,wordwrap($message, 70),$headers);
                    
        // display success message and redirect to login
        $_SESSION['success'] = "Password reset successful.";
        if($_SESSION['role'] === 'patient') {
            header("Location: patients_dashboard.php");
        } elseif ($_SESSION['role'] === 'medical_team') {
            header("Location: medic_team_dashboard.php");
        } elseif ($_SESSION['role'] === 'admin') {
            header("Location: dashboard.php");
        }
        die();
    }
}
?>