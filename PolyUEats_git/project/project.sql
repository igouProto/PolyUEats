-- MySQL dump 10.13  Distrib 5.1.51, for pc-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: food
-- ------------------------------------------------------
-- Server version       5.1.51-debug-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP SCHEMA IF EXISTS project;
CREATE SCHEMA project;
USE project;
SET AUTOCOMMIT=0;

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `Name` text NOT NULL,
  `Password` int(11) NOT NULL,
  `Email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Administrator`
--

INSERT INTO `Administrator` (`Name`, `Password`, `Email`) VALUES
('John', 111, '111@polyu.hk'),
('John', 111, '111@polyu.hk'),
('Steve', 333, '333@nba.hk'),
('Steve', 333, '333@nba.hk'),
('Harden', 2929, '2929@nba.hk'),
('Harden', 2929, '2929@nba.hk'),
('Lucy', 4545, '4545@polyu.hk'),
('Lucy', 4545, '4545@polyu.hk'),
('Jason', 6767, '6767@polyu.hk'),
('Jason', 6767, '6767@polyu.hk'),
('Lucy', 4545, '4545@polyu.hk');
COMMIT;

SET AUTOCOMMIT=1;


--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Name`, `Password`, `Email`) VALUES
('Cook', '222', '222@polyu.hk'),
('Curry', '999', '999@polyu.hk'),
('Green', '444', '444@polyu.hk'),
('Irving', '888', '888@polyu.hk'),
('John', '111', '111@polyu.hk'),
('July', '333', '333@polyu.hk'),
('June', '555', '555@polyu.hk'),
('Kevin', '100', '100@polyu.hk'),
('Leo', '777', '777@polyu.hk'),
('May', '666', '666@polyu.hk'),
('Rady', '7878', '7878@polyu.hk'),
('Rudy', '1717', '1717@poly.hk'),
('Shark', '677', '677@nba.hk');

--
-- 转储表的索引
--

--
-- 表的索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Name`);
COMMIT;

SET AUTOCOMMIT=1;

--
-- Table structure for table `AmericanDiner`
--

DROP TABLE IF EXISTS `AmericanDiner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AmericanDiner` (
  `ID` INT(10) NOT NULL AUTO_INCREMENT,
  `FoodItem` CHAR(35) NOT NULL DEFAULT '',
  `Type` CHAR(35) NOT NULL DEFAULT '',
  `Price` INT(10) NOT NULL DEFAULT '0',
  `Picture` CHAR(20) NOT NULL DEFAULT '',
  `Popularity` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
  )ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AmericanDiner`
--
-- ORDER BY:  `ID`

INSERT INTO `AmericanDiner` VALUES (1,'Apple','Fruit',5,'ad_apple',1);
INSERT INTO `AmericanDiner` VALUES (2,'Chicken','Course',16,'ad_chicken',15);
INSERT INTO `AmericanDiner` VALUES (3,'Beef','Course',25,'ad_beef',8);
INSERT INTO `AmericanDiner` VALUES (4,'Pork','Course',30,'ad_pork',6);
INSERT INTO `AmericanDiner` VALUES (5,'Lemon Tea','Drink',8,'ad_lemontea',2);
INSERT INTO `AmericanDiner` VALUES (6,'Hot Dog','Course',10,'ad_hotdog',3);
INSERT INTO `AmericanDiner` VALUES (7,'Milk','Drink',8,'ad_milk',12);
COMMIT;


SET AUTOCOMMIT=1;


--
-- Table structure for table `VACanteen`
--

DROP TABLE IF EXISTS `VACanteen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VACanteen` (
  `ID` INT(10) NOT NULL AUTO_INCREMENT,
  `FoodItem` CHAR(35) NOT NULL DEFAULT '',
  `Type` CHAR(35) NOT NULL DEFAULT '',
  `Price` INT(10) NOT NULL DEFAULT '0',
  `Picture` CHAR(20) NOT NULL DEFAULT '',
  `Popularity` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
  )ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=latin1;

/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--
-- ORDER BY:  `ID`

INSERT INTO `VACanteen` VALUES (1,'Apple','Fruit',5,'va_apple',8);
INSERT INTO `VACanteen` VALUES (2,'Banana','Fruit',7,'va_banana',2);
INSERT INTO `VACanteen` VALUES (3,'Beef','Course',20,'va_beef',4);
INSERT INTO `VACanteen` VALUES (4,'Hot Dog','Course',12,'va_hotdog',9);
INSERT INTO `VACanteen` VALUES (5,'Sasuage','Course',10,'va_sasuage',12);
INSERT INTO `VACanteen` VALUES (6,'Coffee','Drink',10,'va_coffee',11);
COMMIT;


SET AUTOCOMMIT=1;


--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderNo` varchar(4) NOT NULL,
  `OrderItems` varchar(500) DEFAULT NULL,
  `Canteen` varchar(20) DEFAULT NULL,
  `Seasoning` varchar(100) DEFAULT NULL,
  `PlasticBag` tinyint(1) NOT NULL DEFAULT 0,
  `OrderTime` datetime DEFAULT NULL,
  `PickupTime` datetime NOT NULL,
  `Total` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderNo`, `OrderItems`, `Canteen`, `Seasoning`, `PlasticBag`, `OrderTime`, `PickupTime`, `Total`, `Status`) VALUES
('1259', 'Chicken, Hot Dog, Lemon Tea, Apple', 'American Diner', 'Ketchup, Mustard', 1, '2019-12-06 05:31:07', '2019-12-06 05:46:07', 40, 'confirmed'),
('1588', 'Chicken, Lemon Tea, Milk, Apple, Pork', 'American Diner', 'Mustard, Sugar', 1, '2019-12-04 11:29:51', '2019-12-05 12:34:51', 68, 'confirmed'),
('2322', 'Chicken, Beef, Pork, Hot Dog, Lemon Tea, Milk, Apple', 'American Diner', 'Pepper', 1, '2019-12-04 10:45:20', '2019-12-04 11:00:20', 103, 'confirmed'),
('2763', 'Chicken, Beef, Pork, Hot Dog, Lemon Tea, Milk, Apple', 'American Diner', 'Pepper', 1, '2019-12-04 10:51:55', '2019-12-04 11:06:55', 103, 'confirmed'),
('3179', 'Chicken, Lemon Tea, Apple', 'American Diner', 'Ketchup', 1, '2019-12-04 10:22:50', '2019-12-04 10:37:50', 30, 'confirmed'),
('3431', 'Pork, Hot Dog, Beef, Beef, Beef, Beef, Beef, Beef, Chicken, Chicken', 'American Diner', 'Ketchup, Pepper, Mustard, Sugar', 1, '2019-12-04 11:29:26', '2019-12-04 11:44:26', 223, 'confirmed'),
('3590', 'Hot Dog, Lemon Tea, Apple', 'American Diner', 'Ketchup, Mustard', 1, '2019-12-04 11:05:43', '2019-12-04 11:20:43', 24, 'confirmed'),
('3847', 'Hot Dog, Lemon Tea, Apple', 'American Diner', 'Ketchup', 0, '2019-12-04 11:13:02', '2019-12-04 11:28:02', 23, 'confirmed'),
('3917', 'Chicken, Lemon Tea, Apple', 'American Diner', 'Pepper', 1, '2019-12-04 11:14:26', '2019-12-04 11:34:26', 30, 'confirmed'),
('7649', 'Beef', 'American Diner', 'Ketchup, Pepper', 1, '2019-12-04 11:27:18', '2019-12-04 11:42:18', 26, 'confirmed'),
('9006', 'Beef, Pork, Lemon Tea, Milk, Apple', 'American Diner', 'Ketchup, Mustard', 1, '2019-12-06 02:13:38', '2019-12-06 02:28:38', 77, 'confirmed');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderNo`);
COMMIT;

SET AUTOCOMMIT=1;


CREATE TABLE `UsedId` (
  `ID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `UsedId`
--

INSERT INTO `UsedId` (`ID`) VALUES
('1259'),
('1588'),
('2322'),
('2763'),
('3179'),
('3431'),
('3590'),
('3847'),
('3917'),
('7649'),
('9006');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `UsedId`
--
ALTER TABLE `UsedId`
  ADD PRIMARY KEY (`ID`) USING BTREE;
COMMIT;



/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-08 11:01:37
