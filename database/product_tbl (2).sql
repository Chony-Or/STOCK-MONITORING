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
  `date_deleted` datetime DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `productClass_id`, `product_price`, `product_name`, `product_stock`, `product_details`, `product_code`, `product_picture`, `date_created`, `date_updated`, `date_deleted`, `is_active`) VALUES
(1, 1, 100.000, 'COKE', 200, 'Test Data Only', 'CK1000', 'coke.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(2, 1, 75.000, 'SPRITE', 200, 'Test Data Only', 'SPRT1000', 'sprite.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(3, 1, 115.000, 'RC Qute', 20, '237 ml per piece\n12 pieces per purchase', 'RC-QT', 'RCQUTE.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(4, 1, 271.000, '7up Medium', 12, '355 ml per piece\n24 pieces per purchase', '7upMdm', '7upMedium.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(5, 1, 271.000, '7up Big', 12, '750 ml per piece\n12 pieces per purchase', '7upBg', '7upMega.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(6, 1, 169.000, '7Up Small', 9, '237 ml per piece\n24 pieces per purchase', '7upSmll', '7upSmall.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', NULL, 1),
(7, 3, 218.000, 'Absolute 6L', 12, '6 liters per piece\n3 pieces per purchase', 'Abslt6L', 'Absolute6L.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(8, 1, 284.000, 'Cobra Green', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-GRN', 'CobraGreenSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(9, 1, 186.000, 'Cobra Pet Bottles', 200, '350 ml per piece\n12 pieces per purchase', 'CBRA-PT-BTTL', 'CobraPetBottle.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(10, 1, 284.000, 'Cobra Yellow', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-YLLW', 'CobraYellowSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(11, 1, 284.000, 'Cobra Red', 200, '240 ml per piece\n24 pieces per purchase', 'CBRA-RED', 'CobraRedSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(12, 1, 714.000, 'Coke 1.5', 95, '1.5 liters per piece\n12 pieces per purchase', 'COKE-1.5', 'Coke 1.5.png', '0000-00-00 00:00:00', '2023-02-09 10:04:25', NULL, 1),
(13, 1, 286.000, 'Coke Kasalo', 20, '750 ml per piece\n12 pieces per purchase', 'CK-KSL', 'CokeKasalo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(14, 1, 170.000, 'Coke Mismo', 50, '290 ml per piece\n12 pieces per purchase', 'CK-MSM', 'CokeMismo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(15, 1, 181.000, 'Coke Small', 50, '237 ml per piece\n24 pieces per purchase', 'CK-SML', 'CokeSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(16, 1, 124.000, 'Coke Swakto', 20, '195 ml per piece\n12 pieces per purchase', 'CK-SWKT', 'CokeSwakto.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(17, 1, 303.000, 'Gatorade Blue Small', 20, '240 ml per piece\n24 pieces per purchase', 'GTRD-BL-SML', 'GatoradeBlueSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(18, 1, 271.000, 'Mountain Dew Big', 20, '750 ml per piece\n12 pieces per purchase', 'MNTN-DW-BG', 'MountainDewBig.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(19, 1, 271.000, 'Mountain Dew Medium', 20, '355 ml per piece\n24 pieces per purchase', 'MNTN-DW-MDM', 'MountainDewMedium.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(20, 1, 161.000, 'Mountain Dew Neon', 20, '290 ml per piece\n12 pieces per purchase', 'MNTN-DW-NN', 'MountainDewMismo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(21, 1, 169.000, 'Mountain Dew Small', 20, '237 ml per piece\n24 pieces per purchase', 'MNTN-DW-SML', 'MountainDewSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(22, 4, 820.000, 'San Miguel Beer Pale Pilsen', 20, '320 ml per piece\n24 pieces per purchase', 'SMB-PL-PLSN', 'PalePilsen.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(23, 1, 271.000, 'Pepsi Big', 20, '750 ml per piece\n12 pieces per purchase', 'PPS-BG', 'PepsiBig.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(24, 1, 240.000, 'RC MEGA', 20, '800 ml per piece\n12 pieces per purchase', 'RCB', 'RcBig.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(25, 1, 156.000, 'RC Small', 20, '240 ml per piece\n24 pieces per purchase', 'RCS', 'RcSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(26, 4, 550.000, 'Red Horse Big', 13, '1 liter per piece\n6 pieces per purchase', 'RHB', 'RhBig.png', '0000-00-00 00:00:00', '2023-04-06 15:22:32', NULL, 1),
(27, 4, 540.000, 'Red Horse Small', 20, '500 ml per piece\n12 pieces per purchase', 'RHS', 'RhSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(28, 1, 115.000, 'Root Beer Qute', 20, '237 ml per piece\n12 pieces per purchase', 'RTBR-QT', 'RootbeerQute.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(29, 1, 156.000, 'Root Beer Small', 20, '240 ml per piece\n24 pieces per purchase', 'RTBR-SMLL', 'RootbeerSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(30, 1, 714.000, 'Royal 1.5', 20, '1.5 liters per piece\n12 pieces per purchase', 'RYL-1.5', 'Royal 1.5.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(31, 1, 286.000, 'Royal Kasalo', 19, '750 ml per piece\n12 pieces per purchase', 'RYL-KSL', 'RoyalKasalo.png', '0000-00-00 00:00:00', '2023-01-07 09:11:20', NULL, 1),
(32, 1, 181.000, 'Royal Small', 20, '237 ml per piece\n24 pieces per purchase', 'RYL-SMLL', 'RoyalSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(33, 4, 720.000, 'San Miguel Apple', 14, '330 ml per piece\n24 pieces per purchase', 'SMA', 'SanMigApple.png', '0000-00-00 00:00:00', '2023-04-06 15:22:31', NULL, 1),
(34, 4, 911.000, 'San Miguel Light', 16, '330 ml per piece\n24 pieces per purchase', 'SML', 'SanMigLight.png', '0000-00-00 00:00:00', '2023-04-03 11:59:36', NULL, 1),
(35, 1, 115.000, 'Seetrus Qute', 20, '237 ml per piece\n12 pieces per purchase', 'STRS-QT', 'SeetrusQute.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(36, 1, 156.000, 'Seetrus Small', 18, '240 ml per piece\n24 pieces per purchase', 'STRS-SMLL', 'SeetrusSmall.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', NULL, 1),
(37, 3, 200.000, 'Sip 1 Liter', 14, '1 liter per piece\n12 pieces per purchase', 'SP-1LTR', 'Sip 1L.png', '0000-00-00 00:00:00', '2023-04-03 11:54:29', NULL, 1),
(38, 3, 307.000, 'Sip 350 ml', 20, '350 ml per piece\n35 pieces per purchase', 'SP-350ML', 'Sip 350ml.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(39, 3, 200.000, 'Sip 500 ml', 20, '500 ml per piece\n24 pieces per purchase', 'SP-500ML', 'Sip 500ml.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(40, 1, 170.000, 'Royal Mismo', 20, '290 ml per piece\n12 pieces per purchase', 'RYL-MSM', 'RoyalMismo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(41, 1, 240.000, 'Soda Lemon Big', 20, '800 ml per piece\n12 pieces per purchase', 'SD-LMN-BG', 'SodaLemonBig.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(42, 1, 115.000, 'Soda Lemon Qute', 20, '237 ml per piece\n12 pieces per purchase', 'SD-LMN-QT', 'SodaLemonQute.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(43, 1, 156.000, 'Soda Lemon Small', 20, '240 ml per piece\n24 pieces per purchase', 'SD-LMN-SMLL', 'SodaLemonSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(44, 1, 240.000, 'Soda Orange Big', 20, '800 ml per piece\n12 pieces per purchase', 'SD-RNG-BG', 'SodaOrangeBig.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(45, 1, 115.000, 'Soda Orange Qute', 20, '237 ml per piece\n12 pieces per purchase', 'SD-RNG-QT', 'SodaOrangeQute.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(46, 1, 156.000, 'Soda Orange Small', 20, '240 ml per piece\n24 pieces per purchase', 'SD-RNG-SMLL', 'SodaSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(47, 1, 714.000, 'Sprite 1.5 Liters', 20, '1.5 liters per piece\n12 pieces per purchase', 'SPRT-1.5L', 'Sprite 1.5.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(48, 1, 170.000, 'Sprite Mismo', 20, '290 ml per piece\n12 pieces per purchase', 'SPRT-MSM', 'sprite mismo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(49, 1, 181.000, 'Sprite Small', 20, '237 ml per piece\n24 pieces per purchase', 'SPRT-SMLL', 'sprite small.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(50, 1, 286.000, 'Sprite Kasalo', 20, '750 ml per piece\n12 pieces per purchase', 'SPRT-KSL', 'SpriteKasalo.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(51, 1, 186.000, 'Sting Pet Bottle', 20, '290 ml per piece\n12 pieces per purchase', 'STNG-PT-BTTL', 'StingPetBottle.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(52, 3, 219.000, 'Summit 1 Liter', 20, '1 liter per piece\n12 pieces per purchase', 'SMMT-1L', 'Summit 1L.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(53, 3, 260.000, 'Summit 350 ML', 19, '350 ml per piece\n35 pieces per purchase', 'SMMT-350ML', 'summit 350ml.png', '0000-00-00 00:00:00', '2023-01-07 12:30:05', NULL, 1),
(54, 3, 255.000, 'Summit 500 ML', 20, '500 ml per piece\n24 pieces per purchase', 'SMMT-500ML', 'Summit 500ml.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(55, 2, 380.000, 'Vitamilk Milk', 20, '200 ml per piece\n24 pieces per purchase', 'VTMLK-MLK', 'Vitamilk.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(56, 2, 380.000, 'Vitamilk Choco', 20, '200 ml per piece\n24 pieces per purchase', 'VTMLK-CHC', 'VitamilkChoco.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(57, 2, 87.000, 'Zest - O Apple', 15, '250 ml per piece\n10 pieces per purchase', 'ZST-PPL', 'Zest-oApple.png', '0000-00-00 00:00:00', '2023-01-07 12:27:59', NULL, 1),
(58, 2, 185.000, 'Zest - O Choco', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-CHC', 'Zest-oChoco.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(59, 2, 93.000, 'Zest - O Guyabano', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-GYBN', 'Zest-oGuyabano.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(60, 2, 93.000, 'Zest - O Mango', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-MNG', 'Zest-oMango.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(61, 2, 87.000, 'Zest - O Orange', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-RNG', 'Zest-oOrange.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(62, 2, 87.000, 'Zest - O Pineapple', 20, '250 ml per piece\n10 pieces per purchase', 'ZST-PNPLL', 'Zest-oPineapple.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(63, 1, 291.000, 'Sting Small', 20, '240 ml per piece\n24 pieces per purchase', 'STNG-SMLL', 'StingSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(64, 4, 535.000, 'San Miguel Beer Grande', 20, '1 liter per piece\n6 pieces per purchase', 'SMB-GRND', 'PalePilsenGrande.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(65, 1, 169.000, 'Pepsi Blue', 20, '237 ml per piece\n24 pieces per purchase', 'PPS-BL', 'PepsiBlueSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(66, 1, 169.000, 'Pepsi Black', 20, '237 ml per piece\n24 pieces per purchase', 'PPS-BLCK', 'PepsiBlackSmall.png', '0000-00-00 00:00:00', NULL, NULL, 1),
(67, 1, 186.000, 'Extra Joss', 20, '237 ml per piece\n12 pieces per purchase', 'XTR-JSS', 'ExtraJoss.png', '0000-00-00 00:00:00', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `productClass_id` (`productClass_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD CONSTRAINT `productClass_id` FOREIGN KEY (`productClass_id`) REFERENCES `productclass_tbl` (`productClass_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
