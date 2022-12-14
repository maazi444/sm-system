<?php
include("./includes/connection.php");
// connect_db();
session_start();
$msg = "";
$accountMsg = "";
$accountDeleted = "";
$userRole = "";
if (isset($_POST['login'])) {
    $studentEmail = $_POST['student_email'];
    $studentPassword = $_POST['student_password'];
    $userRole = $_POST['userRole'];
    if ($studentEmail == "") {
        $msg = "Email can not be empty.";
    } else if ($studentPassword == "") {
        $msg = "Password can not be empty.";
    }

    if ($userRole == "2") {
        if ($msg == "") {
            $sql = "select * from students where student_email='$studentEmail' and student_password='$studentPassword'";
            $records = mysqli_query($conn, $sql);
            $record = mysqli_fetch_array($records);
            if (isset($record['student_email'])) {
                $_SESSION['student_auth'] = 1;
                $_SESSION['student_name'] = $record['student_name'];
                $_SESSION['student_picture'] = "";
                if ($record['profile_picture'] == "") {
                    $_SESSION['student_picture'] = "person-dummy.png";
                } else {
                    $_SESSION['student_picture'] = $record['profile_picture'];
                }
                $_SESSION['student_id'] = $record['id'];
                header("location:dashboard/student-home.php");
            } else {

                header("location:index.php?login=0");
            }
        }
        
    } else if ($userRole == "1") {

        if ($msg == "") {
            $sql = "select * from admin where admin_email='$studentEmail' and admin_password='$studentPassword'";
            $records = mysqli_query($conn, $sql);
            $record = mysqli_fetch_array($records);
            if (isset($record['admin_email'])) {
                $_SESSION['auth'] = 1;
                $_SESSION['admin_name'] = $record['admin_email'];
                header("location:dashboard/");
            } else {

                header("location:index.php?login=0");
            }
        }
    }
}
if (!isset($_SESSION['student_auth']) || !isset($_SESSION['auth'])) {
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
            <div class="row bg-white px-3 py-5 w-md-50 w-sm-75 signin-outer">
                <div class="col-md-6 col-12">
                    <img src="./assets/signin-image.jpg" class="img-fluid" alt="Sign In Image">
                </div>
                <div class="col-md-6 col-12 px-2">
                    <h1 class="fw-bold text-center">Student Management </h1>
                    <form action="" method="POST" class="mt-3 d-flex flex-column align-items-start" autocomplete="off">
                        <input type="email" name="student_email" class="signin-input my-2 p-2 w-100" id="student_email" placeholder="E-mail" />
                        <input type="password" name="student_password" class="signin-input my-2 p-2 w-100" placeholder="Password" id="student_password">
                        <select name="userRole" id="userRole" class="form-control" required>
                            <option value="">Select a Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Student</option>
                        </select>
                        <?php
                        if (isset($_GET['login'])) {
                            $accountMsg = "Invalid email or password";
                        }
                        ?>
                        <span class="text-danger"><?php echo $accountMsg; ?></span>
                        <input type="submit" name="login" value="Sign In" class="btn btn-primary w-100 mt-2">
                    </form>
                    <div class="w-100 text-center mt-3">
                        <div>
                            <span class="me-2">New Student?</span><a href="register-student.php" class="text-decoration-none fw-bold">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

    </html>

<?php
}
?>