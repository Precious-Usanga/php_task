<?php  session_start();
    $error_count = 0;
    $data = $_POST;
    $first_name = $data['first_name'] != "" ? $data['first_name'] : $error_count++;
    $last_name = $data['last_name'] != "" ? $data['last_name'] : $error_count++;
    $email = $data['email'] != "" ? $data['email'] : $error_count++;
    $password = $data['password'] != "" ? $data['password'] : $error_count++;
    $designation = $data['designation'] != "" ? $data['designation'] : $error_count++;
    $gender = $data['gender'] != "" ? $data['gender'] : $error_count++;
    $department = $data['department'] != "" ? $data['department'] : $error_count++;

    // $first_name = $_POST['first_name'] ? "first_name canot be empty" : " ";
    if ($error_count > 0) {
        $_SESSION['error'] = "You have " . $error_count . " error(s) on your form";
        $_SESSION['formData'] = $data;
        header("Location: register.php");
    } else {
        $all_users = scandir('db/users');
        // print_r($all_users);
        $new_user_id = count($all_users) - 2;
        $postData = [
            'id' => ++$new_user_id,
            'first_name'=> $first_name,
            'last_name'=> $last_name,
            'email'=> $email,
            'password'=> password_hash($password, PASSWORD_DEFAULT),
            'designation'=> $designation,
            'gender'=> $gender,
            'department'=> $department
        ];
        // print_r($postData); exit;
        for($i = 0; $i < count($all_users); $i++){
            if($postData['email'].'.json' == $all_users[$i]) {
                $_SESSION['error'] = "The email " .$postData['email'] . " already exist";
                $_SESSION['formData'] = $data;
                header("Location: register.php");
                die();
            }
        };
        file_put_contents('db/users/'.$email.'.json', json_encode($postData, JSON_PRETTY_PRINT));
        header("Location: login.php");
        $_SESSION['success'] = "Registration Successful! Please Login";
    }
?>