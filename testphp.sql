-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 10, 2020 lúc 04:05 AM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `testphp`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `acc`
--

CREATE TABLE `acc` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pos` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `acc`
--

INSERT INTO `acc` (`id`, `email`, `password`, `pos`) VALUES
(3, 'phuc@gmail.com', '123654', 1),
(4, 'quyetthang@gmail.com', 'Tt@29120699', 1),
(5, 'phuc2@gmail.com', '123456@Tt', 1),
(6, 'hong@gmail.com', '987654', 1),
(7, 'super@gmail.com', '123456', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `soluong`, `info`) VALUES
(2, 'laptop2', 221, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum'),
(3, 'Ab', 132, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum'),
(4, 'kk', 11, ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum'),
(7, 'gido', 20, 'Tên của bảng mẹ chứa khóa chính được dùng trong bang_con.'),
(9, 'gido2', 20, 'Tên của bảng mẹ chứa khóa chính được dùng trong bang_con.'),
(10, 'gido22', 201, 'Tên của bng mẹ chứa khóa chính được dùng trong bang_con.'),
(12, 'gido', 20, 'Tên của ẹ chứa khóa chính được dùng trong bang_con.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtin`
--

CREATE TABLE `thongtin` (
  `id` int(11) NOT NULL,
  `idacc` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `thongtin`
--

INSERT INTO `thongtin` (`id`, `idacc`, `name`, `info`) VALUES
(7, 3, 'Nguyễn Phúc Vinh', 'Vic family phúc k');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `acc`
--
ALTER TABLE `acc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thongtin_ibfk_1` (`idacc`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `acc`
--
ALTER TABLE `acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `thongtin`
--
ALTER TABLE `thongtin`
  ADD CONSTRAINT `thongtin_ibfk_1` FOREIGN KEY (`idacc`) REFERENCES `acc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
