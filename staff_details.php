<?php

session_start();

// get staffid from url
$staffid = $_GET['staffid'];

//check if user is logged in
if (!isset($_SESSION['staffid'])){
    header('Location: index.php');

}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$inventory = new Inventory();
$staff = new Staff();
$book = new BOOK();
$staffname = $staff->getStaffFullName($staffid);
$staffpos = $staff->getStaffPosition($staffid);

//manager
if ($staffpos == 'Manager') {
    $isManager = true;
} 
else {
    $isManager = false;
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

<!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/animate.css">

<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">

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
            <a href="dashboard.html"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
            </li>
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Books</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="productlist.html">Book List</a></li>
            <li><a href="addproduct.html">Add Book</a></li>
            </ul>
            </li>
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="purchaselist.html">Purchase List</a></li>
            <li><a href="addpurchase.html">Add Purchase</a></li>
            
            </ul>
            </li>
            
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Supplier</span> <span class="menu-arrow"></span></a>
            <ul>
            
            <li><a href="supplierlist.html">Supplier List</a></li>
            <li><a href="addsupplier.html">Add Supplier </a></li>
            </ul>
            </li> 
            
            <li class="submenu">
            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span> Users</span> <span class="menu-arrow"></span></a>
            <ul>
            <li><a href="newuser.html">New User </a></li>
            <li><a href="userlists.html">User List</a></li>
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
<h4>Staff Details</h4>
<h6>Full details of a user</h6>
</div>
</div>

<div class="row">
<div class="col-lg-8 col-sm-12">
<div class="card">
<div class="card-body">
<div class="productdetails">
    <?php

    $detail = $staff->getStaffDetails($staffid);
    $detail_staffid = "N/A";
    $detail_first_name = "N/A";
    $detail_last_name = "N/A";
    $detail_phone_number = "N/A";
    $detail_salary = "N/A";
    $detail_hire_date = "N/A";
    $detail_password = "N/A";
    $detail_postion = "N/A";
    $detail_supervisor_id = "N/A";
    $detail_email = "N/A";
    $detail_address = "N/A";

    if (!is_null($detail)) {

        foreach ($detail as $details) {

            $detail_staffid = $details['STAFFID'];
            $detail_first_name = $details['FIRST_NAME'];
            $detail_last_name = $details['LAST_NAME'];
            $detail_phone_number = $details['PHONE_NUMBER'] ;
            $detail_salary = $details['SALARY'] ;
            $detail_hire_date = $details['HIRE_DATE'];
            $detail_password = $details['PASSWORD'];
            $detail_postion = $details['POSITION'];
            $detail_supervisor_id = $details['SUPERVISOR_ID'] ;
            $detail_email = $details['EMAIL'];
            $detail_address = $details['ADDRESS'] ;
        }

    
    }
    
    ?>
<ul class="product-bar">
<li>
<h4>Staff ID</h4>
<?php
  echo "<h6>$detail_staffid</h6>";  
?>
</li>
<li>
<h4>First Name</h4>
<?php
echo "<h6>$detail_first_name</h6>";
?>
</li>
<li>
<h4>Last Name</h4>
<?php
echo "<h6>$detail_last_name</h6>";
?>
</li>
<li>
<h4>Phone</h4>
<?php
echo "<h6>$detail_phone_number</h6>";
?>
</li>
<li>
<h4>Address</h4>
<?php
echo "<h6>$detail_address</h6>";
?>
</li>
<li>
<h4>Email</h4>
<?php
echo "<h6>$detail_email</h6>";
?>
</li>
<li>
<h4>Hire Date</h4>
<?php
echo "<h6>$detail_hire_date</h6>";
?>
</li>
<li>
    <h4>Position</h4>
    <?php
echo "<h6>$detail_position</h6>";
?>
</li>
<li>
    <h4>Supervisor ID</h4>
    <?php
echo "<h6>$detail_supervisor_id</h6>";
?>
</li>
<li>
    <h4>Salary</h4>
    <?php
echo "<h6>$detail_salary</h6>";
?>
</li>
<?php
if($isManager) {
    echo "<li>";
    echo "<h4>Action</h4>";
    echo "<h6>";

    //edit and delete button
    echo "<a href= 'staff_edit.php?staffid=$detail_staffid' class= 'btn btn-primary'>Edit</a>";
    echo "<a href= 'staff_delete.php?staffid=$detail_staffid' class= 'btn btn-danger'>Delete</a>";
    echo "</h6>";
    echo "</li>";
}
?>
</ul>
</div>
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

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>