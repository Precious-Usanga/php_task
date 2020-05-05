<?php include_once('lib/header.php') ?>

    <?php if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {?>
        <div class="alert alert-success" role="alert">
            <?php 
                echo $_SESSION['success'];
            ?>
        </div>
    <?php } ?>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_login.php">
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
                        <input type="email" class="form-control" id="email" name="email"
                        <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['email'];}?>
                        >
                        <?php if(isset($_SESSION['login_error']) && !empty($_SESSION['login_error']['email_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['login_error']['email_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php if(isset($_SESSION['login_error']) && !empty($_SESSION['login_error']['password_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['login_error']['password_error']; 
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