-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2025 at 08:10 AM
-- Server version: 9.1.0
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codecamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` double NOT NULL DEFAULT '15000',
  `date` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `price`, `date`) VALUES
(13, 'Game Dev in Roblox', 'For more information about this course please contact our support', 2, '2021-09-15T08:55'),
(15, 'Web Development with JavaScript\r\n', NULL, 15000, '0000-00-00'),
(16, '3D Design and Modeling with Blender\r\n', NULL, 15000, '0000-00-00'),
(19, 'Build Simple Applications With Java\r\n', NULL, 15000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `course_enroll`
--

DROP TABLE IF EXISTS `course_enroll`;
CREATE TABLE IF NOT EXISTS `course_enroll` (
  `course_id` int NOT NULL,
  `user_id` int NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user` (`user_id`),
  KEY `courses` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_enroll`
--

INSERT INTO `course_enroll` (`course_id`, `user_id`, `datetime`) VALUES
(19, 2, '2021-08-04 13:57:33'),
(16, 2, '2021-08-04 13:59:13'),
(13, 2, '2021-08-04 14:11:34'),
(13, 2, '2021-08-04 14:11:42'),
(15, 3, '2021-08-06 08:13:19'),
(13, 3, '2021-08-17 09:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `course_payments`
--

DROP TABLE IF EXISTS `course_payments`;
CREATE TABLE IF NOT EXISTS `course_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `course_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `amount` double(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_payments`
--

DROP TABLE IF EXISTS `mpesa_payments`;
CREATE TABLE IF NOT EXISTS `mpesa_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `result_code` varchar(10) NOT NULL,
  `result_desc` varchar(255) NOT NULL,
  `merchant_request_id` varchar(50) NOT NULL,
  `checkout_request_id` varchar(50) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `mpesa_receipt_number` varchar(30) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

DROP TABLE IF EXISTS `password_reset_temp`;
CREATE TABLE IF NOT EXISTS `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course` int NOT NULL,
  `age` int NOT NULL,
  `phone` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fname`, `lname`, `email`, `course`, `age`, `phone`) VALUES
(6, 'Stephen', 'Owago', 'stevenowago@gmail.com', 2, 23, '+254713218312');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `startdatetime` varchar(25) NOT NULL,
  `link` text NOT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `trn_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `role_id`, `trn_date`) VALUES
(2, 'Stephen Owago', 'stevenowago@gmail.com', '$2y$10$X4LBT4hq.KYIOyfFIh192uICXhanC3qjfE61oCMn0FCkQ3ujc5dOy', '+254713218312', 2, '2021-08-03'),
(3, 'Stephen Owago', 'steveowago@gmail.com', '$2y$10$FvWQPgR9BCizWXA4bFtUquIabzt7gf4AlVQTKCDexRnwAtcZ28BDa', '+254713218312', 1, '2021-08-04'),
(5, 'admin', 'admin', '$2y$10$FvWQPgR9BCizWXA4bFtUquIabzt7gf4AlVQTKCDexRnwAtcZ28BDa', '9876543212', 2, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_enroll`
--
ALTER TABLE `course_enroll`
  ADD CONSTRAINT `courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `course_payments`
--
ALTER TABLE `course_payments`
  ADD CONSTRAINT `course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
