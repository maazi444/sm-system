<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['student_auth']) == "1") {
    $studentName = $_SESSION['student_name'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Portal</title>

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
                        <h4>Dashboard</h4>
                    </div>
                    <h5 class="mt-3"><i class="fi fi-rr-star mx-2"></i>This Month Statistics</h5>
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
                            <h5 class="mb-4"><i class="fi fi-rr-id-badge mx-2"></i>Manage Attendance</h5>
                            <a href="#" class="bg-primary d-inline-block p-3 text-light rounded mx-2"><i class="fi fi-rr-check mx-2"></i>Mark Present</a>
                            <a href="#" class="bg-success d-inline-block p-3 text-light rounded mx-2"><i class="fi fi-rr-paper-plane mx-2"></i>Request Leave</a>
                            <a href="#" class="bg-secondary d-inline-block p-3 text-light rounded mx-2"><i class="fi fi-rr-book-alt mx-2"></i>View Attendance</a>
                            
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