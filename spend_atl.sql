-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 15, 2017 lúc 11:31 AM
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
-- Cấu trúc bảng cho bảng `atl_collected`
--

CREATE TABLE `atl_collected` (
  `id` int(11) NOT NULL,
  `collected_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collected_date` date DEFAULT NULL,
  `collected_time` time DEFAULT NULL,
  `collected_description` text COLLATE utf8_unicode_ci,
  `collected_created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `atl_collected`
--

INSERT INTO `atl_collected` (`id`, `collected_price`, `collected_date`, `collected_time`, `collected_description`, `collected_created_date`) VALUES
(5, '200000', '2017-11-03', '00:30:00', '123', '2017-11-15 05:01:59'),
(6, '300000', '2017-11-12', '00:30:00', '2', '2017-11-15 05:02:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_debt`
--

CREATE TABLE `atl_debt` (
  `id` int(11) NOT NULL,
  `debt_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debt_paid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `debt_date` date DEFAULT NULL,
  `debt_expire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debt_description` text COLLATE utf8_unicode_ci,
  `debt_created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `atl_debt`
--

INSERT INTO `atl_debt` (`id`, `debt_price`, `debt_paid`, `debt_date`, `debt_expire`, `debt_description`, `debt_created_date`) VALUES
(7, '100000', '0', '2017-11-09', '16.11.2017', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '2017-11-15 11:05:29'),
(8, '200000', '200000', '2017-11-09', 'indefinitely', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '2017-11-15 09:54:01'),
(9, '400000', '0', '2017-11-16', '30.11.2017', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '2017-11-15 10:07:59'),
(10, '400000', '0', '2017-11-17', '11.11.2017', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', '2017-11-15 10:15:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_spend`
--

CREATE TABLE `atl_spend` (
  `id` int(11) NOT NULL,
  `spend_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spend_date` date DEFAULT NULL,
  `spend_time` time DEFAULT NULL,
  `spend_description` text COLLATE utf8_unicode_ci,
  `spend_created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_usermeta`
--

CREATE TABLE `atl_usermeta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `atl_usermeta`
--

INSERT INTO `atl_usermeta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'user_birthday', ''),
(2, 1, 'user_address', ''),
(3, 1, 'user_moreinfo', ''),
(4, 1, 'user_phone', ''),
(5, 1, 'user_social', '{\"fb\":\"\",\"gplus\":\"\"}'),
(6, 1, 'user_role', 'admin'),
(7, 1, 'user_office', ''),
(8, 1, 'user_avatar', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `atl_users`
--

CREATE TABLE `atl_users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_registered` datetime DEFAULT NULL,
  `user_status` tinyint(2) DEFAULT NULL,
  `user_display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `atl_users`
--

INSERT INTO `atl_users` (`id`, `user_name`, `user_password`, `user_email`, `user_registered`, `user_status`, `user_display_name`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '2017-11-15 10:14:15', 1, 'Admin');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `atl_collected`
--
ALTER TABLE `atl_collected`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `atl_debt`
--
ALTER TABLE `atl_debt`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT cho bảng `atl_collected`
--
ALTER TABLE `atl_collected`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `atl_debt`
--
ALTER TABLE `atl_debt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `atl_spend`
--
ALTER TABLE `atl_spend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `atl_usermeta`
--
ALTER TABLE `atl_usermeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `atl_users`
--
ALTER TABLE `atl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
