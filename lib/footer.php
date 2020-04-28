        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <?php if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link active" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="forgot_password.php">Forgot Password</a>
            </li>
        </ul>
    </body>
</html>
<?php //session_destroy() ?>