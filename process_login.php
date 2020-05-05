<?php  session_start();
    $error = [];
    $data = $_POST;
    $formData = [];

    if($data){
        if(!isset($data['email']) || $data['email'] === ""){
            $email_error = 'Please Enter Email';
            $error['email_error'] = $email_error;
        } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $email_error = 'Enter valid Email';
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
?>