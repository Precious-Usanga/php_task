<?php  session_start();
    $error_count = 0;
    $data = $_POST;
    $email = $data['email'] != "" ? $data['email'] : $error_count++;
    $password = $data['password'] != "" ? $data['password'] : $error_count++;

    // $first_name = $_POST['first_name'] ? "first_name canot be empty" : " ";
    if ($error_count > 0) {
        $_SESSION['error'] = "You have " . $error_count . " error(s) on your form";
        $_SESSION['formData'] = $data;
        header("Location: login.php");
    } else {
        $all_users = scandir('db/users');
        // print_r($all_users);
        // $new_user_id = count($all_users) - 2;
        // $user = $all_users.filter(function($u){
        //     if($u == $data['email'].'.json'){
        //         print_r($user);
        //         return $user;
        //     }
        // });

        // $ufile = $all_users.search($data['email'].'.json');
        // print_r($uFile); exit;


        for($i = 0; $i < count($all_users); $i++){
            if($data['email'].'.json' == $all_users[$i]){
                // print_r($all_users[$i]);
                // $userFile = $all_users[$i];
                $userFile = file_get_contents('db/users/'.$all_users[$i]);
                $userData = json_decode($userFile);
                // print_r($userData);
                $verifypassword = password_verify($data['password'], $userData->password);
                if($verifypassword == true) {
                    $_SESSION['success'] = "logged in successfully";
                    header("Location: dashboard.php");
                    die();
                } else {
                    $_SESSION['error'] = "Invalid username or password";
                    $_SESSION['formData'] = $data;
                    header("Location: login.php");
                    die();
                }
            } 
            // else {

            // }
        };
    }
?>