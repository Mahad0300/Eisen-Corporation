-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2026 at 08:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eisen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_bids`
--

CREATE TABLE `auction_bids` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `max_bid_amount` decimal(12,2) NOT NULL,
  `status` enum('Pending Confirmation','Bid Confirmed','Won','Lost') NOT NULL DEFAULT 'Pending Confirmation',
  `placed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auction_bids`
--

INSERT INTO `auction_bids` (`id`, `user_id`, `vehicle_id`, `max_bid_amount`, `status`, `placed_at`) VALUES
(1, 2, 3, 35000.00, 'Bid Confirmed', '2026-06-04 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `outcome` enum('Reached','Not Reached','Scheduled Callback') NOT NULL,
  `notes` text NOT NULL,
  `next_action` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consignees`
--

CREATE TABLE `consignees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `consignee_name` varchar(100) DEFAULT NULL,
  `consignee_country` varchar(50) DEFAULT NULL,
  `consignee_state` varchar(50) DEFAULT NULL,
  `consignee_city` varchar(100) DEFAULT NULL,
  `consignee_address` text DEFAULT NULL,
  `consignee_ref_address` text DEFAULT NULL,
  `consignee_phone_1` varchar(30) DEFAULT NULL,
  `consignee_phone_2` varchar(30) DEFAULT NULL,
  `consignee_phone_3` varchar(30) DEFAULT NULL,
  `consignee_email_1` varchar(100) DEFAULT NULL,
  `consignee_email_2` varchar(100) DEFAULT NULL,
  `consignee_email_3` varchar(100) DEFAULT NULL,
  `notify_name` varchar(100) DEFAULT NULL,
  `notify_country` varchar(50) DEFAULT NULL,
  `notify_state` varchar(50) DEFAULT NULL,
  `notify_city` varchar(100) DEFAULT NULL,
  `notify_address` text DEFAULT NULL,
  `notify_ref_address` text DEFAULT NULL,
  `notify_phone_1` varchar(30) DEFAULT NULL,
  `notify_phone_2` varchar(30) DEFAULT NULL,
  `notify_phone_3` varchar(30) DEFAULT NULL,
  `notify_email_1` varchar(100) DEFAULT NULL,
  `notify_email_2` varchar(100) DEFAULT NULL,
  `notify_email_3` varchar(100) DEFAULT NULL,
  `notify_same` tinyint(1) DEFAULT 0,
  `permanent` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consignees`
--

INSERT INTO `consignees` (`id`, `user_id`, `consignee_name`, `consignee_country`, `consignee_state`, `consignee_city`, `consignee_address`, `consignee_ref_address`, `consignee_phone_1`, `consignee_phone_2`, `consignee_phone_3`, `consignee_email_1`, `consignee_email_2`, `consignee_email_3`, `notify_name`, `notify_country`, `notify_state`, `notify_city`, `notify_address`, `notify_ref_address`, `notify_phone_1`, `notify_phone_2`, `notify_phone_3`, `notify_email_1`, `notify_email_2`, `notify_email_3`, `notify_same`, `permanent`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tariq Mahmood Consignee', 'PAKISTAN', 'SINDH', 'KARACHI', 'Plot 45-C, Lane 2, DHA Phase 6', NULL, '+92', '300', '1234567', 'tariq.consignee@example.com', NULL, NULL, 'Tariq Mahmood Consignee', 'PAKISTAN', 'SINDH', 'KARACHI', 'Plot 45-C, Lane 2, DHA Phase 6', NULL, '+92', '300', '1234567', 'tariq.consignee@example.com', NULL, NULL, 1, 1, '2026-06-05 17:01:35', '2026-06-05 17:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `category` enum('Comfort & Convenience','Dress Up','Exterior','Safety','Other') NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `category`, `label`) VALUES
(1, 'Comfort & Convenience', 'Air Conditioner'),
(2, 'Comfort & Convenience', 'Audio Player'),
(3, 'Comfort & Convenience', 'Navigation System'),
(4, 'Comfort & Convenience', 'Power Steering'),
(5, 'Comfort & Convenience', 'Power Window All'),
(6, 'Comfort & Convenience', 'Push Start'),
(7, 'Comfort & Convenience', 'Steering Switch'),
(8, 'Comfort & Convenience', 'ACC'),
(9, 'Comfort & Convenience', 'Both Power Slide Door'),
(10, 'Comfort & Convenience', 'Cooler'),
(11, 'Comfort & Convenience', 'Cruise Control'),
(12, 'Comfort & Convenience', 'Double Air Conditioner'),
(13, 'Comfort & Convenience', 'Left Side Power Slide Door'),
(14, 'Comfort & Convenience', 'Paddle Shift'),
(15, 'Comfort & Convenience', 'Power Back Door'),
(16, 'Comfort & Convenience', 'Power Seat'),
(17, 'Comfort & Convenience', 'Power Window Driver'),
(18, 'Comfort & Convenience', 'Power Window Front'),
(19, 'Dress Up', 'Alloy Wheels'),
(20, 'Dress Up', 'Aero Front'),
(21, 'Dress Up', 'Aero Rear'),
(22, 'Dress Up', 'Aero Side'),
(23, 'Dress Up', 'Grill Guard'),
(24, 'Dress Up', 'Rear Spoiler'),
(25, 'Dress Up', 'Wood Combination Steering'),
(26, 'Exterior', 'LED Light'),
(27, 'Exterior', 'Carrier Base'),
(28, 'Exterior', 'Roof Box'),
(29, 'Exterior', 'Roof Carrier'),
(30, 'Exterior', 'Roof Rails'),
(31, 'Exterior', 'Sun Roof'),
(32, 'Exterior', 'Double Sun Roof'),
(33, 'Exterior', 'Glass Roof'),
(34, 'Exterior', 'Fog Light'),
(35, 'Exterior', 'HID Light'),
(36, 'Exterior', 'High Roof'),
(37, 'Exterior', 'New Shape'),
(38, 'Exterior', 'Slide Glass'),
(39, 'Safety', 'Air Bag'),
(40, 'Safety', 'Back Camera'),
(41, 'Safety', 'ABS'),
(42, 'Safety', 'Around View Monitor'),
(43, 'Safety', 'Front Camera'),
(44, 'Safety', 'Side Camera'),
(45, 'Safety', 'Corner Sensor'),
(46, 'Safety', 'ESC'),
(47, 'Other', 'Auto Door'),
(48, 'Other', 'Back Tire'),
(49, 'Other', 'Just Low'),
(50, 'Other', 'Half Leather Seat'),
(51, 'Other', 'Leather Seat'),
(52, 'Other', 'Same Tire'),
(53, 'Other', 'Side Lift Up Seat'),
(54, 'Other', 'Sloper');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `payment_type` enum('Full Car Payment','Auction Deposit','Auction Balance','Refund') NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` enum('USD','JPY') NOT NULL DEFAULT 'USD',
  `payment_method` varchar(50) NOT NULL DEFAULT 'Bank Wire',
  `bank_reference` varchar(100) NOT NULL,
  `status` enum('Pending','Confirmed','Refunded') NOT NULL DEFAULT 'Pending',
  `invoice_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `vehicle_id`, `payment_type`, `amount`, `currency`, `payment_method`, `bank_reference`, `status`, `invoice_url`, `created_at`) VALUES
(1, 2, 4, 'Full Car Payment', 48900.00, 'USD', 'Bank Wire', 'TXN-98124801', 'Confirmed', NULL, '2026-05-15 05:00:00'),
(2, 2, 1, 'Auction Deposit', 5000.00, 'USD', 'Bank Wire', 'TXN-10294711', 'Confirmed', NULL, '2026-05-20 09:30:00'),
(3, 2, 1, 'Auction Balance', 24800.00, 'USD', 'Bank Wire', 'TXN-10295822', 'Pending', NULL, '2026-06-01 04:15:00'),
(4, 2, 2, 'Auction Deposit', 200000.00, 'JPY', 'Bank Wire', 'TXN-77284102', 'Confirmed', NULL, '2026-05-25 06:20:00'),
(5, 2, 2, 'Full Car Payment', 980000.00, 'JPY', 'Bank Wire', 'TXN-77284103', 'Confirmed', NULL, '2026-05-26 10:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `status` enum('Pending Call','Contacted - Awaiting Wire Deposit','Deposit Received - Booking Locked','Released') NOT NULL DEFAULT 'Pending Call',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `vehicle_id`, `agent_id`, `expires_at`, `status`, `created_at`) VALUES
(1, 2, 1, NULL, '2026-06-15 12:00:00', 'Contacted - Awaiting Wire Deposit', '2026-06-05 07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `security_deposits`
--

CREATE TABLE `security_deposits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `requested_limit` decimal(12,2) NOT NULL,
  `slip_url` varchar(255) NOT NULL,
  `status` enum('Pending Verification','Approved','Rejected') NOT NULL DEFAULT 'Pending Verification',
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `security_deposits`
--

INSERT INTO `security_deposits` (`id`, `user_id`, `amount`, `requested_limit`, `slip_url`, `status`, `rejection_reason`, `created_at`) VALUES
(1, 2, 300.00, 3000.00, 'slips/wire_receipt.jpg', 'Approved', NULL, '2026-06-05 17:01:35'),
(2, 2, 70000.00, 700000.00, 'slips/wire_receipt_jpy.jpg', 'Approved', NULL, '2026-06-05 17:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `bl_number` varchar(50) NOT NULL,
  `vessel_name` varchar(100) NOT NULL,
  `etd` date NOT NULL,
  `eta` date NOT NULL,
  `status` enum('Preparing','Dispatched','At Port','Delivered') NOT NULL DEFAULT 'Preparing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `vehicle_id`, `bl_number`, `vessel_name`, `etd`, `eta`, `status`, `created_at`) VALUES
(1, 4, 'BL-EISEN-89104', 'HOEGH TRACER', '2026-05-20', '2026-06-18', 'Dispatched', '2026-06-05 17:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','finance_officer','caller_agent','registered_buyer','inventory_manager') NOT NULL DEFAULT 'registered_buyer',
  `account_type` enum('Individual Buyer','Corporate Buyer','Inventory Manager') NOT NULL DEFAULT 'Individual Buyer',
  `phone` varchar(25) DEFAULT NULL,
  `whatsapp` varchar(25) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `destination_port` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `preferred_currency` enum('USD','JPY') NOT NULL DEFAULT 'USD',
  `asf_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `newsletter_subscribed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `password`, `role`, `account_type`, `phone`, `whatsapp`, `address`, `address2`, `city`, `state`, `zip`, `country`, `destination_port`, `company_name`, `preferred_currency`, `asf_confirmed`, `newsletter_subscribed`, `created_at`, `updated_at`) VALUES
(1, 'Eisen Admin', 'Eisen', 'Admin', 'admin@eisen.com', '$2y$10$YljMlKRq4LS5DPkKgK24t.6BjfXsHizNVlfrjklvtz14EUZ/t.B5O', 'admin', 'Individual Buyer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 0, 0, '2026-06-04 20:41:47', '2026-06-05 17:01:35'),
(2, 'Tariq Mahmood', 'Tariq', 'Mahmood', 'tariq.m@example.com', '$2y$10$ypBtuD9hXU2rB9r7Qs1IVeaH8R4pg6GbMz3npIgqWBlXubn0CFS4O', 'registered_buyer', 'Individual Buyer', NULL, NULL, 'Flat 204, Premium Apartments', NULL, 'Karachi', 'Sindh', '75500', 'PAKISTAN', 'KARACHI', NULL, 'USD', 0, 0, '2026-06-04 20:41:47', '2026-06-05 17:01:35'),
(3, 'Muhammad Zain', 'Muhammad', 'Zain', 'imuhammadzain01@gmail.com', '$2y$10$xWE9zOKkmyc7yf7uBsHBjuQRLXLlKponrIFZeJNCqhFS0GffsKWlm', 'registered_buyer', 'Individual Buyer', '+92 3442882239', '+92 3442882239', NULL, NULL, NULL, NULL, NULL, 'PAKISTAN', NULL, NULL, 'USD', 1, 1, '2026-06-04 21:08:55', '2026-06-05 17:01:35'),
(4, 'test', 'test', '', 'akamaanullah02@gmail.com', '$2y$10$itRtgavz5mJNMyLMPVp/MOOwxkabZ.BAURtGMyXBAIv9L9dqykzh6', 'registered_buyer', 'Individual Buyer', '+92 123465798', '+92 123465798', NULL, NULL, NULL, NULL, NULL, 'KENYA', NULL, NULL, 'USD', 1, 1, '2026-06-04 21:20:44', '2026-06-05 17:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `stock_id` varchar(30) NOT NULL,
  `chassis_number` varchar(50) NOT NULL,
  `type` enum('In-Stock','Auction') NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `grade` varchar(15) NOT NULL,
  `mileage_km` int(11) NOT NULL,
  `engine_cc` int(11) NOT NULL,
  `transmission` enum('AT','MT') NOT NULL DEFAULT 'AT',
  `steering` enum('RHD','LHD') NOT NULL DEFAULT 'RHD',
  `fuel` enum('PETROL','DIESEL','HYBRID','ELECTRIC') NOT NULL DEFAULT 'PETROL',
  `doors` int(11) NOT NULL DEFAULT 5,
  `seats` int(11) NOT NULL DEFAULT 5,
  `location` varchar(100) NOT NULL DEFAULT 'KOBE, JAPAN',
  `color` varchar(30) NOT NULL DEFAULT 'White',
  `body_type` varchar(50) NOT NULL,
  `drive_type` varchar(30) NOT NULL,
  `fob_price` decimal(12,2) NOT NULL,
  `freight_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `vanning_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `inspection_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `insurance_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cf_price` decimal(12,2) DEFAULT NULL,
  `damage_report_url` varchar(255) DEFAULT NULL,
  `status` enum('Available','Reserved','Reservation Expired','Payment Pending','Payment Received','Shipping In Progress','Delivered','Sold') NOT NULL DEFAULT 'Available',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `arrival_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dimension` varchar(50) NOT NULL DEFAULT '0.00m × 0.00m × 0.00m',
  `m3` varchar(20) NOT NULL DEFAULT '10.167',
  `description` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `price_jpy` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `stock_id`, `chassis_number`, `type`, `make`, `model`, `year`, `grade`, `mileage_km`, `engine_cc`, `transmission`, `steering`, `fuel`, `doors`, `seats`, `location`, `color`, `body_type`, `drive_type`, `fob_price`, `freight_price`, `vanning_price`, `inspection_price`, `insurance_price`, `cf_price`, `damage_report_url`, `status`, `featured`, `arrival_date`, `created_at`, `updated_at`, `dimension`, `m3`, `description`, `views`, `price_jpy`) VALUES
(1, 'ST-2094', 'RU3-1204928', 'In-Stock', 'Honda', 'Vezel EX-L', 2023, '5.0', 14200, 1500, 'AT', 'RHD', 'HYBRID', 5, 5, 'KOBE, JAPAN', 'Pearl White', 'SUV', '2WD', 29800.00, 1200.00, 200.00, 450.00, 50.00, 31700.00, NULL, 'Available', 1, '2026-06-15', '2026-06-04 21:34:46', '2026-06-04 22:40:49', '0.00m × 0.00m × 0.00m', '10.167', NULL, 0, 4470000.00),
(2, 'ST-2095', 'NHP10-2394851', 'In-Stock', 'Toyota', 'Aqua Hybrid', 2022, '4.5', 21500, 1500, 'AT', 'RHD', 'HYBRID', 5, 5, 'YOKOHAMA, JAPAN', 'Blue Metallic', 'Hatchback', '2WD', 22400.00, 1100.00, 200.00, 450.00, 50.00, 24200.00, NULL, 'Available', 1, NULL, '2026-06-04 21:34:46', '2026-06-04 22:40:49', '0.00m × 0.00m × 0.00m', '10.167', NULL, 0, 3360000.00),
(3, 'AUC-9824', 'WBA5A31000K29', 'Auction', 'BMW', '5 Series', 2021, '4.0', 32800, 2000, 'AT', 'RHD', 'PETROL', 4, 5, 'USS Tokyo, Japan', 'Black', 'Sedan', '2WD', 32200.00, 1500.00, 0.00, 500.00, 100.00, 34300.00, NULL, 'Available', 1, '2026-06-08', '2026-06-04 21:34:46', '2026-06-04 22:40:49', '0.00m × 0.00m × 0.00m', '10.167', NULL, 0, 4830000.00),
(4, 'ST-2096', 'WDD21300412A', 'In-Stock', 'Mercedes-Benz', 'E-Class E200', 2022, '4.5', 18400, 2000, 'AT', 'RHD', 'PETROL', 4, 5, 'KOBE, JAPAN', 'Silver', 'Sedan', '2WD', 48900.00, 1400.00, 200.00, 450.00, 80.00, 51030.00, NULL, 'Sold', 1, NULL, '2026-06-04 21:34:47', '2026-06-04 22:40:49', '0.00m × 0.00m × 0.00m', '10.167', NULL, 0, 7335000.00),
(5, 'AUC-9825', 'WA1BUAFY4N210', 'Auction', 'Audi', 'Q5 Premium', 2022, 'R (Repaired)', 45100, 2000, 'AT', 'RHD', 'PETROL', 5, 5, 'USS Osaka, Japan', 'Grey Metallic', 'SUV', '4WD', 34500.00, 1400.00, 0.00, 450.00, 60.00, 36410.00, NULL, 'Available', 1, '2026-06-10', '2026-06-04 21:34:47', '2026-06-05 00:21:59', '0.00m × 0.00m × 0.00m', '10.167', NULL, 3, 5175000.00),
(8, 'ST-2953', 'test1231', 'In-Stock', 'test', 'test', 2000, 'g', 5000, 5000, 'AT', 'RHD', 'PETROL', 4, 6, 'KOBE, JAPAN', 'White', 'Hatchback', '2wd', 5000.00, 1200.00, 0.00, 450.00, 50.00, 6700.00, NULL, 'Available', 0, NULL, '2026-06-04 22:18:28', '2026-06-05 00:02:20', '0.00m × 0.00m × 0.00m', '10.167', '2022 Audi Q5 Premium ek luxury compact SUV hai jo apni elegant design aur powerful performance ki wajah se bohot pasand ki jaati hai. Isme 2.0-liter turbocharged 4-cylinder engine hai jo 261 horsepower aur 273 lb-ft torque produce karta hai, aur 7-speed automatic transmission ke saath milkar yeh car sirf 5.9 seconds mein 0-60 mph tak pohonch jaati hai. Quattro all-wheel drive system is car ki pehchaan hai jo har mausam aur har road pe zabardast grip aur stability deta hai. Interior ki baat karein toh iska cabin bilkul premium feel deta hai — leather seats, 10.1-inch MMI touchscreen, Audi Virtual Cockpit (12.3-inch digital instrument cluster), aur dual-zone automatic climate control jaise features ise andar se bhi ek luxury experience banate hain. Safety ke lihaz se bhi yeh car kisi se kam nahi — forward collision warning, automatic emergency braking, lane departure warning, aur blind spot monitoring jaise advance safety features standard milte hain. Fuel economy ki baat karein toh yeh city mein 23 mpg aur highway pe 28 mpg deti hai jo is class mein reasonable hai. Kul mila ke 2022 Audi Q5 Premium un logon ke liye ek perfect choice hai jo style, comfort, performance aur safety — sab ek saath chahte hain, aur woh bhi ek mid-range luxury budget mein.', 25, 750000.00);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_favorites`
--

CREATE TABLE `vehicle_favorites` (
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_favorites`
--

INSERT INTO `vehicle_favorites` (`user_id`, `vehicle_id`, `created_at`) VALUES
(1, 3, '2026-06-04 22:27:35'),
(1, 4, '2026-06-04 22:27:35'),
(1, 5, '2026-06-04 22:27:35'),
(2, 2, '2026-06-05 17:01:35'),
(2, 5, '2026-06-05 17:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_images`
--

CREATE TABLE `vehicle_images` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_images`
--

INSERT INTO `vehicle_images` (`id`, `vehicle_id`, `image_url`, `sort_order`) VALUES
(1, 1, 'photo-1606664515524-ed2f786a0bd6', 0),
(2, 1, 'photo-1549317661-bd32c8ce0db2', 1),
(3, 1, 'photo-1552519507-da3b142c6e3d', 2),
(4, 2, 'photo-1549317661-bd32c8ce0db2', 0),
(5, 2, 'photo-1618843479313-40f8afb4b4d8', 1),
(6, 3, 'photo-1503376780353-7e6692767b70', 0),
(7, 3, 'photo-1553440569-bcc63803a83d', 1),
(8, 4, 'photo-1618843479313-40f8afb4b4d8', 0),
(9, 4, 'photo-1492144534655-ae79c964c9d7', 1),
(10, 5, 'photo-1606664515524-ed2f786a0bd6', 0),
(11, 5, 'photo-1552519507-da3b142c6e3d', 1),
(37, 8, '/public/uploads/vehicles/img_ST-2953_3_1780611508.png', 0),
(38, 8, '/public/uploads/vehicles/img_ST-2953_1_1780611508.png', 1),
(39, 8, '/public/uploads/vehicles/img_ST-2953_2_1780611508.png', 2),
(40, 8, '/public/uploads/vehicles/img_ST-2953_4_1780611508.png', 3),
(41, 8, '/public/uploads/vehicles/img_ST-2953_0_1780611508.png', 4),
(42, 8, '/public/uploads/vehicles/img_ST-2953_5_1780611508.jpg', 5),
(43, 8, '/public/uploads/vehicles/img_ST-2953_6_1780611508.png', 6),
(44, 8, '/public/uploads/vehicles/img_ST-2953_7_1780611508.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_options`
--

CREATE TABLE `vehicle_options` (
  `vehicle_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_options`
--

INSERT INTO `vehicle_options` (`vehicle_id`, `option_id`) VALUES
(1, 1),
(1, 6),
(1, 19),
(1, 26),
(1, 40),
(2, 1),
(2, 3),
(2, 4),
(2, 39),
(2, 41),
(3, 1),
(3, 3),
(3, 6),
(3, 8),
(3, 19),
(3, 51),
(4, 1),
(4, 3),
(4, 6),
(4, 19),
(4, 26),
(4, 40),
(4, 45),
(4, 51),
(5, 1),
(5, 19),
(5, 26),
(5, 39),
(5, 40),
(5, 46),
(8, 1),
(8, 2),
(8, 3),
(8, 4),
(8, 5),
(8, 6),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(8, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 29),
(8, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(8, 41),
(8, 42),
(8, 43),
(8, 44),
(8, 45),
(8, 46),
(8, 47),
(8, 48),
(8, 49),
(8, 50),
(8, 51),
(8, 52),
(8, 53),
(8, 54);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_reviews`
--

CREATE TABLE `vehicle_reviews` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_reviews`
--

INSERT INTO `vehicle_reviews` (`id`, `vehicle_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 2, 5, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(2, 1, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35'),
(3, 2, 2, 4, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(4, 2, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35'),
(5, 4, 2, 4, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(6, 4, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35'),
(7, 8, 2, 5, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(8, 8, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35'),
(9, 3, 2, 5, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(10, 3, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35'),
(11, 5, 2, 4, 'Excellent condition and smooth handling, very happy with this model!', '2026-06-04 22:27:35'),
(12, 5, 1, 5, 'Highly recommended vehicle. Verified auction-grade inspection certificate.', '2026-06-04 22:27:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_bids`
--
ALTER TABLE `auction_bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bids_user` (`user_id`),
  ADD KEY `fk_bids_vehicle` (`vehicle_id`),
  ADD KEY `idx_bids_status` (`status`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calls_res` (`reservation_id`),
  ADD KEY `fk_calls_agent` (`agent_id`);

--
-- Indexes for table `consignees`
--
ALTER TABLE `consignees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`),
  ADD KEY `idx_options_category` (`category`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pays_user` (`user_id`),
  ADD KEY `fk_pays_vehicle` (`vehicle_id`),
  ADD KEY `idx_pays_status` (`status`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_res_user` (`user_id`),
  ADD KEY `fk_res_vehicle` (`vehicle_id`),
  ADD KEY `fk_res_agent` (`agent_id`),
  ADD KEY `idx_res_status` (`status`),
  ADD KEY `idx_res_expires` (`expires_at`);

--
-- Indexes for table `security_deposits`
--
ALTER TABLE `security_deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_deposits_user` (`user_id`),
  ADD KEY `idx_deposits_status` (`status`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ships_vehicle` (`vehicle_id`),
  ADD KEY `idx_ships_status` (`status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_role` (`role`),
  ADD KEY `idx_users_email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_id` (`stock_id`),
  ADD UNIQUE KEY `chassis_number` (`chassis_number`),
  ADD KEY `idx_vehicles_type` (`type`),
  ADD KEY `idx_vehicles_status` (`status`),
  ADD KEY `idx_vehicles_make_model` (`make`,`model`);

--
-- Indexes for table `vehicle_favorites`
--
ALTER TABLE `vehicle_favorites`
  ADD PRIMARY KEY (`user_id`,`vehicle_id`),
  ADD KEY `fk_favorites_vehicle` (`vehicle_id`);

--
-- Indexes for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_images_vehicle_sort` (`vehicle_id`,`sort_order`);

--
-- Indexes for table `vehicle_options`
--
ALTER TABLE `vehicle_options`
  ADD PRIMARY KEY (`vehicle_id`,`option_id`),
  ADD KEY `fk_vopts_option` (`option_id`);

--
-- Indexes for table `vehicle_reviews`
--
ALTER TABLE `vehicle_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reviews_vehicle` (`vehicle_id`),
  ADD KEY `fk_reviews_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_bids`
--
ALTER TABLE `auction_bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consignees`
--
ALTER TABLE `consignees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `security_deposits`
--
ALTER TABLE `security_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `vehicle_reviews`
--
ALTER TABLE `vehicle_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction_bids`
--
ALTER TABLE `auction_bids`
  ADD CONSTRAINT `fk_bids_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bids_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD CONSTRAINT `fk_calls_agent` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_calls_res` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consignees`
--
ALTER TABLE `consignees`
  ADD CONSTRAINT `fk_consignees_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_pays_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pays_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_res_agent` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_res_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_res_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `security_deposits`
--
ALTER TABLE `security_deposits`
  ADD CONSTRAINT `fk_deposits_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `fk_ships_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_favorites`
--
ALTER TABLE `vehicle_favorites`
  ADD CONSTRAINT `fk_favorites_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorites_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD CONSTRAINT `fk_images_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_options`
--
ALTER TABLE `vehicle_options`
  ADD CONSTRAINT `fk_vopts_option` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vopts_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_reviews`
--
ALTER TABLE `vehicle_reviews`
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reviews_vehicle` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
