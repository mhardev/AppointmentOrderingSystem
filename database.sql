-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2024 at 09:42 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`localhost`@`127.0.0.1` PROCEDURE `spGetAppSlots` (IN `appDate` DATE)   WITH morningA AS 
(
    SELECT COUNT(*) as mornA FROM `tbl_appointment` WHERE `appointment_type` = '08:00 AM - 09:00 AM' AND DATE(appointment_date) = appDate
),
morningB AS
(
    SELECT COUNT(*) as mornB FROM `tbl_appointment` WHERE `appointment_type` = '09:00 AM - 10:00 AM' AND DATE(appointment_date) = appDate
),
morningC AS
(
    SELECT COUNT(*) as mornC FROM `tbl_appointment` WHERE `appointment_type` = '10:00 AM - 11:00 AM' AND DATE(appointment_date) = appDate
),
morningD AS
(
    SELECT COUNT(*) as mornD FROM `tbl_appointment` WHERE `appointment_type` = '11:00 AM - 12:00 NN' AND DATE(appointment_date) = appDate
),
afternoonA AS
(
    SELECT COUNT(*) as afterA FROM `tbl_appointment` WHERE `appointment_type` = '01:00 PM - 02:00 PM' AND DATE(appointment_date) = appDate
),
afternoonB AS
(
    SELECT COUNT(*) as afterB FROM `tbl_appointment` WHERE `appointment_type` = '02:00 PM - 03:00 PM' AND DATE(appointment_date) = appDate
),
afternoonC AS
(
    SELECT COUNT(*) as afterC FROM `tbl_appointment` WHERE `appointment_type` = '03:00 PM - 04:00 PM' AND DATE(appointment_date) = appDate
),
afternoonD AS
(
    SELECT COUNT(*) as afterD FROM `tbl_appointment` WHERE `appointment_type` = '04:00 PM - 05:00 PM' AND DATE(appointment_date) = appDate
)

SELECT
    ma.mornA,
    mb.mornB,
    mc.mornC,
    md.mornD,
    aa.afterA,
    ab.afterB,
    ac.afterC,
    ad.afterD
FROM morningA ma
CROSS JOIN morningB mb
CROSS JOIN morningC mc
CROSS JOIN morningD md
CROSS JOIN afternoonA aa
CROSS JOIN afternoonB ab
CROSS JOIN afternoonC ac
CROSS JOIN afternoonD ad$$

CREATE DEFINER=`localhost`@`127.0.0.1` PROCEDURE `spGetSalesReport` (IN `startDate` VARCHAR(50), IN `endDate` VARCHAR(50))   SELECT
	SUM(total_price) AS Total
FROM tbl_billing 
WHERE order_status = 'Complete' AND place_on BETWEEN startDate AND endDate$$

CREATE DEFINER=`localhost`@`127.0.0.1` PROCEDURE `spGetServicesReport` (IN `startDate` VARCHAR(50), IN `endDate` VARCHAR(50))   SELECT SUM(total_cost) As Total FROM tbl_appointment WHERE status = 'complete' AND appointment_started BETWEEN startDate AND endDate$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dashboardcards`
--

CREATE TABLE `dashboardcards` (
  `TotalSales` decimal(47,0) DEFAULT NULL,
  `Users` bigint(21) DEFAULT NULL,
  `Orders` bigint(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `notifications`
-- (See below for the actual view)
--
CREATE TABLE `notifications` (
`Title` varchar(12)
,`appointment_date` datetime /* mariadb-5.3 */
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `productstockchart`
-- (See below for the actual view)
--
CREATE TABLE `productstockchart` (
`product_category` varchar(100)
,`ProductStockCount` decimal(46,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `number`, `age`, `address`, `image`) VALUES
(1, 'admin', '4b78e581bdaffa037a6b11d58bdc934a', 'motojen.30@gmail.com', '9934410043', 23, 'address 1', 'Admin-Pic-5677.png'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'jen@gmail.com', '', 1, 'sample address', 'Admin-Pic-5677.png '),
(5, 'sample', 'ee11cbb19052e40b07aac0ca060c23ee', 'jen@gmail.com', '', 12, 'sample address', 'Product-Motojen-547.png '),
(6, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'motojen.30@gmail.com', '', 31, 'San Agustin Novaliches', 'Admin-Pic-5677.png '),
(8, 'admin3', '21232f297a57a5a743894a0e4a801fc3', 'moto-jen30@gmail.com', '', 30, 'San Agustin, Novaliches', 'Admin-Pic-5677.png '),
(9, 'admin4', '4b78e581bdaffa037a6b11d58bdc934a', 'joshuamhar05@gmail.com', '', 22, 'Gulod, Novaliches', 'Admin-Pic-5677.png ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_archived`
--

CREATE TABLE `tbl_admin_archived` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `age` int(3) NOT NULL,
  `address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admin_archived`
--

INSERT INTO `tbl_admin_archived` (`id`, `username`, `password`, `email`, `number`, `age`, `address`, `image`) VALUES
(7, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'jenmoto1@gmail.com', '', 25, 'San Agustin, Novaliches', 'Admin-Pic-5677.png ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `services_name` varchar(500) NOT NULL,
  `appointment_date` date NOT NULL DEFAULT current_timestamp(),
  `appointment_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `total_cost` decimal(25,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`id`, `user_id`, `services_name`, `appointment_date`, `appointment_type`, `status`, `total_cost`, `created_at`) VALUES
(14, 2, 'tune up', '2023-11-16', 'morning', 'Complete', 150, '2024-01-19 01:29:45'),
(15, 2, 'tune up', '2023-11-16', 'morning', 'Cancelled', 150, '2024-01-19 01:29:45'),
(16, 4, 'tune up', '2023-11-16', 'morning', 'Cancelled', 153, '2024-01-19 01:29:45'),
(19, 6, 'change seat cover with seat cover set', '2023-11-16', 'morning', 'complete', 250, '2024-01-19 01:29:45'),
(20, 6, 'electrical repair', '2023-11-16', 'morning', 'Cancelled', 400, '2024-01-19 01:29:45'),
(32, 26, 'carborador cleaning tune up change oil ', '2023-11-19', 'morning', 'Complete', 280, '2024-01-19 01:29:45'),
(38, 26, 'PALIT TAMBUCHO,cleaning,electrical repair,', '2023-11-19', 'morning', 'Cancelled', 2400, '2024-01-19 01:29:45'),
(40, 22, 'tune up,carborador cleaning,', '2024-01-05', 'morning', 'Complete', 250, '2024-01-19 01:29:45'),
(41, 22, 'change oil,change seat cover with seat cover set,', '2024-01-05', 'morning', 'Complete', 280, '2024-01-19 01:29:45'),
(42, 22, 'change seat cover with seat cover set,electrical repair,', '2024-01-05', 'morning', 'Complete', 650, '2024-01-19 01:29:45'),
(43, 22, 'PALIT TAMBUCHO,engine repair,', '2024-01-05', 'morning', 'Cancelled', 3300, '2024-01-19 01:29:45'),
(44, 22, 'tune up,carborador cleaning,change seat cover with seat cover set,', '2024-01-05', 'morning', 'Complete', 500, '2024-01-19 01:29:45'),
(45, 0, 'tune up,carborador cleaning,', '0000-00-00', 'morning', 'Cancelled', 250, '2024-01-19 01:29:45'),
(46, 0, 'tune up,carborador cleaning,change oil,', '2024-01-08', 'morning', 'Cancelled', 280, '2024-01-19 01:29:45'),
(47, 0, 'tune up,engine repair,', '2024-01-07', 'morning', 'Cancelled', 1650, '2024-01-19 01:29:45'),
(49, 22, 'change seat cover with seat cover set,engine repair,', '2024-01-08', 'morning', 'Complete', 1750, '2024-01-19 01:29:45'),
(50, 22, 'tune up,PALIT TAMBUCHO,', '2024-01-08', 'morning', 'Cancelled', 1950, '2024-01-19 01:29:45'),
(52, 22, 'tune up,carborador cleaning,', '2024-01-08', 'morning', 'Cancelled', 250, '2024-01-19 01:29:45'),
(53, 22, '', '2024-01-07', 'morning', 'Complete', 0, '2024-01-19 01:29:45'),
(54, 22, 'NaNchanging breakpad,', '2024-01-06', 'morning', 'Cancelled', 200, '2024-01-19 01:29:45'),
(55, 26, 'electrical repair,', '2024-01-12', 'morning', 'Cancelled', 400, '2024-01-19 01:29:45'),
(56, 26, '', '2024-01-12', 'morning', 'Cancelled', 0, '2024-01-19 01:29:45'),
(57, 34, 'NaNchange oil,Check-up,PALIT TAMBUCHO,Replace Bulb,change seat cover with seat cover set,carborador cleaning,changing breakpad,', '2024-01-24', 'morning', 'Complete', 1750, '2024-01-19 01:29:45'),
(58, 31, 'cleaning,electrical repair,', '2024-01-23', 'morning', '', 600, '2024-01-19 01:29:45'),
(59, 31, 'engine repair,changing breakpad,', '2024-01-24', 'morning', 'Complete', 1200, '2024-01-19 01:29:45'),
(60, 31, 'cleaning,PALIT TAMBUCHO,', '2024-01-25', 'morning', '', 1000, '2024-01-19 01:29:45'),
(61, 31, 'NaNReplace Bulb,changing breakpad,', '2024-01-26', 'morning', '', 220, '2024-01-19 01:29:45'),
(62, 31, 'change seat cover with seat cover set,electrical repair,', '2024-01-27', 'morning', '', 650, '2024-01-19 01:29:45'),
(63, 31, 'NaNengine repair,', '2024-01-25', 'morning', 'Complete', 1000, '2024-01-19 01:29:45'),
(64, 31, 'NaN', '2024-01-26', 'morning', 'Pending', 1000, '2024-01-19 01:29:45'),
(65, 31, 'Tune-up,carborador cleaning,Check-up,', '2024-01-28', 'morning', '', 250, '2024-01-19 01:29:45'),
(66, 31, 'change seat cover with seat cover set,electrical repair,', '2024-01-31', 'morning', '', 650, '2024-01-19 01:29:45'),
(69, 31, 'change seat cover with seat cover set,cleaning,', '2024-01-30', 'morning', 'Complete', 450, '2024-01-19 04:39:36'),
(75, 31, 'engine repair,change seat cover with seat cover set,', '2024-02-28', 'morning', 'Complete', 1250, '2024-01-19 13:49:30'),
(76, 31, '', '2024-02-27', 'afternoon', 'Complete', 0, '2024-01-19 13:51:09'),
(77, 31, 'NaNPALIT TAMBUCHO,', '2024-01-21', 'afternoon', 'Complete', 800, '2024-01-19 13:52:22'),
(78, 31, 'PALIT TAMBUCHO,engine repair,', '2024-01-29', 'afternoon', 'Pending', 1800, '2024-01-19 13:55:23'),
(79, 31, 'Tune-up,change seat cover with seat cover set,engine repair,', '2024-01-24', 'afternoon', 'Complete', 1400, '2024-01-19 13:56:48'),
(80, 31, 'cleaning,changing breakpad,carborador cleaning,change seat cover with seat cover set,PALIT TAMBUCHO,', '2024-02-22', 'afternoon', 'Pending', 1550, '2024-01-20 00:38:07'),
(81, 31, 'PALIT TAMBUCHO,change seat cover with seat cover set,', '2024-01-31', 'afternoon', 'Pending', 1050, '2024-01-20 00:39:26'),
(82, 35, 'cleaning,engine repair,', '2024-01-24', 'morning', 'Complete', 1200, '2024-01-20 01:32:36'),
(83, 36, 'change seat cover with seat cover set,electrical repair,', '2024-01-27', 'afternoon', 'Pending', 650, '2024-01-20 02:35:21'),
(96, 44, 'electrical repair,PALIT TAMBUCHO,', '2024-01-24', '09:00 AM - 10:00 AM', 'Pending', 1200, '2024-01-22 00:53:04'),
(97, 44, 'NaNchanging breakpad,PALIT TAMBUCHO,', '2024-01-24', '09:00 AM - 10:00 AM', 'Pending', 1000, '2024-01-22 01:34:43'),
(98, 38, 'change seat cover with seat cover set,cleaning,', '2024-01-24', '08:00 AM - 09:00 AM', 'Complete', 450, '2024-01-22 10:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_archived`
--

CREATE TABLE `tbl_archived` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` decimal(25,0) NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_stock` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_archived`
--

INSERT INTO `tbl_archived` (`id`, `product_name`, `product_price`, `image`, `product_category`, `product_stock`) VALUES
(15, '2T Motor Oil SAE 30', 200, 'Product-Motojen-8277.png', 'oil', 48),
(82, 'Motorcycle Stainless Bolts 6X16-1pc', 5, 'Product-Motojen-7664.png', 'frame', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE `tbl_audit_trail` (
  `audit_id` int(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `activity_details` varchar(1000) NOT NULL,
  `audit_date` date NOT NULL,
  `audit_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_audit_trail`
--

INSERT INTO `tbl_audit_trail` (`audit_id`, `user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES
(3, 'admin', '', 'Ordered Product', '', '2023-10-30', '14:41:30'),
(4, 'admin', '', 'Added new supplier', '', '2023-10-30', '14:57:30'),
(5, 'user', '25', 'Ordered Product', '', '2023-10-30', '18:12:43'),
(6, 'user', '', 'Ordered Product', '', '2023-10-30', '18:15:04'),
(7, 'user', '23', 'Ordered Product', '', '2023-10-30', '18:15:45'),
(8, 'user', '23', 'Ordered Product', '', '2023-10-30', '18:16:02'),
(9, 'user', '23', 'Ordered Product', '', '2023-10-30', '19:18:19'),
(10, 'user', '23', 'Ordered Product', '', '2023-10-30', '19:19:26'),
(11, 'admin', '23', 'Updated a status of an order.', '', '2023-10-30', '19:22:31'),
(12, 'user', '23', 'Ordered Product', '', '2023-10-30', '19:32:22'),
(13, 'admin', '23', 'Updated a status of an order.', '', '2023-10-30', '19:36:40'),
(14, 'admin', '', 'Added new supplier', '', '2023-10-30', '19:42:52'),
(15, 'admin', '', 'Registered New Supplier', '', '2023-10-30', '19:43:49'),
(16, 'admin', '', 'Ordered Product', '', '2023-10-30', '19:47:26'),
(17, 'admin', '23', 'Updated a status of an order.', '', '2023-10-30', '19:55:52'),
(18, 'admin', '23', 'Updated a status of an order.', '', '2023-10-30', '19:56:13'),
(19, 'admin', '', 'Updated a status of an order.', '', '2023-11-05', '13:09:21'),
(20, 'admin', '', 'Updated a status of an order.', '', '2023-11-05', '13:09:47'),
(21, 'admin', '', 'Updated a status of an order.', '', '2023-11-05', '13:09:57'),
(22, 'admin', 'row.id', 'Updated a status of an order.', '', '2023-11-05', '13:10:48'),
(23, 'admin', 'row.id', 'Updated a status of an order.', '', '2023-11-05', '13:10:58'),
(24, 'admin', 'row.id', 'Updated a status of an order.', '', '2023-11-05', '13:14:33'),
(25, 'admin', '', 'Deleted a product', '', '2023-11-12', '14:53:48'),
(26, 'admin', '', 'Deleted a product', '', '2023-11-12', '14:53:56'),
(27, 'admin', '', 'Deleted a product', '', '2023-11-12', '14:56:31'),
(28, 'admin', '', 'Deleted a product', '', '2023-11-12', '14:57:04'),
(29, 'admin', '', 'Deleted a product', '', '2023-11-12', '14:57:38'),
(30, 'admin', '1', 'Updete a service.', '', '2023-11-15', '18:54:36'),
(31, 'admin', '1', 'Updete a service.', '', '2023-11-15', '18:54:43'),
(32, 'admin', '1', 'Updete a service.', '', '2023-11-15', '18:55:16'),
(33, 'admin', '', 'Deleted a service', '', '2023-11-15', '18:55:20'),
(34, 'admin', '', 'Deleted a product', '', '2023-11-15', '19:17:59'),
(35, 'admin', '', 'Ordered Product', '', '2023-11-15', '20:29:46'),
(36, 'admin', '', 'Registered New admin account', '', '2023-11-15', '20:43:36'),
(37, 'admin', '1', 'Added a service.', '', '2023-11-16', '20:00:03'),
(38, 'user', '', 'Created an appointment.', '', '2023-11-16', '22:48:29'),
(39, 'user', '', 'Created an appointment.', '', '2023-11-16', '22:51:24'),
(40, 'admin', '', 'Updated a status of an appointment.', '', '2023-11-16', '22:55:01'),
(41, 'user', '', 'Created an appointment.', '', '2023-11-16', '23:18:04'),
(42, 'user', '', 'Created an appointment.', '', '2023-11-16', '23:19:15'),
(43, 'admin', '26', 'Ordered Product', '', '2023-11-18', '21:37:31'),
(44, 'admin', '', 'Deleted a product', '', '2023-11-18', '21:37:55'),
(45, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '21:44:38'),
(46, 'admin', '26', 'Ordered Product', '', '2023-11-18', '21:44:54'),
(47, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '21:51:22'),
(48, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '21:52:16'),
(49, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '21:53:45'),
(50, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '21:55:02'),
(51, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '22:10:05'),
(52, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '22:10:59'),
(53, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '22:13:09'),
(54, 'admin', '', 'Registered New Supplier', '', '2023-11-18', '22:18:45'),
(55, 'admin', '26', 'Ordered Product', '', '2023-11-18', '22:20:14'),
(56, 'admin', '26', 'Ordered Product', '', '2023-11-18', '22:21:38'),
(57, 'user', '', 'Created an appointment.', '', '2023-11-18', '23:43:14'),
(58, 'user', '', 'Created an appointment.', '', '2023-11-18', '23:50:58'),
(59, 'user', '26', 'Created an appointment.', '', '2023-11-18', '23:57:43'),
(60, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:07:53'),
(61, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:08:01'),
(62, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:08:55'),
(63, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:11:58'),
(64, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:14:07'),
(65, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:14:13'),
(66, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:14:17'),
(67, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:14:21'),
(68, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:15:20'),
(69, 'admin', '', 'Deleted a product', '', '2023-11-22', '21:18:34'),
(70, 'admin', '', 'Deleted a product', '', '2023-11-22', '21:18:50'),
(71, 'admin', '', 'Deleted a product', '', '2023-11-22', '21:21:04'),
(72, 'admin', '', 'Updated a status of an order.', '', '2023-11-22', '21:36:05'),
(73, 'admin', '', 'Updated a status of an order.', '', '2023-11-22', '21:54:45'),
(74, 'admin', '', 'Deleted a product', '', '2023-11-23', '00:29:55'),
(75, 'admin', '1', 'Added a service.', '', '2023-11-23', '01:14:03'),
(76, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '01:17:57'),
(77, 'admin', '', 'Ordered Product', '', '2023-11-23', '01:18:47'),
(78, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '01:29:31'),
(79, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '01:43:43'),
(80, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '01:44:47'),
(81, 'admin', '', 'Ordered Product', '', '2023-11-23', '01:48:00'),
(82, 'admin', '', 'Updated a status of an order.', '', '2023-11-23', '11:03:43'),
(83, 'admin', '', 'Updated a status of an order.', '', '2023-11-23', '11:03:55'),
(84, 'user', '', 'Created an appointment.', '', '2023-11-23', '19:29:24'),
(85, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '20:18:00'),
(86, 'admin', '', 'Registered New Supplier', '', '2023-11-23', '20:18:01'),
(87, 'admin', '', 'Updated a status of an appointment.', '', '2023-11-23', '21:56:35'),
(88, 'admin', '', 'Deleted a product', '', '2023-11-27', '01:31:46'),
(89, 'admin', '', 'Deleted a product', '', '2023-11-27', '01:31:52'),
(90, 'admin', '', 'Updated a product stock.', '', '2023-11-27', '01:46:20'),
(91, 'admin', '', 'Updated a product stock.', '', '2023-11-27', '01:49:09'),
(92, 'admin', '', 'Updated a product stock.', '', '2023-11-27', '01:50:25'),
(93, 'admin', '', 'Updated a product stock.', '', '2023-11-27', '02:08:10'),
(94, 'admin', '', 'Updated a product stock.', '', '2023-11-27', '02:08:23'),
(95, 'admin', '1', 'Updete profile pic.', '', '2024-01-04', '18:15:44'),
(96, 'admin', '1', 'Updete profile pic.', '', '2024-01-04', '18:15:45'),
(97, 'user', '', 'Created an appointment.', '', '2024-01-05', '00:35:24'),
(98, 'user', '', 'Created an appointment.', '', '2024-01-05', '00:35:41'),
(99, 'user', '', 'Created an appointment.', '', '2024-01-05', '00:35:50'),
(100, 'user', '', 'Created an appointment.', '', '2024-01-05', '00:35:59'),
(101, 'user', '', 'Created an appointment.', '', '2024-01-05', '00:36:08'),
(102, 'admin', '1', 'Registered a new admin account', '', '2024-01-05', '16:20:19'),
(103, 'user', '', 'Created an appointment.', '', '2024-01-05', '16:56:31'),
(104, 'user', '', 'Created an appointment.', '', '2024-01-05', '16:58:37'),
(105, 'user', '', 'Created an appointment.', '', '2024-01-05', '17:17:50'),
(106, 'user', '', 'Created an appointment.', '', '2024-01-05', '17:19:46'),
(107, 'admin', '1', 'Added new supplier', '', '2024-01-05', '17:24:12'),
(108, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '17:26:16'),
(109, 'admin', '', 'Updated a status of an order.', '', '2024-01-05', '17:26:54'),
(110, 'admin', '', 'Updated a status of an order.', '', '2024-01-05', '17:27:03'),
(111, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '17:31:18'),
(112, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '17:36:25'),
(113, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '17:41:37'),
(114, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '18:29:21'),
(115, 'user', '22', 'Ordered Product.', '', '2024-01-05', '19:54:54'),
(116, 'admin', '', 'Updated a status of an order.', '', '2024-01-05', '21:17:23'),
(117, 'admin', '', 'Updated a status of an order.', '', '2024-01-05', '21:35:19'),
(118, 'user', '22', 'Created an appointment.', '', '2024-01-05', '21:40:50'),
(119, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '21:41:51'),
(120, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '21:45:56'),
(121, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-05', '21:54:04'),
(122, 'admin', '', 'Updated a status of an order.', '', '2024-01-05', '22:45:01'),
(123, 'user', '22', 'Ordered Product.', '', '2024-01-06', '02:59:52'),
(124, 'user', '22', 'Created an appointment.', '', '2024-01-06', '03:43:06'),
(125, 'user', '22', 'Created an appointment.', '', '2024-01-06', '03:52:49'),
(126, 'user', '22', 'Created an appointment.', '', '2024-01-06', '04:00:43'),
(127, 'user', '22', 'Ordered Product.', '', '2024-01-06', '04:52:38'),
(128, 'user', '22', 'Ordered Product.', '', '2024-01-06', '04:54:20'),
(129, 'admin', '1', 'Added a service.', '', '2024-01-06', '04:58:35'),
(130, 'user', '22', 'Created an appointment.', '', '2024-01-06', '05:02:58'),
(131, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-06', '05:07:40'),
(132, 'user', '22', 'Created an appointment.', '', '2024-01-06', '05:07:47'),
(133, 'user', '26', 'Created an appointment.', '', '2024-01-07', '04:33:46'),
(134, 'user', '26', 'Created an appointment.', '', '2024-01-07', '04:36:40'),
(135, 'user', '', 'Ordered Product', '', '2024-01-07', '09:49:34'),
(136, 'user', '', 'Ordered Product', '', '2024-01-07', '09:49:38'),
(137, 'user', '', 'Ordered Product', '', '2024-01-07', '09:50:23'),
(138, 'user', '', 'Ordered Product', '', '2024-01-07', '09:54:58'),
(139, 'user', '', 'Ordered Product', '', '2024-01-07', '09:57:52'),
(140, 'user', '', 'Ordered Product', '', '2024-01-07', '09:57:52'),
(141, 'user', '', 'Ordered Product', '', '2024-01-07', '09:57:53'),
(142, 'user', '', 'Ordered Product', '', '2024-01-07', '09:57:57'),
(143, 'user', '', 'Ordered Product', '', '2024-01-07', '09:58:24'),
(144, 'user', '', 'Ordered Product', '', '2024-01-07', '09:58:35'),
(145, 'user', '', 'Ordered Product', '', '2024-01-07', '09:58:58'),
(146, 'user', '', 'Ordered Product', '', '2024-01-07', '10:02:18'),
(147, 'admin', '', 'Deleted a product', '', '2024-01-10', '09:56:40'),
(148, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-11', '20:08:41'),
(149, 'admin', '', 'Deleted a product', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', '2024-01-11', '21:07:31'),
(150, 'admin', '', 'Deleted a product', 'ID: 85, Product Name: Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B, Price: 1100, Image: Product-Motojen-7967.png, Category: battery, Stock: 1', '2024-01-11', '21:24:08'),
(151, 'admin', '1', 'Registered a new admin account', 'ID: admin3, Username: admin3, Email: moto-jen30@gmail.com, Number: , Age: 30, Address: San Agustin, Novaliches, Image: Admin-Pic-5677.png', '2024-01-11', '22:53:18'),
(152, 'admin', '', 'Deleted a product', 'ID: 89, Product Name: Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B , Price: 800, Image: , Category: battery, Stock: 300', '2024-01-11', '23:03:38'),
(153, 'admin', '1', 'Ordered Product', '', '2024-01-14', '21:51:05'),
(154, 'admin', '', 'Product has been moved to archive', 'ID: , Product Name: , Price: , Image: , Category: , Stock: ', '2024-01-14', '22:39:26'),
(155, 'admin', '', 'Product has been moved to archive', 'ID: 9, Product Name: YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO , Price: 900, Image: Product-Motojen-6996.png, Category: battery, Stock: 38', '2024-01-14', '22:45:19'),
(156, 'admin', '', 'Product has been moved to archive', 'ID: 15, Product Name: 2T Motor Oil SAE 30, Price: 200, Image: Product-Motojen-8277.png, Category: oil, Stock: 48', '2024-01-14', '23:07:22'),
(157, 'admin', '', 'Product has retrieved', 'ID: 9, Product Name: YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO , Price: 900, Image: Product-Motojen-6996.png, Category: battery, Stock: 38', '2024-01-14', '23:13:28'),
(158, 'admin', '', 'Product has retrieved', 'ID: 112, Product Name: Domino Quick Throttle Racing with Cable, Price: 210, Image: Domino Quick Throttle Racing with Cable.png, Category: Throttle Cable, Stock: 10', '2024-01-14', '23:14:04'),
(159, 'admin', '', 'Product has been moved to archive', 'ID: 112, Product Name: Domino Quick Throttle Racing with Cable, Price: 210, Image: Domino Quick Throttle Racing with Cable.png, Category: Throttle Cable, Stock: 10', '2024-01-14', '23:42:26'),
(160, 'admin', '', 'Deleted a product', 'ID: 112, Product Name: Domino Quick Throttle Racing with Cable, Price: 210, Image: , Category: Throttle Cable, Stock: 10', '2024-01-14', '23:45:39'),
(162, 'admin', '1', 'Added a service.', 'ID: 12, Services Name: Replace Bulb, Price: 20', '2024-01-15', '00:53:57'),
(166, 'admin', '1', 'Added a service.', 'ID: 16, Services Name: Change Clutch Cable, Price: 150', '2024-01-15', '01:01:40'),
(167, 'admin', '1', 'Product has been moved to archive', 'ID: 9, Product Name: YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO , Price: 900, Image: Product-Motojen-6996.png, Category: battery, Stock: 38', '2024-01-15', '01:13:09'),
(168, 'admin', '1', 'Product has retrieved', 'ID: 9, Product Name: YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO , Price: 900, Image: Product-Motojen-6996.png, Category: battery, Stock: 38', '2024-01-15', '01:13:29'),
(169, 'admin', '1', 'The service has been moved to archive', 'ID: 16, Service name: Change Clutch Cable, Price: ', '2024-01-15', '03:10:46'),
(170, 'admin', '1', 'Added a service.', 'ID: 17, Services Name: Change Spark Plug, Price: 50', '2024-01-15', '03:20:45'),
(171, 'admin', '1', 'The service has been moved to archive', 'ID: 17, Service name: Change Spark Plug, Price: 50', '2024-01-15', '03:20:55'),
(172, 'admin', '1', 'The user has been moved to archive', 'ID: 4, User name: MichaelGaid, Email: michaelcharls.gaid@gmail.com, Number: 921633604, Address: michaelcharls.gaid@gmail.com, Status: Active, OTP code: , OTP verified: 0, Datetime created: 0000-00-00 00:00:00', '2024-01-15', '03:44:15'),
(173, 'admin', '1', 'The user has been retrieved', 'ID: 4, User name: MichaelGaid, Email: michaelcharls.gaid@gmail.com, Number: 921633604, Address: michaelcharls.gaid@gmail.com, Status: Active, OTP code: 0, OTP verified: 0, Datetime created: 0000-00-00 00:00:00', '2024-01-15', '03:45:26'),
(174, 'admin', '1', 'The user has been retrieved', 'ID: 3, User name: JhonDeinielDiñoDo, Email: jhondeinieldote15@gmail.com, Number: 213131, Address: #78,P.TupazSt.DonaRosarioSubdNovalichesQue, Status: Inactive/Blocked, OTP code: 0, OTP verified: 0, Datetime created: 0000-00-00 00:00:00', '2024-01-15', '04:53:58'),
(175, 'admin', '1', 'The admin account has been move to archive', 'ID: 7, Admin User name: admin2, Email: jenmoto1@gmail.com, Age: 25,  Address: San Agustin, Novaliches', '2024-01-15', '06:44:08'),
(176, 'admin', '1', 'The admin account has been move to archive', 'ID: 8, Admin User name: admin3, Email: moto-jen30@gmail.com, Age: 30,  Address: San Agustin, Novaliches', '2024-01-15', '07:26:43'),
(177, 'admin', '1', 'The admin account has been retrieved', 'ID: 8, Admin User name: admin3, Email: moto-jen30@gmail.com, Age: 30,  Address: San Agustin, Novaliches', '2024-01-15', '07:30:03'),
(178, 'admin', '1', 'Registered a new admin account', 'ID: 9, Username: admin4, Email: joshuamhar05@gmail.com, Number: , Age: 22, Address: Gulod, Novaliches, Image: Admin-Pic-5677.png', '2024-01-15', '22:24:20'),
(181, 'admin', '1', 'Added new supplier', 'ID: 8, Supplier name: Maikuni Shop, Address: San Agustin, Novaliches, Contact number: 09253698741, Supplier Person: Jamil Carlo', '2024-01-15', '22:34:53'),
(182, 'admin', '1', 'Added new supplier', 'ID: 9, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09635478125, Supplier Person: Melvin Aguilla', '2024-01-15', '22:36:05'),
(184, 'admin', '1', 'Added new supplier.', 'ID: 11, Supplier name: SpeedMoto, Address: Sta. Lucia, Novaliches, Contact number: 09963568823, Supplier Person: Jenny De Guzman', '2024-01-15', '22:49:25'),
(185, 'admin', '1', 'The supplier has been moved to archive', 'ID: 11, Supplier name: SpeedMoto, Address: Sta. Lucia, Novaliches, Contact number: 09963568823, Supplier Person: Jenny De Guzman', '2024-01-15', '23:50:50'),
(186, 'admin', '1', 'The supplier has been moved to archive', 'ID: 9, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09635478125, Supplier Person: Melvin Aguilla', '2024-01-16', '00:53:48'),
(187, 'admin', '1', 'The service has been retrieved', 'ID: 17, Service name: Change Spark Plug, Price: ', '2024-01-16', '01:04:04'),
(188, 'admin', '1', 'The supplier has been moved to archive', 'ID: 8, Supplier name: Maikuni Shop, Address: San Agustin, Novaliches, Contact number: 09253698741, Supplier Person: Jamil Carlo', '2024-01-16', '01:05:51'),
(189, 'admin', '1', 'The service has been moved to archive', 'ID: 17, Service name: Change Spark Plug, Price: 0', '2024-01-16', '01:13:30'),
(190, 'admin', '1', 'The service has been deleted', 'ID: 17, Service Name: Change Spark Plug, Price: ', '2024-01-16', '01:13:53'),
(191, 'admin', '1', 'Added a service.', 'ID: 18, Services Name: Change Fork, Price: 250', '2024-01-16', '01:14:30'),
(192, 'admin', '1', 'The service has been moved to archive', 'ID: 18, Service name: Change Fork, Price: 250', '2024-01-16', '01:14:39'),
(193, 'admin', '1', 'The service has been retrieved', 'ID: 18, Service name: Change Fork, Price: ', '2024-01-16', '01:14:50'),
(194, 'admin', '1', 'The service has been moved to archive', 'ID: 18, Service name: Change Fork, Price: 250', '2024-01-16', '01:16:17'),
(195, 'admin', '1', 'The service has been retrieved', 'ID: 18, Service name: Change Fork, Price: ', '2024-01-16', '01:16:31'),
(196, 'admin', '1', 'The service has been moved to archive', 'ID: 18, Service name: Change Fork, Price: 250', '2024-01-16', '01:38:50'),
(197, 'admin', '1', 'The service has been retrieved', 'ID: 16, Service name: Change Clutch Cable, Price: 0', '2024-01-16', '01:39:03'),
(198, 'admin', '1', 'The service has been moved to archive', 'ID: 16, Service name: Change Clutch Cable, Price: 150', '2024-01-16', '01:39:31'),
(199, 'admin', '1', 'The service has been retrieved', 'ID: 18, Service name: Change Fork, Price: 250', '2024-01-16', '01:39:49'),
(200, 'admin', '1', 'The service has been moved to archive', 'ID: 18, Service name: Change Fork, Price: 250', '2024-01-16', '01:50:12'),
(201, 'admin', '1', 'The service has been deleted', 'ID: 18, Service Name: Change Fork, Price: ', '2024-01-16', '01:50:21'),
(202, 'admin', '1', 'Added new supplier.', 'ID: 12, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09125647381, Supplier Person: Jamil Santos', '2024-01-16', '02:11:01'),
(203, 'admin', '1', 'The supplier has been moved to archive', 'ID: 12, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09125647381, Supplier Person: Jamil Santos', '2024-01-16', '02:12:45'),
(204, 'admin', '1', 'The supplier has been moved to archive', 'ID: 5, Supplier name: MOTU Shop, Address: San Agustin, Novaliches, Contact number: 09280944031, Supplier Person: James Diaz', '2024-01-16', '02:13:13'),
(205, 'admin', '1', 'Added new supplier.', 'ID: 13, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09126758492, Supplier Person: Jamil Santos', '2024-01-16', '02:29:59'),
(206, 'admin', '1', 'The supplier has been moved to archive', 'ID: 13, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09126758492, Supplier Person: Jamil Santos', '2024-01-16', '02:30:09'),
(207, 'admin', '1', 'The supplier has been retrieved', 'ID: 13, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09126758492, Supplier Person: Jamil Santos', '2024-01-16', '02:45:35'),
(208, 'admin', '1', 'The supplier has been moved to archive', 'ID: 13, Supplier name: MotoSpeed, Address: Gulod, Novaliches, Contact number: 09126758492, Supplier Person: Jamil Santos', '2024-01-16', '02:45:54'),
(209, 'admin', '1', 'Added new supplier.', 'ID: 14, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09125670939, Supplier Person: Renz Umali', '2024-01-16', '02:46:44'),
(210, 'admin', '1', 'The supplier has been moved to archive', 'ID: 14, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09125670939, Supplier Person: Renz Umali', '2024-01-16', '02:46:57'),
(211, 'admin', '1', 'The supplier has been retrieved', 'ID: 14, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09125670939, Supplier Person: Renz Umali', '2024-01-16', '02:50:11'),
(212, 'admin', '1', 'The supplier has been moved to archive', 'ID: 14, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09125670939, Supplier Person: Renz Umali', '2024-01-16', '02:50:36'),
(213, 'admin', '1', 'The supplier has been deleted', 'ID: 14, Supplier name: NGK Shop, Address: Gulod, Novaliches, Contact number: 09125670939, Supplier Person: Renz Umali', '2024-01-16', '03:06:59'),
(214, 'admin', '1', 'Product has been moved to archive', 'ID: 29, Supplier ID: 4, Supplier Name: Robinsons, Product Name: Sample Plant, Price: 500, Image: 7.jpg, Category: Plant, Stock: 0', '2024-01-16', '06:38:39'),
(215, 'admin', '1', 'Product has been moved to archive', 'ID: 1, Supplier ID: 1, Supplier Name: SupplierName1, Product Name: Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B, Price: 1100, Image: Product-Motojen-7967.png, Category: battery, Stock: 1000', '2024-01-16', '07:39:46'),
(216, 'admin', '1', 'Product has been moved to retrieved', 'ID: 1, Supplier ID: 4, Supplier Name: Robinsons, Product Name: Sample Plant, Price: 500, Image: 7.jpg, Category: Plant, Stock: 0', '2024-01-16', '07:43:20'),
(217, 'admin', '1', 'Product has been moved to archive', 'ID: 36, Supplier ID: 4, Supplier Name: Robinsons, Product Name: Sample Plant, Price: 500, Image: 7.jpg, Category: Plant, Stock: 0', '2024-01-16', '07:43:48'),
(218, 'admin', '1', 'The user has been deleted', 'ID: , Supplier ID: , Supplier Name: , Product Name: , Price: , Image: , Category: , Stock: ', '2024-01-16', '07:47:12'),
(219, 'admin', '1', 'Add supplier product', '', '2024-01-16', '07:55:54'),
(220, 'admin', '1', 'Product has been moved to archive', 'Archived ID: 4, Supplier ID: 4, Supplier Name: Robinsons, Product Name: Domino Quick Throttle Racing with Cable, Price: 250, Image: Domino Quick Throttle Racing with Cable.png, Category: Throttle Cable, Stock: 0', '2024-01-16', '07:56:18'),
(221, 'admin', '1', 'Product has been moved to archive', 'Archived ID: 5, Supplier ID: 4, Supplier Name: Robinsons, Product Name: plantito, Price: 1, Image: , Category: plant, Stock: 1', '2024-01-16', '08:25:35'),
(222, 'admin', '1', 'Product has been moved to archive', 'Archived ID: 6, Supplier ID: 4, Supplier Name: Robinsons, Product Name: soil, Price: 0, Image: 7.jpg, Category: plant, Stock: 1', '2024-01-16', '08:27:28'),
(223, 'admin', '1', 'The user has been deleted', 'ID: 3, User Name: JhonDeinielDiñoDo, Email: jhondeinieldote15@gmail.com, Number: 213131, Address: #78,P.TupazSt.DonaRosarioSubdNovalichesQue, Status: Inactive/Blocked, OTP code: 0, Verified At: 0000-00-00 00:00:00', '2024-01-16', '09:27:28'),
(224, 'user', '34', 'Created an appointment.', '', '2024-01-17', '03:06:47'),
(225, 'user', '31', 'Created an appointment.', '', '2024-01-18', '00:56:12'),
(226, 'user', '31', 'Created an appointment.', '', '2024-01-18', '00:59:00'),
(227, 'user', '31', 'Created an appointment.', '', '2024-01-18', '00:59:47'),
(228, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:00:18'),
(229, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:20:39'),
(230, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:22:33'),
(231, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:24:44'),
(232, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:25:22'),
(233, 'user', '31', 'Created an appointment.', '', '2024-01-18', '01:37:46'),
(234, 'user', '31', 'Ordered Product.', '', '2024-01-18', '02:57:17'),
(235, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '04:34:13'),
(236, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '06:13:47'),
(237, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '06:16:26'),
(238, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '07:27:30'),
(239, 'user', '31', 'Created an appointment.', '', '2024-01-19', '08:37:36'),
(240, 'user', '31', 'Created an appointment.', '', '2024-01-19', '09:17:20'),
(241, 'user', '31', 'Created an appointment.', '', '2024-01-19', '09:27:45'),
(242, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '09:52:29'),
(243, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '10:01:54'),
(244, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '10:15:55'),
(245, 'user', '31', 'Created an appointment.', '', '2024-01-19', '10:16:44'),
(246, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '10:17:03'),
(247, 'user', '31', 'Created an appointment.', '', '2024-01-19', '10:18:14'),
(248, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '10:18:45'),
(249, 'user', '31', 'Created an appointment.', '', '2024-01-19', '10:33:21'),
(250, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '10:34:44'),
(251, 'user', '31', 'Created an appointment.', '', '2024-01-19', '12:05:06'),
(252, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '12:05:55'),
(253, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '12:21:10'),
(254, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '12:21:23'),
(255, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '12:21:32'),
(256, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:53'),
(257, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(258, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(259, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(260, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(261, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(262, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(263, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(264, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:23:54'),
(265, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '16:58:43'),
(266, 'user', '31', 'Created an appointment.', '', '2024-01-19', '19:40:42'),
(267, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '19:41:30'),
(268, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '19:42:07'),
(269, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '20:08:37'),
(270, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:20:59'),
(271, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '13:22:08'),
(272, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:39:45'),
(273, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:40:00'),
(274, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:40:33'),
(275, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:41:46'),
(276, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:42:14'),
(277, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:42:22'),
(278, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:46:52'),
(279, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:47:02'),
(280, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:47:24'),
(281, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:47:30'),
(282, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:49:30'),
(283, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:49:37'),
(284, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:51:09'),
(285, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:52:22'),
(286, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:54:58'),
(287, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:55:23'),
(288, 'user', '31', 'Created an appointment.', '', '2024-01-19', '13:56:48'),
(289, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-19', '13:57:08'),
(290, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '14:05:25'),
(291, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '14:07:54'),
(292, 'admin', '', 'Updated a status of an order.', '', '2024-01-19', '14:11:45'),
(293, 'admin', '1', 'The admin account has been move to archive', 'ID: 9, Admin User name: admin4, Email: joshuamhar05@gmail.com, Age: 22,  Address: Gulod, Novaliches', '2024-01-19', '19:38:43'),
(294, 'admin', '1', 'The admin account has been retrieved', 'ID: 9, Admin User name: admin4, Email: joshuamhar05@gmail.com, Age: 22,  Address: Gulod, Novaliches', '2024-01-19', '19:38:53'),
(295, 'user', '31', 'Created an appointment.', '', '2024-01-20', '00:38:07'),
(296, 'user', '31', 'Created an appointment.', '', '2024-01-20', '00:39:26'),
(297, 'admin', '1', 'Product has been moved to archive', 'ID: 82, Product Name: Motorcycle Stainless Bolts 6X16-1pc, Price: 5, Image: Product-Motojen-7664.png, Category: frame, Stock: 50', '2024-01-20', '00:46:33'),
(298, 'user', '35', 'Created an appointment.', '', '2024-01-20', '01:32:36'),
(299, 'admin', '1', 'Product has been moved to archive', 'ID: 14, Product Name: OD Battery Gel Type YTX9-BS(GEL TYPE) , Price: 1050, Image: Product-Motojen-4604.png, Category: battery, Stock: 47', '2024-01-20', '02:14:08'),
(300, 'admin', '1', 'The product has been retrieved', 'ID: 14, Product Name: OD Battery Gel Type YTX9-BS(GEL TYPE) , Price: 1050, Image: Product-Motojen-4604.png, Category: battery, Stock: 47', '2024-01-20', '02:14:33'),
(301, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-20', '02:19:13'),
(302, 'admin', '1', 'The supplier has been moved to archive', 'ID: 4, Supplier name: Robinsons, Address: sample address, Contact number: 09045618521, Supplier Person: Martin James', '2024-01-20', '02:21:49'),
(303, 'admin', '1', 'The supplier has been retrieved', 'ID: 4, Supplier name: Robinsons, Address: sample address, Contact number: 09045618521, Supplier Person: Martin James', '2024-01-20', '02:22:06'),
(304, 'admin', '1', 'Product has been moved to archive', 'Archived ID: 7, Supplier ID: 1, Supplier Name: SupplierName1, Product Name: Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  , Price: 1250, Image: Product-Motojen-7905.png, Category: battery, Stock: 50', '2024-01-20', '02:22:45'),
(305, 'user', '36', 'Created an appointment.', '', '2024-01-20', '02:35:21'),
(306, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-20', '02:41:25'),
(307, 'admin', '', 'Updated a status of an order.', '', '2024-01-20', '11:24:46'),
(308, 'admin', '', 'Updated a status of an order.', '', '2024-01-20', '13:00:24'),
(309, 'admin', '', 'Updated a status of an order.', '', '2024-01-20', '13:00:34'),
(310, 'admin', '', 'Updated a status of an order.', '', '2024-01-21', '00:34:57'),
(311, 'user', '31', 'Created an appointment.', '', '2024-01-21', '08:46:49'),
(312, 'user', '38', 'Created an appointment.', '', '2024-01-21', '08:57:38'),
(313, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:30:26'),
(314, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:30:40'),
(315, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:31:01'),
(316, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:31:13'),
(317, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:31:28'),
(318, 'user', '38', 'Created an appointment.', '', '2024-01-21', '15:46:37'),
(319, 'user', '38', 'Created an appointment.', '', '2024-01-21', '22:20:42'),
(320, 'user', '38', 'Created an appointment.', '', '2024-01-21', '22:46:19'),
(321, 'user', '38', 'Created an appointment.', '', '2024-01-21', '22:46:30'),
(322, 'user', '38', 'Created an appointment.', '', '2024-01-21', '22:46:44'),
(323, 'admin', '1', 'The user has been deleted', 'ID: 39, User Name: Akira_Seika, Email: joshuamhar1@gmail.com, Number: 9934410043, Address: Santa Lucia St, Status: Inactive/Blocked, OTP code: 166871, Verified At: 2024-01-21 23:31:30', '2024-01-21', '23:33:19'),
(324, 'admin', '1', 'The user has been deleted', 'ID: 40, User Name: Joshua Mhar Alcubilla , Email: joshuamhar1@gmail.com, Number: 9934410043, Address: Santa Lucia St, Status: Inactive/Blocked, OTP code: 232746, Verified At: 0000-00-00 00:00:00', '2024-01-21', '23:39:16'),
(325, 'admin', '1', 'The user has been deleted', 'ID: 43, User Name: Jojo , Email: joshuamhar1@gmail.com, Number: 9934410034, Address: Santa Lucia St, Status: Inactive/Blocked, OTP code: 930518, Verified At: 0000-00-00 00:00:00', '2024-01-22', '00:38:14'),
(326, 'admin', '1', 'The user has been deleted', 'ID: 42, User Name: Jhomar , Email: joshuamhar1@gmail.com, Number: 9934410043, Address: 9 J. P. Rizal, Status: Inactive/Blocked, OTP code: 286168, Verified At: 0000-00-00 00:00:00', '2024-01-22', '00:38:18'),
(327, 'admin', '1', 'The user has been deleted', 'ID: 41, User Name: Jhomar , Email: joshuamhar1@gmail.com, Number: 9934410043, Address: Santa Lucia St, Status: Inactive/Blocked, OTP code: 161388, Verified At: 0000-00-00 00:00:00', '2024-01-22', '00:38:22'),
(328, 'admin', '1', 'The user has been deleted', 'ID: 33, User Name: joshua, Email: joshuamhar1@gmail.com, Number: 9635241786, Address: novaliches, Status: Inactive/Blocked, OTP code: 301071, Verified At: 2024-01-16 22:26:22', '2024-01-22', '00:40:28'),
(329, 'user', '44', 'Created an appointment.', '', '2024-01-22', '00:53:04'),
(330, 'user', '44', 'Created an appointment.', '', '2024-01-22', '01:34:43'),
(331, 'user', '38', 'Created an appointment.', '', '2024-01-22', '10:15:55'),
(332, 'admin', '', 'Updated a status of an appointment.', '', '2024-01-22', '10:25:19'),
(333, 'admin', '', 'Updated a status of an order.', '', '2024-01-22', '10:26:01'),
(334, 'admin', '1', 'Added a service.', 'ID: 19, Services Name: Change Disk Brake, Price: 150', '2024-01-22', '10:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE `tbl_billing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` bigint(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(500) NOT NULL,
  `total_price` decimal(25,0) NOT NULL,
  `place_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_amount` int(50) NOT NULL,
  `proof_of_purchase` varchar(100) NOT NULL,
  `remaining_bal` int(25) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_billing`
--

INSERT INTO `tbl_billing` (`id`, `user_id`, `name`, `number`, `payment_method`, `address`, `total_products`, `total_price`, `place_on`, `payment_amount`, `proof_of_purchase`, `remaining_bal`, `payment_type`, `reference_no`, `order_status`) VALUES
(1, 26, 'Ayemimaw', 958612345, '', 'sample address', 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO  (900 x 1) - ', 900, '2023-11-18 20:38:39', 0, '', 0, '', '', 'Complete'),
(22, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'MRTR Chain & Sprocket CB110 (428H-120L) (480 x 10) - ', 4800, '2023-10-29 03:58:20', 0, '', 0, '', '', 'Complete'),
(23, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - Motolite MOTORCYCLE Battery ', 1800, '2023-10-30 17:07:35', 0, '', 0, '', '', 'Complete'),
(24, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B   (1100 x 1) - 4T Motor Oil 20W-50 (200 x', 1300, '2023-10-30 17:10:17', 0, '', 0, '', '', 'Complete'),
(25, 23, 'user', 958612345, '', 'sample address', '12 pcs Ti M5x16 Motorcycle Disc Brake Bolt Titanium Bolts Color (70 x 1) - Motolite MOTORCYCLE Batte', 1320, '2023-10-30 17:11:50', 0, '', 0, '', '', 'Cancelled'),
(26, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2023-10-30 17:13:54', 0, '', 0, '', '', 'Cancelled'),
(27, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B   (1100 x 1) - ', 1100, '2023-10-30 17:14:52', 0, '', 0, '', '', 'Cancelled'),
(28, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - Motolite MOTORCYCLE Battery', 2500, '2023-10-30 19:20:50', 0, '', 0, '', '', 'Cancelled'),
(29, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO  (900 x 1) - OD Battery Gel Type YTX4L-', 1650, '2023-11-22 21:54:13', 0, '', 0, '', '', 'Complete'),
(30, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2023-11-23 05:03:23', 0, '', 0, '', '', 'Complete'),
(31, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Nibbi Racing Throttle Cable (350 x 1) - ', 350, '2023-11-23 07:29:00', 0, '', 0, '', '', 'Complete'),
(32, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - OD Battery Gel Type YTX9-BS', 3550, '2024-01-05 00:43:55', 0, '', 0, '', '', 'Complete'),
(33, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Moto Depot Throttle Cable RXT135 1 Piece (120 x 1) - ', 120, '2024-01-05 17:42:19', 0, '', 0, '', '', 'Complete'),
(34, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Nibbi Racing Throttle Cable (350 x 2) - ', 700, '2024-01-05 17:51:09', 0, '', 0, '', '', 'Cancelled'),
(35, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B (1100 x 1) - ', 1100, '2024-01-05 18:01:44', 0, '', 0, '', '', 'Cancelled'),
(36, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Moto Depot Throttle Cable RXT135 1 Piece (120 x 1) - ', 120, '2024-01-05 18:20:15', 0, '', 0, '', '', 'Cancelled'),
(37, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Nibbi Racing Throttle Cable (350 x 2) - ', 700, '2024-01-05 18:36:51', 0, '', 0, '', '', 'Cancelled'),
(38, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Nibbi Racing Throttle Cable (350 x 1) - ', 350, '2024-01-05 18:57:14', 0, '', 0, '', '', 'Cancelled'),
(39, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Nibbi Racing Throttle Cable (350 x 4) - ', 1400, '2024-01-05 19:00:41', 0, '', 0, '', '', 'Complete'),
(40, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2024-01-05 19:54:54', 0, '', 0, '', '', 'Complete'),
(41, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2024-01-06 02:59:52', 0, '', 0, '', '', 'Cancelled'),
(42, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - Motolite MOTORCYCLE Battery', 125000, '2024-01-06 04:52:38', 0, '', 0, '', '', 'Cancelled'),
(43, 22, 'joshua', 9123456789, '', 'novaliches, quezon city', '2T Motor Oil SAE 30 (200 x 1) - 4T Motor Oil 20W-50 (200 x 1) - 4T Premium Multi-Grade Motor Oil 15W', 600, '2024-01-06 04:54:20', 0, '', 0, '', '', 'Cancelled'),
(44, 26, 'Ayemimaw', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - Motolite MOTORCYCLE Battery ', 1980, '2024-01-07 07:24:30', 0, '', 0, '', '', 'Cancelled'),
(45, 26, 'Ayemimaw', 958612345, '', 'sample address', 'Makoto bearing 6201 (30 x 2) - Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1', 1340, '2024-01-07 07:39:41', 0, '', 0, '', '', 'Cancelled'),
(46, 26, 'Ayemimaw', 958612345, '', 'sample address', 'Makoto bearing 6201 (30 x 1) - Makoto bearing 6203 (40 x 1) - ', 70, '2024-01-07 07:51:33', 0, '', 0, '', '', 'Cancelled'),
(47, 26, 'Ayemimaw', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2024-01-07 08:11:38', 0, '', 0, '', '', 'Cancelled'),
(48, 26, 'Ayemimaw', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2024-01-07 08:18:07', 0, '', 0, '', '', 'Cancelled'),
(49, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-18 02:57:17', 0, '', 0, '', '', 'Complete'),
(50, 31, 'joshua', 9123456963, '', 'novaliches', 'OD Battery Gel Type YB2.5L-BS(STX/BAJAJ)  (550 x 1) - ', 550, '2024-01-19 05:18:43', 0, '', 0, '', '', 'Pending'),
(51, 31, 'joshua', 9123456963, '', 'novaliches', 'NGK Spark Plug D8EA (150 x 1) - OD Battery Gel Type YTX9-BS(GEL TYPE)  (1050 x 1) - ', 1200, '2024-01-19 05:27:34', 0, '', 0, '', '', 'Complete'),
(52, 31, 'joshua', 9123456963, '', 'novaliches', 'Motul 10W40 4T Scooter Engine Oil 1L All Suzuki Scooter Model (370 x 1) - ', 370, '2024-01-19 05:29:13', 0, '', 0, '', '', 'Complete'),
(53, 31, 'joshua', 9123456963, '', 'novaliches', 'Nibbi Racing Throttle Cable (350 x 1) - ', 350, '2024-01-19 09:51:15', 0, '', 0, '', '', 'Complete'),
(54, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-19 10:01:33', 0, '', 0, '', '', 'Complete'),
(55, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-19 17:43:23', 0, '', 0, '', '', 'Pending'),
(56, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-20 14:15:39', 0, '', 0, '', '', 'pending'),
(57, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-20 14:20:53', 0, '', 0, '', '', 'pending'),
(58, 31, 'joshua', 9123456963, '', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-20 14:32:36', 0, '', 0, '', '', 'pending'),
(59, 31, 'joshua', 9123456963, 'Gcash', 'novaliches', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-20 14:41:12', 350, 'Uservalid-Pic757.jpeg', 350, 'Down', '10015467876', 'pending'),
(61, 38, 'Joshua Mhar Alcubilla', 0, 'Gcash', '9 J. P. Rizal', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-21 00:32:32', 700, 'Uservalid-Pic1310.jpg', 0, 'Full', '1001264237483', 'Complete'),
(62, 38, 'Joshua Mhar Alcubilla', 0, 'Gcash', '9 J. P. Rizal', 'Nibbi Racing Throttle Cable (350 x 1) - ', 350, '2024-01-21 22:41:27', 350, 'Uservalid-Pic9459.jpg', 0, 'Full', '1001345345632', 'pending'),
(63, 38, 'Joshua Mhar Alcubilla', 0, 'Gcash', '9 J. P. Rizal', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - ', 700, '2024-01-22 11:06:51', 700, 'Uservalid-Pic1826.jpg', 0, 'Full', '1001345278345', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `product_category` varchar(150) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `product_id`, `product_category`, `name`, `price`, `quantity`, `image`) VALUES
(34, 6, 5, '', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 1, 'Product-Motojen-7905.png'),
(39, 6, 4, '', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B  ', 1100, 1, 'Product-Motojen-7967.png'),
(66, 22, 1, '', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 1, 'Product-Motojen-7905.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(25,0) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_stock` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `product_price`, `image`, `product_category`, `product_stock`) VALUES
(1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 329),
(8, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B ', 700, 'Product-Motojen-7362.png', 'battery', 21),
(9, 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO ', 900, 'Product-Motojen-6996.png', 'battery', 38),
(10, 'OD Battery Gel Type YB2.5L-BS(STX/BAJAJ) ', 550, 'Product-Motojen-738.png', 'battery', 48),
(11, 'OD Battery Gel Type YTX4L-BS ', 750, 'Product-Motojen-2733.png', 'battery', 49),
(12, 'OD Battery Gel Type 12N5L-BS(MIO) ', 750, 'Product-Motojen-4500.png', 'battery', 50),
(13, 'OD Battery Gel Type 12N6.5L-BS(China) ', 750, 'Product-Motojen-7327.png', 'battery', 50),
(14, 'OD Battery Gel Type YTX9-BS(GEL TYPE) ', 1050, 'Product-Motojen-4604.png', 'battery', 47),
(16, '4T Motor Oil 20W-50', 200, 'Product-Motojen-2013.png', 'oil', 48),
(17, '4T Premium Multi-Grade Motor Oil 15W-40', 200, 'Product-Motojen-2941.png', 'oil', 48),
(18, '4T Premium Multi-Grade Scooter Motor Oil 10W-40', 220, 'Product-Motojen-5751.png', 'oil', 49),
(19, 'Motul 10W40 4T Scooter Engine Oil 1L All Suzuki Scooter Model', 370, 'Product-Motojen-9891.png', 'oil', 49),
(20, 'Motul 3000 plus 10w40', 280, 'Product-Motojen-9238.png', 'oil', 50),
(21, 'Zic Fully Synthetic Motorcycle Oil 10W-40 and 10W-50', 270, 'Product-Motojen-1435.png', 'oil', 50),
(22, 'Mobil Super Moto 10W-40 4T Synthetic Technology Motorcycle Engine Oil 800 ml', 250, 'Product-Motojen-3482.png', 'oil', 50),
(23, 'Mobil Super Moto 10W-40 4T Synthetic Technology Motorcycle Engine Oil 1 Liter', 300, 'Product-Motojen-4735.png', 'oil', 50),
(24, 'Mobil Super Moto SAE 20W-40 Premium Technology Motorcycle Oil 1 Liter', 300, 'Product-Motojen-1478.png', 'oil', 50),
(25, 'GOODYEAR MOTORCYCLE FUERZA 4T 10W40 800ML Premium Mineral', 20, 'Product-Motojen-823.png', 'oil', 50),
(26, 'GOODYEAR MOTORCYCLE FUERZA 4T 20W50 800ML Premium Mineral', 200, 'Product-Motojen-8299.png', 'oil', 49),
(27, 'RAIMOL FLASH1 4T Scoot 20W-40 4T 0.8L', 165, 'Product-Motojen-2699.png', 'oil', 50),
(28, 'RAIMOL FLASH1 Gold 10W-40 4T 1L', 250, 'Product-Motojen-7771.png', 'oil', 50),
(29, 'Makoto bearing 6201', 30, 'Product-Motojen-9111.png', 'Bearing', 46),
(31, 'Makoto bearing 6203', 40, 'Product-Motojen-1754.png', 'Bearing', 49),
(32, 'Makoto bearing 6301', 45, 'Product-Motojen-8087.png', 'Bearing', 50),
(33, 'Makoto bearing 6302', 50, 'Product-Motojen-5805.png', 'engine', 50),
(34, 'Makoto bearing 6303', 55, 'Product-Motojen-7069.png', 'engine', 50),
(35, 'NSK bearing 6201', 30, 'Product-Motojen-4755.png', 'engine', 49),
(36, 'NSK bearing 6202', 35, 'Product-Motojen-270.png', 'engine', 50),
(37, 'NSK bearing 6203', 40, 'Product-Motojen-7341.png', 'engine', 50),
(38, 'NSK bearing 6301', 45, 'Product-Motojen-33.png', 'engine', 50),
(39, 'NSK bearing 6302 ', 50, 'Product-Motojen-8998.png', 'engine', 50),
(40, 'NSK bearing 6303', 55, 'Product-Motojen-756.png', 'engine', 50),
(41, '3 shoe clutch lining RED for 63cc 71cc Stand up scooter 49cc pocket bike Mini ATV', 250, 'Product-Motojen-2774.png', 'engine', 50),
(42, 'OEM Clutch lining/Wave washer for 49cc Stand up Scooter (No Brand)', 220, 'Product-Motojen-5678.png', 'engine', 50),
(43, 'TAKASAGO CLUTCH STEEL PLATE CT100', 100, 'Product-Motojen-3130.png', 'engine', 50),
(44, 'MRTR Clutch lining set TMX', 100, 'Product-Motojen-6889.png', 'engine', 50),
(45, 'FX Clutch Lining Set for TMX 155 (5 Pcs)', 160, 'Product-Motojen-2745.png', 'engine', 50),
(46, 'GRS Clutch Lining Kawasaki Wind 125', 150, 'Product-Motojen-7309.png', 'engine', 50),
(47, '2 shoe clutch lining 49cc 63cc 71cc clutch ', 370, 'Product-Motojen-5249.png', 'engine', 50),
(48, 'Takamoto Clutch Lining Set for XRM 110/WAVE100 (4pcs)', 150, 'Product-Motojen-9453.png', 'engine', 50),
(49, 'NGK Spark Plug C7HSA', 100, 'Product-Motojen-9701.png', 'engine', 50),
(50, 'NGK Spark Plug D8EA', 150, 'Product-Motojen-2113.png', 'engine', 49),
(51, 'NGK Spark Plug BP6ES', 100, 'Product-Motojen-2476.png', 'engine', 50),
(52, 'Bosch Spark Plug WSR6F', 80, 'Product-Motojen-3483.png', 'engine', 50),
(53, 'Bosch Spark Plug D8EA ', 100, 'Product-Motojen-3051.png', 'engine', 50),
(54, 'Bosch Spark Plug UR2CC', 200, 'Product-Motojen-6859.png', 'engine', 50),
(55, 'Bosch Spark Plug ID9RP-7', 400, 'Product-Motojen-9253.png', 'engine', 50),
(56, 'Bosch Spark Plug ID10N-7', 400, 'Product-Motojen-7771.png', 'engine', 50),
(57, 'TAKAMOTO Rear Sprocket 34T', 260, 'Product-Motojen-1629.png', 'engine', 49),
(58, 'TAKAMOTO Rear Sprocket 36T', 260, 'Product-Motojen-6982.png', 'engine', 50),
(59, 'TAKAMOTO Rear Sprocket 38T', 270, 'Product-Motojen-3622.png', 'engine', 50),
(60, 'TAKAMOTO Rear Sprocket 40T', 280, 'Product-Motojen-8494.png', 'engine', 50),
(61, 'TAKAMOTO Rear Sprocket 45T', 310, 'Product-Motojen-5294.png', 'engine', 50),
(62, 'TAKAMOTO Chain and Sprocket 14T/38T x 110L', 500, 'Product-Motojen-8443.png', 'engine', 50),
(63, 'TAKAMOTO Chain and Sprocket 15T/38T x 110L', 500, 'Product-Motojen-126.png', 'engine', 50),
(64, 'TAKAMOTO Chain and Sprocket 16T/38T x 110L', 500, 'Product-Motojen-2594.png', 'engine', 50),
(65, 'TAKAMOTO Chain and Sprocket 14T/40T x 110L', 550, 'Product-Motojen-6961.png', 'engine', 50),
(66, 'TAKAMOTO Chain and Sprocket 15T/40T x 110L', 550, 'Product-Motojen-2113.png', 'engine', 50),
(67, 'TAKAMOTO Chain and Sprocket 16T/40T x 110L', 550, 'Product-Motojen-473.png', 'engine', 50),
(68, 'MRTR Chain & Sprocket CB110 (428H-120L)', 480, 'Product-Motojen-9534.png', 'engine', 40),
(69, 'MRTR Chain & Sprocket Sniper 150 (428H-130L) 38T/14T', 500, 'Product-Motojen-6814.png', 'engine', 50),
(70, 'MRTR Chain & Sprocket Sniper 150 (428H-130L) 43T/14T', 550, 'Product-Motojen-3596.png', 'engine', 50),
(71, 'MRTR Chain & Sprocket BARAKO/BC175 (428H-110L) 14T-42T', 500, 'Product-Motojen-3015.png', 'engine', 50),
(72, 'MAKOTO Timing Chain 124L Raider 150', 300, 'Product-Motojen-987.png', 'engine', 50),
(73, 'DID Drive Chain 428H-DS', 400, 'Product-Motojen-3658.png', 'engine', 50),
(74, 'Rubber Windshield Nut Body Motorcycle Bike Windscreen Bolt Screw Set', 180, 'Product-Motojen-9161.png', 'frame', 50),
(75, '12 pcs Ti M5x16 Motorcycle Disc Brake Bolt Titanium Bolts Color', 70, 'Product-Motojen-8728.png', 'frame', 49),
(76, '10 pcs M6 6MM Flange Bolt Hexagonal Motor Bolts Motorcycle Nut', 60, 'Product-Motojen-547.png', 'frame', 50),
(77, '10 pcs M5 Motorcycle Fairing Body Spring Bolts Nuts Spire Speed Fastener Red', 150, 'Product-Motojen-7878.png', 'frame', 50),
(78, '10 pcs M5 Motorcycle Fairing Body Spring Bolts Nuts Spire Speed Fastener Gold', 170, 'Product-Motojen-1720.png', 'frame', 50),
(79, '10 pcs M5 Motorcycle Fairing Body Spring Bolts Nuts Spire Speed Fastener Blue', 150, 'Product-Motojen-5166.png', 'frame', 50),
(80, 'Motorcycle Stainless Bolts 5.5X14.5-1pc', 5, 'Product-Motojen-259.png', 'frame', 50),
(81, 'Motorcycle Stainless Bolts 5.5X15-1pc', 5, 'Product-Motojen-9058.png', 'frame', 40),
(83, 'Motorcycle Stainless Bolts 6X20-1pc', 6, 'Product-Motojen-5712.png', 'frame', 50),
(86, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 500),
(88, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 400),
(90, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 500),
(91, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 499),
(110, 'Nibbi Racing Throttle Cable', 350, 'Nibbi Racing Throttle Cable.png', 'Throttle Cable', 88),
(111, 'Moto Depot Throttle Cable RXT135 1 Piece', 120, 'Moto Depot Throttle Cable RXT135 1 Piece.png', 'Throttle Cable', 53),
(113, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_buy_count`
--

CREATE TABLE `tbl_product_buy_count` (
  `id` int(11) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_buy_count` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_buy_count`
--

INSERT INTO `tbl_product_buy_count` (`id`, `product_category`, `product_buy_count`) VALUES
(1, 'battery', 115),
(2, 'Bearing', 75),
(3, 'engine', 1001),
(4, 'frame', 60),
(5, 'oil', 302),
(6, 'Throttle Cable', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `services_name` varchar(100) NOT NULL,
  `services_price` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `services_name`, `services_price`) VALUES
(1, 'Check-up', 0),
(2, 'Tune-up', 150),
(3, 'carborador cleaning', 100),
(4, 'change oil', 30),
(5, 'change seat cover with seat cover set', 250),
(6, 'electrical repair', 400),
(7, 'cleaning', 200),
(8, 'PALIT TAMBUCHO', 800),
(9, 'engine repair', 1000),
(10, 'changing breakpad', 200),
(12, 'Replace Bulb', 20),
(19, 'Change Disk Brake', 150);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services_archived`
--

CREATE TABLE `tbl_services_archived` (
  `id` int(11) NOT NULL,
  `services_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `services_price` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_services_archived`
--

INSERT INTO `tbl_services_archived` (`id`, `services_name`, `services_price`) VALUES
(16, 'Change Clutch Cable', 150);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(100) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `contact_no`, `contact_person`) VALUES
(1, 'SupplierName1', 'sample address', '09561234564', 'sample contact'),
(2, 'SupplierName2', 'sample address2', 'sample contact2', 'sample contact2'),
(3, 'MotorShopCo', 'sample address', '09045618521', 'Richard Perez'),
(4, 'Robinsons', 'sample address', '09045618521', 'Martin James');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_archived`
--

CREATE TABLE `tbl_supplier_archived` (
  `supplier_id` int(100) NOT NULL,
  `supplier_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_person` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_supplier_archived`
--

INSERT INTO `tbl_supplier_archived` (`supplier_id`, `supplier_name`, `supplier_address`, `contact_no`, `contact_person`) VALUES
(13, 'MotoSpeed', 'Gulod, Novaliches', '09126758492', 'Jamil Santos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_products`
--

CREATE TABLE `tbl_supplier_products` (
  `tbl_id` int(11) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(25,0) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier_products`
--

INSERT INTO `tbl_supplier_products` (`tbl_id`, `supplier_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) VALUES
(3, 2, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 3000),
(4, 1, 'Sample Product 1 ', 150, 'Product-Motojen-7830.png', 'Tool', 250),
(5, 2, 'Sample Product 2 ', 400, 'Product-Motojen-7830.png', 'Picture', 600),
(7, 4, 'Nmax 550', 26000, 'Product-Motojen-7830.png', 'Motor', 300),
(30, 4, 'Nibbi Racing Throttle Cable', 350, 'Nibbi Racing Throttle Cable.png', 'Throttle Cable', 400),
(31, 4, 'AIRBLADE 150 Throttle Cable', 280, 'AIRBLADE 150 THROTTLE CABLE.png', 'Throttle Cable', 150),
(33, 4, 'Moto Depot Throttle Cable RXT135 1 Piece', 120, 'Moto Depot Throttle Cable RXT135 1 Piece.png', 'Throttle Cable', 95),
(34, 3, 'Domino Quick Throttle Racing with Cable', 210, 'Domino Quick Throttle Racing with Cable.png', 'Throttle Cable', 240),
(40, 4, 'halaman', 2, '370267563_336410315741475_1424135733426935708_n.jpg', 'plant', 1),
(41, 4, 'cable', 1, 'Nibbi Racing Throttle Cable.png', 'cable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_products_archived`
--

CREATE TABLE `tbl_supplier_products_archived` (
  `tbl_id` int(11) NOT NULL,
  `supplier_id` int(100) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` decimal(25,0) NOT NULL,
  `product_image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_supplier_products_archived`
--

INSERT INTO `tbl_supplier_products_archived` (`tbl_id`, `supplier_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) VALUES
(2, 1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 1000),
(4, 4, 'Domino Quick Throttle Racing with Cable', 250, 'Domino Quick Throttle Racing with Cable.png', 'Throttle Cable', 0),
(5, 4, 'plantito', 1, '', 'plant', 1),
(6, 4, 'soil', 0, '7.jpg', 'plant', 1),
(7, 1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 50);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `number` bigint(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `otp_code` int(6) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `number`, `address`, `status`, `otp_code`, `email_verified_at`) VALUES
(1, 'motojen_user1', 'motojen_user1@gmail.com', '8eba222291146e829e0748eeaea0b839', 2147483647, 'asdfghj', 'Active', 0, '0000-00-00 00:00:00'),
(2, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 320300303, 'asdfghj', 'Active', 0, '0000-00-00 00:00:00'),
(26, 'Ayemimaw', 'jen@gmail.com', '$2y$10$rIKsBrfU1NWHnCVe2jlWA.gHsUXg5fo7W18OWxli2aIxrqiOxMply', 958612345, 'sample address', 'Active', 0, '0000-00-00 00:00:00'),
(31, 'joshua', 'joshuamhar05@gmail.com', '$2y$10$a7rYuIAF/yvfjT1sK5Ev1ODtnjDku5d3qK/IZEXC9t6QD.p4jfJzO', 9123456963, 'novaliches', 'Active', 134603, '2024-01-16 21:59:50'),
(34, 'joshua', 'uekiaki3@gmail.com', '$2y$10$KbDQTJlsXAIml0Zh0MreF..S.vefc9maNDAsqVFFP9R1TCZryHKwC', 9635287412, 'novaliches', 'Active', 293554, '2024-01-16 23:55:45'),
(35, 'joshua', 'micflores44@gmail.com', '$2y$10$D28W3zMfEggOMwjGY6N0T.dvu./J/kFH7/4RnRHx5PWSLvn.V6x0i', 9934410043, 'Novaliches Proper', 'Active', 257025, '2024-01-20 01:14:05'),
(36, 'Akira_Seika', 'kathbgomez@gmail.com', '$2y$10$KRymbFKYTlgQcNbaCaCvo./P2jlwVUKA9G8dkNrO8Vu0waNp7ks7W', 9037474781, '9 J. P. Rizal', 'Active', 793776, '2024-01-20 02:33:13'),
(38, 'Joshua Mhar Alcubilla', 'jmhar.alcubilla1@gmail.com', '$2y$10$eLCRhKGOVhDt8edlZJmoV.PWDZP9lLn8AZn6ad5XtfUMvRBIKy9P6', 9934460945, '9 J. P. Rizal', 'Active', 338679, '2024-01-20 22:58:16'),
(44, 'Jojo', 'joshuamhar1@gmail.com', '$2y$10$2t8xXgX82qyG0arHd9JNDesxBQHJ5taswy1RQPEBAqpLhxaCeqk7q', 9934410034, '9 J. P. Rizal', 'Active', 668502, '2024-01-22 00:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_archived`
--

CREATE TABLE `tbl_user_archived` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` bigint(11) NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Inactive/Blocked',
  `otp_code` int(6) NOT NULL,
  `email_verified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user_archived`
--

INSERT INTO `tbl_user_archived` (`id`, `name`, `email`, `password`, `number`, `address`, `status`, `otp_code`, `email_verified_at`) VALUES
(4, 'MichaelGaid', 'michaelcharls.gaid@gmail.com', '2d3c57e517fa3f2f525f2727e3dd6f51', 921633604, 'michaelcharls.gaid@gmail.com', 'Inactive/Blocked', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `totalincome`
-- (See below for the actual view)
--
CREATE TABLE `totalincome` (
`January` decimal(47,0)
,`February` decimal(47,0)
,`March` decimal(47,0)
,`April` decimal(47,0)
,`May` decimal(47,0)
,`June` decimal(47,0)
,`July` decimal(47,0)
,`August` decimal(47,0)
,`September` decimal(47,0)
,`October` decimal(47,0)
,`November` decimal(47,0)
,`December` decimal(47,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `users`
-- (See below for the actual view)
--
CREATE TABLE `users` (
`name` varchar(100)
,`email` varchar(100)
,`number` bigint(11)
,`address` varchar(255)
,`status` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `notifications`
--
DROP TABLE IF EXISTS `notifications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`localhost`@`127.0.0.1` SQL SECURITY DEFINER VIEW `notifications`  AS SELECT 'Appointments' AS `Title`, `tbl_appointment`.`appointment_date` AS `appointment_date` FROM `tbl_appointment` WHERE cast(`tbl_appointment`.`appointment_date` as date) = curdate()union select 'ProductOrder' AS `Title`,`tbl_billing`.`place_on` AS `place_on` from `tbl_billing` where cast(`tbl_billing`.`place_on` as date) = curdate()  ;

-- --------------------------------------------------------

--
-- Structure for view `productstockchart`
--
DROP TABLE IF EXISTS `productstockchart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`localhost`@`127.0.0.1` SQL SECURITY DEFINER VIEW `productstockchart`  AS SELECT `tbl_product`.`product_category` AS `product_category`, sum(`tbl_product`.`product_stock`) AS `ProductStockCount` FROM `tbl_product` GROUP BY `tbl_product`.`product_category` ;

-- --------------------------------------------------------

--
-- Structure for view `totalincome`
--
DROP TABLE IF EXISTS `totalincome`;

CREATE ALGORITHM=UNDEFINED DEFINER=`localhost`@`127.0.0.1` SQL SECURITY DEFINER VIEW `totalincome`  AS SELECT sum(case when month(`tbl_billing`.`place_on`) = 1 then `tbl_billing`.`total_price` else 0 end) AS `January`, sum(case when month(`tbl_billing`.`place_on`) = 2 then `tbl_billing`.`total_price` else 0 end) AS `February`, sum(case when month(`tbl_billing`.`place_on`) = 3 then `tbl_billing`.`total_price` else 0 end) AS `March`, sum(case when month(`tbl_billing`.`place_on`) = 4 then `tbl_billing`.`total_price` else 0 end) AS `April`, sum(case when month(`tbl_billing`.`place_on`) = 5 then `tbl_billing`.`total_price` else 0 end) AS `May`, sum(case when month(`tbl_billing`.`place_on`) = 6 then `tbl_billing`.`total_price` else 0 end) AS `June`, sum(case when month(`tbl_billing`.`place_on`) = 7 then `tbl_billing`.`total_price` else 0 end) AS `July`, sum(case when month(`tbl_billing`.`place_on`) = 8 then `tbl_billing`.`total_price` else 0 end) AS `August`, sum(case when month(`tbl_billing`.`place_on`) = 9 then `tbl_billing`.`total_price` else 0 end) AS `September`, sum(case when month(`tbl_billing`.`place_on`) = 10 then `tbl_billing`.`total_price` else 0 end) AS `October`, sum(case when month(`tbl_billing`.`place_on`) = 11 then `tbl_billing`.`total_price` else 0 end) AS `November`, sum(case when month(`tbl_billing`.`place_on`) = 12 then `tbl_billing`.`total_price` else 0 end) AS `December` FROM `tbl_billing` WHERE year(`tbl_billing`.`place_on`) = year(curdate()) AND `tbl_billing`.`order_status` = 'Complete' ;

-- --------------------------------------------------------

--
-- Structure for view `users`
--
DROP TABLE IF EXISTS `users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`localhost`@`127.0.0.1` SQL SECURITY DEFINER VIEW `users`  AS SELECT `tbl_user`.`name` AS `name`, `tbl_user`.`email` AS `email`, `tbl_user`.`number` AS `number`, `tbl_user`.`address` AS `address`, `tbl_user`.`status` AS `status` FROM `tbl_user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_archived`
--
ALTER TABLE `tbl_admin_archived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_archived`
--
ALTER TABLE `tbl_archived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_audit_trail`
--
ALTER TABLE `tbl_audit_trail`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_buy_count`
--
ALTER TABLE `tbl_product_buy_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services_archived`
--
ALTER TABLE `tbl_services_archived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_supplier_archived`
--
ALTER TABLE `tbl_supplier_archived`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_supplier_products`
--
ALTER TABLE `tbl_supplier_products`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_supplier_products_archived`
--
ALTER TABLE `tbl_supplier_products_archived`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_archived`
--
ALTER TABLE `tbl_user_archived`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_admin_archived`
--
ALTER TABLE `tbl_admin_archived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `tbl_archived`
--
ALTER TABLE `tbl_archived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_audit_trail`
--
ALTER TABLE `tbl_audit_trail`
  MODIFY `audit_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `tbl_product_buy_count`
--
ALTER TABLE `tbl_product_buy_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_services_archived`
--
ALTER TABLE `tbl_services_archived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_supplier_archived`
--
ALTER TABLE `tbl_supplier_archived`
  MODIFY `supplier_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_supplier_products`
--
ALTER TABLE `tbl_supplier_products`
  MODIFY `tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_supplier_products_archived`
--
ALTER TABLE `tbl_supplier_products_archived`
  MODIFY `tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_user_archived`
--
ALTER TABLE `tbl_user_archived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
