
    <div class="card border-0 bg-transparent mb-3">
        <div class="row p-2">
            <div class="col-md-3">
                <div class="card bg-info">
                    <div class="card-header">NAME</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_SESSION['fullname']; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-secondary">
                    <div class="card-header">DEPARTMENT</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_SESSION['department']; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning">
                    <div class="card-header">ROLE</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_SESSION['role']; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success">
                    <div class="card-header">LAST LOGIN</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $_SESSION['lastLogin']; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 mb-3">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 bg-light mb-3">
                    <div class="card-header"><?php echo $_SESSION['fullname']; ?></div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Role: <?php echo $_SESSION['role']; ?></li>
                                <li class="list-group-item">Department: <?php echo $_SESSION['department']; ?></li>
                                <li class="list-group-item">Date of Registration: <?php echo $_SESSION['dateOfReg']; ?></li>
                                <li class="list-group-item">Last Login: <?php echo $_SESSION['lastLogin']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>