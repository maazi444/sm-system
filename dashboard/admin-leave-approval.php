<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    $studentId;
    if(isset($_POST['leave-approve']))
    {
        $attendanceId = $_POST['attendance_id'];
        $sql = "UPDATE sms_attendance SET attendance_status = 4 WHERE attendance_id = $attendanceId";
        mysqli_query($conn, $sql);
    }

    if(isset($_POST['leave-disapprove']))
    {
        $attendanceId = $_POST['attendance_id'];
        $sql = "UPDATE sms_attendance SET attendance_status = 5 WHERE attendance_id = $attendanceId";
        mysqli_query($conn, $sql);
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

    <body class="bg-light">
        <main class="container-fluid">
            <div class="row dashboard-outer">
                <?php
                include("./includes/sideMenu.php");
                ?>
                <div class="col-md-10">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-edit me-2"></i>Admin | Approve Leaves</h4>
                    </div>

                    <div class="col-md-12 mt-4">
                        <?php
                        $sql = "SELECT a.attendance_id, s.student_name, a.student_id, a.attendance_status, a.attendance_date FROM sms_attendance a, students s WHERE a.student_id = s.id AND a.attendance_status = 3";
                        // $sql = "SELECT * FROM sms_attendance WHERE attendance_status = 3";
                        $row = mysqli_query($conn, $sql);
                        // print_r($row);
                        // exit();
                        if (!mysqli_num_rows($row) == 0) {
                            // $sql = "select s.student_name, a.attendance_status, a.attendance_date from sms_attendance a, students s where a.student_id = s.id";
                            // $recordRow = mysqli_query($conn, $sql);
                            while ($record = mysqli_fetch_assoc($row)) {
                        ?>
                                <div class="alert alert-secondary w-75 d-flex justify-content-between align-items-center" role="alert">
                                    <span><span class="fw-bold fst-italic"><?php echo $record['student_name']; ?></span> -- <?php echo $record['attendance_date']; ?></span>
                                    <div class="d-flex">
                                        <form action="" method="POST" class="mx-2">
                                            <input type="hidden" value="<?php echo $record['attendance_id']; ?>" name="attendance_id">
                                            <input type="hidden" value="<?php echo $record['student_id']; ?>" name="student_id">
                                            <input type="submit" class="btn btn-success" name="leave-approve" value="Approve">
                                        </form>
                                        <form action="" method="POST" class="mx-2">
                                            <input type="hidden" value="<?php echo $record['attendance_id']; ?>" name="attendance_id">
                                            <input type="hidden" value="<?php echo $record['student_id']; ?>" name="student_id">
                                            <input type="submit" class="btn btn-secondary" name="leave-disapprove" value="Disapprove">
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-success w-75" role="alert">
                                No Leave Requests till now!
                            </div>
                        <?php
                        }
                        ?>
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