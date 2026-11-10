-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2026 at 03:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakerychrips_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_sections`
--

CREATE TABLE `about_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'c8.png',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_sections`
--

INSERT INTO `about_sections` (`id`, `title`, `description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Herlina Cookies & Cakes', 'Herlina Cookies & Cakes adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik. Berdiri sejak 2020, kami telah melayani ribuan pelanggan dengan produk-produk berkualitas.', 'images/about_1776869500.jpg', 1, '2026-02-15 07:41:22', '2026-11-09 02:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `business_hours`
--

CREATE TABLE `business_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `close_time` varchar(255) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_hours`
--

INSERT INTO `business_hours` (`id`, `day`, `open_time`, `close_time`, `is_closed`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Senin - Jumat', '08:00', '18:00', 0, 1, '2026-02-15 07:41:22', '2026-11-09 01:51:24'),
(2, 'Sabtu', '08:00', '18:00', 0, 2, '2026-02-15 07:41:22', '2026-11-09 01:51:38'),
(3, 'Minggu', '08:00', '18:00', 0, 3, '2026-02-15 07:41:22', '2026-11-09 01:51:49'),
(4, 'Hari Raya Idul Fitri', '08:00', '19:00', 0, 4, '2026-02-15 07:41:22', '2026-11-09 02:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `description`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(9, 'matcha', 'matcha', 'images/1776782735_matcha.png', NULL, 0, 1, '2026-02-17 00:41:09', '2026-04-21 07:47:44'),
(10, 'Cup Cake', 'cup-cake', 'images/1776868026_cup-cake.png', 'cup cake', 1, 1, '2026-04-01 05:36:01', '2026-04-22 07:27:06'),
(11, 'Cake', 'cake', 'images/1776782942_cake.png', 'enak', 0, 1, '2026-04-01 05:59:53', '2026-04-21 07:57:35'),
(12, 'Slice Cake', 'slice-cake', 'images/1776867999_slice-cake.png', 'matcha', 0, 1, '2026-04-01 06:47:51', '2026-04-22 07:26:41'),
(14, 'donut', 'donut', 'images/1776868093_donut.png', 'a', 1, 1, '2026-04-22 07:28:13', '2026-04-22 07:28:13'),
(15, 'Kue Kering', 'kue-kering', 'images/1776948614_kue-kering.jpg', 'kue kering nastaar', 0, 1, '2026-04-23 05:50:14', '2026-04-23 05:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `whatsapp_number` varchar(255) NOT NULL,
  `whatsapp_message` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `maps_embed` text DEFAULT NULL,
  `delivery_info` varchar(255) DEFAULT NULL,
  `parking_info` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `whatsapp_number`, `whatsapp_message`, `address`, `maps_embed`, `delivery_info`, `parking_info`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '+6281270301267', 'Halo, saya mau pesan produk', 'Sei Jang, Kec. Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3321049989754!2d104.47875979999999!3d0.8944988999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d96d5de67130e1%3A0x4b00dda489dfb9d!2sHerlina%20Cookies%20%26%20Cakes!5e0!3m2!1sid!2sid!4v1794214102948!5m2!1sid!2sid', '-', 'Parkir luas dan aman', 1, '2026-02-15 07:41:22', '2026-11-09 02:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `description`, `icon`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Bahan-bahan segar dan alami', 'Kami hanya menggunakan bahan-bahan berkualitas tinggi dan segar setiap hari', '🍽️', 1, 1, '2026-02-15 07:41:22', '2026-04-23 08:06:00'),
(2, 'Pengiriman cepat dan aman', 'Pengiriman dengan kemasan aman dan driver profesional', '📦', 2, 1, '2026-02-15 07:41:22', '2026-04-23 08:09:51'),
(3, 'Tampilan modern dan mudah digunakan', 'Website modern untuk kemudahan pemesanan', '📲', 3, 1, '2026-02-15 07:41:22', '2026-04-23 08:10:35'),
(4, 'Harga terjangkau', 'Kualitas premium dengan harga yang bersahabat', '💸', 4, 1, '2026-02-15 07:41:22', '2026-04-23 08:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `footer_sections`
--

CREATE TABLE `footer_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL DEFAULT '© 2025 BakeryChrips. All Rights Reserved.',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_sections`
--

INSERT INTO `footer_sections` (`id`, `description`, `address`, `phone`, `email`, `copyright`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Roti fresh setiap hari, dibuat dari bahan berkualitas dan rasa terbaik untuk keluarga. Nikmati kelezatan roti dan kue buatan tangan dengan resep tradisional dan sentuhan modern.', 'Sei Jang, Kec. Bukit Bestari, Kota Tanjung Pinang, Kepulauan Riau', '+6281270301267', 'herlina2443@gmail.com', '2026 Herlina Cookies & Cakes. All Rights Reserved.', 1, '2026-02-15 07:41:22', '2026-11-09 02:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cake_image` varchar(255) NOT NULL DEFAULT 'cake1.png',
  `strawberry_left` varchar(255) NOT NULL DEFAULT 's1.png',
  `strawberry_right` varchar(255) NOT NULL DEFAULT 's2.png',
  `button_text` varchar(255) NOT NULL DEFAULT 'Lihat Produk',
  `button_link` varchar(255) NOT NULL DEFAULT '#terlaris',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_sections`
--

INSERT INTO `hero_sections` (`id`, `title`, `subtitle`, `description`, `cake_image`, `strawberry_left`, `strawberry_right`, `button_text`, `button_link`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Herlina', 'Cookies & Cakes', 'Nikmati berbagai macam roti dan kue segar buatan tangan. Pesan online dengan mudah dan cepat.', 'images/cake_1794231315.png', 'images/strawberry_left_1794231374.png', 'images/strawberry_right_1794231374.png', 'Lihat Produk', '#terlaris', 1, '2026-02-15 07:41:22', '2026-11-09 06:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_15_131353_create_hero_sections_table', 1),
(5, '2026_02_15_131354_create_about_sections_table', 1),
(6, '2026_02_15_131354_create_categories_table', 1),
(7, '2026_02_15_131354_create_features_table', 1),
(8, '2026_02_15_131355_create_footer_sections_table', 1),
(9, '2026_02_15_131356_create_products_table', 1),
(10, '2026_02_15_131356_create_social_media_table', 1),
(11, '2026_02_15_131357_add_role_to_users_table', 1),
(12, '2026_02_15_135558_create_contacts_table', 1),
(13, '2026_02_15_135631_create_business_hours_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$BcMzUyZNUNzxpNkk92zwM.Rr6lvurWZxhx.fsuEz35.92w3F./gti', '2026-04-22 09:05:26'),
('devindadheaindira@gmail.com', '$2y$12$3k8LNy3ucAErgOvoLB8.euihRqJAek1UHwrK8pNZkxekcNIcFzRFW', '2026-04-22 09:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT 5.0,
  `image` varchar(255) DEFAULT NULL,
  `is_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `price`, `rating`, `image`, `is_best_seller`, `created_at`, `updated_at`) VALUES
(16, 'Slice Cake', 'Cake', 'Enakk', 25000.00, 5.0, 'images/1776871231_cake.jpg', 1, '2026-04-01 06:12:26', '2026-04-22 08:20:31'),
(17, 'Donut', 'Cake', 'Donat adalah penganan yang digoreng, dibuat dari adonan tepung terigu, gula pasir, kuning telur, ragi roti, dan mentega. Donat yang paling umum adalah donat dengan bentuk seperti cincin dan ada lubang di tengahnya, biasanya ditaburi dengan meses atau gula halus. Sedangkan donat dengan bentuk bundar diisi isian manis, seperti selai, jelly, krim, cokelat, dan custard.', 5000.00, 5.0, 'images/1794231422_donut.png', 1, '2026-04-01 06:48:41', '2026-11-09 06:37:02'),
(18, 'Brownies', 'matcha', 'coklat', 10000.00, 5.0, 'images/1776870873_image-removebg-preview-3.png', 1, '2026-04-01 06:49:10', '2026-04-22 08:14:33'),
(19, 'Slice Cake', 'Kue Kering', 'abc', 25000.00, 5.0, 'images/1794231439_image-removebg-preview-6.png', 1, '2026-04-23 06:13:28', '2026-11-09 06:37:19'),
(20, 'nastar', 'Kue Kering', 'abc', 20000.00, 5.0, 'images/1776950169_nastar.jpg', 1, '2026-04-23 06:16:09', '2026-04-23 06:16:09'),
(21, 'Cup Cake', 'Cup Cake', 'enak', 20000.00, 5.0, 'images/1777116519_cupcakes.png', 1, '2026-04-25 04:28:39', '2026-11-09 06:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9DlCczK5FqwhG7oOQnu9pY0mjoLjhQbOqQZbkT5K', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVNuem9ObHlXd3BObWpNNFd4MXBLOVRYTGx5cWpMQjhRUEY5ZGUySCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1794231917),
('sa2byKUcObnHkrhYgFk1r7MArsHAtbVLM1v4cfqW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVNNWWVFRVBSV2tmbElrQjdUc2h3S2F3REQyRDlRYUtYR1p2OUlYMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1794226485);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `platform` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `platform`, `icon`, `url`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Instagram', 'bi-instagram', 'https://www.instagram.com/herlinacookies_?exln=ZHhmd2d4OHk0eGJi', 1, 1, '2026-02-15 07:41:22', '2026-11-09 02:31:04'),
(2, 'Facebook', 'bi-facebook', 'https://facebook.com/bakerychrips', 2, 1, '2026-02-15 07:41:22', '2026-02-15 07:41:23'),
(3, 'TikTok', 'bi-tiktok', 'https://tiktok.com/@bakerychrips', 3, 1, '2026-02-15 07:41:22', '2026-02-15 07:41:23'),
(4, 'Twitter', 'bi-twitter', 'https://twitter.com/bakerychrips', 4, 1, '2026-02-15 07:41:22', '2026-02-15 07:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin@gmail.com', 'admin@gmail.com', NULL, '$2y$12$dF.rNfVqwfXjSfkSzTug5uvTg6487kO2ebKDlPN6hD85kMxkFqIOm', NULL, '2026-02-15 07:41:22', '2026-11-08 22:33:54', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_sections`
--
ALTER TABLE `about_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_hours`
--
ALTER TABLE `business_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_sections`
--
ALTER TABLE `footer_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_sections`
--
ALTER TABLE `about_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_hours`
--
ALTER TABLE `business_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `footer_sections`
--
ALTER TABLE `footer_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
