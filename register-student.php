<?php
ob_start();
session_start();
include("./includes/connection.php");
include("includes/insertPicture.php");
    $student_name = "";
    $student_email = "";
    $student_password = "";
    $student_subject = "";
    $studentEmailError = "";
    $studentPasswordError = "";
    $student_id;
if(isset($_POST['register'])){
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
    $student_password = mysqli_real_escape_string($conn, $_POST['student_password']);
    $student_subject = mysqli_real_escape_string($conn, $_POST['student_subject']);
    $admission_date = date("d-m-Y"); 

    if(strlen($student_password) < 5)
    {
        $studentPasswordError = "Password must be at least 5 characters";
    }
    else
    {
        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $student_password = $_POST['student_password'];
        $recordset = mysqli_query($conn, "select * from students where student_email='$student_email'");
        while($result = mysqli_fetch_assoc($recordset))
        {
            $student_id = $result['id'];
        }
        if(mysqli_num_rows($recordset)>0)
        {
            $student_emailError="E-mail is already in use. Please use another E-mail";
        }
        else
        {
            $sql="insert into students(student_name,student_email,student_password,student_subject, profile_picture,admission_date) values('$student_name','$student_email','$student_password', '$student_subject', '$newfilename','$admission_date')";
            mysqli_query($conn, $sql);
            $msg = "inserted";
            $_SESSION['student_auth'] = 1;
            $_SESSION['student_name'] = $student_name;
            $_SESSION['student_id'] = $student_id;
            header("location:dashboard/student-home.php");
        }
    }
}
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
            <div class="col-md-6 px-2">
                <h1 class="fw-bold">Register Student</h1>
                <form action="" method="POST" class="mt-3 d-flex flex-column align-items-start" autocomplete="off" enctype="multipart/form-data">

                    <input type="text" name="student_name" class="signin-input my-2 p-2 w-100" id="student_name" placeholder="Full Name" required />
                    
                    <input type="email" name="student_email" class="signin-input my-2 p-2 w-100" id="student_email" placeholder="E-mail" required />
                    <span class="text-danger"><?php echo $studentEmailError; ?></span>

                    <input type="password" name="student_password" class="signin-input my-2 p-2 w-100" placeholder="Password" id="student_password" required />
                    <span class="text-danger"><?php echo $studentPasswordError ?></span>

                    <select class="form-select my-2" name="student_subject" id="student_subject" required>
                        <option value="">Select Course</option>
                        <option value="Web Design">Web Design</option>
                        <option value="Web Development">Web Development</option>
                    </select>

                    <label for="student_profilepic" class="form-label mt-2">Profile Picture</label>
                    <input class="form-control" type="file" name="image" id="image">

                    <input type="submit" name="register" value="Register" class="btn btn-primary w-100 mt-2">

                </form>
                <div class="w-100 text-center mt-3">
                    <div>
                        <span class="me-2">Already a Student?</span><a href="index.php" class="text-decoration-none fw-bold">Sign In</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="./assets/register-student-image.jpg" class="img-fluid" alt="Sign In Image">
            </div>
        </div>
    </main>
</body>

</html>