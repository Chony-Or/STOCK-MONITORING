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
-- Table structure for table `transachistory_tbl`
--

CREATE TABLE `transachistory_tbl` (
  `transac_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `activeOrder_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double(255,3) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  ADD PRIMARY KEY (`transac_id`),
  ADD KEY `transac_customer_id` (`customer_id`),
  ADD KEY `transac_product_id` (`product_id`),
  ADD KEY `transac_activeOrder_id` (`activeOrder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  MODIFY `transac_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  ADD CONSTRAINT `transac_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
