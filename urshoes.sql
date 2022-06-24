-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2021 at 03:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `urshoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin__id` int(11) NOT NULL,
  `admin__name` varchar(255) NOT NULL,
  `admin__email` varchar(255) NOT NULL,
  `admin__user` varchar(255) NOT NULL,
  `admin__pass` varchar(255) NOT NULL,
  `admin__level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin__id`, `admin__name`, `admin__email`, `admin__user`, `admin__pass`, `admin__level`) VALUES
(2, 'thanh', 'thanh@gmail.com', 'adminthanh', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `fullname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `province` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Chờ xử lý, 1: Chuẩn bị, 2: Đang giao, 3: Đã giao'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`, `fullname`, `email`, `phone`, `province`, `district`, `address`, `date`, `total`, `status`) VALUES
('05a84ee95fa1641e042f8ad1488fd064', 0, 'Khách lẻ 4', 'khach4@gmail.com', '979786', 6, 7, 'Cẩm Sơn', '2021-12-16 15:40:21', 2636000, 0),
('1e413292a3077a46604cddbe4d42adcc', 18, 'Ngô Nhân', 'nhan@gmail.com', '08999', 0, 0, 'Tân Trung', '2021-12-09 23:11:20', 100000, 1),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 0, 'Khách 3', 'khach3@gmaiil.com', '33123123', 6, 7, 'An Định', '2021-12-16 14:35:37', 4654000, 0),
('4b438bac675a7ad90d1a0471b499671d', 0, 'Khách lẻ 4', 'khach4@gmail.com', '2343243', 2, 0, 'Phường 7', '2021-12-16 15:37:24', 419000, 1),
('6fe9dc9f8013736a7f66e0f3c09d25c4', 0, 'Khách lẻ 2', 'khach2@gmail.com', '44324234', 57, 0, 'Phường 2', '2021-12-14 14:34:42', 3495000, 2),
('92b935b2798f5d3cfaa7c3b44111c4c2', 0, 'Nhân 1', 'nhan1@gmail.com', '43243', 30, 18, 'Linh Trung', '2021-12-07 14:46:45', 1400, 0),
('a1950479f18bccb9ba05ac4555dd08fd', 0, 'Khách lẻ 6', 'khach4@gmail.com', '2343243', 11, 0, 'Phường 7', '2021-12-14 15:38:46', 2619000, 3),
('ba90070628a3555c6fd4e41c9b3c1c5b', 0, 'Ngô Hữu Nhân', 'nhan@gmail.com', '979786', 6, 7, 'Minh Đức', '2021-12-15 16:38:07', 200700, 2),
('c51a9d82284e2e17e3d06f55a9b5f7e0', 0, 'Khách lẻ 5', 'nhan@gmail.com', '2343243', 7, 0, 'Phường 7', '2021-12-13 15:38:13', 1119000, 0),
('c6fc9e63a587050c66c092bfb7ffc256', 0, 'Khách lẻ 2', 'khachle@gmail.com', '42423423423', 30, 18, 'Linh Xuân', '2021-12-17 15:11:28', 1343000, 3),
('dd084fb492da11564fc59b1c0f439b98', 0, 'Khách 2', 'khach@gmail.com', '434234', 6, 7, 'Cẩm Sơn', '2021-12-19 10:06:32', 200000, 0),
('e20acfce76ce43ce92e4b3bebc1e7bd5', 18, 'Ngô Hữu Nhân', 'nhan@gmail.com', '08999', 30, 18, 'Linh Trung', '2021-12-22 10:33:22', 200000, 2),
('ea733f6fd3004c0b9b2ecf72c5c18079', 0, 'Khách lẻ 1', 'khach1@gmail.com', '3123231', 13, 2, 'Phường 3', '2021-12-16 14:33:26', 1540000, 0),
('fae4d148973d77d450f9e9d26be6f4d6', 0, 'Ngô Hữu Nhân', 'nhan1@gmail.com', '42342323', 30, 18, 'Linh Trung', '2021-11-24 15:12:19', 2138000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_id` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_id`, `product_id`, `quantity`, `price`) VALUES
('05a84ee95fa1641e042f8ad1488fd064', 24, 1, 876000),
('05a84ee95fa1641e042f8ad1488fd064', 25, 2, 1500000),
('05a84ee95fa1641e042f8ad1488fd064', 35, 1, 260000),
('1e413292a3077a46604cddbe4d42adcc', 38, 1, 100000),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 23, 1, 419000),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 29, 3, 2700000),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 35, 1, 260000),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 36, 2, 480000),
('266c2d9c9b9f8f7db4fd1a7795aacf8b', 37, 1, 795000),
('4b438bac675a7ad90d1a0471b499671d', 23, 1, 419000),
('6fe9dc9f8013736a7f66e0f3c09d25c4', 29, 3, 2700000),
('6fe9dc9f8013736a7f66e0f3c09d25c4', 37, 1, 795000),
('92b935b2798f5d3cfaa7c3b44111c4c2', 26, 2, 1400),
('a1950479f18bccb9ba05ac4555dd08fd', 23, 1, 419000),
('a1950479f18bccb9ba05ac4555dd08fd', 25, 2, 1500000),
('a1950479f18bccb9ba05ac4555dd08fd', 28, 1, 700000),
('ba90070628a3555c6fd4e41c9b3c1c5b', 29, 1, 700),
('ba90070628a3555c6fd4e41c9b3c1c5b', 37, 2, 200000),
('c51a9d82284e2e17e3d06f55a9b5f7e0', 23, 1, 419000),
('c51a9d82284e2e17e3d06f55a9b5f7e0', 28, 1, 700000),
('c6fc9e63a587050c66c092bfb7ffc256', 23, 2, 838000),
('c6fc9e63a587050c66c092bfb7ffc256', 50, 1, 505000),
('dd084fb492da11564fc59b1c0f439b98', 39, 2, 200000),
('e20acfce76ce43ce92e4b3bebc1e7bd5', 39, 2, 200000),
('ea733f6fd3004c0b9b2ecf72c5c18079', 22, 2, 1440000),
('ea733f6fd3004c0b9b2ecf72c5c18079', 39, 1, 100000),
('fae4d148973d77d450f9e9d26be6f4d6', 23, 2, 838000),
('fae4d148973d77d450f9e9d26be6f4d6', 37, 1, 795000),
('fae4d148973d77d450f9e9d26be6f4d6', 50, 1, 505000);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category__id` int(11) NOT NULL,
  `category__name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category__id`, `category__name`) VALUES
(28, 'Giới thiệu'),
(29, 'Nữ'),
(30, 'Nam'),
(31, 'Tin tức'),
(32, 'Liên hệ');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment__id` int(11) NOT NULL,
  `customer__id` int(11) NOT NULL,
  `product__id` int(11) NOT NULL,
  `comment__content` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer__id` int(11) NOT NULL,
  `customer__name` varchar(255) NOT NULL,
  `customer__email` varchar(100) NOT NULL,
  `customer__phone` varchar(10) NOT NULL,
  `customer__province` varchar(30) NOT NULL,
  `customer__district` varchar(30) NOT NULL,
  `customer__ward` varchar(30) NOT NULL,
  `customer__address` varchar(255) NOT NULL,
  `customer__pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer__id`, `customer__name`, `customer__email`, `customer__phone`, `customer__province`, `customer__district`, `customer__ward`, `customer__address`, `customer__pass`) VALUES
(7, 'c', 'c@gmail.com', '0123456789', 'Chọn Tỉnh/TP', 'Chọn Quận/Huyện', 'Chọn Phường/Xã', 'a', '202cb962ac59075b964b07152d234b70'),
(18, 'Ngô Nhân', 'nhan@gmail.com', '08999', '6', '7', '', 'Tân Trung', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product__id` int(11) NOT NULL,
  `category__id` int(11) NOT NULL,
  `producttype__id` int(11) NOT NULL,
  `product__name` varchar(255) NOT NULL,
  `product__cost` int(11) NOT NULL,
  `product__img` varchar(255) NOT NULL,
  `product__img2` varchar(255) NOT NULL,
  `product__img3` varchar(255) NOT NULL,
  `product__img4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product__id`, `category__id`, `producttype__id`, `product__name`, `product__cost`, `product__img`, `product__img2`, `product__img3`, `product__img4`) VALUES
(21, 29, 38, 'Bitis DSW060688TRG', 900000, 'sneaker-nu.jpg', '', '', ''),
(22, 29, 38, ' Bitis Hunter X Strawberry Punch', 720000, 'dswh03400hog__1__0c9b6ce9fed540b88780774f8a474a7f_1024x1024.jpg', '', '', ''),
(23, 30, 41, 'CONVERSE ALL STAR CỔ NGẮN ĐEN', 419000, 'picture-8-3-6-570x570.png', '', '', ''),
(24, 30, 41, 'BATA 4066 JEAN XANH', 876000, 'sneaker-nam-1.jpg', '', '', ''),
(25, 30, 42, 'Giày da bò nam mùa hè thoáng khí GNTA05386-D', 750000, 'giay-da-bo-nam-mua-he-thoang-khi-ma-gnta05386-d.jpg', '', '', ''),
(26, 30, 43, 'BATA 4066 JEAN XANH', 854000, 'sneaker-nam-3.jpg', '', '', ''),
(27, 30, 41, 'VANS OLD SKOOL', 800000, 'vans-old-skool-trang-xanh-nuoc-bien-570x570.jpg', '', '', ''),
(28, 29, 38, ' Bitis Hunter Street Festive Low-Cut Rose', 700000, 'dswh04300hog-2_64e5aa581d4d4a7db2041fa710a226c9_1024x1024.jgp.jpg', '', '', ''),
(29, 30, 41, 'ADIDAS SUPERSTAR TRẮNG SỌC ĐEN', 900000, 'giay_thỂ_thao_adidas_superstar_trẮng_sỌc_Đen-570x570.jpg', '', '', ''),
(30, 29, 39, 'CONVERSE ALL STAR CỔ NGẮN ĐEN', 710000, 'picture-8-3-6-570x570.png', '', '', ''),
(31, 29, 39, 'BATA 4066 JEAN XANH', 825000, 'sneaker-nu-2.jpg', '', '', ''),
(32, 29, 39, 'BATA 4066 JEAN XANH', 652000, 'sneaker-nu-2.jpg', '', '', ''),
(33, 29, 39, 'BATA 4066 JEAN XANH', 450000, 'sneaker-nu-2.jpg', '', '', ''),
(34, 29, 40, 'Sandal Nữ Bitis DTW010088HOG', 240000, 'dtw010088hog_f3d3bc2146064abc8992ddea75262e60_1024x1024.jpg', '', '', ''),
(35, 29, 40, 'Sandal Nữ Bitis DTW010688TRG', 260000, 'dsc_0557_ad3df84f2c0c480294a4bc39dc12f8ef_1024x1024.jpg', '', '', ''),
(36, 29, 40, 'Sandal Nữ Bitis DTW010088VAG', 240000, 'dtw010088vag_dd2e3a3b57d542f791ecaa1e3ea77cca_1024x1024.jpg', '', '', ''),
(37, 29, 38, 'Bitis Hunter Core Classic Pink', 795000, 'dswh0500den-2_76cfb2fd696a4c418a4d34c3e450921f_1024x1024.jpg', '', '', ''),
(38, 30, 41, 'BATA 4066 JEAN XANH', 100000, 'sneaker-nam-1.jpg', '', '', ''),
(39, 30, 42, 'Giày lười nam màu nâu GNTA686-N', 100000, 'that-lung-nam-GNTA686-N.jpg', '', '', ''),
(40, 30, 42, 'Giày da nam màu nâu GNTA10062-N', 660000, 'GNTA10062-N.jpg', '', '', ''),
(41, 30, 41, 'NIKE AIR FORCE 1 SHADOW', 615000, 'air-force-1-shadow-phantom-2-600x600-570x570.jpg', '', '', ''),
(42, 30, 42, 'Giày lười nam quai ngang GNTA2151-DXANH', 580000, 'giay-luoi-nam-quai-ngang-GNTA2151-D..jpg', '', '', ''),
(44, 30, 43, 'BATA 4066 JEAN XANH', 100000, 'sneaker-nam-3.jpg', '', '', ''),
(45, 30, 43, 'BATA 4066 JEAN XANH', 100000, 'sneaker-nam-3.jpg', '', '', ''),
(46, 30, 41, 'Sneaker', 100000, 'sneaker-nam-1.jpg', '', '', ''),
(48, 29, 38, 'Bitis Hunter Street Mid Kumquat Soda', 690000, 'dsmh03601__13__d63293fd8d274168bcc75cb8ba169777_1024x1024.jpg', '', '', ''),
(49, 29, 40, 'Sandal Nữ Bitis DTW010388HOG', 280000, 'dtw010388hog_b87a29d9f22d4d868527febeba5c56da_1024x1024.jpg', '', '', ''),
(50, 29, 38, 'Bitis DSW060688TRG', 505000, 'dsw060688trg__5__17e56319dc8a4268a9c66e706bc1b3be_1024x1024.jpg', '', '', ''),
(51, 29, 38, 'Bitis Hunter Street Vintage Blue', 766000, 'dswh04000xdl-1_4becc8e577324438b85049fbe5b12ffd_1024x1024.jpg', '', '', ''),
(52, 29, 38, 'Bitis Hunter Street Mid Kumquat Soda', 820000, 'dsmh03601__13__d63293fd8d274168bcc75cb8ba169777_1024x1024.jpg', '', '', ''),
(53, 29, 38, 'BATA 4066 JEAN XANH', 705000, 'sneaker-nu.jpg', '', '', ''),
(55, 29, 38, 'Bitis Hunter Street Mid Kumquat Soda', 670000, 'dsmh03601__13__d63293fd8d274168bcc75cb8ba169777_1024x1024.jpg', '', '', ''),
(56, 29, 38, 'BATA 4066 JEAN XANH', 765000, 'sneaker-nu.jpg', '', '', ''),
(57, 29, 38, 'Bitis DSW060688TRG', 500000, 'dsw060688trg__5__17e56319dc8a4268a9c66e706bc1b3be_1024x1024.jpg', '', '', ''),
(58, 29, 38, 'Bitis Hunter Street Vintage Purple', 743000, 'dswh04000tim-1_a74d935ca4b64c7ca115f6e644be17c0_1024x1024.jpg', '', '', ''),
(59, 29, 38, 'Bitis Hunter Street Festive Low-Cut Rose', 733000, 'dswh04300hog-2_64e5aa581d4d4a7db2041fa710a226c9_1024x1024.jgp.jpg', '', '', ''),
(60, 29, 38, 'BATA 4066 JEAN XANH', 720000, 'sneaker-nu.jpg', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `producttype__id` int(11) NOT NULL,
  `category__id` int(11) NOT NULL,
  `producttype__name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`producttype__id`, `category__id`, `producttype__name`) VALUES
(38, 29, 'Sneaker'),
(39, 29, 'Giày bốt'),
(40, 29, 'Sandal'),
(41, 30, 'Sneaker'),
(42, 30, 'Giày lười'),
(43, 30, 'Sandal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin__id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `FK_CDETAIL_PRODUCT` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category__id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment__id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer__id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product__id`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`producttype__id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `producttype__id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `FK_CDETAIL_CART` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `FK_CDETAIL_PRODUCT` FOREIGN KEY (`product_id`) REFERENCES `product` (`product__id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
