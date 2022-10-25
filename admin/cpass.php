<?php
    # Start the Session
    session_start();
    
    if(isset($_SESSION['admin'])) {

        $admin = $_SESSION['admin'];
        if(isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
        }

        # Includes
        include '../includes/config.php';
        include '../includes/functions.php';

        if(isset($_POST['change'])) {

            // print_r($_POST);
        
            $oldpass = $con->real_escape_string($_POST['old']);
            $newpass = $con->real_escape_string($_POST['new']);
            $newhpass = password_hash($newpass, PASSWORD_DEFAULT);
    
            $sql = "SELECT `password` FROM `admin` WHERE `name` = '$admin'";
            $result = $con->query($sql);
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $mainpass = $row['password'];
    
                // Compare the Passwords
                if(password_verify($oldpass, $mainpass)) {
                    
                    $sql = "UPDATE
                            `admin`
                        SET
                            `password` = '$newhpass'
                        WHERE 
                            `name` = '$admin'";
                    $result = $con->query($sql);
                    if($result) {
                        $_SESSION['message'] = "Admin Password Has Been Changed.";
                        header("Location: cpass.php");
                    } else {
                        $notification = "Something Went Wrong!";
                        $border = 'danger';
                    }
    
                } else { 
                    $notification = 'Incorrect Old Password!';
                    $border = 'danger';
                }
            }
    
        }
        
        
    ?>
    
    
    
    <!DOCTYPE html>
    <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Change Password</title>
            
            <!-- ./CSS -->
            <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
            <link rel="stylesheet" href="../assets/css/style.css">
            <!-- CSS/. -->
            
            <!-- ./FAVICON -->
            <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon">
            <!-- FAVICON/. -->
            
        </head>
        
        <body>
            <!-- ./HEADER -->
            <header>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container">
                        <a class="navbar-brand" href="index.php"><span class="text-success">ADMIN</span><span class="text-danger">CP</span>
                        </a>
                    </div>
                </nav>
            </header>
            <!-- HEADER./ -->
            
            <!-- ./MAIN -->
            <main>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Nav -->
                        <div class="col-md-3">
                            <nav class="navbar-dark bg-dark">
                                <ul class="navbar-nav">
                                    <li class="px-3">
                                        <a class="nav-link" href="index.php">
                                            <span class="me-2">
                                        <i class="bi bi-speedometer2"></i>
                                    </span>
                                            <span>
                                        Dashboard
                                    </span>
                                        </a>
                                    </li>
                                    <li class="my-2">
                                        <hr class="dropdown-divider bg-light">
                                    </li>
                                    <li>
                                        <div class="text-muted small fw-bold text-uppercase px-3">
                                            Management
                                        </div>
                                    </li>
                                    <!-- Departments -->
                                    <li>
                                        <a class="nav-link px-3" href="members.php">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Members</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="requestfeed.php">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Requestfeed</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="completed.php">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Completed Requests</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="donation.php">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Donation</span>
                                        </a>
                                    </li>
                                    <li class="my-2">
                                        <hr class="dropdown-divider bg-light">
                                    </li>
                                    <li>
                                        <div class="text-muted small fw-bold text-uppercase px-3">
                                            Settings
                                        </div>
                                    </li>
                                    <!-- Setting -->
                                    <li>
                                        <a class="nav-link active px-3" href="cpass.php">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Change Password</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link px-3" href="logout.php">
                                            <span class="me-2"><i class="bi bi-box-arrow-left"></i></span>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                    <li class="my-2">
                                        <hr class="dropdown-divider bg-light">
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <!-- Main -->
                        <div class="col-md-5 offset-md-2">
                            <h2 class="fw-bold">Change Password</h2>
                            <div class="row">
                                <div class="col-sm-6 offset-sm-3">
                                    <div class="card border-0 mb-3">
                                        <div class="card-header mb-3">
                                            <span class="text-muted">Fill up all the information</span>
                                        </div>
                                        <?php
                                        
                                        // Notification
                                        if(!empty($message)) {
                                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <span class='text-success'><i class='bi bi-check-circle-fill'></i></span> <span>{$message}</span>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";

                                            unset($_SESSION['message']);
                                        }

                                        // Error Message
                                        if(isset($notification)) {
                                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                                        }  ?>

                                        <form action="cpass.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="old" id="old" placeholder="Old Password" required>
                                                <label for="old">Old Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="new" id="new" placeholder="New Password" required>
                                                <label for="new">New Password</label>
                                            </div>
                                            <div class="form-floating mt-3">
                                                <button class="btn btn-success" name="change">Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- MAIN./ -->
            
            <!-- ./FOOTER -->
            <?php include '../includes/footer2.php'; ?>
            <!-- FOOTER./ -->
            
            <!-- ./LOADER -->
            <div id="pre-loader">
                <div class="loader"></div>
                <div class="loader-text">LOADING</div>
            </div>
            <!-- LOADER./ -->
            
            <!-- ./JS -->
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../vendor/bootstrap/js/jquery-3.6.0.min.js"></script>
            <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
            <script src="../assets/js/main.js"></script>
            
            <script>
                AOS.init();
            </script>
            
            
            <!-- JS./ -->
        </body>
        
    </html>
    
    <?php }else {
        header("Location: login.php");
    }
?>