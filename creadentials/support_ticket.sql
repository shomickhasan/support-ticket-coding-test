-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 27, 2024 at 02:08 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `support_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_25_161923_user_type_to_users_table', 1),
(6, '2024_09_27_025724_create_support_tickets_table', 1),
(7, '2024_09_27_031344_create_support_ticket_statuses_table', 1),
(8, '2024_09_27_055413_create_support_replies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_replies`
--

DROP TABLE IF EXISTS `support_replies`;
CREATE TABLE IF NOT EXISTS `support_replies` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `support_ticket_id` bigint UNSIGNED NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `support_replies_support_ticket_id_index` (`support_ticket_id`),
  KEY `support_replies_created_by_index` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_replies`
--

INSERT INTO `support_replies` (`id`, `support_ticket_id`, `reply`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Okay Dont warry I will fixed it thank you', 1, '2024-09-27 06:38:22', '2024-09-27 06:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `issue_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_status` tinyint NOT NULL COMMENT '0 for close & 1 for open',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `support_tickets_created_by_foreign` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `issue_details`, `current_status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'I need a support , i can\'t login with my account', 0, 11, '2024-09-27 06:37:13', '2024-09-27 06:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_statuses`
--

DROP TABLE IF EXISTS `support_ticket_statuses`;
CREATE TABLE IF NOT EXISTS `support_ticket_statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `support_ticket_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 for closed, 1 for open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `support_ticket_statuses_support_ticket_id_foreign` (`support_ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_statuses`
--

INSERT INTO `support_ticket_statuses` (`id`, `support_ticket_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-09-27 06:37:13', '2024-09-27 06:37:13'),
(2, 1, 0, '2024-09-27 06:38:28', '2024-09-27 06:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint NOT NULL COMMENT '0 for admin 1 for user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', 0, NULL, '$2y$12$2BieIGQDleIEAFarZ.onAu7XUoLRolcf8gq3Rw7paNhOTHuGT7TxK', NULL, '2024-09-27 06:34:50', '2024-09-27 06:34:50'),
(2, 'Customer 1', 'customer1@gmail.com', 1, NULL, '$2y$12$5EfhBCIDXPJ8NVZo78.5i.fVGWpRCrODw3bPRF1eJ0MwHs3A1VzeW', NULL, '2024-09-27 06:34:50', '2024-09-27 06:34:50'),
(3, 'Customer 2', 'customer2@gmail.com', 1, NULL, '$2y$12$/RUamzlLo7UDcgsZO9QqBeD0BFoZYQDLtGNT4EldR7c95sd1VZoeC', NULL, '2024-09-27 06:34:50', '2024-09-27 06:34:50'),
(4, 'Customer 3', 'customer3@gmail.com', 1, NULL, '$2y$12$9jFloeNEQhWFL9LA3V2xfulkyIYdP/WPAu08jN4EkUtPxUMaOLZ62', NULL, '2024-09-27 06:34:51', '2024-09-27 06:34:51'),
(5, 'Customer 4', 'customer4@gmail.com', 1, NULL, '$2y$12$wK7UTcSpHHZ5R5O91zB.T.ag5PmZohisvfpVSFrsDFZXZ/lOzTsIW', NULL, '2024-09-27 06:34:51', '2024-09-27 06:34:51'),
(6, 'Customer 5', 'customer5@gmail.com', 1, NULL, '$2y$12$AEyvawfRl2wBliNvylLuH.zezIYZYqPH.70Wp4ZfkpcFotDrvtAoS', NULL, '2024-09-27 06:34:51', '2024-09-27 06:34:51'),
(7, 'Customer 6', 'customer6@gmail.com', 1, NULL, '$2y$12$PPqxL7.RTU7DM15zfQLhWedCrVi3P9tDfdduPMx86hN.ujglsg9lK', NULL, '2024-09-27 06:34:51', '2024-09-27 06:34:51'),
(8, 'Customer 7', 'customer7@gmail.com', 1, NULL, '$2y$12$YtZ5mvTZx2eeRXB5VSbVaO3dYsd4dLjLmgIji2xtMtntiIyOHFj92', NULL, '2024-09-27 06:34:52', '2024-09-27 06:34:52'),
(9, 'Customer 8', 'customer8@gmail.com', 1, NULL, '$2y$12$OxkXPlHevnHH0G3caItL2eiCTGdY5TsQeFsWCjElG256ylobHNB2S', NULL, '2024-09-27 06:34:52', '2024-09-27 06:34:52'),
(10, 'Customer 9', 'customer9@gmail.com', 1, NULL, '$2y$12$/vMVwanAFXEqs.gq7oTBx.rCmnSeKF.4VRlVnaOBgH5W.hnAL7eoq', NULL, '2024-09-27 06:34:52', '2024-09-27 06:34:52'),
(11, 'Shomick Hasan', 'shomick@gmail.com', 1, NULL, '$2y$12$rSbsIwXgJF8/6IhNmGAJlOITpcPfOA7nfZAs4AxQ7I/j7xjhY4k36', NULL, '2024-09-27 06:36:07', '2024-09-27 06:36:07');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `support_replies`
--
ALTER TABLE `support_replies`
  ADD CONSTRAINT `support_replies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `support_replies_support_ticket_id_foreign` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_tickets` (`id`);

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `support_ticket_statuses`
--
ALTER TABLE `support_ticket_statuses`
  ADD CONSTRAINT `support_ticket_statuses_support_ticket_id_foreign` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
