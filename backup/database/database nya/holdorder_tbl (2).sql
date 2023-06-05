-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 07:49 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  ADD PRIMARY KEY (`holdOrder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holdorder_tbl`
--
ALTER TABLE `holdorder_tbl`
  MODIFY `holdOrder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
