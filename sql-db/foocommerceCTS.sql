-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 05:06 AM
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

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`adr_ID`, `user_ID`, `house_number`, `street`, `apt_number`, `city`, `state`, `country`, `postal_code`, `special_instructions`) VALUES
(1, 1, '123', 'Doinitmy Way', '', 'Beverly Hills', 'CA', 'US', '90210', ''),
(2, 5, '989', 'Moonlight Ridge Rd', '', 'Phoenix', 'AZ', 'US', '27345', ''),
(3, 4, '291', 'W 44th St', '4B', 'Cincinnati', 'OH', 'US', '45251', 'Leave at front desk');

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
(5, 'Hand-crafted goods'),
(7, 'Clothing'),
(8, 'Pet Supplies');

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

--
-- Dumping data for table `paymethods`
--

INSERT INTO `paymethods` (`pm_ID`, `user_ID`, `nameOnAccount`, `pm_type`, `acct_num`, `exp_date`, `adr_ID`, `billMatchShip`) VALUES
(1, 1, 'Tami S Farber', 0, '4179000000034', '0625', 1, NULL),
(2, 5, 'Tawny Kitaen', 0, '446500000089', '0625', 2, NULL),
(3, 4, 'Hubert Lloyd', 2, '741956400032', '0625', 3, NULL);

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
(6, 1, 'pens', '10 pack of Gel pens (black)', 'null', 400, '6.99', '0.3300', 2, '2022-12-07 03:57:36'),
(7, 2, 'booky', 'a book', '', 2, '12.99', '4.0300', 2, '2022-12-07 19:21:41'),
(8, 1, 'fidget spinner', 'spins when you want to fidget', '', 50, '2.00', '0.0200', 5, '2022-12-08 04:27:01'),
(9, 1, 'Flippity-flyer', 'Toss it in the air and it falls with style', '', 60, '4.50', '0.3000', 5, '2022-12-08 05:02:10'),
(10, 2, 'microfiber cloths', 'Set of 10 microfiber cloths. 6\" x 8\"', '', 12, '12.99', '3.5000', 5, '2022-12-08 05:06:22'),
(12, 3, 'Great Dane Sculpture', 'Resin-cast sculpture 9 x 18', '', 1, '800.00', '550.0000', 5, '2022-12-10 17:01:22'),
(15, 2, 'Keyboard', 'Goes clickity-clackity. Removeable keys. WASD and 10-key included', '', 64, '20.99', '5.0000', 5, '2022-12-10 18:00:14'),
(16, 7, 'Fuzzy Fluffy Fleece Footies', 'Your feet will thank you. We have 5 colors to choose from and sizes for all\r\n', '', 100, '25.87', '10.0000', 6, '2022-12-11 02:32:51'),
(17, 7, 'LoTR t-shirt', 'Black: Mordor Fun Run', '', 45, '12.80', '2.0000', 6, '2022-12-11 02:33:22'),
(18, 7, 'Felt shoulder bag', 'wool felt handbag with vegan leather trim\r\n', '', 16, '74.45', '20.0000', 6, '2022-12-11 02:33:51'),
(20, 8, 'Custom: Pet ornaments', 'Your pet\'s name engraved on a hand-painted woodcut ornament\r\n', '', 1, '16.99', '5.0000', 6, '2022-12-11 02:35:09'),
(22, 8, 'Custom: Personalized Dog Collar', 'Twill with copper accents.  See size chart for how to measure dog.', '', 1, '9.99', '3.0000', 6, '2022-12-11 02:37:01'),
(23, 8, 'Firehose Dog Toy', 'Heavy-duty fabric made from upcycled firehoses. For determined chewers and fun-loving doggos\r\n', '', 55, '15.00', '5.0000', 6, '2022-12-11 02:38:58'),
(24, 5, 'Widdle Hat', 'A hat for your cat. Crocheted with lurv', '', 3, '150.00', '149.9900', 5, '2022-12-12 03:20:58'),
(25, 5, 'Widdle Sweater', 'This sweater should keep your iguana from falling out of a tree on those freezing desert nights. Crocheted with lurv!', '', 15, '85.00', '68.0000', 5, '2022-12-12 03:23:54'),
(26, 8, 'Custom: Pet Photo Pillowcase King size', 'Send us a picture of your pet and we will print their image on a pillowcase. All the hugs, less fur, easy to travel with', '', 1, '16.50', '7.5000', 6, '2022-12-12 03:28:20'),
(27, 8, 'Custom: Pet Photo Pillowcase Queen size sham', 'Send us a picture of your pet and we will print their image on a pillowcase. All the hugs, less fur, easy to travel with', '', 1, '25.00', '20.0000', 6, '2022-12-12 03:29:26');

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
(1, 0, 'Tami', 'Farber', 'farbert1@nku.edu', '$2y$10$btgwYlvlIAtoH0Vm9klFKelWNsP8cH2Q8k3zj9xCSpnY7J5Mi3PZm', '', '', 'Got my mind on my doggies and my doggies on my mind.', '0000-00-00 00:00:00', '1971-06-14'),
(2, 1, 'T.S.', 'Farber', 't.s.farber09@gmail.com', '$2y$10$xbOTpZwGa/w9VOD47ZYXxePNTyKXHnwWL7FILXkYlmuHEFhV8pY82', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(4, 2, 'admin', 'three', 'admin3@nku.edu', '$2y$10$CUnVoI69Rizelx15kY8a3.DrplId6XURRrFfk/CNWk8vyIdaM5K6O', '', '', '', '2022-12-08 03:57:20', '1955-07-21'),
(5, 1, 'SellerOfStuff', 'One', 'seller01@nku.edu', '$2y$10$ZROXRBEvM51e.YpVQcW7yeEXFXMER2hTbonAiwoKMWhdfHwTX5QLq', '', '', 'I used to model for Whitesnake videos, now I crochet hats for turtles and sweaters for iguanas. No snakes though. They find clothes constricting.', '2022-12-08 04:09:55', '1961-08-05'),
(6, 1, 'Ida', 'Seller', 'seller02@nku.edu', '$2y$10$6ZJ5BDrET.Kr339MfklJze6RxeV9DAEE.yPw4dvZyt8Zlp1jSUF8S', NULL, NULL, NULL, '2022-12-11 03:31:22', NULL);

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
  MODIFY `adr_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymethods`
--
ALTER TABLE `paymethods`
  MODIFY `pm_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
