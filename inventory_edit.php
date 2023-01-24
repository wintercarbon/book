<?php

session_start();

// get INVID from url
$INVID = $_GET['INVID'];
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


?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $INVID = $_POST['invid'];
    $QUANTITY = $_POST['quantity'];
    $BOOKID = $_POST['bookid'];
    $PURCHASE_PRICE = $_POST['PURCHASE_PRICE'];

    // UPDATE: UPDATE INV_BOOK SET QUANTITY = :QUANTITY WHERE INVID = :INVID AND BOOKID = :BOOKID
    // UPDATE: UPDATE INV_BOOK SET PURCHASE_PRICE = :PURCHASE_PRICE WHERE INVID = :INVID AND BOOKID = :BOOKID // ONLY FOR MANAGER
    if($result = $inventory->updateInventoryBook($INVID, $BOOKID, $QUANTITY, $PURCHASE_PRICE)) {
        echo "<script>alert('Inventory updated successfully!');</script>";
    } else {
        echo "<script>alert('Inventory update failed!');</script>";
    }
}

?>
<?php

// b.INVID, b.isbn, b.book_name, b.book_author, b.book_price, b.publication_date, s.supplier_name, ib.quantity

$INVID = $_GET['INVID'];
$bookid = $_GET['bookid'];

$detail = $inventory->getInventoryByid($INVID, $bookid);
 // I.INVID, b.bookid, b.book_name, ib.quantity,ib.purchase_price, b.book_price, i.purchase_date
$detail_invid = "N/A";
$detail_bookid = "N/A";
$detail_book_name = "N/A";
$detail_quantity = "N/A";
$detail_purchase_price = "N/A";
$detail_book_price = "N/A";
$detail_purchase_date = "N/A";

if (!is_null($detail)) {
    foreach ($detail as $details) {
        $detail_invid = $details['INVID'];
        $detail_bookid = $details['BOOKID'];
        $detail_book_name = $details['BOOK_NAME'];
        $detail_quantity = $details['QUANTITY'];
        $detail_purchase_price = $details['PURCHASE_PRICE'];
        $detail_book_price = $details['BOOK_PRICE'];
        $detail_purchase_date = $details['PURCHASE_DATE'];
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
    <title>Inventory | Edit</title>

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
                        <h4>Inventory Edit</h4>
                        <h6>Update your Inventory</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="my-3"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?INVID=" . $INVID . "&bookid=" . $bookid; ?>"
                                method="POST">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="number" name="invid" value="<?php echo $detail_invid; ?>" hidden>
                                        <label>Inventory ID</label>
                                        <input type="number" value="<?php echo $detail_invid; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="number" name="bookid" value="<?php echo $detail_bookid; ?>" hidden>
                                        <label>Book ID</label>
                                        <input type="number" value="<?php echo $detail_bookid; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Book Name</label>
                                        <input type="text" value="<?php echo $detail_book_name; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Book Price</label>
                                        <input type="number" value="<?php echo $detail_book_price; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Purchase Price</label>
                                        <?php
                                        if($isManager) {
                                            echo '<input type="number" name="PURCHASE_PRICE" value="' . $detail_purchase_price . '">';
                                        } else {
                                            echo "<input type='number' name='PURCHASE_PRICE' value='$detail_purchase_price' hidden>";
                                            echo "<input type='number' name='PURCHASE_PRICE' value='$detail_purchase_price' disabled>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Purchase Date</label>
                                        <?php
                                        $newDate = date("Y-m-d", strtotime($detail_purchase_date));
                                        ?>
                                        <input type="date" value="<?php echo $newDate; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="<?php echo $detail_quantity; ?>">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <input type="submit" name="update" value="Update" class="btn btn-submit me-2">
                                    <a href="inventory_view.php" class="btn btn-cancel">Cancel</a>
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