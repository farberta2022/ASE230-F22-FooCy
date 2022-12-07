-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 05:16 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foocommercect`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `adr_ID` int(10) UNSIGNED NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL,
  `house_number` varchar(10) NOT NULL,
  `street` varchar(25) NOT NULL,
  `apt_number` varchar(10) DEFAULT NULL,
  `city` varchar(64) NOT NULL,
  `state` char(2) NOT NULL,
  `country` char(2) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `special_instructions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_ID` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_ID`, `cat_name`) VALUES
(1, 'Household goods'),
(2, 'Technology'),
(3, 'Art'),
(4, 'Art supply'),
(5, 'Hand-crafted goods');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_ID` int(10) UNSIGNED NOT NULL,
  `ord_date` datetime NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL,
  `prod_ID` int(10) UNSIGNED NOT NULL,
  `adr_ID` int(10) UNSIGNED NOT NULL,
  `pm_ID` int(10) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `auth_code` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ord_status` tinytext CHARACTER SET latin2 DEFAULT NULL,
  `ord_ttlBilled` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymethods`
--

CREATE TABLE `paymethods` (
  `pm_ID` int(10) UNSIGNED NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL,
  `nameOnAccount` varchar(64) NOT NULL,
  `pm_type` tinyint(2) UNSIGNED NOT NULL COMMENT 'This will be a code obtained through radio button/drop down of company permitted options',
  `acct_num` varchar(32) NOT NULL COMMENT 'this is varchar, not int to accept encryption values for storage',
  `exp_date` varchar(4) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `adr_ID` int(10) UNSIGNED NOT NULL,
  `billMatchShip` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_ID` int(10) UNSIGNED NOT NULL,
  `cat_ID` int(10) UNSIGNED NOT NULL,
  `prod_name` varchar(128) NOT NULL,
  `prod_desc` mediumtext DEFAULT NULL,
  `prod_imgs` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `quantOnHand` smallint(5) UNSIGNED NOT NULL,
  `prod_price` decimal(10,2) UNSIGNED NOT NULL,
  `prod_cost` decimal(15,4) UNSIGNED NOT NULL,
  `user_ID` int(10) UNSIGNED NOT NULL,
  `date_prod_added` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_ID`, `cat_ID`, `prod_name`, `prod_desc`, `prod_imgs`, `quantOnHand`, `prod_price`, `prod_cost`, `user_ID`, `date_prod_added`) VALUES
(1, 1, 'microfiber cloths', '5 microfiber cleaning cloths', 'null', 15, '3.00', '0.5000', 0, '2022-12-07 02:30:59'),
(2, 2, 'rulers', 'ruler with standard and metric units', 'null', 6, '0.50', '0.0200', 0, '2022-12-07 03:25:40'),
(3, 4, 'ThingFor A Thing', 'For the person who has everything', 'null', 2, '89.00', '0.5000', 0, '2022-12-07 03:31:38'),
(4, 2, 'MoarStuff Animals', 'Just like the name, our stuffed animals have MOAR stuff', 'null', 100, '25.00', '1.0000', 0, '2022-12-07 03:49:42'),
(5, 1, 'headphones', 'really good headphones', 'null', 4, '125.00', '65.0000', 2, '2022-12-07 03:53:53'),
(6, 1, 'pens', '10 pack of Gel pens (black)', 'null', 400, '6.99', '0.3300', 2, '2022-12-07 03:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(10) UNSIGNED NOT NULL,
  `role` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `phone_number` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `date_account_created` datetime NOT NULL,
  `birthday` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `role`, `firstname`, `lastname`, `email`, `password`, `phone_number`, `picture`, `bio`, `date_account_created`, `birthday`) VALUES
(1, 0, 'Tami', 'Farber', 'farbert1@nku.edu', '$2y$10$btgwYlvlIAtoH0Vm9klFKelWNsP8cH2Q8k3zj9xCSpnY7J5Mi3PZm', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(2, 1, 'T.S.', 'Farber', 't.s.farber09@gmail.com', '$2y$10$xbOTpZwGa/w9VOD47ZYXxePNTyKXHnwWL7FILXkYlmuHEFhV8pY82', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`adr_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `prod_ID` (`prod_ID`),
  ADD KEY `adr_ID` (`adr_ID`),
  ADD KEY `pm_ID` (`pm_ID`);

--
-- Indexes for table `paymethods`
--
ALTER TABLE `paymethods`
  ADD PRIMARY KEY (`pm_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `adr_ID` (`adr_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_ID`),
  ADD KEY `cat_ID` (`cat_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `adr_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymethods`
--
ALTER TABLE `paymethods`
  MODIFY `pm_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`adr_ID`) REFERENCES `addresses` (`adr_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`prod_ID`) REFERENCES `products` (`prod_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`pm_ID`) REFERENCES `paymethods` (`pm_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paymethods`
--
ALTER TABLE `paymethods`
  ADD CONSTRAINT `paymethods_ibfk_1` FOREIGN KEY (`adr_ID`) REFERENCES `addresses` (`adr_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paymethods_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_ID`) REFERENCES `categories` (`cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
