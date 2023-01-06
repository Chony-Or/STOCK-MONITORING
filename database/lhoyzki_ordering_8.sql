-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 04:52 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lhoyzki_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `addons_tbl`
--

CREATE TABLE `addons_tbl` (
  `Addons_ID` int(11) NOT NULL,
  `Addons_Price` double(6,2) NOT NULL,
  `Addons_Name` varchar(100) NOT NULL,
  `Addons_Stocks` int(11) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL,
  `Is_Active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addons_tbl`
--

INSERT INTO `addons_tbl` (`Addons_ID`, `Addons_Price`, `Addons_Name`, `Addons_Stocks`, `Date_Created`, `Date_Updated`, `Date_Deleted`, `Is_Active`) VALUES
(1, 15.00, 'Choco chips', 200, '2021-05-05 22:58:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 15.00, 'Black Pearl', 200, '2021-05-11 23:53:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 15.00, 'Oreo', 200, '2021-05-12 01:29:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 15.00, 'Mallows', 200, '2021-05-12 21:21:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 15.00, 'Nata', 200, '2021-05-12 22:22:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 15.00, 'Cream Cheese', 200, '2021-05-12 22:23:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 15.00, 'Pudding', 200, '2021-05-12 22:23:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 15.00, 'Red Beans', 200, '2021-05-12 22:23:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `Customer_ID` int(11) NOT NULL,
  `L_Name` varchar(50) NOT NULL,
  `F_Name` varchar(50) NOT NULL,
  `Cust_Num` int(20) NOT NULL,
  `Cust_Address` varchar(100) DEFAULT NULL,
  `Is_Checkout` tinyint(4) NOT NULL DEFAULT 0,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL,
  `Is_Active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

CREATE TABLE `feedback_tbl` (
  `comments` varchar(255) NOT NULL,
  `feedback_ID` int(11) NOT NULL,
  `customerID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`comments`, `feedback_ID`, `customerID`) VALUES
('', 1, '60b32ad1e7aa4'),
('', 2, '60b32ad72bab3'),
('', 3, '60b32d0364e06'),
('', 4, '60b32d07036fe'),
('', 5, '60b32d421bf02'),
('', 6, '60b32d487e29b'),
('', 7, '60b333f005d78'),
('', 8, '60b33582b7e20'),
('', 9, '60b33586e3bee'),
('', 10, '60b3358b1607a'),
('', 11, '60b336af21d6b'),
('', 12, '60b33921cabdc'),
('', 13, '60b34549e5bc0'),
('', 14, '60b34564d5601'),
('', 15, '60b345b39daa2'),
('', 16, '60b3481ed6f96'),
('', 17, '60b34bdae160c'),
('', 18, '60b3df2d0ace9'),
('', 19, '60b6458ae3752'),
('', 20, '60b645a6305d4');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `Order_ID` int(11) NOT NULL,
  `Product_IDP` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Size_ID` int(11) NOT NULL,
  `Sugar_Level` varchar(50) NOT NULL,
  `Addons` varchar(100) DEFAULT NULL,
  `Quantity` int(4) NOT NULL,
  `Amount` double(6,2) NOT NULL,
  `Discount` double(6,2) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL,
  `Is_Active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `Product_IDP` int(11) NOT NULL,
  `Product_Stocks` int(11) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Product_Code` varchar(50) NOT NULL,
  `Product_Category` varchar(200) NOT NULL,
  `Product_Details` varchar(255) NOT NULL,
  `Product_Picture` varchar(255) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL,
  `Is_Active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`Product_IDP`, `Product_Stocks`, `Product_Name`, `Product_Code`, `Product_Category`, `Product_Details`, `Product_Picture`, `Date_Created`, `Date_Updated`, `Date_Deleted`, `Is_Active`) VALUES
(1, 200, 'Classic Taro', 'MT1', 'MilkTea', 'Want some healthy Milktea? Then try this purple Taro goodness baby.', '../FINAL/src/ClassicTaroMT.png', '2021-04-30 01:05:25', '0000-00-00 00:00:00', '2021-05-18 16:55:48', 1),
(2, 200, 'Classic Okinawa', 'MT2', 'MilkTea', 'Indulge your tastebuds with yet another Japanese flavor: the Okinawa Milktea that has roasted brown sugar goodness.', '../FINAL/src/ClassicOkinawaMT.png', '2021-04-30 01:33:30', '0000-00-00 00:00:00', '2021-05-18 22:19:42', 1),
(3, 200, 'Hokkaido', 'MT3', 'MilkTea', 'Feel the province of Japan with this one. Try out the Hokkaido Milktea and taste the blend of fresh tea leaves.', '../FINAL/src/HokkaidoMT.png', '2021-04-30 01:34:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 200, 'Chocolate', 'MT4', 'MilkTea', 'A must-try for those who crave cold and sweet beverage, especially those with sweet tooth.', '../FINAL/src/ChocolateMT.png', '2021-04-30 23:51:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 200, 'Red Velvet', 'MT5', 'MilkTea', 'With mild fruity flavor blended with subtle taste of chocolate, this beverage will truly captivate you.', '../FINAL/src/RedVelvetMT.png', '2021-05-11 21:35:45', '0000-00-00 00:00:00', '2021-05-12 22:34:55', 1),
(6, 200, 'Classic Winter Melon', 'MT6', 'MilkTea', 'Feel the pleasure with every sip of the refreshing taste of our Wintermelon, delighting your tastebuds until the last drop.', '../FINAL/src/ClassicWintermelon.png', '2021-05-11 22:22:11', '0000-00-00 00:00:00', '2021-05-12 22:34:26', 1),
(7, 200, 'Premium Caramel Sugar', 'MT7', 'MilkTea', 'Enjoy the taste of our traditional Milktea blended with a touch of luscious Premium Caramel Sugar.', '../FINAL/src/PremiumCaramelSugar.png', '2021-05-12 22:34:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 200, 'Cookies and Cream', 'MT8', 'MilkTea', 'Satisfy your sweet cravings with the classic taste of Cookies and Cream Milktea.', '../FINAL/src/CookiesNCream.png', '2021-05-12 22:40:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 200, 'Choco Fudge', 'MS1', 'MilkShake', 'Be crazy and in love with our sweetest shake that is loaded with brownies and chocolate fudge that will make you stun for minutes.', '../FINAL/src/ChocoFudgeWToppings1.png', '2021-05-12 22:41:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 200, 'Choco Kisses', 'MS2', 'MilkShake', 'Feel the love with this shake, it contains of milk joy powder that will surely win your heart.', '../FINAL/src/ChocoKissesMS.png', '2021-05-12 22:41:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 200, 'Black Forest', 'MS3', 'MilkShake', 'Be in the clouds with the taste of this milkshake blended with cherries and topped with crushed cookies.', '../FINAL/src/BlackForestMS.png', '2021-05-12 22:41:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 200, 'Cookies and Cream', 'MS4', 'MilkShake', 'Get ready to taste our sweet and creamy shake with crushed oreos, that will surely get you crazy.', '../FINAL/src/CNC.png', '2021-05-12 22:41:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 200, 'Coffee Crumble', 'MS5', 'MilkShake', 'Crumble and fall with the taste of this creamy delicious thick loaded shake with coffee, milk and chocolate.', '../FINAL/src/CoffeeCrumbleMS.png', '2021-05-12 22:42:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(14, 200, 'Melon', 'MS6', 'MilkShake', 'This shake will make you smile, it contains of lovely melon, attractive vanilla ice cream and a delicious milk.', '../FINAL/src/MelonMS.png', '2021-05-12 22:42:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 200, 'Avocado', 'MS7', 'MilkShake', 'Taste the creamy shake that is made of milk and avocado with love that will satisfy your avo-cravings.', '../FINAL/src/AvocadoMS.png', '2021-05-12 22:43:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(16, 200, 'Buko Pandan', 'MS8', 'MilkShake', 'Be in love with this shake combined with coconut juice and screw pine leaves for a refreshing pandan moment.', '../FINAL/src/BukoPandanWToppings.png', '2021-05-12 22:43:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(17, 200, 'Ube', 'MS9', 'MilkShake', 'Be refreshed with this milky ube shake for it will give you a moment that will last forever.', '../FINAL/src/UbeMS.png', '2021-05-12 22:43:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(18, 200, 'Strawberry', 'MS10', 'MilkShake', 'Start your golden day with this shake because itï¿½s combined with honey, milk and strawberries that will fit with your mood.', '../FINAL/src/StrawberryMS.png', '2021-05-12 22:44:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(19, 200, 'Buko', 'MS11', 'MilkShake', 'Taste this refreshing shake, the best tasting drink is made from the famous coconut.', '../FINAL/src/BukoMS.png', '2021-05-12 22:44:26', '0000-00-00 00:00:00', '2021-05-28 17:30:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `size_tbl`
--

CREATE TABLE `size_tbl` (
  `Size_ID` int(11) NOT NULL,
  `Product_IDP` int(11) NOT NULL,
  `Amount` double(6,2) NOT NULL,
  `Size_Description` varchar(100) NOT NULL,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL,
  `Is_Active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size_tbl`
--

INSERT INTO `size_tbl` (`Size_ID`, `Product_IDP`, `Amount`, `Size_Description`, `Date_Created`, `Date_Updated`, `Date_Deleted`, `Is_Active`) VALUES
(1, 1, 115.00, 'LARGE', '2021-05-02 23:29:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 1, 130.00, 'EXTRA LARGE', '2021-05-02 23:32:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 1, 100.00, 'REGULAR', '2021-05-02 23:40:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 2, 100.00, 'REGULAR', '2021-05-19 00:37:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 2, 115.00, 'LARGE', '2021-05-19 00:37:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 2, 130.00, 'EXTRA LARGE', '2021-05-19 00:37:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 3, 100.00, 'REGULAR', '2021-05-19 02:07:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 3, 115.00, 'LARGE', '2021-05-19 02:07:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 3, 130.00, 'EXTRA LARGE', '2021-05-19 02:07:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 4, 115.00, 'LARGE', '2021-05-20 13:30:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 4, 130.00, 'EXTRA LARGE', '2021-05-20 13:30:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 4, 100.00, 'REGULAR', '2021-05-20 13:39:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 5, 115.00, 'LARGE', '2021-05-20 13:39:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(14, 5, 130.00, 'EXTRA LARGE', '2021-05-20 13:39:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 5, 100.00, 'REGULAR', '2021-05-28 17:27:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(16, 6, 115.00, 'LARGE', '2021-05-28 17:27:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(17, 6, 130.00, 'EXTRA LARGE', '2021-05-28 17:27:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(18, 6, 100.00, 'REGULAR', '2021-05-28 17:28:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(19, 7, 135.00, 'LARGE', '2021-05-28 17:28:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(20, 7, 150.00, 'EXTRA LARGE', '2021-05-28 17:28:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(21, 7, 120.00, 'REGULAR', '2021-05-28 17:28:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(22, 8, 115.00, 'LARGE', '2021-05-28 17:28:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(23, 8, 130.00, 'EXTRA LARGE', '2021-05-28 17:28:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(24, 8, 100.00, 'REGULAR', '2021-05-28 17:28:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(28, 9, 110.00, 'REGULAR', '2021-05-31 11:35:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(29, 9, 125.00, 'LARGE', '2021-05-31 11:35:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(30, 9, 140.00, 'EXTRA LARGE', '2021-05-31 11:35:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(31, 10, 110.00, 'REGULAR', '2021-05-31 12:07:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(32, 10, 125.00, 'LARGE', '2021-05-31 12:07:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(33, 10, 140.00, 'EXTRA LARGE', '2021-05-31 12:07:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(34, 11, 110.00, 'REGULAR', '2021-05-31 12:07:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(35, 11, 125.00, 'LARGE', '2021-05-31 12:07:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(36, 11, 140.00, 'EXTRA LARGE', '2021-05-31 12:07:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(37, 12, 110.00, 'REGULAR', '2021-05-31 12:08:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(38, 12, 125.00, 'LARGE', '2021-05-31 12:08:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(39, 12, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(40, 13, 110.00, 'REGULAR', '2021-05-31 12:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(41, 13, 125.00, 'LARGE', '2021-05-31 12:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(42, 13, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(43, 14, 110.00, 'REGULAR', '2021-05-31 12:08:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(44, 14, 125.00, 'LARGE', '2021-05-31 12:08:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(45, 14, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(46, 15, 110.00, 'REGULAR', '2021-05-31 12:08:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(47, 15, 125.00, 'LARGE', '2021-05-31 12:08:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(48, 15, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(49, 16, 110.00, 'REGULAR', '2021-05-31 12:08:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(50, 16, 125.00, 'LARGE', '2021-05-31 12:08:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(51, 16, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(52, 17, 110.00, 'REGULAR', '2021-05-31 12:08:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(53, 17, 125.00, 'LARGE', '2021-05-31 12:08:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(54, 17, 140.00, 'EXTRA LARGE', '2021-05-31 12:08:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(55, 18, 110.00, 'REGULAR', '2021-05-31 12:09:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(56, 18, 125.00, 'LARGE', '2021-05-31 12:09:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(57, 18, 140.00, 'EXTRA LARGE', '2021-05-31 12:09:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user`
--

CREATE TABLE `tbl_admin_user` (
  `Admin_ID` int(11) NOT NULL,
  `L_Name` varchar(50) NOT NULL,
  `F_Name` varchar(50) NOT NULL,
  `Contact_Num` int(11) NOT NULL,
  `Admin_Email` varchar(50) NOT NULL,
  `Admin_Password` varchar(200) NOT NULL,
  `Is_Active` tinyint(1) NOT NULL DEFAULT 1,
  `Date_Created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Updated` datetime NOT NULL,
  `Date_Deleted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_user`
--

INSERT INTO `tbl_admin_user` (`Admin_ID`, `L_Name`, `F_Name`, `Contact_Num`, `Admin_Email`, `Admin_Password`, `Is_Active`, `Date_Created`, `Date_Updated`, `Date_Deleted`) VALUES
(6, 'OR', 'CHONY', 906248177, 'chonyor76@gmail.com', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 1, '2021-05-11 21:26:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addons_tbl`
--
ALTER TABLE `addons_tbl`
  ADD PRIMARY KEY (`Addons_ID`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  ADD PRIMARY KEY (`feedback_ID`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `Fk_Customer_Order` (`Customer_ID`),
  ADD KEY `Fk_Size_Order` (`Size_ID`),
  ADD KEY `Fk_Product_Order` (`Product_IDP`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`Product_IDP`);

--
-- Indexes for table `size_tbl`
--
ALTER TABLE `size_tbl`
  ADD PRIMARY KEY (`Size_ID`),
  ADD KEY `Fk_Product_size` (`Product_IDP`);

--
-- Indexes for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addons_tbl`
--
ALTER TABLE `addons_tbl`
  MODIFY `Addons_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback_tbl`
--
ALTER TABLE `feedback_tbl`
  MODIFY `feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `Product_IDP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `size_tbl`
--
ALTER TABLE `size_tbl`
  MODIFY `Size_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `Fk_Customer_Order` FOREIGN KEY (`Customer_ID`) REFERENCES `customer_tbl` (`Customer_ID`),
  ADD CONSTRAINT `Fk_Product_Order` FOREIGN KEY (`Product_IDP`) REFERENCES `product_tbl` (`Product_IDP`),
  ADD CONSTRAINT `Fk_Size_Order` FOREIGN KEY (`Size_ID`) REFERENCES `size_tbl` (`Size_ID`);

--
-- Constraints for table `size_tbl`
--
ALTER TABLE `size_tbl`
  ADD CONSTRAINT `Fk_Product_size` FOREIGN KEY (`Product_IDP`) REFERENCES `product_tbl` (`Product_IDP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
