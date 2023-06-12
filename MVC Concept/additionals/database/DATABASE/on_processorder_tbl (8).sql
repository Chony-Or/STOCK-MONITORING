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
-- Table structure for table `on_processorder_tbl`
--

CREATE TABLE `on_processorder_tbl` (
  `activeOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `pendingorder_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double(255,3) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'In Process',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `on_processorder_tbl`
--

INSERT INTO `on_processorder_tbl` (`activeOrder_id`, `product_id`, `customer_id`, `pendingorder_id`, `quantity`, `amount`, `status`, `date_created`, `is_active`) VALUES
(1, 33, 1, 1, 6, 720.000, 'In Process', '2023-06-05 02:19:08', NULL),
(2, 26, 1, 2, 4, 550.000, 'In Process', '2023-06-05 02:19:08', NULL),
(3, 12, 22, 3, 1, 714.000, 'In Process', '2023-06-05 02:21:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD PRIMARY KEY (`activeOrder_id`),
  ADD KEY `active_product_id` (`product_id`),
  ADD KEY `active_customer_id` (`customer_id`),
  ADD KEY `active_pendingOrder_id` (`pendingorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  MODIFY `activeOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
