-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 10:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(15) NOT NULL,
  `admin_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'parv gupta', 'parvg555', 'parvgupta', 'parvg1234@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupcode` int(10) NOT NULL,
  `tcode` varchar(30) NOT NULL,
  `scode` varchar(30) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_uniquename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupcode`, `tcode`, `scode`, `group_name`, `group_uniquename`) VALUES
(7, 'ierxweiH1', 'htlytnkH1', 'M1', 'M1'),
(8, 'ierxweiH2', 'htlytnkH2', 'M2', 'M2');

-- --------------------------------------------------------

--
-- Table structure for table `m1_students`
--

CREATE TABLE `m1_students` (
  `student_id` int(10) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_username` varchar(255) DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m1_subjects`
--

CREATE TABLE `m1_subjects` (
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(30) DEFAULT NULL,
  `subject_teachercode` int(10) DEFAULT NULL,
  `subject_teachername` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m1_teachers`
--

CREATE TABLE `m1_teachers` (
  `teacher_id` int(10) DEFAULT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_username` varchar(255) DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m2_students`
--

CREATE TABLE `m2_students` (
  `student_id` int(10) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_username` varchar(255) DEFAULT NULL,
  `student_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m2_students`
--

INSERT INTO `m2_students` (`student_id`, `student_name`, `student_username`, `student_email`) VALUES
(5, 'Parv Gupta', 'parvg555', 'parvg555@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `m2_subjects`
--

CREATE TABLE `m2_subjects` (
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(30) DEFAULT NULL,
  `subject_teachercode` int(10) DEFAULT NULL,
  `subject_teachername` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `m2_teachers`
--

CREATE TABLE `m2_teachers` (
  `teacher_id` int(10) DEFAULT NULL,
  `teacher_name` varchar(255) DEFAULT NULL,
  `teacher_username` varchar(255) DEFAULT NULL,
  `teacher_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reported_student`
--

CREATE TABLE `reported_student` (
  `student_id` int(10) NOT NULL,
  `teacher_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(10) NOT NULL,
  `student_rollnumber` int(15) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_username` varchar(30) NOT NULL,
  `student_password` varchar(15) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_group` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_rollnumber`, `student_name`, `student_username`, `student_password`, `student_email`, `student_group`) VALUES
(5, 101916073, 'Parv Gupta', 'parvg555', 'parvgupta', 'parvg555@gmail.com', 'M2');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(10) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_username` varchar(30) NOT NULL,
  `teacher_password` varchar(15) NOT NULL,
  `teacher_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_name`, `teacher_username`, `teacher_password`, `teacher_email`) VALUES
(4, 'Parv gupta', 'parvg555', 'parvgupta', 'parvg1234@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_teacher`
--

CREATE TABLE `waiting_teacher` (
  `waiting_id` int(10) NOT NULL,
  `waiting_name` varchar(255) NOT NULL,
  `waiting_username` varchar(30) NOT NULL,
  `waiting_email` varchar(255) NOT NULL,
  `waiting_password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupcode`);

--
-- Indexes for table `m1_subjects`
--
ALTER TABLE `m1_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `m2_subjects`
--
ALTER TABLE `m2_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `waiting_teacher`
--
ALTER TABLE `waiting_teacher`
  ADD PRIMARY KEY (`waiting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupcode` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m1_subjects`
--
ALTER TABLE `m1_subjects`
  MODIFY `subject_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m2_subjects`
--
ALTER TABLE `m2_subjects`
  MODIFY `subject_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `waiting_teacher`
--
ALTER TABLE `waiting_teacher`
  MODIFY `waiting_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
