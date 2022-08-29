<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['student_auth']) == "1") {
    // echo $_SESSION['student_id'];
    $studentName = $_SESSION['student_name'];
    $student_id = $_SESSION['student_id'];
    $attendance_date = date("Y-n-d");
    $attendance_status;

    $sql = "SELECT * FROM sms_attendance WHERE student_id = '$student_id' AND attendance_date = '$attendance_date'";
    $recordset = mysqli_query($conn, $sql);

    if (isset($_POST['mark-present'])) {
        $attendance_status = $_POST['student_present'];

        $sql = "SELECT * FROM sms_attendance WHERE student_id = '$student_id' AND attendance_date = '$attendance_date'";
        $recordset = mysqli_query(connect_db(), $sql);
        if (!mysqli_num_rows($recordset) > 0) {
            $sql = "INSERT INTO `sms_attendance` (`student_id`, `attendance_status`, `attendance_date`) VALUES ('$student_id', '$attendance_status', '$attendance_date')";
            mysqli_query($conn, $sql);
        }
    }

    if (isset($_POST['request-leave'])) {
        $attendance_status = $_POST['student_leave'];
        $sql = "SELECT * FROM sms_attendance WHERE student_id = '$student_id' AND attendance_date = '$attendance_date'";
        $recordset = mysqli_query($conn, $sql);
        if (!mysqli_num_rows($recordset) > 0) {
            $sql = "INSERT INTO `sms_attendance` (`student_id`, `attendance_status`, `attendance_date`) VALUES ('$student_id', '$attendance_status', '$attendance_date')";
            mysqli_query($conn, $sql);
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Dashboard - SMS</title>

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
                <div class="col-md-10 border">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-apps me-2"></i>Students | Dashboard</h4>
                    </div>
                    <h5 class="mt-3"><i class="fi fi-rr-star me-2"></i>Current Month Attendance</h5>
                    <div class="row py-1 dashboard-cards">
                        <!-- Card 1 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-primary rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light">25</h1>
                                <p class="text-light">Presents</p>
                            </div>
                            <i class="fi fi-rr-user"></i>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-warning rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light">3</h1>
                                <p class="text-light">Leaves</p>
                            </div>
                            <i class="fi fi-rr-edit"></i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h5 class="mb-4"><i class="fi fi-rr-id-badge me-2"></i>Manage Attendance</h5>

                            <?php
                            $sql = "SELECT * FROM sms_attendance WHERE student_id = '$student_id' AND attendance_date = '$attendance_date'";
                            $recordset = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($recordset) == 0) {
                                $output = '
                                <form action="" method="POST" class="d-inline-block">
                                    <input type="hidden" value="' . $_SESSION['student_id'] . '" name="student_id">
                                    <input type="hidden" value="1" name="student_present" />
                                    <input type="submit" name="mark-present" class="btn btn-primary p-3 text-light rounded mx-2" value="Mark Present">
                                </form>

                                <form action="" method="POST" class="d-inline-block">
                                    <input type="hidden" value="' . $_SESSION['student_id'] . '" name="student_id">
                                    <input type="hidden" value="2" name="student_leave" />
                                    <input type="submit" name="request-leave" class="btn btn-success p-3 text-light rounded mx-2" value="Leave Request">
                                </form>
                                <h6 class="mx-2 mt-2 pb-2 border-bottom"></h6>
                                ';

                                echo $output;
                            } else {
                                $attendanceStatusMsg = "";
                                $record = mysqli_fetch_array($recordset);
                                if ($record['attendance_status'] == 1) {
                                    $attendanceStatusMsg = "Status: Present Marked";
                                } else if ($record['attendance_status'] == 2) {
                                    if($record['leave_status'] == "1")
                                    {
                                        $attendanceStatusMsg = "Status: Leave Disapproved";
                                    }
                                    else if($record['leave_status'] == "2")
                                    { 
                                        $attendanceStatusMsg = "Status: Leave Approved";
                                    }
                                    else
                                    {
                                        $attendanceStatusMsg = "Status: Leave Requested";
                                    }
                                }

                                $output = '
                                <form action="" method="POST" class="d-inline-block">
                                    <input type="submit" name="mark-present" class="btn btn-primary p-3 text-light rounded mx-2" value="Mark Present" disabled>
                                </form>

                                <form action="" method="POST" class="d-inline-block">
                                    <input type="submit" name="request-leave" class="btn btn-success p-3 text-light rounded mx-2" value="Leave Request" disabled>
                                </form>
                                
                                <h6 class="mx-2 mt-2 pb-2 border-bottom">' . $attendanceStatusMsg . '</h6>
                                ';

                                echo $output;
                            }
                            ?>

                            <a href="student-attendance.php" class="bg-secondary d-inline-block p-3 text-light rounded mx-2"><i class="fi fi-rr-book-alt mx-2"></i>View Attendance</a>

                        </div>
                        <div class="col-md-4"></div>
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