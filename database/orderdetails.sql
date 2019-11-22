-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 22, 2019 lúc 03:59 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cosodulieu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `mahd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `masp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`mahd`, `masp`, `soluong`, `gia`) VALUES
('hd01', 'sp01', 2, 120000),
('hd01', 'sp02', 1, 70000),
('hd01', 'sp09', 4, 280000),
('hd02', 'sp07', 1, 57000),
('hd03', 'sp06', 12, 780000),
('hd03', 'sp07', 11, 670000),
('hd04', 'sp01', 15, 980000),
('hd04', 'sp04', 1, 65000),
('hd06', 'sp09', 6, 442000),
('hd07', 'sp01', 3, 180000),
('hd07', 'sp06', 10, 470000),
('hd08', 'sp05', 4, 210000),
('hd09', 'sp09', 3, 180000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`mahd`,`masp`),
  ADD KEY `masp` (`masp`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`mahd`) REFERENCES `orders` (`mahd`),
  ADD CONSTRAINT `orderdetails_ibfk_3` FOREIGN KEY (`masp`) REFERENCES `sach` (`masp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
