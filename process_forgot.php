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