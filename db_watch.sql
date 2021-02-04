-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 16, 2020 lúc 11:08 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_watch`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) UNSIGNED NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) UNSIGNED NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` tinyint(4) NOT NULL,
  `cat_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_status`, `cat_parent_id`) VALUES
(2, 'Nam', 1, 0),
(3, 'Nữ', 1, 0),
(4, 'Trẻ em', 0, 0),
(6, 'CASIO', 1, 4),
(7, 'ORIENT', 1, 2),
(18, 'CASIO', 1, 2),
(21, 'ORIENT', 1, 4),
(22, 'BENTLEY', 1, 2),
(23, 'SEIKO', 1, 2),
(24, 'CITIZEN', 1, 3),
(25, 'CASIO', 1, 3),
(26, 'channel', 1, 4),
(28, 'casio', 1, 27),
(29, 'channel', 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `images_id` int(11) UNSIGNED NOT NULL,
  `images_name` varchar(100) NOT NULL,
  `images_status` tinyint(4) NOT NULL,
  `products_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`images_id`, `images_name`, `images_status`, `products_id`) VALUES
(6, 'watch-img1606628444.jpg', 1, 14),
(7, 'watch-img1606631646.jpg', 1, 14),
(9, 'vnc16064075340.jpg', 1, 19),
(11, 'vnc16064075342.jpg', 1, 19),
(12, 'vnc16064075343.jpg', 1, 19),
(14, 'watch-img1606631668.jpg', 1, 14),
(15, 'vnc16066328030.jpg', 1, 20),
(16, 'vnc16066328031.jpg', 1, 20),
(17, 'vnc16066328032.jpg', 1, 20),
(18, 'vnc16066345640.jpg', 1, 21),
(19, 'vnc16066345641.jpg', 1, 21),
(20, 'vnc16066345642.png', 1, 21),
(21, 'watch-img1606651462.jpg', 1, 22),
(22, 'vnc16066514021.jpg', 1, 22),
(24, 'vnc16068533060.jpg', 1, 23),
(25, 'vnc16068534050.jpg', 1, 24),
(26, 'vnc16068535280.jpg', 1, 25),
(27, 'vnc16068537150.jpg', 1, 26),
(28, 'vnc16068537151.jpg', 1, 26),
(29, 'vnc16068537162.jpg', 1, 26),
(30, 'vnc16068537163.jpg', 1, 26),
(31, 'vnc16068538430.png', 1, 27),
(32, 'vnc16068539700.jpg', 1, 28),
(33, 'vnc16068539701.jpg', 1, 28),
(34, 'vnc16068539702.jpg', 1, 28),
(35, 'vnc16068541140.jpg', 1, 29),
(36, 'vnc16068541141.jpg', 1, 29),
(37, 'vnc16068541142.jpg', 1, 29),
(38, 'vnc16068547600.jpg', 1, 30),
(39, 'vnc16068547601.jpg', 1, 30),
(40, 'vnc16068547602.jpg', 1, 30),
(43, 'watch-img1607026550.jpg', 1, 31),
(44, 'watch-img1607026565.jpg', 1, 31),
(45, 'watch-img1607026580.jpg', 1, 31),
(51, 'watch-img1607026893.jpg', 1, 32),
(52, 'watch-img1607488646.jpg', 1, 32),
(56, 'watch-16071503440.jpg', 1, 24),
(57, 'watch-16072205070.jpg', 1, 27),
(58, 'watch-16072205520.jpg', 1, 25),
(59, 'watch-16072205850.jpg', 1, 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `id` int(11) UNSIGNED NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_total_money` float NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_method` tinyint(4) NOT NULL,
  `order_datetime` datetime NOT NULL,
  `order_content` varchar(255) NOT NULL,
  `order_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `id`, `order_address`, `order_total_money`, `order_status`, `order_method`, `order_datetime`, `order_content`, `order_code`) VALUES
(49, 35, 'Thôn 1 Thái Sơn,Xã Điện Tiến,Huyện Điện Bàn,Tỉnh Quảng Nam', 1885000, 4, 1, '2020-12-12 05:42:11', 'âdadd', '85F2A'),
(50, 35, 'Thôn 1 Thái Sơn,Xã Điện Tiến,Huyện Điện Bàn,Tỉnh Quảng Nam', 2131800, 2, 2, '2020-12-12 05:46:56', 'adad', '8836F'),
(51, 35, 'Thôn 1 Thái Sơn,Xã Điện Tiến,Huyện Điện Bàn,Tỉnh Quảng Nam', 8775170, 2, 2, '2020-12-13 09:38:34', 'hiao hnag nhanh', 'DFBD6');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `order_detail_id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) UNSIGNED NOT NULL,
  `products_id` int(11) UNSIGNED NOT NULL,
  `order_detail_quantity` int(4) NOT NULL,
  `order_discount` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`order_detail_id`, `order_id`, `products_id`, `order_detail_quantity`, `order_discount`) VALUES
(57, 49, 21, 1, 0),
(58, 50, 28, 1, 0),
(59, 51, 32, 1, 0),
(60, 51, 30, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `products_id` int(11) UNSIGNED NOT NULL,
  `products_name` varchar(100) NOT NULL,
  `products_price` float NOT NULL,
  `products_quantity` int(4) NOT NULL,
  `products_origin` varchar(100) NOT NULL,
  `products_diameter` varchar(100) NOT NULL,
  `products_thickness` varchar(100) NOT NULL,
  `products_bracelet` varchar(100) NOT NULL,
  `products_case` varchar(100) NOT NULL,
  `products_crystal` varchar(100) NOT NULL,
  `products_machine` varchar(100) NOT NULL,
  `products_status` tinyint(4) NOT NULL,
  `products_detail` longtext NOT NULL,
  `products_datetime` date NOT NULL,
  `cat_id` int(11) UNSIGNED NOT NULL,
  `brand_id` int(11) UNSIGNED DEFAULT NULL,
  `sale_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_price`, `products_quantity`, `products_origin`, `products_diameter`, `products_thickness`, `products_bracelet`, `products_case`, `products_crystal`, `products_machine`, `products_status`, `products_detail`, `products_datetime`, `cat_id`, `brand_id`, `sale_id`) VALUES
(14, 'CASIO EFR-553D-1BVUDF', 2500000, 10, 'Janpan', '40mm', '8mm', 'Kim  loại không rỉ', 'Kim loại không rỉ', 'Kính khoáng', 'Quartz', 1, 'chất lượng là thương hiệu', '2020-11-26', 18, NULL, 4),
(19, 'ORIENT FAA02001B9', 3000000, 10, 'Nhật Bản', '41.5 mm', '6mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, 'thương hiệu là chất lượng', '2020-11-26', 6, NULL, 4),
(20, 'CASIO LA680WGA-1DF', 1700000, 20, 'Nhật Bản', '30mm', '5mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính khoáng', 'Quartz', 1, '<p style=\"margin-bottom: 1.3em; font-family: Roboto, sans-serif; font-size: 14.24px; letter-spacing: normal;\">&nbsp; &nbsp;thương hiệu là thành công<br></p>', '2020-11-29', 18, NULL, NULL),
(21, 'CASIO LTP-E164D-7ADF', 2900000, 15, 'Nhật Bản', '30mm', '6mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Quartz', 1, '<p>chất&nbsp;</p>', '2020-11-29', 25, NULL, 2),
(22, 'Casio FFT 2020', 2000000, 50, 'Nhật Bản', '30mm', '6mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, '<p>chất lượng là đi đầu</p>', '2020-11-20', 6, NULL, NULL),
(23, 'DW-5035d-1bdr-Master', 6049000, 15, 'Việt Nam', '30mm', '8mm', 'Nhựa', 'Kim loại không rỉ', 'Kính khoáng', 'Automatic', 1, '<p><span style=\"background-color: rgb(255, 255, 0);\">ddd</span></p>', '2020-11-30', 25, NULL, NULL),
(24, 'DW-5600mw-7dr_master', 2990000, 10, 'Việt Nam', '30mm', '6mm', 'Nhựa', 'Kim loại không rỉ', 'Kính khoáng', 'Automatic', 1, '<p>đẹp</p>', '2020-11-30', 25, NULL, NULL),
(25, 'DW-6900HM-2HDR', 2350000, 50, 'Nhật Bản', '30mm', '6mm', 'Nhựa', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, '<p>s</p>', '2020-11-30', 25, NULL, NULL),
(26, 'Casio AE-1200WHD', 1250000, 30, 'Nhật Bản', '30mm', '7mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính khoáng', 'Quartz', 1, '<p>l</p>', '2020-11-30', 25, NULL, NULL),
(27, 'CASIO LTP-E163D-1ADF', 1900000, 10, 'Nhật Bản', '30mm', '7mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Quartz', 1, '<p>j</p>', '2020-11-30', 25, NULL, NULL),
(28, 'CASIO LTP-E164L-9ADF', 2550000, 5, 'Nhật Bản', '30mm', '6mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, '<p>gg</p>', '2020-11-30', 25, NULL, 4),
(29, 'Casio SHE-3806GL-7AUDR', 4520000, 15, 'Nhật Bản', '30mm', '8mm', 'Thép không gỉ 316L', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, '<p>d</p>', '2020-11-30', 25, NULL, 2),
(30, 'CASIO SHE-4055PGL-7BUDF', 4113000, 20, 'Nhật Bản', '30mm', '7mm', 'Da cao cấp', 'Thép không gỉ 316L', 'Kính khoáng', 'Automatic', 1, '<p>d</p>', '2020-11-30', 25, NULL, 3),
(31, 'ORIENT RE-AM0002L00B', 36500000, 10, 'Nhật Bản', '30mm', '8mm', 'Da cao cấp', 'Thép không gỉ 316L', 'Kính Cứng', 'Automatic', 1, '<p>a</p>', '2020-11-30', 7, NULL, 4),
(32, 'Orient Bambino FAC0000CA0', 5999000, 10, 'Nhật Bản', '35mm', '8mm', 'Da cao cấp', 'Thép không gỉ 316L', 'Kính khoáng', 'Automatic', 1, '<p>sggg</p>', '2020-11-30', 7, NULL, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `sale_id` int(11) UNSIGNED NOT NULL,
  `sale_name` varchar(150) NOT NULL,
  `sale_percent` int(3) NOT NULL,
  `sale_date_start` date DEFAULT NULL,
  `sale_date_end` date DEFAULT NULL,
  `sale_status` tinyint(4) DEFAULT NULL,
  `sale_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_name`, `sale_percent`, `sale_date_start`, `sale_date_end`, `sale_status`, `sale_code`) VALUES
(2, 'Ngày quốc tế phụ nữ 8-3', 35, '2020-08-03', '2020-08-10', 1, NULL),
(3, 'Ngày nhà giáo việt nam 20-11', 15, '2020-11-20', '2020-11-27', 1, NULL),
(4, 'Firday Black', 12, '2020-11-27', '2020-11-30', 1, NULL),
(5, 'chiet khau', 25, '2020-11-27', '2020-11-29', 1, NULL),
(50, 'Mã Giảm Giá Cho Khách Hàng', 5, NULL, NULL, 0, '70283'),
(52, 'Mã Giảm Giá Cho Khách Hàng', 5, NULL, NULL, 1, 'B1F50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `permission` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `gender`, `birthday`, `address`, `permission`) VALUES
(35, 'Tân', 'vantan291@yahoo.com', '$2y$10$g2d8SKR8LfWpOshZGwDDy.o9OPam3eZf3VO2yY68HYmsrO.KOSr6O', 792219129, 1, '2000-10-20', 'Thôn 1 Thái Sơn,Xã Điện Tiến,Huyện Điện Bàn,Tỉnh Quảng Nam', 0),
(36, 'Lê Nguyễn Thịnh', 'lvtan.18i@cit.udn', '$2y$10$uiKZjYUq1YeQBmw6zKET2.PjF1ux2e.SKO0mJ6aKDK4y4zpA44Opm', 792219129, 1, '2000-02-10', 'Hòa quý, Hòa vang, Đà Nẵng', 2),
(38, 'Kỳ võ', 'kin2912000@gmail.com', '$2y$10$DChZPvw7bGVCwTDjZVO.ZekW7sQouBRnksI3JzCJaSIF.kx.KYk7q', 909372941, 0, '1999-02-11', 'Hòa tiến, Hòa vang, Đà Nẵng', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`images_id`),
  ADD KEY `products_pk` (`products_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_pk` (`id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `orders_pk` (`order_id`),
  ADD KEY `products_oreder_detail` (`products_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`),
  ADD KEY `sale_PK` (`sale_id`),
  ADD KEY `category_pk` (`cat_id`),
  ADD KEY `brand_pk` (`brand_id`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `images_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `order_detail_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `products_pk` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_pk` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_pk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_oreder_detail` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brand_pk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_pk` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_PK` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
