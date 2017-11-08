-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 08, 2017 lúc 11:37 AM
-- Phiên bản máy phục vụ: 10.1.25-MariaDB
-- Phiên bản PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `spend_atl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_spend`
--

CREATE TABLE `atl_spend` (
  `id` int(11) NOT NULL,
  `spend_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spend_date` date DEFAULT NULL,
  `spend_time` time DEFAULT NULL,
  `spend_description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_usermeta`
--

CREATE TABLE `atl_usermeta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_users`
--

CREATE TABLE `atl_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_status` tinyint(2) DEFAULT NULL,
  `user_display_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `atl_users`
--

INSERT INTO `atl_users` (`id`, `user_name`, `user_password`, `user_email`, `user_registered`, `user_status`, `user_display_name`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2017-09-18 08:47:14', 1, 'Admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `atl_spend`
--
ALTER TABLE `atl_spend`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `atl_usermeta`
--
ALTER TABLE `atl_usermeta`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `atl_users`
--
ALTER TABLE `atl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `atl_spend`
--
ALTER TABLE `atl_spend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `atl_usermeta`
--
ALTER TABLE `atl_usermeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `atl_users`
--
ALTER TABLE `atl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
