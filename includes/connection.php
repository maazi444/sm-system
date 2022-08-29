<?php

    function connect_db(){
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db = "attendance";
        $conn = new mysqli($hostname, $username, $password);
        mysqli_select_db($conn, $db);
        if($conn->connect_error){
            die("Connection is not successful". $conn->connect_error);
        } 
        // echo "Connection Successful";
        return $conn; 
    }

   


    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "attendance";
    $conn = mysqli_connect($hostname, $username, $password);
    mysqli_select_db($conn, $db);
    if(!$conn){
        die("Connection is not successful");
    }

    function countAttendance($studentId, $attendanceStatus){
        $mycon= connect_db();
        $sql = "SELECT attendance_status FROM sms_attendance WHERE student_id = $studentId AND attendance_status = $attendanceStatus";
        $recordset = mysqli_query($mycon, $sql);
        $rowNumber = mysqli_num_rows($recordset);
        return $rowNumber;
    }
    
?>