<?php 

    function is_logged_in(){
        if(isset($_SESSION['loggedIn'])) {
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
        if(!isset($_SESSION['loggedIn'])) {
            header("Location: login.php");
        } elseif (isset($_SESSION['loggedIn']) && $_SESSION['role'] != $role) {
            $_SESSION['error'] = "You cannot access that page";
            header("Location: login.php");
            exit;
        }
    }

    function success() {
        if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            echo "<div class='alert alert-success' role='alert'>" .$_SESSION['success'] . "</div>";
            session_destroy();
        }
    }

    function recordLastLogin() {
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
            logout();
        }
    }

    function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>