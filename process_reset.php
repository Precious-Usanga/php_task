<?php
     session_start();

    require_once('functions/user.php');
    
    if(isset($_SESSION['loggedIn'])) {
        changePassword($_POST);
    } else {
        resetPassword($_POST);
    }
?>