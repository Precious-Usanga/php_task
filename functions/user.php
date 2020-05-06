<?php 
    require_once('functions/form.php');

    function registerUser($formMethod){
        $form = validateForm($formMethod);
        $error = $form['error'];
        $data = $form['data'];
        $formData = $form['formData'];
        if (!empty($error)) {
            $_SESSION['register_error'] = $error;
            $_SESSION['formData'] = $data;
            if(isset($_SESSION['loggedIn'])){
                header("Location: dashboard.php");
            } else {
                header("Location: register.php");
            }
            die();
        } else {
            $all_users = scandir('db/users');
            // print_r($all_users);
            $new_user_id = count($all_users) - 2;
            $postData = [
                'id' => ++$new_user_id,
                'first_name'=> $formData['first_name'],
                'last_name'=> $formData['last_name'],
                'email'=> $formData['email'],
                'password'=> password_hash($formData['password'], PASSWORD_DEFAULT),
                'designation'=> $formData['designation'],
                'gender'=> $formData['gender'],
                'department'=> $formData['department'],
                'dateOfReg'=> date('m/d/Y h:i:s a', time())
            ];
            // print_r($postData); exit;
            for($i = 0; $i < count($all_users); $i++){
                if($postData['email'].'.json' == $all_users[$i]) {
                    $_SESSION['error'] = "User Email already exist.";
                    $_SESSION['formData'] = $data;
                    header("Location: register.php");
                    die();
                }
            };
            file_put_contents('db/users/'.$postData['email'].'.json', json_encode($postData, JSON_PRETTY_PRINT));
            if(isset($_SESSION['loggedIn'])){
                $_SESSION['success'] = "New User Created";
                header("Location: dashboard.php");
            } else {
                $_SESSION['success'] = "Registration Successful! Please Login";
                header("Location: login.php");
            }
        }
    }

    function userLogin($formMethod){
        $form = validateForm($formMethod);
        $error = $form['error'];
        $data = $form['data'];
        $formData = $form['formData'];

        if (!empty($error)){
            $_SESSION['login_error'] = $error;
            $_SESSION['formData'] = $data;
            header("Location: login.php");
            die();
        } else {
            $all_users = scandir('db/users');
    
            for($i = 0; $i < count($all_users); $i++){
                if($formData['email'].'.json' == $all_users[$i]){
                    $userFile = file_get_contents('db/users/'.$all_users[$i]);
                    $userData = json_decode($userFile);
                    $verifypassword = password_verify($formData['password'], $userData->password);
                    if($verifypassword == true) {
                        $_SESSION['success'] = "Hello ".$userData->first_name." ".$userData->last_name." You're Logged in successfully";
                        $_SESSION['loggedIn'] = $userData->id;
                        $_SESSION['email'] = $userData->email; 
                        $_SESSION['fullname'] = $userData->first_name. " " .$userData->last_name;
                        $_SESSION['role'] = $userData->designation;
                        $_SESSION['department'] = $userData->department;
                        $_SESSION['dateOfReg'] = $userData->dateOfReg;
                        $_SESSION['lastLogin'] = $userData->lastLogin;
                         
                        if($_SESSION['role'] === 'patient') {
                            header("Location: patients_dashboard.php");
                        } elseif ($_SESSION['role'] === 'medical_team') {
                            header("Location: medic_team_dashboard.php");
                        } elseif ($_SESSION['role'] === 'admin') {
                            header("Location: dashboard.php");
                        }
                        die();
                    } else {
                        $_SESSION['error'] = "Invalid username or password";
                        $_SESSION['formData'] = $data;
                        header("Location: login.php");
                        die();
                    }
                }
            };
            $_SESSION['error'] = "User doesn't exist";
            $_SESSION['formData'] = $data;
            header("Location: login.php");
            exit;
        }
    }


    function forgotPassword($formMethod){
        $form = validateForm($formMethod);
        $error = $form['error'];
        $data = $form['data'];
        $formData = $form['formData'];

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
    }

    function resetPassword($formMethod){
        $form = validateForm($formMethod);
        $error = $form['error'];
        $data = $form['data'];
        $formData = $form['formData'];

        if (!empty($error)) {
            $_SESSION['reset_error'] = $error;
            $_SESSION['formData'] = $data;
            header("Location: reset_password.php");
            die();
        } else {
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
        }
    }

    function changePassword($formMethod){
        $form = validateForm($formMethod);
        $error = $form['error'];
        $data = $form['data'];
        $formData = $form['formData'];

        if (!empty($error)) {
            $_SESSION['reset_error'] = $error;
            $_SESSION['formData'] = $data;
            header("Location: reset_password.php");
            die();
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