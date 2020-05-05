<?php include('lib/header.php'); 
    if(isset($_SESSION['loggedIn'])) {
        if($_SESSION['role'] === 'patient') {
            header("Location: patients_dashboard.php");
            die();
        } elseif ($_SESSION['role'] === 'medical_team') {
            header("Location: medic_team_dashboard.php");
            die();
        } elseif ($_SESSION['role'] === 'admin'){
            header("Location: dashboard.php");
            die();
        }
    }
?>

    <div class="container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_register.php">
                    <?php if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {?>
                        <div class="alert alert-warning" role="alert">
                            <?php 
                                echo $_SESSION['error']; 
                                session_destroy();
                            ?>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['first_name'];}?>
                            >
                            <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['firstname_error'])) {?>
                                <small class="form-text text-danger">
                                    <?php 
                                        echo $_SESSION['register_error']['firstname_error']; 
                                        session_destroy();
                                    ?>
                                </small>
                            <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                        <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['last_name'];}?>
                        >
                        <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['lastname_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['register_error']['lastname_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                        <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['email'];}?>
                        >
                        <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['email_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['register_error']['email_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                        <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['password'];}?>
                        >
                        <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['password_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['register_error']['password_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option value="">Select</option>
                            <option value="male" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['gender'] == 'male') {echo "selected";}?> >
                                Male
                            </option>
                            <option value="female" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['gender'] == 'female') { echo "selected";}?> >
                                Female
                            </option>
                        </select>
                        <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['gender_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['register_error']['gender_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <select name="designation" id="designation">
                            <option value="">Select</option>
                            <option value="admin" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['designation'] == 'admin') {echo "selected";}?> >
                                Admin
                            </option>
                            <option value="medical_team" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['designation'] == 'medical_team') {echo "selected";}?> >
                                Medical Team
                            </option>
                            <option value="patient" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['designation'] == 'patient') {echo "selected";}?> >
                                Patient
                            </option>
                        </select>
                        <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['designation_error'])) {?>
                            <small class="form-text text-danger">
                                <?php 
                                    echo $_SESSION['register_error']['designation_error']; 
                                    session_destroy();
                                ?>
                            </small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department"
                            <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['department'];}?>
                            >
                            <?php if(isset($_SESSION['register_error']) && !empty($_SESSION['register_error']['department_error'])) {?>
                                <small class="form-text text-danger">
                                    <?php 
                                        echo $_SESSION['register_error']['department_error']; 
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