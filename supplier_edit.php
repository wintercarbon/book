<?php

session_start();

// get supplier_id from url
$supplier_id = $_GET['supplier_id'];

// check if user is logged in
if(!isset($_SESSION['staffid'])){
    header('Location: index.php');
}

include_once 'php/function.php';

$staffid = $_SESSION['staffid'];

$inventory = new Inventory();
$staff = new Staff();
$supplier = new Supplier();
$staffname = $staff->getStaffFullName($staffid);
$staffpos = $staff->getStaffPosition($staffid);
// is manager
if($Supplierpos = 'Manager'){
    $isManager = true;
}else {
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
    $supplier_phone = $_POST['phone_number'];

    if ($r = $supplier->updateSupplier($supplier_id, $supplier_name, $supplier_address, $contact_person, $supplier_phone)) {
        echo "<script>alert('Supplier updated successfully!')</script>";
    } else {
        echo "<script>alert('Supplier update failed!');</script>";    
    }

}

// delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $supplier_id = $_POST['supplier_id'];
    if ($result = $supplier->deleteSupplier($supplier_id)) {
        echo "<script>alert('Supplier deleted successfully!');</script>";
        echo '<script>window.location.href = "supplier_view.php"</script>';
    } else {
        echo "<script>alert('Supplier delete failed!');</script>";
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
    <title>Supplier | Edit</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/bookx.jpg">

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
                        <h4>Edit Supplier</h4>
                        <h6>Update the supplier details</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="productdetails">
                                    <?php
                                    // b.supplier_id, b.isbn, b.supplier_name, b.supplier_author, b.supplier_price, b.publication_date, s.supplier_name, ib.quantity
                                    $detail = $supplier->getSupplierDetail($supplier_id);
                                    $detail_supplier_id = "N/A";
                                    $detail_supplier_name = "N/A";
                                    $detail_supplier_address = "N/A";
                                    $detail_contact_person = "N/A";
                                    $detail_phone_number = "N/A";
                                    if (!is_null($detail)) {
                                        foreach ($detail as $details) {
                                            
                                            $detail_supplier_id = $details['SUPPLIER_ID'];
                                            $detail_supplier_name = $details['SUPPLIER_NAME'];
                                            $detail_supplier_address = $details['SUPPLIER_ADDRESS'];
                                            $detail_contact_person = $details['CONTACT_PERSON'];
                                            $detail_phone_number = $details['PHONE_NUMBER'];
                                        }

                                    }
                                    ?>
                                    
                            <form class="my-3"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?supplier_id=" . $detail_supplier_id; ?>"
                                method="POST">
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <input type="number" name="supplier_id" value="<?php echo $detail_supplier_id; ?>" hidden>
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
                                        <input type="text" name="supplier_address" value="<?php echo $detail_supplier_address; ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" name="contact_person" value="<?php echo $detail_contact_person; ?>" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" value="<?php echo $detail_phone_number; ?>">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <input type="submit" name="update" value="update" class="btn btn-submit me-2">
                                    <?php
                                    echo "<a href='supplier_detail.php?supplier_id=" . $detail_supplier_id . "' class='btn btn-cancel'>Cancel</a>";
                                    ?>
                                </div>
                        </div>
                        </form>
                            <form class="border-bottom"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?supplier_id=" . $detail_supplier_id; ?>"
                                method="POST" id="deleteForm"
                                onsubmit="return confirm('Are you sure you want to delete the supplier?');">

                                <?php

                                //if (!$isManager) {
                                    echo "<input type='submit' name='delete' value='Delete' class='btn btn-danger'>";
                                //}

                                ?>
                                <input type="number" name="supplier_id" value="<?php echo $detail_supplier_id; ?>" hidden>
                            </form>
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