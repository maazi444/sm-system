<?php
$hostname = "localhost";
$username = "root";
$password = "";
$db = "attendance";
$conn = mysqli_connect($hostname, $username, $password);
mysqli_select_db($conn, $db);
if (!$conn) {
    die("Connection is not successful");
}

// function countAttendance($studentId, $attendanceStatus)
// {
//     include("");
//     $sql = "SELECT attendance_status FROM sms_attendance WHERE student_id = $studentId AND attendance_status = $attendanceStatus";
//     $recordset = mysqli_query($conn, $sql);
//     $rowNumber = mysqli_num_rows($recordset);
//     return $rowNumber;
// }
