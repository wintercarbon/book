<?php

session_start();


//check if user is logged in
if (!isset($_SESSION['staffid'])) {
    header('Location: index.php');

}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$staff = new Staff();
$staffname = $staff->getStaffFullName($staffid);
$staffpos = $staff->getStaffPosition($staffid);

//manager
if ($staffpos == 'Manager') {
    $isManager = true;
} else {
    $isManager = false;
}

?>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_email_phone'])) {

    $staffid = $_SESSION['staffid'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $result = $staff->updateStaffEmailPhone($staffid, $email, $phone);

    if ($result) {
        echo '<script>alert("Update email and phone successfully")</script>';
    } else {
        echo '<script>alert("Update email and phone failed")</script>';
    }
}

// update password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {

    $staffid = $_SESSION['staffid'];
    $oldpassword = $_POST['old_password'];

    if(!isset($_POST['new_password']) || $_POST['new_password'] == '') {
        echo '<script>alert("New password is required")</script>';
    } else {
        $newpassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
        // check old password
        $checkoldpassword = $staff->ceheckPassword($staffid, $oldpassword);
    
        if ($checkoldpassword) {
            // check new password and confirm password
            $result = $staff->updateStaffPassword($staffid, $newpassword);
            if ($result) {
                echo '<script>alert("Update password successfully")</script>';
            } else {
                echo '<script>alert("Update password failed")</script>';
            }
        } else {
            echo '<script>alert("Old password is incorrect")</script>';
        }
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
    <title>Profile | Book Inventory Management System</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/bookx.jpg">

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
                    <img src="assets/img/bookx.jpg" alt="">
                </a>
                <a href="dashboard.php" class="logo-small">
                    <img src="assets/img/bookx.jpg" alt="">
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
                        <span class="user-img"><img src="assets/img/hehe.png" alt="">
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
                        <h4>Profile</h4>
                        <h6>User Profile</h6>
                    </div>
                </div>

                <?php

                $detail = $staff->getStaffDetails($staffid);
                $detail_staffid = "N/A";
                $detail_first_name = "N/A";
                $detail_last_name = "N/A";

                $detail_phone_number = "N/A";
                $detail_password = "N/A";

                $detail_postion = "N/A";

                $supervisorName = "N/A";
                $detail_email = "N/A";

                if (!is_null($detail)) {
                    foreach ($detail as $details) {
                        if (isset($details['SUPERVISOR_ID'])) {
                            $supervisorName = $details['SUPERVISOR_ID'];
                        } else {
                            $supervisorName = "N/A";
                        }
                        $detail_staffid = $details['STAFFID'];
                        $detail_first_name = $details['FIRST_NAME'];
                        $detail_last_name = $details['LAST_NAME'];
                        $detail_phone_number = $details['PHONE_NUMBER'];
                        $detail_salary = $details['SALARY'];
                        $detail_hire_date = $details['HIRE_DATE'];
                        $detail_postion = $details['POSITION'];
                        $detail_email = $details['EMAIL'];
                        $detail_address = $details['ADDRESS'];
                    }

                }

                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" value="<?php echo $detail_first_name; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" value="<?php echo $detail_last_name; ?>" disabled>
                                </div>
                            </div>
                            <p>---</p>
                            <h4>Update</h4>

                            <form class="my-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                method="POST">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="<?php echo $detail_email; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?php echo $detail_phone_number; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" name="update_email_phone" value="Update Email/Phone"
                                        class="btn btn-submit me-2">
                                </div>
                            </form>

                            <form class="my-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                method="POST">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <div class="pass-group">
                                            <input name="old_password" type="password" class="pass-input">
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                        <label>New Password</label>
                                        <div class="pass-group">
                                            <input name="new_password" type="password" class="pass-input">
                                            <span class="fas toggle-password fa-eye-slash"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" name="update_password" value="Update Password"
                                        class="btn btn-submit me-2">
                                </div>
                            </form>
                        </div>
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