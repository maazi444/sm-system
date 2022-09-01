<?php
include("./includes/connection.php");
session_start();
$msg = "";
$accountMsg = "";
$accountDeleted = "";
if (isset($_POST['login'])) {
    $adminEmail = $_POST['admin_email'];
    $adminPassword = $_POST['admin_password'];
    if ($adminEmail == "") {
        $msg = "Email can not be empty.";
    } else if ($adminPassword == "") {
        $msg = "Password can not be empty.";
    }
    if ($msg == "") {
        $sql = "select * from admin where admin_email='$adminEmail' and admin_password='$adminPassword'";
        $records = mysqli_query($conn, $sql);
        $record = mysqli_fetch_array($records);
        if (isset($record['admin_email'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['admin_name'] = $record['admin_email'];
            header("location:dashboard/");
        } else {

            header("location:admin-login.php?login=0");
        }
    }
}
if (!isset($_SESSION['auth'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <?php
    include("./includes/sources.php");
    ?>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="container-fluid  d-flex justify-content-center align-items-center main-container">
        <div class="row bg-white px-3 py-5 w-50 signin-outer">
            <div class="col-md-6">
                <img src="./assets/signin-image.jpg" class="img-fluid" alt="Sign In Image">
            </div>
            <div class="col-md-6 px-2">
                <h1 class="fw-bold">Sign In - Admin Panel</h1>
                <form action="" method="POST" class="mt-3 d-flex flex-column align-items-start" autocomplete="off">
                    <input type="email" name="admin_email" class="signin-input my-2 p-2 w-100" id="admin_email" placeholder="E-mail" required />
                    <input type="password" name="admin_password" class="signin-input my-2 p-2 w-100" placeholder="Password" id="admin_password" required />
                    <?php
                    if (isset($_GET['login'])) {
                        $accountMsg = "Invalid email or password";
                    }
                    ?>
                    <span class="text-danger"><?php echo $accountMsg; ?></span>
                    <input type="submit" name="login" value="Sign In" class="btn btn-primary w-100 mt-2">
                </form>
                <div class="w-100 text-center mt-3">
                    <a href="index.php" class="link-secondary text-align-center text-decoration-none"><i class="fi fi-rr-users-alt mx-2"></i>Student Panel</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<?php
} else {
    header("location:dashboard/index.php");
}
?>