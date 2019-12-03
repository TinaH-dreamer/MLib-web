-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2019-12-03 10:37:25
-- 服务器版本： 5.7.26
-- PHP 版本： 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `library`
--

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `BID` char(20) NOT NULL COMMENT '书本编号（主键）',
  `BName` varchar(30) NOT NULL COMMENT '书本名称',
  `BAuthor` varchar(20) NOT NULL COMMENT '书本作者',
  `BLoc` varchar(20) NOT NULL COMMENT '书本位置',
  `BState` tinyint(1) NOT NULL COMMENT '书本可借阅状态',
  PRIMARY KEY (`BID`),
  UNIQUE KEY `BID` (`BID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE IF NOT EXISTS `borrow` (
  `BorrowId` bigint(20) NOT NULL AUTO_INCREMENT,
  `SID` char(10) NOT NULL,
  `BID` char(20) NOT NULL,
  `Borrow_Date` datetime NOT NULL,
  `Return_Date` datetime NOT NULL,
  `Expect_Return_Date` datetime NOT NULL,
  PRIMARY KEY (`BorrowId`),
  KEY `borrow_FK_BID` (`BID`),
  KEY `borrow_FK_SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `donate`
--

DROP TABLE IF EXISTS `donate`;
CREATE TABLE IF NOT EXISTS `donate` (
  `DonateID` char(20) NOT NULL,
  `SID` char(10) NOT NULL,
  `BID` char(20) NOT NULL,
  `DDate` datetime NOT NULL,
  PRIMARY KEY (`DonateID`),
  UNIQUE KEY `BorrowId` (`DonateID`),
  KEY `donate_FK_BID` (`BID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `SID` char(10) NOT NULL,
  `SName` varchar(10) NOT NULL,
  `SScore` int(11) NOT NULL,
  `SPhoneNum` char(11) NOT NULL,
  `SEMail` varchar(30) NOT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 限制导出的表
--

--
-- 限制表 `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_FK_BID` FOREIGN KEY (`BID`) REFERENCES `books` (`BID`),
  ADD CONSTRAINT `borrow_FK_SID` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`);

--
-- 限制表 `donate`
--
ALTER TABLE `donate`
  ADD CONSTRAINT `donate_FK_BID` FOREIGN KEY (`BID`) REFERENCES `books` (`BID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
