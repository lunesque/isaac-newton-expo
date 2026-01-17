-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2025 at 01:44 AM
-- Server version: 9.2.0
-- PHP Version: 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expo_newton`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `login`, `password`, `first_name`, `last_name`, `email`) VALUES
(1, 'admin', '$2y$12$a2McLIqdSN9MLqUDQ7Ir5exk5jrJnl8MPIunbxwzy82rq5YlyYCji', 'toto', 'toto', 'toto@toto.com'),
(2, 'hang', '$2y$12$glZ8mDG9jl0HS.B7vlBwM.3UaRtGCEQ/MYEGxgyuap6clbVFjil9S', 'hang', 'nguyen', 'hang@toto.com'),
(4, 'a', '$2y$12$bJKrV7KINfoqZz0gtBEfvOmwShxijgYMYMGLZYL.zKpEue5bz5Uv2', 'a', 'a', 'a@a.com'),
(5, 'tutu', '$2y$12$pzC/T15qYgwkW1zS3pkqp.lsDXZ69Q18mbleD04wNI4h8AEg9nHIS', 'tutu', 'tutu', 'tutu@tutu.com'),
(6, 'bbbbb', '$2y$12$mUNMadKyvT3HmFK.jiVwhukdy/pE8BY6XOW0Rrch8a/.BVxUdaqvi', 'test', 'test', 'toto@toto.com'),
(9, 'neil', '$2y$12$gEJ7FdIbHtVBzsoo495pj.maL7hk.BWe807D9mXhgQax/7x3sZTzW', 'neil', 'josten', 'neil@josten.com'),
(10, 'andrew', '$2y$12$mZ/uw2ta4UmqMRZzjk2nJe0H0/AznbZ6irh0Ttk.winkkELc19Hym', 'andrew', 'minyard', 'andrew@minyard.com'),
(11, 'matt', '$2y$12$dGoaBvHCgrMRA2/Zn/fa3un01sHNiOSI9xF01Mtj.81VQHwe7g0tC', 'matt', 'boyd', 'matt@boyd.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(50) NOT NULL,
  `account_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `time_slot`, `account_id`, `created_at`, `modified_at`, `first_name`, `last_name`, `email`) VALUES
(4, '2025-03-21', '14h', NULL, '2025-03-12 16:14:56', '2025-03-22 18:56:27', 'toto', 'toto', 'toto@toto.com'),
(5, '2025-03-21', '14h', NULL, '2025-03-17 08:39:15', '2025-03-22 18:56:29', 'John', 'Doe', 'john@doe.com'),
(6, '2025-03-21', '14h', NULL, '2025-03-18 15:09:41', '2025-03-22 18:56:32', 'John', 'Doe', 'john@doe.com'),
(7, '2025-03-21', '17h', NULL, '2025-03-20 08:29:14', '2025-03-22 18:56:41', 'toto', 'toto', 'toto@toto.com'),
(8, '2025-03-21', '17h', 2, '2025-03-20 08:55:28', '2025-03-22 18:56:46', 'hang', 'nguyen', 'toto@toto.com'),
(11, '2025-03-21', '17h', NULL, '2025-03-20 15:17:48', '2025-03-22 18:56:58', 'hang', 'nguyen', 'toto@toto.com'),
(12, '2025-03-21', '17h', NULL, '2025-03-20 15:25:37', '2025-03-22 18:57:02', 'hang', 'nguyen', 'toto@toto.com'),
(13, '2025-03-21', '17h', NULL, '2025-03-20 15:26:04', '2025-03-22 18:57:05', 'hang', 'nguyen', 'toto@toto.com'),
(14, '2025-03-21', '17h', NULL, '2025-03-20 15:26:28', '2025-03-22 18:57:07', 'hang', 'nguyen', 'toto@toto.com'),
(15, '2025-03-21', '17h', NULL, '2025-03-20 15:27:01', '2025-03-22 18:57:11', 'hang', 'nguyen', 'toto@toto.com'),
(16, '2025-03-21', '17h', NULL, '2025-03-20 15:27:15', '2025-03-22 18:57:14', 'hang', 'nguyen', 'toto@toto.com'),
(17, '2025-03-20', '11h', NULL, '2025-03-22 15:43:48', NULL, 'hang', 'nguyen', 'toto@toto.com'),
(18, '2025-03-21', '14h', NULL, '2025-03-24 02:00:41', NULL, 't', 't', 'tutu@tutu.com'),
(19, '2025-03-18', '17h', NULL, '2025-03-24 02:01:39', NULL, 'hang', 'nguyen', 'thuyhang@nguyen.com'),
(20, '2025-03-20', '9h', 10, '2025-03-24 02:10:57', NULL, 'andrew', 'minyard', 'andrew@minyard.com'),
(21, '2025-03-20', '9h', 10, '2025-03-24 02:14:28', NULL, 'andrew', 'minyard', 'andrew@minyard.com'),
(22, '2025-03-23', '16h', 1, '2025-03-24 02:19:35', NULL, 'andrew', 'minyard', 'andrew@minyard.com'),
(23, '2025-03-07', '13h', NULL, '2025-03-24 02:25:38', NULL, 'dan', 'wilds', 'dan@wilds.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_ticket`
--

CREATE TABLE `reservation_ticket` (
  `id` int NOT NULL,
  `reservation_id` int NOT NULL,
  `ticket_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `reservation_ticket`
--

INSERT INTO `reservation_ticket` (`id`, `reservation_id`, `ticket_id`, `quantity`) VALUES
(1, 8, 1, 2),
(2, 8, 2, 2),
(3, 4, 2, 2),
(4, 6, 1, 4),
(5, 16, 1, 2),
(6, 5, 2, 1),
(7, 17, 1, 2),
(8, 7, 2, 1),
(9, 11, 3, 2),
(10, 12, 1, 2),
(11, 13, 2, 1),
(12, 14, 2, 2),
(13, 15, 1, 2),
(14, 16, 3, 1),
(15, 5, 3, 2),
(16, 18, 1, 3),
(17, 16, 2, 3),
(18, 17, 3, 2),
(19, 19, 1, 2),
(20, 19, 2, 1),
(22, 20, 2, 1),
(24, 21, 1, 1),
(26, 22, 1, 1),
(27, 22, 2, 1),
(28, 22, 3, 3),
(29, 23, 1, 1),
(30, 23, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text CHARACTER SET utf8mb4  NOT NULL,
  `unit_price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `description`, `unit_price`) VALUES
(1, 'Student', 'Reduced price for students', 5.00),
(2, 'Child', 'Free access for children', 0.00),
(3, 'Adult', 'Normal price', 10.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7D3656A4AA08CB10` (`login`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `reservation_ticket`
--
ALTER TABLE `reservation_ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_ticket_ibfk_1` (`reservation_id`),
  ADD KEY `reservation_ticket_ibfk_2` (`ticket_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reservation_ticket`
--
ALTER TABLE `reservation_ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reservation_ticket`
--
ALTER TABLE `reservation_ticket`
  ADD CONSTRAINT `reservation_ticket_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ticket_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
