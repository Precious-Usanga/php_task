<?php 
        include_once('lib/header.php');
        require_once('functions/session.php'); 
        acl_redirect();
        require_once('functions/form.php');
        require_once('functions/alertHandler.php');
        
    
?>

<main style="margin-top:110px;">
    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-xl-10 col-lg-8 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-5 d-lg-block d-none text-center align-self-center px-3 py-0">
                                <img src="img/register.jpg" class="card-img" alt="branding logo">
                            </div>
                            <div class="col-lg-7 col-12 p-0">
                                <div class="card rounded-0 border-0 mb-0 px-2 py-4">
                                    <div class="card-header border-0 pt-50 pb-1">
                                        <div class="card-title text-center">
                                            <h4 class="mb-0">Create Account</h4>
                                        </div>
                                    </div>
                                    <p class="px-2 mx-auto">Fill the below form to create a new account.</p>
                                    <div class="card-body pt-0">
                                        <form role="form" method="POST" action="process_register.php">
                                            <div class="form-row">
                                                <?php alert();?>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                                            <?php patchValue('first_name'); ?>
                                                        >
                                                        <?php formActionError('register_error', 'firstname_error'); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                                        <?php patchValue('last_name'); ?>
                                                        >
                                                        <?php formActionError('register_error', 'lastname_error'); ?>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <label for="email">Email address</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                        <?php patchValue('email'); ?>
                                                        >
                                                        <?php formActionError('register_error', 'email_error'); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" id="password" name="password">
                                                        <?php formActionError('register_error', 'password_error'); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="department">Department</label>
                                                        <select class="form-control" name="department" id="deparment">
                                                            <option value="">--Select Dept--</option>
                                                            <option value="emergency" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'emergency') {echo "selected";}?> >
                                                                Emergency
                                                            </option>
                                                            <option value="icu" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'icu') { echo "selected";}?> >
                                                                ICU
                                                            </option>
                                                            <option value="cardiology" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'cardiology') {echo "selected";}?> >
                                                                Cardiology
                                                            </option>
                                                            <option value="radiology" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'radiology') { echo "selected";}?> >
                                                                Radiology
                                                            </option>
                                                            <option value="neurology" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'neurology') {echo "selected";}?> >
                                                                Neurology
                                                            </option>
                                                            <option value="oncology" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'oncology') { echo "selected";}?> >
                                                                Oncology
                                                            </option>
                                                            <option value="obstetrics" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'obstetrics') {echo "selected";}?> >
                                                                Obstetrics
                                                            </option>
                                                            <option value="gynaecology" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['department'] == 'gynaecology') { echo "selected";}?> >
                                                                Gynaecology
                                                            </option>
                                                        </select>
                                                        <?php formActionError('register_error', 'department_error'); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="gender">Gender</label>
                                                        <select class="form-control" name="gender" id="gender">
                                                            <option value="">--Select Gender--</option>
                                                            <option value="male" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['gender'] == 'male') {echo "selected";}?> >
                                                                Male
                                                            </option>
                                                            <option value="female" <?php if(isset($_SESSION['formData']) && $_SESSION['formData']['gender'] == 'female') { echo "selected";}?> >
                                                                Female
                                                            </option>
                                                        </select>
                                                        <?php formActionError('register_error', 'gender_error'); ?>
                                                    </div>
                                                    <div class="col-lg-6 col-12 form-group">
                                                        <label for="designation">Designation</label>
                                                        <select class="form-control" name="designation" id="designation">
                                                            <option value="">--Select designation--</option>
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
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary pull-right">Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <p class="text-center">Already Registered? <a href="login.php">Login</a></p>
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