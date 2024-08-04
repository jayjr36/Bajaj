-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 11:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bajaj_tracking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bajaj`
--

CREATE TABLE `bajaj` (
  `bajaj_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `license_plate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bajaj`
--

INSERT INTO `bajaj` (`bajaj_id`, `model`, `license_plate`) VALUES
(1, 'Nyeusi', 'T 094 Bsx');

-- --------------------------------------------------------

--
-- Table structure for table `bajaj_data`
--

CREATE TABLE `bajaj_data` (
  `id` int(11) NOT NULL,
  `bajaj_id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `passenger_count` int(11) NOT NULL DEFAULT 0,
  `motor_state` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bajaj_data`
--

INSERT INTO `bajaj_data` (`id`, `bajaj_id`, `latitude`, `longitude`, `passenger_count`, `motor_state`, `timestamp`) VALUES
(1, 1, 0, 0, 0, 0, '2024-08-03 15:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `bajaj_owners`
--

CREATE TABLE `bajaj_owners` (
  `owner_id` int(11) NOT NULL,
  `bajaj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bajaj_owners`
--

INSERT INTO `bajaj_owners` (`owner_id`, `bajaj_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owner_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `name`, `contact_info`) VALUES
(1, 'Elywis', ')673858575');

-- --------------------------------------------------------

--
-- Table structure for table `switch_state`
--

CREATE TABLE `switch_state` (
  `id` int(11) NOT NULL,
  `bajaj_id` int(11) NOT NULL,
  `switch` varchar(10) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `switch_state`
--

INSERT INTO `switch_state` (`id`, `bajaj_id`, `switch`, `timestamp`) VALUES
(1, 1, 'OFF', '2024-08-04 12:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(1, 'Elywis', 'elly@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bajaj`
--
ALTER TABLE `bajaj`
  ADD PRIMARY KEY (`bajaj_id`);

--
-- Indexes for table `bajaj_data`
--
ALTER TABLE `bajaj_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bajaj_id` (`bajaj_id`);

--
-- Indexes for table `bajaj_owners`
--
ALTER TABLE `bajaj_owners`
  ADD PRIMARY KEY (`owner_id`,`bajaj_id`),
  ADD KEY `bajaj_id` (`bajaj_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `switch_state`
--
ALTER TABLE `switch_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bajaj`
--
ALTER TABLE `bajaj`
  MODIFY `bajaj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bajaj_data`
--
ALTER TABLE `bajaj_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `switch_state`
--
ALTER TABLE `switch_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bajaj_data`
--
ALTER TABLE `bajaj_data`
  ADD CONSTRAINT `bajaj_data_ibfk_1` FOREIGN KEY (`bajaj_id`) REFERENCES `bajaj` (`bajaj_id`);

--
-- Constraints for table `bajaj_owners`
--
ALTER TABLE `bajaj_owners`
  ADD CONSTRAINT `bajaj_owners_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`),
  ADD CONSTRAINT `bajaj_owners_ibfk_2` FOREIGN KEY (`bajaj_id`) REFERENCES `bajaj` (`bajaj_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
