-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 11:31 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2021_04_08_053031_create_sessions_table', 2),
(7, '2021_04_08_123102_update_user_table', 3),
(8, '2021_04_08_184256_create_project_table', 4),
(9, '2021_04_08_184645_create_project_files', 4),
(10, '2021_04_08_184720_create_project_history', 4),
(11, '2021_04_09_035354_add_column_projectstatus', 5),
(12, '2021_04_09_035506_add_column_notes_t_o_history_table', 5),
(13, '2021_04_09_035637_add_column_historyid_to_files_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `assign_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('assigned','in_progress','in_review','completed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `due_date`, `assign_to`, `created_by`, `status`, `last_modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'Test', '<p>1123</p>', '2021-04-13', 3, 4, 'completed', NULL, '2021-04-09 03:07:27', '2021-04-09 11:37:42', NULL),
(6, 'Test new', '<p>hi</p>', '2021-04-20', 3, 4, 'completed', NULL, '2021-04-09 11:19:39', '2021-04-09 14:05:17', NULL),
(8, 'Test Project', '<p>HEllo Projeject</p>', '2021-04-14', 3, 16, 'completed', NULL, '2021-04-09 16:11:59', '2021-04-09 16:17:21', NULL),
(9, 'TEst new', '<p>hello</p>', '2021-04-22', 17, 16, 'assigned', NULL, '2021-04-09 16:15:07', '2021-04-09 16:15:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `history_id` bigint(20) UNSIGNED DEFAULT NULL,
  `last_modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `name`, `project_id`, `created_by`, `history_id`, `last_modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1617912447_Laravel-Practical---Mayuri-Darji.pdf', 6, 4, 1, NULL, '2021-04-09 03:07:27', '2021-04-09 03:07:27', NULL),
(2, '1617912448_IMG20210227084100.jpg', 6, 4, 1, NULL, '2021-04-09 03:07:28', '2021-04-09 03:07:28', NULL),
(3, '1617948144_MayuriDarjiResume.pdf', 6, 3, 8, NULL, '2021-04-09 13:02:24', '2021-04-09 13:02:24', NULL),
(4, '1617948144_Mayuri-Darji-resume-converted1.docx', 6, 3, 8, NULL, '2021-04-09 13:02:24', '2021-04-09 13:02:24', NULL),
(5, '1617949805_IMG-20190506-WA0280.jpg', 6, 4, 9, NULL, '2021-04-09 13:30:05', '2021-04-09 13:30:05', NULL),
(6, '1617949805_Mayuri-Darji-resume-converted1.docx', 6, 4, 9, NULL, '2021-04-09 13:30:05', '2021-04-09 13:30:05', NULL),
(7, '1617949805_Mayuri-Darji-resume-converted.docx', 6, 4, 9, NULL, '2021-04-09 13:30:05', '2021-04-09 13:30:05', NULL),
(11, '1617959735_MayuriDarjiResume.pdf', 9, 16, 15, NULL, '2021-04-09 16:15:35', '2021-04-09 16:15:35', NULL),
(12, '1617959799_Mayuri-Darji-resume-converted.docx', 9, 17, 16, NULL, '2021-04-09 16:16:39', '2021-04-09 16:16:39', NULL),
(13, '1617959799_Mayuri-Darji-resume.pdf', 9, 17, 16, NULL, '2021-04-09 16:16:39', '2021-04-09 16:16:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_history`
--

CREATE TABLE `project_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_modified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_history`
--

INSERT INTO `project_history` (`id`, `name`, `notes`, `project_id`, `created_by`, `last_modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Project assigned', NULL, 6, 4, NULL, '2021-04-09 11:19:39', '2021-04-09 11:19:39', NULL),
(2, 'Project is Completed', NULL, 6, 4, NULL, '2021-04-09 11:35:12', '2021-04-09 11:35:12', NULL),
(3, 'Project is Assigned', NULL, 5, 4, NULL, '2021-04-09 11:36:03', '2021-04-09 11:36:03', NULL),
(8, 'Designer Replied', NULL, 6, 3, NULL, '2021-04-09 13:02:24', '2021-04-09 13:02:24', NULL),
(9, 'Client Added comment', '111', 6, 4, NULL, '2021-04-09 13:30:04', '2021-04-09 13:30:04', NULL),
(10, 'Project is Completed', NULL, 6, 4, NULL, '2021-04-09 14:05:17', '2021-04-09 14:05:17', NULL),
(13, 'Project assigned', NULL, 8, 16, NULL, '2021-04-09 16:11:59', '2021-04-09 16:11:59', NULL),
(14, 'Project assigned', NULL, 9, 16, NULL, '2021-04-09 16:15:07', '2021-04-09 16:15:07', NULL),
(15, 'Client Added comment', '<p>Thiu is initial note</p>', 9, 16, NULL, '2021-04-09 16:15:35', '2021-04-09 16:15:35', NULL),
(16, 'Designer Replied', '<p>Hii How are you?? here i am attaching file for testinh purpose</p>', 9, 17, NULL, '2021-04-09 16:16:39', '2021-04-09 16:16:39', NULL),
(17, 'Client Added comment', '<p>hello</p>', 9, 16, NULL, '2021-04-09 16:17:16', '2021-04-09 16:17:16', NULL),
(18, 'Project is Completed', NULL, 8, 16, NULL, '2021-04-09 16:17:21', '2021-04-09 16:17:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1YXi52H6dy7O5LK70uflyD0bXINZI0Vja2cSel6P', 16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiaWtjUndNbGUxNWRjWXpycVVrVlJIQWRhNFFUQ1NIQ0FPQlE0dmo5eSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jbGllbnQvcHJvamVjdHMiO31zOjU6InN0YXRlIjtzOjQwOiJoYnpwOVB0bDZXMnl2Nkt0TFVIdXcyRnRXZkhvR0hZdjI2R1V5SDFWIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDk3VnZoQU1mT1BudEIxcFdLZjdwN09TSlRaR0UvY29tQ2ZnRFJnZnlXUTVWYjR1OFJldUdtIjt9', 1617959847);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialcode_phoneno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('client','designer') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `social_id`, `dialcode_phoneno`, `profile`, `user_type`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Cleint Mayuri', 'darji_mayuri_designer@ymail.com', NULL, '$2y$10$c0KzW/epjCO4lwLhWKtepeJFooM2cAQy7d.mMDe8XtCtieQjh8qdS', '1907122496121388_111', '+91 1234567890', '1617903542_IMG20210227084100.jpg', 'designer', NULL, NULL, 'iUD0qZrSETVWcBI1jzOlPPwpuaLT0Ym2LAoODZVQYzH6TtVU5Arn2YJaycOe', '2021-04-09 00:38:46', '2021-04-09 00:39:02'),
(4, 'Mtest Darji', 'darji_mayuri1@ymail.com', NULL, '$2y$10$EPL9JL6tU5SuigdtoIi3COha/3zh28rltgzb.6pXvDsiTFhD3ZQ8O', '1907122496121388_1', '+91 1234567890', '', 'client', NULL, NULL, NULL, '2021-04-09 01:12:21', '2021-04-09 01:13:43'),
(16, 'Mayuri Darji', 'darji_mayuri@ymail.com', NULL, '$2y$10$97VvhAMfOPntB1pWKf7p7OSJTZGE/comCfgDRgfyWQ5Vb4u8ReuGm', '1907122496121388', '+91 1234567811', '', 'client', NULL, NULL, NULL, '2021-04-09 16:10:25', '2021-04-09 16:11:00'),
(17, 'mayuri darji', 'darjimayuri90@gmail.com', NULL, '$2y$10$GNpcSEhBvie70lCjJWpSh.rTLLC3D/YEOqJ0QunGDua.QfkPlIwIW', '112238414813251672311', '+91 1234567891', '', 'designer', NULL, NULL, NULL, '2021-04-09 16:13:42', '2021-04-09 16:13:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_assign_to_foreign` (`assign_to`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `projects_title_index` (`title`),
  ADD KEY `projects_due_date_index` (`due_date`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_files_project_id_foreign` (`project_id`),
  ADD KEY `project_files_created_by_foreign` (`created_by`),
  ADD KEY `project_files_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `project_files_name_index` (`name`),
  ADD KEY `project_files_history_id_foreign` (`history_id`);

--
-- Indexes for table `project_history`
--
ALTER TABLE `project_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_history_project_id_foreign` (`project_id`),
  ADD KEY `project_history_created_by_foreign` (`created_by`),
  ADD KEY `project_history_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `project_history_name_index` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project_history`
--
ALTER TABLE `project_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_assign_to_foreign` FOREIGN KEY (`assign_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_last_modified_by_foreign` FOREIGN KEY (`last_modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_files`
--
ALTER TABLE `project_files`
  ADD CONSTRAINT `project_files_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_files_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `project_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_files_last_modified_by_foreign` FOREIGN KEY (`last_modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_history`
--
ALTER TABLE `project_history`
  ADD CONSTRAINT `project_history_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_history_last_modified_by_foreign` FOREIGN KEY (`last_modified_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_history_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
