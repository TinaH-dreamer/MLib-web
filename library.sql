-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2019-12-02 10:53:15
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
-- 表的结构 `books`
--

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

CREATE TABLE IF NOT EXISTS `borrow` (
  `BorrowId` bigint(20) NOT NULL AUTO_INCREMENT,
  `SID` char(10) NOT NULL,
  `BID` char(20) NOT NULL,
  `Borrow_Date` datetime NOT NULL,
  `Return_Date` datetime NOT NULL,
  `Expect_Return_Date` datetime NOT NULL,
  PRIMARY KEY (`BorrowId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `BorrowId` (`DonateID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `SID` char(10) NOT NULL,
  `SName` varchar(10) NOT NULL,
  `SScore` int(11) NOT NULL,
  `SPhoneNum` char(11) NOT NULL,
  `SEMail` varchar(30) NOT NULL,
  PRIMARY KEY (`SID`),
  UNIQUE KEY `SID` (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
