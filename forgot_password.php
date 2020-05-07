<?php 
    include_once('lib/header.php');
    require_once('functions/session.php'); 
    require_once('functions/alertHandler.php');
    require_once('functions/form.php');
?>

<main style="margin-top:110px;">
    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 col-xl-8 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-3 py-0">
                                <img src="img/register.jpg" class="card-img" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 border-0 mb-0 px-2 py-4">
                                    <div class="card-header border-0 pt-50 pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Recover your password</h4>
                                        </div>
                                    </div>
                                    <p class="px-2 mx-auto">Please provide the Email address associated with your account.</p>
                                    <div class="card-body pt-0">
                                        <form role="form" method="POST" action="process_forgot.php">
                                            <div class="form-row pt-3">
                                                <?php alert();?>
                                                <div class="col-12 form-group">
                                                    <label class="sr-only" for="email">Email address</label>
                                                    <div class="input-group mb-2 mr-sm-2">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                                                        </div>
                                                        <input type="email" class="form-control login-email" id="email" name="email" placeholder="Email address"
                                                        <?php patchValue('email'); ?>
                                                        >
                                                    </div>
                                                    <?php formActionError('forgot_error', 'email_error'); ?>
                                                </div>
                                            </div>
                                                <div class="form-group">
                                                    <a role="button" href="login.php" class="btn btn-outline-primary pull-left">
                                                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Login</a>
                                                    <button type="submit" class="btn btn-primary pull-right">Send code</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <p class="text-center">Not yet registered? <a href="register.php">Register here</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include_once('lib/footer.php') ?>