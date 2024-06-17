-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2024 at 09:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'daniel AL', 'rungkut TIMUR', '2024-05-20 04:24:49', '2024-05-28 21:36:14', NULL),
(2, 'bima', 'RMS SELATAN', '2024-05-20 04:24:49', '2024-05-27 08:51:35', NULL),
(3, 'indahh', 'Jl.Mawang no 19 dd', '2024-05-20 04:24:49', '2024-05-27 09:01:04', NULL),
(4, 'Aris', 'jl. kendal sari no 53c, rungkut, surabaya', '2024-05-20 04:36:12', '2024-05-20 04:36:12', NULL),
(5, 'Rangga', 'jl. bali satu no 61b, Dompu, Dompu, Nusa Tenggara Barat', '2024-05-20 04:37:01', '2024-05-20 04:37:01', NULL),
(6, 'Nurull', 'jl. kali jati no 12k, ciampelas, Bandung, Jawa Barat', '2024-05-20 04:37:48', '2024-05-28 21:36:28', NULL),
(7, 'AVEL', 'kali jodo', '2024-05-28 21:41:39', '2024-05-28 21:55:03', '2024-05-28 21:55:03'),
(8, 'asdda', 'asdasd', '2024-05-28 21:51:22', '2024-05-28 21:51:28', '2024-05-28 21:51:28'),
(9, 'dasdd', 'dasdasd', '2024-05-28 21:52:31', '2024-05-28 21:54:20', '2024-05-28 21:54:20'),
(10, 'dasd', 'dasd', '2024-05-28 21:55:34', '2024-05-28 21:55:46', '2024-05-28 21:55:46'),
(11, 'asdas', 'asdasd', '2024-06-03 09:04:53', '2024-06-03 09:04:57', '2024-06-03 09:04:57'),
(12, 'asdasd', 'asdasd', '2024-06-03 09:05:28', '2024-06-03 09:05:32', '2024-06-03 09:05:32'),
(13, 'asdasda', 'sdasdasd', '2024-06-03 09:05:37', '2024-06-03 09:05:40', '2024-06-03 09:05:40'),
(14, 'asd', 'asddddddd', '2024-06-03 09:06:04', '2024-06-03 09:06:09', '2024-06-03 09:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(15000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `city`, `created_at`, `updated_at`, `image`, `type_id`, `deleted_at`) VALUES
(1, 'Hotel A', 'Jalan A', 'Surabaya', '2024-03-11 19:14:30', '2024-03-11 19:14:30', '1.jpeg', 1, NULL),
(2, 'Hotel B', 'Jalan B', 'Malang', '2024-03-11 19:14:30', '2024-03-11 19:14:30', '2.jpeg', 2, NULL),
(3, 'The Shourten Hotel', 'Jalan genjer', 'Semarang', '2024-03-11 19:14:30', '2024-03-11 19:14:30', '3.jpeg', 3, NULL),
(4, 'Luminor Hotel', 'Jl. Bmbang', 'Jakarta', '2024-03-11 19:14:30', '2024-03-11 19:14:30', '4.jpeg', 1, NULL),
(5, 'Yellow Hotel', 'Jl. sedeng', 'Medan', '2024-03-11 19:14:30', '2024-03-11 19:14:30', '1.jpeg', 2, NULL),
(6, 'Harris Hotel', 'Jl. A Yani Utara Riverside', 'Malang', '2024-03-18 18:06:08', '2024-03-18 18:06:08', '2.jpeg', 3, NULL),
(7, 'AMAN GATI', 'Jl. Pahlawan No. 123 Kelurahan Sukajadi Kecamatan Cikini Kota Jakarta Pusat DKI Jakarta 12345 Indonesia', 'Jakarta', '2024-05-10 01:28:42', '2024-05-10 01:28:42', '3.jpeg', 4, NULL),
(8, 'ALAM SUTRA', 'Jl. Pahlawan No. 123 Kelurahan Sukajadi Kecamatan Cikini Kota Jakarta Pusat DKI Jakarta 12345 Indonesia', 'Jakarta', '2024-05-10 01:32:45', '2024-06-10 21:05:45', '1718078745_vip hotel.jpeg', 5, NULL),
(9, 'ALAM BAKA', 'Jl. Pahlawan No. 123 Kelurahan Sukajadi Kecamatan Cikini Kota Jakarta Pusat DKI Jakarta 12345 Indonesia', 'Jakarta', '2024-05-10 01:33:27', '2024-06-10 21:04:45', '1718078685_vip hotel.jpeg', 4, NULL),
(10, 'Alam Gaspoll', 'jl. kenjeran surabaya no 46', 'surabaya', '2024-05-10 01:42:00', '2024-06-10 21:05:34', '1718078734_3.jpeg', 3, NULL),
(11, 'Boston Hotel', 'Jl. lingkar Lombok Utara', 'Lombok', '2024-05-10 01:44:03', '2024-05-10 01:44:03', '3.jpeg', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_10_005805_create_hotels_table', 1),
(6, '2024_03_10_005825_create_products_table', 1),
(7, '2024_03_10_013243_addfk_produc_hotel_products_table', 2),
(8, '2024_04_24_180719_create_suppliers_table', 3),
(12, '2024_03_24_141050_create_types_table', 4),
(14, '2024_05_27_084412_add_types_column', 5),
(15, '2024_05_27_155220_add_customers_column', 6),
(16, '2024_05_27_155428_add_products_column', 7),
(17, '2024_05_27_155446_add_transactions_column', 7),
(18, '2024_05_27_155619_add_users_column', 8),
(19, '2024_05_27_161246_add_hotels_column', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_room` int DEFAULT NULL,
  `hotel_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `available_room`, `hotel_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kamar AA', 1300000, '3.jpeg', 'Kamar Yang bagus', 11, 11, '2024-03-12 14:49:13', '2024-05-27 09:51:58', NULL),
(2, 'Kamar B', 950000, '2.jpeg', 'Kamar yang indahh', 14, 1, '2024-03-12 14:49:13', '2024-05-29 09:54:02', NULL),
(3, 'Kamar C', 750000, '3.jpeg', 'Kamr yang cukup luas', 22, 2, '2024-03-12 14:49:13', '2024-05-29 09:54:12', NULL),
(4, 'Kamar D', 8000001, '4.jpeg', 'Kamr yang luas', 21, 4, '2024-03-12 14:49:13', '2024-05-27 09:49:10', NULL),
(5, 'Kamar Deluxe 1', 1000000, '1.jpeg', 'Kamr yang luas', 25, 3, '2024-03-18 18:35:05', '2024-03-18 18:35:05', NULL),
(6, 'Kamar Deluxe 2', 600000, '2.jpeg', 'Kamr yang luas', 13, 3, '2024-03-18 18:35:22', '2024-03-18 18:35:22', NULL),
(7, 'Kamar VIP', 2000000, '3.jpeg', 'Kamr yang luas', 6, 3, '2024-03-18 18:35:42', '2024-03-18 18:35:42', NULL),
(8, 'Superior 1', 400000, '4.jpeg', 'Kamr yang luas', 5, 4, '2024-03-18 18:36:12', '2024-03-18 18:36:12', NULL),
(9, 'Superior 2', 500000, '4.jpeg', 'Kamr yang luas', 5, 4, '2024-03-18 18:36:26', '2024-03-18 18:36:26', NULL),
(10, 'Kamar Deluxe 1', 1300000, '3.jpeg', 'Kamr yang luas', 5, 5, '2024-03-18 18:35:05', '2024-03-18 18:35:05', NULL),
(11, 'Kamar Deluxe 2', 700000, '2.jpeg', 'Kamr yang luas', 12, 5, '2024-03-18 18:35:22', '2024-03-18 18:35:22', NULL),
(12, 'Kamar VIP', 1300000, '2.jpeg', 'Kamr yang luas', 12, 5, '2024-03-18 18:35:42', '2024-03-18 18:35:42', NULL),
(13, 'Superior 1', 400000, '4.jpeg', 'Kamr yang luas', 4, 6, '2024-03-18 18:36:12', '2024-03-18 18:36:12', NULL),
(14, 'Superior 2', 1300000, '2.jpeg', 'Kamr yang luas', 21, 6, '2024-03-18 18:36:26', '2024-03-18 18:36:26', NULL),
(15, 'Kamar Deluxe 1', 600000, '3.jpeg', 'Kamr yang luas', 2, 6, '2024-03-18 18:35:05', '2024-03-18 18:35:05', NULL),
(16, 'Kamar Deluxe 2', 700000, '1.jpeg', 'Kamr yang luas', 12, 6, '2024-03-18 18:35:22', '2024-03-18 18:35:22', NULL),
(17, 'Kamar VIP', 1300000, '4.jpeg', 'Kamr yang luas', 21, 5, '2024-03-18 18:35:42', '2024-05-27 09:50:45', NULL),
(18, 'Kamar mandi', 123456789, '3.jpeg', 'kamr ini ada shower, pemanas air, dan masih banyak lagi', 12, 7, '2024-05-20 04:57:37', '2024-05-27 09:53:47', '2024-05-27 09:53:47'),
(19, 'kamar bayi', 15023411, '1.jpeg', 'aman pokok nya', 5, 7, '2024-05-28 22:12:27', '2024-06-03 08:48:51', '2024-06-03 08:48:51'),
(20, 'asdasd', 123123, '3.jpeg', 'asdasd', 12, 1, '2024-06-03 08:49:24', '2024-06-03 08:49:29', '2024-06-03 08:49:29'),
(21, 'asd', 1231, '2.jpeg', 'asdasd', 1, 11, '2024-06-03 09:00:46', '2024-06-03 09:00:51', '2024-06-03 09:00:51'),
(22, 'asdasd', 123, '1.jpeg', '1sdasd', 1, 5, '2024-06-03 09:03:16', '2024-06-03 09:03:20', '2024-06-03 09:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_transaction`
--

CREATE TABLE `product_transaction` (
  `product_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_transaction`
--

INSERT INTO `product_transaction` (`product_id`, `transaction_id`, `quantity`, `subtotal`) VALUES
(1, 1, 15, 6000000123),
(1, 8, 2, 10201000),
(1, 11, 12, 100000000),
(2, 5, 3, 6000000),
(3, 3, 3, 10000000),
(4, 2, 21, 5000000),
(5, 7, 2, 2000000),
(6, 8, 5, 150000000),
(7, 4, 1, 2000000),
(8, 6, 4, 9000000),
(12, 16, 123, 12312312313),
(13, 18, 12, 1231231231231),
(14, 15, 99, 9999999999),
(15, 19, 12, 123456789),
(16, 13, 12, 123456789),
(16, 17, 123, 1231231231231),
(18, 12, 123, 10101010101010),
(19, 14, 12, 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_date`, `created_at`, `updated_at`, `user_id`, `customer_id`, `deleted_at`) VALUES
(1, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-27 10:44:50', 1, 6, NULL),
(2, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-27 10:45:17', 1, 2, NULL),
(3, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 2, 1, NULL),
(4, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 2, 2, NULL),
(5, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 1, 1, NULL),
(6, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 1, 2, NULL),
(7, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 2, 1, NULL),
(8, '2024-05-07 11:16:35', '2024-05-07 04:16:35', '2024-05-07 04:16:35', 2, 2, NULL),
(9, '2024-05-20 11:24:35', '2024-05-20 04:24:35', '2024-05-20 04:24:35', 3, 1, NULL),
(10, '2024-05-20 11:24:49', '2024-05-20 04:24:49', '2024-05-20 04:24:49', 3, 2, NULL),
(11, '2024-05-20 15:48:01', '2024-05-20 08:48:01', '2024-06-03 08:59:29', 1, 5, '2024-06-03 08:59:29'),
(12, '2024-05-20 15:49:01', '2024-05-20 08:49:01', '2024-06-03 08:55:32', 2, 5, '2024-06-03 08:55:32'),
(13, '2024-05-27 17:49:33', '2024-05-27 10:49:33', '2024-05-27 10:50:40', 19, 1, '2024-05-27 10:50:40'),
(14, '2024-05-29 17:18:13', '2024-05-29 10:18:13', '2024-06-03 08:55:21', 19, 3, '2024-06-03 08:55:21'),
(15, '2024-05-29 17:34:28', '2024-05-29 10:34:28', '2024-06-03 08:55:15', 16, 4, '2024-06-03 08:55:15'),
(16, '2024-06-03 15:57:37', '2024-06-03 08:57:37', '2024-06-03 08:57:43', 14, 3, '2024-06-03 08:57:43'),
(17, '2024-06-03 15:58:08', '2024-06-03 08:58:08', '2024-06-03 08:58:14', 21, 4, '2024-06-03 08:58:14'),
(18, '2024-06-03 15:59:50', '2024-06-03 08:59:50', '2024-06-03 08:59:56', 21, 2, '2024-06-03 08:59:56'),
(19, '2024-06-03 16:03:49', '2024-06-03 09:03:49', '2024-06-03 09:03:53', 13, 1, '2024-06-03 09:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Villa', 'Mantap', '2024-05-10 01:18:19', '2024-05-10 01:18:19', NULL),
(2, 'Resort Hotel', 'UISSHHHHH', '2024-05-10 01:18:19', '2024-05-27 01:27:05', NULL),
(3, 'Cottage', '1234524', '2024-05-10 01:18:19', '2024-05-28 21:20:04', NULL),
(4, 'Residance', 'WIHHHHH', '2024-05-10 01:18:19', '2024-05-27 01:26:58', NULL),
(5, 'Room', 'LOHHHHHHH', '2024-05-10 01:18:33', '2024-05-27 01:26:41', NULL),
(6, 'kolam', 'AMANTAPPPP', '2024-05-10 01:48:52', '2024-05-28 21:11:41', NULL),
(7, 'Zifas', 'HMMMMM', '2024-05-10 01:49:04', '2024-05-28 21:50:27', '2024-05-28 21:50:27'),
(8, 'Gudang', 'Kosong', '2024-05-20 05:01:54', '2024-05-20 05:01:54', NULL),
(9, 'asdas', 'asdasd', '2024-05-27 09:02:55', '2024-05-27 09:03:02', '2024-05-27 09:03:02'),
(10, 'MANTAP BRO', 'asdasd', '2024-05-27 09:03:31', '2024-05-27 09:03:35', '2024-05-27 09:03:35'),
(11, 'kamar kosong', 'wihh', '2024-05-27 20:24:51', '2024-05-28 21:11:57', NULL),
(12, 'rusun2', 'asdasd', '2024-05-28 21:08:01', '2024-05-28 21:11:11', NULL),
(13, 'rusun3', 'asdasd', '2024-05-28 21:08:58', '2024-05-28 21:26:19', '2024-05-28 21:26:19'),
(14, 'rusun', 'asdas', '2024-05-28 21:09:54', '2024-05-28 21:10:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role` varchar(45) DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `role`) VALUES
(1, 'budiman', 'budiman@gmail.com', NULL, 'budi', NULL, '2024-05-07 04:08:57', '2024-05-07 04:14:32', NULL, 'guest'),
(2, 'alex', 'alex@gmail.com', NULL, 'alex', NULL, '2024-05-07 04:08:57', '2024-05-07 04:14:32', NULL, 'guest'),
(3, 'aman', 'aman', NULL, 'aman', NULL, '2024-05-20 11:14:27', '2024-05-20 11:14:27', NULL, 'guest'),
(13, 'asep', 'asep', NULL, 'asep', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(14, 'nil', 'nil', NULL, 'nil', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(15, 'Kiki', 'kiki', NULL, 'kiki', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(16, 'sule', 'seula', NULL, 'sule', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(17, 'mamat', 'mamat', NULL, 'mamat', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(18, 'boris', 'b', NULL, 'a', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(19, 'jegel', 'c', NULL, 'b', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(20, 'oki', 'a', NULL, 'c', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(21, 'bene', 'ca', NULL, 'd', NULL, '2024-05-27 17:47:33', '2024-05-27 17:47:33', NULL, 'guest'),
(22, 'admin', 'admin@gamil.com', NULL, '$2y$10$1dk/g.nPUhFQ/J1MNo88lu2pd3Gy4T1RXvcYgVNARwjfLpkPjzVzG', NULL, '2024-06-03 21:05:21', '2024-06-04 05:08:29', NULL, 'owner'),
(23, 'Daniel', 'dan@gmail.com', NULL, '$2y$10$Y50gh3VzXGBNVSB6SfPDn.p.AYkI6PabsLMgJCVj6IKlFwgrPCKru', NULL, '2024-06-03 21:50:18', '2024-06-04 05:08:29', NULL, 'employee'),
(24, '123', 'a@a.com', NULL, '$2y$10$NEtyOi81LtoHj0r2ryYqY.mPPyvzarIu06Gpw8Gk7V7Brkk83RH0a', NULL, '2024-06-03 22:04:11', '2024-06-03 22:04:11', NULL, 'guest'),
(25, 'asd', 'asd@a', NULL, '$2y$10$Y79EhYHPtlH12dpAxDPS6us6syLkLDby09IoGEJy.Wbwye4pDLJxO', NULL, '2024-06-03 22:07:10', '2024-06-03 22:07:10', NULL, 'guest'),
(26, 'daniel', 'daniel@gmail.com', NULL, '$2y$10$xCeX./EzmsngbB2sACvtNe7TX//MkPeN/ArqpNBVmj67GmlJkhl.y', NULL, '2024-06-03 22:09:04', '2024-06-03 22:09:04', NULL, 'guest'),
(27, 'asdasd', '123@1', NULL, '$2y$10$/mGYXG3kC4ZM/DH.B3pb0OCgTmkIgtjAWfux8YlCoTt10V2CyNGZy', NULL, '2024-06-03 22:15:29', '2024-06-03 22:15:29', NULL, 'guest'),
(28, 'abed', 'a@a', NULL, '$2y$10$rf67I6jnIHX9ePK4GRI42OI.7duBClXEptClSOZVkjn59C95YH1YG', NULL, '2024-06-03 22:17:06', '2024-06-03 22:17:06', NULL, 'employee'),
(29, 'admin', 'admin@admin.com', NULL, '$2y$10$Rxyzown/Z6KGzkzHxfh6lePMPkQ4bbIs69irgbe5KfBLDABPgMLfW', NULL, '2024-06-10 20:13:10', '2024-06-10 20:13:10', NULL, 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hotels_types1_idx` (`type_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD PRIMARY KEY (`product_id`,`transaction_id`),
  ADD KEY ` product_transaction_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`,`user_id`,`customer_id`),
  ADD KEY `fk_transactions_users1_idx` (`user_id`),
  ADD KEY `fk_transactions_customers1_idx` (`customer_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `fk_hotels_types1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `product_transaction`
--
ALTER TABLE `product_transaction`
  ADD CONSTRAINT `product_transaction_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_transaction_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_transactions_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
