-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 06:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pspeach`
--

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_10_005112_create_speeches_table', 1),
(5, '2025_12_10_033503_create_sessions_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '2025_12_15_033332_create_transactions_table', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pr6DuY5fBQnmGEcLhx4odnW4kmncgnYCw39F7h3C', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSzQzOFA3UlJLMDdGUFdoczM2cjlzZXVTU1RzWk5GYXU4bUloS2lnQiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L3BzcGVhY2gvcHVibGljL2hvbWUiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzY1NzY5NTE3O319', 1765773333),
('uink53PszXc6cFy9Oir2QQUVH58s0fwXD3lMkI4q', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiM1dSaGo1N3B4MVZmVXI2MGZZWTdybDdkeVlyaVNVclQ0eXdRb3NsYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3QvcHNwZWFjaC9wdWJsaWMvaG9tZSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NjU3NjkxMjk7fX0=', 1765769130);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `trans_id` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `type`, `description`, `trans_id`, `account_number`, `account_name`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 1, 5000.00, 'credit', 'Salary payment', 'TXN1001', '1234567890', 'John Doe', 'Access Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(2, 1, 5000.00, 'credit', 'Salary payment', 'TXN1001', '1234567890', 'John Doe', 'Access Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(3, 1, 1500.00, 'debit', 'Grocery shopping', 'TXN1002', '1234567890', 'John Doe', 'GTBank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(4, 2, 2000.00, 'credit', 'Transfer from friend', 'TXN2001', '2345678901', 'Jane Smith', 'UBA', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(5, 2, 2000.00, 'credit', 'Transfer from friend', 'TXN2001', '2345678901', 'Jane Smith', 'UBA', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(6, 2, 750.00, 'debit', 'Internet subscription', 'TXN2002', '2345678901', 'Jane Smith', 'MTN Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(7, 3, 10000.00, 'credit', 'Business income', 'TXN3001', '3456789012', 'Michael Lee', 'First Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(8, 3, 10000.00, 'credit', 'Business income', 'TXN3001', '3456789012', 'Michael Lee', 'First Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(9, 3, 3000.00, 'debit', 'Office supplies', 'TXN3002', '3456789012', 'Michael Lee', 'Zenith Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(10, 3, 1200.00, 'debit', 'Fuel', 'TXN3003', '3456789012', 'Michael Lee', 'Mobil', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(11, 4, 8000.00, 'credit', 'Contract payment', 'TXN4001', '4567890123', 'Sarah Johnson', 'Ecobank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(12, 4, 8000.00, 'credit', 'Contract payment', 'TXN4001', '4567890123', 'Sarah Johnson', 'Ecobank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(13, 4, 2500.00, 'debit', 'Rent payment', 'TXN4002', '4567890123', 'Sarah Johnson', 'Union Bank', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(14, 4, 900.00, 'debit', 'Electricity bill', 'TXN4003', '4567890123', 'Sarah Johnson', 'IBEDC', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(15, 5, 3000.00, 'credit', 'Gift received', 'TXN5001', '5678901234', 'David Brown', 'Stanbic IBTC', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(16, 5, 3000.00, 'credit', 'Gift received', 'TXN5001', '5678901234', 'David Brown', 'Stanbic IBTC', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(17, 5, 1200.00, 'debit', 'Online shopping', 'TXN5002', '5678901234', 'David Brown', 'Flutterwave', '2025-12-15 04:01:23', '2025-12-15 04:01:23'),
(18, 5, 450.00, 'debit', 'Transport fare', 'TXN5003', '5678901234', 'David Brown', 'Bolt', '2025-12-15 04:01:23', '2025-12-15 04:01:23');

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
  `account_type` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `security_question` varchar(100) NOT NULL,
  `security_answer` varchar(100) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `credit` decimal(15,2) NOT NULL DEFAULT 0.00,
  `debit` decimal(15,2) NOT NULL DEFAULT 0.00,
  `last_transaction_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `account_type`, `account_name`, `account_number`, `security_question`, `security_answer`, `balance`, `credit`, `debit`, `last_transaction_amount`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Jaida Rath I', 'becker.antonette@gmail.net', '2025-12-10 02:13:53', '$2y$12$sXQSee3OQoylg5jUUbV.fO7Y1c.GQ8lWorNyZpqqiXsbM0CX6wmPe', 'kwAARXuE8B3fyL0gBjXu4nZSWRQKwHNB2ZxmQhWNMl8g52ebjKWX0vwXx03i', 'savings', 'Moore LLC', '9459069941', 'Name of your childhood best friend', 'John', 9645.21, 2665.71, 3227.97, 115.62, '2025-12-10 02:13:55', '2025-12-10 02:13:55'),
(2, 'Tina Weimann', 'joelle19@hotmail.com', '2025-12-10 02:13:53', '$2y$12$9kNihSrC3bocq0VeIeXzJ.ynQesTPNKGF7iqV2q6lwo4GyHONwf5i', 'OsDyrpxofKL6oPW2AeiFNdLxIO9EnFhpigdo9AOMP3ulG5nkiBWVmjv6hN9o', 'savings', 'Rippin-Kulas', '71039052848', 'What is your favorite food', 'Beans', 8782.02, 4277.10, 2625.32, 30.60, '2025-12-10 02:13:55', '2025-12-10 02:13:55'),
(3, 'Miss Dortha Dietrich DDS', 'keely.fadel@yahoo.com', '2025-12-10 02:13:54', '$2y$12$3gXfngi5NU.TasOxc8zACu.ZKrtzQKDJw30kSq5GkXLmYnbXJHnm2', 'w1bT8nn33q', 'current', 'Paucek-Koss', '488274097682', 'What is your hobby', 'Program', 872.08, 2116.15, 4859.57, 84.66, '2025-12-10 02:13:55', '2025-12-10 02:13:55'),
(4, 'Prof. Doris Crooks I', 'jbogan@nao.org', '2025-12-10 02:13:54', '$2y$12$.M62eop2YAkWQ6xS8nTP7OUMgjxthnAK3Cn9rvblA.teA9590jl3O', 'NIWXQ8q8q4Np1JSO7AtwrXXu76yUEksROmb9EcDxeGfRos8q0tk0f5ppF5JL', 'current', 'Carter, Quitzon and Gerhold', '055007807572726', 'What is your hobby', 'Reading', 99.09, 3400.95, 3198.22, 223.42, '2025-12-10 02:13:55', '2025-12-10 02:13:55'),
(5, 'Prof. Anissa Dibbert', 'luettgen.sheridan@evan.net', '2025-12-10 02:13:54', '$2y$12$pU8UHaxrZ3XCjSkRGRRclOopuy2KVvImshyK23cZsk0.2wfaXezz.', 'pDPwB1YNe3j9ngGS8CUAI3dcHwsLf5sSZ8np5e5EwKxCjsGqNkJRn1M6oUab', 'current', 'Ratke-Haag', '45114417', 'favorite food', 'Rice', 7732.25, 2047.64, 285.27, 914.46, '2025-12-10 02:13:55', '2025-12-10 02:13:55'),
(6, 'Ndubuisi Anthony O', 'soloking2000.nao@gmail.com', NULL, '$2y$12$8r6Zd4qusV.7hoE/86/iTeRnEd5YPf6eOe5NHy6gEXqb8.Z.FLoDG', NULL, NULL, NULL, '4348365624', 'What is your favorite food', 'beans', 0.00, 0.00, 0.00, NULL, '2025-12-15 02:05:45', '2025-12-15 02:05:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_last_activity` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
