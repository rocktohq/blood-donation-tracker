<?php

include '../includes/config.php';
include '../includes/functions.php';

$message = "";

if(isset($_POST['login'])) {
    // Email
    if(isset($_POST['email'])) {
        $email = $con->real_escape_string($_POST['email']);
        $email = strtolower($email);
    } else {
        $message = "Username is required!";
    }

    // Password
    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    } else {
        $message = "Password is required!";
    }


    // Fetch the Password from DB
    $sql = "SELECT `password` FROM `admin` WHERE `email` = '$email'";
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Compare the Passwords
        if(password_verify($password, $hashed_password)) {
            // Start the session
            session_start();
            $_SESSION["admin"] = "admin";
            
            header("Location: index.php");
        } else { 
            $message = 'Incorrect password!';
        }  
    } else {
        $message = "User doesn't exist!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <meta property="og:title" content="Blood Donation Tracker - bdT">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Blood Donation Tracker - bdT">

    <!-- ./CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- CSS/. -->

    <!-- ./FAVICON -->
    <link rel="shortcut icon" href="../assets/images/icon.png" type="image/x-icon">
    <!-- FAVICON/. -->

</head>

<body>
    <!-- ./HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php"><span class="text-success">bd</span><span class="text-danger">Tracker</span></a>
                <span class="navbar-brand">Admin Login</span>
            </div>
        </nav>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 login-main my-3">
                    <div class="m-auto login-profile">
                        <img src="../assets/images/admin.png" alt="">
                    </div>
                    <h3 class="text-center my-3">Login here to get access</h3>
                    <?php 
                        if(!empty($message)) {
                            echo "<p class='mb-2 text-center text-danger'>{$message}</p>";
                        }
                    ?>
                    <form action="login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                            <label for="email">Email Address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-success" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN./ -->
    
    <!-- ./FOOTER -->
    <?php include '../includes/footer.php'; ?>
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
    <script src="../assets/js/main.js"></script>
    <!-- JS./ -->
</body>

</html>