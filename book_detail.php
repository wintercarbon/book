<?php

session_start();

// get bookid from url
$bookid = $_GET['bookid'];

// check if user is logged in
if (!isset($_SESSION['staffid'])) {
    header('Location: index.php');
}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$inventory = new Inventory();
$staff = new Staff();
$book = new BOOK();
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
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Book Inventory Management System</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

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

        </div>

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Book Details</h4>
                        <h6>Full details of a product</h6>
                    </div>
                    <div class="page-btn">
                        <a href="book_view.php" class="btn btn-added">Back</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="productdetails">
                                    <?php
                                    // b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, ib.quantity
                                    $detail = $book->getBookDetails($bookid);
                                    $detail_bookid = "N/A";
                                    $detail_isbn = "N/A";
                                    $detail_book_name = "N/A";
                                    $detail_author = "N/A";
                                    $detail_book_price = "N/A";
                                    $detail_publication_date = "N/A";
                                    $detail_supplier_name = "N/A";
                                    $detail_quantity = "N/A";
                                    $detail_url = "";
                                    if (!is_null($detail)) {
                                        foreach ($detail as $details) {
                                            
                                            if(isset($details['QUANTITY']) && !empty($details['QUANTITY'])) {
                                                $detail_quantity = $details['QUANTITY'];
                                            } else {
                                                $detail_quantity = "N/A";
                                            }

                                            $detail_bookid = $details['BOOKID'];
                                            $detail_isbn = $details['ISBN'];
                                            $detail_book_name = $details['BOOK_NAME'];
                                            $detail_author = $details['BOOK_AUTHOR'];
                                            $detail_book_price = $details['BOOK_PRICE'];
                                            $detail_publication_date = $details['PUBLICATION_DATE'];
                                            $detail_supplier_name = $details['SUPPLIER_NAME'];
                                            $detail_url = $details['IMAGE_URL'];
                                        }

                                    }
                                    ?>
                                    <ul class="product-bar">
                                        <li>
                                            <h4>Book ID</h4>
                                            <?php
                                            echo "<h6>$detail_bookid</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>ISBN</h4>
                                            <?php
                                            echo "<h6>$detail_isbn</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Book Name</h4>
                                            <?php
                                            echo "<h6>$detail_book_name</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Author</h4>
                                            <?php
                                            echo "<h6>$detail_author</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Book Price</h4>
                                            <?php
                                            echo "<h6>$detail_book_price</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Publication Date</h4>
                                            <?php
                                            echo "<h6>$detail_publication_date</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Supplier Name</h4>
                                            <?php
                                            echo "<h6>$detail_supplier_name</h6>";
                                            ?>
                                        </li>
                                        <li>
                                            <h4>Quantity</h4>
                                            <?php
                                            echo "<h6>$detail_quantity</h6>";
                                            ?>
                                        </li>
                                        <?php
                                        if($isManager) {
                                            echo "<li>";
                                            echo "<h4>Action</h4>";
                                            echo "<h6>";
                                            // edit and delete button
                                            echo "<a href='book_edit.php?bookid=$detail_bookid' class='btn btn-primary'>Edit</a>";
                                            echo "</h6>";
                                            echo "</li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="slider-product-details">
                                    <div class="owl-carousel owl-theme product-slide">
                                        <div class="slider-product">
                                            <?php
                                            echo "<img src='$detail_url' alt='N/A'>";
                                            ?>
                                        </div>
                                        <div class="slider-product">
                                            <?php
                                            echo "<img src='$detail_url' alt='N/A'>";
                                            ?>
                                        </div>
                                    </div>
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