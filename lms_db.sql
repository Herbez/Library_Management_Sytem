-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2024 at 12:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookId` int(10) NOT NULL,
  `Title` varchar(50) DEFAULT NULL,
  `Publisher` varchar(50) DEFAULT NULL,
  `Year` varchar(50) DEFAULT NULL,
  `Availability` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookId`, `Title`, `Publisher`, `Year`, `Availability`) VALUES
(2, 'DBMS', 'Sybex', '2010', '35'),
(8, 'Database Processing', 'Prentice Hall', '2013', '15'),
(9, 'Machine Learning', 'Apress', '2015', '45'),
(15, 'Machine Design', 'Pearson India ', '2012', '58'),
(21, 'Software Enginner', 'Pearson', '2023', '47'),
(22, 'Computational Methods', 'Pearson', '2002', '55'),
(25, 'DevOPs', 'Pearson', '2023', '65'),
(29, 'how to code using PHP', 'Pearson', '2010', '58');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `rec_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrowdate` datetime DEFAULT NULL,
  `returndate` datetime DEFAULT NULL,
  `duedate` datetime DEFAULT NULL,
  `Dues` int(11) DEFAULT NULL,
  `renewals` int(11) DEFAULT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`rec_id`, `email`, `book_id`, `borrowdate`, `returndate`, `duedate`, `Dues`, `renewals`, `Status`) VALUES
(1, 'tshemaherbez@gmail.com', 21, '2024-02-01 17:40:25', '2024-02-03 18:10:39', '2024-02-11 17:40:25', -8, 1, 'Accepted'),
(2, 'bosco@gmail.com', 8, '2024-02-03 15:00:25', '2024-02-03 00:00:00', '2024-02-13 15:00:25', -10, 1, 'Accepted'),
(3, 'bosco@gmail.com', 22, '2024-02-02 18:48:40', NULL, '2024-02-12 18:48:40', NULL, 1, 'Accepted'),
(5, 'Jeannet@gmail.com', 21, '2024-02-06 12:22:52', '2024-02-18 12:26:38', '2024-02-16 12:22:52', 2, 1, 'Accepted'),
(8, 'Jeannet@gmail.com', 22, '2024-02-06 12:37:11', NULL, '2024-02-26 12:37:11', NULL, 0, 'Accepted'),
(12, 'chantal@gmail.com', 21, '2024-02-07 10:56:29', NULL, NULL, NULL, NULL, 'Rejected'),
(13, 'alexandre@gmail.com', 21, '2024-02-07 11:09:35', NULL, '2024-02-17 11:09:35', NULL, 1, 'Accepted'),
(14, 'alexandre@gmail.com', 25, '2024-02-07 12:25:09', NULL, '2024-02-17 12:25:09', -10, 1, 'Accepted'),
(15, 'tshemaherbez@gmail.com', 21, '2024-02-07 12:49:33', NULL, NULL, NULL, NULL, 'Pending'),
(16, 'mbonyi@gmail.com', 29, '2024-02-08 14:44:39', NULL, '2024-02-18 14:44:39', -10, 1, 'Accepted'),
(17, 'alphonse@gmail.com', 29, '2024-02-08 14:48:24', '2024-02-08 14:49:41', '2024-02-18 14:48:24', -10, 1, 'Accepted'),
(18, 'bosco@gmail.com', 29, '2024-02-08 16:20:44', NULL, '2024-02-28 16:20:44', -10, 0, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `renew`
--

CREATE TABLE `renew` (
  `email` varchar(50) NOT NULL,
  `BookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `renew`
--

INSERT INTO `renew` (`email`, `BookId`) VALUES
('alexandre@gmail.com', 25),
('bosco@gmail.com', 22);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE `return` (
  `email` varchar(50) NOT NULL,
  `BookId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return`
--

INSERT INTO `return` (`email`, `BookId`) VALUES
('bosco@gmail.com', 8),
('tshemaherbez@gmail.com', 21),
('Jeannet@gmail.com', 21),
('alphonse@gmail.com', 29);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `names` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `names`, `email`, `phone`, `category`, `department`, `type`, `password`) VALUES
(1, 'Librarian', 'librarian@gmail.com', '0788881000', NULL, NULL, 1, '123'),
(2, 'Herbez', 'tshemaherbez@gmail.com', '0789091938', 'student', 'ICT', 0, '123'),
(3, 'Bosco', 'bosco@gmail.com', '0788882000', 'student', 'ICT', 0, '123'),
(5, 'Jeannet', 'Jeannet@gmail.com', '078794008', 'student', 'ICT', 0, '123'),
(6, 'Alexandre', 'alexandre@gmail.com', '0788997766', 'teacher', 'Electrical', 0, '123'),
(7, 'Chantal', 'chantal@gmail.com', '0789124355', 'student', 'ICT', 0, '123'),
(9, 'Mbonyi Israel', 'mbonyi@gmail.com', '0789091978', 'student', 'ICT', 0, '12345'),
(10, 'Alphonse', 'alphonse@gmail.com', '0789091939', 'student', 'ICT', 0, '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookId`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `renew`
--
ALTER TABLE `renew`
  ADD KEY `fk_renew` (`BookId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `book` (`BookId`);

--
-- Constraints for table `renew`
--
ALTER TABLE `renew`
  ADD CONSTRAINT `fk_renew` FOREIGN KEY (`BookId`) REFERENCES `book` (`BookId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
