-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2025 lúc 05:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `seo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `meta_description`, `price`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Trà Sữa Trân Châu Đường Đen', 'tra-sua-tran-chau-duong-den', 'Sự kết hợp hoàn hảo giữa trà sữa thơm béo và trân châu đường đen nấu chậm.', 'Mua trà sữa trân châu đường đen ngon nhất Đà Nẵng. Hương vị đậm đà, trân châu dai giòn.', 35000.00, '/storage/products/tra-sua-tran-chau-duong-den-1764337104.jpg', '2025-11-28 02:25:01', '2025-11-28 06:38:24'),
(2, 'Cà Phê Muối Huế', 'ca-phe-muoi-hue', 'Vị đắng của cà phê hòa quyện với lớp kem muối mặn ngọt béo ngậy.', 'Cà phê muối chuẩn vị Huế. Giao hàng tận nơi, đảm bảo hương vị độc đáo.', 29000.00, '/storage/products/ca-phe-muoi-hue-1764517416.jpg', '2025-11-28 02:25:01', '2025-11-30 08:43:36'),
(3, 'Cà Phê Đen Đá', 'ca-phe-den-da', 'Đen Đá', 'Đen Đá', 20000.00, '/storage/products/ca-phe-den-da.jpg', '2025-11-30 04:47:30', '2025-11-30 04:47:30'),
(4, 'Bạc Xỉu', 'bac-xiu', 'test', 'test', 20000.00, '/storage/products/bac-xiu.jpg', '2025-11-30 02:59:00', '2025-11-30 02:59:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
