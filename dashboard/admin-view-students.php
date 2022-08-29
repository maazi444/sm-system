<?php
include("../includes/connection.php");
session_start();
if (isset($_SESSION['auth']) == "1") {
    $totalStudents;
    $sql = "SELECT * from students";
    $row = mysqli_query($conn, $sql);
    if(mysqli_num_rows($row) > 0)
    {
        $totalStudents = mysqli_num_rows($row);
    }
    else{
        $totalStudents = 0;
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
                        <h4 class="my-2"><i class="fi fi-rr-eye me-2"></i>Admin | View Students</h4>
                    </div>

                    <div class="row py-3 dashboard-cards">
                        <!-- Card 1 -->
                        <div class="col-md-3 mx-md-2 my-2 py-3 d-flex bg-primary rounded d-flex flex-md-row justify-content-around">
                            <div>
                                <h1 class="text-light"><?php echo $totalStudents; ?></h1>
                                <p class="text-light">Total Students</p>
                            </div>
                            <i class="fi fi-rr-user"></i>
                        </div>
                    </div>
                    <table class="table table-dark table-striped w-75">
                        <thead>
                            <th scope="col">Name</th>
                            <th scope="col">Admission Date</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php
                            while ($record = mysqli_fetch_assoc($row)) {
                                $output = '<tr>
                                    <td>' . $record['student_name'] . '</td>
                                    <td>' . $record['admission_date'] . '</td>
                                    <td>
                                        <form action="" method="POST">
                                        <input type="hidden" value="' . $record['id'] . '" name="student_num">
                                        <input type="submit" class="btn btn-info" name="view-attendance" value="View Attendance">
                                        </form>
                                    </td>';
                                echo $output;
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