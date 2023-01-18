﻿<?php

session_start();

// check if user is logged in
if (!isset($_SESSION['staffid'])) {
    header('Location: index.php');
}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$inventory = new Inventory();
$staff = new Staff();
$staffname = $staff->getStaffFullName($staffid);
$staffpos = $staff->getStaffPosition($staffid);

// is manager
if ($staffpos == 'Manager') {
    $isManager = true;
} else {
    $isManager = false;
}

$supplier = new Supplier();




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

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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
                    <!-- <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt=""> -->
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
                <!-- <a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a> -->
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
        <!-- <a class="dropdown-item" href="generalsettings.php">Settings</a> -->
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
                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                                    Books</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="productlist.php">Book List</a></li>
                                <li><a href="addproduct.php">Add Book</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span>
                                    Purchase</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="purchaselist.php">Purchase List</a></li>
                                <li><a href="addpurchase.php">Add Purchase</a></li>

                            </ul>
                        </li>


                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                                    Supplier</span> <span class="menu-arrow"></span></a>
                            <ul>

                                <li><a href="supplierlist.php">Supplier List</a></li>
                                <li><a href="addsupplier.php">Add Supplier </a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                                    Users</span> <span class="menu-arrow"></span></a>
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
                        <h4>Supplier List</h4>
                        <h6>Manage your Supplier</h6>
                    </div>
                    <div class="page-btn">
                        <?php
                        if($isManager) {
                            echo '<a href="addsupplier.php" class="btn btn-added"><img src="assets/img/icons/plus.svg"
                            alt="img">Add Supplier</a>';
                        }
                        ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-path">
                                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                    </a>
                                </div>
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg"
                                            alt="img"></a>
                                </div>
                            </div>
                            <div class="wordset">
                                <ul>
                                </ul>
                            </div>
                        </div>

                        <div class="card mb-0" id="filter_inputs">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-1 col-sm-6 col-12">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Supplier ID</th>
                                    <th>Supplier Name</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                        <?php
                                        if($isManager) {
                                            echo "<th>Action</th>";
                                        }
                                        ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $detail = $supplier->getAllSupplier();
                                if(!is_null($detail)) {
                                    foreach($detail as $details) {
                                        echo "<tr>";
                                        echo "<td>".$details['SUPPLIER_ID']."</td>";
                                        echo "<td>".$details['SUPPLIER_NAME']."</td>";
                                        echo "<td>".$details['SUPPLIER_ADDRESS']."</td>";
                                        echo "<td>".$details['CONTACT_PERSON']."</td>";
                                        echo "<td>".$details['PHONE_NUMBER']."</td>";
                                        if ($isManager) {
                                            echo "<td><a href='editsupplier.php?id=".$details['SUPPLIER_ID']."'><img src='assets/img/icons/edit.svg' alt='img'></a><a href='deletesupplier.php?id=".$details['SUPPLIER_ID']."'><img src='assets/img/icons/delete.svg' alt='img'></a></td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>




    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/jquery.slimscroll.min.js"></script>

    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>