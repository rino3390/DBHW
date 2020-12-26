-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: freshfood
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client` (
  `clientName` varchar(12) NOT NULL COMMENT '客戶名稱',
  `clientID` char(10) NOT NULL COMMENT '身分證',
  `tel` varchar(16) NOT NULL,
  `address` varchar(30) NOT NULL,
  `age` int(4) NOT NULL,
  `job` varchar(12) NOT NULL,
  `date` date NOT NULL COMMENT '登載日期',
  `pic` blob NOT NULL,
  `status` char(6) NOT NULL COMMENT '消費狀態',
  PRIMARY KEY (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='客戶資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `client_monthpay`
--

DROP TABLE IF EXISTS `client_monthpay`;
/*!50001 DROP VIEW IF EXISTS `client_monthpay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `client_monthpay` AS SELECT 
 1 AS `clientID`,
 1 AS `months`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `client_weekpay`
--

DROP TABLE IF EXISTS `client_weekpay`;
/*!50001 DROP VIEW IF EXISTS `client_weekpay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `client_weekpay` AS SELECT 
 1 AS `clientID`,
 1 AS `weeks`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `client_yearpay`
--

DROP TABLE IF EXISTS `client_yearpay`;
/*!50001 DROP VIEW IF EXISTS `client_yearpay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `client_yearpay` AS SELECT 
 1 AS `clientID`,
 1 AS `years`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `collection`
--

DROP TABLE IF EXISTS `collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collection` (
  `clientID` char(10) NOT NULL COMMENT '客戶身分證',
  `orderID` int(11) NOT NULL COMMENT '訂單編號',
  `recieveDate` date NOT NULL COMMENT '應收日期',
  `actualDate` date DEFAULT NULL COMMENT '實收日期',
  `actualPay` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '實收',
  PRIMARY KEY (`clientID`,`orderID`),
  KEY `orderID_idx` (`orderID`),
  CONSTRAINT `clientID_collection` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderID_collection` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='收帳款';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `collection`
--

LOCK TABLES `collection` WRITE;
/*!40000 ALTER TABLE `collection` DISABLE KEYS */;
/*!40000 ALTER TABLE `collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `collection_view`
--

DROP TABLE IF EXISTS `collection_view`;
/*!50001 DROP VIEW IF EXISTS `collection_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `collection_view` AS SELECT 
 1 AS `clientName`,
 1 AS `clientID`,
 1 AS `price`,
 1 AS `recieveDate`,
 1 AS `actualDate`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `oder_view`
--

DROP TABLE IF EXISTS `oder_view`;
/*!50001 DROP VIEW IF EXISTS `oder_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `oder_view` AS SELECT 
 1 AS `clientID`,
 1 AS `orderDate`,
 1 AS `expectDate`,
 1 AS `actualDate`,
 1 AS `productName`,
 1 AS `unit`,
 1 AS `num`,
 1 AS `price`,
 1 AS `sum`,
 1 AS `supplierName`,
 1 AS `supplierID`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` char(10) DEFAULT NULL,
  `orderDate` date NOT NULL COMMENT '訂貨日期',
  `expectDate` date NOT NULL COMMENT '預計遞交日期',
  `actualDate` date DEFAULT NULL COMMENT '實際遞交日期',
  PRIMARY KEY (`orderID`),
  KEY `clientID_idx` (`clientID`),
  CONSTRAINT `clientID` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='訂單資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_product` (
  `orderID` int(11) NOT NULL COMMENT '訂單編號',
  `productID` int(11) NOT NULL DEFAULT '0' COMMENT '產品編號',
  `number` decimal(10,2) NOT NULL COMMENT '數量',
  `unit` varchar(6) NOT NULL COMMENT '單位',
  `supplierID` char(5) NOT NULL,
  PRIMARY KEY (`orderID`,`productID`,`supplierID`),
  KEY `contain_product_idx` (`productID`),
  KEY `contain_supplier_idx` (`supplierID`),
  CONSTRAINT `contain_order` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contain_product` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contain_supplier` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='訂單含有的產品資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(16) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE KEY `productName_UNIQUE` (`productName`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='產品資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (0,'已遺失的產品資訊',0.00);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `product_AFTER_DELETE` AFTER DELETE ON `product` FOR EACH ROW BEGIN
	update order_product Set productID = 0 where order_product.productID = OLD.productID;
    update supplier_product Set productID = 0 where supplier_product.productID = OLD.productID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `supplierID` char(5) NOT NULL,
  `supplierName` varchar(16) NOT NULL COMMENT '供應商名稱',
  `principal` varchar(12) NOT NULL COMMENT '負責人名稱',
  PRIMARY KEY (`supplierID`),
  CONSTRAINT `chk` CHECK (((regexp_like(`supplierID`,_utf8mb4'^-?[0-9]+$') > 0) and (length(`supplierID`) = 5)))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='供應商資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES ('00000','已遺失供應商資訊','已遺失供應商資訊');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `supplier_AFTER_DELETE` AFTER DELETE ON `supplier` FOR EACH ROW BEGIN
	update supplier_product Set supplierID = '00000' where supplier_product.supplierID = OLD.supplierID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `supplier_daypay`
--

DROP TABLE IF EXISTS `supplier_daypay`;
/*!50001 DROP VIEW IF EXISTS `supplier_daypay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `supplier_daypay` AS SELECT 
 1 AS `supplierID`,
 1 AS `day`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `supplier_product`
--

DROP TABLE IF EXISTS `supplier_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier_product` (
  `supplierID` char(5) NOT NULL,
  `productID` int(11) NOT NULL,
  `number` decimal(10,2) NOT NULL COMMENT '數量',
  `unit` varchar(6) NOT NULL COMMENT '單位',
  `price` decimal(10,2) NOT NULL COMMENT '單價',
  `total` decimal(10,2) GENERATED ALWAYS AS ((`number` * `price`)) VIRTUAL,
  `location` varchar(16) NOT NULL COMMENT '庫存位置',
  `standard` varchar(16) NOT NULL COMMENT '規格',
  `purchaseDate` date NOT NULL COMMENT '進貨日期',
  PRIMARY KEY (`supplierID`,`productID`,`purchaseDate`),
  KEY `product_provide_idx` (`productID`),
  CONSTRAINT `product_provide` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON UPDATE CASCADE,
  CONSTRAINT `supplier_provide` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='供應商提供產品的資料';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_product`
--

LOCK TABLES `supplier_product` WRITE;
/*!40000 ALTER TABLE `supplier_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `supplier_view`
--

DROP TABLE IF EXISTS `supplier_view`;
/*!50001 DROP VIEW IF EXISTS `supplier_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `supplier_view` AS SELECT 
 1 AS `supplierName`,
 1 AS `supplierID`,
 1 AS `principal`,
 1 AS `productName`,
 1 AS `num`,
 1 AS `unit`,
 1 AS `price`,
 1 AS `sum`,
 1 AS `location`,
 1 AS `standard`,
 1 AS `purchaseDate`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `supplier_weekpay`
--

DROP TABLE IF EXISTS `supplier_weekpay`;
/*!50001 DROP VIEW IF EXISTS `supplier_weekpay`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `supplier_weekpay` AS SELECT 
 1 AS `supplierID`,
 1 AS `weeks`,
 1 AS `pay`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `client_monthpay`
--

/*!50001 DROP VIEW IF EXISTS `client_monthpay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `client_monthpay` AS select `oder_view`.`clientID` AS `clientID`,date_format(`oder_view`.`orderDate`,'%Y-%m') AS `months`,sum(`oder_view`.`sum`) AS `pay` from `oder_view` group by `oder_view`.`clientID`,`months` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `client_weekpay`
--

/*!50001 DROP VIEW IF EXISTS `client_weekpay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `client_weekpay` AS select `oder_view`.`clientID` AS `clientID`,date_format(`oder_view`.`orderDate`,'%Y-%u') AS `weeks`,sum(`oder_view`.`sum`) AS `pay` from `oder_view` group by `oder_view`.`clientID`,`weeks` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `client_yearpay`
--

/*!50001 DROP VIEW IF EXISTS `client_yearpay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `client_yearpay` AS select `oder_view`.`clientID` AS `clientID`,date_format(`oder_view`.`orderDate`,'%Y') AS `years`,sum(`oder_view`.`sum`) AS `pay` from `oder_view` group by `oder_view`.`clientID`,`years` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `collection_view`
--

/*!50001 DROP VIEW IF EXISTS `collection_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `collection_view` (`clientName`,`clientID`,`price`,`recieveDate`,`actualDate`,`pay`) AS select `client`.`clientName` AS `clientName`,`collection`.`clientID` AS `clientID`,`ord`.`sum` AS `price`,`collection`.`recieveDate` AS `recieveDate`,`collection`.`actualDate` AS `actualDate`,(case when ((now() > `collection`.`recieveDate`) and (`collection`.`actualDate` = NULL)) then `ord`.`sum` else 0 end) AS `Name_exp_6` from ((`client` join `collection`) join (select `order_product`.`orderID` AS `orderID`,sum((`product`.`price` * `order_product`.`number`)) AS `sum` from (`order_product` join `product`) where (`order_product`.`productID` = `product`.`productID`) group by `order_product`.`orderID`) `ord`) where ((`collection`.`orderID` = `ord`.`orderID`) and (`collection`.`clientID` = `client`.`clientID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `oder_view`
--

/*!50001 DROP VIEW IF EXISTS `oder_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `oder_view` (`clientID`,`orderDate`,`expectDate`,`actualDate`,`productName`,`unit`,`num`,`price`,`sum`,`supplierName`,`supplierID`) AS select `order`.`clientID` AS `clientID`,`order`.`orderDate` AS `orderDate`,`order`.`expectDate` AS `expectDate`,`order`.`actualDate` AS `actualDate`,`product`.`productName` AS `productName`,`order_product`.`unit` AS `unit`,`order_product`.`number` AS `number`,`product`.`price` AS `price`,cast((`product`.`price` * `order_product`.`number`) as decimal(10,2)) AS `sum`,`supplier`.`supplierName` AS `supplierName`,`order_product`.`supplierID` AS `supplierID` from (((`order` join `product`) join `order_product`) join `supplier`) where ((`product`.`productID` = `order_product`.`productID`) and (`order`.`orderID` = `order_product`.`orderID`) and (`supplier`.`supplierID` = `order_product`.`supplierID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `supplier_daypay`
--

/*!50001 DROP VIEW IF EXISTS `supplier_daypay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `supplier_daypay` AS select `supplier_view`.`supplierID` AS `supplierID`,date_format(`supplier_view`.`purchaseDate`,'%Y-%m-%d') AS `day`,sum(`supplier_view`.`sum`) AS `pay` from `supplier_view` group by `supplier_view`.`supplierID`,`day` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `supplier_view`
--

/*!50001 DROP VIEW IF EXISTS `supplier_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `supplier_view` (`supplierName`,`supplierID`,`principal`,`productName`,`num`,`unit`,`price`,`sum`,`location`,`standard`,`purchaseDate`) AS select `supplier`.`supplierName` AS `supplierName`,`supplier_product`.`supplierID` AS `supplierID`,`supplier`.`principal` AS `principal`,`product`.`productName` AS `productName`,`supplier_product`.`number` AS `number`,`supplier_product`.`unit` AS `unit`,`supplier_product`.`price` AS `price`,`supplier_product`.`total` AS `total`,`supplier_product`.`location` AS `location`,`supplier_product`.`standard` AS `standard`,`supplier_product`.`purchaseDate` AS `purchaseDate` from ((`supplier_product` join `supplier`) join `product`) where ((`supplier_product`.`supplierID` = `supplier`.`supplierID`) and (`supplier_product`.`productID` = `product`.`productID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `supplier_weekpay`
--

/*!50001 DROP VIEW IF EXISTS `supplier_weekpay`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `supplier_weekpay` AS select `supplier_view`.`supplierID` AS `supplierID`,date_format(`supplier_view`.`purchaseDate`,'%Y-%u') AS `weeks`,sum(`supplier_view`.`sum`) AS `pay` from `supplier_view` group by `supplier_view`.`supplierID`,`weeks` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-27  7:21:30
