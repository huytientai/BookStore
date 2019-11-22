-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 22, 2019 lúc 03:54 AM
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
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `masp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tensach` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tentg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tennxb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loaisach` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`masp`, `tensach`, `tentg`, `tennxb`, `loaisach`, `sl`) VALUES
('sp01', 'Đắc nhân tâm', 'DALE CARNEGIE', 'Nhà xuất bản phụ nữ', 'self-help', 15),
('sp02', 'Trên đường băng', 'TONY BUỔI SÁNG', 'Nhà xuất bản Tổng hợp', 'kinh doanh', 21),
('sp03', 'cuộc sống rất giống cuộc đời', 'NGUYỄN HOÀNG HẢI', 'nhà xuất bản Kim Đồng', 'thiếu niên', 15),
('sp04', 'những kẻ xuất chúng', 'MALCOLM GLADWELL ', 'Nhà xuất bản Tổng hợp', 'lịch sử', 25),
('sp05', 'code dạo kí sự', 'PHẠM HUY HOÀNG', 'Nhà xuất bản giáo dục', 'thiếu niên', 18),
('sp06', 'sơ đồ tư duy', 'BARRY BUZAN', 'Nhà xuất bản thông tin truyền thông', 'khoa học', 31),
('sp07', 'quốc gia khởi nghiệp', 'DAN SENOR & SAUL SINGER', 'Nhà xuất bản lao động', 'kinh tế', 25),
('sp08', 'cà phê cùng TONY', 'TONY BUỔI SÁNG', 'Nhà xuất bản Tổng hợp', 'self-help', 28),
('sp09', 'ông già và biển cả', 'ERNEST HEMINGWAY', 'Nhà xuất bản giáo dục', 'văn học', 41);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`masp`),
  ADD KEY `tennxb` (`tennxb`),
  ADD KEY `tentg` (`tentg`),
  ADD KEY `loaisach` (`loaisach`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`tennxb`) REFERENCES `nhaxuatban` (`tennxb`),
  ADD CONSTRAINT `sach_ibfk_2` FOREIGN KEY (`tentg`) REFERENCES `tacgia` (`tentg`),
  ADD CONSTRAINT `sach_ibfk_3` FOREIGN KEY (`loaisach`) REFERENCES `loaisach` (`loaisach`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
