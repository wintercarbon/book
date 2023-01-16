<?php

include_once 'php/function.php';
$connect = new Connect();
$errmsg = '';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($connect->login($email, $password)) {
        // create session to show that user login
        // set session for staffid
        $staff = new Staff();
        $_SESSION['staffid'] = $staff->getStaffId($email);
        // set session for staff position
        $_SESSION['position'] = $staff->getStaffPosition($staff->getStaffId($email));

        header('Location: homepage.php');
    } else {
        $errmsg = "Invalid email or password";
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
    <title>Login - Book Inventory | Login </title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logos.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="assets/img/logos.png" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Sign In</h3>
                            <h4>Please login to your account</h4>
                        </div>
                            <span id="msg" style="color:red;">
                                <?php echo $errmsg; ?>
                            </span>
                        <form id="registeration-form" name="registeration-form"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input type="text" placeholder="Enter your email address" name="email">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="Enter your password"
                                        name="password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                            <div class="form-login">
                                <input type="submit" value="Sign In" class="btn btn-login" id="login" name="login">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/signin.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>

</html>