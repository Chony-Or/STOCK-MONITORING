-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 09:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
(2, 'Angelica Rose', '$2y$10$rVKEy7xfcvtyubOEAp4qyurHtWUyMPsYRFDC6dGsHzYLysgjfT26u', '2022-11-26 03:23:16', NULL, NULL, NULL),
(3, 'Chas Sanqui', '$2y$10$RSwQMUhDY6YBns4sbW2XMOixP2sPhILlfzv/10T8GgOS72czdqOjy', '2022-12-02 09:32:45', NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holdorder_tbl`
--

INSERT INTO `holdorder_tbl` (`holdOrder_id`, `product_id`, `customer_id`, `product_name`, `quantity`, `amount`, `product_picture`) VALUES
(55, 58, 1, 'Zest - O Choco', 1, 185.000, 'Zest-oChoco.png'),
(56, 9, 1, 'Cobra Pet Bottles', 1, 186.000, 'CobraPetBottle.png');

-- --------------------------------------------------------

--
-- Table structure for table `on_processorder_tbl`
--

CREATE TABLE `on_processorder_tbl` (
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
  `date_created` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendingorder_tbl`
--

INSERT INTO `pendingorder_tbl` (`pendingOrder_id`, `product_id`, `product_name`, `order_number`, `customer_id`, `quantity`, `amount`, `date_created`, `date_deleted`, `is_active`) VALUES
(22, 58, NULL, 0, 812447158, 1, 1, NULL, NULL, 127),
(23, 9, NULL, 0, 812447158, 1, 1, NULL, NULL, 127),
(24, 58, NULL, 0, 623611214, 1, 1, NULL, NULL, 127),
(25, 9, NULL, 0, 623611214, 1, 1, NULL, NULL, 127),
(26, 58, NULL, 0, 109686820, 1, 1, NULL, NULL, 127),
(27, 9, NULL, 0, 109686820, 1, 1, NULL, NULL, 127),
(28, 58, NULL, 0, 884897810, 1, 1, NULL, NULL, 127),
(29, 9, NULL, 0, 884897810, 1, 1, NULL, NULL, 127),
(30, 58, NULL, 0, 735296826, 1, 1, NULL, NULL, 127),
(31, 9, NULL, 0, 735296826, 1, 1, NULL, NULL, 127);

-- --------------------------------------------------------

--
-- Table structure for table `productclass_tbl`
--

CREATE TABLE `productclass_tbl` (
  `productClass_id` int(255) NOT NULL,
  `product_class` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productclass_tbl`
--

INSERT INTO `productclass_tbl` (`productClass_id`, `product_class`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 'SOFTDRINK', '2022-12-02 00:22:34', NULL, NULL, 1),
(2, 'JUICE', '2022-12-02 00:22:34', NULL, NULL, 1),
(3, 'WATER', '2022-12-02 00:22:34', NULL, NULL, 1),
(4, 'ALCOHOL', '2022-12-02 00:22:34', NULL, NULL, 1);

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

INSERT INTO `product_tbl` (`product_id`, `productClass_id`, `product_price`, `product_name`, `product_stock`, `product_code`, `product_picture`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 1, 100.000, 'COKE', 200, 'CK1000', 'coke.png', NULL, NULL, NULL, 1),
(2, 1, 75.000, 'SPRITE', 200, 'SPRT1000', 'sprite.png', NULL, NULL, NULL, 1),
(3, 1, 115.000, 'RC Qute', 20, 'RC-QT', 'RCQUTE.png', NULL, NULL, NULL, 1),
(4, 1, 271.000, '7up Medium', 12, '7upMdm', '7upMedium.png', NULL, NULL, NULL, 1),
(5, 1, 271.000, '7up Big', 12, '7upBg', '7upMega.png', NULL, NULL, NULL, 1),
(6, 1, 169.000, '7Up Small', 12, '7upSmll', '7upSmall.png', NULL, NULL, NULL, 1),
(7, 3, 218.000, 'Absolute 6L', 12, 'Abslt6L', 'Absolute6L.png', NULL, NULL, NULL, 1),
(8, 1, 284.000, 'Cobra Green', 200, 'CBRA-GRN', 'CobraGreenSmall.png', NULL, NULL, NULL, 1),
(9, 1, 186.000, 'Cobra Pet Bottles', 200, 'CBRA-PT-BTTL', 'CobraPetBottle.png', NULL, NULL, NULL, 1),
(10, 1, 284.000, 'Cobra Yellow', 200, 'CBRA-YLLW', 'CobraYellowSmall.png', NULL, NULL, NULL, 1),
(11, 1, 284.000, 'Cobra Red', 200, 'CBRA-RED', 'CobraRedSmall.png', NULL, NULL, NULL, 1),
(12, 1, 714.000, 'Coke 1.5', 100, 'COKE-1.5', 'Coke 1.5.png', NULL, NULL, NULL, 1),
(13, 1, 286.000, 'Coke Kasalo', 0, 'CK-KSL', 'CokeKasalo.png', NULL, NULL, NULL, 1),
(14, 1, 170.000, 'Coke Mismo', 50, 'CK-MSM', 'CokeMismo.png', NULL, NULL, NULL, 1),
(15, 1, 181.000, 'Coke Small', 50, 'CK-SML', 'CokeSmall.png', NULL, NULL, NULL, 1),
(16, 1, 124.000, 'Coke Swakto', 20, 'CK-SWKT', 'CokeSwakto.png', NULL, NULL, NULL, 1),
(17, 1, 303.000, 'Gatorade Blue Small', 20, 'GTRD-BL-SML', 'GatoradeBlueSmall.png', NULL, NULL, NULL, 1),
(18, 1, 271.000, 'Mountain Dew Big', 20, 'MNTN-DW-BG', 'MountainDewBig.png', NULL, NULL, NULL, 1),
(19, 1, 271.000, 'Mountain Dew Medium', 20, 'MNTN-DW-MDM', 'MountainDewMedium.png', NULL, NULL, NULL, 1),
(20, 1, 161.000, 'Mountain Dew Neon', 20, 'MNTN-DW-NN', 'MountainDewMismo.png', NULL, NULL, NULL, 1),
(21, 1, 169.000, 'Mountain Dew Small', 20, 'MNTN-DW-SML', 'MountainDewSmall.png', NULL, NULL, NULL, 1),
(22, 4, 820.000, 'San Miguel Beer Pale Pilsen', 20, 'SMB-PL-PLSN', 'PalePilsen.png', NULL, NULL, NULL, 1),
(23, 1, 271.000, 'Pepsi Big', 20, 'PPS-BG', 'PepsiBig.png', NULL, NULL, NULL, 1),
(24, 1, 240.000, 'RC MEGA', 20, 'RCB', 'RcBig.png', NULL, NULL, NULL, 1),
(25, 1, 156.000, 'RC Small', 20, 'RCS', 'RcSmall.png', NULL, NULL, NULL, 1),
(26, 4, 550.000, 'Red Horse Big', 20, 'RHB', 'RhBig.png', NULL, NULL, NULL, 1),
(27, 4, 540.000, 'Red Horse Small', 20, 'RHS', 'RhSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(28, 1, 115.000, 'Root Beer Qute', 20, 'RTBR-QT', 'RootbeerQute.png', NULL, NULL, NULL, 1),
(29, 1, 156.000, 'Root Beer Small', 20, 'RTBR-SMLL', 'RootbeerSmall.png', NULL, NULL, NULL, 1),
(30, 1, 714.000, 'Royal 1.5', 20, 'RYL-1.5', 'Royal 1.5.png', NULL, NULL, NULL, 1),
(31, 1, 286.000, 'Royal Kasalo', 20, 'RYL-KSL', 'RoyalKasalo.png', NULL, NULL, NULL, 1),
(32, 1, 181.000, 'Royal Small', 20, 'RYL-SMLL', 'RoyalSmall.png', NULL, NULL, NULL, 1),
(33, 4, 720.000, 'San Miguel Apple', 20, 'SMA', 'SanMigApple.png', NULL, NULL, NULL, 1),
(34, 4, 911.000, 'San Miguel Light', 20, 'SML', 'SanMigLight.png', NULL, NULL, NULL, 1),
(35, 1, 115.000, 'Seetrus Qute', 20, 'STRS-QT', 'SeetrusQute.png', NULL, NULL, NULL, 1),
(36, 1, 156.000, 'Seetrus Small', 20, 'STRS-SMLL', 'SeetrusSmall.png', NULL, NULL, NULL, 1),
(37, 3, 200.000, 'Sip 1 Liter', 20, 'SP-1LTR', 'Sip 1L.png', NULL, NULL, NULL, 1),
(38, 3, 307.000, 'Sip 350 ml', 20, 'SP-350ML', 'Sip 350ml.png', NULL, NULL, NULL, 1),
(39, 3, 200.000, 'Sip 500 ml', 20, 'SP-500ML', 'Sip 500ml.png', NULL, NULL, NULL, 1),
(40, 1, 170.000, 'Royal Mismo', 20, 'RYL-MSM', 'RoyalMismo.png', NULL, NULL, NULL, 1),
(41, 1, 240.000, 'Soda Lemon Big', 20, 'SD-LMN-BG', 'SodaLemonBig.png', NULL, NULL, NULL, 1),
(42, 1, 115.000, 'Soda Lemon Qute', 20, 'SD-LMN-QT', 'SodaLemonQute.png', NULL, NULL, NULL, 1),
(43, 1, 156.000, 'Soda Lemon Small', 20, 'SD-LMN-SMLL', 'SodaLemonSmall.png', NULL, NULL, NULL, 1),
(44, 1, 240.000, 'Soda Orange Big', 20, 'SD-RNG-BG', 'SodaOrangeBig.png', NULL, NULL, NULL, 1),
(45, 1, 115.000, 'Soda Orange Qute', 20, 'SD-RNG-QT', 'SodaOrangeQute.png', NULL, NULL, NULL, 1),
(46, 1, 156.000, 'Soda Orange Small', 20, 'SD-RNG-SMLL', 'SodaSmall.png', NULL, NULL, NULL, 1),
(47, 1, 714.000, 'Sprite 1.5 Liters', 20, 'SPRT-1.5L', 'Sprite 1.5.png', NULL, NULL, NULL, 1),
(48, 1, 170.000, 'Sprite Mismo', 20, 'SPRT-MSM', 'sprite mismo.png', NULL, NULL, NULL, 1),
(49, 1, 181.000, 'Sprite Small', 20, 'SPRT-SMLL', 'sprite small.png', NULL, NULL, NULL, 1),
(50, 1, 286.000, 'Sprite Kasalo', 20, 'SPRT-KSL', 'SpriteKasalo.png', NULL, NULL, NULL, 1),
(51, 1, 186.000, 'Sting Pet Bottle', 20, 'STNG-PT-BTTL', 'StingPetBottle.png', NULL, NULL, NULL, 1),
(52, 3, 219.000, 'Summit 1 Liter', 20, 'SMMT-1L', 'Summit 1L.png', NULL, NULL, NULL, 1),
(53, 3, 260.000, 'Summit 350 ML', 20, 'SMMT-350ML', 'summit 350ml.png', NULL, NULL, NULL, 1),
(54, 3, 255.000, 'Summit 500 ML', 20, 'SMMT-500ML', 'Summit 500ml.png', NULL, NULL, NULL, 1),
(55, 2, 380.000, 'Vitamilk Milk', 20, 'VTMLK-MLK', 'Vitamilk.png', NULL, NULL, NULL, 1),
(56, 2, 380.000, 'Vitamilk Choco', 20, 'VTMLK-CHC', 'VitamilkChoco.png', NULL, NULL, NULL, 1),
(57, 2, 87.000, 'Zest - O Apple', 20, 'ZST-PPL', 'Zest-oApple.png', NULL, NULL, NULL, 1),
(58, 2, 185.000, 'Zest - O Choco', 20, 'ZST-CHC', 'Zest-oChoco.png', NULL, NULL, NULL, 1),
(59, 2, 93.000, 'Zest - O Guyabano', 20, 'ZST-GYBN', 'Zest-oGuyabano.png', NULL, NULL, NULL, 1),
(60, 2, 93.000, 'Zest - O Mango', 20, 'ZST-MNG', 'Zest-oMango.png', NULL, NULL, NULL, 1),
(61, 2, 87.000, 'Zest - O Orange', 20, 'ZST-RNG', 'Zest-oOrange.png', NULL, NULL, NULL, 1),
(62, 2, 87.000, 'Zest - O Pineapple', 20, 'ZST-PNPLL', 'Zest-oPineapple.png', NULL, NULL, NULL, 1),
(63, 1, 291.000, 'Sting Small', 20, 'STNG-SMLL', 'StingSmall.png', NULL, NULL, NULL, 1),
(64, 4, 535.000, 'San Miguel Beer Grande', 20, 'SMB-GRND', 'PalePilsenGrande.png', NULL, NULL, NULL, 1),
(65, 1, 169.000, 'Pepsi Blue', 20, 'PPS-BL', 'PepsiBlueSmall.png', NULL, NULL, NULL, 1),
(66, 1, 169.000, 'Pepsi Black', 20, 'PPS-BLCK', 'PepsiBlackSmall.png', NULL, NULL, NULL, 1),
(67, 1, 186.000, 'Extra Joss', 20, 'XTR-JSS', 'ExtraJoss.png', NULL, NULL, NULL, 1);

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
-- Indexes for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD PRIMARY KEY (`activeOrder_id`),
  ADD KEY `active_pendingOrder_id` (`order_id`),
  ADD KEY `active_customer_id` (`customer_id`),
  ADD KEY `active_product_id` (`product_id`);

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
  ADD KEY `transac_activeOrder_id` (`activeOrder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customerclass_tbl`
--
ALTER TABLE `customerclass_tbl`
  MODIFY `customerClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  MODIFY `holdOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  MODIFY `activeOrder_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  MODIFY `pendingOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  MODIFY `productClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

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
  ADD CONSTRAINT `transac_activeOrder_id` FOREIGN KEY (`activeOrder_id`) REFERENCES `on_processorder_tbl` (`activeOrder_id`),
  ADD CONSTRAINT `transac_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
