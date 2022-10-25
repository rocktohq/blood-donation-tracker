<?php
    # Start the Session
    session_start();
    
    if(isset($_SESSION['admin'])) {

        $admin = $_SESSION['admin'];

        # Includes
        include '../includes/config.php';
        include '../includes/functions.php';

        if(isset($_GET['id'])) {
            $eid = $_GET['id'];

            // Post Information
            $sql = "SELECT * FROM `request` WHERE `id` = '$eid'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            $userid = $row['author_id'];

        }
        
        if(isset($_POST['update'])) {

            // print_r($_POST);
        
            $quantity = $con->real_escape_string($_POST['quantity']);
            if(empty($quantity)) {
                $quantity = $row['quantity'];
            }
            $description = $con->real_escape_string($_POST['description']);
            if(empty($description)) {
                $description = $row['description'];
            }
            $blood_group = $con->real_escape_string($_POST['bloodgroup']);
            if(empty($blood_group)) {
                $blood_group = $row['blood_group'];
            }
            $date = $con->real_escape_string($_POST['date']);
            if(empty($date)) {
                $date = $row['date'];
            }
            $contact = $con->real_escape_string($_POST['contact']);
            if(empty($contact)) {
                $contact = $row['contact'];
            }
            $hospital =  $con->real_escape_string($_POST['hospital']);
            if(empty($hospital)) {
                $hospital = $row['hospital'];
            }
        
        
            // Photo
            if(isset($_FILES['photo'])) {
                $filename = $_FILES["photo"]["name"];

                if(!empty($filename)) {
                    $filename = $_FILES["photo"]["name"];
                    $tempname = $_FILES["photo"]["tmp_name"];
                    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                    $folder = "../uploads/wall/";
                    $photo =  uniqid() . ".". $imageFileType;
            
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        $notification = "Only JPG, JPEG, PNG files are allowed!";
                        $border = "danger";
                    }
            
                    if(!move_uploaded_file($tempname, $folder.$photo)) {
                    $notification = "Photo can't be uploaded!";
                    $border = "warning";
                    }
                } else {
                    $photo = $row['photo'];
                }
                
            }
        
           
            if(empty($notification)) {
                echo $sql = "UPDATE
                                `request`
                            SET
                                `author_id` = '$userid',
                                `description` = '$description',
                                `blood_group` = '$blood_group',
                                `quantity` = '$quantity',
                                `date` = '$date',
                                `contact` = '$contact',
                                `hospital` = '$hospital',
                                `photo` = '$photo'
                            WHERE
                                `id` = '$eid'";
        
                $result = $con->query($sql);
                if($result) {
                    $_SESSION['message'] = "Request Updated Successfully";
                    header("Location: requestfeed.php");
                }else {
                    $notification = "Something Went Wrong!";
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
            <title>Update Request</title>
            
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
                                        <a class="nav-link active px-3" href="requestfeed.php">
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
                            <h2 class="fw-bold">Change Password</h2>
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
                                        
                                        ?>
                                        <form action="requestfeed-update.php?id=<?php echo $eid; ?>" method="POST" enctype="multipart/form-data">

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
                                                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>">
                                                <label for="quantity">Quantity</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?php echo $row['date']; ?>">
                                                <label for="date">Date</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact Number" value="<?php echo htmlspecialchars($row['contact']); ?>">
                                                <label for="contact">Contact Number</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="hospital" id="hospital" placeholder="Hospital" value="<?php echo htmlspecialchars($row['hospital']); ?>">
                                                <label for="hospital">Hospital Address</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label"><span class="text-muted">Short Description</span></label>
                                                <textarea class="form-control" name="description" id="description" rows="5"><?php echo htmlspecialchars($row['description']); ?>"</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo" class="form-label"><span class="text-muted">Upload Patient's Picture</span></label>
                                                <input class="form-control" name="photo" type="file" id="photo" accept="image/*">
                                            </div>
                                            <div class="form-floating mt-3">
                                                <button class="btn btn-success" name="update">Update Request</button>
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