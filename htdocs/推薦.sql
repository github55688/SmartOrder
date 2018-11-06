-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2018 年 10 月 30 日 14:16
-- 伺服器版本: 10.1.36-MariaDB
-- PHP 版本： 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `good`
--

-- --------------------------------------------------------

--
-- 資料表結構 `推薦`
--

CREATE TABLE `推薦` (
  `編號` int(10) NOT NULL,
  `情境` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `性別` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `年齡` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `主餐` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `湯頭` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `推薦`
--

INSERT INTO `推薦` (`編號`, `情境`, `性別`, `年齡`, `主餐`, `湯頭`) VALUES
(1, 'family', 'boy', 'young', 'B02', 'A01'),
(2, 'friend', 'girl', 'mid', 'B01', 'A200'),
(3, 'one', 'boy', 'old', 'B03', 'A244'),
(4, 'family', NULL, NULL, 'B99', ''),
(5, 'one', 'boy', NULL, 'B02', 'ggg');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `推薦`
--
ALTER TABLE `推薦`
  ADD PRIMARY KEY (`編號`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `推薦`
--
ALTER TABLE `推薦`
  MODIFY `編號` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
