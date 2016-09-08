-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2016 at 02:33 PM
-- Server version: 5.7.11-0ubuntu6
-- PHP Version: 5.6.24-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filevault`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assets`
--

CREATE TABLE `Assets` (
  `AssetId` int(11) NOT NULL,
  `Javno` varchar(3) DEFAULT NULL,
  `MimeTip` varchar(30) DEFAULT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Assets`
--

INSERT INTO `Assets` (`AssetId`, `Javno`, `MimeTip`, `UserId`) VALUES
(1, 'da', 'dasdas', 79),
(2, 'sa', 'sdaas', 80),
(3, 'aa', 'dsads', 81),
(4, 'aa', 'sdasa', 79),
(5, 'sa', 'sdaasdd', 80);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Validate` varchar(32) DEFAULT NULL,
  `Confirmed` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserId`, `Username`, `Password`, `Email`, `Validate`, `Confirmed`) VALUES
(79, 'simun', '70c52e178b6732341a798cb0b161083433e7e96a', 'simun.sgogic@gmail.com', 'ylC5WD38xonkdN81exWXH8u1udXd98Ex', 1),
(80, 'maric', '648eda7c387608bcdbb54eeb23de467a26cee878', 'sadas@gmail.com', '51lsy9XX5YNLdYOmLxXj7RwstMfwWpRR', 1),
(81, 'maricc', '70c52e178b6732341a798cb0b161083433e7e96a', 'simun.gogic@gmail.coma', 'zq7k1Q5qShlyS4dj4CvU5xAPg5pItwhi', 1),
(82, 'marijan', '70c52e178b6732341a798cb0b161083433e7e96a', 'sdasa@s.hr', 'ForJ7aEI4gzBKD3dvVe9qmwidJTZ14l6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assets`
--
ALTER TABLE `Assets`
  ADD PRIMARY KEY (`AssetId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assets`
--
ALTER TABLE `Assets`
  MODIFY `AssetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assets`
--
ALTER TABLE `Assets`
  ADD CONSTRAINT `Assets_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
