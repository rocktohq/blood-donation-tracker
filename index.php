<?php
    # Start the Session
    session_start();

    if(isset($_SESSION['userid'])) {

    # Includes
    include './includes/config.php';
    include './includes/functions.php';

    $userid = $_SESSION['userid'];

    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requestfeed</title>

    <!-- ./CSS -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/wall.css">
    <!-- CSS/. -->

    <!-- ./FAVICON -->
    <link rel="shortcut icon" href="./assets/images/icon.png" type="image/x-icon">
    <!-- FAVICON/. -->

</head>

<body>
    <!-- ./HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><span class="text-success">bd</span><span class="text-danger">Tracker</span></a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="fa-1"><i class="bi bi-list"></i></span>
		    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php"><i class="bi bi-house-door-fill"></i> Requestfeed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="completed.php"><i class="bi bi-check-square-fill"></i> Completed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="members.php"><i class="bi bi-people-fill"></i> Members</a>
                        </li>
                        <li class="donate-money">
                            <a class="nav-link text-danger" href="donate.php"><i class="bi bi-currency-exchange"></i> Donate Money</a>
                        </li>
                    </ul>
                    <div>
                        <!-- Profile Options -->
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="profile.php?id=<?php echo $userid; ?>">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="editprofile.php">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="changepass.php">Change Password</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Profile Options -->
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="mb-3 request">
                        <a class="btn btn-success" href="request.php">Add Request</a>
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

                        

                    ?>
                    
                    <?php 

                    # Data to display
                    $sql = "SELECT * FROM `request` ORDER BY id DESC LIMIT 10";
                    $result = $con->query($sql);
                    if($result->num_rows > 0) {
                        while($rows = $result->fetch_assoc()) {

                            if(empty($rows['completed'])) {

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
                        <div class="card-header d-flex justify-content-evenly author-time">
                            <div><?php   echo requestedby($rows['author_id']); ?></div>
                            <div><span class="text-muted"><?php echo $time; ?></span></div>
                        </div>
                        <div class="card-body">
                            <div class="patient-details">
                                <div class="patient-pic">
                                    <?php echo "<img class='responsive' src='./uploads/wall/{$photo}' alt=''>"; ?>
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
    </main>
    <!-- MAIN./ -->

    <!-- ./FOOTER -->
    <?php include './includes/footer.php'; ?>
    <!-- FOOTER./ -->

    <!-- ./LOADER -->
    <div id="pre-loader">
        <div class="loader"></div>
        <div class="loader-text">LOADING</div>
    </div>
    <!-- LOADER./ -->

    <!-- ./JS -->
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/bootstrap/js/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./assets/js/main.js"></script>

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