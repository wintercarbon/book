<?php

session_start();

// get supplier_id from url
$supplier_id = $_GET['supplier_id'];

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
    $supplier_id = $_POST['supplier_id'];
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $contact_person = $_POST['contact_person'];
    $phone_number = $_POST['phone_number'];

    if($result = $supplier->updateSupplier($supplier_id, $supplier_name, $supplier_address, $contact_person, $phone_number)) {
        
        echo "<script>alert('Supplier update successfully!');</script>";
    } else {
        echo "<script>alert('Supplier update failed!');</script>";
    }
}

// delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $supplier_id = $_POST['supplier_id'];
    if($result = $supplier->deleteSupplier($supplier_id)) {
        echo "<script>alert('Supplier deleted successfully!');</script>";
        echo '<script>window.location.href = "supplier_view.php"</script>';
    } else {
        echo "<script>alert('Supplier delete failed!');</script>";
    }
}
?>

<?php

// 

$supplier_id = $_GET['supplier_id'];

$detail = $supplier->getSupplierDetailsForUpdate($supplier_id);
$detail_supplier_id = "N/A";
$detail_supplier_name = "N/A";
$detail_suppplier_address = "N/A";
$detail_contact_person= "N/A";
$detail_phone_number = "N/A";

if (!is_null($detail)) {
    foreach ($detail as $details) {
        $detail_supplier_id = $details['SUPPLIER_ID'];
        $detail_supplier_name = $details['SUPPLIER_NAME'];
        $detail_supplier_address = $details['SUPPLIER_ADDRESS'];
        $detail_contact_person = $details['CONTACT_PERSON'];
        $detail_phone_number = $details['PHONE_NUMBER'];
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
                                <!-- <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt=""> -->
                                <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>D. Luffy</h6>
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My
                                Profile</a>
                            <!-- <a class="dropdown-item" href="generalsettings.php"><i class="me-2" data-feather="settings"></i>Settings</a> -->
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="index.php"><img
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
                    <a class="dropdown-item" href="signin.php">Logout</a>
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
                        <h4>Supplier Edit</h4>
                        <h6>Update Supplier</h6>
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
                                        <label>Supplier ID</label>
                                        <input type="number" value="<?php echo $detail_supplier_id; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <input type="text" name="supplier_name" value="<?php echo $detail_supplier_name; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Supplier Address</label>
                                        <input type="text" name="supplier_address" value="<?php echo $detail_supplier_address; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" value="<?php echo $detail_contact_person; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone_number"
                                            value="<?php echo $detail_phone_number; ?>">
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
                                    <input type="submit" name="update" value="update" class="btn btn-submit me-2">
                                    <a href="book_view.php" class="btn btn-cancel">Cancel</a>
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