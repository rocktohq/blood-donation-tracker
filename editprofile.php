<?php
    # Start the Session
    session_start();

    if(isset($_SESSION['userid'])) {

    # Includes
    include './includes/config.php';
    include './includes/functions.php';

    $userid = $_SESSION['userid'];

    // User Information
    $sql = "SELECT * FROM `user` WHERE `id` = '$userid'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    if(isset($_POST['update'])) {

        $name = $con->real_escape_string($_POST['fullname']);
        if(empty($name)) {
            $name = $row['name'];
        }
        $gender = $con->real_escape_string($_POST['gender']);
        if(empty($gender)) {
            $gender = $row['gender'];
        }
        $blood_group = $con->real_escape_string($_POST['bloodgroup']);
        if(empty($blood_group)) {
            $blood_group = $row['blood_group'];
        }
        $email = $con->real_escape_string($_POST['email']);
        if(empty($email)) {
            $email = $row['email'];
        }
        $phone = $con->real_escape_string($_POST['phone']);
        if(empty($phone)) {
            $phone = $row['phone'];
        }
        $address =  $con->real_escape_string($_POST['address']);
        if(empty($address)) {
            $address = $row['address'];
        }
        $bio =  $con->real_escape_string($_POST['bio']);
        if(empty($bio)) {
            $bio = $row['bio'];
        }


        // Photo
        if(isset($_FILES['photo'])) {
            $filename = $_FILES["photo"]["name"];

            if(!empty($filename)) {
                $tempname = $_FILES["photo"]["tmp_name"];
                $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                $folder = "./uploads/profile/";
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
                $photo =  $row['photo'];
            }
        }

        // SQL QUERY
        $sql = "UPDATE
                    `user`
                SET
                    `name` = '$name',
                    `gender` = '$gender',
                    `blood_group` = '$blood_group',
                    `phone` = '$phone',
                    `bio` = '$bio',
                    `address` = '$address',
                    `photo` = '$photo',
                    `email` = '$email'
                WHERE
                    `id` = '$userid'";
        $result = $con->query($sql);
        if($result) {
            $_SESSION['message'] = "Profile Updated Successfully";
            header("Location: editprofile.php");
        }else {
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
    <title>Update Profile</title>

    <!-- ./CSS -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                            <a class="nav-link" href="index.php"><i class="bi bi-house-door-fill"></i> Requestfeed</a>
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
                    
                    <div class="card border-0 mb-3">
                        <div class="card-header mb-3">
                            <span class="text-muted">Fill up the form to Register</span>
                        </div>
                        <?php
                        
                        // Notification
                        if(isset($notification)) {
                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                        }
                        
                        ?>
                        <form action="editprofile.php" method="POST" enctype="multipart/form-data">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($row['name']); ?>">
                                <label for="fullname">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="bloodgroup" id="bloodgroup">
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
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($row['email']); ?>">
                                <label for="email">Email Address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($row['phone']); ?>">
                                <label for="phone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo htmlspecialchars($row['address']); ?>">
                                <label for="address">Address</label>
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label"><span class="text-muted">Bio</span></label>
                                <textarea class="form-control" name="bio" id="bio" rows="5"><?php echo htmlspecialchars($row['bio']); ?>"</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"><span class="text-muted">Upload Profile Picture</span></label>
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success" name="update">Update Profile</button>
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