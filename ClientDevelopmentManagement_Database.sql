-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 31, 2015 at 10:33 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ClientDevelopmentManagement_Database`
--

-- --------------------------------------------------------

--
-- Table structure for table `Client`
--

CREATE TABLE `Client` (
  `ClientName` varchar(30) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `HoursLeft` bigint(20) NOT NULL,
  PRIMARY KEY (`ClientName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ClientContact`
--

CREATE TABLE `ClientContact` (
  `ClientName` varchar(30) NOT NULL,
  `Firstname` varchar(15) DEFAULT NULL,
  `Lastname` varchar(15) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` char(2) DEFAULT NULL,
  PRIMARY KEY (`ClientName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ClientPurchases`
--

CREATE TABLE `ClientPurchases` (
  `PurchaseID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(30) NOT NULL,
  `HoursPurchased` bigint(20) DEFAULT NULL,
  `PurchaseDate` date DEFAULT NULL,
  PRIMARY KEY (`PurchaseID`),
  KEY `ClientName` (`ClientName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE `Contact` (
  `Username` varchar(30) NOT NULL,
  `Firstname` varchar(15) DEFAULT NULL,
  `Lastname` varchar(15) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` char(2) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Credentials`
--

CREATE TABLE `Credentials` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(25) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Developer`
--

CREATE TABLE `Developer` (
  `Team` varchar(30) DEFAULT NULL,
  `Username` varchar(30) NOT NULL,
  `Position` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DeveloperAssignments`
--

CREATE TABLE `DeveloperAssignments` (
  `Username` varchar(30) DEFAULT NULL,
  `ClientProjectTask` varchar(30) DEFAULT NULL,
  `Type` char(7) DEFAULT NULL,
  KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

CREATE TABLE `Projects` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(30) NOT NULL,
  `ProjectName` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ProjectID`),
  KEY `ClientName` (`ClientName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientName` varchar(30) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TaskName` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `ClientName` (`ClientName`),
  KEY `ProjectID` (`ProjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TimeSheet`
--

CREATE TABLE `TimeSheet` (
  `TimeLogID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `ClientName` varchar(30) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `TimeIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeSpent` bigint(20) NOT NULL,
  PRIMARY KEY (`TimeLogID`),
  KEY `Username` (`Username`),
  KEY `ClientName` (`ClientName`),
  KEY `ProjectID` (`ProjectID`),
  KEY `TaskID` (`TaskID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ClientContact`
--
ALTER TABLE `ClientContact`
  ADD CONSTRAINT `clientcontact_ibfk_1` FOREIGN KEY (`ClientName`) REFERENCES `Client` (`ClientName`);

--
-- Constraints for table `ClientPurchases`
--
ALTER TABLE `ClientPurchases`
  ADD CONSTRAINT `clientpurchases_ibfk_1` FOREIGN KEY (`ClientName`) REFERENCES `Client` (`ClientName`);

--
-- Constraints for table `Contact`
--
ALTER TABLE `Contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Developer` (`Username`);

--
-- Constraints for table `Credentials`
--
ALTER TABLE `Credentials`
  ADD CONSTRAINT `credentials_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Developer` (`Username`);

--
-- Constraints for table `DeveloperAssignments`
--
ALTER TABLE `DeveloperAssignments`
  ADD CONSTRAINT `developerassignments_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Developer` (`Username`);

--
-- Constraints for table `Projects`
--
ALTER TABLE `Projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`ClientName`) REFERENCES `Client` (`ClientName`);

--
-- Constraints for table `Tasks`
--
ALTER TABLE `Tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`ClientName`) REFERENCES `Client` (`ClientName`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`ProjectID`) REFERENCES `Projects` (`ProjectID`);

--
-- Constraints for table `TimeSheet`
--
ALTER TABLE `TimeSheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Developer` (`Username`),
  ADD CONSTRAINT `timesheet_ibfk_2` FOREIGN KEY (`ClientName`) REFERENCES `Client` (`ClientName`),
  ADD CONSTRAINT `timesheet_ibfk_3` FOREIGN KEY (`ProjectID`) REFERENCES `Projects` (`ProjectID`),
  ADD CONSTRAINT `timesheet_ibfk_4` FOREIGN KEY (`TaskID`) REFERENCES `Tasks` (`TaskID`);
