<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    $currentMonth = date("n");
    $lastMonth = intval($currentMonth) - 1;
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
                <div class="col-md-10 overflow=auto">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-eye me-2"></i>Admin | View Grades</h4>
                    </div>

                    <div class="col-md-8 col-sm-12 mt-4">
                        <table class="table table-dark table-striped text-center">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Present</th>
                                <th scope="col">Grade</th>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT DISTINCT a.student_id, s.student_name, a.attendance_status FROM sms_attendance a, students s WHERE a.student_id = s.id AND a.attendance_status = 1 AND month(a.attendance_date) = '$lastMonth'";
                                    $result = mysqli_query($conn, $sql);

                                    // $sql = "SELECT attendance_status FROM sms_attendance a, students s WHERE a.student_id = s.id AND ";

                                    $row = mysqli_query($conn, $sql);
                                    while($record = mysqli_fetch_assoc($row))
                                    {
                                        $studentId = $record['student_id'];
                                        $sql = "SELECT attendance_status FROM sms_attendance WHERE student_id = $studentId AND month(attendance_date) = '$lastMonth' AND attendance_status = 1";
                                        $recordRow = mysqli_query($conn, $sql);
                                        $attendanceNumber = mysqli_num_rows($recordRow);
                                        
                                ?>
                                        <tr>
                                            <td scope="col"><?php echo $record['student_name']; ?></td>
                                            <td scope="col"><?php echo $attendanceNumber; ?></td>
                                            <td scope="col">
                                                <?php
                                                if($attendanceNumber > 25)
                                                    echo "A+";
                                                else if($attendanceNumber > 20)
                                                    echo "A";
                                                else if($attendanceNumber > 15)
                                                    echo "B";
                                                else if($attendanceNumber > 10)
                                                    echo "C";
                                                else if($attendanceNumber > 4)
                                                    echo "D";
                                                else
                                                    echo "F";
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }

                                ?>
                            </tbody>
                        </table>
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