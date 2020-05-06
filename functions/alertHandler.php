<?php 

    function success() {
        if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            echo "<div class='alert alert-success' role='alert'>" .$_SESSION['success'] . "</div>";
            // session_unset();
        }
    }

    function alert() {
        $type = ["message", "success", "error"];
        $class = ["alert-info", "alert-success", "alert-warning"];
        for($i = 0; $i < count($type); $i++){
            if(isset($_SESSION[$type[$i]]) && !empty($_SESSION[$type[$i]])){
                    echo "<div class='alert ".$class[$i]."' role='alert'>" .$_SESSION[$type[$i]] . "</div>";
            }
        }
        session_destroy();
    }

    function formActionError($actionError, $errorField) {
        if(isset($_SESSION[$actionError]) && !empty($_SESSION[$actionError][$errorField])) {
            echo "<small class='form-text text-danger'>" .$_SESSION[$actionError][$errorField] . "</small>";
        //    session_destroy();
        }
    }

    function set_alert($type="message", $content=""){
        switch($type){
            case "success":
                $_SESSION['success']=$content;
            break;
            case "error":
                $_SESSION['error']=$content;
            break;
            case "message":
                $_SESSION['error']=$content;
            break;
            default:
            $_SESSION['message']=$content;
        break;
        }
    }

    function set_form_alert($error_form="", $error_fields=[]){
        switch($error_form){
            case "login_error":
                $_SESSION['login_error']=$error_fields;
            break;
            case "forgot_error":
                $_SESSION['forgot_error']=$error_fields;
            break;
            case "reset_error":
                $_SESSION['reset_error']=$error_fields;
            break;
            case "register_error":
                $_SESSION['register_error']=$error_fields;
            break;
            default:
            $_SESSION['register_error']=$error_fields;
        break;
        }
    }
?>