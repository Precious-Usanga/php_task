<?php
     session_start();

    require_once('functions/user.php');
    
    if(is_user_loggedIn()) {
        changePassword($_POST);
    } else {
        resetPassword($_POST);
    }
?>