<?php 
    include_once('lib/header.php'); 
    
    // print_r('4');
    // print_r($_SESSION['formData']['token']); exit;
    if(!isset($_GET['token'])){
        $_SESSION['error'] = "Invalid reset link. You're not authorized to view this page"; 
        header("Location: login.php");
        die();
    }
?>

    <div class="container">
        <h3>Reset Password</h3>
        <p>Reset Password associated with [email]</p>
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_reset.php">
                    <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {?>
                        <div class="alert alert-warning" role="alert">
                            <?php 
                                echo $_SESSION['error']; 
                                session_destroy();
                            ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" 
                           <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['email'];}?>
                        >
                        <?php if(isset($_SESSION['reset_error']) && !empty($_SESSION['reset_error']['email_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['reset_error']['email_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Enter New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php if(isset($_SESSION['reset_error']) && !empty($_SESSION['reset_error']['password_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['reset_error']['password_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="token" 
                        <?php 
                            if(isset($_GET['token'])){
                                echo "value=".$_GET['token'];
                            } elseif(isset($_SESSION['formData']['token'])){
                                echo "value=".$_SESSION['formData']['token']; 
                            }
                        ?>
                    >
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>