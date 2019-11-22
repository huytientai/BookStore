-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 21, 2019 lúc 05:47 PM
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
-- Cấu trúc bảng cho bảng `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `tennxb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diachi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dienthoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`tennxb`, `diachi`, `dienthoai`, `email`, `website`) VALUES
('Nhà xuất bản chính trị quốc gia', 'số 6/86 Duy Tân, Cầu Giấy, Hà Nội', '028049221', 'suthat@nxbctqg.vn', 'www.nxbctqg.org.vn'),
('Nhà xuất bản giáo dục', '81 Trần Hưng Đạo, Hà Nội', '02498451928', 'giaoduc@nxbgd.com.cn', 'www.nxbgd.vn'),
('nhà xuất bản Kim Đồng', '55 Quang Trung, Hai Bà Trưng, Hà Nội', '0243455678', 'kimdong@hn.vnn.vn', 'www.nxbkimdong.com.vn'),
('Nhà xuất bản lao động', '175 Giảng Võ, Đống Đa, Hà Nội', '02433458865', 'nxblaodong@yahoo.com', 'www.nxblaodong.com.vn'),
('Nhà xuất bản phụ nữ', '80 Trần Hưng Đạo,Hoàn Kiếm,Hà Nội', '024.8345926916', 'nxbgtvt@fpt.vn', 'www.nxbgtvt.vn'),
('Nhà xuất bản thông tin truyền thông', 'số 115 Trần Duy Hưng, Hà Nội', '02434597591', 'nxb.tttt@mic.gov.vn', 'www.nxbthongtintruyenthong.vn'),
('Nhà xuất bản Tổng hợp', 'số 64 Nguyễn Du, Hà Nội', '024.23459804', 'nxbhnv@hnd.org.vn', 'www.nxbhoinhavan.net'),
('Nhà xuất bản Tổng hợp thành phố Hồ Chí Minh', '63 Nguyễn Thị Minh Khai,Quận 1,TP.HCM', '(028)23484632', 'tonghop@nxbhcm.com.vn', 'www.nxbhcm.com.vn'),
('nhà xuất bản Trẻ', '161B Lý Chính Thắng, Quận 3, Thành phố Hồ Chí Minh', '0283456743', 'hopthubandoc@nxbtre.com.vn', 'www.nxbtre.com.vn'),
('Nhà xuất bản Tư pháp', 'số 35 Trần Quốc Toản, Hoàn Kiếm, Hà Nội', '024.29834767992', 'nxbtp@mọ.gov.vn', 'www.nxbtp.mọ.gov.vn');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`tennxb`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
