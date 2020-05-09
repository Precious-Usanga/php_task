<?php

    function patchValue($formField){
        if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {
            echo "value=".$_SESSION['formData'][$formField];
        }
    }

    function validateForm($payload){
        $error = [];
        $data = $payload;
        $formData = [];
        
        if($data){
            if(isset($data['first_name'])){
                if( $data['first_name'] === ""){
                    $firstname_error = 'Firstname cannot be empty';
                    $error['firstname_error'] = $firstname_error;
                } elseif((strlen($data['first_name']) < 2)){
                    $firstname_error = 'Firstname cannot be less than 2 letters';
                    $error['firstname_error'] = $firstname_error;
                } elseif(!ctype_alpha($data['first_name'])){
                    $firstname_error = 'Firstname cannot contain special characters or numbers';
                    $error['firstname_error'] = $firstname_error;
                } else {
                    $formData['first_name'] = $data['first_name'];
                }
            }
        
            if(isset($data['last_name'])){
                if($data['last_name'] === ""){
                    $lastname_error = 'Lastname cannot be empty';
                    $error['lastname_error'] = $lastname_error;
                } elseif(strlen($data['last_name']) < 2) {
                    $lastname_error = 'Lastname cannot be less than 2 letters';
                    $error['lastname_error'] = $lastname_error;
                } elseif(!ctype_alpha($data['last_name'])){
                    $lastname_error = 'Lastname cannot contain special characters or numbers';
                    $error['lastname_error'] = $lastname_error;
                } else {
                    $formData['last_name']  = $data['last_name'];
                }
            }
        
            if(isset($data['email'])){
                if($data['email'] === ""){
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
        
            if(isset($data['password'])){
                if($data['password'] === ""){
                    $password_error = 'Password cannot be empty';
                    $error['password_error'] = $password_error;
                } else {
                    $formData['password']  = $data['password'];
                }
            }
            if(isset($data['gender'])){
                if($data['gender'] === ""){
                    $gender_error = 'Select Gender';
                    $error['gender_error'] = $gender_error;
                } else {
                    $formData['gender']  = $data['gender'];
                }
            }
            if(isset($data['designation'])){
                if($data['designation'] === ""){
                    $designation_error = 'Select Designation';
                    $error['designation_error'] = $designation_error;
                } else {
                    $formData['designation']  = $data['designation'];
                }
            }
            if(isset($data['department'])){
                if($data['department'] === ""){
                    $department_error = 'Select Department';
                    $error['department_error'] = $department_error;
                } else {
                    $formData['department']  = $data['department'];
                }
            }

            if(isset($data['token'])){
                if($data['token'] === ""){
                    $token_error = "invalid reset token";
                    $error['token_error'] = $token_error;
                } else {
                    $formData['token']  = $data['token'];
                }
            }

            if(isset($data['oldPassword'])){
                if( $data['oldPassword'] === ""){
                    $oldPassword_error = 'Old Password cannot be empty';
                    $error['oldPassword_error'] = $oldPassword_error;
                } else {
                    $formData['oldPassword']  = $data['oldPassword'];
                }
            }

            if(isset($data['newPassword'])){
                if($data['newPassword'] === ""){
                    $newPassword_error = 'New Password cannot be empty';
                    $error['newPassword_error'] = $newPassword_error;
                } else {
                    $formData['newPassword']  = $data['newPassword'];
                }
            }
        }

        return ['error' => $error, 'data' => $data, 'formData' => $formData];
    }
?>