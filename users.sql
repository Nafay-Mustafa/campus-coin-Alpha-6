-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2026 at 08:45 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_coin`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `academic_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_allowance` decimal(12,2) NOT NULL DEFAULT '0.00',
  `saving_goal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `academic_year`, `monthly_allowance`, `saving_goal`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NAFAY MUSTAFA', 'nafaymustafa50@gmail.com', NULL, '$2y$12$L2f/Y3Rtw53xRe9MmS8ck.T4Le62LKux0XB.YDeYIrvgxYlnN4M/y', NULL, NULL, NULL, '2026 2nd year', 50000.00, 10000.00, 0, NULL, '2026-09-29 02:20:50', '2026-09-29 02:20:50'),
(2, 'Campus Coin Admin', 'admin@campuscoin.test', '2026-09-29 02:42:30', '$2y$12$Fsqr8Uq1XvVMVnqeWBgZLeRnk8z2ugHjeUbyztu/FIkCwK9Im8hhW', NULL, NULL, NULL, 'Administrator', 0.00, 0.00, 1, NULL, '2026-09-29 02:42:30', '2026-09-29 02:42:30'),
(3, 'Demo Student', 'student@campuscoin.test', '2026-09-29 02:42:30', '$2y$12$7qbZZF2Kzd5T0BndvWJBpenbH77AcDtsBtuE5dXnKJLHM9nA4CzCK', NULL, NULL, NULL, '2026', 25000.00, 5000.00, 0, NULL, '2026-09-29 02:42:30', '2026-09-29 02:42:30'),
(4, 'Arham Bin Kamran', 'arhamkamran768@gmail.com', NULL, '$2y$12$FlN4hICzLdx6d6uGfqnKmOwZxfT5Tawh6A6WmKEjpWmebcjzzPrEm', NULL, NULL, NULL, '2026 2nd year', 60000.00, 15000.00, 0, NULL, '2026-09-29 03:17:35', '2026-09-29 03:17:35'),
(5, 'Abidullah', 'abidullah@gmail.com', NULL, '$2y$12$JwAzjkhRq09wk5BuXviiHOUqlt4t6l99knYYZEQkNP.fYQG.c.Pq2', NULL, NULL, NULL, '2026 2nd year', 50000.00, 25000.00, 0, NULL, '2026-09-29 03:21:39', '2026-09-29 03:21:39'),
(6, 'Yusra batool', 'yusra@gmail.com', NULL, '$2y$12$l7cAeIHYG9t4HoxJnhFHG.zm0JsNkTxbsE5c1USOEn1nyBNEEKgna', NULL, NULL, NULL, '2026 KU degree', 70000.00, 30000.00, 0, NULL, '2026-09-29 03:24:28', '2026-09-29 03:24:28'),
(7, 'Ahrar', 'ahrar@gmail.com', NULL, '$2y$12$lyh1T0DQyjhDY2NlbjolcesfAv39aNwlIU5Tt97PeQnMLC306wREe', NULL, NULL, NULL, '2026 iqra uni degree', 90000.00, 10000.00, 0, NULL, '2026-09-29 03:26:07', '2026-09-29 03:26:07'),
(8, 'Rehan', 'rehan@gmail.com', NULL, '$2y$12$9tbBy2x3GkzXb/up9C/D9.X8W.ftFFJtYQLxLtHTuMlrqkllJ24sW', NULL, NULL, NULL, '2026 2nd year', 40000.00, 5000.00, 0, NULL, '2026-09-29 03:28:31', '2026-09-29 03:28:31'),
(9, 'Jamil', 'jamil@gmail.com', NULL, '$2y$12$.wsKdcLdYQy4b84SbTkjJugsuXzO4.wJO4484N2WYQo89fWWEkm0e', NULL, NULL, NULL, '2026 KU degree', 60000.00, 10000.00, 0, NULL, '2026-09-29 03:30:24', '2026-09-29 03:30:24'),
(10, 'Zara', 'zara46@gmail.com', NULL, '$2y$12$gFIqoHs9aBufasqf4HozfOGpPYslmy9TCi265XjwV/uFEgxzdUvum', NULL, NULL, NULL, '2026 2nd year', 200000.00, 50000.00, 0, NULL, '2026-09-29 03:32:39', '2026-09-29 03:32:39'),
(11, 'Ahmad', 'ahmad@gmail.com', NULL, '$2y$12$n7Ejp6uioNBeicO04JHc6ulSqh6.b1FCJX11j.Xj2nsWvCVkVxCxa', NULL, NULL, NULL, '2026 2nd year', 600000.00, 100000.00, 0, NULL, '2026-09-29 03:33:54', '2026-09-29 03:33:54'),
(12, 'Aiman', 'aiman@gmail.com', NULL, '$2y$12$aurfM0suhzvj7ZGbx14osuxKH6ADZDzANjHdzNaQUDeiVejgTWYiS', NULL, NULL, NULL, '2026 iqra uni degree', 70000.00, 10000.00, 0, NULL, '2026-09-29 03:35:35', '2026-09-29 03:35:35'),
(13, 'Aqsa', 'aqsa@gmail.com', NULL, '$2y$12$2s3UaCIWZ5IdIaP3LxkfYexNYMgl68KS3QgIFv60iuUvoizXy87Hq', NULL, NULL, NULL, '2026 2nd year', 10000.00, 2000.00, 0, NULL, '2026-09-29 03:36:56', '2026-09-29 03:36:56'),
(14, 'Hareem', 'hareem@gmail.com', NULL, '$2y$12$ZHatwB1f0XOosoqwtnBwZ.geAyUxC6snaYDM/bxlg3cQVXIuQUnv2', NULL, NULL, NULL, '2026 KU degree', 200000.00, 30000.00, 0, NULL, '2026-09-29 03:38:25', '2026-09-29 03:38:25'),
(15, 'Taha', 'taha@gmail.com', NULL, '$2y$12$RzCrp3lt.gCyuKPEYJ9ge.ooX1y9T6wIFViYQwpmsNqpgdi.f6zKe', NULL, NULL, NULL, '2026 2nd year', 15000.00, 3000.00, 0, NULL, '2026-09-29 03:40:41', '2026-09-29 03:40:41'),
(16, 'Shayan', 'shayan@gmail.com', NULL, '$2y$12$9v/hkF1plSDMG1Zi9PbYnOEzvIFvbpcrZEF8PLhZYLNNZ5FVW3ofq', NULL, NULL, NULL, '2026 iqra uni degree', 800000.00, 5000.00, 0, NULL, '2026-09-29 03:41:59', '2026-09-29 03:41:59'),
(17, 'Wasil', 'wasil@gmail.com', NULL, '$2y$12$qgxZOjEidlAoNYpI/0dIxOjJTTNRM.jjcINwDh7K3Rbo5ePEI3c6G', NULL, NULL, NULL, '2026 Diploma in Aptech', 500000.00, 100000.00, 0, NULL, '2026-09-29 03:43:13', '2026-09-29 03:43:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
