-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 21, 2019 lúc 02:37 PM
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
-- Cấu trúc bảng cho bảng `tacgia`
--

CREATE TABLE `tacgia` (
  `tentg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sodt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tacgia`
--

INSERT INTO `tacgia` (`tentg`, `email`, `sodt`, `diachi`) VALUES
('Adam Khoo', 'adamkhoo2342@gmail.com', '0234987235', 'đại học Victorria, Singapore, Singapore'),
('BARRY BUZAN', 'tonybuzan25489@gmail.com', '04589735915', 'Mỹ'),
('DALE CARNEGIE', 'dalecarnegie273@gmail.com', '0435738459', 'Boston, Hoa Kỳ'),
('DAN SENOR & SAU SINGER', 'dan&sau2398@gmail.com', '02387239846', 'Jerusalem,Israel'),
('Ernest Hemingway', 'hemingway23476@gmail.com', '02734611984', 'Mỹ'),
('MALCOLM GLADWELL ', 'malcolmgladwell983@gmail.com', '0128712981', 'Ottawa, Canada'),
('Nguyễn Hoàng Hải', 'hoanghainguyen453@gmail.com', '0986248973', 'quận Tây Hồ, Hà Nội'),
('Phạm Huy Hoàng', 'phamhuyhoang129874@gmail.com', '0124764115', 'Roma, Italia'),
('TONY buổi sáng', 'tonybuoisang7832@gmail.com', '02374623123', 'Cần Giờ, thành phố Hồ Chí Minh');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`tentg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
