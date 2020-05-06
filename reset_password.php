<?php 
    include_once('lib/header.php');
    require_once('functions/user.php');
    
    if(!is_user_loggedIn() && !is_token_set()){
        $_SESSION['error'] = "Invalid reset link. You're not authorized to view this page"; 
        header("Location: login.php");
        die();
    }
    
    require_once('functions/alertHandler.php');
    require_once('functions/form.php');
?>

    <div class="container">
        <h3>Reset Password</h3>
        <?php if(is_user_loggedIn()) { ?>
            <p>Reset Password associated with <?php echo $_SESSION['email']; ?> </p>
        <?php } else {?>
            <p>Fill the form below to reset your password</p>
        <?php }?>
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_reset.php">
                    <?php error();?>
                    <?php if(is_user_loggedIn()) { ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly <?php echo "value=" . $_SESSION['email'] ;?>
                            >
                            <?php formActionError('reset_error', 'email_error'); ?>
                        </div>
                        <div class="form-group">
                            <label for="oldPassword">Enter Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                            <?php formActionError('reset_error', 'oldPassword_error'); ?>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Enter New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                            <?php formActionError('reset_error', 'newPassword_error'); ?>
                        </div>
                    <?php } else {?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" 
                            <?php patchValue('email'); ?>
                            >
                            <?php formActionError('reset_error', 'email_error'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Enter New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php formActionError('reset_error', 'password_error'); ?>
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
                    <?php }?>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>