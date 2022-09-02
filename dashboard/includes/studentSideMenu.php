<?php
    $student_profile_picture = "";
    $sql = "SELECT profile_picture FROM students WHERE id = '$student_id'";
    $data = mysqli_query($conn, $sql);
    $dataRow = mysqli_fetch_assoc($data);
    if(!mysqli_num_rows($data)>0)
    {
        $student_profile_picture = $_SESSION['student_profile_picture'];
    }
    else{
        $student_profile_picture = $dataRow['profile_picture'];
    }
?>
<div class="col-md-2 bg-dark text-white py-3">
    <h6 class="my-2">SMS - Student Panel</h6>
    <div class="mt-4 d-flex align-items-center">
        <img src="../assets/user_pictures/<?php echo $student_profile_picture; ?>" class="img-fluid w-25 rounded-circle" alt="">
        <p class="ms-2">
            <?php
                echo $studentName;
            ?>
        </p>
    </div>
    <div class="mt-4 menu-links">
        <a href="./student-home.php" class="link-light d-block my-3"><i class="fi fi-rr-home mx-2"></i>Home</a>
        <a href="./student-attendance.php" class="link-light d-block my-3"><i class="fi fi-rr-eye mx-2"></i>View Attendance</a>
        <a href="./profile-setting.php" class="link-light d-block my-3"><i class="fi fi-rr-settings-sliders mx-2"></i></i>Settings</a>
        <a href="./student-logout.php" class="link-light d-block"><i class="fi fi-rr-exit mx-2"></i>Log Out</a>
    </div>
</div>