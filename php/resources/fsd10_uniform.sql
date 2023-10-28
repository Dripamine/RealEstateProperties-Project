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

-- Database: `fsd10_uniform`

-- Table structure for table `admins`
CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `LoginID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `admins`
-- Insert 3 records into the admins table
INSERT INTO `admins` (`AdminID`, `LoginID`, `FirstName`, `LastName`, `Email`) VALUES
(1, 1, 'Admin1FirstName', 'Admin1LastName', 'teamuniformFSD10@GMAIL.COM'),
(2, 2, 'Admin2FirstName', 'Admin2LastName', 'teamuniformFSD10@GMAIL.COM'),
(3, 3, 'Admin3FirstName', 'Admin3LastName', 'teamuniformFSD10@GMAIL.COM');

-- Table structure for table `agents`
CREATE TABLE `agents` (
  `AgentID` int(11) NOT NULL,
  `LoginID` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `agents`
-- Insert 3 records into the agents table
INSERT INTO `agents` (`AgentID`, `LoginID`, `FirstName`, `LastName`, `Phone`, `Email`) VALUES
(1, 4, 'AgentJohn', 'Doe', '514 909 0909', 'AgentJohnDoe@agentjustsell.ca'),
(2, 5, 'AgentJane', 'Smith', '514 909 0909', 'AgentJaneSmith@agentjustsell.ca'),
(3, 6, 'AgentAlice', 'Johnson', '514 909 0909', 'AgentAliceJohnson@agentjustsell.ca');


-- Table structure for table `image`
CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `PropertyID` int(11) NOT NULL,
  `ImagePath` varchar(255) NOT NULL,
  `ImageFileName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert records into the image table
INSERT INTO `image` (`ImageID`, `PropertyID`, `ImagePath`, `ImageFileName`, `Description`) VALUES
(0101, 01, 'images/PropertiesImages', 'House_01 (1).png', 'Front'),
(0102, 01, 'images/PropertiesImages', 'House_01 (2).png','Back'),
(0103, 01, 'images/PropertiesImages', 'House_01 (3).png','Location'),
(0201, 02, 'images/PropertiesImages', 'Ap_02 (1).png', 'Front'),
(0202, 02, 'images/PropertiesImages', 'Ap_02 (2).png','Back'),
(0203, 02, 'images/PropertiesImages', 'Ap_02 (3).png','Location'),
(0301, 03, 'images/PropertiesImages', 'House_03 (1).png', 'Front'),
(0302, 03, 'images/PropertiesImages', 'House_03 (2).png','Back'),
(0303, 03, 'images/PropertiesImages', 'House_03 (3).png','Location'),
(0401, 04, 'images/PropertiesImages', 'Ap_04 (1).png', 'Front'),
(0402, 04, 'images/PropertiesImages', 'Ap_04 (2).png','Back'),
(0403, 04, 'images/PropertiesImages', 'Ap_04 (3).png','Location'),
(0501, 05, 'images/PropertiesImages', 'ComercialBuilding_01 (1).png', 'Front'),
(0502, 05, 'images/PropertiesImages', 'ComercialBuilding_01 (2).png','Back'),
(0503, 05, 'images/PropertiesImages', 'ComercialBuilding_01 (3).png','Location'),
(0601, 06, 'images/PropertiesImages', 'Ap_06 (3).png', 'Front'),
(0602, 06, 'images/PropertiesImages', 'Ap_06 (3).png','Back'),
(0603, 06, 'images/PropertiesImages', 'Ap_06 (3).png','Location');


-- Table structure for table `logins`
CREATE TABLE `logins` (
  `LoginID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Permission` tinyint(4) NOT NULL DEFAULT '1' -- 1 for users, 2 for agents and 3 for ADM ??
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `logins`
-- Insert 6 records into the logins table - 3 agents and 3 admins
INSERT INTO `logins` (`LoginID`, `Username`, `Password`, `Permission`) VALUES
(1, 'SuperAdmin1', 'Admin1', 3),
(2, 'SuperAdmin2', 'Admin2', 3),
(3, 'SuperAdmin3', 'Admin3', 3),
(4, 'AgentJohn', 'Doe', 2),
(5, 'AgentJane', 'Smith', 2),
(6, 'AgentAlice', 'Johnson', 2),
(7, 'User1', 'User1Last', 1),
(8, 'User2', 'User2Last', 1),
(9, 'User3', 'User3Last', 1),
(10, 'User4', 'User4Last', 1),
(11, 'User5', 'User5Last', 1),
(12, 'User6', 'User6Last', 1),
(13, 'User7', 'User7Last', 1),
(14, 'User8', 'User8Last', 1);


-- Table structure for table `properties`
CREATE TABLE `properties` (
  `PropertyID` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `StreetNum` mediumint(8) UNSIGNED NOT NULL,
  `StreetName` varchar(60) NOT NULL,
  `City` varchar(30) NOT NULL,
  `Province` varchar(30) NOT NULL,
  `Postal` varchar(10) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Bathrooms` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `Bedrooms` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `Floors` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `size` float DEFAULT NULL,
  `furnished` tinyint(1) NOT NULL DEFAULT '0',
  `PropertyType` varchar(30) NOT NULL DEFAULT 'House',
  `YearOfBuilt` tinyint(3) NOT NULL,
  `Amenities` varchar(100) NOT NULL,
  `sellOption` varchar(30) NOT NULL,
  `Construction Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert 6 records into the properties table
INSERT INTO `properties` 
(`PropertyID`, `AgentID`, `StreetNum`, `StreetName`, `City`, `Province`, `Postal`, `Description`, `Price`, `Bathrooms`, `Bedrooms`, `Floors`, `size`, `furnished`, `PropertyType`, `YearOfBuilt`, `Amenities`, `sellOption`, `Construction Status`) VALUES
(1, 1, '11', 'Broadway', 'New York', 'NY', 'NY10101', 'Historic apartment in the theater district. A piece of New York history.', 1200000.00, 2, 2, 1, '1234567', 'furnished', 'House', 2020, 'Pool, Sauna, Deck', 'Sale', 'Ready to Move'),
(2, 2, '9401', 'Union St', 'San Francisco', 'CA', 'CA10101', 'Contemporary penthouse with stunning city views. Ideal for urban living.', 1800000.00, 3, 2, 2, '1234567', 'furnished', 'Apartment', 2021, 'Pool, Sauna', 'Resale', 'Ready to Move'),
(3, 3, '604601', 'River Rd', 'Chicago', 'IL', 'IL10101', 'Cozy townhouse near the Chicago River. Perfect for a small family.', 500000.00, 1, 2, 2, '1234567', 'furnished', 'House', 2019, 'Sauna, Deck', 'Leasing', 'Ready to Move'),
(4, 1, 'A0602', 'Garden Ave', 'Chicago', 'IL', 'IL10101', 'Charming bungalow with a spacious garden. A great starter home.', 350000.00, 2, 2, 1, '1234567', 'furnished', 'Apartment', 2000, 'Please contact us', 'Sale', 'Under Construction'),
(5, 2, '11603', 'Lake St', 'Chicago', 'IL', 'IL10101', 'Lakefront condominium with panoramic lake views. Enjoy the city and the water.', 900000.00, 2, 3, 3, '1234567', 'furnished', 'Comercial Building', 2017, 'Pool', 'Resale', 'Under Construction'),
(6, 3, '331', 'Beach Blvd', 'Miami', 'FL', 'FL10101', 'Tropical paradise with a private beach. Escape to your own slice of heaven.', 3500000.00, 4, 5, 2, '1234567', 'furnished', 'Apartment', 2005, 'No Amenities Included', 'Sale', 'Ready to Move');

-- Table structure for table `propertyoffers`
CREATE TABLE `propertyoffers` (
  `OfferID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `PropertyID` int(11) NOT NULL,
  `OfferAmount` float UNSIGNED NOT NULL,
  `OfferStatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert records into the propertyoffers table
INSERT INTO `propertyoffers` (`OfferID`, `UserID`, `PropertyID`, `OfferAmount`, `OfferStatus`) VALUES
(1, 7, 1, 125000.00, 'Pending'),
(2, 8, 2, 195000.00, 'Pending'),
(3, 9, 3, 522000.00, 'Pending'),
(4, 10, 4, 320000.00, 'Pending'),
(5, 11, 5, 900000.00, 'Pending'),
(6, 12, 6, 2750000.00, 'Rejected'),
(7, 13, 1, 1190000.00, 'Pending'),
(8, 14, 2, 200000.00, 'Accepted'),
(9, 7, 3, 450000.00, 'Pending'),
(10, 8, 4, 350000.00, 'Pending'),
(11, 9, 5, 750000.00, 'Rejected'),
(12, 10, 6, 3000000.00, 'Pending'),
(13, 11, 1, 11000.00, 'Rejected'),
(14, 12, 2, 110000.00, 'Rejected'),
(15, 13, 3, 600000.00, 'Pending');


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

-- Insert records into the users table
INSERT INTO `users` (`UserID`,`LoginID`, `Email`, `FirstName`, `LastName`, `Phone`, `StreetNum`, `StreetName`, `City`, `Province`, `Postal`) VALUES
(7, 7, 'user1@example.com', 'User1', 'User1Last', '123-456-7890', 123, 'Main St', 'New York', 'NY', '10001'),
(8, 8, 'user2@example.com', 'User2', 'User2Last', '987-654-3210', 456, 'Elm St', 'Los Angeles', 'CA', '90001'),
(9, 9, 'user3@example.com', 'User3', 'User3Last', '555-123-4567', 789, 'Oak St', 'Chicago', 'IL', '60601'),
(10, 10, 'user4@example.com', 'User4', 'User4Last', '555-987-6543', 1011, 'Pine St', 'Miami', 'FL', '33101'),
(11, 11, 'user5@example.com', 'User5', 'User5Last', '777-888-9999', 1213, 'Cedar St', 'San Francisco', 'CA', '94101'),
(12, 12, 'user6@example.com', 'User6', 'User6Last', '333-555-7777', 1415, 'Willow St', 'Denver', 'CO', '80201'),
(13, 13, 'user7@example.com', 'User7', 'User7Last', '222-444-6666', 1617, 'Holly St', 'Las Vegas', 'NV', '89101'),
(14, 14, 'user8@example.com', 'User8', 'User8Last', '111-333-5555', 1819, 'Vine St', 'Seattle', 'WA', '98101');
-- Uncomment and insert data for User #15
-- (15, 15, 'user9@example.com', 'User9', 'User9Last', '777-111-4444', 2021, 'Rose St', 'Austin', 'TX', '73301');



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

