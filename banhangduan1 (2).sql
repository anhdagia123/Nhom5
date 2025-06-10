-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2025 at 05:03 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banhangduan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrts`
--

CREATE TABLE `carrts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `cate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_name`) VALUES
(1, 'Áo Nam'),
(6, 'Quần Nam'),
(7, 'Best seller'),
(10, 'tuan'),
(12, 'Mới 1'),
(13, 'Mới 2');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `content`, `created_at`, `status`) VALUES
(1, 10, 14, 'Sản phẩm rất tốt', '2025-06-06 12:34:33', 0),
(2, 10, 1, 'Sản phẩm chất lượng mà hết hàng, tiếc quá', '2025-06-07 15:26:20', 0),
(3, 10, 13, 'sdfghjkl', '2025-06-07 15:52:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `payment_method`, `total_price`, `created_at`) VALUES
(1, 9, 1, 'card', '199.00', '2025-06-05 05:13:22'),
(2, 9, 1, 'cod', '995.00', '2025-06-05 18:38:23'),
(3, 9, 1, 'card', '199597.00', '2025-06-06 03:35:37'),
(4, 9, 1, 'cod', '398.00', '2025-06-06 03:36:50'),
(5, 9, 1, 'cod', '199199.00', '2025-06-06 03:47:16'),
(6, 10, 1, 'cod', '199199.00', '2025-06-06 04:02:04'),
(7, 10, 1, 'cod', '199199.00', '2025-06-06 04:11:37'),
(8, 10, 1, 'cod', '796.00', '2025-06-06 04:17:09'),
(9, 10, 1, 'cod', '398.00', '2025-06-06 04:22:39'),
(10, 10, 1, 'cod', '199.00', '2025-06-06 04:43:31'),
(11, 10, 1, 'cod', '199.00', '2025-06-06 04:51:53'),
(12, 10, 3, 'cod', '199.00', '2025-06-06 05:20:13'),
(13, 10, 3, 'cod', '199.00', '2025-06-06 05:20:30'),
(14, 10, 3, 'cod', '100.00', '2025-06-06 10:33:54'),
(15, 10, 1, 'cod', '199000.00', '2025-06-06 10:43:50'),
(16, 10, 3, 'cod', '199000.00', '2025-06-06 10:46:57'),
(17, 10, 3, 'cod', '199000.00', '2025-06-07 08:49:33'),
(18, 10, 3, 'cod', '199.00', '2025-06-07 11:11:57'),
(19, 10, 1, 'cod', '199.00', '2025-06-07 16:56:33'),
(20, 10, 1, 'cod', '199199.00', '2025-06-07 17:27:06'),
(21, 10, 0, 'cod', '199.00', '2025-06-08 03:14:50'),
(22, 10, 0, 'cod', '199.00', '2025-06-08 03:18:48'),
(23, 10, 3, 'cod', '199000.00', '2025-06-08 03:50:44'),
(24, 10, 3, 'cod', '1592796.00', '2025-06-08 03:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 1, 14, 199, 1),
(2, 2, 14, 199, 4),
(3, 2, 16, 199, 1),
(4, 3, 14, 199, 3),
(5, 3, 13, 199000, 1),
(6, 4, 14, 199, 1),
(7, 4, 16, 199, 1),
(8, 5, 14, 199, 1),
(9, 5, 13, 199000, 1),
(10, 6, 14, 199, 1),
(11, 6, 13, 199000, 1),
(12, 7, 13, 199000, 1),
(13, 7, 14, 199, 1),
(14, 8, 14, 199, 3),
(15, 8, 16, 199, 1),
(16, 9, 14, 199, 1),
(17, 9, 16, 199, 1),
(18, 10, 16, 199, 1),
(19, 11, 14, 199, 1),
(20, 12, 14, 199, 1),
(21, 13, 14, 199, 1),
(22, 14, 1, 100, 1),
(23, 15, 13, 199000, 1),
(24, 16, 13, 199000, 1),
(25, 17, 13, 199000, 1),
(26, 18, 16, 199, 1),
(27, 19, 16, 199, 1),
(28, 20, 16, 199, 1),
(29, 20, 13, 199000, 1),
(30, 21, 16, 199, 1),
(31, 22, 16, 199, 1),
(32, 23, 13, 199000, 1),
(33, 24, 16, 199, 4),
(34, 24, 13, 199000, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'status : trang thai kinh doanh . 1 : dang kinh doanh , 0 : ngưng kinh doanh',
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `quantity`, `description`, `content`, `status`, `category_id`) VALUES
(1, 'Áo Sơ Mi', 'images/aosomi1.webp', '100.00', 10, 'test 1', 'test 1', 1, 6),
(10, 'Áo Bò', 'images/banner 1.webp', '199000.00', 1, 'áo đẹp', 'áo ok', 1, 7),
(12, 'Áo Sơ Mi', 'images/aosomi1.webp', '200000.00', 1, 'OK', 'ok', 1, 6),
(13, 'Áo Sơ Mi', 'images/aosimi3.webp', '199000.00', 82, 'sss', 'sss', 1, 1),
(14, 'Áo Sơ Mi OK', 'images/aosomi1.webp', '199.00', 83, '111', '111', 1, 10),
(15, 'Sơ mi cao cấp', 'images/aosomi2.webp', '199.00', 1, '111111111', '1111', 1, 7),
(16, 'Áo Sơ Mi', 'images/aosomi2.webp', '199.00', 96, 'ok', 'dep', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `phone`, `role`, `address`, `created_at`, `updated_at`, `active`) VALUES
(1, 'Tuấn Vương', 'tuanvxph48985@gmail.com', '$2y$10$e8AjrSNsTpth5ksdsDCazeqvl2QUD2DoRtq6IQ6QXviLoT04QNx3a', '0367556095', 'user', 'Hà Nội', '2025-05-27 12:35:26', '2025-05-27 12:35:26', 0),
(2, 'Tuấn Vương', 'tuanvxph48985@gmail.com', '$2y$10$7/fk.CHSdxW8w6MJbihaf.JW08piZ2CD/P/Y6d2pjgBSWn18Yhv0m', '0367556095', 'user', 'Hà Nội', '2025-05-27 12:37:11', '2025-05-27 12:37:11', 1),
(3, 'tuan11', 'tam@gmail.com', '$2y$10$iBHOCY1Zqu059cznkc3o5OHZuhpsap3Oe1MN7EFRMB498aQ7DTtsC', '0367556095', 'user', 'Hà Nội', '2025-05-27 12:42:01', '2025-05-27 12:42:01', 1),
(4, 'Admin', 'admin@gmail.com', 'password', '0367556095', 'admin', 'Hà Nội', '2025-05-27 12:46:27', '2025-05-27 12:46:27', 1),
(5, 'kien', 'kien@gmail.com', '123456', '123456789', 'admin', 'ấdnjkakbda', '2025-05-28 12:58:49', '2025-05-28 12:58:49', 1),
(6, 'Nguyễn Trung kiên', 'nguyenkien19762005@gmail.com', '$2y$10$eLXi820yJ4hhJ5A4SFPfTuU7bYNknS7vLSMoYXhNLoLdYfLLs8r1y', '0763322976', 'user', 'Mỹ Đình - Hà Nội', '2025-05-29 08:14:21', '2025-05-29 08:14:21', 1),
(7, 'kien', 'kien@gmail.com', '1', '123456789', 'admin', 'áđâsdsda', '2025-06-04 14:56:34', '2025-06-04 14:56:34', 1),
(8, 'minh hieu', 'minhhieu@gmail.com', '$2y$10$yNyPcZIn2rXMI4M/V.adWeGFY2aGeA9I1EHJmmMgqBnXjJC1V/tOW', '0365016573', 'user', 'ok', '2025-06-05 04:56:53', '2025-06-05 04:56:53', 1),
(9, 'admin2', 'admin2@gmail.com', '$2y$10$mirCsmVS481If9IUBGmCpeG/1VaigOh7InmE1BSo2xpAcXRDRhieu', '89253845843', 'admin', 'uhfhfhfhhf', '2025-06-05 05:09:47', '2025-06-05 05:09:47', 1),
(10, 'user1', 'user1@gmail.com', '$2y$10$ALsReGkcGdnOK1YU5A/53.QZ20UUGu.CeZyzftqp6qgQGInOrHrVe', '89253845843', 'user', 'không có', '2025-06-06 03:59:05', '2025-06-06 03:59:05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrts`
--
ALTER TABLE `carrts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrts`
--
ALTER TABLE `carrts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
