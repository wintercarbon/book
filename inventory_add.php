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
/*
if (!$isManager) {
    header('Location: dashboard.php');
} */


?>
<?php
// add
if (isset($_POST['add'])) {

    // addInventory($staffid) // automate this :/ to today.
    // addInvBook($invid, $bookid, $quantity, $purchase_price)

    $post_staffid = $_POST['staffid'];
    // inventory_add.php - button to create invid
    // push to be 

    if($result = $inventory->addInventory($post_staffid)) {
        $newinvid = $inventory->getInvIdSeqCurrval();
        $post_invid = $newinvid;
        $post_bookid = $_POST['bookid'];
        $post_quantity = $_POST['quantity'];
        $post_purchase_price = $_POST['purchase_price'];

        $result = $inventory->addInvBook($post_invid, $post_bookid, $post_quantity, $post_purchase_price);
        if ($result) {
            echo '<script>alert("Add inventory successfully")</script>';
            echo '<script>window.location.href = "inventory_edit.php?INVID='. $post_invid . '&bookid=' . $post_bookid . '"</script>';
        } else {
            echo '<script>alert("Add inventory failed")</script>';
            echo '<script>window.location.href = "inventory_add.php"</script>';
        }
    } else {
        echo '<script>alert("Add inventory failed")</script>';
        echo '<script>window.location.href = "inventory_add.php"</script>';
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
    <title>Inventory | Add New </title>

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
                        <h4>Inventory</h4>
                        <h6>Create a new inventory</h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form class="my-3"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                method="POST">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="number" name="staffid" value="<?php echo $staffid; ?>" hidden>
                                        <label>Book Name</label>
                                        <?php
                                        $allbook = $book->getAllUniqueBook();
                                        
                                        if(!is_null($allbook)) {
                                            echo "<select name='bookid'>";
                                            foreach($allbook as $allbooks) {
                                                if($allbooks['BOOKID'] == $allbooks) {
                                                    echo "<option value='" . $allbooks['BOOKID'] . "' selected>" . $allbooks['BOOK_NAME'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $allbooks['BOOKID'] . "'>" . $allbooks['BOOK_NAME'] . "</option>";
                                                }
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Purchase Price</label>
                                        <input type="number" name="purchase_price" value="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" value="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" name="add" value="Add" class="btn btn-submit me-2">
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