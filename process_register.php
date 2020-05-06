<?php  
    session_start();
    require_once('functions/user.php');

    registerUser($_POST);
    
?>