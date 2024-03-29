-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2023 at 03:46 AM
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
-- Database: `la_bvrgs`
--

-- --------------------------------------------------------

--
-- Table structure for table `productclass_tbl`
--

CREATE TABLE `productclass_tbl` (
  `productClass_id` int(255) NOT NULL,
  `product_class` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productclass_tbl`
--

INSERT INTO `productclass_tbl` (`productClass_id`, `product_class`, `date_created`, `date_updated`, `is_active`) VALUES
(1, 'SOFTDRINK', '2022-12-02 00:22:34', '2023-06-05 09:07:26', 1),
(2, 'JUICE', '2022-12-02 00:22:34', NULL, 1),
(3, 'WATER', '2022-12-02 00:22:34', NULL, 1),
(4, 'ALCOHOL', '2022-12-02 00:22:34', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  ADD PRIMARY KEY (`productClass_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  MODIFY `productClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
