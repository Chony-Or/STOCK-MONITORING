-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 10:04 PM
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

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `customer_firstname`, `customer_lastname`, `customer_contactNo`, `customer_houseno`, `customer_street`, `customer_city`, `customer_username`, `customer_password`, `customerClass_id`, `date_created`, `date_updated`, `is_active`) VALUES
(1, 'Rose', 'Gumanid', '09062481779', 'Blk 110 lot 17', 'M.H Delpilar St. Rizal', 'Taguig City', 'rose', 'rose', 1, '2022-11-18 00:00:00', NULL, 1),
(22, 'Chony', 'Or', '09062481779', 'blk 110 lot 17', 'M.H Delpilar st. Brgy Rizal', 'TAGUIG CITY', 'chony', 'chony', 1, '2023-04-20 10:32:13', NULL, NULL),
(23, 'Chastine', 'Sanqui', '09062481779', 'blk 110 lot 17', 'm.h delpilar st', 'TAGUIG CITY', 'chassy', 'chassy', 1, '2023-04-20 11:11:36', NULL, NULL);

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

--
-- Dumping data for table `holdorder_tbl`
--

INSERT INTO `holdorder_tbl` (`holdOrder_id`, `product_id`, `customer_id`, `product_name`, `quantity`, `amount`, `product_picture`) VALUES
(79, 26, 23, 'Red Horse Big', 4, 550.000, 'RhBig.png'),
(81, 58, 22, 'Zest - O Choco', 1, 185.000, 'Zest-oChoco.png'),
(83, 7, 23, 'Absolute 6L', 3, 218.000, 'Absolute6L.png'),
(85, 21, 0, 'Mountain Dew Small', 2, 169.000, 'MountainDewSmall.png');

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
(4, 26, 'Red Horse Big', 605747866, 23, 4, 550, '2023-04-20 11:18:17', 1),
(5, 7, 'Absolute 6L', 605747866, 23, 3, 218, '2023-04-20 11:18:17', 1);

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
(1, 'SOFTDRINK', '2022-12-02 00:22:34', NULL, 1),
(2, 'JUICE', '2022-12-02 00:22:34', NULL, 1),
(3, 'WATER', '2022-12-02 00:22:34', NULL, 1),
(4, 'ALCOHOL', '2022-12-02 00:22:34', NULL, 1);

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

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `productClass_id`, `product_price`, `product_name`, `product_stock`, `product_details`, `product_code`, `product_picture`, `date_created`, `date_updated`, `is_active`) VALUES
(1, 1, 100.000, 'COKE', 200, 'Test Data Only', 'CK1000', 'coke.png', '0000-00-00 00:00:00', NULL, 1),
(2, 1, 75.000, 'SPRITE', 200, 'Test Data Only', 'SPRT1000', 'sprite.png', '0000-00-00 00:00:00', NULL, 1),
(3, 1, 115.000, 'RC Qute', 20, '237 ml per piece\n12 pieces per purchase', 'RC-QT', 'RCQUTE.png', '0000-00-00 00:00:00', NULL, 1),
(4, 1, 271.000, '7up Medium', 12, '355 ml per piece\n24 pieces per purchase', '7upMdm', '7upMedium.png', '0000-00-00 00:00:00', NULL, 1),
(5, 1, 271.000, '7up Big', 12, '750 ml per piece\n12 pieces per purchase', '7upBg', '7upMega.png', '0000-00-00 00:00:00', NULL, 1),
(6, 1, 169.000, '7Up Small', 9, '237 ml per piece\n24 pieces per purchase', '7upSmll', '7upSmall.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', 1),
(7, 3, 218.000, 'Absolute 6L', 12, '6 liters per piece\n3 pieces per purchase', 'Abslt6L', 'Absolute6L.png', '0000-00-00 00:00:00', NULL, 1),
(8, 1, 284.000, 'Cobra Green', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-GRN', 'CobraGreenSmall.png', '0000-00-00 00:00:00', NULL, 1),
(9, 1, 186.000, 'Cobra Pet Bottles', 200, '350 ml per piece\n12 pieces per purchase', 'CBRA-PT-BTTL', 'CobraPetBottle.png', '0000-00-00 00:00:00', NULL, 1),
(10, 1, 284.000, 'Cobra Yellow', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-YLLW', 'CobraYellowSmall.png', '0000-00-00 00:00:00', NULL, 1),
(11, 1, 284.000, 'Cobra Red', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-RED', 'CobraRedSmall.png', '0000-00-00 00:00:00', NULL, 1),
(12, 1, 714.000, 'Coke 1.5', 95, '1.5 liters per piece\n12 pieces per purchase', 'COKE-1.5', 'Coke 1.5.png', '0000-00-00 00:00:00', '2023-02-09 10:04:25', 1),
(13, 1, 286.000, 'Coke Kasalo', 20, '750 ml per piece\n12 pieces per purchase', 'CK-KSL', 'CokeKasalo.png', '0000-00-00 00:00:00', NULL, 1),
(14, 1, 170.000, 'Coke Mismo', 50, '290 ml per piece\n12 pieces per purchase', 'CK-MSM', 'CokeMismo.png', '0000-00-00 00:00:00', NULL, 1),
(15, 1, 181.000, 'Coke Small', 50, '237 ml per piece\n24 pieces per purchase', 'CK-SML', 'CokeSmall.png', '0000-00-00 00:00:00', NULL, 1),
(16, 1, 124.000, 'Coke Swakto', 20, '195 ml per piece\n12 pieces per purchase', 'CK-SWKT', 'CokeSwakto.png', '0000-00-00 00:00:00', NULL, 1),
(17, 1, 303.000, 'Gatorade Blue Small', 20, '240 ml per piece\n24 pieces per purchase', 'GTRD-BL-SML', 'GatoradeBlueSmall.png', '0000-00-00 00:00:00', NULL, 1),
(18, 1, 271.000, 'Mountain Dew Big', 20, '750 ml per piece\n12 pieces per purchase', 'MNTN-DW-BG', 'MountainDewBig.png', '0000-00-00 00:00:00', NULL, 1),
(19, 1, 271.000, 'Mountain Dew Medium', 20, '355 ml per piece\n24 pieces per purchase', 'MNTN-DW-MDM', 'MountainDewMedium.png', '0000-00-00 00:00:00', NULL, 1),
(20, 1, 161.000, 'Mountain Dew Neon', 20, '290 ml per piece\n12 pieces per purchase', 'MNTN-DW-NN', 'MountainDewMismo.png', '0000-00-00 00:00:00', NULL, 1),
(21, 1, 169.000, 'Mountain Dew Small', 20, '237 ml per piece\n24 pieces per purchase', 'MNTN-DW-SML', 'MountainDewSmall.png', '0000-00-00 00:00:00', NULL, 1),
(22, 4, 820.000, 'San Miguel Beer Pale Pilsen', 20, '320 ml per piece\n24 pieces per purchase', 'SMB-PL-PLSN', 'PalePilsen.png', '0000-00-00 00:00:00', NULL, 1),
(23, 1, 271.000, 'Pepsi Big', 20, '750 ml per piece\n12 pieces per purchase', 'PPS-BG', 'PepsiBig.png', '0000-00-00 00:00:00', NULL, 1),
(24, 1, 240.000, 'RC MEGA', 20, '800 ml per piece\n12 pieces per purchase', 'RCB', 'RcBig.png', '0000-00-00 00:00:00', NULL, 1),
(25, 1, 156.000, 'RC Small', 20, '240 ml per piece\n24 pieces per purchase', 'RCS', 'RcSmall.png', '0000-00-00 00:00:00', NULL, 1),
(26, 4, 550.000, 'Red Horse Big', 13, '1 liter per piece\n6 pieces per purchase', 'RHB', 'RhBig.png', '0000-00-00 00:00:00', '2023-04-06 15:22:32', 1),
(27, 4, 540.000, 'Red Horse Small', 20, '500 ml per piece\n12 pieces per purchase', 'RHS', 'RhSmall.png', '0000-00-00 00:00:00', NULL, 1),
(28, 1, 115.000, 'Root Beer Qute', 20, '237 ml per piece\n12 pieces per purchase', 'RTBR-QT', 'RootbeerQute.png', '0000-00-00 00:00:00', NULL, 1),
(29, 1, 156.000, 'Root Beer Small', 20, '240 ml per piece\n24 pieces per purchase', 'RTBR-SMLL', 'RootbeerSmall.png', '0000-00-00 00:00:00', NULL, 1),
(30, 1, 714.000, 'Royal 1.5', 20, '1.5 liters per piece\n12 pieces per purchase', 'RYL-1.5', 'Royal 1.5.png', '0000-00-00 00:00:00', NULL, 1),
(31, 1, 286.000, 'Royal Kasalo', 19, '750 ml per piece\n12 pieces per purchase', 'RYL-KSL', 'RoyalKasalo.png', '0000-00-00 00:00:00', '2023-01-07 09:11:20', 1),
(32, 1, 181.000, 'Royal Small', 20, '237 ml per piece\n24 pieces per purchase', 'RYL-SMLL', 'RoyalSmall.png', '0000-00-00 00:00:00', NULL, 1),
(33, 4, 720.000, 'San Miguel Apple', 14, '330 ml per piece\n24 pieces per purchase', 'SMA', 'SanMigApple.png', '0000-00-00 00:00:00', '2023-04-06 15:22:31', 1),
(34, 4, 911.000, 'San Miguel Light', 16, '330 ml per piece\n24 pieces per purchase', 'SML', 'SanMigLight.png', '0000-00-00 00:00:00', '2023-04-03 11:59:36', 1),
(35, 1, 115.000, 'Seetrus Qute', 20, '237 ml per piece\n12 pieces per purchase', 'STRS-QT', 'SeetrusQute.png', '0000-00-00 00:00:00', NULL, 1),
(36, 1, 156.000, 'Seetrus Small', 18, '240 ml per piece\n24 pieces per purchase', 'STRS-SMLL', 'SeetrusSmall.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', 1),
(37, 3, 200.000, 'Sip 1 Liter', 14, '1 liter per piece\n12 pieces per purchase', 'SP-1LTR', 'Sip 1L.png', '0000-00-00 00:00:00', '2023-04-03 11:54:29', 1),
(38, 3, 307.000, 'Sip 350 ml', 20, '350 ml per piece\n35 pieces per purchase', 'SP-350ML', 'Sip 350ml.png', '0000-00-00 00:00:00', NULL, 1),
(39, 3, 200.000, 'Sip 500 ml', 20, '500 ml per piece\n24 pieces per purchase', 'SP-500ML', 'Sip 500ml.png', '0000-00-00 00:00:00', NULL, 1),
(40, 1, 170.000, 'Royal Mismo', 20, '290 ml per piece\n12 pieces per purchase', 'RYL-MSM', 'RoyalMismo.png', '0000-00-00 00:00:00', NULL, 1),
(41, 1, 240.000, 'Soda Lemon Big', 20, '800 ml per piece\n12 pieces per purchase', 'SD-LMN-BG', 'SodaLemonBig.png', '0000-00-00 00:00:00', NULL, 1),
(42, 1, 115.000, 'Soda Lemon Qute', 20, '237 ml per piece\n12 pieces per purchase', 'SD-LMN-QT', 'SodaLemonQute.png', '0000-00-00 00:00:00', NULL, 1),
(43, 1, 156.000, 'Soda Lemon Small', 20, '240 ml per piece\n24 pieces per purchase', 'SD-LMN-SMLL', 'SodaLemonSmall.png', '0000-00-00 00:00:00', NULL, 1),
(44, 1, 240.000, 'Soda Orange Big', 20, '800 ml per piece\n12 pieces per purchase', 'SD-RNG-BG', 'SodaOrangeBig.png', '0000-00-00 00:00:00', NULL, 1),
(45, 1, 115.000, 'Soda Orange Qute', 20, '237 ml per piece\n12 pieces per purchase', 'SD-RNG-QT', 'SodaOrangeQute.png', '0000-00-00 00:00:00', NULL, 1),
(46, 1, 156.000, 'Soda Orange Small', 20, '240 ml per piece\n24 pieces per purchase', 'SD-RNG-SMLL', 'SodaSmall.png', '0000-00-00 00:00:00', NULL, 1),
(47, 1, 714.000, 'Sprite 1.5 Liters', 20, '1.5 liters per piece\n12 pieces per purchase', 'SPRT-1.5L', 'Sprite 1.5.png', '0000-00-00 00:00:00', NULL, 1),
(48, 1, 170.000, 'Sprite Mismo', 20, '290 ml per piece\n12 pieces per purchase', 'SPRT-MSM', 'sprite mismo.png', '0000-00-00 00:00:00', NULL, 1),
(49, 1, 181.000, 'Sprite Small', 20, '237 ml per piece\n24 pieces per purchase', 'SPRT-SMLL', 'sprite small.png', '0000-00-00 00:00:00', NULL, 1),
(50, 1, 286.000, 'Sprite Kasalo', 20, '750 ml per piece\n12 pieces per purchase', 'SPRT-KSL', 'SpriteKasalo.png', '0000-00-00 00:00:00', NULL, 1),
(51, 1, 186.000, 'Sting Pet Bottle', 20, '290 ml per piece\n12 pieces per purchase', 'STNG-PT-BTTL', 'StingPetBottle.png', '0000-00-00 00:00:00', NULL, 1),
(52, 3, 219.000, 'Summit 1 Liter', 20, '1 liter per piece\n12 pieces per purchase', 'SMMT-1L', 'Summit 1L.png', '0000-00-00 00:00:00', NULL, 1),
(53, 3, 260.000, 'Summit 350 ML', 19, '350 ml per piece\n35 pieces per purchase', 'SMMT-350ML', 'summit 350ml.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', 1),
(54, 3, 255.000, 'Summit 500 ML', 20, '500 ml per piece\n24 pieces per purchase', 'SMMT-500ML', 'Summit 500ml.png', '0000-00-00 00:00:00', NULL, 1),
(55, 2, 380.000, 'Vitamilk Milk', 20, '200 ml per piece\n24 pieces per purchase', 'VTMLK-MLK', 'Vitamilk.png', '0000-00-00 00:00:00', NULL, 1),
(56, 2, 380.000, 'Vitamilk Choco', 20, '200 ml per piece\n24 pieces per purchase', 'VTMLK-CHC', 'VitamilkChoco.png', '0000-00-00 00:00:00', NULL, 1),
(57, 2, 87.000, 'Zest - O Apple', 15, '250 ml per piece\n10 pieces per purchase', 'ZST-PPL', 'Zest-oApple.png', '0000-00-00 00:00:00', '2023-01-07 12:27:59', 1),
(58, 2, 185.000, 'Zest - O Choco', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-CHC', 'Zest-oChoco.png', '0000-00-00 00:00:00', NULL, 1),
(59, 2, 93.000, 'Zest - O Guyabano', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-GYBN', 'Zest-oGuyabano.png', '0000-00-00 00:00:00', NULL, 1),
(60, 2, 93.000, 'Zest - O Mango', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-MNG', 'Zest-oMango.png', '0000-00-00 00:00:00', NULL, 1),
(61, 2, 87.000, 'Zest - O Orange', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-RNG', 'Zest-oOrange.png', '0000-00-00 00:00:00', NULL, 1),
(62, 2, 87.000, 'Zest - O Pineapple', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-PNPLL', 'Zest-oPineapple.png', '0000-00-00 00:00:00', NULL, 1),
(63, 1, 291.000, 'Sting Small', 20, '240 ml per piece\n24 pieces per purchase', 'STNG-SMLL', 'StingSmall.png', '0000-00-00 00:00:00', NULL, 1),
(64, 4, 535.000, 'San Miguel Beer Grande', 20, '1 liter per piece\n6 pieces per purchase', 'SMB-GRND', 'PalePilsenGrande.png', '0000-00-00 00:00:00', NULL, 1),
(65, 1, 169.000, 'Pepsi Blue', 20, '237 ml per piece\n24 pieces per purchase', 'PPS-BL', 'PepsiBlueSmall.png', '0000-00-00 00:00:00', NULL, 1),
(66, 1, 169.000, 'Pepsi Black', 20, '237 ml per piece\n24 pieces per purchase', 'PPS-BLCK', 'PepsiBlackSmall.png', '0000-00-00 00:00:00', NULL, 1),
(67, 1, 186.000, 'Extra Joss', 20, '237 ml per piece\n12 pieces per purchase', 'XTR-JSS', 'ExtraJoss.png', '0000-00-00 00:00:00', NULL, 1);

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
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `notification_product_id` (`product_id`),
  ADD KEY `notification_pendingOrder_id` (`pendingOrder_id`);

--
-- Indexes for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  ADD PRIMARY KEY (`activeOrder_id`),
  ADD KEY `active_product_id` (`product_id`),
  ADD KEY `active_customer_id` (`customer_id`),
  ADD KEY `active_pendingOrder_id` (`pendingorder_id`);

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
  MODIFY `customer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  MODIFY `holdOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `notif_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `on_processorder_tbl`
--
ALTER TABLE `on_processorder_tbl`
  MODIFY `activeOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pendingorder_tbl`
--
ALTER TABLE `pendingorder_tbl`
  MODIFY `pendingOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `productclass_tbl`
--
ALTER TABLE `productclass_tbl`
  MODIFY `productClass_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

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
