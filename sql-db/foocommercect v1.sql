-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2022 at 10:39 PM
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
  `date_prod_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `cat_ID` (`cat_ID`);

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
  MODIFY `cat_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `prod_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
