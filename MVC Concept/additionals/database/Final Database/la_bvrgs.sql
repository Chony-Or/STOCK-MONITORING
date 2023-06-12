-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 08:22 PM
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
-- Database: `final`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_type` enum('super','admin') NOT NULL DEFAULT 'admin',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_username`, `admin_password`, `admin_type`, `date_created`, `date_updated`, `is_active`) VALUES
(1, 'Laconsay Warehouse', '$2y$10$ViG9bq3oJ0FIpb69G6ieyO9Ki277nC1yIl1QeMIjw7hI9gB0d1F6e', 'super', '2023-05-29 00:59:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customerclass_tbl`
--

CREATE TABLE `customerclass_tbl` (
  `customerClass_id` int(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `customer_discount` int(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerclass_tbl`
--

INSERT INTO `customerclass_tbl` (`customerClass_id`, `customer_type`, `customer_discount`, `date_created`, `is_active`) VALUES
(1, 'REGULAR', 10, '2022-11-18 00:00:00', 1),
(2, 'GUEST', 0, '2022-11-18 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_id` int(255) NOT NULL,
  `customer_firstname` varchar(255) NOT NULL,
  `customer_lastname` varchar(255) NOT NULL,
  `customer_contactNo` varchar(255) NOT NULL,
  `customer_houseno` varchar(255) NOT NULL,
  `customer_street` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customerClass_id` int(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holdorder_tbl`
--

CREATE TABLE `holdorder_tbl` (
  `holdOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double(255,3) NOT NULL,
  `product_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `notif_id` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `notif_subject` varchar(255) DEFAULT NULL,
  `notif_context` varchar(255) DEFAULT NULL,
  `notif_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `on_processorder_tbl`
--

CREATE TABLE `on_processorder_tbl` (
  `activeOrder_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `customer_id` int(255) NOT NULL,
  `pendingOrder_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `amount` double(255,3) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'In Process',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(255) NOT NULL,
  `productClass_id` int(255) DEFAULT NULL,
  `product_price` double(255,3) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_stock` int(255) NOT NULL,
  `product_details` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_picture` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  ADD PRIMARY KEY (`holdOrder_id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD PRIMARY KEY (`activeOrder_id`),
  ADD KEY `active_product_id` (`product_id`),
  ADD KEY `active_customer_id` (`customer_id`),
  ADD KEY `active_pendingOrder_id` (`pendingOrder_id`);

--
-- Indexes for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  ADD PRIMARY KEY (`pendingOrder_id`),
  ADD KEY `pending_customer_id` (`customer_id`),
  ADD KEY `pending_product_id` (`product_id`);

--
-- Indexes for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  ADD PRIMARY KEY (`productClass_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `productClass_id` (`productClass_id`);

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
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerclass_tbl`
--
ALTER TABLE `customerclass_tbl`
  MODIFY `customerClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  MODIFY `holdOrder_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `notif_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  MODIFY `activeOrder_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  MODIFY `pendingOrder_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  MODIFY `productClass_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  MODIFY `transac_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD CONSTRAINT `customerclass_id` FOREIGN KEY (`customerClass_id`) REFERENCES `customerclass_tbl` (`customerClass_id`);

--
-- Constraints for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);

--
-- Constraints for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD CONSTRAINT `productClass_id` FOREIGN KEY (`productClass_id`) REFERENCES `productclass_tbl` (`productClass_id`);

--
-- Constraints for table `transachistory_tbl`
--
ALTER TABLE `transachistory_tbl`
  ADD CONSTRAINT `transac_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
