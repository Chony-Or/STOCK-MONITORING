-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 03:25 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

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
-- Table structure for table `activeorder_tbl`
--

CREATE TABLE `activeorder_tbl` (
  `activeOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double(255,3) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_username`, `admin_password`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 'Chony Or', '$2y$10$M98CNFIaYh7UPqjWCk44M.LioPLDNzKB3vnmzQDsa/lXRzDAvKeJ6', '2022-11-26 03:22:43', NULL, NULL, NULL),
(2, 'Angelica Rose', '$2y$10$rVKEy7xfcvtyubOEAp4qyurHtWUyMPsYRFDC6dGsHzYLysgjfT26u', '2022-11-26 03:23:16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customerclass_tbl`
--

CREATE TABLE `customerclass_tbl` (
  `customerClass_id` int(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `customer_discount` int(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerclass_tbl`
--

INSERT INTO `customerclass_tbl` (`customerClass_id`, `customer_type`, `customer_discount`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 'REGULAR', 10, '2022-11-18 00:00:00', '2022-11-18 00:00:00', NULL, 1),
(2, 'GUEST', 0, '2022-11-18 00:00:00', '2022-11-18 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_id` int(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_password` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_contactNo` varchar(255) NOT NULL,
  `customerClass_id` int(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `customer_name`, `customer_password`, `customer_address`, `customer_contactNo`, `customerClass_id`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 'rose', 'rose', 'Blk 110 lot 17 M.H Delpilar St. Rizal Makati City', '09062481779', 1, '2022-11-18 00:00:00', '2022-11-18 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pendingorder_tbl`
--

CREATE TABLE `pendingorder_tbl` (
  `pendingOrder_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(255) NOT NULL,
  `product_price` double(255,3) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_stock` int(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_price`, `product_name`, `product_stock`, `product_code`, `product_picture`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 100.000, 'COKE', 200, 'CK1000', 'coke.png', NULL, NULL, NULL, 1),
(2, 75.000, 'SPRITE', 200, 'SPRT1000', 'sprite.png', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transachistory_tbl`
--

CREATE TABLE `transachistory_tbl` (
  `transac_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `activeOrder_id` int(255) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activeorder_tbl`
--
ALTER TABLE `activeorder_tbl`
  ADD PRIMARY KEY (`activeOrder_id`),
  ADD KEY `active_pendingOrder_id` (`order_id`),
  ADD KEY `active_customer_id` (`customer_id`),
  ADD KEY `active_product_id` (`product_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customerclass_tbl`
--
ALTER TABLE `customerclass_tbl`
  ADD PRIMARY KEY (`customerClass_id`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customerclass_id` (`customerClass_id`);

--
-- Indexes for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  ADD PRIMARY KEY (`pendingOrder_id`),
  ADD KEY `pending_customer_id` (`customer_id`),
  ADD KEY `pending_product_id` (`product_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  ADD PRIMARY KEY (`transac_id`),
  ADD KEY `transac_customer_id` (`customer_id`),
  ADD KEY `transac_activeOrder_id` (`activeOrder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activeorder_tbl`
--
ALTER TABLE `activeorder_tbl`
  ADD CONSTRAINT `active_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`),
  ADD CONSTRAINT `active_product_id` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`);

--
-- Constraints for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD CONSTRAINT `customerclass_id` FOREIGN KEY (`customerClass_id`) REFERENCES `customerclass_tbl` (`customerClass_id`);

--
-- Constraints for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  ADD CONSTRAINT `pending_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`),
  ADD CONSTRAINT `pending_product_id` FOREIGN KEY (`product_id`) REFERENCES `product_tbl` (`product_id`);

--
-- Constraints for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  ADD CONSTRAINT `transac_activeOrder_id` FOREIGN KEY (`activeOrder_id`) REFERENCES `activeorder_tbl` (`activeOrder_id`),
  ADD CONSTRAINT `transac_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
