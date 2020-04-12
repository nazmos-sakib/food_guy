-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 10:46 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_food_guy`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `st` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `st`) VALUES
(1, 'chicken', '2020-04-10 20:00:06'),
(2, 'snacks', '2020-04-10 20:00:06'),
(3, 'subways', '2020-04-10 20:00:06'),
(4, 'sandwich', '2020-04-10 20:00:06'),
(5, 'burger', '2020-04-10 20:00:06'),
(6, 'pizza', '2020-04-10 20:00:06'),
(7, 'pasta & noodles', '2020-04-10 20:00:06'),
(8, 'rice', '2020-04-10 20:00:06'),
(9, 'set menu', '2020-04-10 20:00:06'),
(10, 'drinks & dessert', '2020-04-10 20:00:06'),
(11, 'juice', '2020-04-10 20:00:06'),
(12, 'mocktail', '2020-04-10 20:00:06'),
(13, 'coffee', '2020-04-10 20:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(10) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `time_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `zip_code`, `time_input`) VALUES
(1, 'Jessore Sadar', 7400, '2020-04-10 20:28:00'),
(2, 'Jessore Upa-shahar', 7401, '2020-04-10 20:28:00'),
(3, 'Chanchra', 7402, '2020-04-10 20:28:00'),
(4, 'Jessore canttonment', 7403, '2020-04-10 20:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_1_id` int(11) DEFAULT NULL,
  `sub_category_2_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `in_offer`
--

CREATE TABLE `in_offer` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `in_order`
--

CREATE TABLE `in_order` (
  `id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `menu_item_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` decimal(12,2) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text NOT NULL,
  `recipe` text NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `date_active_from` date DEFAULT NULL,
  `time_active_from` time DEFAULT NULL,
  `date_active_to` date DEFAULT NULL,
  `time_active_to` time DEFAULT NULL,
  `offer_price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='offer that are valid in date range or in intraday time range';

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `placed_order_id` int(11) NOT NULL,
  `status_catalog_id` int(11) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `placed_order`
--

CREATE TABLE `placed_order` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estimated_delivery_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `food_ready` timestamp NULL DEFAULT NULL,
  `actual_delivery_time` timestamp NULL DEFAULT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `discount` decimal(12,2) NOT NULL,
  `final_price` decimal(12,2) NOT NULL,
  `comment` text DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_list`
--

CREATE TABLE `restaurant_list` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `restaurant_owner_email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `time_st` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_owner`
--

CREATE TABLE `restaurant_owner` (
  `owner_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `restaurant_name` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `contract_phone` int(11) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_joined` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant_owner`
--

INSERT INTO `restaurant_owner` (`owner_id`, `full_name`, `restaurant_name`, `city_id`, `address`, `contract_phone`, `owner_email`, `password`, `time_joined`) VALUES
(3, 'nazmos sakib', 'sakib hotel', 3, 'chasra buss stand, jeshore', 1911434399, 'nazmossakib3652@live.com', '$2y$10$soGMuuj2xuJ.BG/eFvJq7evF7CQ.X/Daom1RyK/Cyf4UYPFNF6KdS', '2020-04-12 19:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `status_catalog`
--

CREATE TABLE `status_catalog` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `zip_code` (`zip_code`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `in_offer`
--
ALTER TABLE `in_offer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `in_offer_ak_1` (`offer_id`,`menu_item_id`);

--
-- Indexes for table `in_order`
--
ALTER TABLE `in_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placed_order`
--
ALTER TABLE `placed_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_list`
--
ALTER TABLE `restaurant_list`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `restaurant_owner`
--
ALTER TABLE `restaurant_owner`
  ADD PRIMARY KEY (`owner_email`),
  ADD UNIQUE KEY `email` (`owner_email`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `status_catalog`
--
ALTER TABLE `status_catalog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_catalog_ak_1` (`status_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_offer`
--
ALTER TABLE `in_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_order`
--
ALTER TABLE `in_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_owner`
--
ALTER TABLE `restaurant_owner`
  MODIFY `owner_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_catalog`
--
ALTER TABLE `status_catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
