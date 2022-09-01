<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    $searchOutput = "";
    $fromDate = "";
    $toDate = "";
    // echo $_SESSION['student_id'];
    // SELECT DISTINCT(concat(month(attendance_date),"-", YEAR(attendance_date))) from sms_attendance; 8-2022
    //  $sql = "SELECT * from sms_attendance WHERE concat(month(attendance_date),'-', YEAR(attendance_date)) = '9-2022'";

    //$sql = select a.attendance_id, s.student_name, a.attendance_status, a.leave_status, a.attendance_date from sms_attendance a, students s where a.student_id = s.id;

    if (isset($_POST['attendance_search'])) {
        $fromDate = $_POST['from_date'];
        $toDate = $_POST['to_date'];
        $sql = "SELECT s.student_name, a.attendance_status, a.attendance_date FROM sms_attendance a, students s WHERE a.student_id = s.id AND attendance_date BETWEEN '$fromDate' AND '$toDate'";
        $recordRow = mysqli_query($conn, $sql);

        if (mysqli_num_rows($recordRow) == 0) {
            echo '
                    <tr>
                        <td scope="col" rowspan="3">No Records Found</td>
                    </tr>
                ';
        } else {
            while ($record = mysqli_fetch_assoc($recordRow)) {
                $searchOutput = '
                    <tr>
                        <td scope="col">' . $record['attendance_date'] . '</td>
                        <td scope="col">' . $record['student_name'] . '</td>
                        <td scope="col">' . $record['attendance_status'] . '</td>
                    </tr>
                ';
            }
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

    <body class="bg-light">
        <main class="container-fluid">
            <div class="row dashboard-outer">
                <?php
                include("./includes/sideMenu.php");
                ?>
                <div class="col-md-10 overflow-auto">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4 class="my-2"><i class="fi fi-rr-chart-histogram me-2"></i>Admin | Generate Attendance Report</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 bg-dark text-white py-3">
                            <h5 class="mb-3"><i class="fi fi-rr-search me-2"></i>Search Criteria: </h5>

                            <!-- Select Criteria Form -->

                            <form action="" method="POST" class="d-flex align-items-end flex-wrap">
                                <div class="d-flex align-items-center me-5 flex-wrap">
                                    <label for="from_date" class="form-label me-2">From: </label>
                                    <input type="date" class="form-control" name="from_date" id="from_date" required>
                                </div>

                                <div class="d-flex align-items-center ms-md-5 flex-wrap">
                                    <label for="to_date" class="form-label me-2">To: </label>
                                    <input type="date" class="form-control" name="to_date" id="to_date" required>
                                </div>
                                <input type="submit" value="Search" name="attendance_search" class="btn btn-outline-success mx-3">
                            </form>

                        </div>
                        <h5 class="my-2">Showing results from <span class="text-primary"><?php echo $fromDate; ?></span> to <span class="text-primary"><?php echo $toDate; ?></span></h5>
                    </div>
                    <table class="table table-light table-striped text-center">
                        <thead>
                            <th scope="col">Date (y-m-d)</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Attendance Status</th>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['attendance_search'])) {
                                $fromDate = $_POST['from_date'];
                                $toDate = $_POST['to_date'];
                                $sql = "SELECT s.student_name, a.attendance_status, a.attendance_date FROM sms_attendance a, students s WHERE a.student_id = s.id AND attendance_date BETWEEN '$fromDate' AND '$toDate' ORDER BY attendance_date ASC";
                                $recordRow = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($recordRow) == 0) {
                                    echo '
                                                <tr>
                                                    <td scope="col" colspan="3">No Records Found</td>
                                                </tr>
                                            ';
                                } else {
                                    while ($record = mysqli_fetch_assoc($recordRow)) {
                            ?>
                                        <tr>
                                            <td scope="col"><?php echo $record['attendance_date']; ?></td>
                                            <td scope="col"><?php echo $record['student_name']; ?></td>
                                            <td scope="col">
                                                <?php
                                                if ($record['attendance_status'] == 1) {
                                                    echo "Present";
                                                } else if ($record['attendance_status'] == 2) {
                                                    echo "Absent";
                                                } else if ($record['attendance_status'] == 3) {
                                                    echo "Leave Requested";
                                                } else if ($record['attendance_status'] == 4) {
                                                    echo "Leave";
                                                } else if ($record['attendance_status'] == 5) {
                                                    echo "Leave Disapproved";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
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