<?php
    # Start the Session
    session_start();

    if(isset($_SESSION['userid'])) {

    # Includes
    include './includes/config.php';
    include './includes/functions.php';

    $userid = $_SESSION['userid'];

    if(isset($_POST['submit'])) {
        $number =  $con->real_escape_string($_POST['number']);
        $trxid =  $con->real_escape_string($_POST['trxid']);
        $ammount =  $con->real_escape_string($_POST['ammount']);
        $name = userName($userid);


        // SQL
        $sql = "INSERT INTO `donation`(
            `phone`,
            `ammount`,
            `trxid`,
            `name`
        )
        VALUES(
            '$number',
            '$ammount',
            '$trxid',
            '$name'
        )";

        $result = $con->query($sql);
        if($result) {
            $notification = "Donation Added and Waiting for Admin Approval.";
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
    <title>Donate Money</title>

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
                            <a class="nav-link active text-danger" href="donate.php"><i class="bi bi-currency-exchange"></i> Donate Money</a>
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
                    <div class="mb-3 request">
                        <a class="btn btn-success" href="donation.php">Donation List</a>
                    </div>
                    <div class="card border-0 mb-3">
                        <div class="card-header mb-3">
                            <span class="text-muted">How to Donate</span>
                        </div>
                        <div class="card-body">
                            <p>1. Open bKash application or simply type *247# to open bKash USSD terminal.</p>
                            <p>3. Send Money to our personal number: <span class="text-success fw-bold">01711 112233</span>.</p>
                            <p>3. After done that, submit some information related to your donation bellow.</p>
                        </div>
                    </div>
                    <div class="card border-0 mb-3">
                        <div class="card-header mb-3">
                            <span class="text-muted">Donation Information</span>
                        </div>
                        <!-- Notification -->
                        <?php 
                        
                        // Notification
                        if(isset($notification)) {
                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                        }
                        
                        ?>

                        <form action="donate.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" name="number" class="form-control" id="number" placeholder="bKash Number" required>
                                <label for="number">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="trxid" class="form-control" id="trxid" placeholder="trxid" required>
                                <label for="trxid">TrxID</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" name="ammount" class="form-control" id="ammount" placeholder="Ammount" required>
                                <label for="trxid">Amount</label>
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success" name="submit">Submit</button>
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
<?php } else {
    header("Location: login.php");
}