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
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `notif_id` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `pendingOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `notif_subject` varchar(255) DEFAULT NULL,
  `notif_context` varchar(255) DEFAULT NULL,
  `notif_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`notif_id`, `customer_id`, `pendingOrder_id`, `product_id`, `notif_subject`, `notif_context`, `notif_date`) VALUES
(1, 1, 1, 33, 'San Miguel Apple - 136254889', 'In Process', '2023-06-05 02:19:08'),
(2, 1, 2, 26, 'Red Horse Big - 136254889', 'In Process', '2023-06-05 02:19:08'),
(3, 22, 3, 12, 'Coke 1.5 - 661778620', 'In Process', '2023-06-05 02:21:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `notification_product_id` (`product_id`),
  ADD KEY `notification_pendingOrder_id` (`pendingOrder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `notif_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
