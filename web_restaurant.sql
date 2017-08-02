-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2017 at 07:24 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `pknum` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(11) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` smallint(5) NOT NULL DEFAULT '0' COMMENT 'Nguoi tao',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT 'Thoi gian tao, timestamp',
  `menu_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`pknum`, `name`, `url`, `cost`, `image`, `created_by`, `created_at`, `menu_type`) VALUES
(15, 'Heo tộc hầm khoai sọ', 'heo-toc-ham-khoai-so', 200000, 'ecebbf71cd54fe20cb1c857177d7a14c.jpg', 3, 1501693458, ''),
(16, 'Gà Đông Tảo hầm sâm', 'ga-dong-tao-ham-sam', 300000, '4948c5c9591ae075b4f0256fe840489f.jpg', 3, 1501693521, ''),
(17, ' NƯỚC ÉP THẬP CẨM ĐẶC BIỆT', 'nuoc-ep-thap-cam-dac-biet', 45000, '13d78e6085316acca26f1734d1aecd22.png', 3, 1501693627, ''),
(19, 'BẠC XỈU', 'bac-xiu', 15000, '1fbc8798ed7e0fe91f721f631c43ee0f.png', 3, 1501693688, ''),
(20, 'Cafe Sữa', 'cafe-sua', 20000, '0da3cfe3456775478fafd28b51ca0d28.png', 3, 1501693707, ''),
(21, 'Cafe Đen', 'cafe-den', 15000, '2d4db47f81c06aa9ca981c9b4016a413.png', 3, 1501693756, ''),
(22, 'Nước sâm', 'nuoc-sam', 17000, '6e6ee1960825ca67c1b0ae506ed93ce6.png', 3, 1501693777, ''),
(23, 'Trà xanh Đá/nóng', 'tra-xanh-da-nong', 20000, '85e6a131339d83d4cee1563325955ca9.png', 3, 1501693806, ''),
(24, 'Nước suối', 'nuoc-suoi', 12000, 'c46cd22462c5ff8f0691fff1be4b1f45.png', 3, 1501693839, ''),
(25, 'Pepsi', 'pepsi', 12000, 'c91173dcbd088083efed1f0e2b82d1bd.png', 3, 1501693859, ''),
(26, 'Sting', 'sting', 15000, '77a1d0b123f738521ca3b634633666e6.png', 3, 1501693876, ''),
(27, 'Bia', 'bia', 35000, '35f504e526dac6bccbaee9dbbc76373a.png', 3, 1501693921, ''),
(28, 'Cà rốt', 'ca-rot', 20000, 'd8fb5a86b7dd87ac360a1c37850d4b01.png', 3, 1501693953, ''),
(29, 'Bưởi ép', 'buoi-ep', 15000, '6e543dcc7c2e79a63617f8f4a81913ce.png', 3, 1501694366, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `pknum` smallint(5) NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`pknum`, `fullname`, `username`, `password`, `image`, `created_at`) VALUES
(6, 'My Admin', 'admin', '14e1b600b1fd579f47433b88e8d85291', '1b3405a03a867c489604b181e5cc432d.jpg', 1501694286),
(7, 'My Admin 2', 'admin2', '14e1b600b1fd579f47433b88e8d85291', 'ca223d7c27c6e7a75640435bccf33dbb.jpg', 1501694280);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`pknum`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pknum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `pknum` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `pknum` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
