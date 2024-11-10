-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2023 at 03:11 PM
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
-- Database: `motojen_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `spGetAppSlots` (IN `appDate` DATE)   WITH morningCount AS 
(
    SELECT COUNT(*) as morningApp FROM `tbl_appointment` WHERE `appointment_type` = 'morning' AND 					DATE(appointment_date) = appDate
)
,afternoonCount AS(
    SELECT COUNT(*) as afternoonApp FROM `tbl_appointment` WHERE `appointment_type` = 'afternoon' AND 				DATE(appointment_date) = appDate
)
SELECT
	mc.morningApp,
    ac.afternoonApp
FROM morningCount mc
CROSS JOIN afternoonCount ac$$

CREATE PROCEDURE `spGetSalesReport` (IN `startDate` VARCHAR(50), IN `endDate` VARCHAR(50))   SELECT
	SUM(total_price) AS Total
FROM tbl_billing 
WHERE order_status = 'Complete' AND place_on BETWEEN startDate AND endDate$$

CREATE PROCEDURE `spGetServicesReport` (IN `startDate` VARCHAR(50), IN `endDate` VARCHAR(50))   SELECT SUM(total_cost) As Total FROM tbl_appointment WHERE status = 'complete' AND appointment_started BETWEEN startDate AND endDate$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `dashboardcards`
-- (See below for the actual view)
--
CREATE TABLE `dashboardcards` (
`TotalSales` decimal(47,0)
,`Users` bigint(21)
,`Orders` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `notifications`
-- (See below for the actual view)
--
CREATE TABLE `notifications` (
`Title` varchar(12)
,`appointment_date` datetime
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
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'emmanuel.david.lopez30@gmail.com', '9058600196', 23, 'address 1', 'Product-Motojen-270.png'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'jen@gmail.com', '', 1, 'sample address', 'Admin-Pic-5677.png '),
(5, 'sample', 'ee11cbb19052e40b07aac0ca060c23ee', 'jen@gmail.com', '', 12, 'sample address', 'Product-Motojen-547.png ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `services_name` varchar(500) NOT NULL,
  `appointment_date` date NOT NULL DEFAULT current_timestamp(),
  `appointment_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `total_cost` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`id`, `user_id`, `services_name`, `appointment_date`, `appointment_type`, `status`, `total_cost`) VALUES
(14, 2, 'tune up', '2023-11-16', 'morning', 'Pending', 150),
(15, 2, 'tune up', '2023-11-16', 'morning', 'pending', 150),
(16, 4, 'tune up', '2023-11-16', 'morning', 'pending', 153),
(17, 6, 'change oil', '2023-11-16', 'afternoon', 'pending', 30),
(19, 6, 'change seat cover with seat cover set', '2023-11-16', 'morning', 'complete', 250),
(20, 6, 'electrical repair', '2023-11-16', 'morning', 'pending', 400),
(21, 6, 'cleaning', '2023-11-16', '', 'pending', 200),
(22, 22, 'carborador cleaning', '2023-10-29', '', 'pending', 100),
(32, 26, 'carborador cleaning tune up change oil ', '2023-11-19', 'morning', 'Pending', 280),
(33, 26, 'PALIT TAMBUCHO,change seat cover with seat cover set,electrical repair,', '2023-11-19', 'afternoon', 'Pending', 2450),
(38, 26, 'PALIT TAMBUCHO,cleaning,electrical repair,', '2023-11-19', 'morning', 'Pending', 2400);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_trail`
--

CREATE TABLE `tbl_audit_trail` (
  `audit_id` int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
(68, 'user', '26', 'Created an appointment.', '', '2023-11-19', '00:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE `tbl_billing` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` bigint(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(25) NOT NULL,
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
(1, 26, 'Ayemimaw', 958612345, 'Gcash', 'sample address', 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO  (900 x 1) - ', 900, '2023-11-18 20:38:39', 900, 'Uservalid-Pic9108.jpg', 0, 'Full', '12345678913654521', 'pending'),
(22, 22, 'joshua', 9123456789, 'pickup', 'novaliches, quezon city', 'MRTR Chain & Sprocket CB110 (428H-120L) (480 x 10) - ', 4800, '2023-10-29 03:58:20', 4800, 'Uservalid-Pic5997.jpg', 0, '', '', 'Complete'),
(23, 23, 'user', 958612345, '', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B  (700 x 1) - Motolite MOTORCYCLE Battery ', 1800, '2023-10-30 17:07:35', 0, '', 1800, 'Full', '', 'Complete'),
(24, 23, 'user', 958612345, 'pickup', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B   (1100 x 1) - 4T Motor Oil 20W-50 (200 x', 1300, '2023-10-30 17:10:17', 0, '', 1300, 'Full', '', 'Complete'),
(25, 23, 'user', 958612345, 'paytm', 'sample address', '12 pcs Ti M5x16 Motorcycle Disc Brake Bolt Titanium Bolts Color (70 x 1) - Motolite MOTORCYCLE Batte', 1320, '2023-10-30 17:11:50', 0, 'Uservalid-Pic1755.jpg', 1320, 'Full', '12345678913654521', 'Cancelled'),
(26, 23, 'user', 958612345, 'Gcash', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - ', 1250, '2023-10-30 17:13:54', 1000, 'Uservalid-Pic2635.jpg', 250, 'Down', '12345678913654521', 'Cancelled'),
(27, 23, 'user', 958612345, 'Maya', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B   (1100 x 1) - ', 1100, '2023-10-30 17:14:52', 1000, 'Uservalid-Pic2613.jpg', 100, 'Down', '12345678913654521', 'Cancelled'),
(28, 23, 'user', 958612345, 'Gcash', 'sample address', 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B   (1250 x 1) - Motolite MOTORCYCLE Battery', 2500, '2023-10-30 19:20:50', 2000, 'Uservalid-Pic1153.png', 500, 'Down', '12345678913654521', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `product_id`, `name`, `price`, `quantity`, `image`) VALUES
(34, 6, 5, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 1, 'Product-Motojen-7905.png'),
(39, 6, 4, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B  ', 1100, 1, 'Product-Motojen-7967.png'),
(42, 22, 9, 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO ', 900, 1, 'Product-Motojen-6996.png'),
(43, 22, 11, 'OD Battery Gel Type YTX4L-BS ', 750, 1, 'Product-Motojen-2733.png'),
(44, 26, 8, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B ', 700, 1, 'Product-Motojen-7362.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_stock` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `product_price`, `image`, `product_category`, `product_stock`) VALUES
(1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 250),
(8, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF4L-B ', 700, 'Product-Motojen-7362.png', 'battery', 47),
(9, 'YUASA BATTERY YTX4L-BS MOTORCYCLE BATTERY (MF4L-B) SPEEDMOTO ', 900, 'Product-Motojen-6996.png', 'battery', 39),
(10, 'OD Battery Gel Type YB2.5L-BS(STX/BAJAJ) ', 550, 'Product-Motojen-738.png', 'battery', 50),
(11, 'OD Battery Gel Type YTX4L-BS ', 750, 'Product-Motojen-2733.png', 'battery', 50),
(12, 'OD Battery Gel Type 12N5L-BS(MIO) ', 750, 'Product-Motojen-4500.png', 'battery', 50),
(13, 'OD Battery Gel Type 12N6.5L-BS(China) ', 750, 'Product-Motojen-7327.png', 'battery', 50),
(14, 'OD Battery Gel Type YTX9-BS(GEL TYPE) ', 1050, 'Product-Motojen-4604.png', 'battery', 49),
(15, '2T Motor Oil SAE 30', 200, 'Product-Motojen-8277.png', 'oil', 49),
(16, '4T Motor Oil 20W-50', 200, 'Product-Motojen-2013.png', 'oil', 49),
(17, '4T Premium Multi-Grade Motor Oil 15W-40', 200, 'Product-Motojen-2941.png', 'oil', 49),
(18, '4T Premium Multi-Grade Scooter Motor Oil 10W-40', 220, 'Product-Motojen-5751.png', 'oil', 50),
(19, 'Motul 10W40 4T Scooter Engine Oil 1L All Suzuki Scooter Model', 370, 'Product-Motojen-9891.png', 'oil', 50),
(20, 'Motul 3000 plus 10w40', 280, 'Product-Motojen-9238.png', 'oil', 50),
(21, 'Zic Fully Synthetic Motorcycle Oil 10W-40 and 10W-50', 270, 'Product-Motojen-1435.png', 'oil', 50),
(22, 'Mobil Super Moto 10W-40 4T Synthetic Technology Motorcycle Engine Oil 800 ml', 250, 'Product-Motojen-3482.png', 'oil', 50),
(23, 'Mobil Super Moto 10W-40 4T Synthetic Technology Motorcycle Engine Oil 1 Liter', 300, 'Product-Motojen-4735.png', 'oil', 50),
(24, 'Mobil Super Moto SAE 20W-40 Premium Technology Motorcycle Oil 1 Liter', 300, 'Product-Motojen-1478.png', 'oil', 50),
(25, 'GOODYEAR MOTORCYCLE FUERZA 4T 10W40 800ML Premium Mineral', 20, 'Product-Motojen-823.png', 'oil', 50),
(26, 'GOODYEAR MOTORCYCLE FUERZA 4T 20W50 800ML Premium Mineral', 200, 'Product-Motojen-8299.png', 'oil', 49),
(27, 'RAIMOL FLASH1 4T Scoot 20W-40 4T 0.8L', 165, 'Product-Motojen-2699.png', 'oil', 50),
(28, 'RAIMOL FLASH1 Gold 10W-40 4T 1L', 250, 'Product-Motojen-7771.png', 'oil', 50),
(29, 'Makoto bearing 6201', 30, 'Product-Motojen-9111.png', 'engine', 50),
(31, 'Makoto bearing 6203', 40, 'Product-Motojen-1754.png', 'engine', 50),
(32, 'Makoto bearing 6301', 45, 'Product-Motojen-8087.png', 'engine', 50),
(33, 'Makoto bearing 6302', 50, 'Product-Motojen-5805.png', 'engine', 50),
(34, 'Makoto bearing 6303', 55, 'Product-Motojen-7069.png', 'engine', 50),
(35, 'NSK bearing 6201', 30, 'Product-Motojen-4755.png', 'engine', 50),
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
(50, 'NGK Spark Plug D8EA', 150, 'Product-Motojen-2113.png', 'engine', 50),
(51, 'NGK Spark Plug BP6ES', 100, 'Product-Motojen-2476.png', 'engine', 50),
(52, 'Bosch Spark Plug WSR6F', 80, 'Product-Motojen-3483.png', 'engine', 50),
(53, 'Bosch Spark Plug D8EA ', 100, 'Product-Motojen-3051.png', 'engine', 50),
(54, 'Bosch Spark Plug UR2CC', 200, 'Product-Motojen-6859.png', 'engine', 50),
(55, 'Bosch Spark Plug ID9RP-7', 400, 'Product-Motojen-9253.png', 'engine', 50),
(56, 'Bosch Spark Plug ID10N-7', 400, 'Product-Motojen-7771.png', 'engine', 50),
(57, 'TAKAMOTO Rear Sprocket 34T', 260, 'Product-Motojen-1629.png', 'engine', 50),
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
(81, 'Motorcycle Stainless Bolts 5.5X15-1pc', 5, 'Product-Motojen-9058.png', 'frame', 50),
(82, 'Motorcycle Stainless Bolts 6X16-1pc', 5, 'Product-Motojen-7664.png', 'frame', 50),
(83, 'Motorcycle Stainless Bolts 6X20-1pc', 6, 'Product-Motojen-5712.png', 'frame', 50),
(84, '1', 1100, 'Product-Motojen-7967.png', 'battery', 1),
(85, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 1),
(86, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 500),
(87, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 12),
(88, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 400),
(89, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 300),
(90, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 500),
(91, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 500),
(92, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 500),
(93, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 1000),
(94, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 1000),
(95, 'Nmax 550', 26000, 'Product-Motojen-7830.png', 'Motor', 200),
(108, 'Sample Plant', 500, '7.jpg', 'Plant', 500),
(109, 'Sample Plant', 500, '7.jpg', 'Plant', 500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `services_name` varchar(100) NOT NULL,
  `services_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `services_name`, `services_price`) VALUES
(2, 'tune up', 150),
(3, 'carborador cleaning', 100),
(4, 'change oil', 30),
(5, 'change seat cover with seat cover set', 250),
(6, 'electrical repair', 400),
(7, 'cleaning', 200),
(8, 'PALIT TAMBUCHO', 1800);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
-- Table structure for table `tbl_supplier_products`
--

CREATE TABLE `tbl_supplier_products` (
  `tbl_id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `supplier_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(25) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier_products`
--

INSERT INTO `tbl_supplier_products` (`tbl_id`, `supplier_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) VALUES
(1, 1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF7A-B', 1100, 'Product-Motojen-7967.png', 'battery', 1000),
(2, 1, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF9-B  ', 1250, 'Product-Motojen-7905.png', 'battery', 500),
(3, 2, 'Motolite MOTORCYCLE Battery (VRLA Maintenance Free) MF5L-B ', 800, 'Product-Motojen-7830.png', 'battery', 3000),
(4, 1, 'Sample Product 1 ', 150, 'Product-Motojen-7830.png', 'Tool', 250),
(5, 2, 'Sample Product 2 ', 400, 'Product-Motojen-7830.png', 'Picture', 600),
(7, 4, 'Nmax 550', 26000, 'Product-Motojen-7830.png', 'Motor', 300),
(29, 4, 'Sample Plant', 500, '7.jpg', 'Plant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `number` bigint(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `otp_code` int(6) DEFAULT NULL,
  `otp_verified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `number`, `address`, `status`, `otp_code`, `otp_verified`) VALUES
(1, 'motojen_user1', 'motojen_user1@gmail.com', '8eba222291146e829e0748eeaea0b839', 2147483647, 'asdfghj', 'Active', NULL, 0),
(2, 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 320300303, 'asdfghj', 'Active', NULL, 0),
(3, 'JhonDeinielDiñoDo', 'jhondeinieldote15@gmail.com', '202cb962ac59075b964b07152d234b70', 213131, '#78,P.TupazSt.DonaRosarioSubdNovalichesQue', 'Active', NULL, 0),
(4, 'MichaelGaid', 'michaelcharls.gaid@gmail.com', '2d3c57e517fa3f2f525f2727e3dd6f51', 921633604, 'michaelcharls.gaid@gmail.com', 'Active', NULL, 0),
(22, 'joshua', 'joshuamhar05@gmail.com', '$2y$10$CQJZGbJxf5Lh449kJwAqxOAVm/y1LVjtdk3wMwvswNpf0fUZlEld6', 9123456789, 'novaliches, quezon city', 'Active', NULL, 0),
(26, 'Ayemimaw', 'jen@gmail.com', '$2y$10$rIKsBrfU1NWHnCVe2jlWA.gHsUXg5fo7W18OWxli2aIxrqiOxMply', 958612345, 'sample address', 'Active', NULL, 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `totalincome`
-- (See below for the actual view)
--
CREATE TABLE `totalincome` (
`January` decimal(46,0)
,`February` decimal(46,0)
,`March` decimal(46,0)
,`April` decimal(46,0)
,`May` decimal(46,0)
,`June` decimal(46,0)
,`July` decimal(46,0)
,`August` decimal(46,0)
,`September` decimal(46,0)
,`October` decimal(46,0)
,`November` decimal(46,0)
,`December` decimal(46,0)
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
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `verification_id` int(11) NOT NULL,
  `UserId` varchar(100) NOT NULL,
  `VerificationCode` varchar(50) NOT NULL,
  `Expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`verification_id`, `UserId`, `VerificationCode`, `Expiration`) VALUES
(1, 'admin', '989925', '2023-11-13 23:36:53'),
(2, 'sample', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Structure for view `notifications`
--
DROP TABLE IF EXISTS `notifications`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u572443248_motojen`@`154.56.38.42` SQL SECURITY DEFINER VIEW `notifications`  AS SELECT 'Appointments' AS `Title`, `tbl_appointment`.`appointment_date` AS `appointment_date` FROM `tbl_appointment` WHERE cast(`tbl_appointment`.`appointment_date` as date) = curdate()union select 'ProductOrder' AS `Title`,`tbl_billing`.`place_on` AS `place_on` from `tbl_billing` where cast(`tbl_billing`.`place_on` as date) = curdate()  ;

-- --------------------------------------------------------

--
-- Structure for view `productstockchart`
--
DROP TABLE IF EXISTS `productstockchart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u572443248_motojen`@`154.56.38.42` SQL SECURITY DEFINER VIEW `productstockchart`  AS SELECT `tbl_product`.`product_category` AS `product_category`, sum(`tbl_product`.`product_stock`) AS `ProductStockCount` FROM `tbl_product` GROUP BY `tbl_product`.`product_category` ;

-- --------------------------------------------------------

--
-- Structure for view `totalincome`
--
DROP TABLE IF EXISTS `totalincome`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u572443248_motojen`@`154.56.38.42` SQL SECURITY DEFINER VIEW `totalincome`  AS SELECT sum(case when month(`tbl_billing`.`place_on`) = 1 then `tbl_billing`.`total_price` else 0 end) AS `January`, sum(case when month(`tbl_billing`.`place_on`) = 2 then `tbl_billing`.`total_price` else 0 end) AS `February`, sum(case when month(`tbl_billing`.`place_on`) = 3 then `tbl_billing`.`total_price` else 0 end) AS `March`, sum(case when month(`tbl_billing`.`place_on`) = 4 then `tbl_billing`.`total_price` else 0 end) AS `April`, sum(case when month(`tbl_billing`.`place_on`) = 5 then `tbl_billing`.`total_price` else 0 end) AS `May`, sum(case when month(`tbl_billing`.`place_on`) = 6 then `tbl_billing`.`total_price` else 0 end) AS `June`, sum(case when month(`tbl_billing`.`place_on`) = 7 then `tbl_billing`.`total_price` else 0 end) AS `July`, sum(case when month(`tbl_billing`.`place_on`) = 8 then `tbl_billing`.`total_price` else 0 end) AS `August`, sum(case when month(`tbl_billing`.`place_on`) = 9 then `tbl_billing`.`total_price` else 0 end) AS `September`, sum(case when month(`tbl_billing`.`place_on`) = 10 then `tbl_billing`.`total_price` else 0 end) AS `October`, sum(case when month(`tbl_billing`.`place_on`) = 11 then `tbl_billing`.`total_price` else 0 end) AS `November`, sum(case when month(`tbl_billing`.`place_on`) = 12 then `tbl_billing`.`total_price` else 0 end) AS `December` FROM `tbl_billing` WHERE year(`tbl_billing`.`place_on`) = year(curdate()) AND `tbl_billing`.`order_status` = 'Complete' ;

-- --------------------------------------------------------

--
-- Structure for view `users`
--
DROP TABLE IF EXISTS `users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u572443248_motojen`@`154.56.38.42` SQL SECURITY DEFINER VIEW `users`  AS SELECT `tbl_user`.`name` AS `name`, `tbl_user`.`email` AS `email`, `tbl_user`.`number` AS `number`, `tbl_user`.`address` AS `address`, `tbl_user`.`status` AS `status` FROM `tbl_user` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
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
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_supplier_products`
--
ALTER TABLE `tbl_supplier_products`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_audit_trail`
--
ALTER TABLE `tbl_audit_trail`
  MODIFY `audit_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_supplier_products`
--
ALTER TABLE `tbl_supplier_products`
  MODIFY `tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
