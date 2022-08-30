<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    // echo $_SESSION['student_id'];
    // SELECT DISTINCT(concat(month(attendance_date),"-", YEAR(attendance_date))) from sms_attendance; 8-2022
    //  $sql = "SELECT * from sms_attendance WHERE concat(month(attendance_date),'-', YEAR(attendance_date)) = '9-2022'";

    //$sql = select a.attendance_id, s.student_name, a.attendance_status, a.leave_status, a.attendance_date from sms_attendance a, students s where a.student_id = s.id;
    
    // $record = mysqli_fetch_assoc($row);
    // $date = $record['attendance_date'];
    // $dateArray = explode("-", $date);
    // $monthNumber = $dateArray[1];

    // $monthName = date('M', mktime(0, 0, 0, $monthNumber, 10));

    $student_email = $_GET['student_email'];
    
    $sql = "SELECT student_name, id FROM students WHERE student_email = '$student_email'";
    $row = mysqli_query($conn, $sql);
    $record = mysqli_fetch_assoc($row);
    $student_name = $record['student_name'];
    $student_id = $record['id'];
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
                    <table class="table table-light table-striped w-75 text-center">
                        <thead>
                            <th scope="col">Date (y-m-d)</th>
                            <th scope="col">Attendance Status</th>
                            <th scope="col">Actions</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM sms_attendance WHERE student_id = $student_id";
                                $dataRow = mysqli_query($conn, $sql);
                                if(!mysqli_num_rows($dataRow) == 0)
                                {
                                    while($recordRow = mysqli_fetch_assoc($dataRow))
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $recordRow['attendance_date']; ?></td>
                                                <td><?php
                                                    if($recordRow['attendance_status'] == 1)
                                                    {
                                                        echo "Present";
                                                    }
                                                    else if($recordRow['attendance_status'] == 2)
                                                    {
                                                        echo "Absent";
                                                    }
                                                    else if($recordRow['attendance_status'] == 3)
                                                    {
                                                        echo "Leave Requested";
                                                    }
                                                    else if($recordRow['attendance_status'] == 4){
                                                        echo "Leave Approved";
                                                    }
                                                    else if($recordRow['attendance_status'] == 5){
                                                        echo "Leave Disapproved";
                                                    }
                                                ?></td>
                                                <td>
                                                    <form action="" method="POST">
                                                        <input type="submit" class="btn btn-primary mx-2" value="Edit">
                                                        <input type="submit" class="btn btn-danger mx-2" value="Delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
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
        </main>
    </body>

    </html>

<?php
} else {
    header("location:../index.php");
}
?>