<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    // echo $_SESSION['student_id'];
    // SELECT DISTINCT(concat(month(attendance_date),"-", YEAR(attendance_date))) from sms_attendance; 8-2022
    //  $sql = "SELECT * from sms_attendance WHERE concat(month(attendance_date),'-', YEAR(attendance_date)) = '9-2022'";

    //$sql = select a.attendance_id, s.student_name, a.attendance_status, a.leave_status, a.attendance_date from sms_attendance a, students s where a.student_id = s.id;
    $editAttendanceId;
    $attendanceMsg = "";
    $formOutput = "";
    $oldAttendanceDate = "";
    $student_email = $_GET['student_email'];

    $sql = "SELECT student_name, id FROM students WHERE student_email = '$student_email'";
    $row = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($row);
    $student_name = $record['student_name'];
    $student_id = $record['id'];

    if (isset($_POST['add-attendance'])) {
        $newAttendanceDate = $_POST['attendance_date'];
        $newAttendanceStatus = $_POST['attendance_status'];

        $sql = "SELECT attendance_date FROM sms_attendance WHERE student_id = $student_id AND attendance_date = '$newAttendanceDate'";
        $row = mysqli_query($conn, $sql);
        if (mysqli_num_rows($row) == 0) {
            $sql = "INSERT INTO sms_attendance (student_id, attendance_status, attendance_date) VALUES($student_id, $newAttendanceStatus, '$newAttendanceDate')";
            mysqli_query($conn, $sql);
        } else {
            $attendanceMsg = "Date Already Exists";
        }
    }

    if (isset($_POST['attendance_delete'])) {
        $attendanceId = $_POST['attendance_id'];
        $sql = "DELETE FROM sms_attendance WHERE attendance_id = $attendanceId";
        mysqli_query($conn, $sql);
    }

    if (isset($_POST['update-attendance'])) {


       
    }
     
    if (isset($_POST['attendance_edit'])) {
        $editAttendanceId = $_POST['attendance_id'];
        $sql = "SELECT * FROM sms_attendance WHERE attendance_id = $editAttendanceId";
        $row = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($row);

        $formOutput = '
        <form action="" class="ms-md-4 border border-alert p-2 rounded mt-3" method="POST">
            <h5>Edit Attendance</h5>
            <input type="hidden" class="form-control" name="edit_attendance_id" id="attendance_id" value="'.$editAttendanceId.'">
            <div class="d-flex align-items-center my-3">
                <label for="attendance_date" class="form-label me-md-4">Date: </label>
                <input type="date" class="form-control" name="edit_attendance_date" id="attendance_date" value="'.$record['attendance_date'].'" required>
            </div>
            <div class="d-flex align-items-center my-3">
                <label for="attendance_status" class="form-label me-md-4">Status</label>
                <select name="edit_attendance_status" class="form-control" id="attendance_status" required>
                    <option value="">Select Attendance...</option>
                    <option value="1">Present</option>
                    <option value="2">Absent</option>
                    <option value="4">Leave</option>
                </select>
            </div>
            <span class="text-danger my-2 d-block"><?php echo $attendanceMsg; ?></span>
            <input type="submit" class="btn btn-info w-100" name="update-attendance" value="Update">
        </form>
        ';
    }

    if (isset($_POST['update-attendance'])) {
        $editAttendanceId = $_POST['edit_attendance_id'];
        $editAttendanceDate = $_POST['edit_attendance_date'];
        $editAttendanceStatus = $_POST['edit_attendance_status'];
        $sql = "UPDATE  sms_attendance SET attendance_status = $editAttendanceStatus, attendance_date = '$editAttendanceDate' WHERE attendance_id = $editAttendanceId";
        $row = mysqli_query($conn, $sql);
        $formOutput = "";
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
                        <h4 class="my-2"><i class="fi fi-rr-eye me-2"></i>Admin | View Attendance - <?php echo $student_name; ?></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <form action="" class="ms-md-4 border border-alert p-2 rounded mt-3" method="POST">
                                <h5>Add Attendance</h5>
                                <div class="d-flex align-items-center my-3">
                                    <label for="attendance_date" class="form-label me-md-4">Date: </label>
                                    <input type="date" class="form-control" name="attendance_date" id="attendance_date" required>
                                </div>
                                <div class="d-flex align-items-center my-3">
                                    <label for="attendance_status" class="form-label me-md-4">Status</label>
                                    <select name="attendance_status" class="form-control" id="attendance_status" required>
                                        <option value="">Select Attendance...</option>
                                        <option value="1">Present</option>
                                        <option value="2">Absent</option>
                                        <option value="4">Leave</option>
                                    </select>
                                </div>
                                <span class="text-danger my-2 d-block"><?php echo $attendanceMsg; ?></span>
                                <input type="submit" class="btn btn-primary w-100" name="add-attendance" value="Add">
                            </form>
                            <?php
                            echo $formOutput;
                            ?>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <table class="table table-light table-striped text-center">
                                <thead>
                                    <th scope="col">Date (y-m-d)</th>
                                    <th scope="col">Attendance Status</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM sms_attendance WHERE student_id = $student_id ORDER BY attendance_date DESC";
                                    $dataRow = mysqli_query($conn, $sql);
                                    if (!mysqli_num_rows($dataRow) == 0) {
                                        while ($recordRow = mysqli_fetch_assoc($dataRow)) {
                                    ?>
                                    
                                    
                                    // please check above site for dropdown code update..... Ahmad Noor 31 Aug 2022
                                    //// https://stackoverflow.com/questions/50737788/populate-dropdown-from-database-and-set-default-value

                                            <tr>
                                                <td><?php echo $recordRow['attendance_date']; ?></td>
                                                <td><?php
                                                    if ($recordRow['attendance_status'] == 1) {
                                                        echo "Present";
                                                    } else if ($recordRow['attendance_status'] == 2) {
                                                        echo "Absent";
                                                    } else if ($recordRow['attendance_status'] == 3) {
                                                        echo "Leave Requested";
                                                    } else if ($recordRow['attendance_status'] == 4) {
                                                        echo "Leave";
                                                    } else if ($recordRow['attendance_status'] == 5) {
                                                        echo "Leave Disapproved";
                                                    }
                                                    ?></td>
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="attendance_id" value="<?php echo $recordRow['attendance_id']; ?>">
                                                        <input type="submit" class="btn btn-success mx-2" name="attendance_edit" value="Edit">
                                                        <input type="submit" class="btn btn-danger mx-2" name="attendance_delete" value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="3">No Record Found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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