<?php session_start();

    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        $all_users = scandir('db/users');
        for($i = 0; $i < count($all_users); $i++){
            if($_SESSION['email'].'.json' == $all_users[$i]){
                $userFile = file_get_contents('db/users/'.$all_users[$i]);
                $userData = json_decode($userFile);
                $userData->lastLogin = date('m/d/Y h:i:s a', time());
                file_put_contents('db/users/'.$_SESSION['email'].'.json', json_encode($userData, JSON_PRETTY_PRINT));
            }
        }
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>