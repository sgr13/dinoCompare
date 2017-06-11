-- phpMyAdmin SQL Dump
-- version 4.6.4deb1+deb.cihar.com~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2017 at 11:43 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dino`
--

-- --------------------------------------------------------

--
-- Table structure for table `dino_data`
--

CREATE TABLE `dino_data` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `weight` double NOT NULL,
  `lenght` double NOT NULL,
  `height` double NOT NULL,
  `discoverYear` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `food_type_id` int(11) DEFAULT NULL,
  `period_id` int(11) DEFAULT NULL,
  `dino_order_id` int(11) DEFAULT NULL,
  `dino_suborder_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dino_data`
--

INSERT INTO `dino_data` (`id`, `name`, `weight`, `lenght`, `height`, `discoverYear`, `path`, `food_type_id`, `period_id`, `dino_order_id`, `dino_suborder_id`) VALUES
(21, 'Spinozaur', 6, 15, 4, 1926, '60dc1341443b7b999fa5fb495ff7f116.jpeg', 3, 3, 2, 1),
(22, 'Triceratops', 8.5, 4, 3, 1889, '9bb7aa92a4a93e0c8908b05959376fae.jpeg', 4, 3, 2, 7),
(23, 'Stegozaur', 2.6, 4.6, 2, 1887, 'e556b42100b99929940a0e61d85aab82.jpeg', 4, 2, 2, 3),
(24, 'Diplodok', 18, 25, 5, 1878, 'ec0a1aa2fb887ec9b02e00729e6fe5ef.jpeg', 4, 2, 1, 8),
(25, 'Ankylozaur', 6, 6.25, 1.7, 1908, '97b2621821626f61e486989d2db9d692.jpeg', 4, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `dino_order`
--

CREATE TABLE `dino_order` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dino_order`
--

INSERT INTO `dino_order` (`id`, `name`) VALUES
(1, 'gadziomiedniczy'),
(2, 'ptasiomiedniczy');

-- --------------------------------------------------------

--
-- Table structure for table `dino_suborder`
--

CREATE TABLE `dino_suborder` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `suborderPath` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dino_suborder`
--

INSERT INTO `dino_suborder` (`id`, `name`, `suborderPath`) VALUES
(1, 'Teropody', 'theropods.jpeg'),
(2, 'Heterodontozaury', ''),
(3, 'Stegozaury', ''),
(4, 'Ankylozaury', ''),
(5, 'Ornitopody', ''),
(6, 'Pachycefalozaury', ''),
(7, 'Ceratops', ''),
(8, 'Zauropody', ''),
(9, 'Prozauropody', '');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`id`, `name`) VALUES
(3, 'Mięsożerca'),
(4, 'Roślinożerca'),
(5, 'Wszystkożerca');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `period`
--

INSERT INTO `period` (`id`, `name`) VALUES
(1, 'Trias'),
(2, 'Jura'),
(3, 'Kreda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dino_data`
--
ALTER TABLE `dino_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_3CFD81C45E237E06` (`name`),
  ADD KEY `IDX_3CFD81C48AD350AB` (`food_type_id`),
  ADD KEY `IDX_3CFD81C4EC8B7ADE` (`period_id`),
  ADD KEY `IDX_3CFD81C413DD7EE6` (`dino_order_id`),
  ADD KEY `IDX_3CFD81C4F825A93B` (`dino_suborder_id`);

--
-- Indexes for table `dino_order`
--
ALTER TABLE `dino_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dino_suborder`
--
ALTER TABLE `dino_suborder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dino_data`
--
ALTER TABLE `dino_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `dino_order`
--
ALTER TABLE `dino_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dino_suborder`
--
ALTER TABLE `dino_suborder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `period`
--
ALTER TABLE `period`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dino_data`
--
ALTER TABLE `dino_data`
  ADD CONSTRAINT `FK_3CFD81C413DD7EE6` FOREIGN KEY (`dino_order_id`) REFERENCES `dino_order` (`id`),
  ADD CONSTRAINT `FK_3CFD81C48AD350AB` FOREIGN KEY (`food_type_id`) REFERENCES `food_type` (`id`),
  ADD CONSTRAINT `FK_3CFD81C4EC8B7ADE` FOREIGN KEY (`period_id`) REFERENCES `period` (`id`),
  ADD CONSTRAINT `FK_3CFD81C4F825A93B` FOREIGN KEY (`dino_suborder_id`) REFERENCES `dino_suborder` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
