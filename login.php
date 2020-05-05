<?php
    include_once('lib/header.php');
    require_once('functions/session.php'); 
    is_logged_in();
    require_once('functions/errorHandler.php');
    require_once('functions/form.php');

?>

    <?php success(); ?>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_login.php">
                    <?php alert(); ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                        <?php patchValue('email') ?>
                        >
                        <?php formActionError('login_error', 'email_error'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php formActionError('login_error', 'password_error'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>