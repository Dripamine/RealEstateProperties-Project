-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 25, 2023 at 07:32 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fsd10_uniform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `LoginID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `LoginID`, `FirstName`, `LastName`, `Email`) VALUES
(1, 1, 'Super', 'Admin', 'teamuniformFSD10@GMAIL.COM');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `AgentID` int(11) NOT NULL,
  `LoginID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`AgentID`, `LoginID`, `FirstName`, `LastName`, `Phone`, `Email`) VALUES
(1, 2, 'John', 'Doe', '514 909 0909', 'JohnDoe@Test.ca');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `PropertyID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `LoginID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Permission` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`LoginID`, `Username`, `Password`, `Permission`) VALUES
(1, 'AdminSuper', '$2y$10$p24agRR3OK355PsQBA2nle8wRIAiVQ.Z03BFT3a2mb/QyoJglk4h6', 3),
(2, 'AgentJohn', '$2y$10$jWqfgHkaQ7s4lNqou2bEbeEkg2ky6yNdrKup1LeFI8BzLeFxPicWm', 2);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `PropertyID` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `StreetNum` mediumint(8) UNSIGNED NOT NULL,
  `StreetName` varchar(60) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Province` varchar(30) NOT NULL,
  `Postal` varchar(7) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Bathrooms` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `Bedrooms` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `Floors` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `size` float DEFAULT NULL,
  `furnished` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`PropertyID`, `AgentID`, `StreetNum`, `StreetName`, `City`, `Province`, `Postal`, `Description`, `Price`, `Bathrooms`, `Bedrooms`, `Floors`, `size`, `furnished`) VALUES
(1, 1, 123, 'Laurier', 'Montreal', 'QC', 'H1A 3H6', 'This is a lovely test property, located in the heart of downtown montreal.', 9999.79, 1, 1, 1, NULL, 0),
(2, 1, 9999, 'Pie-IX', 'Montreal', 'QC', 'H1X 2X9', 'Located 5 mins from the Biodome, this is a wonderful place to live and you should definitely buy it. please buy this house. buy this house. buy it. buy this house.', 300001, 1, 4, 1, NULL, 0),
(3, 1, 56, 'MapleLeaf', 'Somewhere', 'ON', 'O9N 0X0', 'A tiny Cabin is the calm valley of Somewhere, ON. The perfect vacation home or a wonderful place to retire.', 50.54, 1, 1, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `propertyoffers`
--

CREATE TABLE `propertyoffers` (
  `OfferID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PropertyID` int(11) NOT NULL,
  `OfferAmount` float UNSIGNED NOT NULL,
  `OfferStatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `LoginID` int(11) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `StreetNum` mediumint(9) DEFAULT NULL,
  `StreetName` varchar(30) DEFAULT NULL,
  `City` varchar(30) DEFAULT NULL,
  `Province` varchar(30) DEFAULT NULL,
  `Postal` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `FK_AD_LG` (`LoginID`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`AgentID`),
  ADD KEY `FK_AG_LG` (`LoginID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `FK_IM_PR` (`PropertyID`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`LoginID`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`PropertyID`),
  ADD KEY `FK_PRTY_AG` (`AgentID`);

--
-- Indexes for table `propertyoffers`
--
ALTER TABLE `propertyoffers`
  ADD PRIMARY KEY (`OfferID`),
  ADD KEY `FK_PO_USER` (`UserID`),
  ADD KEY `FK_PO_PRTY` (`PropertyID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `FK_USER_LG` (`LoginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `AgentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `LoginID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `propertyoffers`
--
ALTER TABLE `propertyoffers`
  MODIFY `OfferID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `FK_AD_LG` FOREIGN KEY (`LoginID`) REFERENCES `logins` (`LoginID`);

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `FK_AG_LG` FOREIGN KEY (`LoginID`) REFERENCES `logins` (`LoginID`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_IM_PR` FOREIGN KEY (`PropertyID`) REFERENCES `properties` (`PropertyID`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `FK_PRTY_AG` FOREIGN KEY (`AgentID`) REFERENCES `agents` (`AgentID`);

--
-- Constraints for table `propertyoffers`
--
ALTER TABLE `propertyoffers`
  ADD CONSTRAINT `FK_PO_PRTY` FOREIGN KEY (`PropertyID`) REFERENCES `properties` (`PropertyID`),
  ADD CONSTRAINT `FK_PO_USER` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_USER_LG` FOREIGN KEY (`LoginID`) REFERENCES `logins` (`LoginID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
