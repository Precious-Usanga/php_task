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
    <h1>PATIENT DASHBOARD</h1>
    <p>Welcome! <?php echo $_SESSION['fullname'] . " " ."You're logged in as ".$_SESSION['role'].". Your Id is ".$_SESSION['loggedIn'] ?></p>
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Role: <?php echo $_SESSION['role']; ?></li>
            <li class="list-group-item">Department: <?php echo $_SESSION['department']; ?></li>
            <li class="list-group-item">Date of Registration: <?php echo $_SESSION['dateOfReg']; ?></li>
            <li class="list-group-item">Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
        </ul>
    </div>
    
    <?php include_once('lib/footer.php') ?>