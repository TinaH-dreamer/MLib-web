-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2020-03-22 17:19:50
-- 服务器版本： 5.5.45
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
  `BID` char(20) CHARACTER SET utf8 NOT NULL COMMENT '书本编号（主键）',
  `BName` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '书本名称',
  `BAuthor` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '书本作者',
  `BLoc` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '书本位置',
  `BState` tinyint(1) NOT NULL COMMENT '书本可借阅状态',
  PRIMARY KEY (`BID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE IF NOT EXISTS `borrow` (
  `BorrowId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '借阅编号',
  `SID` char(10) CHARACTER SET utf8 NOT NULL COMMENT '学号',
  `BID` char(20) CHARACTER SET utf8 NOT NULL COMMENT '图书编号',
  `Borrow_Date` datetime NOT NULL COMMENT '借出日期',
  `Return_Date` datetime NOT NULL COMMENT '归还日期',
  `Expect_Return_Date` datetime NOT NULL COMMENT '应还日期',
  `TID` char(10) CHARACTER SET utf8 NOT NULL COMMENT '预约取书编号',
  `State` varchar(20) NOT NULL COMMENT '状态',
  PRIMARY KEY (`BorrowId`),
  KEY `borrow_FK_books` (`BID`),
  KEY `borrow_FK_student` (`SID`),
  KEY `borrow_FK_token` (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `SID` char(10) CHARACTER SET utf8 NOT NULL COMMENT '学号',
  `SName` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '学生姓名',
  `SScore` int(11) NOT NULL COMMENT '积分',
  `SPhoneNum` char(11) CHARACTER SET utf8 NOT NULL COMMENT '手机号码',
  `SEMail` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '邮箱',
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `tid` char(10) NOT NULL COMMENT '预约编号',
  `time` datetime NOT NULL COMMENT '取书时间',
  `sid` char(10) NOT NULL COMMENT '学号',
  `mess` varchar(100) NOT NULL COMMENT '借阅书目',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 限制导出的表
--

--
-- 限制表 `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_FK_token` FOREIGN KEY (`TID`) REFERENCES `token` (`tid`),
  ADD CONSTRAINT `borrow_FK_books` FOREIGN KEY (`BID`) REFERENCES `books` (`BID`),
  ADD CONSTRAINT `borrow_FK_student` FOREIGN KEY (`SID`) REFERENCES `student` (`SID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
