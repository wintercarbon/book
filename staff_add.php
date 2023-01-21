<?php

session_start();


//check if user is logged in
if (!isset($_SESSION['staffid'])) {
    header('Location: index.php');

}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$inventory = new Inventory();
$staff = new Staff();
$book = new BOOK();
$supplier = new Supplier();
$staffname = $staff->getStaffFullName($staffid);
$staffpos = $staff->getStaffPosition($staffid);

//manager
if ($staffpos == 'Manager') {
    $isManager = true;
} else {
    $isManager = false;
}

//check not manager go to dashboard
if (!$isManager) {
        header ('Location: dashboard.php');
}
?>

<?php
//add
if (isset($_POST['add'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $salary = floatval($_POST['salary']);
    $date = $_POST['hire_date'];
    $hire_date = date("d-M-Y", strtotime($date));

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $position = $_POST['position'];
    $supervisor_id = $_POST['supervisor_id'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $checksalary = is_numeric($salary);
    $checksupervisor = is_numeric($supervisor_id);



    $result = $staff->insertStaff($first_name, $last_name, $phone_number, $hire_date, $email, $address, $position, floatval($salary), $supervisor_id, $password);
    if ($result) {
        $newstaff = $staff->getStaffIdSeq();
        echo "'<script>alert('Staff added successfully')</script>";
        echo '<script>window.location.href = "staff_details.php?staffid=' . $newstaff . '"</script>';
    } else {
        echo "<script>alert('Fail to add staff')</script>";
        echo '<script>window.location.href = "staff_add.php"</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Book Inventory Management System</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">

    <div class="header">
            <div class="header-left active">
                <a href="dashboard.php" class="logo">
                    <img src="assets/img/logos.png" alt="">
                </a>
                <a href="dashboard.php" class="logo-small">
                    <img src="assets/img/logos.png" alt="">
                </a>
            </div>
            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="assets/img/luffy.png" alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>
                                        <?php
                                        echo $staffname;
                                        ?>
                                    </h6>
                                    <h5><?php
                                    echo $staffpos;
                                    ?></h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="logout.php"><img
                                    src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                    Dashboard</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Staff Management</h4>
                        <h6>Add Staff</h6>
                    </div>
                    <div class="page-btn">
                        <a href="staff_view.php" class="btn btn-added">Back</a>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="my-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                method="POST">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input type="number" name="salary" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Hire Date</label>
                                        <input type="date" name="hire_date" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="pass-input" placeholder="Enter password"
                                            name="password"> <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <div class="form-group">
                                            <select name="position" class="select">
                                                <option>Staff</option>
                                                <option>Manager</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supervisor Id</label>
                                        <?php
                                        $gml = $staff->getManagerList();
                                        if (!is_null($gml)) {
                                            echo "<select name='supervisor_id' class='select'>";
                                            foreach ($gml as $row) {
                                                echo "<option value='" . $row['STAFFID'] . "'>" . $row['STAFFID'] . " " . $row['FULLNAME'] . "</option>";
                                            }
                                            echo "<option value=''>None</option>";
                                        }
                                        echo "</select>";

                                        ?>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" name="add" value="Add"
                                        class="btn btn-submit me-2"></input>
                                    <a href="staff_view.php" class="btn btn-cancel">Cancel</a>
                                </div>

                        </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>