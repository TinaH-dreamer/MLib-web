-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2020-02-10 11:45:56
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `Aid` char(10) NOT NULL COMMENT '管理员ID',
  `AName` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '管理员姓名',
  PRIMARY KEY (`Aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `BID` char(20) NOT NULL COMMENT '书本编号（主键）',
  `BName` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '书本名称',
  `BAuthor` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '书本作者',
  `BLoc` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '书本位置',
  `BState` bit(1) NOT NULL COMMENT '书本可借阅状态',
  PRIMARY KEY (`BID`),
  UNIQUE KEY `BID` (`BID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `BorrowId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '借阅记录编号',
  `SID` char(10) NOT NULL COMMENT '借阅学生ID',
  `BID` char(20) NOT NULL COMMENT '借阅图书ID',
  `Borrow_Date` datetime NOT NULL COMMENT '借阅日期',
  `Return_Date` datetime DEFAULT NULL COMMENT '归还日期',
  `Expect_Return_Date` datetime DEFAULT NULL COMMENT '最晚归还日期',
  `BorrowState` bit(3) DEFAULT NULL COMMENT '当前借阅状态',
  PRIMARY KEY (`BorrowId`),
  KEY `borrow_FK_BID` (`BID`),
  KEY `borrow_FK_SID` (`SID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- 表的结构 `donate`
--

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

CREATE TABLE IF NOT EXISTS `student` (
  `SID` char(10) NOT NULL,
  `SName` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
