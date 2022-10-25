<?php

# Start the Session
session_start();

if(isset($_SESSION['userid'])) {

# Includes
include './includes/config.php';
include './includes/functions.php';

$userid = $_SESSION['userid'];
$message = "";

if(isset($_POST['request'])) {

    //print_r($_POST);

    $quantity = $con->real_escape_string($_POST['quantity']);
    $description = $con->real_escape_string($_POST['description']);
    $blood_group = $con->real_escape_string($_POST['bloodgroup']);
    $date = $con->real_escape_string($_POST['date']);
    $contact = $con->real_escape_string($_POST['contact']);
    $hospital =  $con->real_escape_string($_POST['hospital']);


    // Photo
    if(isset($_FILES['photo'])) {
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
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
    }

   
    if(empty($message)) {
        $sql = "INSERT INTO `request`(
            `author_id`,
            `description`,
            `blood_group`,
            `quantity`,
            `date`,
            `contact`,
            `hospital`,
            `photo`
        )
        VALUES(
            '$userid',
            '$description',
            '$blood_group',
            '$quantity',
            '$date',
            '$contact',
            '$hospital',
            '$photo'
        )";

        $result = $con->query($sql);
        if($result) {
            $_SESSION['message'] = "Request for blood has been added.";
            header("Location: index.php");
        }else {
            $notification = "Something went wrong!";
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
    <title>Request for Blood</title>

    <!-- ./CSS -->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
    <main class="mt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <div class="card border-0 mb-3">
                        <div class="card-header mb-3">
                            <span class="text-muted">Fill up all the information</span>
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
                        <form action="request.php" method="POST" enctype="multipart/form-data">

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
                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                                <label for="quantity">Quantity</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                                <label for="date">Date</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact Number">
                                <label for="contact">Contact Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="hospital" id="hospital" placeholder="Hospital">
                                <label for="hospital">Hospital Address</label>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label"><span class="text-muted">Short Description</span></label>
                                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label"><span class="text-muted">Upload Patient's Picture</span> [Optional]</label>
                                <input class="form-control" name="photo" type="file" id="photo" accept="image/*">
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success" name="request">Add Request</button>
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

<?php 
} else {
    header("Location: login.php");
}