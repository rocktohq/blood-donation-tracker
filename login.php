<?php

include './includes/config.php';
include './includes/functions.php';

$message = "";

if(isset($_POST['login'])) {
    // Email
    if(isset($_POST['email'])) {
        $email = $con->real_escape_string($_POST['email']);
        $email = strtolower($email);
    } else {
        $message = "Email is required!";
    }

    // Password
    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    } else {
        $message = "Password is required!";
    }


    // Fetch the Password from DB
    $sql = "SELECT `password`, `id` FROM `user` WHERE `email` = '$email'";
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Compare the Passwords
        if(password_verify($password, $hashed_password)) {
            // Start the session
            session_start();
            $_SESSION["userid"] = $row['id'];
            
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
    <title>Login - Blood Donation Tracker</title>
    <meta property="og:title" content="Blood Donation Tracker - bdT">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Blood Donation Tracker - bdT">
    <meta property="og:image" content="https://bdt.netlify.app/assets/images/og-img.png">
    <meta property="og:url" content="https://bdt.netlify.app">

    <!-- ./CSS -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="./assets/css/style.css">
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
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="donate-money">
                            <a class="nav-link text-danger" href="donate.php"><i class="bi bi-currency-exchange"></i> Donate Money</a>
                        </li>
                    </ul>
                    <div>
                        <a class="btn btn-outline-danger" href="login.php">Login</a>
                        <a class="btn btn-success" href="register.php">Register</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-5">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-sm-6 slogan">
                    <h1 class="mt-3 text-center"><span class="text-danger">Donate Blood,</span> <span class="text-success">Save Life!</span></h1>
                    <h5 class="mb-3 text-center">- Spread the red love -</h5>
                    <img src="./assets/images/blood-donor.jpg" alt="">
                </div>
                <div class="col-sm-6 login-main my-3">
                    <div class="m-auto login-profile">
                        <img src="./assets/images/avatar.png" alt="">
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
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-success" name="login">Login</button>
                        </div>
                    </form>
                    <div class="mt-4">
                        <div>
                            - <a href="forgot.php">Forgot password?</a>
                        </div>
                        <div>
                            - Don't have account? <a href="register.php">Register now!</a>
                        </div>
                    </div>
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
    <script src="./assets/js/main.js"></script>
    <!-- JS./ -->
</body>

</html>