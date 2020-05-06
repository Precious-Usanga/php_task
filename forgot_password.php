<?php 
    include_once('lib/header.php');
    require_once('functions/session.php'); 
    require_once('functions/alertHandler.php');
    require_once('functions/form.php');
?>

    <div class="container">
        <h3>Forgot Password</h3>
        <p>Provide the Email address associated with your account</p>
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_forgot.php">
                    <?php alert();?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                        <?php patchValue('email'); ?>
                        >
                        <?php formActionError('forgot_error', 'email_error'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Code</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>