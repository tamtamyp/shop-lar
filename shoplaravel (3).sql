-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2021 lúc 03:07 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoplaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `created_by` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(45) DEFAULT NULL,
  `display` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `status`, `parent_id`, `created`, `created_by`, `modified`, `modified_by`, `display`) VALUES
(1, 'Trang phục cách tân', 'trang-phuc-cach-tan', 'active', 0, '2019-05-03 17:00:00', 'admin', '2021-11-17 09:44:06', 'rurikeigo', 'list'),
(2, 'Trang phục truyền thống', 'trang-phuc-truyen-thong', 'active', 0, '2019-05-03 17:00:00', 'admin', '2021-11-19 15:31:10', 'rurikeigo', 'grid'),
(3, 'Nam', 'nam', 'active', 2, '2019-05-03 17:00:00', 'admin', '2021-11-19 15:32:24', 'rurikeigo', 'list'),
(4, 'Nữ', 'nu', 'active', 2, '2019-05-03 17:00:00', 'admin', '2021-11-19 15:32:39', 'rurikeigo', 'list'),
(5, 'Khoa học', '0', 'active', 0, '2019-05-03 17:00:00', 'admin', '2021-11-12 21:19:27', 'rurikeigo', 'list'),
(6, 'Nam', 'nam', 'active', 1, '2019-05-03 17:00:00', 'admin', '2021-11-22 02:42:09', 'rurikeigo', 'grid'),
(18, 'Nữ', 'nu', 'active', 1, '2021-11-16 07:07:42', 'rurikeigo', '2021-11-16 17:09:47', 'rurikeigo', 'grid');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_note` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `order_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_address` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `order_note`, `customer_id`, `order_name`, `order_phone`, `order_email`, `order_address`, `status`, `total`, `modified`, `modified_by`) VALUES
(5, '2021-11-21', NULL, 1, 'Nguyễn Thị Tâm', '0349937818', 'thientamyp@gmail.com', 'Trung Nghĩa -Yên Phong - Bắc Ninh', 'pending', 3780000, '2021-11-21 18:56:03', NULL),
(7, '2021-11-21', NULL, 1, 'Nguyễn Thị Tâm', '4', 'admin@gmail.com', 'Trung Nghĩa -Yên Phong - Bắc Ninh', 'processing', 2230000, '2021-11-22 04:10:56', 'rurikeigo'),
(8, '2021-11-22', NULL, 7, 'aaaaa', '444444444', 'ahaha@gmail.com', 'Phù Lưu-Trung Nghĩa -Yên Phong-Bắc Ninh', 'processing', 1680000, '2021-11-22 04:25:18', 'rurikeigo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `price`, `quantity`) VALUES
(4, 10, 2000000, 2),
(5, 10, 1650000, 2),
(5, 4, 450000, 1),
(6, 9, 2200000, 1),
(7, 9, 2200000, 1),
(8, 10, 1650000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_at` date DEFAULT current_timestamp(),
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `category_id`, `name`, `content`, `status`, `thumb`, `created`, `created_by`, `modified`, `modified_by`, `publish_at`, `type`) VALUES
(23, 6, 'Asus ra mắt Zenfone 6 với camera lật tự động', '<p>Với thiết kế màn hình tràn viền hoàn toàn không tai thỏ, camera chính 48 megapixel trên Zenfone 6 có thể lật từ sau ra trước biến thành camera selfie.</p>\r\n\r\n<p>Zenfone 6 là một trong những smartphone có viền màn hình mỏng nhất trên thị trường với tỷ lệ màn hình hiển thị chiếm tới 92% diện tích mặt trước. Máy có màn hình 6,4 inch tràn viền ra cả bốn cạnh, không tai thỏ như một số mẫu Zenfone trước và cũng không dùng thiết kế đục lỗ như Galaxy S10, S10+</p>', 'active', 'post/banner.jpg', '2019-05-17 00:00:00', 'hailan', '2021-11-22 03:27:32', 'rurikeigo', '2019-05-16', 'normal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_list` varchar(600) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `description`, `content`, `price`, `sale_price`, `thumb`, `thumb_list`, `status`, `type`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'ÁO GIAO LĨNH CÁCH TÂN BẠCH HẠC', '1', NULL, NULL, '500000', '400000', 'product/SAN_4869-1-600x899.jpg', '0', 'active', 'featured', '2021-11-16 06:11:05', 'rurikeigo', '2021-11-17 14:57:24', 'thanhminhyp99'),
(2, 'ÁO GIAO LĨNH NGŨ HÀNH', '18', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Giao Lĩnh Ngũ Hành</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Áo Giao Lĩnh Ngũ Hành là dạng áo cách tân từ áo Giao Lĩnh truyền thống với điểm nhấn là dải ngũ hành ở tay áo.</div>\r\n\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Áo Giao Lĩnh Ngũ Hành có 2 màu: Đỏ đô hoặc Trắng be.</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Áo Giao Lĩnh Ngũ Hành có thể phối hợp với chân váy Cát Phượng. Chân váy Cát Phượng cũng có 2 màu: Đỏ đô hoặc Trắng be</div>\r\n\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Áo Giao Lĩnh Ngũ Hành có giá 390K</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Chân váy Cát Phượng có giá 400K</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Combo Áo và Chân Váy có giá 750K</div>\r\n</div>', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Áo Giao Lĩnh Ngũ Hành là dạng áo cách tân từ áo Giao Lĩnh truyền thống với điểm nhấn là dải ngũ hành ở tay áo.</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Áo Giao Lĩnh Ngũ Hành có 2 màu: Đỏ đô hoặc Trắng be.</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Áo Giao Lĩnh Ngũ Hành có thể phối hợp với chân váy Cát Phượng. Chân váy Cát Phượng cũng có 2 màu: Đỏ đô hoặc Trắng be</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Áo Giao Lĩnh Ngũ Hành có giá 390K</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Chân váy Cát Phượng có giá 400K</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Combo Áo và Chân Váy có giá 750K</div>', '390000', NULL, 'product/xbfw_SAN_4338.jpg', '0', 'active', 'normal', '2021-11-16 20:32:13', 'rurikeigo', '2021-11-17 14:57:34', 'thanhminhyp99'),
(3, 'ÁO NHẬT BÌNH CÁCH TÂN HỒ YÊU', '18', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box; text-align: left;\">Mã sản phẩm:&nbsp;Áo Nhật bình cách tân Hồ Yêu</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p style=\"text-align:left\">Mẫu áo Nhật bình cách tân Hồ Yêu được cách tân từ trang phục nhật bình truyền thống, có sử dụng hoa văn Hồ Ly đã được thiết kế và in lại trên nền vải gấm. Chất vải cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, thoáng mát, và có hai màu để lựa chọn: Đỏ hoặc Trắng</p>\r\n</div>', '<p style=\"text-align:left\">Mẫu áo Nhật bình cách tân Hồ Yêu được cách tân từ trang phục nhật bình truyền thống, có sử dụng hoa văn Hồ Ly đã được thiết kế và in lại trên nền vải gấm. Chất vải cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, thoáng mát, và có hai màu để lựa chọn: Đỏ hoặc Trắng</p>\r\n\r\n<p style=\"text-align:left\">Nhật bình cách tân Hồ Yêu là dạng áo khoác ngoài, có 2 khuy (khuy ngọc tròn và khuy gài), phối thêm huy hiệu hồ yêu xinh xắn. Phù hợp cho mặc hàng ngày, đi chơi, đi du lịch, đi làm,…</p>\r\n\r\n<p style=\"text-align:left\">Nhật bình cách tân Hồ Yêu có thể kết hợp với Yếm Phượng, hoặc các mẫu chân váy trơn sẵn có của khách</p>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px; text-align: left;\"><strong>KHÁCH HÀNG KHÔNG CHỌN ĐƯỢC SIZE HOẶC OVERSIZE VUI LÒNG INBOX FANPAGE ĐỂ ĐƯỢC TƯ VẤN CỤ THỂ HƠN</strong></div>', '400000', NULL, 'product/SAN_4117-1.jpg', NULL, 'active', 'featured', '2021-11-17 13:45:36', 'thanhminhyp99', '2021-11-18 22:55:55', 'rurikeigo'),
(4, 'ÁO NHẬT BÌNH CÁCH TÂN SAPPHIRE & EMERALD (LAM NGỌC & LỤC NGỌC)', '18', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Nhật Bình cách tân Sapphire &amp; Emerald</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p>Mẫu áo Nhật Bình cách tân Sapphire &amp; Emerald (Lam ngọc &amp; Lục ngọc) được lấy ý tưởng từ Nhật bình thời Nguyễn, kết hợp cùng một số hoa văn Đại Việt quen thuộc.</p>\r\n\r\n<p>Nhật bình cách tân Sapphire &amp; Emerald (Lam ngọc &amp; Lục ngọc) là dạng áo khoác ngoài, có 2 khuy (khuy ngọc liên hoa và khuy gài) may bằng chất liệu vải voan mỏng nhẹ, tiên tử. Phù hợp cho mặc hàng ngày, đi chơi, đi du lịch, đi làm,…</p>\r\n</div>', '<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Mẫu áo Nhật Bình cách tân Sapphire &amp; Emerald (Lam ngọc &amp; Lục ngọc) được lấy ý tưởng từ Nhật bình thời Nguyễn, kết hợp cùng một số hoa văn Đại Việt quen thuộc.</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p style=\"text-align:justify\">Nhật bình cách tân Sapphire &amp; Emerald (Lam ngọc &amp; Lục ngọc) là dạng áo khoác ngoài, có 2 khuy (khuy ngọc liên hoa và khuy gài) may bằng chất liệu vải voan mỏng nhẹ, tiên tử. Phù hợp cho mặc hàng ngày, đi chơi, đi du lịch, đi làm,…</p>\r\n\r\n<p style=\"text-align:justify\">Nhật bình cách tân Sapphire &amp; Emerald (Lam ngọc &amp; Lục ngọc) có thể kết hợp với chân váy mà mọi người đã có sẵn</p>\r\n</div>\r\n\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Áo có 2 phối màu chính đều cực kỳ tươi mát và phù hợp với mùa hè luônnnnn:</div>\r\n\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">– Sapphire (Lam ngọc)</div>\r\n\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">– Emerald (Lục ngọc)</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Giá: 450k</div>', '450000', NULL, 'product/b.jpg', NULL, 'active', 'featured', '2021-11-17 13:48:34', 'thanhminhyp99', '2021-11-18 22:55:53', 'rurikeigo'),
(5, 'ÁO NGŨ THÂN CÁCH TÂN VIỀN LỤC GIÁC (UNISEX)', '18', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo ngũ thân cách tân viền lục giác</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu Áo ngũ thân cách tân viền lục giác sử dụng chất liệu cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, sờ thích, thoáng mát, thường dùng may đồ công sở (cotton 95%, 5% spandex chống nhăn).</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu Áo ngũ thân cách tân viền lục giác có 3 lựa chọn về màu sắc: Đen, Đỏ hoặc Trắng, Đây là mẫu áo Unisex, cả nam và nữ đều mặc được.</div>\r\n\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><strong>KHÁCH HÀNG KHÔNG CHỌN ĐƯỢC SIZE HOẶC OVERSIZE VUI LÒNG INBOX FANPAGE ĐỂ ĐƯỢC TƯ VẤN CỤ THỂ HƠN</strong></div>\r\n</div>\r\n</div>', '<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Mẫu Áo ngũ thân cách tân viền lục giác là kiểu áo cách tân của áo Ngũ thân tay chẽn – là kiểu áo đặc trưng nhất thời Nguyễn, cũng như là tiền thân của áo dài ngày nay. Áo có sử dụng hoa văn triều Nguyễn được sắp xếp ngẫu hứng đầy màu sắc, tạo nên nét nổi bật ở phần viền cổ và viền tay áo.</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Mẫu Áo ngũ thân cách tân viền lục giác sử dụng chất liệu cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, sờ thích, thoáng mát, thường dùng may đồ công sở (cotton 95%, 5% spandex chống nhăn).</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Mẫu Áo ngũ thân cách tân viền lục giác có 3 lựa chọn về màu sắc: Đen, Đỏ hoặc Trắng, Đây là mẫu áo Unisex, cả nam và nữ đều mặc được.</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div style=\"box-sizing: border-box;\"><strong>KHÁCH HÀNG KHÔNG CHỌN ĐƯỢC SIZE HOẶC OVERSIZE VUI LÒNG INBOX FANPAGE ĐỂ ĐƯỢC TƯ VẤN CỤ THỂ HƠN</strong></div>\r\n</div>', '390000', NULL, 'product/94197326_2790701634382663_1846585051060371456_n-600x640.jpg', NULL, 'inactive', 'normal', '2021-11-18 14:15:49', 'thanhminhyp99', '2021-11-18 17:46:43', NULL),
(6, 'ÁO ĐỐI KHÂM (UNISEX)', '1', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Đối Khâm (Unisex)</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu áo Đối Khâm cách tân chất liệu cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, sờ thích, thoáng mát, thường dùng may đồ công sở.</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu áo Đối Khâm có 2 lựa chọn hoa văn: hình phượng (đỏ) hoặc hình mãng (xanh), và là dạng unisex, cả nam và nữ đều mặc được.</div>\r\n\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n\r\n<div style=\"box-sizing: border-box;\">\r\n<div style=\"box-sizing: border-box;\"><strong>KHÁCH HÀNG KHÔNG CHỌN ĐƯỢC SIZE HOẶC OVERSIZE VUI LÒNG INBOX FANPAGE ĐỂ ĐƯỢC TƯ VẤN CỤ THỂ HƠN</strong></div>\r\n</div>\r\n</div>', '<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu áo Đối Khâm cách tân chất liệu cotton lóng vuông mềm mịn, hút mồ hôi, mặt vải lạnh, sờ thích, thoáng mát, thường dùng may đồ công sở (cotton 95%, 5% spandex chống nhăn).</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box;\">Mẫu áo Đối Khâm có 2 lựa chọn hoa văn: hình phượng (đỏ) hoặc hình mãng (xanh), và là dạng unisex, cả nam và nữ đều mặc được.</div>\r\n\r\n<div style=\"box-sizing: border-box;\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Chữ Khâm trong áo Đối Khâm có nghĩa là vạt áo trước. Đối Khâm là dạng áo có hai vạt trước đặt song song nhau, thường để buông.</div>\r\n\r\n<div class=\"kvgmc6g5 cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">Tuỳ vào thời đại, đối khâm còn có những tên như bối tử (thời Tống), phi phong (thời Minh), và nhật bình (thời Nguyễn). Mỗi thời đại, kiểu dáng sẽ thay đổi đôi chút. Không như giao lĩnh và viên lĩnh (có 6 thân), hay thụ lĩnh triều Nguyễn (có 5 thân – còn được gọi là ngũ thân), đối khâm chỉ có 4 thân nên dân gian còn gọi là tứ thân.</div>\r\n\r\n<div style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">&nbsp;</div>\r\n\r\n<div class=\"o9v6fnle cxmmr5t8 oygrvhab hcukyx3x c1et5uql\" style=\"box-sizing: border-box; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div style=\"box-sizing: border-box;\"><strong>KHÁCH HÀNG KHÔNG CHỌN ĐƯỢC SIZE HOẶC OVERSIZE VUI LÒNG INBOX FANPAGE ĐỂ ĐƯỢC TƯ VẤN CỤ THỂ HƠN</strong></div>\r\n</div>', '400000', '350000', 'product/SAN_5111-1-600x899.jpg', '[\"product/MG_7779-1-600x900.jpg\",\"product/94197326_2790701634382663_1846585051060371456_n-600x640.jpg\",\"product/93482719_2851835821590790_3541953670952255488_n-600x900-1.jpg\"]', 'active', 'featured', '2021-11-18 17:53:26', 'thanhminhyp99', '2021-11-18 22:55:51', 'rurikeigo'),
(7, 'ÁO NGŨ THÂN TAY CHẼN HSSV VẢI ĐŨI TUYẾT NHẬT CHO NAM HOẶC NỮ', '1', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Ngũ Thân Tay Chẽn HSSV vải đũi tuyết Nhật cho nam hoặc nữ</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Áo Ngũ Thân Tay Chẽn HSSV vải đũi tuyết Nhật cho nam hoặc nữ là may bằng vải đũi tuyết Nhật, may 1 lớp, hướng tới đối tượng HSSV. Có 4 màu để lựa chọn: Xanh trời, xanh rêu, hồng vỏ đỗ, xám nhạt.</p>\r\n\r\n<ul>\r\n	<li>Chất liệu vải đũi tuyết Nhật được lựa chọn cẩn thận, rất mát, thấm hút mồ hôi, ít nhăn, không phai màu,và phù hợp với học sinh, sinh viên khi mặc hàng ngày và vận động nhiều.</li>\r\n</ul>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo: 800k với đối tượng HSSV, và 900k với các đối tượng khác. Sản phẩm này, shop khuyến khích phối với quần jean, quần thô năng động trẻ trung</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;May thêm quần +200k.</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;May thêm khăn nam +200k, khăn nữ 1 vòng +100k, khăn nữ 2 vòng +150k</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n</div>', '<blockquote>\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Áo Ngũ Thân Tay Chẽn HSSV vải đũi tuyết Nhật cho nam hoặc nữ là may bằng vải đũi tuyết Nhật, may 1 lớp, hướng tới đối tượng HSSV. Có 4 màu để lựa chọn: Xanh trời, xanh rêu, hồng vỏ đỗ, xám nhạt.</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li>Chất liệu vải đũi tuyết Nhật được lựa chọn cẩn thận, rất mát, thấm hút mồ hôi, ít nhăn, không phai màu,và phù hợp với học sinh, sinh viên khi mặc hàng ngày và vận động nhiều.</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo: 800k với đối tượng HSSV, và 900k với các đối tượng khác. Sản phẩm này, shop khuyến khích phối với quần jean, quần thô năng động trẻ trung</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;May thêm quần +200k.</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;May thêm khăn nam +200k, khăn nữ 1 vòng +100k, khăn nữ 2 vòng +150k</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>', '900000', '800000', 'product/1WV05410-600x900.jpg', '[\"product/1WV05576-600x900.jpg\",\"product/1WV05568-600x900.jpg\",\"product/1WV05246-600x900.jpg\"]', 'active', 'normal', '2021-11-19 15:34:48', 'rurikeigo', NULL, NULL),
(8, 'FULLSET ÁO NGŨ THÂN TAY CHẼN VẢI GẤM IN HOA VĂN CHO NAM', '1', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Ngũ Thân Tay Chẽn vải gấm in hoa văn cho nam</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set áo Ngũ Thân Tay Chẽn vải gấm in hoa văn cho nam gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải gấm in hoa văn chìm, có thể lựa chọn màu bất kỳ và bộ hoa văn<br />\r\n– Quần cotton trắng<br />\r\n– Khăn đóng sẵn cho nam</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset: 2050k</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo Ngũ Thân Tay Chẽn: 1650k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n</div>', '<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set áo Ngũ Thân Tay Chẽn vải gấm in hoa văn cho nam gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải gấm in hoa văn chìm, có thể lựa chọn màu bất kỳ và bộ hoa văn<br />\r\n– Quần cotton trắng<br />\r\n– Khăn đóng sẵn cho nam</p>\r\n\r\n<ul>\r\n	<li>File hoa văn của áo Ngũ Thân Tay Chẽn được thiết kế độc quyền, màu sắc hài hòa, sử dụng công nghệ in tiên tiến nhất, tạo đường in sắc nét và siêu bền màu, rất được các Studio và nháy ưa chuộng vì lên ảnh đẹp.</li>\r\n	<li>Áo Ngũ Thân Tay Chẽn may bằng vải gấm có hoa văn chìm đặc biệt, tạo nên sự sang trọng và có hồn cho áo, rất đặc trưng và dễ phân biệt với các áo bên khác, tạo chiều sâu cho bức ảnh, video.</li>\r\n	<li>Dây khuy của Áo Ngũ Thân Tay Chẽn sử dụng kỹ thuật cải tiến, và sử dụng cúc đồng, đem lại sự tinh tế, quý phái cho sản phẩm.</li>\r\n	<li>Áo Ngũ Thân Tay Chẽn may 2 lớp, với lớt lót trong là vải habutai Nhật, mềm mại, thấm hút mồ hôi, mặt vải lạnh, sờ thích, êm da</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset: 2050k</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo Ngũ Thân Tay Chẽn: 1650k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p style=\"text-align:justify\"><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n\r\n<p style=\"text-align:justify\">Nguồn ảnh: Feedback khách hàng chị Lan Anh</p>', '3000000', '2050000', 'product/SAN_5709-copy-768x1152.jpg', '[\"product/WWV00980-600x900.jpg\",\"product/WWV00971-600x900.jpg\",\"product/WWV00914-600x900.jpg\"]', 'active', 'normal', '2021-11-19 15:37:08', 'rurikeigo', '2021-11-19 15:37:37', NULL),
(9, 'FULLSET ÁO NGŨ THÂN TAY CHẼN VẢI GẤM IN HOA VĂN CHO NỮ', '1', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Fullset Ngũ Thân Tay Chẽn vải gấm in hoa văn</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set áo Ngũ Thân Tay Chẽn vải gấm in hoa văn cho nữ gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải gấm in hoa văn chìm, có thể lựa chọn màu bất kỳ và bộ hoa văn<br />\r\n– Quần cotton trắng<br />\r\n– Khăn vành đóng sẵn cho nữ hoặc khăn lươn</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset:</p>\r\n\r\n<ul>\r\n	<li>2200k nếu dùng khăn vành đóng sẵn</li>\r\n	<li>1950k nếu dùng khăn lươn 1 vòng</li>\r\n	<li>2000k nếu dùng khăn lươn 2 vòng</li>\r\n</ul>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo Ngũ Thân Tay Chẽn: 1650k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n\r\n<p>Nguồn ảnh: hiệu ảnh Việt Phục Bull</p>\r\n</div>', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Fullset Ngũ Thân Tay Chẽn vải gấm in hoa văn</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set áo Ngũ Thân Tay Chẽn vải gấm in hoa văn cho nữ gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải gấm in hoa văn chìm, có thể lựa chọn màu bất kỳ và bộ hoa văn<br />\r\n– Quần cotton trắng<br />\r\n– Khăn vành đóng sẵn cho nữ hoặc khăn lươn</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset:</p>\r\n\r\n<ul>\r\n	<li>2200k nếu dùng khăn vành đóng sẵn</li>\r\n	<li>1950k nếu dùng khăn lươn 1 vòng</li>\r\n	<li>2000k nếu dùng khăn lươn 2 vòng</li>\r\n</ul>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng áo Ngũ Thân Tay Chẽn: 1650k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n\r\n<p>Nguồn ảnh: hiệu ảnh Việt Phục Bull</p>\r\n</div>', '3000000', '2200000', 'product/SAN_6032-copy-768x1152.jpg', '[\"product/SAN_6051-copy-600x900.jpg\",\"product/SAN_6033-copy-768x1152.jpg\",\"product/152001882_269778958105730_2032000446896798078_n-600x900.jpg\"]', 'active', 'normal', '2021-11-19 15:39:42', 'rurikeigo', NULL, NULL),
(10, 'FULLSET ÁO NGŨ THÂN TAY CHẼN VẢI SA HOẶC TƠ CHO NỮ', '1', '<div class=\"product_meta\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<div class=\"sku-wrap\" style=\"box-sizing: border-box;\">Mã sản phẩm:&nbsp;Áo Ngũ Thân Tay Chẽn vải sa hoặc tơ cho nữ</div>\r\n</div>\r\n\r\n<div class=\"short-description\" style=\"box-sizing: border-box; margin: 10px 0px 0px; color: rgb(102, 102, 102); font-family: Roboto, sans-serif; font-size: 14px;\">\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set Áo Ngũ Thân Tay Chẽn vải sa hoặc tơ cho nữ gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải sa hàn hoặc vải tơ sống, tơ vân, tơ thủy ngư, tơ hoa cúc, tơ xước kim, … Màu vải lựa chọn trong bảng màu của shop (inbox để được tư vấn).<br />\r\n– Quần cotton trắng<br />\r\n– Khăn lươn một vòng cho nữ</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset: 1650k. (Nếu lựa chọn khăn lươn 2 vòng thì +50k)</p>\r\n\r\n<p><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng Áo Ngũ Thân Tay Chẽn: 1350k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>\r\n</div>', '<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Set Áo Ngũ Thân Tay Chẽn vải sa hoặc tơ cho nữ gồm<br />\r\n– Áo Ngũ Thân Tay Chẽn vải sa hàn hoặc vải tơ sống, tơ vân, tơ thủy ngư, tơ hoa cúc, tơ xước kim, … Màu vải lựa chọn trong bảng màu của shop (inbox để được tư vấn).<br />\r\n– Quần cotton trắng<br />\r\n– Khăn lươn một vòng cho nữ</p>\r\n\r\n<ul>\r\n	<li>Chất liệu vải sa hàn hoặc vải tơ sống, tơ vân, tơ thủy ngư, tơ hoa cúc, tơ xước kim, … đều là những chất liệu sang trọng, phù hợp với các sự kiện lớn, các dịp lễ trọng đại, chụp ảnh cưới, …</li>\r\n	<li>Dây khuy của Áo Ngũ Thân Tay Chẽn V’style sử dụng kỹ thuật cải tiến, và sử dụng cúc đồng, đem lại sự tinh tế, quý phái cho sản phẩm.</li>\r\n	<li>Áo Ngũ Thân Tay Chẽn V’style may 2 lớp, với lớt lót trong là vải habutai Nhật, mềm mại, thấm hút mồ hôi, mặt vải lạnh, sờ thích, êm da</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá fullset: 1650k. (Nếu lựa chọn khăn lươn 2 vòng thì +50k)</p>\r\n\r\n<p style=\"text-align:justify\"><img alt=\"✨\" class=\"lazy loaded\" src=\"https://static.xx.fbcdn.net/images/emoji.php/v9/t7b/1.5/16/2728.png\" style=\"border-style:none; box-sizing:border-box; height:auto; max-width:100%; min-height:1px; vertical-align:middle; width:auto\" />&nbsp;Giá riêng Áo Ngũ Thân Tay Chẽn: 1350k.&nbsp;<strong>Nếu mua lẻ các món, vui lòng inbox facebook fanpage để được tư vấn</strong></p>\r\n\r\n<p style=\"text-align:justify\"><strong>ĐỒ MAY THEO SỐ ĐO NÊN KHÁCH HÀNG VUI LÒNG INBOX FACEBOOK FANPAGE ĐỂ ĐƯỢC TƯ VẤN ĐẦY ĐỦ</strong></p>', '2000000', '1650000', 'product/SAN_6219-copy-768x1152.jpg', NULL, 'active', 'featured', '2021-11-19 15:43:39', 'rurikeigo', '2021-11-22 03:45:55', 'rurikeigo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `config_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `config_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`config_key`, `config_value`, `created`, `created_by`, `modified`, `modified_by`) VALUES
('favicon', 'setting/favicon.png', '2021-11-19 08:17:24', '', '2021-11-19 13:40:08', 'rurikeigo'),
('logo', 'setting/logo.png', '2021-11-19 13:37:41', '', '2021-11-19 13:55:48', 'rurikeigo'),
('banner1', 'setting/banner1.jpg', '2021-11-19 14:14:15', '', '2021-11-19 14:24:17', 'rurikeigo'),
('banner2', 'setting/banner2.jpg', '2021-11-19 14:14:15', '', '2021-11-19 14:29:59', 'rurikeigo'),
('banner3', 'setting/banner3.jpg', '2021-11-19 14:14:43', '', '2021-11-19 14:32:24', 'rurikeigo'),
('banner4', 'setting/banner4.jpg', '2021-11-19 14:14:43', '', '2021-11-19 14:43:29', 'rurikeigo'),
('banner_product', 'setting/banner_product.jpg', '2021-11-19 14:46:22', '', '2021-11-19 14:48:00', 'rurikeigo'),
('hotline', '0985831314', '2021-11-19 16:28:55', '', '2021-11-19 16:48:54', 'rurikeigo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`id`, `name`, `description`, `link`, `thumb`, `status`, `created`, `modified`, `created_by`, `modified_by`, `ordering`) VALUES
(1, 'slider-1', '<h2><span style=\"color:#FFFFFF\">Kid Smart <strong>Watches</strong></span></h2>\r\n\r\n<p><em><strong>Compra todos tus </strong></em>productos Smart por internet..</p>\r\n\r\n<p>Only price: $59.99</p>', 'https://laravel.com/docs/8.x/blade', 'slider/3sLp_244737362_354817609755648_2171652065767239413_n.jpg', 'active', '2021-08-12 18:54:36', '2021-11-17 15:15:01', 'kieu le', 'thanhminhyp99', 1),
(2, 'slider-2', '<p>On online payments</p>', 'https://laravel.com/docs/8.x/blade', 'slider/9lrT_241182717_341030317801044_2389961409902309855_n.jpg', 'active', '2021-08-12 18:54:36', '2021-11-17 15:15:12', 'kieu le', 'thanhminhyp99', 2),
(3, 'slider-3', '<p>Exclusive Furniture Packages to Suit every need...</p>', 'https://laravel.com/docs/8.x/blade', 'slider/banner1.jpg', 'active', '2021-08-12 18:54:36', '2021-11-17 15:16:06', 'kieu le', 'thanhminhyp99', 3),
(12, 'slider-4', NULL, 'http://localhost/shop/public/admin/slider/add', 'slider/ReR5_180693716_245405420696868_3120169509397477140_n.jpg', 'active', '2021-11-06 06:37:51', '2021-11-17 15:16:26', 'admin', 'thanhminhyp99', NULL),
(13, 'slider-12hhh', NULL, 'http://localhost/shop/public/admin/slider/add', 'slider/243336969_351285820108827_3089387011270810149_n.jpg', 'active', '2021-11-10 07:10:54', '2021-11-17 15:16:47', 'rurikeigo', 'thanhminhyp99', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `created_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `avatar`, `status`, `level`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'rurikeigo', 'thientamyp@gmail.com', 'Nguyễn Thị Tâm', '41cfe1093824f14feef5c4b97fca964b', 'user/nPQj_FB_IMG_1630828780811.jpg', 'active', 'admin', '2021-11-06 11:00:13', 'rurikeigo', '2021-11-17 15:14:16', 'thanhminhyp99'),
(4, 'thanhminhyp99', 'admin@gmail.com', 'Nguyễn Thị Tâm', '41cfe1093824f14feef5c4b97fca964b', 'user/gTX9_482fadb9cf56e282eab4c9f76a955659.png', 'active', 'admin', '2021-11-08 09:42:56', NULL, '2021-11-21 08:49:59', 'thanhminhyp99'),
(7, 'cocgiayxanh', 'ahaha@gmail.com', 'Nguyễn Thị Tâm', '41cfe1093824f14feef5c4b97fca964b', 'user/user.png', 'active', 'member', '2021-11-08 17:07:51', NULL, '2021-11-21 08:45:16', 'thanhminhyp99'),
(8, 'tamtam1999', 'tamtam1k99@gmail.com', 'Nà Ní', '41cfe1093824f14feef5c4b97fca964b', 'user/user.png', 'inactive', 'member', '2021-11-08 20:14:45', 'tamtam1999', '2021-11-19 08:08:32', 'rurikeigo'),
(9, 'hoaxubac', 'haha@gmail.com', 'Nà Ní', '41cfe1093824f14feef5c4b97fca964b', 'user/user.png', 'inactive', 'admin', '2021-11-10 07:13:33', 'rurikeigo', '2021-11-19 08:08:41', 'rurikeigo');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
