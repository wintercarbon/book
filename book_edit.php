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
    $bookid = $_POST['bookid'];
    $isbn = $_POST['isbn'];
    $book_name = $_POST['book_name'];
    $book_author = $_POST['book_author'];
    $book_price = $_POST['book_price'];
    $date = $_POST['book_publication_date'];
    $publication_date = date("d-M-Y", strtotime($date));
    $image_url = $_POST['book_image'];
    $getsupplier = $_POST['supplierid'];

    if($result = $book->updateBook($bookid, $isbn, $book_name, $book_author, $book_price, $publication_date, $image_url, $getsupplier)) {
        
        echo "<script>alert('Book update successfully!');</script>";
    } else {
        echo "<script>alert('Book update failed!');</script>";
    }
}

// delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $bookid = $_POST['bookid'];
    if($result = $book->deleteBook($bookid)) {
        echo "<script>alert('Book deleted successfully!');</script>";
        echo '<script>window.location.href = "book_view.php"</script>';
    } else {
        echo "<script>alert('Book delete failed!');</script>";
    }
}
?>
<?php

// b.bookid, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, ib.quantity

$bookid = $_GET['bookid'];

$detail = $book->getBookDetailsForUpdate($bookid);
$detail_bookid = "N/A";
$detail_isbn = "N/A";
$detail_book_name = "N/A";
$detail_author = "N/A";
$detail_book_price = "N/A";
$detail_publication_date = "N/A";
$detail_supplierid = "N/A";
$detail_url = "";
if (!is_null($detail)) {
    foreach ($detail as $details) {
        $detail_bookid = $details['BOOKID'];
        $detail_isbn = $details['ISBN'];
        $detail_book_name = $details['BOOK_NAME'];
        $detail_author = $details['BOOK_AUTHOR'];
        $detail_book_price = $details['BOOK_PRICE'];
        $detail_publication_date = $details['PUBLICATION_DATE'];
        $detail_url = $details['IMAGE_URL'];
        $detail_supplierid = $details['SUPPLIER_ID'];
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
                        <h4>Product Edit</h4>
                        <h6>Update your product</h6>
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
                                        <input type="number" name="bookid" value="<?php echo $detail_bookid; ?>" hidden>
                                        <label>Book ID</label>
                                        <input type="number" value="<?php echo $detail_bookid; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>ISBN</label>
                                        <input type="text" name="isbn" value="<?php echo $detail_isbn; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Book Name</label>
                                        <input type="text" name="book_name" value="<?php echo $detail_book_name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Author</label>
                                        <input type="text" name="book_author" value="<?php echo $detail_author; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Book Price</label>
                                        <input type="number" name="book_price"
                                            value="<?php echo $detail_book_price; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Publication Date</label>
                                        <?php
                                        $newDate = date("Y-m-d", strtotime($detail_publication_date));
                                        ?>
                                        <input type="date" name="book_publication_date" value="<?php echo $newDate; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Image URL</label>
                                        <input type="text" name="book_image" value="<?php echo $detail_url; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <?php
                                        $getAllSupplier = $supplier->getAllSupplierIDName();
                                        if(!is_null($getAllSupplier)) {
                                            echo "<select name='supplierid'>";
                                            foreach($getAllSupplier as $getAllSuppliers) {
                                                if($getAllSuppliers['SUPPLIER_ID'] == $detail_supplierid) {
                                                    echo "<option value='" . $getAllSuppliers['SUPPLIER_ID'] . "' selected>" . $getAllSuppliers['SUPPLIER_NAME'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $getAllSuppliers['SUPPLIER_ID'] . "'>" . $getAllSuppliers['SUPPLIER_NAME'] . "</option>";
                                                }
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" name="update" value="Update" class="btn btn-submit me-2">
                                    <?php
                                    echo "<a href='book_detail.php?bookid=" . $bookid . "' class='btn btn-cancel'>Cancel</a>";
                                    ?>
                                </div>
                        </div>
                        </form>
                        <form class="border-bottom" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?bookid=" . $bookid; ?>" method="POST" id="deleteForm" onsubmit="return confirm('Are you sure you want to delete the book?');">
                            <input type="number" name="bookid" value="<?php echo $detail_bookid; ?>" hidden>
                            <input type="hidden" name="delete" value="delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
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