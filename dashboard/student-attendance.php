<?php
include("../includes/connection.php");
include("../includes/countAttendance.php");
session_start();
if (isset($_SESSION['student_auth']) == "1") {
    // echo $_SESSION['student_id'];
    $studentName = $_SESSION['student_name'];
    $student_id = $_SESSION['student_id'];
    $monthName = "";

    $currentDate = date("Y-n-d");
    // echo $currentDate;
    $currentDateArray = explode("-", $currentDate);
    $currentMonth = $currentDateArray[1];
    // echo "<br/>".$currentMonth;
    $monthName = date('M', mktime(0, 0, 0, $currentMonth, 10));
    // echo "<br/>".$monthName;

    // $sql = "SELECT attendance_date from sms_attendance WHERE student_id = '$student_id'";
    // echo $sql;
    // exit();
    // $row = mysqli_query($conn, $sql);
    // if(mysqli_num_rows($row) > 0)
    // {
    //     $record = mysqli_fetch_assoc($row);
    //     $date = $record['attendance_date'];
    //     $dateArray = explode("-", $date);
    //     $monthNumber = $dateArray[1];
    //     $monthName = date('M', mktime(0, 0, 0, $monthNumber, 10));
    // }
    // else{
    //     echo "No record Found";
    // }
    // exit();

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
                include("./includes/studentSideMenu.php");
                ?>
                <div class="col-md-10">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-eye me-2"></i>Students | View Attendance</h4>
                    </div>
                    <h5 class="mt-4">Current Month: <?php echo $monthName; ?></h5>
                    <table class="table table-dark table-striped w-50 text-center">
                        <thead>
                            <th scope="col">Present</th>
                            <th scope="col">Leave</th>
                            <th scope="col">Total</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    echo countAttendance($student_id, 1, $currentMonth);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo countAttendance($student_id, 2, $currentMonth);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo countAttendance($student_id, 2, $currentMonth) + countAttendance($student_id, 1, $currentMonth);
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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