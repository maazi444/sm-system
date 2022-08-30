<?php
function countAttendance($studentId, $attendanceStatus, $currentMonth)
{
    include("../includes/connection.php");
    $sql = "SELECT attendance_status FROM sms_attendance WHERE student_id = $studentId AND attendance_status = $attendanceStatus AND 
    month(attendance_date) = $currentMonth";
    $recordset = mysqli_query($conn, $sql);
    $rowNumber = mysqli_num_rows($recordset);
    if($rowNumber > 0)
    {
        return $rowNumber;
    }
    else{
        return 0;
    }
}
