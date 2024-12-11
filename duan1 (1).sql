-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 10, 2024 lúc 10:23 PM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `about`
--

CREATE TABLE `about` (
  `id` int NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mission` text COLLATE utf8mb4_general_ci NOT NULL,
  `vision` text COLLATE utf8mb4_general_ci NOT NULL,
  `core_values` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `about`
--

INSERT INTO `about` (`id`, `company_name`, `mission`, `vision`, `core_values`, `created_at`) VALUES
(1, 'Your Company Name', 'Our mission is to deliver top-notch products and services that bring value to our customers.', 'We envision a future where our company is recognized as a global leader in the industry.', 'Integrity, Customer Commitment, Quality, Teamwork, Innovation', '2024-11-24 10:32:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `summary` text COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `summary`, `content`, `created_at`) VALUES
(1, 'Hades - Một Trong Những \"Phát Súng Đầu Tiên\" của Vietnamese Streetwear', '', '\r\nHades - Một Trong Những \r\n16.03.2021\r\nRa đời từ những năm cuối thế kỷ 20, streetwear là phong cách thời trang phổ biến của cộng đồng đam mê bộ môn skateboard.\r\n \r\nDù mới “bén duyên” với giới trẻ Việt 5 năm trở lại đây nhưng hàng loạt thương hiệu thời trang nội địa đi theo phong cách này đã xuất hiện. Trong số đó phải kể đến Hades - cái tên được nhắc “liên tục” bởi người chơi hệ Streetwear từ Bắc vào Nam.\r\n\r\nHADES góp phần thay đổi phong cách ăn mặc giới trẻ bằng xu thế thời trang mới.\r\n\r\nThế hệ trẻ hiện nay được coi là “thế hệ không biên giới” với sự tự tin ngập tràn, năng lượng sống tích cực cùng khả năng sáng tạo vô bờ bến. Sự phát triển của công nghệ, của mạng xã hội giúp họ có nhiều “đất” hơn để thể hiện cá tính và cái tôi riêng của bản thân. Một trong những cách thể hiện bản thân đơn giản nhất chính là sử dụng ngôn ngữ thời trang.\r\n\r\n \r\n\r\n \r\n\r\n../../../public/img/carousel-4.jpg\r\n\r\n \r\n\r\nLà một trong những “phát súng” đầu tiên khơi mào trào lưu thời trang streetwear tại Việt Nam, Hades chính thức mở cửa vào năm 2016. Trải qua gần nửa thập kỷ hoạt động, thương hiệu này đã trở thành cái tên “sừng sỏ” trên bản đồ thời trang đường phố tại Việt Nam với hệ thống gồm 1 Flagship Store tại trung tâm Sài Gòn cùng 7 chi nhánh tại các thành phố lớn: Cần Thơ, Đồng Nai, Hà Nội.\r\n\r\nMang tinh thần tự do, thoải mái của thế hệ trẻ hiện đại, hầu hết các sản phẩm của Hades đều hướng tới kiểu dáng rộng rãi, thiết kế đơn giản không kén người mặc. Béo hay gầy, cao hay thấp, 3 vòng có như 1 hay không giờ đây cũng chẳng quan trọng. Bởi, đã đến với Hades, chắc chắn bạn chẳng thể ra “vác người không” ra về. \r\n\r\nSáng tạo không ngừng nghỉ là cách HADES “mê hoặc” giới trẻ.\r\n\r\nMặc dù đã đồng hành cùng giới trẻ Việt được 6 năm nhưng chưa bao giờ Hades đánh mất đi độ hot của mình. Chìa khoá giúp Hades len lỏi vào mọi ngóc ngách của ngành thời trang streetwear chính là “sự sáng tạo” liên tục trong mẫu mã sản phẩm.\r\n\r\nKhông quá khi nói rằng đội ngũ thiết kế của Hades là những con người có khả năng “đẻ không biết mệt” khi liên tục cho ra mắt hàng loạt những bộ sưu tập chất lượng với nhiều concept khác nhau. Điểm chung của tất cả các bộ sưu tập chính là sự thoải mái, tính ứng dụng cao và sự nổi bật trong cách kết hợp màu sắc.\r\n\r\n \r\n\r\n \r\n\r\n\r\n\r\n \r\n\r\nKhông chỉ giới hạn ở những gam màu đen trắng cơ bản, Hades khẳng định nét độc lạ của mình bằng việc sử dụng các hiệu ứng màu ấn tượng: phản quang, galaxy, tie-dye,... Mỗi hoạ tiết được đưa vào sản phẩm đều được lên ý tưởng kỹ lưỡng sao cho mới mẻ, hợp mốt nhưng không được mất đi “bản sắc” đặc trưng của thương hiệu: mạnh mẽ, cá tính và chút gì đó bụi bặm. \r\n\r\n“Không chỉ là một thương hiệu thời trang hiện đại dành cho giới trẻ, Hades còn đại diện cho một xu hướng thẩm mỹ cũng như một lối sống riêng. Thông qua việc hoàn thiện vẻ bề ngoài, chúng tôi muốn các bạn trẻ cảm thấy yêu bản thân hơn, tự tin hơn, thoả sức sáng tạo trong thế giới riêng của mình.”\r\n\r\nVới các sản phẩm có thiết kế độc đáo, chất lượng cao cùng giá thành hợp lý, chắc chắn cái tên Hades sẽ còn lớn mạnh hơn, khẳng định được chỗ đứng của mình trong lòng giới trẻ đam mê Streetwear tại Việt Nam cũng như các quốc gia trong khu vực.\r\n\r\nHADES STUDIO\r\n\r\nWebsite: https://hades.vn\r\n\r\nFacebook: https://www.facebook.com/HADES-1489313121348883 \r\n\r\nInstagram: https://www.instagram.com/hades.studio/ \r\n\r\nSố điện thoại: 0903945112\r\n\r\nEmail: contact@hades.vn\r\n\r\nHades Flagship Store: 121 Nguyễn Trãi Q.1, TP HCM', '2024-11-24 10:37:00'),
(2, 'Health and Wellness Tips', 'Staying healthy is crucial for a happy life...', 'Full content of the blog post here...', '2024-11-24 10:37:00'),
(3, 'Exploring the World of Finance', 'The financial world can be complex...', 'Full content of the blog post here...', '2024-11-24 10:37:00'),
(4, 'Traveling the World: Top Destinations', 'Traveling opens the door to new experiences...', 'Full content of the blog post here...', '2024-11-24 10:37:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 9, 2, 1, '2024-12-11 03:51:03', '2024-12-10 20:51:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Bottoms', 'Danh mục các sản phẩm quần', '2024-11-11 05:45:20'),
(2, 'Tee', 'Danh mục các sản phẩm áo', '2024-11-11 05:45:20'),
(3, 'Shoes', 'Danh mục các sản phẩm giày', '2024-11-11 05:45:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkout`
--

CREATE TABLE `checkout` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `checkout_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Completed','Failed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Nguyễn Trường Thành', 'thanhxinhtraizz@gmail.com', 'aaaaaaa', 'haha', '2024-11-24 10:16:18'),
(2, 'Huỳnh yến ngọc', 'ngocz@gmail.com', 'hahaha', 'nôn', '2024-11-24 10:24:17'),
(3, 'Nguyễn Trường Thành', 'thanhxinhtraizz@gmail.com', 'aaa', 'aaa', '2024-12-04 06:20:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite_products`
--

CREATE TABLE `favorite_products` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `favorite_products`
--

INSERT INTO `favorite_products` (`id`, `user_id`, `product_id`, `name`, `price`, `image_path`, `created_at`) VALUES
(15, 9, 3, 'sản phẩm 3', 17000000.00, '../../../public/img/product-3.jpg', '2024-12-10 22:06:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Pending','Completed','Cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `payment_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `status`, `payment_id`, `total_amount`, `address`) VALUES
(1, NULL, '2024-12-10 13:41:33', 'Pending', NULL, NULL, 'cần thơ '),
(2, 9, '2024-12-10 10:47:22', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(3, 9, '2024-12-10 10:49:06', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(4, 9, '2024-12-10 10:49:13', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(5, 9, '2024-12-10 10:49:20', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(6, 9, '2024-12-10 10:58:04', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(7, 9, '2024-12-10 10:59:00', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(8, 9, '2024-12-10 11:02:43', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(9, 9, '2024-12-10 11:02:44', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(10, 9, '2024-12-10 11:02:49', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(11, 9, '2024-12-10 11:04:53', 'Pending', 'MOMO123456', 85000.00, 'cần thơ'),
(12, 9, '2024-12-10 11:06:09', 'Pending', 'MOMO123456', 85000.00, 'cần thơ'),
(13, 9, '2024-12-10 11:09:23', 'Pending', 'MOMO123456', 85000.00, 'cần thơ'),
(38, 9, '2024-12-10 14:04:42', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(39, 9, '2024-12-10 14:04:53', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(40, 9, '2024-12-10 14:05:06', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(41, 9, '2024-12-10 14:05:17', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(42, 9, '2024-12-10 14:05:20', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(43, 9, '2024-12-10 14:05:23', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(44, 9, '2024-12-10 14:05:29', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(45, 9, '2024-12-10 14:05:32', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(46, 9, '2024-12-10 14:06:19', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(47, 9, '2024-12-10 14:06:39', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(48, 9, '2024-12-10 14:06:47', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(49, 9, '2024-12-10 14:16:00', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(50, 9, '2024-12-10 14:16:05', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(52, 9, '2024-12-10 14:21:21', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(53, 9, '2024-12-10 14:21:24', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(54, 9, '2024-12-10 14:28:11', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(55, 9, '2024-12-10 14:28:12', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(56, 9, '2024-12-10 14:32:00', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(57, 9, '2024-12-10 14:32:03', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(58, 9, '2024-12-10 15:23:26', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(62, 9, '2024-12-10 15:37:00', 'Pending', 'MOMO123456', 60000.00, 'cần thơ'),
(63, 9, '2024-12-10 15:46:22', 'Pending', 'MOMO123456', 75000.00, 'cần thơ'),
(64, 9, '2024-12-10 15:47:22', 'Pending', 'MOMO123456', 75000.00, 'cần thơ'),
(65, 9, '2024-12-10 15:47:29', 'Pending', 'MOMO123456', 75000.00, 'cần thơ'),
(66, 9, '2024-12-10 15:47:37', 'Pending', 'MOMO123456', 90000.00, 'cần thơ'),
(67, 9, '2024-12-10 15:59:53', 'Pending', 'MOMO123456', 105000.00, 'cần thơ'),
(68, 9, '2024-12-10 16:00:57', 'Pending', 'MOMO123456', 105000.00, 'cần thơ'),
(69, 9, '2024-12-10 16:23:37', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(70, 9, '2024-12-10 17:15:25', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(71, 9, '2024-12-10 17:18:56', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(72, 9, '2024-12-10 17:20:36', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(73, 9, '2024-12-10 17:25:17', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(74, 9, '2024-12-10 17:27:33', 'Pending', 'MOMO123456', 60000.00, 'cần thơ'),
(75, 9, '2024-12-10 17:31:30', 'Pending', 'MOMO123456', 77000.00, 'cần thơ'),
(76, 9, '2024-12-10 17:33:35', 'Pending', 'MOMO123456', 77000.00, 'cần thơ'),
(77, 9, '2024-12-10 17:40:05', 'Pending', 'MOMO123456', 30000.00, 'cần thơ'),
(78, 9, '2024-12-10 17:43:12', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(79, 9, '2024-12-10 17:44:02', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(80, 9, '2024-12-10 17:45:25', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(81, 9, '2024-12-10 17:45:44', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(82, 9, '2024-12-10 17:45:47', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(83, 9, '2024-12-10 17:47:16', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(84, 9, '2024-12-10 17:51:08', 'Pending', 'MOMO123456', 45000.00, 'cần thơ'),
(85, 9, '2024-12-10 18:01:09', 'Pending', 'MOMO123456', 60000.00, 'cần thơ, '),
(86, 9, '2024-12-10 18:01:13', 'Pending', 'MOMO123456', 60000.00, 'cần thơ, ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `price`, `quantity`) VALUES
(7, 1, 'Sản phẩm A', 100000.00, 2),
(8, 1, 'Sản phẩm B', 150000.00, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(10,2) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `brand` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL,
  `stock` int DEFAULT '0',
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `description`, `brand`, `price`, `stock_quantity`, `stock`, `size`, `is_featured`, `image_path`, `created_at`) VALUES
(2, 2, 'sản phẩm 2', 'aaaaaaaaaaaaaaaaaaaaaa', NULL, 15000.00, 0, 3, 'M, L, XL', 0, '../../../public/img/product-2.jpg', '2024-11-10 06:24:43'),
(3, 1, 'sản phẩm 3', 'aaaaaaaaa', 'Hades', 17000000.00, 12, 0, 'L, XL', 0, '../../../public/img/product-3.jpg', '2024-11-10 06:56:48'),
(4, 1, 'sản phẩm 4', 'aaaaaaaa', NULL, 15000000.00, 0, 0, 'S, M, L', 0, '../../../public/img/product-4.jpg', '2024-11-10 06:56:48'),
(5, 2, 'sản phẩm 5', 'aaaaaaa', 'Hades', 17000.00, 12, 4, 'M, L, XL', 0, '../../../public/img/product-5.jpg', '2024-11-10 07:00:15'),
(6, 3, 'sản phẩm 6', 'aaaaaaaa', NULL, 17000000.00, 0, 0, 'L, XL', 0, '../../../public/img/product-6.jpg', '2024-11-10 10:14:33'),
(7, 2, 'sản phẩm 7', 'aaaaaa', NULL, 15000000.00, 0, 0, 'S, M, L', 0, '../../../public/img/product-7.jpg', '2024-11-10 10:14:33'),
(8, 3, 'sản phẩm 8', 'aaaaaaaa', NULL, 1500000.00, 0, 0, 'M, L, XL', 0, '../../../public/img/product-8.jpg', '2024-11-10 15:01:43'),
(10, 2, 'hades', 'aaaaaaaaaa', NULL, 1500000.00, 0, 4, 'L, XL', 0, '../../../public/img/product-10.jpg', '2024-11-11 05:53:23'),
(12, 2, 'namaanh', 'hahahahahahahaha', 'haha', 5000000.00, 50, 0, 'M,L,XL', 0, 'img/adidas.jpg', '2024-12-04 06:58:23'),
(13, 2, 'hades 12', 'nam anh hihiiiii', 'Hades', 120000.00, 50, 0, 'S,M,L,XL', 0, 'img/cat-1.jpg', '2024-12-09 19:35:00'),
(14, 1, 'namaanh123', '123123123123123123', 'Hades', 135000.00, 50, 0, 'S,M,L,XL', 0, 'img/product-6.jpg', '2024-12-09 19:42:18'),
(15, 2, 'namaanhaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Hades', 500000.00, 232, 0, 'S,M,L,XL', 0, 'img/cat-1.jpg', '2024-12-09 19:52:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('Admin','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'User',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `address`, `phone`, `role`, `created_at`) VALUES
(9, 'yenngoc2211', '$2y$10$8JEEVbLQHRuphsNoKeHsyetQWTkyAZrz/RBvLOXEbuYyiY8fC8ELK', 'ngoc@gmail.com', 'Huỳnh yến ngọc', 'cần thơ', '0763939172', 'Admin', '2024-11-10 10:36:24'),
(15, 'ngoc212121', '$2y$10$K/VnRKOZOi2RCnZQb8DrH.WgvxD4g/u6ZMKXTTqGtY1LW.z53QHh.', 'thanhxinhtraizz@gmail.com', 'Nguyễn Thành danh', 'số 37 khu vực thới lợi', '0774901624', 'User', '2024-12-09 19:33:10');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `favorite_products`
--
ALTER TABLE `favorite_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`order_id`),
  ADD KEY `fk_product_new` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_payment` (`payment_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `about`
--
ALTER TABLE `about`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `favorite_products`
--
ALTER TABLE `favorite_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `checkout_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `checkout_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `favorite_products`
--
ALTER TABLE `favorite_products`
  ADD CONSTRAINT `favorite_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorite_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_product_new` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
