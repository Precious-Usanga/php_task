<?php  
    session_start();
    $error = [];
    $data = $_POST;
    $formData = [];
    
    if($data){
        if(!isset($data['first_name']) || $data['first_name'] === ""){
            $firstname_error = 'Firstname cannot be empty';
            $error['firstname_error'] = $firstname_error;
        } elseif((strlen($data['first_name']) < 2)){
            $firstname_error = 'Firstname cannot be less than 2 letters';
            $error['firstname_error'] = $firstname_error;
        } elseif(!ctype_alpha($data['first_name'])){
            $firstname_error = 'Firstname cannot contain numbers';
            $error['firstname_error'] = $firstname_error;
        } else {
            $formData['first_name'] = $data['first_name'];
        }
    
        if(!isset($data['last_name']) || $data['last_name'] === ""){
            $lastname_error = 'Lastname cannot be empty';
            $error['lastname_error'] = $lastname_error;
        } elseif(strlen($data['last_name']) < 2) {
            $lastname_error = 'Lastname cannot be less than 2 letters';
            $error['lastname_error'] = $lastname_error;
        } elseif(!ctype_alpha($data['last_name'])){
            $lastname_error = 'Lastname cannot contain numbers';
            $error['lastname_error'] = $lastname_error;
        } else {
            $formData['last_name']  = $data['last_name'];
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
    
        if(!isset($data['gender']) || $data['gender'] === ""){
            $gender_error = 'Select Gender';
            $error['gender_error'] = $gender_error;
        } else {
            $formData['gender']  = $data['gender'];
        }
    
        if(!isset($data['designation']) || $data['designation'] === ""){
            $designation_error = 'Select Designation';
            $error['designation_error'] = $designation_error;
        } else {
            $formData['designation']  = $data['designation'];
        }
    
        if(!isset($data['department']) || $data['department'] === ""){
            $department_error = 'Specify Department';
            $error['department_error'] = $department_error;
        } else {
            $formData['department']  = $data['department'];
        }
    }

    if (!empty($error)) {
        $_SESSION['register_error'] = $error;
        $_SESSION['formData'] = $data;
        header("Location: register.php");
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
            'department'=> $formData['department']
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
        header("Location: login.php");
        $_SESSION['success'] = "Registration Successful! Please Login";
    }
?>