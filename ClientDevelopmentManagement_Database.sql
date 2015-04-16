-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2015 at 10:32 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clientdevelopmentmanagement_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `Client`
--

CREATE TABLE IF NOT EXISTS `Client` (
  `ClientName` varchar(30) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `HoursLeft` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Client`
--

INSERT INTO `Client` (`ClientName`, `StartDate`, `HoursLeft`) VALUES
('CocaCola', '2003-06-05', 0),
('Home Depot', '1983-01-20', 0),
('The Business', '1993-06-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ClientContact`
--

CREATE TABLE IF NOT EXISTS `ClientContact` (
  `ClientName` varchar(30) NOT NULL,
  `Firstname` varchar(15) DEFAULT NULL,
  `Lastname` varchar(15) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ClientContact`
--

INSERT INTO `ClientContact` (`ClientName`, `Firstname`, `Lastname`, `Phone`, `Email`, `Address`, `City`, `State`) VALUES
('CocaCola', 'Muhtar', 'Kent', '7704044789', 'muhtar@coke.com', 'Beverage St.', 'Atlanta', 'GA'),
('Home Depot', 'Arthur', 'Blank', '4044049111', 'arthur@homedepot.com', 'Atlanta St.', 'Atlanta', 'GA'),
('The Business', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');

-- --------------------------------------------------------

--
-- Table structure for table `ClientPurchases`
--

CREATE TABLE IF NOT EXISTS `ClientPurchases` (
`PurchaseID` int(11) NOT NULL,
  `ClientName` varchar(30) NOT NULL,
  `HoursPurchased` bigint(20) DEFAULT NULL,
  `PurchaseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Contact`
--

CREATE TABLE IF NOT EXISTS `Contact` (
  `Username` varchar(30) NOT NULL,
  `Firstname` varchar(15) DEFAULT NULL,
  `Lastname` varchar(15) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Address` varchar(40) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contact`
--

INSERT INTO `Contact` (`Username`, `Firstname`, `Lastname`, `Phone`, `Email`, `Address`, `City`, `State`) VALUES
('admin', 'admin', 'm', 'm', 'm', 'm', 'm', 'ME'),
('b.zucker', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA'),
('delaney', '1', '1', '1', '1', '1', '1', 'CA'),
('max', 'Max', 'G', '9889', '9898', '9898', '9898', '98'),
('one', 'one', 'o', 'o', 'o', 'o', 'o', 'CA'),
('test', 'm', 'm', 'm', 'm', 'm', 'm', 'AL'),
('test1', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Credentials`
--

CREATE TABLE IF NOT EXISTS `Credentials` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Credentials`
--

INSERT INTO `Credentials` (`Username`, `Password`) VALUES
('admin', 'ed4060702b42311eb4f6c707b11f1999'),
('b.zucker', '90c2593cbb53916910bf9a1140beeb47'),
('max', '5435a9bfcc0feda85a0e06df31f2decc'),
('one', 'fab2e0f17aaeca5a81634df0a27f3063');

-- --------------------------------------------------------

--
-- Table structure for table `Developer`
--

CREATE TABLE IF NOT EXISTS `Developer` (
  `Team` varchar(30) DEFAULT NULL,
  `Username` varchar(30) NOT NULL,
  `Position` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Developer`
--

INSERT INTO `Developer` (`Team`, `Username`, `Position`) VALUES
('SE', 'admin', 'Project Manager'),
('SE', 'b.zucker', 'Developer'),
('SE', 'delaney', 'Developer'),
('One', 'max', ''),
('SE', 'one', 'Project Manager'),
('SE', 'test', 'Developer'),
('SE', 'test1', 'Project Manager');

-- --------------------------------------------------------

--
-- Table structure for table `DeveloperAlerts`
--

CREATE TABLE IF NOT EXISTS `DeveloperAlerts` (
  `DaysExpirationWarning` int(11) NOT NULL DEFAULT '100',
  `HoursLeftWarning` int(11) NOT NULL DEFAULT '10',
  `Username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeveloperAlerts`
--

INSERT INTO `DeveloperAlerts` (`DaysExpirationWarning`, `HoursLeftWarning`, `Username`) VALUES
(100, 10, 'admin'),
(100, 10, 'b.zucker'),
(100, 10, 'delaney'),
(100, 10, 'max'),
(100, 10, 'one'),
(100, 10, 'test'),
(100, 10, 'test1');

-- --------------------------------------------------------

--
-- Table structure for table `DeveloperAssignments`
--

CREATE TABLE IF NOT EXISTS `DeveloperAssignments` (
  `Username` varchar(30) DEFAULT NULL,
  `ClientProjectTask` varchar(30) DEFAULT NULL,
  `Type` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DeveloperAssignments`
--

INSERT INTO `DeveloperAssignments` (`Username`, `ClientProjectTask`, `Type`) VALUES
('b.zucker', 'The Business', 'Client'),
('b.zucker', 'CocaCola', 'Client'),
('b.zucker', 'Home Depot', 'Client'),
('b.zucker', '1', 'Project'),
('b.zucker', '2', 'Project'),
('b.zucker', '3', 'Project'),
('b.zucker', '4', 'Project'),
('b.zucker', '1', 'Task');

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

CREATE TABLE IF NOT EXISTS `Projects` (
`ProjectID` int(11) NOT NULL,
  `ClientName` varchar(30) NOT NULL,
  `ProjectName` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`ProjectID`, `ClientName`, `ProjectName`, `Description`) VALUES
(1, 'The Business', 'Loaded Project', 'This project was stored in the database before the Client object was created.'),
(2, 'Home Depot', 'Orange App', 'This project was stored in the database before the Client object was created.'),
(3, 'Home Depot', 'Store Locator', 'This project was stored in the database before the Client object was created.'),
(4, 'CocaCola', 'Sprite Website', 'This project was stored in the database before the Client object was created.');

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE IF NOT EXISTS `Tasks` (
`TaskID` int(11) NOT NULL,
  `ClientName` varchar(30) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TaskName` varchar(30) NOT NULL,
  `Description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tasks`
--

INSERT INTO `Tasks` (`TaskID`, `ClientName`, `ProjectID`, `TaskName`, `Description`) VALUES
(1, 'The Business', 1, 'Loaded Task', 'This task was stored in the databse before the Client object was created.');

-- --------------------------------------------------------

--
-- Table structure for table `TimeSheet`
--

CREATE TABLE IF NOT EXISTS `TimeSheet` (
`TimeLogID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `ClientName` varchar(30) DEFAULT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TaskID` int(11) DEFAULT NULL,
  `TimeIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimeOut` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TimeSpent` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Client`
--
ALTER TABLE `Client`
 ADD PRIMARY KEY (`ClientName`);

--
-- Indexes for table `ClientContact`
--
ALTER TABLE `ClientContact`
 ADD PRIMARY KEY (`ClientName`);

--
-- Indexes for table `ClientPurchases`
--
ALTER TABLE `ClientPurchases`
 ADD PRIMARY KEY (`PurchaseID`), ADD KEY `ClientName` (`ClientName`);

--
-- Indexes for table `Contact`
--
ALTER TABLE `Contact`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Credentials`
--
ALTER TABLE `Credentials`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Developer`
--
ALTER TABLE `Developer`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `DeveloperAlerts`
--
ALTER TABLE `DeveloperAlerts`
 ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `DeveloperAssignments`
--
ALTER TABLE `DeveloperAssignments`
 ADD KEY `Username` (`Username`);

--
-- Indexes for table `Projects`
--
ALTER TABLE `Projects`
 ADD PRIMARY KEY (`ProjectID`), ADD KEY `ClientName` (`ClientName`);

--
-- Indexes for table `Tasks`
--
ALTER TABLE `Tasks`
 ADD PRIMARY KEY (`TaskID`), ADD KEY `ClientName` (`ClientName`), ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `TimeSheet`
--
ALTER TABLE `TimeSheet`
 ADD PRIMARY KEY (`TimeLogID`), ADD KEY `Username` (`Username`), ADD KEY `ClientName` (`ClientName`), ADD KEY `ProjectID` (`ProjectID`), ADD KEY `TaskID` (`TaskID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ClientPurchases`
--
ALTER TABLE `ClientPurchases`
MODIFY `PurchaseID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Projects`
--
ALTER TABLE `Projects`
MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Tasks`
--
ALTER TABLE `Tasks`
MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `TimeSheet`
--
ALTER TABLE `TimeSheet`
MODIFY `TimeLogID` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `DeveloperAlerts`
--
ALTER TABLE `DeveloperAlerts`
ADD CONSTRAINT `developeralerts_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Developer` (`Username`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
