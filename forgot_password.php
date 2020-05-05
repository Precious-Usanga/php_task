<?php include_once('lib/header.php') ?>

    <div class="container">
        <h3>Forgot Password</h3>
        <p>Provide the Email address associated with this account</p>
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_forgot.php">
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
                        <?php if(isset($_SESSION['forgot_error']) && !empty($_SESSION['forgot_error']['email_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['forgot_error']['email_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>