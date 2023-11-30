-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 06:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sva`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`) VALUES
(1, 'shrinkhala@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Shrinkhala Joshi');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_category` varchar(255) NOT NULL,
  `course_created` datetime NOT NULL DEFAULT current_timestamp(),
  `course_description` text NOT NULL,
  `no_of _videos` int(11) NOT NULL DEFAULT 1,
  `thumbnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_category`, `course_created`, `course_description`, `no_of _videos`, `thumbnail`) VALUES
(9, 'C Programming', 'IT and Computer Science', '2023-10-02 07:24:14', 'This is a C-Programming tutorial. ', 1, '651fa94c38b8apexels-pavel-danilyuk-7120409.jpg'),
(10, 'Guitar Lesson For Beginners', 'Music', '2023-10-02 07:55:36', 'This is a basic guitar for beginners.', 1, '651fa93d3fa42pexels-pavel-danilyuk-7120409.jpg'),
(13, 'Nepali Language 101', 'Language', '2023-10-02 08:34:34', 'Learn Nepali language with Barsha', 1, ''),
(14, 'Video Editing for beginners', 'Film and Video', '2023-10-02 10:30:22', 'this is a video editing course for beginners', 1, ''),
(15, 'Java For Everybody', 'IT and Computer Science', '2023-10-05 10:15:28', 'this is java course', 1, ''),
(16, 'How to make Samosa at Home', 'Cooking', '2023-10-06 09:56:06', 'In this course you will learn to make samosa at home', 1, ''),
(17, 'OOP in java', 'IT and Computer Science', '2023-10-08 07:31:56', 'vdchvs', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `rating_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `comment`, `rating`, `course_id`, `rating_date`) VALUES
(1, 2, '', 1, 9, '2023-10-05 15:11:45'),
(2, 2, '', 4, 10, '2023-10-05 15:13:29'),
(3, 3, '', 0, 14, '2023-10-06 00:45:06'),
(4, 3, '', 5, 13, '2023-10-06 00:46:07'),
(5, 3, '', 5, 10, '2023-10-06 01:00:57'),
(6, 3, '', 0, 9, '2023-10-07 10:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullName`, `email`, `phone`, `password`) VALUES
(1, 'Shrinkhala Joshi', 'shrinkhala@gmail.com', '9800000000', '153bd4ad2dd9ac6c6e05b366adf27415'),
(2, 'Shrinkhala Joshi', 'shrinkhala1@gmail.com', '9800000000', '153bd4ad2dd9ac6c6e05b366adf27415'),
(3, 'Himanjali Joshi', 'maanju@gmail.com', '9800000000', 'fc9857c02f0f72bad6b468984b8d8d0b');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_file_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `episode_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_file_path`, `created_at`, `course_id`, `title`, `description`, `episode_no`) VALUES
(32, '../videos/651f892cf3b7e.mp4', '2023-10-06 06:12:28', 16, 'Learn to make Samosa', 'make delicious home made samosa', 1),
(33, '../videos/651f8fe9986d1.mp4', '2023-10-06 06:41:13', 13, 'Name of Months', 'learn the name of months in Nepali', 2),
(34, '../videos/651f901566669.mp4', '2023-10-06 06:41:57', 13, 'Ordinal Numbers', 'Learn Ordinal Numbers in Nepali', 3),
(35, '../videos/651f9038e0d9b.mp4', '2023-10-06 06:42:32', 13, 'Professions', 'learn Professions in Nepali', 4),
(36, '../videos/6521ddd528707.mp4', '2023-10-08 00:38:13', 10, 'Basic Open Chords', 'learn Basic Open Chords', 1),
(37, '../videos/6521ddf5bb88c.mp4', '2023-10-08 00:38:45', 10, 'How to strum with fingers', 'How to strum with fingers', 2),
(38, '../videos/6521e19f2f195.mp4', '2023-10-08 00:54:23', 9, 'Introduction to C Programming ', 'Introduction to C Programming ', 1),
(39, '../videos/6521e1cf3c6ad.mp4', '2023-10-08 00:55:11', 9, 'Installing GCC Compiler', 'Installing GCC Compiler', 2),
(40, '../videos/6521e36ee3bec.mp4', '2023-10-08 01:02:06', 15, 'Class and Object in Java', 'Class and Object in Java', 1),
(41, '../videos/6521e38e36669.mp4', '2023-10-08 01:02:38', 15, 'Inheritance in Java ', 'Inheritance in Java ', 2),
(42, '../videos/6521e3b0cc8ea.mp4', '2023-10-08 01:03:12', 15, 'Super keyword in Java ', 'Super keyword in Java ', 3),
(43, '../videos/6521e42b6fbcd.mp4', '2023-10-08 01:05:15', 14, 'Course Introduction', 'Video Editing Course for beginners', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `UQ_review` (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`),
  ADD UNIQUE KEY `UC_Video` (`course_id`,`video_file_path`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
