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
            $userData = find_user($_SESSION['email']);
            if(isset($userData) && !empty($userData)){
                $userData->lastLogin = date('m/d/Y h:i:s a', time());
                update_user($_SESSION['email'], $userData);
                
                logout();
            } else {
                header("Location: index.php");
                die();
            }
        }
    }

    function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
        die();
    }
?>