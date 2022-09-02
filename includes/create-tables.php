<?php

$sql = "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_email` varchar(255) NOT NULL,
        `admin_password` varchar(255) NOT NULL
      )";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `lup_attendance` (
        `code` int(2) NOT NULL,
        `description` varchar(20) NOT NULL
      )";
mysqli_query($conn, $sql);
$sql = "CREATE TABLE IF NOT EXISTS `sms_attendance` (
        `attendance_id` int(255) NOT NULL,
        `student_id` int(255) NOT NULL,
        `attendance_status` int(255) NOT NULL,
        `attendance_date` date NOT NULL)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `students` (
    `id` int(10) NOT NULL,
    `student_name` varchar(255) NOT NULL,
    `student_email` varchar(255) NOT NULL,
    `student_password` varchar(255) NOT NULL,
    `student_subject` varchar(255) NOT NULL,
    `profile_picture` varchar(255) NOT NULL,
    `admission_date` varchar(255) NOT NULL
  )";

?>