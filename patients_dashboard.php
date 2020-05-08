<?php session_start(); 
    require_once('functions/session.php');
    dashboardCheck('patient');
    require_once('functions/alertHandler.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNH | Hospital for the ignorant</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Passion+One|Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/afe88b558f.js"></script></head>
<body>



<div class="col-2 bg-dark fixed-top" style="height: 100vh;">
    <?php include_once('lib/dashboard/side-nav.php'); ?>
</div>
<div  style="margin-left: 225px;">
    <div class="sticky-top bg-light py-3">
        <?php include_once('lib/dashboard/header.php'); ?>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <?php include_once('lib/dashboard/patient/patient_dashboard.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







    
<?php include_once('lib/footer.php') ?>