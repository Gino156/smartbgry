-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 01:55 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21660325_mydatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `event_image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_description`, `event_image`) VALUES
(144, 'Free Dental Clinic', '2024-09-11', 'free dental check-up', 'dental.jfif'),
(145, 'KKDAT (Kabataan Kontra Droga at Terorismo Seminar)', '2024-10-24', 'Kabataan Kontra Droga ar Terorismo Semina', 'drugs.webp'),
(146, 'Means of Escape (Fire Safety and Prevention)', '2024-10-03', 'Means of Escape (Fire Safety and Prevention)', 'fireman.png'),
(147, 'Drop, Cover and Hold ! Earthquake Preparedness', '2024-06-11', 'Drop, Cover and Hold !\r\nEarthquake Preparedness', 'drill.jpg'),
(148, 'Youth are Ready: Providing Free First Aid Kit', '2024-08-08', 'Youth are Ready: Providing Free First Aid Kit', 'firstaid.jpg'),
(157, 'Basic Self Defense  Training', '2024-07-03', 'Basic Self Defense \r\nTraining', 'self.jfif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
