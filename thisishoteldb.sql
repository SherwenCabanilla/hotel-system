-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 06:54 PM
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
-- Database: `thisishoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin1', 'admin1', 'admin1@gmail.com'),
(2, 'admin2', 'admin2', 'admin2@gmail.com'),
(3, 'admin3', 'admin3', 'admin3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenity_id` int(11) NOT NULL,
  `breakfast` tinyint(1) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT NULL,
  `pool` tinyint(1) DEFAULT NULL,
  `room_service` tinyint(1) DEFAULT NULL,
  `spa` tinyint(1) DEFAULT NULL,
  `bathroom_essentials` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenity_id`, `breakfast`, `wifi`, `pool`, `room_service`, `spa`, `bathroom_essentials`) VALUES
(1, 0, 0, 1, 0, 0, 0),
(2, 1, 0, 0, 1, 0, 0),
(3, 1, 0, 1, 0, 0, 0),
(4, 1, 1, 1, 1, 1, 1),
(5, 1, 0, 1, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0),
(7, 1, 1, 1, 1, 1, 1),
(8, 1, 0, 1, 1, 1, 0),
(9, 1, 0, 1, 1, 1, 0),
(10, 0, 0, 1, 1, 0, 0),
(11, 1, 1, 1, 1, 1, 1),
(12, 1, 0, 1, 0, 1, 0),
(13, 1, 0, 1, 0, 0, 0),
(14, 1, 0, 1, 0, 1, 0),
(15, 0, 0, 1, 0, 1, 0),
(16, 1, 0, 1, 0, 1, 0),
(17, 1, 0, 0, 1, 0, 0),
(18, 0, 0, 0, 0, 0, 0),
(19, 0, 0, 0, 1, 0, 0),
(20, 0, 0, 1, 1, 0, 0),
(21, 0, 0, 0, 0, 0, 0),
(22, 0, 0, 0, 0, 0, 0),
(23, 1, 0, 1, 0, 0, 0),
(24, 0, 0, 0, 0, 0, 1),
(25, 1, 0, 1, 0, 0, 0),
(26, 0, 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `room_type_id`, `amount`, `check_in_date`, `check_out_date`) VALUES
(3, 6, 6, 49491.00, '2023-12-21', '2023-12-30'),
(4, 8, 8, 63742.00, '2023-12-29', '2024-01-06'),
(5, 10, 10, 34844.00, '2023-12-22', '2023-12-28'),
(6, 12, 12, 62742.00, '2023-12-22', '2023-12-30'),
(7, 15, 15, 17947.00, '2023-12-21', '2023-12-24'),
(8, 17, 17, 12000.00, '2023-12-22', '2023-12-25'),
(9, 18, 18, 24500.00, '2023-12-22', '2023-12-29'),
(10, 19, 19, 25500.00, '2023-12-22', '2023-12-29'),
(11, 20, 20, 5350.00, '2023-12-21', '2023-12-22'),
(12, 21, 21, 3500.00, '2023-12-21', '2023-12-22'),
(13, 22, 22, 3500.00, '2023-12-22', '2023-12-23'),
(14, 23, 23, 29350.00, '2023-12-21', '2023-12-29'),
(15, 24, 24, 25050.00, '2023-12-21', '2023-12-28');

-- --------------------------------------------------------

--
-- Table structure for table `confirmed_payments`
--

CREATE TABLE `confirmed_payments` (
  `confirmed_payment_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirmed_payments`
--

INSERT INTO `confirmed_payments` (`confirmed_payment_id`, `invoice_id`) VALUES
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 21);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `age`, `gender`, `phone_number`) VALUES
(6, 'John', 'bulak', 28, 'male', '09123456789'),
(7, 'mitchelle', 'nuba', 27, 'F', '09321654987'),
(8, 'bon', 'ape', 27, 'M', '09987456321'),
(9, 'mark', 'jonessss', 29, '', '09123546789'),
(10, 'John', 'asd', 132, 'M', ''),
(11, 'tore', 'reyy', 37, 'M', '091234567456'),
(12, 'Whsk', 'Doe', 45, 'F', '1234567890'),
(15, 'vin', 'cie', 26, 'F', '09789456123'),
(17, 'book', 'ing', 26, 'F', '09789456123'),
(18, 'eqwe', 'Doe', 56, '', '1234567890'),
(19, 'ds', '', 0, '', ''),
(20, 'Whsk', 'Doe', 32, 'F', 'asdasd'),
(21, 'asd', 'das', 1, 'M', '1234567890'),
(22, 'Whskdsaddsa', 'v', 23, 'F', '1234567890'),
(23, 'bonape', 'yup', 25, 'M', '09369258147'),
(24, 'clark', 'jones', 24, 'M', '09369258147'),
(25, 'min', 'ho', 26, 'F', '09789456423');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `pending_id` int(11) DEFAULT NULL,
  `customer_total_bill` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `booking_id`, `pending_id`, `customer_total_bill`) VALUES
(5, 3, NULL, 49491.00),
(6, NULL, 4, 14200.00),
(7, 4, NULL, 63742.00),
(8, NULL, 5, 35944.00),
(9, 5, NULL, 34844.00),
(10, NULL, 6, 24700.00),
(11, 6, NULL, 62742.00),
(12, 7, NULL, 17947.00),
(13, 8, NULL, 12000.00),
(14, 9, NULL, 24500.00),
(15, 10, NULL, 25500.00),
(16, 11, NULL, 5350.00),
(17, 12, NULL, 3500.00),
(18, 13, NULL, 3500.00),
(19, 14, NULL, 29350.00),
(20, 15, NULL, 25050.00),
(21, NULL, 10, 23346.00);

-- --------------------------------------------------------

--
-- Table structure for table `pending_payments`
--

CREATE TABLE `pending_payments` (
  `pending_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_payments`
--

INSERT INTO `pending_payments` (`pending_id`, `amount`, `due_date`, `reservation_id`, `status`) VALUES
(4, 14200.00, '2023-12-27', 4, 'paid'),
(5, 35944.00, '2023-12-24', 5, 'paid'),
(6, 24700.00, '2023-12-24', 6, 'paid'),
(10, 23346.00, '2023-12-25', 10, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `room_type_id` int(11) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `customer_id`, `reservation_date`, `room_type_id`, `check_in_date`, `check_out_date`) VALUES
(4, 7, '2023-12-27', 7, '2023-12-27', '2023-12-30'),
(5, 9, '2023-12-24', 9, '2023-12-24', '2023-12-30'),
(6, 11, '2023-12-24', 11, '2023-12-24', '2023-12-30'),
(10, 25, '2023-12-25', 25, '2023-12-25', '2023-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_number` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_number`, `name`, `booking_id`, `reservation_id`, `status`) VALUES
(1, 'Standard', NULL, NULL, 'Available'),
(2, 'Standard', NULL, NULL, 'Available'),
(3, 'Standard', NULL, NULL, 'Available'),
(4, 'Standard', NULL, NULL, 'Available'),
(5, 'Standard', NULL, NULL, 'Available'),
(6, 'Standard', NULL, NULL, 'Available'),
(7, 'Standard', NULL, NULL, 'Available'),
(8, 'Standard', NULL, NULL, 'Available'),
(9, 'Standard', NULL, NULL, 'Available'),
(10, 'Standard', NULL, NULL, 'Available'),
(11, 'Standard', NULL, NULL, 'Available'),
(12, 'Standard', NULL, NULL, 'Available'),
(13, 'Standard', NULL, NULL, 'Available'),
(14, 'Standard', NULL, NULL, 'Available'),
(15, 'Standard', NULL, NULL, 'Available'),
(16, 'Standard', NULL, NULL, 'Available'),
(17, 'Standard', NULL, NULL, 'Available'),
(18, 'Standard', NULL, NULL, 'Available'),
(19, 'Standard', NULL, NULL, 'Available'),
(20, 'Standard', NULL, NULL, 'Available'),
(21, 'Standard', NULL, NULL, 'Available'),
(22, 'Standard', NULL, NULL, 'Available'),
(23, 'Standard', NULL, NULL, 'Available'),
(24, 'Standard', NULL, NULL, 'Available'),
(25, 'Standard', NULL, NULL, 'Available'),
(32, 'Suites', NULL, NULL, 'Available'),
(33, 'Suites', NULL, NULL, 'Available'),
(34, 'Suites', NULL, NULL, 'Available'),
(35, 'Suites', NULL, NULL, 'Available'),
(36, 'Suites', NULL, NULL, 'Available'),
(37, 'Suites', NULL, NULL, 'Available'),
(38, 'Suites', NULL, NULL, 'Available'),
(39, 'Suites', NULL, NULL, 'Available'),
(40, 'Suites', NULL, NULL, 'Available'),
(41, 'Suites', NULL, NULL, 'Available'),
(42, 'Suites', NULL, NULL, 'Available'),
(43, 'Suites', NULL, NULL, 'Available'),
(44, 'Suites', NULL, NULL, 'Available'),
(45, 'Suites', NULL, NULL, 'Available'),
(46, 'Suites', NULL, NULL, 'Available'),
(47, 'Suites', NULL, NULL, 'Available'),
(48, 'Suites', NULL, NULL, 'Available'),
(49, 'Suites', NULL, NULL, 'Available'),
(50, 'Suites', NULL, NULL, 'Available'),
(51, 'Suites', NULL, NULL, 'Available'),
(52, 'Suites', NULL, NULL, 'Available'),
(53, 'Suites', NULL, NULL, 'Available'),
(54, 'Suites', NULL, NULL, 'Available'),
(55, 'Suites', NULL, NULL, 'Available'),
(56, 'Suites', NULL, NULL, 'Available'),
(63, 'Family', NULL, NULL, 'Available'),
(64, 'Family', NULL, NULL, 'Available'),
(65, 'Family', NULL, NULL, 'Available'),
(66, 'Family', NULL, NULL, 'Available'),
(67, 'Family', NULL, NULL, 'Available'),
(68, 'Family', NULL, NULL, 'Available'),
(69, 'Family', NULL, NULL, 'Available'),
(70, 'Family', NULL, NULL, 'Available'),
(71, 'Family', NULL, NULL, 'Available'),
(72, 'Family', NULL, NULL, 'Available'),
(73, 'Family', NULL, NULL, 'Available'),
(74, 'Family', NULL, NULL, 'Available'),
(75, 'Family', NULL, NULL, 'Available'),
(76, 'Family', NULL, NULL, 'Available'),
(77, 'Family', NULL, NULL, 'Available'),
(78, 'Family', NULL, NULL, 'Available'),
(79, 'Family', NULL, NULL, 'Available'),
(80, 'Family', NULL, NULL, 'Available'),
(81, 'Family', NULL, NULL, 'Available'),
(82, 'Family', NULL, NULL, 'Available'),
(83, 'Family', NULL, NULL, 'Available'),
(84, 'Family', NULL, NULL, 'Available'),
(85, 'Family', NULL, NULL, 'Available'),
(86, 'Family', NULL, NULL, 'Available'),
(87, 'Family', NULL, NULL, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `room_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `amenity_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`room_type_id`, `name`, `amenity_id`) VALUES
(1, 'Suites', 1),
(2, 'Standard', 2),
(3, 'Suites', 3),
(4, 'Family', 4),
(5, 'Standard', 5),
(6, 'Suites', 6),
(7, 'Standard', 7),
(8, 'Family', 8),
(9, 'Suites', 9),
(10, 'Suites', 10),
(11, 'Standard', 11),
(12, 'Family', 12),
(13, 'Suites', 13),
(14, 'Standard', 14),
(15, 'Suites', 15),
(16, 'Standard', 16),
(17, 'Standard', 17),
(18, 'Standard', 18),
(19, 'Standard', 19),
(20, 'Standard', 20),
(21, 'Standard', 21),
(22, 'Standard', 22),
(23, 'Standard', 23),
(24, 'Standard', 24),
(25, 'Suites', 25),
(26, 'Standard', 26);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_bookings_customers` (`customer_id`),
  ADD KEY `fk_bookings_room_types` (`room_type_id`);

--
-- Indexes for table `confirmed_payments`
--
ALTER TABLE `confirmed_payments`
  ADD PRIMARY KEY (`confirmed_payment_id`),
  ADD KEY `fk_confirmed_payments_invoices` (`invoice_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `fk_invoices_bookings` (`booking_id`),
  ADD KEY `fk_invoices_pending_payments` (`pending_id`);

--
-- Indexes for table `pending_payments`
--
ALTER TABLE `pending_payments`
  ADD PRIMARY KEY (`pending_id`),
  ADD KEY `fk_pending_payments_reservations` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `fk_reservations_customers` (`customer_id`),
  ADD KEY `fk_reservations_room_types` (`room_type_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_number`),
  ADD KEY `fk_rooms_bookings` (`booking_id`),
  ADD KEY `fk_rooms_reservations` (`reservation_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`room_type_id`),
  ADD KEY `fk_room_types_amenities` (`amenity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `confirmed_payments`
--
ALTER TABLE `confirmed_payments`
  MODIFY `confirmed_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pending_payments`
--
ALTER TABLE `pending_payments`
  MODIFY `pending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `room_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bookings_room_types` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `confirmed_payments`
--
ALTER TABLE `confirmed_payments`
  ADD CONSTRAINT `fk_confirmed_payments_invoices` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoices_bookings` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_invoices_pending_payments` FOREIGN KEY (`pending_id`) REFERENCES `pending_payments` (`pending_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pending_payments`
--
ALTER TABLE `pending_payments`
  ADD CONSTRAINT `fk_pending_payments_reservations` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservations_room_types` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_bookings` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rooms_reservations` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `fk_room_types_amenities` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`amenity_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
