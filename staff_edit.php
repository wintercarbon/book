<?php

session_start();

// get staffid from url
$staffid = $_GET['staffid'];

// check if user is logged in
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

// is manager
if ($staffpos == 'Manager') {
    $isManager = true;
} else {
    $isManager = false;
}

// check not manager go to dashboard
if (!$isManager) {
    header('Location: dashboard.php');
}

?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $pstaffid = $_POST['staffid'];
    $pfirstname = $_POST['first_name'];
    $plastname = $_POST['last_name'];
    $pphonenumber = $_POST['phone'];
    $psalary = $_POST['salary'];
    $pposition = $_POST['position'];
    $pemail = $_POST['email'];
    $paddress = $_POST['address'];
    if(isset($_POST['supervisor_id'])) {
        $psupervisor_id = $_POST['supervisor_id'];
    } else {
        $psupervisor_id = null;
    }

    if ($result = $staff->updateStaff($pstaffid, $pfirstname, $plastname, $pphonenumber, $pemail, $paddress, $pposition, $psalary, $psupervisor_id)) {
        echo "<script>alert('Staff update successfully!');</script>";
    } else {
        echo "<script>alert('Staff update failed!');</script>";
    }
}

// delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $staffid = $_POST['staffid'];
    if ($result = $staff->deleteStaff($staffid)) {
        echo "<script>alert('Staff deleted successfully!');</script>";
        echo '<script>window.location.href = "staff_view.php"</script>';
    } else {
        echo "<script>alert('Staff delete failed!');</script>";
    }
}
?>
<?php


$detail = $staff->getStaffDetails($_GET['staffid']);
$detail_staffid = "N/A";
$detail_first_name = "N/A";
$detail_last_name = "N/A";
$detail_phone_number = "N/A";
$detail_salary = "N/A";
$detail_hire_date = "N/A";
$detail_password = "N/A";
$detail_position = "N/A";
$detail_email = "N/A";
$detail_address = "N/A";
$detail_supervisor_id = "N/A";
if (!is_null($detail)) {
    foreach ($detail as $details) {
        $detail_staffid = $details['STAFFID'];
        $detail_first_name = $details['FIRST_NAME'];
        $detail_last_name = $details['LAST_NAME'];
        $detail_phone_number = $details['PHONE_NUMBER'];
        $detail_salary = $details['SALARY'];
        $detail_hire_date = $details['HIRE_DATE'];
        $detail_position = $details['POSITION'];
        $detail_email = $details['EMAIL'];
        $detail_address = $details['ADDRESS'];
        if (isset($details['SUPERVISOR_ID'])) {
            $detail_supervisor_id = $details['SUPERVISOR_ID'];
        } else {
            $detail_supervisor_id = "N/A";
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
                        <h6>Edit/Update Staff</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="my-3"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?staffid=" . $detail_staffid; ?>"
                                method="POST">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="number" name="staffid" value="<?php echo $detail_staffid; ?>"
                                                hidden>
                                            <label>Staff ID</label>
                                            <input type="number" value="<?php echo $detail_staffid; ?>" disabled>
                                        </div>
                                        <label>First Name</label>
                                        <input type="text" name="first_name" value="<?php echo $detail_first_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" value="<?php echo $detail_last_name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="<?php echo $detail_phone_number; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="<?php echo $detail_address; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input type="number" name="salary" value="<?php echo $detail_salary; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="<?php echo $detail_email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <?php
                                        if ($detail_position == 'Manager') {
                                            echo "<input type='text' name='position' value='Manager' hidden>";
                                            echo "<select class='select' disabled>";
                                            echo "<option selected>Manager</option>";
                                        } else {
                                            echo "<select name='position' class='select'>";
                                            if ($detail_position == "Staff") {
                                                echo "<option selected>Staff</option>";
                                                echo "<option>Manager</option>";
                                            } else {
                                                echo "<option>Staff</option>";
                                                echo "<option selected>Manager</option>";
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Supervisor ID</label>
                                        <?php
                                        $gml = $staff->getManagerList();
                                        if (!is_null($gml)) {
                                            echo "<select name='supervisor_id' class='select'>";
                                            foreach ($gml as $row) {
                                                // check if user supervisorid = staffid
                                                if ($row['STAFFID'] !== $detail_staffid) {
                                                    if ($detail_supervisor_id == $row['STAFFID']) {
                                                        echo "<option value='" . $row['STAFFID'] . "' selected>" . $row['STAFFID'] . " " . $row['FULLNAME'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $row['STAFFID'] . "'>" . $row['STAFFID'] . " " . $row['FULLNAME'] . "</option>";
                                                    }
                                                }
                                            }
                                            echo "<option value='' Selected>None</option>";
                                            echo "</select>";
                                        }
                                        
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Hire date</label>
                                        <?php
                                        $newDate = date("Y-m-d", strtotime($detail_hire_date));
                                        ?>
                                        <input type="date" name="hire_date" value="<?php echo $newDate; ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <input type="submit" name="update" value="Update" class="btn btn-submit me-2">
                                    <?php
                                    echo "<a href= 'staff_details.php?staffid=$detail_staffid' class= 'btn btn-primary'>Cancel</a>";
                                    ?>
                                </div>
                            </form>

                            <form class="border-bottom"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?staffid=" . $detail_staffid; ?>"
                                method="POST" id="deleteForm"
                                onsubmit="return confirm('Are you sure you want to delete the user?');">

                                <?php

                                if ($detail_position == "Manager" && $detail_supervisor_id == "N/A") {
                                    echo "<input type='submit' name='delete' value='Delete' class='btn btn-danger' disabled>";
                                } else {
                                    echo "<input type='submit' name='delete' value='Delete' class='btn btn-danger'>";
                                }

                                ?>
                                <input type="number" name="staffid" value="<?php echo $detail_staffid; ?>" hidden>
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