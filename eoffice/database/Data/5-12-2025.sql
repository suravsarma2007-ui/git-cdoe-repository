-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 12:37 PM
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
-- Database: `cdoe`
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
-- Table structure for table `eslms`
--

CREATE TABLE `eslms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` varchar(50) NOT NULL,
  `paper_code` varchar(50) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `module_no` tinyint(3) UNSIGNED NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_of_submit` date NOT NULL,
  `file_upload_link` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `block` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eslms`
--

INSERT INTO `eslms` (`id`, `program_id`, `paper_code`, `emp_id`, `module_no`, `status`, `date_of_submit`, `file_upload_link`, `remark`, `block`, `created_at`, `updated_at`) VALUES
(6, 'BCA001', 'OBCA1105', '07', 1, 'Done and Uploaded', '2025-12-05', 'BACHELOR_OF_COMPUTER_APPLICATION/1/MATHEMATICS_FOR_COMPUTER_APPLICATIONS/Module1/MATHEMATICS_FOR_COMPUTER_APPLICATIONS.pdf', NULL, '0', '2025-12-05 04:29:52', '2025-12-05 04:29:52');

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
(4, '2025_12_03_000001_create_staff_table', 2),
(5, '2025_12_03_000002_create_programs_table', 3),
(6, '2025_12_03_000003_create_papers_table', 4),
(7, '2025_12_03_000004_create_paper_allocations_table', 5),
(8, '2025_12_04_000001_create_videos_table', 6),
(9, '2025_12_04_091707_add_final_status_to_videos_table', 7),
(10, '2025_12_05_000005_create_eslms_table', 8),
(11, '2025_12_05_000006_create_ppt_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `codes` varchar(255) NOT NULL,
  `paper_name` varchar(255) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `semester` int(11) NOT NULL,
  `years` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `program_id`, `codes`, `paper_name`, `module`, `semester`, `years`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'OBBA1101', 'BUSINESS ECONOMICS', '1', 1, '2025', '2025-12-03 04:19:56', '2025-12-03 04:26:05', NULL),
(2, 2, 'OBBA1102', 'BASICS OF ACCOUNTING', '1', 1, '2025', '2025-12-03 04:20:13', '2025-12-03 04:25:57', NULL),
(3, 2, 'OBBA1103', 'HUMAN RESOURCE MANAGEMENT', '1', 1, '2025', '2025-12-03 04:31:40', '2025-12-03 04:31:40', NULL),
(4, 2, 'OBBA1104', 'PRINCIPLES OF MANAGEMENT', '1', 1, '2025', '2025-12-03 04:32:00', '2025-12-03 04:32:00', NULL),
(5, 2, 'OBBA1105', 'ENGLISH FOR EFFECTIVE BUSINESS SPEAKING', '1', 1, '2025', '2025-12-03 04:32:18', '2025-12-03 04:32:18', NULL),
(6, 2, 'OBBA1106', 'QUANTITATIVE TECHNIQUES', '1', 1, '2025', '2025-12-03 04:32:34', '2025-12-03 04:32:34', NULL),
(7, 4, 'OBCA1101', 'PROGRAMMING FOR PROBLEM SOLVING', '1', 1, '2025', '2025-12-03 04:32:56', '2025-12-03 04:32:56', NULL),
(8, 4, 'OBCA1102', 'INTRODUCTION TO WEB TECHNOLOGY', '1', 1, '2025', '2025-12-03 04:33:17', '2025-12-03 04:33:17', NULL),
(9, 4, 'OBCA1103', 'FUNDAMENTALS OF COMPUTER APPLICATIONS', '1', 1, '2025', '2025-12-03 04:33:32', '2025-12-03 04:33:32', NULL),
(10, 4, 'OBCA1104', 'DIGITAL ELECTRONICS', '1', 1, '2025', '2025-12-03 04:33:48', '2025-12-03 04:33:48', NULL),
(11, 4, 'OBCA1105', 'MATHEMATICS FOR COMPUTER APPLICATIONS', '1', 1, '2025', '2025-12-03 04:34:02', '2025-12-03 04:34:02', NULL),
(12, 4, 'OBCA1106', 'FUNDAMENTALS OF MANAGEMENT', '1', 1, '2025', '2025-12-03 04:34:18', '2025-12-03 04:34:18', NULL),
(13, 3, 'OMCA1101', 'PROGRAMMING AND DATA STRUCTURES', '1', 1, '2025', '2025-12-03 04:35:24', '2025-12-03 04:35:24', NULL),
(14, 3, 'OMCA1102', 'OPERATING SYSTEMS', '1', 1, '2025', '2025-12-03 04:38:11', '2025-12-03 04:38:11', NULL),
(15, 3, 'OMCA1103', 'COMPUTER ORGANIZATION & ARCHITECTURE', '1', 1, '2025', '2025-12-03 04:38:29', '2025-12-03 04:38:29', NULL),
(16, 3, 'OMCA1104', 'FUNDAMENTALS OF DISCRETE MATHEMATICS', '1', 1, '2025', '2025-12-03 04:38:45', '2025-12-03 04:38:45', NULL),
(17, 3, 'OMCA1105', 'WEB TECHNOLOGY', '1', 1, '2025', '2025-12-03 04:39:56', '2025-12-03 04:39:56', NULL),
(18, 3, 'OMCA1106', 'FUNDAMENTALS OF PROBABILITY AND STATISTICS', '1', 1, '2025', '2025-12-03 04:40:11', '2025-12-03 04:40:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paper_allocations`
--

CREATE TABLE `paper_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paper_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `module_no` varchar(255) DEFAULT NULL,
  `semester` tinyint(3) UNSIGNED DEFAULT NULL,
  `year` year(4) NOT NULL,
  `week_no` tinyint(3) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paper_allocations`
--

INSERT INTO `paper_allocations` (`id`, `paper_id`, `emp_id`, `module_no`, `semester`, `year`, `week_no`, `date`, `created_at`, `updated_at`) VALUES
(1, 6, 10, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:14:32', '2025-12-03 05:14:32'),
(2, 2, 7, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:15:05', '2025-12-03 05:15:05'),
(3, 1, 13, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:16:07', '2025-12-03 05:16:07'),
(4, 3, 9, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:24:02', '2025-12-03 05:24:02'),
(5, 4, 9, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:24:26', '2025-12-03 05:24:26'),
(6, 11, 10, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:26:43', '2025-12-03 05:26:43'),
(7, 7, 11, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:28:00', '2025-12-03 05:28:00'),
(8, 9, 8, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:28:27', '2025-12-03 05:28:27'),
(9, 10, 8, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:28:52', '2025-12-03 05:28:52'),
(10, 12, 7, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:29:53', '2025-12-03 05:29:53'),
(11, 8, 12, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:30:17', '2025-12-03 05:30:17'),
(12, 13, 11, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:30:43', '2025-12-03 05:30:43'),
(13, 14, 8, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:31:11', '2025-12-03 05:31:11'),
(14, 15, 11, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:31:31', '2025-12-03 05:31:31'),
(15, 16, 10, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:31:55', '2025-12-03 05:31:55'),
(16, 17, 12, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:32:20', '2025-12-03 05:32:20'),
(17, 18, 13, '1', 1, '2025', 1, '2025-11-01', '2025-12-03 05:32:40', '2025-12-03 05:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppt`
--

CREATE TABLE `ppt` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paper` varchar(100) NOT NULL,
  `emp_id` varchar(50) NOT NULL,
  `program_id` varchar(50) NOT NULL,
  `module_no` tinyint(3) UNSIGNED NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `no_of_ppt` int(10) UNSIGNED DEFAULT NULL,
  `screen_recording` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `total` int(10) UNSIGNED DEFAULT NULL,
  `date_of_submit` date NOT NULL,
  `ppt_file_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `program_id` varchar(255) NOT NULL,
  `session_year` varchar(255) NOT NULL,
  `program_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program_name`, `program_id`, `session_year`, `program_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'MASTER OF BUSINESS ADMINISTRATION', 'MBA001', '2025-26', 'MBA', '2025-12-03 04:03:54', '2025-12-03 04:04:38', NULL),
(2, 'BACHELOR OF BUSINESS MANAGEMENT', 'BBA001', '2025-26', 'BBA', '2025-12-03 04:04:30', '2025-12-03 04:06:16', NULL),
(3, 'MASTER OF COMPUTER APPLICATION', 'MCA001', '2025-26', 'MCA', '2025-12-03 04:05:09', '2025-12-03 04:05:09', NULL),
(4, 'BACHELOR OF COMPUTER APPLICATION', 'BCA001', '2025-2026', 'BCA', '2025-12-03 04:06:05', '2025-12-03 04:06:24', NULL);

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
('D6OWAKFKFBNPY0Zav0IDByBBFrwuSkE5dj9SmkXA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUnhDN2ltb3E5MTlLY241SER4MGxCWVY0Q2NJZzlwaGxMeDZFUjVqeSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcHQvY3JlYXRlIjtzOjU6InJvdXRlIjtzOjEwOiJwcHQuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764933931);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `staff_type` enum('Faculty','Non-Teaching','Support') NOT NULL,
  `discipline` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `official_email` varchar(255) DEFAULT NULL,
  `personal_email` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `doj` date NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `emp_id`, `name`, `designation`, `staff_type`, `discipline`, `subject`, `official_email`, `personal_email`, `contact`, `doj`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '01', 'Dr. Surajit Sarma', 'Assitant Director', 'Non-Teaching', NULL, NULL, 'surajit.sarma@adtuonline.in', 'suravsarma2007@gmail.com', '8822811292', '2025-08-10', 'Hatigaon, Guwahati', '2025-12-03 03:33:02', '2025-12-03 03:33:02', NULL),
(2, '02', 'Bedanta Goswami', 'System Analyst', 'Non-Teaching', NULL, NULL, 'bedanta.goswami@adtuonline.in', 'bedatachanmari@gmail.com', '8638443195', '2025-08-01', 'Chandmari, Guwahati', '2025-12-03 03:35:00', '2025-12-03 03:35:00', NULL),
(3, '03', 'Dijupam Das', 'Video Editor cum Videographer', 'Non-Teaching', NULL, NULL, 'dijupam.das@adtuonline.in', 'dijupamdas.dd@gmail.com', '7002828615', '2025-09-08', 'Bhetapara, Guwahati', '2025-12-03 03:36:16', '2025-12-03 03:36:16', NULL),
(4, '10', 'Arunabh Choudhury', 'Audio Video Editing', 'Non-Teaching', NULL, NULL, 'arunabh.choudhury@adtuonline.in', 'arunabh.cgfx@gmail.com', '7002069459', '2025-10-15', NULL, '2025-12-03 03:37:15', '2025-12-03 03:41:59', NULL),
(5, '12', 'Jagadish Kalita', 'Audio Video Editing', 'Non-Teaching', NULL, NULL, 'jagadish.kalita@adtuonline.in', 'jagadishkalita61663@gmail.com', '6003611968', '2025-11-13', NULL, '2025-12-03 03:38:38', '2025-12-03 03:38:38', NULL),
(6, '13', 'Rwittik Pathak', 'Audio Video Editing', 'Non-Teaching', NULL, NULL, 'riwittikpathak@adtuonline.in', 'riwittikpathak@gmail.com', '9864437149', '2025-11-25', NULL, '2025-12-03 03:39:26', '2025-12-03 03:39:26', NULL),
(7, '04', 'Dr. Aminuz Zaman', 'Assitant Professor', 'Faculty', 'Accountancy', 'Accountancy', 'aminuz.zaman@adtuonline.in', 'zamanaminuz1@gmail.com', '8638980881', '2025-09-24', NULL, '2025-12-03 03:40:41', '2025-12-03 03:40:41', NULL),
(8, '05', 'Arundhati Bora', 'Assitant Professor', 'Faculty', 'Computer Application', 'Computer Application', 'arundhati.bora@adtuonline.in', 'arundhati30@gmail.com', '7002696089', '2025-09-24', NULL, '2025-12-03 03:41:33', '2025-12-03 03:42:09', NULL),
(9, '06', 'Dr. Mumpi  Das', 'Assistant Professor', 'Faculty', 'Commerece', 'Management', 'mumpi.das@adtuonline.in', 'mampi020993@gmail.com', '6001199453', '2025-08-18', NULL, '2025-12-03 03:43:53', '2025-12-03 03:43:53', NULL),
(10, '07', 'Dr. Nirmali Roy', 'Assistant Professor', 'Faculty', 'Maths', 'Maths', 'nirmali.roy@adtuonline.in', 'nirmaliroy2011@gmail.com', '8638546148', '2025-09-24', NULL, '2025-12-03 03:44:47', '2025-12-03 03:44:47', NULL),
(11, '08', 'Subhrojit Saikia', 'Assistant Professor', 'Faculty', 'Computer Application', 'Computer Application', 'subhrojit.saikia@adtuonline.in', 'subhrojitsaikia@gmail.com', '7002330151', '2025-10-08', NULL, '2025-12-03 03:45:33', '2025-12-03 03:45:33', NULL),
(12, '09', 'Manoj Sarma', 'Assistant Professor', 'Faculty', 'Computer Application', 'Computer Application', 'manoj.sarma@adtuonline.in', 'manoj.sarma.aei@gmail.com', '9706717544', '2025-10-08', NULL, '2025-12-03 03:46:12', '2025-12-03 03:46:12', NULL),
(13, '11', 'Banashree Saikia', 'Assistant Professor', 'Faculty', 'Economics', 'Economics', 'banashree.saikia@adtuonline.in', 'banasaikia2017@gmail.com', '6002586064, 96787360', '2025-10-25', NULL, '2025-12-03 03:46:50', '2025-12-03 03:46:50', NULL),
(14, '14', 'Shubham Chakrovorty', 'Office Assistant', 'Support', NULL, NULL, 'shubham.chakrovorty@adtu.in', 'chakrovortyschubham10@gmail.com', '7002119410', '2025-01-02', NULL, '2025-12-03 03:49:32', '2025-12-03 03:49:41', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$UDkoaKNv0t.9zvVBpdi6e.mBeMQBNZdPSInmRH5Z6djdtLTe34mXi', NULL, '2025-12-03 03:11:14', '2025-12-03 03:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paper_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `module_no` varchar(255) DEFAULT NULL,
  `semester` tinyint(3) UNSIGNED NOT NULL,
  `total_videos_required` int(11) NOT NULL DEFAULT 0,
  `total_videos_done` int(11) NOT NULL DEFAULT 0,
  `total_videos_edited` int(11) NOT NULL DEFAULT 0,
  `uploaded_videos` int(11) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL,
  `final_status` varchar(255) DEFAULT NULL COMMENT 'Status of video: Pending, In Progress, Completed, On Hold',
  `upload_date` date NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL,
  `year` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `paper_id`, `emp_id`, `program_id`, `module_no`, `semester`, `total_videos_required`, `total_videos_done`, `total_videos_edited`, `uploaded_videos`, `remark`, `final_status`, `upload_date`, `month`, `year`, `created_at`, `updated_at`) VALUES
(1, 11, 10, 4, '1', 1, 5, 5, 5, 5, 'All videos successfully uploaded', 'Completed', '2025-12-04', 12, 2025, '2025-12-04 03:39:07', '2025-12-04 03:49:46'),
(2, 7, 11, 4, '1', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 03:41:06', '2025-12-04 03:50:01'),
(3, 9, 8, 4, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 03:52:38', '2025-12-04 03:52:38'),
(4, 10, 8, 4, '1', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 03:53:27', '2025-12-04 03:53:27'),
(5, 12, 7, 4, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:03:31', '2025-12-04 04:03:31'),
(6, 8, 12, 4, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:04:12', '2025-12-04 04:04:12'),
(7, 11, 10, 4, '2', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:13:40', '2025-12-04 04:13:40'),
(8, 7, 11, 4, '2', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:14:15', '2025-12-04 04:14:15'),
(9, 9, 8, 4, '2', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:15:10', '2025-12-04 04:15:10'),
(10, 10, 8, 4, '2', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:36:33', '2025-12-04 04:36:33'),
(11, 12, 7, 4, '2', 1, 5, 5, 5, 5, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:37:03', '2025-12-04 04:37:03'),
(12, 8, 12, 4, '2', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:37:30', '2025-12-04 04:37:30'),
(13, 11, 10, 4, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:40:01', '2025-12-04 04:40:01'),
(14, 7, 11, 4, '3', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:40:25', '2025-12-04 04:40:25'),
(15, 9, 8, 4, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:40:49', '2025-12-04 04:40:49'),
(16, 10, 12, 4, '3', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:41:21', '2025-12-04 04:41:21'),
(17, 12, 7, 4, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:41:51', '2025-12-04 04:41:51'),
(18, 8, 12, 4, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:42:31', '2025-12-04 04:42:31'),
(19, 11, 10, 4, '4', 1, 3, 0, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:43:55', '2025-12-04 04:43:55'),
(20, 7, 11, 4, '4', 1, 3, 3, 3, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:44:43', '2025-12-04 04:44:43'),
(21, 9, 8, 4, '4', 1, 2, 2, 2, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:45:12', '2025-12-04 04:45:12'),
(22, 10, 8, 4, '4', 1, 3, 2, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:46:04', '2025-12-04 04:46:04'),
(23, 12, 7, 4, '4', 1, 3, 2, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:47:05', '2025-12-04 04:47:05'),
(24, 8, 12, 4, '4', 1, 3, 3, 3, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 04:47:41', '2025-12-04 04:47:41'),
(25, 6, 7, 2, '1', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:54:18', '2025-12-04 04:54:18'),
(26, 2, 7, 2, '1', 1, 5, 5, 5, 5, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:58:53', '2025-12-04 04:58:53'),
(27, 1, 13, 2, '1', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 04:59:29', '2025-12-04 04:59:29'),
(28, 3, 9, 2, '1', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:00:04', '2025-12-04 05:00:04'),
(29, 4, 9, 2, '1', 1, 5, 5, 5, 5, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:02:12', '2025-12-04 05:02:12'),
(30, 13, 11, 3, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:03:28', '2025-12-04 05:03:28'),
(31, 14, 8, 3, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:04:04', '2025-12-04 05:04:04'),
(32, 15, 11, 3, '1', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:06:32', '2025-12-04 05:06:32'),
(33, 16, 10, 3, '1', 1, 1, 1, 1, 1, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:07:11', '2025-12-04 05:07:11'),
(34, 17, 12, 3, '1', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:07:46', '2025-12-04 05:07:46'),
(35, 18, 13, 3, '1', 1, 1, 1, 1, 1, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:19:04', '2025-12-04 05:19:04'),
(36, 6, 10, 2, '2', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:23:57', '2025-12-04 05:23:57'),
(37, 2, 7, 2, '2', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:24:22', '2025-12-04 05:24:22'),
(38, 1, 13, 2, '2', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:24:55', '2025-12-04 05:24:55'),
(39, 3, 9, 2, '2', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:25:23', '2025-12-04 05:25:23'),
(40, 4, 9, 2, '2', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:26:34', '2025-12-04 05:26:34'),
(41, 6, 10, 2, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:28:01', '2025-12-04 05:28:01'),
(42, 2, 7, 2, '3', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:28:22', '2025-12-04 05:28:22'),
(43, 1, 13, 2, '3', 1, 2, 2, 2, 2, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:29:01', '2025-12-04 05:29:01'),
(44, 3, 9, 2, '3', 1, 3, 3, 3, 3, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:29:33', '2025-12-04 05:29:33'),
(45, 4, 9, 2, '3', 1, 4, 4, 4, 4, NULL, 'Completed', '2025-12-04', 12, 2025, '2025-12-04 05:30:00', '2025-12-04 05:30:00'),
(46, 13, 11, 3, '3', 1, 2, 2, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:30:36', '2025-12-04 05:30:36'),
(47, 14, 8, 3, '3', 1, 3, 3, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:30:58', '2025-12-04 05:30:58'),
(48, 15, 11, 3, '3', 1, 3, 3, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:31:52', '2025-12-04 05:31:52'),
(49, 16, 10, 3, '3', 1, 2, 2, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:32:23', '2025-12-04 05:32:23'),
(50, 17, 12, 3, '3', 1, 3, 3, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:32:43', '2025-12-04 05:32:43'),
(51, 18, 13, 3, '3', 1, 3, 3, 0, 0, NULL, 'Pending', '2025-12-04', 12, 2025, '2025-12-04 05:33:12', '2025-12-04 05:33:12');

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
-- Indexes for table `eslms`
--
ALTER TABLE `eslms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papers_program_id_index` (`program_id`),
  ADD KEY `papers_codes_index` (`codes`);

--
-- Indexes for table `paper_allocations`
--
ALTER TABLE `paper_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paper_allocations_paper_id_foreign` (`paper_id`),
  ADD KEY `paper_allocations_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `ppt`
--
ALTER TABLE `ppt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_program_id_unique` (`program_id`),
  ADD UNIQUE KEY `programs_program_code_unique` (`program_code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_emp_id_unique` (`emp_id`),
  ADD UNIQUE KEY `staff_official_email_unique` (`official_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_paper_id_foreign` (`paper_id`),
  ADD KEY `videos_emp_id_foreign` (`emp_id`),
  ADD KEY `videos_program_id_foreign` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eslms`
--
ALTER TABLE `eslms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `paper_allocations`
--
ALTER TABLE `paper_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ppt`
--
ALTER TABLE `ppt`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `papers_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paper_allocations`
--
ALTER TABLE `paper_allocations`
  ADD CONSTRAINT `paper_allocations_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paper_allocations_paper_id_foreign` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videos_paper_id_foreign` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `videos_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
