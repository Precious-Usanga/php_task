<?php session_start(); 
    if(!isset($_SESSION['loggedIn'])) {
        header("Location: login.php");
    }
?>

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

    <?php if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {?>
        <div class="alert alert-success" role="alert">
            <?php 
                echo $_SESSION['success'];
            ?>
        </div>
 
    <?php } ?>
    <h1>DASHBOARD</h1>
    <p>Welcome! <?php echo $_SESSION['fullname'] . " " ."You're logged in as ".$_SESSION['role'].". Your Id is ".$_SESSION['loggedIn'] ?> </p>
    
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Role: <?php echo $_SESSION['role']; ?></li>
            <li class="list-group-item">Department: <?php echo $_SESSION['department']; ?></li>
            <li class="list-group-item">Date of Registration: <?php echo $_SESSION['dateOfReg']; ?></li>
            <li class="list-group-item">Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
        </ul>
    </div>
    <br><br>
    <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Add New Users
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Users</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" method="POST" action="process_register.php" style="overflow-y:auto !important;">
                        <div class="modal-body">
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include_once('lib/footer.php') ?>