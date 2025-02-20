-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 20, 2025 at 01:50 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblreg`
--

DROP TABLE IF EXISTS `tblreg`;
CREATE TABLE IF NOT EXISTS `tblreg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dName` varchar(50) NOT NULL COMMENT '50',
  `dBreed` varchar(50) NOT NULL COMMENT '50',
  `dOwner` varchar(50) NOT NULL COMMENT '50',
  `dVaccinated` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dStatus` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dTownID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_dTownID` (`dTownID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblreg`
--

INSERT INTO `tblreg` (`id`, `dName`, `dBreed`, `dOwner`, `dVaccinated`, `dStatus`, `dTownID`) VALUES
(16, 'Bornok', 'Aspin', 'Davon', 'Yes', 'Adopted', 14);

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

DROP TABLE IF EXISTS `towns`;
CREATE TABLE IF NOT EXISTS `towns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dTown` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `dTown`) VALUES
(1, 'Banban'),
(2, 'Bonkokan Ilaya'),
(3, 'Bonkokan Ubos'),
(4, 'Calvario'),
(5, 'Candulang'),
(6, 'Catugasan'),
(7, 'Cayupo'),
(8, 'Cogon'),
(9, 'Jambawan'),
(10, 'La Fortuna'),
(11, 'Lomanoy'),
(12, 'Macalingan'),
(13, 'Malinao East'),
(14, 'Malinao West'),
(15, 'Nagsulay'),
(16, 'Poblacion'),
(17, 'Taug'),
(18, 'Tiguis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Am277n6qQk7ft0GZmN1ZGexr6UrH2t8t9G5TIL3Sb0egWlFXeTcyy');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
