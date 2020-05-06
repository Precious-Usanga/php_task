<?php 
    require_once('functions/user.php');

    function acl_redirect(){
        if(is_user_loggedIn()) {
            if($_SESSION['role'] === 'patient') {
                header("Location: patients_dashboard.php");
                die();
            } elseif ($_SESSION['role'] === 'medical_team') {
                header("Location: medic_team_dashboard.php");
                die();
            } elseif ($_SESSION['role'] === 'admin'){
                header("Location: dashboard.php");
                die();
            }
        }
    }

    function dashboardCheck($role){
        if(!is_user_loggedIn()) {
            header("Location: login.php");
        } elseif (is_user_loggedIn() && $_SESSION['role'] != $role) {
            $_SESSION['error'] = "You cannot access that page";
            header("Location: login.php");
            exit;
        }
    }


    function recordLastLogin() {
        if(is_user_loggedIn()) {
            $all_users = scandir('db/users');
            for($i = 0; $i < count($all_users); $i++){
                if($_SESSION['email'].'.json' == $all_users[$i]){
                    $userFile = file_get_contents('db/users/'.$all_users[$i]);
                    $userData = json_decode($userFile);
                    $userData->lastLogin = date('m/d/Y h:i:s a', time());
                    file_put_contents('db/users/'.$all_users[$i], json_encode($userData, JSON_PRETTY_PRINT));
                }
            }
            logout();
        }
    }

    function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>