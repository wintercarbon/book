<?php

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


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Book Inventory Management System</title>

    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

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
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3">
                            <div class="dash-counts">
                                <h4>
                                    <?php
                                    // get total staff
                                    $staff = new Staff();
                                    $totalStaff = $staff->getTotalStaff();
                                    echo $totalStaff;
                                    ?>
                                </h4>
                                <h5>Staff</h5>
                                <?php
                                // check is manager
                                if ($isManager) {
                                    echo '<a href="staff_view.php" class="btn btn-primary">Manage Staff</a>';
                                } else {
                                    // view staff
                                    echo '<a href="staff_view.php" class="btn btn-primary">View Staff</a>';
                                }
                                ?>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das3">
                            <div class="dash-counts">
                                <h4>
                                    <?php
                                    // get total supplier
                                    $supplier = new Supplier();
                                    $totalSupplier = $supplier->getTotalSupplier();
                                    echo $totalSupplier;
                                    ?>
                                </h4>
                                <h5>Suppliers</h5>
                                <?php
                                // check is manager
                                if ($isManager) {
                                    echo '<a href="supplier_view.php" class="btn btn-primary">Manage Suppliers</a>';
                                } else {
                                    // view staff
                                    echo '<a href="supplier_view.php" class="btn btn-primary">View Suppliers</a>';
                                }
                                ?>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="user-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das1">
                            <div class="dash-counts">
                                <h4>
                                    <?php
                                    // get total inventory
                                    $inv_book = new INV_BOOK();
                                    $totalBook = $inv_book->getTotalInventoryBook();
                                    echo $totalBook;
                                    ?>
                                </h4>
                                <h5>Inventory</h5>
                                <a href="inventory_view.php" class="btn btn-primary">Manage Inventory</a>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="file-text"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12 d-flex">
                        <div class="dash-count das2">
                            <div class="dash-counts">
                                <h4>
                                    <?php
                                    // get total unique book
                                    $book = new BOOK();
                                    $totalUniqueBook = $book->getTotalUniqueBook();
                                    echo $totalUniqueBook;
                                    ?>
                                </h4>
                                <h5>Book</h5>
                                <a href="book_view.php" class="btn btn-primary">Manage Books</a>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="book"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-0">
                    <div class="card-body">
                        <h4 class="card-title">Most Quantity Book</h4>
                        <div class="table-responsive dataview">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Book ID</th>
                                        <th>Book Name</th>
                                        <th>Author</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $frequentBook = $inventory->getFrequentlyPurchasedBook();
                                    if (is_null($frequentBook)) {
                                        echo "No frequently purchased books.";
                                    } else {
                                        foreach ($frequentBook as $frequentBooks) {
                                            echo '<tr>';
                                            echo '<td>' . $frequentBooks['BOOKID'] . '</td>';
                                            echo '<td class="productimgname">';
                                            echo '<a class="product-img" href="book_detail.php?bookid=' . $frequentBooks['BOOKID'] . '">';
                                            echo '<img src=" ' . $frequentBooks['IMAGE_URL'] . '" alt="product">';
                                            echo '</a>';
                                            echo '<a href="book_detail.php?bookid=' . $frequentBooks['BOOKID'] . '">' . $frequentBooks['BOOK_NAME'] . '</a>';
                                            echo '</td>';
                                            echo '<td>' . $frequentBooks['BOOK_AUTHOR'] . '</td>';
                                            echo '<td>' . $frequentBooks['BOOK_PRICE'] . '</td>';
                                            echo '<td>' . $frequentBooks['PURCHASE_COUNT'] . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                    <!--
                                    <tr>
                                        <td><a href="javascript:void(0);">1234</a></td>
                                        <td class="productimgname">
                                            <a class="product-img" href="productlist.php">
                                                <img src="assets/img/product/Jujutsu_kaisen.png" alt="product">
                                            </a>
                                            <a href="productlist.php">Jujutsu Kaisen</a>
                                        </td>
                                        <td>Mr Lee</td>
                                        <td>40.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
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

    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>