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
            $uid =  $con->real_escape_string($_POST['uid']);

            $sql = "DELETE FROM `user` WHERE `id` = '$uid'";
            $result = $con->query($sql);
            if($result) {
                $notification = "User Deleted!";
                $border = 'success';
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
            <title>Members</title>
            
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
                                        <a class="nav-link active px-3" href="members.php">
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
                            <h2 class="fw-bold">Donation</h2>
                            <div class="row">
                                <div class="col-sm-10 offset-sm-1">
                                    <!-- Notification -->
                                    <?php 
                                    
                                    // Notification
                                    if(isset($notification)) {
                                        echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                                    }
                                    
                                    ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Blood Group</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $i = 1;
                                            $sql = "SELECT * FROM `user`";
                                            $result = $con->query($sql);
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                   
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $i; $i++; ?></th>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['blood_group']; ?></td>
                                                <td><form action="members.php" method="POST">
                                                    <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                                                    <button class="btn btn-danger" type="submit" name="submit">Delete</button>
                                                </form></td>
                                            </tr>
                                            <?php   } } ?>
                                        </tbody>
                                    </table>
                                    
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