-- MySQL dump 10.16  Distrib 10.1.29-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: nhs_data
-- ------------------------------------------------------
-- Server version	10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `EventID` int(12) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` varchar(64) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Location` varchar(32) NOT NULL,
  `Shifts` int(32) NOT NULL,
  `ReleaseDate` date NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (2,'Test Event','Testing hour confirmation','2018-04-27','2018-04-27','600 Medinah Rd, Roselle, IL',1,'2018-01-15'),(3,'Sign Up Test Event','Sign up for this event as part of the demo.','2018-02-14','2018-02-14','500 W Bryn Mawr Ave, Roselle, IL',1,'2018-02-10'),(4,'Release Date Test','','2018-02-16','2018-02-16','location',1,'2018-02-14'),(5,'Roster Request Bug Checker','','2018-03-31','2018-03-31','aswd',1,'2018-03-19');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventshift`
--

DROP TABLE IF EXISTS `eventshift`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventshift` (
  `EventID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventshift`
--

LOCK TABLES `eventshift` WRITE;
/*!40000 ALTER TABLE `eventshift` DISABLE KEYS */;
INSERT INTO `eventshift` VALUES (2,2),(3,3),(4,4),(5,5);
/*!40000 ALTER TABLE `eventshift` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `PositionID` int(12) NOT NULL AUTO_INCREMENT,
  `ShiftID` int(12) NOT NULL,
  `StudentID` int(12) DEFAULT NULL,
  `HoursConfirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`PositionID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (3,2,123456,1),(4,2,0,0),(5,3,123456,0),(6,3,NULL,0),(7,4,NULL,0),(8,5,NULL,0),(9,5,NULL,0),(10,5,NULL,0),(11,5,NULL,0),(12,5,NULL,0);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shiftcovers`
--

DROP TABLE IF EXISTS `shiftcovers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shiftcovers` (
  `RequesterID` int(11) NOT NULL,
  `ShiftID` int(11) NOT NULL,
  `CovererID` int(11) NOT NULL,
  `Agreed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shiftcovers`
--

LOCK TABLES `shiftcovers` WRITE;
/*!40000 ALTER TABLE `shiftcovers` DISABLE KEYS */;
/*!40000 ALTER TABLE `shiftcovers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shifts`
--

DROP TABLE IF EXISTS `shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shifts` (
  `ShiftID` int(12) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `PositionsAvailable` int(12) NOT NULL,
  `EventID` int(12) NOT NULL,
  PRIMARY KEY (`ShiftID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shifts`
--

LOCK TABLES `shifts` WRITE;
/*!40000 ALTER TABLE `shifts` DISABLE KEYS */;
INSERT INTO `shifts` VALUES (2,'2018-01-27','05:00:00','06:30:00',0,2),(3,'2018-02-14','04:00:00','05:00:00',1,3),(4,'2018-02-16','01:00:00','02:00:00',1,4),(5,'2018-03-31','12:00:00','14:00:00',5,5);
/*!40000 ALTER TABLE `shifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitecontent`
--

DROP TABLE IF EXISTS `sitecontent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitecontent` (
  `whatItTakes` varchar(1024) NOT NULL,
  `whatItTakes2` varchar(1024) NOT NULL,
  `appReqs` varchar(1024) NOT NULL,
  `attention` varchar(512) NOT NULL,
  `aboutUs` varchar(512) NOT NULL,
  `ID` int(11) NOT NULL,
  `frontImgCaption` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitecontent`
--

LOCK TABLES `sitecontent` WRITE;
/*!40000 ALTER TABLE `sitecontent` DISABLE KEYS */;
INSERT INTO `sitecontent` VALUES ('NHS seeks out students who have a dedication to serving their community. \r\nCharacter is another category NHS pays attention to regarding candidates. A student with high character adheres to high standards of honesty, is courteous to others, and has a clean disciplinary record. Avoid people and situations where you might get in trouble. Things like recreational drug use and underage drinking look bad on an NHS application.\r\nYou cannot simply apply to NHS cold. A faculty member at your school must nominate yo','','','This is an Example Alert! Welome new NHS members! Visit The community Event Tab to see upcoming events and manage those you apply to!','This is an Example About Us! Here at NHS we recognize outstanding high school students. More than just an honor roll, NHS serves to recognize those students who have demonstrated excellence in the areas of scholarship, service, leadership, and character. These characteristics have been associated with membership in the organization since its beginning in 1921.',1,'Promoting appropriate recognition of students who reflect outstanding accomplishments in the areas of scholarship, leadership, character, and service.');
/*!40000 ALTER TABLE `sitecontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentevent`
--

DROP TABLE IF EXISTS `studentevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentevent` (
  `StudentID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentevent`
--

LOCK TABLES `studentevent` WRITE;
/*!40000 ALTER TABLE `studentevent` DISABLE KEYS */;
INSERT INTO `studentevent` VALUES (123456,2),(123456,3),(0,2);
/*!40000 ALTER TABLE `studentevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `StudentID` int(12) NOT NULL,
  `FirstName` varchar(12) NOT NULL,
  `LastName` varchar(12) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `HoursCompleted` float NOT NULL,
  `VicePresident` varchar(12) NOT NULL,
  `Position` varchar(16) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (0,'Test','Student','test@email.com','$2y$10$TRpNkBJfdi0gk0u.YXR8sO/j92LlAXo05kJ/8oR.ZvkShdkcA451m',0,'111111','Student'),(111111,'Miloni','Shah','vp1@email.com','$2y$10$TRpNkBJfdi0gk0u.YXR8sO/j92LlAXo05kJ/8oR.ZvkShdkcA451m',0,'111111','Vice President'),(123456,'Sahil','Patel','email@email.com','$2y$10$TRpNkBJfdi0gk0u.YXR8sO/j92LlAXo05kJ/8oR.ZvkShdkcA451m',6.5,'111111','Admin'),(222222,'Nic','Conry','vp2@email.com','',0,'222222','Vice President'),(654321,'Ben','Wagrez','email2@email.com','$2y$10$T44pEYOXmU.nXNmXBIWkCeVFQhrsBvmUSauRoKgRJ4EQ8oh9Qz7tu',3.5,'222222','Student');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studentshiftrequests`
--

DROP TABLE IF EXISTS `studentshiftrequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentshiftrequests` (
  `EventID` int(12) NOT NULL,
  `StudentID` int(12) NOT NULL,
  `ShiftID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studentshiftrequests`
--

LOCK TABLES `studentshiftrequests` WRITE;
/*!40000 ALTER TABLE `studentshiftrequests` DISABLE KEYS */;
INSERT INTO `studentshiftrequests` VALUES (5,123456,5);
/*!40000 ALTER TABLE `studentshiftrequests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-09 12:00:02
