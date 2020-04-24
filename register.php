<?php session_start() ?>

   <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNH | Hospital for the ignorant</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forgot_password.php">Forgot password</a>
                </li>
            </ul>
            <div class="mx-auto">
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
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['last_name'];}?>
                                >
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['email'];}?>
                                >
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['password'];}?>
                                >
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['gender'];}?>>
                                    <option value="">Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <select name="designation" id="designation" <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['designation'];}?>>
                                    <option value="">Select</option>
                                    <option value="medical_team">Medical Team</option>
                                    <option value="patient">Patient</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" name="department"
                                    <?php if(isset($_SESSION) && !empty($_SESSION) && isset($_SESSION['formData'])) {echo "value=".$_SESSION['formData']['department'];}?>
                                    >
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>