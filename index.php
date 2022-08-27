<?php
    include("./includes/connection.php");
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
</head>
<body>
    <main class="container-fluid  d-flex justify-content-center align-items-center main-container">
        <div class="row bg-white px-3 py-5 w-50 signin-outer">
            <div class="col-md-6">
                <img src="./assets/signin-image.jpg" class="img-fluid" alt="Sign In Image">
            </div>
            <div class="col-md-6 px-2">
                <h1 class="fw-bold">Sign In - Student Panel</h1>
                <form action="" method="POST" class="mt-3 d-flex flex-column align-items-start">
                    <input type="email" name="student_email" class="signin-input my-2 p-2 w-100" id="student_email" placeholder="E-mail"/>
                    <input type="password" name="student_password" class="signin-input my-2 p-2 w-100" placeholder="Password" id="student_password">
                    <input type="submit" value="Sign In" class="btn btn-primary w-100 mt-2">
                </form>
                <div class="w-100 text-center mt-3">
                    <a href="admin-panel.php" class="link-secondary" class="text-align-center"><i class="fas fa-chevron-circle-up"></i>Open Admin Panel</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>