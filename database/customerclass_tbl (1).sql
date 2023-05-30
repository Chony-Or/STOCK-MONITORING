-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 08:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `full`
--

-- --------------------------------------------------------

--
-- Table structure for table `customerclass_tbl`
--

CREATE TABLE `customerclass_tbl` (
  `customerClass_id` int(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `customer_discount` int(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerclass_tbl`
--

INSERT INTO `customerclass_tbl` (`customerClass_id`, `customer_type`, `customer_discount`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 'REGULAR', 10, '2022-11-18 00:00:00', '2022-11-18 00:00:00', NULL, 1),
(2, 'GUEST', 0, '2022-11-18 00:00:00', '2022-11-18 00:00:00', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customerclass_tbl`
--
ALTER TABLE `customerclass_tbl`
  ADD PRIMARY KEY (`customerClass_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customerclass_tbl`
--
ALTER TABLE `customerclass_tbl`
  MODIFY `customerClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
