-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 08:14 PM
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
-- Table structure for table `pendingorder_tbl`
--

CREATE TABLE `pendingorder_tbl` (
  `pendingOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `order_number` int(255) DEFAULT NULL,
  `customer_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendingorder_tbl`
--

INSERT INTO `pendingorder_tbl` (`pendingOrder_id`, `product_id`, `product_name`, `order_number`, `customer_id`, `quantity`, `amount`, `date_created`, `is_active`) VALUES
(1, 33, 'San Miguel Apple', 136254889, 1, 6, 720, '2023-04-06 15:22:31', 1),
(2, 26, 'Red Horse Big', 136254889, 1, 4, 550, '2023-04-06 15:22:32', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  ADD PRIMARY KEY (`pendingOrder_id`),
  ADD KEY `pending_customer_id` (`customer_id`),
  ADD KEY `pending_product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  MODIFY `pendingOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
