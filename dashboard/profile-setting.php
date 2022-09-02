<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['student_auth']) == "1") {
    // echo $_SESSION['student_id'];
    $studentName = $_SESSION['student_name'];
    $student_id = $_SESSION['student_id'];

    echo $studentName."<br/>";
    echo $student_id."<br/>";
    if(isset($_POST['change-profile']))
    {
        include("./includes/insertPicture.php");
        if(!$newfilename == "")
        {
            $sql = "UPDATE students SET profile_picture = '$newfilename' WHERE id = '$student_id'";
            mysqli_query($conn, $sql);
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Profile Setting - SMS</title>

        <?php
        include("../includes/sources.php");
        ?>
        <link rel="stylesheet" href="./css/style.css">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    </head>

    <body>
        <main class="container-fluid">
            <div class="row dashboard-outer">
                <?php
                include("./includes/studentSideMenu.php");
                ?>
                <div class="col-md-10">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-settings me-2"></i>Students | Profile</h4>
                    </div>
                    <?php
                    $sql = "SELECT * FROM students WHERE id = '$student_id'";
                    $recordset = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($recordset);
                    ?>
                    <div class="row d-flex flex-wrap align-items-center mt-4">
                        <div class="col-4 col-md-2">
                            <img src="../assets/user_pictures/<?php
                                                                if ($row['profile_picture'] == "") {
                                                                    echo "person-dummy.png";
                                                                } else {
                                                                    echo $row['profile_picture'];
                                                                }
                                                                ?>" class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="col-7">
                            <h3 class="my-2"><?php echo $row['student_name']; ?></h3>
                            <p class="my-3 text-secondary"><i class="fi fi-rr-envelope me-2"></i><?php echo $row['student_email']; ?></p>
                            <p class="my-3 text-secondary"><i class="fi fi-rr-calendar-lines me-2"></i><?php echo $row['admission_date']; ?></p>
                            <p class="my-3 text-secondary"><i class="fi fi-rr-book-bookmark me-2"></i><?php echo $row['student_subject']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 mt-md-5">
                        <form action="" class="mt-2" method="POST" enctype="multipart/form-data">
                            <label for="profile_picture" class="form-label text-secondary my-3"><i class="fi fi-rr-picture me-2"></i>Change Profile Picture</label>
                            <div class="d-flex">
                                <input type="file" name="image" class="form-control" id="profile_picture">
                                <input type="submit" class="btn btn-success ms-2" name="change-profile" value="Change">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>

    </html>

<?php
} else {
    header("location:../index.php");
}
?>