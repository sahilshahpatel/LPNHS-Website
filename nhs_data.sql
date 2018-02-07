-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2018 at 04:14 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nhs_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(12) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Description` varchar(64) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Location` varchar(32) NOT NULL,
  `Shifts` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `Description`, `StartDate`, `EndDate`, `Location`, `Shifts`) VALUES
(2, 'Test Event', 'Testing hour confirmation', '2018-01-27', '2018-01-27', 'here', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventshift`
--

CREATE TABLE `eventshift` (
  `EventID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventshift`
--

INSERT INTO `eventshift` (`EventID`, `ShiftID`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `PositionID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL,
  `StudentID` int(12) DEFAULT NULL,
  `HoursConfirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`PositionID`, `ShiftID`, `StudentID`, `HoursConfirmed`) VALUES
(3, 2, 123456, 0),
(4, 2, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `ShiftID` int(12) NOT NULL,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `PositionsAvailable` int(12) NOT NULL,
  `EventID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`ShiftID`, `Date`, `StartTime`, `EndTime`, `PositionsAvailable`, `EventID`) VALUES
(2, '2018-01-27', '05:00:00', '06:30:00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sitecontent`
--

CREATE TABLE `sitecontent` (
  `whatItTakes` varchar(512) NOT NULL,
  `whatItTakes2` varchar(512) NOT NULL,
  `attention` varchar(512) NOT NULL,
  `aboutUs` varchar(512) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitecontent`
--

INSERT INTO `sitecontent` (`whatItTakes`, `whatItTakes2`, `attention`, `aboutUs`, `ID`) VALUES
('NHS seeks out students who have a dedication to serving their community. \r\nCharacter is another category NHS pays attention to regarding candidates. A student with high character adheres to high standards of honesty, is courteous to others, and has a clean disciplinary record. Avoid people and situations where you might get in trouble. Things like recreational drug use and underage drinking look bad on an NHS application.\r\nYou cannot simply apply to NHS cold. A faculty member at your school must nominate yo', '', ' This is an Example Alert! Welome new NHS members! Visit The community Event Tab to see upcoming events and manage those you apply to!', 'This is an Example About Us! Here at NHS we recognize outstanding high school students. More than just an honor roll, NHS serves to recognize those students who have demonstrated excellence in the areas of scholarship, service, leadership, and character. These characteristics have been associated with membership in the organization since its beginning in 1921.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentevent`
--

CREATE TABLE `studentevent` (
  `StudentID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentevent`
--

INSERT INTO `studentevent` (`StudentID`, `EventID`) VALUES
(123456, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `StudentID` int(12) NOT NULL,
  `FirstName` varchar(12) NOT NULL,
  `LastName` varchar(12) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `HoursCompleted` float NOT NULL,
  `VicePresident` varchar(12) NOT NULL,
  `Position` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`StudentID`, `FirstName`, `LastName`, `Email`, `PasswordHash`, `HoursCompleted`, `VicePresident`, `Position`) VALUES
(11111, 'Miloni', 'Shah', 'vp1@email.com', '', 0, 'Miloni', 'Vice President'),
(123456, 'Sahil', 'Patel', 'email@email.com', '$2y$10$TRpNkBJfdi0gk0u.YXR8sO/j92LlAXo05kJ/8oR.ZvkShdkcA451m', 5, 'Miloni', 'Admin'),
(222222, 'Nic', 'Conry', 'vp2@email.com', '', 0, 'Nic', 'Vice President'),
(654321, 'Ben', 'Wagrez', 'email2@email.com', '$2y$10$T44pEYOXmU.nXNmXBIWkCeVFQhrsBvmUSauRoKgRJ4EQ8oh9Qz7tu', 3.5, 'Nic', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `studentshiftrequests`
--

CREATE TABLE `studentshiftrequests` (
  `EventID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`ShiftID`);

--
-- Indexes for table `sitecontent`
--
ALTER TABLE `sitecontent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `PositionID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ShiftID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
