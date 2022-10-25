<?php

include './includes/config.php';
include './includes/functions.php';

$message = "";

if(isset($_POST['register'])) {

    $name = $con->real_escape_string($_POST['fullname']);
    $gender = $con->real_escape_string($_POST['gender']);
    $blood_group = $con->real_escape_string($_POST['bloodgroup']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);
    $address =  $con->real_escape_string($_POST['address']);

    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    }else {
        $message = "Password is required!";
    }
    if(isset($_POST['password2'])) {
        $password2 = $con->real_escape_string($_POST['password2']);
    }else {
        $message = "Confirm password is required!";
    }

    if(!empty($password) AND !empty($password2) AND $password !== $password2) {
        $message = "Password didn't match!";
    }


    // Photo
    if(isset($_FILES['photo'])) {
        $filename = $_FILES["photo"]["name"];

        if(!empty($filename)) {
            $tempname = $_FILES["photo"]["tmp_name"];
            $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
            $folder = "./uploads/wall/";
            $photo =  uniqid() . ".". $imageFileType;
            $check = getimagesize($tempname);

            if(!$check) {
                $message = "File isn't an image!";
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $message = "Only JPG, JPEG, PNG files are allowed!";
            }

            if(!move_uploaded_file($tempname, $folder.$photo)) {
            $message = "Photo can't be uploaded!";
            }
        } else {
            $photo = "";
        }
    }

    // Email Exists or Not
    $userexists = userExists($email);

    if($userexists) {
        $message = "Email already exists!";
    }

    // No Error: Now Register the User
    if(empty($message)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user`(
            `name`,
            `gender`,
            `blood_group`,
            `phone`,
            `address`,
            `photo`,
            `email`,
            `password`
        )
        VALUES(
            '$name',
            '$gender',
            '$blood_group',
            '$phone',
            '$address',
            '$photo',
            '$email',
            '$password'
        )";

        $result = $con->query($sql);
        if($result) {
            $notification = "Registration successful. You can login now.";
            $border = 'success';
        } else {
            $notification = "Registration unsuccessful!";
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
    <title>Registration</title>
    <meta property="og:title" content="Registration">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Registration">
    <meta property="og:image" content="https://bdt.netlify.app/assets/images/og-img.png">
    <meta property="og:url" content="https://bdt.netlify.app">

    <!-- ./CSS -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/reg.css">
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
                <a class="navbar-brand" href="index.html"><span class="text-success">bd</span><span class="text-danger">Tracker</span></a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="fa-1"><i class="bi bi-list"></i></span>
		    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        <li class="donate-money">
                            <a class="nav-link text-danger" href="donate.html"><i class="bi bi-currency-exchange"></i> Donate Money</a>
                        </li>
                    </ul>
                    <div>
                        <a class="btn btn-danger" href="login.php">Login</a>
                        <a class="btn btn-outline-success" href="register.php">Register</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-sm-5">
        <div class="container">
            <div class="row mt-2">
                <div class="col-sm-6 offset-sm-3">
                    <div class="card border-0 mb-3">
                        <div class="card-header mb-3">
                            <span class="text-muted">Fill up the form to Register</span>
                        </div>
                        <?php
                        
                        // Notification
                        if(isset($notification)) {
                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                        }
                        // Error Messages
                        if(!empty($message)) {
                            echo "<p class='text-danger text-center'>{$message}</p>";
                        }
                        
                        ?>
                        <form action="register.php" method="POST" enctype="multipart/form-data">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" required>
                                <label for="fullname">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="gender" id="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="bloodgroup" id="bloodgroup" required>
                                    <option value="">Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                <label for="email">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone Number" required>
                                <label for="phone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                <label for="address">Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" required>
                                <label for="password2">Confirm Password</label>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"><span class="text-muted">Upload Profile Picture</span></label>
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success" name="register">Register</button>
                            </div>
                        </form>
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