-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2021-01-04 09:12:13
-- 伺服器版本： 8.0.18
-- PHP 版本： 7.4.12

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `freshfood`
--
DROP DATABASE IF EXISTS `freshfood`;
CREATE DATABASE IF NOT EXISTS `freshfood` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE freshfood;

-- --------------------------------------------------------

--
-- 資料表結構 `client`
--
-- 建立時間： 2020-12-26 11:09:56
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `clientName` varchar(12) NOT NULL COMMENT '客戶名稱',
  `clientID` char(10) NOT NULL COMMENT '身分證',
  `tel` varchar(16) NOT NULL,
  `address` varchar(30) NOT NULL,
  `age` int(4) NOT NULL,
  `job` varchar(12) NOT NULL,
  `date` date NOT NULL COMMENT '登載日期',
  `pic` blob NOT NULL,
  `status` char(6) NOT NULL COMMENT '消費狀態'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='客戶資料';

--
-- 資料表的關聯 `client`:
--

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `client_monthpay`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `client_monthpay`;
CREATE TABLE `client_monthpay` (
`clientID` char(10)
,`months` varchar(7)
,`pay` decimal(32,2)
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `client_weekpay`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `client_weekpay`;
CREATE TABLE `client_weekpay` (
`clientID` char(10)
,`pay` decimal(32,2)
,`weeks` varchar(7)
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `client_yearpay`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `client_yearpay`;
CREATE TABLE `client_yearpay` (
`clientID` char(10)
,`pay` decimal(32,2)
,`years` varchar(4)
);

-- --------------------------------------------------------

--
-- 資料表結構 `collection`
--
-- 建立時間： 2020-12-26 20:17:24
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `clientID` char(10) NOT NULL COMMENT '客戶身分證',
  `orderID` int(11) NOT NULL COMMENT '訂單編號',
  `recieveDate` date NOT NULL COMMENT '應收日期',
  `actualDate` date DEFAULT NULL COMMENT '實收日期',
  `actualPay` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '實收'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='收帳款';

--
-- 資料表的關聯 `collection`:
--   `clientID`
--       `client` -> `clientID`
--   `orderID`
--       `order` -> `orderID`
--

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `collection_view`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `collection_view`;
CREATE TABLE `collection_view` (
`actualDate` date
,`clientID` char(10)
,`clientName` varchar(12)
,`pay` decimal(10,2)
,`price` decimal(10,2)
,`recieveDate` date
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `oder_view`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `oder_view`;
CREATE TABLE `oder_view` (
`actualDate` date
,`clientID` char(10)
,`expectDate` date
,`num` decimal(10,2)
,`orderDate` date
,`price` decimal(10,2)
,`productName` varchar(16)
,`sum` decimal(10,2)
,`supplierID` char(5)
,`supplierName` varchar(16)
,`unit` varchar(6)
);

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--
-- 建立時間： 2020-12-26 19:27:20
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `clientID` char(10) DEFAULT NULL,
  `orderDate` date NOT NULL COMMENT '訂貨日期',
  `expectDate` date NOT NULL COMMENT '預計遞交日期',
  `actualDate` date DEFAULT NULL COMMENT '實際遞交日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='訂單資料';

--
-- 資料表的關聯 `order`:
--   `clientID`
--       `client` -> `clientID`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order_product`
--
-- 建立時間： 2020-12-26 19:10:33
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `orderID` int(11) NOT NULL COMMENT '訂單編號',
  `productID` int(11) NOT NULL DEFAULT '0' COMMENT '產品編號',
  `number` decimal(10,2) NOT NULL COMMENT '數量',
  `unit` varchar(6) NOT NULL COMMENT '單位',
  `supplierID` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='訂單含有的產品資料';

--
-- 資料表的關聯 `order_product`:
--   `orderID`
--       `order` -> `orderID`
--   `productID`
--       `product` -> `productID`
--   `supplierID`
--       `supplier` -> `supplierID`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--
-- 建立時間： 2020-12-26 18:41:37
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(16) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='產品資料';

--
-- 資料表的關聯 `product`:
--

--
-- 觸發器 `product`
--
DROP TRIGGER IF EXISTS `product_AFTER_DELETE`;
DELIMITER $$
CREATE TRIGGER `product_AFTER_DELETE` AFTER DELETE ON `product` FOR EACH ROW BEGIN
	update order_product Set productID = 0 where order_product.productID = OLD.productID;
    update supplier_product Set productID = 0 where supplier_product.productID = OLD.productID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `supplier`
--
-- 建立時間： 2020-12-26 22:24:23
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplierID` char(5) NOT NULL,
  `supplierName` varchar(16) NOT NULL COMMENT '供應商名稱',
  `principal` varchar(12) NOT NULL COMMENT '負責人名稱'
) ;

--
-- 資料表的關聯 `supplier`:
--

--
-- 觸發器 `supplier`
--
DROP TRIGGER IF EXISTS `supplier_AFTER_DELETE`;
DELIMITER $$
CREATE TRIGGER `supplier_AFTER_DELETE` AFTER DELETE ON `supplier` FOR EACH ROW BEGIN
	update supplier_product Set supplierID = '00000' where supplier_product.supplierID = OLD.supplierID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `supplier_daypay`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `supplier_daypay`;
CREATE TABLE `supplier_daypay` (
`day` varchar(10)
,`pay` decimal(32,2)
,`supplierID` char(5)
);

-- --------------------------------------------------------

--
-- 資料表結構 `supplier_product`
--
-- 建立時間： 2020-12-28 03:18:25
--

DROP TABLE IF EXISTS `supplier_product`;
CREATE TABLE `supplier_product` (
  `buyID` int(11) NOT NULL,
  `supplierID` char(5) NOT NULL,
  `productID` int(11) NOT NULL,
  `number` decimal(10,2) NOT NULL COMMENT '數量',
  `unit` varchar(6) NOT NULL COMMENT '單位',
  `price` decimal(10,2) NOT NULL COMMENT '單價',
  `total` decimal(10,2) GENERATED ALWAYS AS ((`number` * `price`)) VIRTUAL,
  `location` varchar(16) NOT NULL COMMENT '庫存位置',
  `standard` varchar(16) NOT NULL COMMENT '規格',
  `purchaseDate` date NOT NULL COMMENT '進貨日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='供應商提供產品的資料';

--
-- 資料表的關聯 `supplier_product`:
--   `productID`
--       `product` -> `productID`
--   `supplierID`
--       `supplier` -> `supplierID`
--

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `supplier_view`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `supplier_view`;
CREATE TABLE `supplier_view` (
`location` varchar(16)
,`num` decimal(10,2)
,`price` decimal(10,2)
,`principal` varchar(12)
,`productName` varchar(16)
,`purchaseDate` date
,`standard` varchar(16)
,`sum` decimal(10,2)
,`supplierID` char(5)
,`supplierName` varchar(16)
,`unit` varchar(6)
);

-- --------------------------------------------------------

--
-- 替換檢視表以便查看 `supplier_weekpay`
-- (請參考以下實際畫面)
--
DROP VIEW IF EXISTS `supplier_weekpay`;
CREATE TABLE `supplier_weekpay` (
`pay` decimal(32,2)
,`supplierID` char(5)
,`weeks` varchar(7)
);

-- --------------------------------------------------------

--
-- 檢視表結構 `client_monthpay`
--
DROP TABLE IF EXISTS `client_monthpay`;
-- 建立時間： 2020-12-26 23:08:07
--

DROP VIEW IF EXISTS `client_monthpay`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_monthpay`  AS SELECT `oder_view`.`clientID` AS `clientID`, date_format(`oder_view`.`orderDate`,'%Y-%m') AS `months`, sum(`oder_view`.`sum`) AS `pay` FROM `oder_view` GROUP BY `oder_view`.`clientID`, `months` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `client_weekpay`
--
DROP TABLE IF EXISTS `client_weekpay`;
-- 建立時間： 2020-12-26 23:08:50
--

DROP VIEW IF EXISTS `client_weekpay`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_weekpay`  AS SELECT `oder_view`.`clientID` AS `clientID`, date_format(`oder_view`.`orderDate`,'%Y-%u') AS `weeks`, sum(`oder_view`.`sum`) AS `pay` FROM `oder_view` GROUP BY `oder_view`.`clientID`, `weeks` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `client_yearpay`
--
DROP TABLE IF EXISTS `client_yearpay`;
-- 建立時間： 2020-12-26 23:04:20
--

DROP VIEW IF EXISTS `client_yearpay`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `client_yearpay`  AS SELECT `oder_view`.`clientID` AS `clientID`, date_format(`oder_view`.`orderDate`,'%Y') AS `years`, sum(`oder_view`.`sum`) AS `pay` FROM `oder_view` GROUP BY `oder_view`.`clientID`, `years` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `collection_view`
--
DROP TABLE IF EXISTS `collection_view`;
-- 建立時間： 2020-12-26 21:16:53
--

DROP VIEW IF EXISTS `collection_view`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `collection_view` (`clientName`, `clientID`, `price`, `recieveDate`, `actualDate`, `pay`) AS   select `client`.`clientName` AS `clientName`,`collection`.`clientID` AS `clientID`,`ord`.`sum` AS `price`,`collection`.`recieveDate` AS `recieveDate`,`collection`.`actualDate` AS `actualDate`,(case when ((now() > `collection`.`recieveDate`) and (`collection`.`actualDate` = ((0 - 0) - 0))) then `ord`.`sum` else 0 end) AS `pay` from ((`client` join `collection`) join (select `order_product`.`orderID` AS `orderID`,cast(sum((`product`.`price` * `order_product`.`number`)) as decimal(10,2)) AS `sum` from (`order_product` join `product`) where (`order_product`.`productID` = `product`.`productID`) group by `order_product`.`orderID`) `ord`) where ((`collection`.`orderID` = `ord`.`orderID`) and (`collection`.`clientID` = `client`.`clientID`))  ;

-- --------------------------------------------------------

--
-- 檢視表結構 `oder_view`
--
DROP TABLE IF EXISTS `oder_view`;
-- 建立時間： 2020-12-26 20:44:13
--

DROP VIEW IF EXISTS `oder_view`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `oder_view` (`clientID`, `orderDate`, `expectDate`, `actualDate`, `productName`, `unit`, `num`, `price`, `sum`, `supplierName`, `supplierID`) AS   select `order`.`clientID` AS `clientID`,`order`.`orderDate` AS `orderDate`,`order`.`expectDate` AS `expectDate`,`order`.`actualDate` AS `actualDate`,`product`.`productName` AS `productName`,`order_product`.`unit` AS `unit`,`order_product`.`number` AS `number`,`product`.`price` AS `price`,cast((`product`.`price` * `order_product`.`number`) as decimal(10,2)) AS `sum`,`supplier`.`supplierName` AS `supplierName`,`order_product`.`supplierID` AS `supplierID` from (((`order` join `product`) join `order_product`) join `supplier`) where ((`product`.`productID` = `order_product`.`productID`) and (`order`.`orderID` = `order_product`.`orderID`) and (`supplier`.`supplierID` = `order_product`.`supplierID`))  ;

-- --------------------------------------------------------

--
-- 檢視表結構 `supplier_daypay`
--
DROP TABLE IF EXISTS `supplier_daypay`;
-- 建立時間： 2020-12-26 23:18:46
--

DROP VIEW IF EXISTS `supplier_daypay`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_daypay`  AS SELECT `supplier_view`.`supplierID` AS `supplierID`, date_format(`supplier_view`.`purchaseDate`,'%Y-%m-%d') AS `day`, sum(`supplier_view`.`sum`) AS `pay` FROM `supplier_view` GROUP BY `supplier_view`.`supplierID`, `day` ;

-- --------------------------------------------------------

--
-- 檢視表結構 `supplier_view`
--
DROP TABLE IF EXISTS `supplier_view`;
-- 建立時間： 2020-12-26 19:52:21
--

DROP VIEW IF EXISTS `supplier_view`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_view` (`supplierName`, `supplierID`, `principal`, `productName`, `num`, `unit`, `price`, `sum`, `location`, `standard`, `purchaseDate`) AS   select `supplier`.`supplierName` AS `supplierName`,`supplier_product`.`supplierID` AS `supplierID`,`supplier`.`principal` AS `principal`,`product`.`productName` AS `productName`,`supplier_product`.`number` AS `number`,`supplier_product`.`unit` AS `unit`,`supplier_product`.`price` AS `price`,`supplier_product`.`total` AS `total`,`supplier_product`.`location` AS `location`,`supplier_product`.`standard` AS `standard`,`supplier_product`.`purchaseDate` AS `purchaseDate` from ((`supplier_product` join `supplier`) join `product`) where ((`supplier_product`.`supplierID` = `supplier`.`supplierID`) and (`supplier_product`.`productID` = `product`.`productID`))  ;

-- --------------------------------------------------------

--
-- 檢視表結構 `supplier_weekpay`
--
DROP TABLE IF EXISTS `supplier_weekpay`;
-- 建立時間： 2020-12-26 23:15:38
--

DROP VIEW IF EXISTS `supplier_weekpay`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `supplier_weekpay`  AS SELECT `supplier_view`.`supplierID` AS `supplierID`, date_format(`supplier_view`.`purchaseDate`,'%Y-%u') AS `weeks`, sum(`supplier_view`.`sum`) AS `pay` FROM `supplier_view` GROUP BY `supplier_view`.`supplierID`, `weeks` ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientID`);

--
-- 資料表索引 `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`clientID`,`orderID`),
  ADD KEY `orderID_idx` (`orderID`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `clientID_idx` (`clientID`);

--
-- 資料表索引 `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`orderID`,`productID`,`supplierID`),
  ADD KEY `contain_product_idx` (`productID`),
  ADD KEY `contain_supplier_idx` (`supplierID`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName_UNIQUE` (`productName`);

--
-- 資料表索引 `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- 資料表索引 `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`buyID`),
  ADD KEY `product_provide_idx` (`productID`),
  ADD KEY `supplier_provide_idx` (`supplierID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `supplier_product`
--
ALTER TABLE `supplier_product`
  MODIFY `buyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `clientID_collection` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderID_collection` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `clientID` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 資料表的限制式 `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `contain_order` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contain_product` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contain_supplier` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD CONSTRAINT `product_provide` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_provide` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
