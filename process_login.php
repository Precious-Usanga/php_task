<?php  
    session_start();
    require_once('functions/user.php');

    userLogin($_POST);
?>