<?php
include("../includes/connection.php");
session_start();
  if(isset($_SESSION['auth']) == "1")
  {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
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
                <div class="row py-3 dashboard-cards">
                    <!-- Card 1 -->
                    <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-primary rounded d-flex flex-md-row justify-content-around">
                        <div>
                            <h1 class="text-light">25</h1>
                            <p class="text-light">Total Students</p>
                        </div>
                        <i class="fi fi-rr-user"></i>
                    </div>
                    <!-- Card 2 -->
                    <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-success rounded d-flex flex-md-row justify-content-around">
                        <div>
                            <h1 class="text-light">19</h1>
                            <p class="text-light">Present Today</p>
                        </div>
                        <i class="fi fi-rr-check"></i>
                    </div>
                    <!-- Card 3 -->
                    <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-warning rounded d-flex flex-md-row justify-content-around">
                        <div>
                            <h1 class="text-light">3</h1>
                            <p class="text-light">Leave Requests</p>
                        </div>
                        <i class="fi fi-rr-edit"></i>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-8">
                        <h5><i class="fi fi-rr-link-alt mx-2"></i>Quick Links</h5>
                        <a href="#" class="d-quick-links d-inline-block p-3 text-light rounded"><i class="fi fi-rr-document-signed mx-2"></i>Generate Attendance Report</a>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<?php
  }
  else{
    header("location:../admin-login.php");
  }
?>