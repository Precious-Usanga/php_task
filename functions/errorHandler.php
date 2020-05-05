<?php 

    function alert() {
        if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo "<div class='alert alert-warning' role='alert'>" .$_SESSION['error'] . "</div>";
            session_destroy();
        }
    }

    function formActionError($actionError, $errorField) {
        if(isset($_SESSION[$actionError]) && !empty($_SESSION[$actionError][$errorField])) {
            echo "<small class='form-text text-danger'>" .$_SESSION[$actionError][$errorField] . "</small>";
            // session_destroy();
        }
    }

?>