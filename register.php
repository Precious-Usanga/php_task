<?php 
        include_once('lib/header.php');
        require_once('functions/session.php'); 
        acl_redirect();
        require_once('functions/form.php');
        require_once('functions/alertHandler.php');
        
    
?>

    <div class="container">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <form role="form" method="POST" action="process_register.php">
                    <?php alert();?>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            <?php patchValue('first_name'); ?>
                        >
                        <?php formActionError('register_error', 'firstname_error'); ?>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                        <?php patchValue('last_name'); ?>
                        >
                        <?php formActionError('register_error', 'lastname_error'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                        <?php patchValue('email'); ?>
                        >
                        <?php formActionError('register_error', 'email_error'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                        <?php patchValue('password'); ?>
                        >
                        <?php formActionError('register_error', 'password_error'); ?>
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
                        <?php formActionError('register_error', 'gender_error'); ?>
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
                        <?php formActionError('register_error', 'designation_error'); ?>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" id="department" name="department"
                            <?php patchValue('department'); ?>
                            >
                            <?php formActionError('register_error', 'department_error'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once('lib/footer.php') ?>