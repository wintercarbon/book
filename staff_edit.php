<?php

session_start();

// get bookid from url
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
    $staffid = $_POST['staffid'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $salary = $_POST['salary'];
    $hire_date = $POST['hire_date'];
    $password = $_POST['password'];
    $position = $_POST['position'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $supervisor_id = $POST['supervisor_id'];

    if($result = $staff->updateStaff($staffid, $first_name, $last_name, $phone_number, $salary, $hire_date, $password, $position, $email, $address, $supervisor_id)) {
        
        echo "<script>alert('Staff update successfully!');</script>";
    } else {
        echo "<script>alert('Staff update failed!');</script>";
    }
}

// delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $staffid = $_POST['staffid'];
    if($result = $staff->deleteStaff($staffid)) {
        echo "<script>alert('Staff deleted successfully!');</script>";
        echo '<script>window.location.href = "staff_view.php"</script>';
    } else {
        echo "<script>alert('Staff delete failed!');</script>";
    }
}
?>
<?php

$staffid = $_GET['staffid'];

$detail = $staff->getStaffDetailsForUpdate($staffid);
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
        $detail_password = $details['PASSWORD'];
        $detail_position = $details['POSITION'];
        $detail_email = $details['EMAIL'];
        $detail_address = $details['ADDRESS'];
        $detail_supervisor_id = $details['SUPERVISOR_ID'];    
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="POS - Bootstrap Admin Template">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
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
        <a href="dashboard.html" class="logo">
        <img src="assets/img/logos.png" alt="">
        </a>
        <a href="dashboard.html" class="logo-small">
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
        <!-- <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt=""> -->
        <span class="status online"></span></span>
        <div class="profilesets">
        <h6>D. Luffy</h6>
        <h5>Admin</h5>
        </div>
        </div>
        <hr class="m-0">
        <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My Profile</a>
        <!-- <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a> -->
        <hr class="m-0">
        <a class="dropdown-item logout pb-0" href="index.html"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
        </div>
        </div>
        </li>
        </ul>
        
        
        <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.html">My Profile</a>
        <!-- <a class="dropdown-item" href="generalsettings.html">Settings</a> -->
        <a class="dropdown-item" href="signin.html">Logout</a>
        </div>
        </div>
        
        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
            <ul>
            <li class="active">
            <a href="dashboard.php"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
            </li>
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Books</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="productlist.php">Book List</a></li>
            <li><a href="addproduct.php">Add Book</a></li>
            </ul>
            </li>
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="purchaselist.php">Purchase List</a></li>
            <li><a href="addpurchase.php">Add Purchase</a></li>
            
            </ul>
            </li>
            
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Supplier</span> <span class="menu-arrow"></span></a>
            <ul>
            
            <li><a href="supplierlist.php">Supplier List</a></li>
            <li><a href="addsupplier.php">Add Supplier </a></li>
            </ul>
            </li> 
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="newuser.php">New User </a></li>
            <li><a href="userlists.php">User List</a></li>
        
            </ul>
            </li>
            
            </ul>
            </li>
            </ul>
            </div>
            </div>
            </div>

<div class="page-wrapper">
<div class="content">
<div class="page-header">
<div class="page-title">
<h4>User Management</h4>
<h6>Edit/Update User</h6>
</div>
</div>

<div class="card">
<div class="card-body">
<div class="row">
<form class="my-3"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?bookid=" . $bookid; ?>"
    method="POST">
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>First Name</label>
<input type="text" name="first_name" value="<?php echo $detail_first_name; ?>">
</div>
<div class="form-group">
<label>Phone</label>
<input type="text" name="phone" value="<?php echo $detail_phone; ?>">
</div>
<div class="form-group">
<label>Address</label>
<input type="text" name="address" value="<?php echo $detail_address; ?>">
</div>
<div class="form-group">
<input type="number" name="staffid" value="<?php echo $detail_staffid; ?>" hidden>
    <label>Staff ID</label>
    <input type="number" value="<?php echo $detail_staffid; ?>" disabled>>
    </div>
    <div class="form-group">
        <label>Salary</label>
        <input type="number" name="salary" value="<?php echo $detail_salary; ?>">
        </div>
<div class="form-group">
<label>Password</label>
<div class="pass-group">
<input type="password" class=" pass-input" value="<?php echo $detail_password; ?>">
<span class="fas toggle-password fa-eye-slash"></span>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="form-group">
<label>Last Name</label>
<input type="text" name="last_name" value="<?php echo $detail_last_name; ?>">
</div>
<div class="form-group">
<label>Email</label>
<input type="text" name="email" value="<?php echo $detail_email; ?>">
</div>
<div class="form-group">
    <label>Position</label>
    <select class="select">
    <option>Staff</option>
    <option>Supervisor</option>
    </select>
</div>
<div class="form-group">
    <label>Supervisor ID</label>
    <input type="text">
    </div>
    <div class="form-group">
        <label>Hire date</label>
        <input type="date" name="hire_date" value="<?php echo $detail_hire_date; ?>">
        </div>
<div class="form-group">
<label>Confirm Password</label>
<div class="pass-group">
<input type="password" class=" pass-inputs" value="<?php echo $detail_password; ?>">
<span class="fas toggle-passworda fa-eye-slash"></span>
</div>
</div>
</div>

<div class="col-lg-12">
<input type="submit" name="update" value="update" class="btn btn-submit me-2">Submit</a>
<a href="user_view.php" class="btn btn-cancel">Cancel</a>
</div>
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