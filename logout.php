<?php session_start();?>
<?php 
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        session_unset();
        header("Location: index.php");
    }
?>