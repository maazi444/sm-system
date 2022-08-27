<?php
include("./includes/connection.php");
session_start();
$msg = "";
$accountMsg = "";
$accountDeleted = "";
if (isset($_POST['login'])) {
    $studentEmail = $_POST['student_email'];
    $studentPassword = $_POST['student_password'];
    if ($studentEmail == "") {
        $msg = "Email can not be empty.";
    } else if ($studentPassword == "") {
        $msg = "Password can not be empty.";
    }
    if ($msg == "") {
        $sql = "select * from students where student_email='$studentEmail' and student_password='$studentPassword'";
        $records = mysqli_query($conn, $sql);
        $record = mysqli_fetch_array($records);
        if (isset($record['student_email'])) {
            $_SESSION['student_auth'] = 1;
            $_SESSION['admin_name'] = $record['student_email'];
            header("location:dashboard/");
        } else {

            header("location:admin-login.php?login=0");
        }
    }
}

if (!isset($_SESSION['student_auth'])) {
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
    <main class="container-fluid d-flex justify-content-center align-items-center main-container">
        <div class="row bg-white px-3 py-5 w-50 signin-outer">
            <div class="col-md-6">
                <img src="./assets/signin-image.jpg" class="img-fluid" alt="Sign In Image">
            </div>
            <div class="col-md-6 px-2">
                <h1 class="fw-bold">Sign In - Student Panel</h1>
                <form action="" method="POST" class="mt-3 d-flex flex-column align-items-start" autocomplete="off">
                    <input type="email" name="student_email" class="signin-input my-2 p-2 w-100" id="student_email" placeholder="E-mail"/>
                    <input type="password" name="student_password" class="signin-input my-2 p-2 w-100" placeholder="Password" id="student_password">
                    <input type="submit" name="login" value="Sign In" class="btn btn-primary w-100 mt-2">
                </form>
                <div class="w-100 text-center mt-3">
                    <a href="admin-login.php" class="link-secondary" class="text-align-center"><i class="fi fi-rr-apps mx-2"></i>Open Admin Panel</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

<?php
} else {
    header("location:dashboard/student-home.php");
}
?>