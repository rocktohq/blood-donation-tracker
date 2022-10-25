<?php
    # Start the Session
    session_start();
    
    if(isset($_SESSION['admin'])) {
        
        # Includes
        include '../includes/config.php';
        include '../includes/functions.php';
        
        $admin = $_SESSION['admin'];
        
        if(isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
        }

        if(isset($_POST['submit'])) {
            $pid =  $con->real_escape_string($_POST['pid']);

            $sql = "DELETE FROM `request` WHERE `id` = '$pid'";
            $result = $con->query($sql);
            if($result) {
                $_SESSION['message'] = "Post Deleted!";
                header("Location: completed.php");
            } else {
                $notification = "Something Went Wrong!";
                $border = 'danger';
            }

        }
        
        
    ?>
    
    
    
    <!DOCTYPE html>
    <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Completed Requests</title>
            
            <!-- ./CSS -->
            <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/wall.css">
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
                        <a class="navbar-brand" href="index.php"><span class="text-success">ADMIN</span><span class="text-danger">CP</span></a>
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
                                        <a class="nav-link active px-3" href="completed.php">
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
                                        <a class="nav-link px-3" href="cpass.php">
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
                        <div class="col-md-9">
                            <h2 class="fw-bold">Completed Requests</h2>
                            <div class="row">
                                <div class="col-12">
                    
                                    <?php 
                                        
                                        // Notification
                                        if(!empty($message)) {
                                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                            <span class='text-success'><i class='bi bi-check-circle-fill'></i></span> <span>{$message}</span>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";

                                            unset($_SESSION['message']);
                                        }

                                        

                                    ?>
                                    
                                    <?php 

                                        # Data to display
                                        $sql = "SELECT * FROM `request` ORDER BY id DESC LIMIT 10";
                                        $result = $con->query($sql);
                                        if($result->num_rows > 0) {
                                            while($rows = $result->fetch_assoc()) {

                                                if(!empty($rows['completed'])) {

                                                $time = date_create($rows['created_at']);
                                                $time = date_format($time, "d M, Y - h:i A");

                                                $date = date_create($rows['date']);
                                                $date = date_format($date, "d M, Y");

                                                $photo = $rows['photo'];
                                                if(empty($photo)) {
                                                    $photo = "default.jpg";
                                                }

                                    ?>
                                    <div class="card mb-3" data-aos="fade-up">
                                        <div class="card-header d-flex justify-content-evenly align-items-center author-time">
                                            <div><?php   echo requestedby($rows['author_id']); ?></div>
                                            <div class="d-flex justify-content-evenly align-items-center"><span class="text-muted"><?php echo $time; ?></span>
                                                <div class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">OP</a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <li>
                                                    <form action="completed.php" method="POST">
                                                        <input type="hidden" name="pid" value="<?php echo $rows['id']; ?>">
                                                        <button class="no-btn" type="submit" name="submit">Delete Post</button>
                                                    </form>
                                                </li>
                                            </ul>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="patient-details">
                                                <div class="patient-pic">
                                                    <?php echo "<img class='responsive' src='../uploads/wall/{$photo}' alt=''>"; ?>
                                                </div>
                                                <div class="patient-info my-3">
                                                    <h6 class="text-muted">Short Description:</h6>
                                                    <?php echo "<p>{$rows['description']}</p>"; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer blood-info">
                                            <div>
                                                <?php echo "<div><span class='text-muted'>Blood Group: </span><span>{$rows['blood_group']}</span></div>
                                                <div><span class='text-muted'>Quantity(bag): </span><span>{$rows['quantity']}</span></div>
                                                <div><span class='text-muted'>Date: </span><span>{$date}</span></div>
                                                <div><span class='text-muted'>Contact: </span><span>0{$rows['contact']}</span></div>
                                                <div><span class='text-muted'>Hospital: </span><span>{$rows['hospital']}</span></div>"; ?>
                                            </div>

                                        </div>
                                    </div>

                                    <?php   }
                                    
                                        }
                                    }else {
                                        echo "There is no request yet!";
                                    }

                                    ?>
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