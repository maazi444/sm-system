-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220720.c906f43e9a
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2022 at 10:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_email`, `admin_password`) VALUES
('admin@email.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `lup_attendance`
--

CREATE TABLE `lup_attendance` (
  `code` int(2) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lup_attendance`
--

INSERT INTO `lup_attendance` (`code`, `description`) VALUES
(1, 'Present'),
(2, 'Absent'),
(3, 'Leave Request'),
(4, 'Leave Approved'),
(5, 'Leave Disapproved');

-- --------------------------------------------------------

--
-- Table structure for table `sms_attendance`
--

CREATE TABLE `sms_attendance` (
  `attendance_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `attendance_status` int(255) NOT NULL,
  `attendance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_attendance`
--

INSERT INTO `sms_attendance` (`attendance_id`, `student_id`, `attendance_status`, `attendance_date`) VALUES
(1, 1, 1, '2022-08-28'),
(3, 1, 1, '2022-08-27'),
(6, 1, 1, '2022-08-29'),
(7, 2, 2, '2022-08-29'),
(8, 4, 1, '2022-08-29'),
(9, 5, 2, '2022-09-02'),
(10, 1, 4, '2022-08-30'),
(11, 2, 4, '2022-08-30'),
(12, 4, 5, '2022-08-30'),
(13, 3, 5, '2022-08-30'),
(17, 1, 2, '2022-08-26'),
(22, 2, 1, '2022-08-28'),
(25, 1, 1, '2022-08-31'),
(26, 1, 1, '2022-08-25'),
(27, 3, 1, '2022-09-02'),
(28, 2, 2, '2022-09-02'),
(29, 1, 2, '2022-09-02'),
(30, 4, 1, '2022-09-02'),
(31, 0, 1, '2022-09-02'),
(34, 13, 4, '2022-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `student_subject` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `admission_date` varchar(255) NOT NULL,
  `status` varchar(7) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`, `student_email`, `student_password`, `student_subject`, `profile_picture`, `admission_date`, `status`) VALUES
(1, 'Maaz Ahmad', 'maazahmad@gmail.com', 'maaz123', 'Web Development', '1.jpg', '27-08-2022', 'active'),
(2, 'Qasim Rashid', 'qasim@gmail.com', 'qasim123', 'web', 'lio.jpeg', '27-08-2022', 'Active'),
(3, 'Abdullah Ahmad', 'abdullah@gmail.com', 'abdullah123', 'Web Design', 'deer logo2.jpg', '28-08-2022', 'Active'),
(4, 'Muhammad Ali', 'ali@gmail.com', 'ali123', 'Web Development', 'lio.jpeg', '28-08-2022', 'Active'),
(5, 'Qasim Ali Shah', 'qasimali@gmail.com', 'qasim123', 'Web Development', 'Drift tomorrow shirt.jpg', '28-08-2022', 'Active'),
(6, 'Ahmad', 'ahmad@gmail.com', '12345', 'Web Development', '1656156388874.jpg', '02-09-2022', 'Active'),
(13, 'jane doe', 'jane@gmail.com', 'jane123', 'Web Design', '1656156388874.jpg', '02-09-2022', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_email`);

--
-- Indexes for table `lup_attendance`
--
ALTER TABLE `lup_attendance`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `Uniq_attendance` (`student_id`,`attendance_date`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_email` (`student_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_attendance`
--
ALTER TABLE `sms_attendance`
  MODIFY `attendance_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
