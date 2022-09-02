<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {

    function stats($query)
    {
        include("../includes/connection.php");
        $todayDate = date("Y-n-d");
        $sql = "SELECT COUNT(*) from sms_attendance WHERE attendance_date = '$todayDate' AND attendance_status = $query";
        $row = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($row);
        return $result['COUNT(*)'];
    }

    function totalStudents(){
        include("../includes/connection.php");
        $sql = "SELECT COUNT(*) FROM students WHERE status = 'Active'";
        $recordset = mysqli_query($conn, $sql);
        $record = mysqli_fetch_assoc($recordset);
        return $record['COUNT(*)'];
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard - SMS</title>
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
                include("./includes/sideMenu.php");
                ?>
                <div class="col-md-10 border">
                    <div class="col-md-12 border-bottom border-alert">
                        <h4>Dashboard</h4>
                    </div>
                    <h6 class="my-3">Today Statistics</h6>
                    <div class="row py-1 dashboard-cards">
                        <!-- Card 1 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 bg-primary rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light"><?php
                                                        echo totalStudents();
                                                        ?></h1>
                                <p class="text-light">Strength</p>
                            </div>
                            <i class="fi fi-rr-user"></i>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 bg-success rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light"><?php
                                                        echo stats(1);
                                                        ?></h1>
                                <p class="text-light">Present</p>
                            </div>
                            <i class="fi fi-rr-check"></i>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 bg-warning rounded d-flex flex-md-row justify-content-around">
                            <a href="admin-leave-approval.php">
                                <div>
                                    <h1 class="text-dark"><?php
                                                            echo stats(3);
                                                            ?></h1>
                                    <p class="text-dark">Leave Requests</p>
                                </div>
                            </a>
                            <i class="fi fi-rr-edit text-dark"></i>
                        </div>

                        <!-- Card 1 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 bg-danger rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light"><?php
                                                        echo totalStudents() - (stats(1) + stats(3)+ stats(4)) ;
                                                        ?></h1>
                                <p class="text-light">Absent</p>
                            </div>
                            <i class="fi fi-rr-cross-circle"></i>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 bg-info rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-dark"><?php
                                                        echo stats(4);
                                                        ?></h1>
                                <p class="text-dark">Leave</p>
                            </div>
                            <i class="fi fi-rr-notebook text-dark"></i>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h5><i class="fi fi-rr-link-alt mx-2"></i>Quick Links</h5>
                            <a href="admin-attendance-report.php" class="btn btn-outline-dark d-inline-block p-3 rounded my-2"><i class="fi fi-rr-document-signed mx-2"></i>Generate Attendance Report</a>

                            <a href="admin-view-grade.php" class="btn btn-outline-dark d-inline-block p-3 rounded my-2"><i class="fi fi-rr-eye mx-2"></i>View Student Grades</a>
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