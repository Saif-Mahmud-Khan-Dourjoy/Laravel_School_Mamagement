-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 06:49 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolmanagementproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vatara', '2019-06-12 02:45:28', '2019-06-12 02:45:28'),
(2, 'Khilbarirtake', '2019-06-12 02:45:55', '2019-06-12 02:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `area_id`, `name`, `address`, `contact_no`, `email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vatara', 'House 1, Block  A, Ward 40, Road 4, Vatara , Notunbazar, Gulshan , Dhaka 1212', '09611354354', 'grace1@graspindustries.com', NULL, '2019-06-12 03:30:26', '2019-06-12 03:30:26'),
(2, 2, 'Khilbarirtake', 'House # 7, Road # 3, Ward # 9, Block # B/3, Khilbarirtek, Badda, Dhaka 1212', '09611354354', 'grace1@graspindustries.com', NULL, '2019-06-12 03:36:01', '2019-06-12 03:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `business_months`
--

CREATE TABLE `business_months` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fiscal_year_id` int(10) UNSIGNED NOT NULL,
  `month_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_from` date NOT NULL,
  `ends_on` date NOT NULL,
  `last_payment_date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_months`
--

INSERT INTO `business_months` (`id`, `user_id`, `fiscal_year_id`, `month_name`, `starts_from`, `ends_on`, `last_payment_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'January', '2019-01-01', '2019-01-31', '2019-02-20', NULL, '2019-07-06 23:32:42', '2019-07-06 23:32:42'),
(3, 1, 1, 'February', '2019-02-01', '2019-02-28', '2019-03-20', NULL, '2019-07-06 23:43:23', '2019-07-06 23:43:23'),
(4, 1, 1, 'March', '2019-03-01', '2019-03-31', '2019-04-22', NULL, '2019-07-07 00:50:11', '2019-07-07 00:50:11'),
(5, 1, 1, 'April', '2019-04-01', '2019-04-30', '2019-05-20', NULL, '2019-07-07 22:07:09', '2019-07-07 22:07:09'),
(6, 1, 1, 'May', '2019-05-01', '2019-05-31', '2019-06-20', NULL, '2019-07-07 22:09:09', '2019-07-07 22:09:09'),
(7, 1, 1, 'June', '2019-06-01', '2019-06-30', '2019-07-22', NULL, '2019-07-07 22:10:41', '2019-07-07 22:10:41'),
(8, 1, 1, 'July', '2019-07-01', '2019-07-31', '2019-08-20', NULL, '2019-07-07 22:13:09', '2019-07-07 22:13:09'),
(9, 1, 1, 'August', '2019-08-01', '2019-08-31', '2019-09-20', NULL, '2019-07-07 22:15:27', '2019-07-07 22:15:27'),
(10, 1, 1, 'September', '2019-09-01', '2019-09-30', '2019-10-20', NULL, '2019-07-07 22:39:43', '2019-07-07 22:39:43'),
(11, 1, 1, 'October', '2019-10-01', '2019-10-31', '2019-11-20', NULL, '2019-07-07 22:41:49', '2019-07-07 22:41:49'),
(12, 1, 1, 'November', '2019-11-01', '2019-11-30', '2019-12-10', NULL, '2019-07-07 22:44:59', '2019-07-07 22:44:59'),
(13, 1, 2, 'January', '2019-01-01', '2019-01-31', '2019-02-20', NULL, '2019-07-07 22:51:03', '2019-07-07 22:55:00'),
(14, 1, 2, 'February', '2019-02-01', '2019-02-28', '2019-03-20', NULL, '2019-07-07 22:56:31', '2019-07-07 22:56:31'),
(15, 1, 2, 'March', '2019-03-01', '2019-03-31', '2019-04-20', NULL, '2019-07-07 22:57:58', '2019-07-07 22:57:58'),
(16, 1, 2, 'April', '2019-04-01', '2019-04-30', '2019-05-20', NULL, '2019-07-07 23:03:35', '2019-07-07 23:03:35'),
(17, 1, 2, 'May', '2019-05-01', '2019-05-31', '2019-06-20', NULL, '2019-07-07 23:06:58', '2019-07-07 23:06:58'),
(18, 1, 2, 'June', '2019-06-01', '2019-06-30', '2019-07-20', NULL, '2019-07-07 23:09:04', '2019-07-07 23:09:04'),
(19, 1, 2, 'July', '2019-07-01', '2019-07-31', '2019-08-20', NULL, '2019-07-07 23:10:04', '2019-07-07 23:10:04'),
(20, 1, 2, 'August', '2019-08-01', '2019-08-31', '2019-09-20', NULL, '2019-07-07 23:11:44', '2019-07-07 23:11:44'),
(21, 1, 2, 'September', '2019-09-01', '2019-09-30', '2019-10-20', NULL, '2019-07-07 23:13:07', '2019-07-07 23:13:07'),
(22, 1, 2, 'October', '2019-10-01', '2019-10-31', '2019-11-20', NULL, '2019-07-07 23:15:50', '2019-07-07 23:15:50'),
(23, 1, 2, 'November', '2019-11-01', '2019-11-30', '2019-12-10', NULL, '2019-07-07 23:21:43', '2019-07-07 23:21:43'),
(24, 1, 2, 'December', '2019-12-01', '2019-12-31', '2019-12-31', NULL, '2019-07-07 23:22:50', '2019-07-07 23:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'stationary', 1, '2019-07-03 00:49:31', '2019-07-03 00:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `collected_fees`
--

CREATE TABLE `collected_fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `collector_id` int(10) UNSIGNED NOT NULL,
  `section_student_id` int(10) UNSIGNED NOT NULL,
  `payment_method_id` int(10) UNSIGNED NOT NULL,
  `prefix_id` int(11) NOT NULL,
  `fees_book_leaf_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection_date` date NOT NULL,
  `total_collected` decimal(8,2) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `total_advanced` decimal(8,2) NOT NULL,
  `total_due` decimal(8,2) NOT NULL,
  `business_month_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_wise_fees_ids` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collected_fees`
--

INSERT INTO `collected_fees` (`id`, `collector_id`, `section_student_id`, `payment_method_id`, `prefix_id`, `fees_book_leaf_number`, `collection_date`, `total_collected`, `discount_amount`, `total_advanced`, `total_due`, `business_month_id`, `section_wise_fees_ids`, `deleted_at`, `created_at`, `updated_at`, `student_id`) VALUES
(1, 1, 143, 1, 1, '1', '2019-08-01', '100.00', 0, '0.00', '0.00', '2', '3', NULL, '2019-08-01 07:01:24', '2019-08-01 07:01:24', 146);

-- --------------------------------------------------------

--
-- Table structure for table `fees_books`
--

CREATE TABLE `fees_books` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `creator_user_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `total_leaf` int(10) UNSIGNED NOT NULL,
  `leaf_start_number` int(11) NOT NULL,
  `leaf_end_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees_books`
--

INSERT INTO `fees_books` (`id`, `branch_id`, `creator_user_id`, `teacher_id`, `total_leaf`, `leaf_start_number`, `leaf_end_number`, `created_at`, `updated_at`, `prefix`, `prefix_id`) VALUES
(2, 1, 1, 19, 100, 1, 100, '2019-07-08 02:21:58', '2019-07-08 02:21:58', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fees_types`
--

CREATE TABLE `fees_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fees_type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees_types`
--

INSERT INTO `fees_types` (`id`, `user_id`, `fees_type_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admission Fees', NULL, '2019-07-03 00:41:42', '2019-07-08 00:58:46'),
(2, 1, 'Monthly Fees', NULL, '2019-07-08 00:50:54', '2019-07-08 00:58:39'),
(3, 1, 'Books', NULL, '2019-07-08 00:59:42', '2019-07-08 00:59:42'),
(4, 1, 'Syllabus', NULL, '2019-07-08 00:59:52', '2019-07-08 00:59:52'),
(5, 1, 'Monogram', NULL, '2019-07-08 01:02:09', '2019-07-08 01:02:09'),
(6, 1, 'ID Card', NULL, '2019-07-08 01:03:07', '2019-07-08 01:03:07'),
(7, 1, 'Exam Fees', NULL, '2019-07-08 02:23:16', '2019-07-08 02:23:16'),
(8, 1, 'Notes', NULL, '2019-07-08 02:23:30', '2019-07-08 02:23:30'),
(9, 1, 'Certificate', NULL, '2019-07-08 02:25:12', '2019-07-08 02:25:12'),
(10, 1, 'Others', NULL, '2019-07-08 02:25:24', '2019-07-08 02:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `final_reports`
--

CREATE TABLE `final_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `final_result_id` int(10) UNSIGNED NOT NULL,
  `section_subject_teacher_id` int(10) UNSIGNED NOT NULL,
  `subject_marks` decimal(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_results`
--

CREATE TABLE `final_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `processor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_years`
--

CREATE TABLE `fiscal_years` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `starts_from` date NOT NULL,
  `ends_on` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiscal_years`
--

INSERT INTO `fiscal_years` (`id`, `year`, `branch_id`, `user_id`, `starts_from`, `ends_on`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Vatara 2019 Rose', 1, 1, '2019-01-01', '2019-12-31', NULL, '2019-07-03 00:31:34', '2019-07-06 21:41:42'),
(2, 'Khilbarir 2019 Lotus', 2, 1, '2019-01-01', '2019-12-31', NULL, '2019-07-06 21:42:35', '2019-07-31 10:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_of_sub` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `class_name`, `num_of_sub`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Play', 6, NULL, '2019-06-12 04:51:35', '2019-06-12 04:51:35'),
(2, 'Nursery', 6, NULL, '2019-06-12 05:16:08', '2019-06-12 05:16:08'),
(3, 'K. G.', 7, NULL, '2019-06-12 05:16:51', '2019-06-12 05:16:51'),
(4, 'One', 8, NULL, '2019-06-12 05:17:17', '2019-06-12 05:17:17'),
(5, 'Two', 10, NULL, '2019-06-12 05:17:53', '2019-06-12 05:17:53'),
(6, 'Three', 11, NULL, '2019-06-12 05:18:29', '2019-06-12 05:18:29'),
(7, 'Four', 12, NULL, '2019-06-12 05:19:00', '2019-06-12 05:20:00'),
(8, 'Five', 7, NULL, '2019-06-12 05:20:26', '2019-06-12 05:20:26'),
(9, 'Six', 9, NULL, '2019-06-12 05:21:23', '2019-06-25 05:33:03'),
(10, 'Seven', 9, NULL, '2019-06-12 05:22:59', '2019-06-25 05:32:25'),
(11, 'Eight', 9, NULL, '2019-06-12 05:23:17', '2019-06-25 05:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `level_enrolls`
--

CREATE TABLE `level_enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level_enrolls`
--

INSERT INTO `level_enrolls` (`id`, `level_id`, `session_id`, `branch_id`, `shift_id`, `created_at`, `updated_at`) VALUES
(3, 1, 4, 1, 1, '2019-06-12 05:24:46', '2019-06-12 05:24:46'),
(4, 2, 4, 1, 1, '2019-06-12 05:25:12', '2019-06-12 05:25:12'),
(5, 3, 4, 1, 1, '2019-06-12 05:25:47', '2019-06-12 05:25:47'),
(6, 4, 4, 1, 1, '2019-06-12 05:26:13', '2019-06-12 05:26:13'),
(7, 5, 4, 1, 1, '2019-06-12 05:26:41', '2019-06-12 05:26:41'),
(8, 6, 4, 1, 1, '2019-06-12 05:26:56', '2019-06-12 05:26:56'),
(9, 7, 4, 1, 2, '2019-06-12 05:27:49', '2019-06-12 05:27:49'),
(10, 8, 4, 1, 2, '2019-06-12 05:28:20', '2019-06-12 05:28:20'),
(11, 9, 4, 1, 2, '2019-06-12 05:29:29', '2019-06-12 05:29:29'),
(12, 10, 4, 1, 2, '2019-06-12 05:29:44', '2019-06-12 05:29:44'),
(13, 11, 4, 1, 2, '2019-06-12 05:30:05', '2019-06-12 05:30:05'),
(14, 1, 3, 2, 3, '2019-07-03 03:28:39', '2019-07-03 03:28:39'),
(15, 2, 3, 2, 3, '2019-07-03 03:34:56', '2019-07-03 03:34:56'),
(16, 3, 3, 2, 3, '2019-07-03 03:35:25', '2019-07-03 03:35:25'),
(17, 4, 3, 2, 3, '2019-07-03 03:36:00', '2019-07-03 03:36:00'),
(18, 8, 3, 2, 3, '2019-07-03 03:36:47', '2019-07-03 03:36:47'),
(19, 5, 3, 2, 4, '2019-07-03 03:37:10', '2019-07-03 03:37:10'),
(20, 6, 3, 2, 4, '2019-07-03 03:37:45', '2019-07-03 03:37:45'),
(21, 7, 3, 2, 4, '2019-07-03 03:38:07', '2019-07-03 03:38:07'),
(22, 8, 3, 2, 4, '2019-07-03 03:39:00', '2019-07-03 03:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_01_22_102245_create_terms_table', 1),
(4, '2018_11_24_111111_create__areas__table', 1),
(5, '2018_11_24_111112_create__branches__table', 1),
(6, '2018_11_24_111113_create__sessions__table', 1),
(7, '2018_11_24_111114_create__shifts__table', 1),
(8, '2018_11_24_111115_create__teachers__table', 1),
(9, '2018_11_24_111116_create__levels__table', 1),
(10, '2018_11_24_111117_create_level_enrolls_table', 1),
(11, '2018_11_24_111118_create__sections__table', 1),
(12, '2018_11_24_111119_create__students__table', 1),
(13, '2018_11_24_111120_create_section_students_table', 1),
(14, '2018_11_24_111121_create_subjects_table', 1),
(15, '2019_01_08_094408_create_section_subject_teachers_table', 1),
(16, '2019_01_08_112849_create_student_subject_results_table', 1),
(17, '2019_01_10_090118_create_weekly_tests_table', 1),
(18, '2019_01_10_090231_create_weekly_test_results_table', 1),
(19, '2019_01_21_105555_create_term_result_table', 1),
(20, '2019_01_22_085715_create_selected_id_table', 1),
(21, '2019_02_02_095302_change_weekly_test_marks_column_type', 1),
(22, '2019_02_02_095918_change_column_types_term_results_table', 1),
(23, '2019_02_03_061133_update_level_enrolls_table', 1),
(24, '2019_02_03_062216_update_sections_table', 1),
(25, '2019_02_03_063713_update_section_students_table', 1),
(26, '2019_02_03_064656_update_section_subject_teachers_table', 1),
(27, '2019_02_03_070152_update_student_subject_results_table', 1),
(28, '2019_02_03_083930_update_term_results_table', 1),
(29, '2019_02_05_111737_drop_fax_column_from_branch_table', 1),
(30, '2019_02_05_112232_drop_fathers_mothers_cell_from_students_table', 1),
(31, '2019_02_10_120202_create_accounts_table', 1),
(32, '2019_02_12_084702_create_final_results_table', 1),
(33, '2019_02_12_084911_create_final_reports_table', 1),
(34, '2019_02_17_094839_update_final_reports_table', 1),
(35, '2019_03_06_042358_add_contacts_to_students_table', 1),
(36, '2019_03_09_101745_create_fiscal_years_table', 1),
(37, '2019_03_09_102204_create_business_months_table', 1),
(38, '2019_03_09_102245_create_prefixes_table', 1),
(39, '2019_03_09_102246_create_fees_books_table', 1),
(40, '2019_03_09_102247_create_fees_types_table', 1),
(41, '2019_03_09_102248_create_section_wise_fees_table', 1),
(42, '2019_03_09_102326_create_payment_methods_table', 1),
(43, '2019_03_09_105452_create_categories_table', 1),
(44, '2019_03_09_105526_create_suppliers_table', 1),
(45, '2019_03_12_053442_create_voucher_table', 1),
(46, '2019_03_12_062905_create_collected_fees_table', 1),
(47, '2019_03_16_052204_add_year_name_to_fiscal_years_table', 1),
(48, '2019_03_18_032354_add_foreign_teacher_to_fees_books', 1),
(49, '2019_03_18_033608_rename_assigned_user_id_fees_book_table', 1),
(50, '2019_03_18_095421_add_student_id_to_collected_fees_table', 1),
(51, '2019_03_20_040256_add_prefix_to_fees_books_table', 1),
(52, '2019_04_13_091833_rename_column_vouchers_table', 1),
(53, '2019_04_18_100517_add_creator_id_to_payment_method_table', 1),
(54, '2019_04_18_101108_rename_creator_id_in_payment_method_table', 1),
(55, '2019_04_18_103014_add_creator_id_to_category_table', 1),
(56, '2019_04_18_104248_add_creator_id_to_suppliers_table', 1),
(57, '2019_05_14_061435_add_prefix_id_to_fees_books_table', 1),
(58, '2019_05_15_081005_change_leaf_number_type_on_fees_books_table', 1),
(59, '2019_05_16_073851_add_last_payment_day_in_months_table', 1),
(60, '2019_05_20_091015_add_prefix_id_to_collected_fees', 1),
(61, '2019_05_20_093338_add_discount_amount_to_collected_fees', 1),
(62, '2019_05_20_093838_add_month_and_fees_type_to_collected_fees', 1),
(63, '2019_06_10_091226_changefees_bookstable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(10) UNSIGNED NOT NULL,
  `method_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, '2019-07-03 00:45:17', '2019-07-03 00:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modual` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `modual`, `created_at`, `updated_at`) VALUES
(15, 'area.index', 'All Data View', 'area', '2019-08-04 07:07:02', '2019-08-04 07:09:32'),
(16, 'area.create', 'Only Can Create', 'area', '2019-08-04 07:07:37', '2019-08-04 07:09:22'),
(17, 'area.show', 'Only Can Read', 'area', '2019-08-04 07:08:07', '2019-08-04 07:08:07'),
(18, 'area.edit', 'Only Can Edit', 'area', '2019-08-04 07:08:29', '2019-08-04 07:09:11'),
(19, 'area.destroy', 'Only Can Delete', 'area', '2019-08-04 07:08:54', '2019-08-04 07:08:54'),
(20, 'branch.index', 'Branch All view', 'branch', '2019-08-04 07:10:37', '2019-08-04 07:10:37'),
(21, 'branch.create', 'Only Can edit', 'branch', '2019-08-04 07:37:56', '2019-08-04 07:37:56'),
(22, 'branch.show', 'Only Can Read', 'branch', '2019-08-04 07:38:30', '2019-08-04 07:38:30'),
(23, 'branch.edit', 'Only can edit', 'branch', '2019-08-04 07:39:55', '2019-08-04 07:39:55'),
(24, 'branch.destroy', 'Only Can Delete', 'branch', '2019-08-04 07:40:56', '2019-08-04 07:40:56'),
(25, 'session.index', 'Session All view', 'session', '2019-08-04 07:42:57', '2019-08-04 07:42:57'),
(26, 'session.create', 'Only Can Create', 'session', '2019-08-04 07:43:25', '2019-08-04 07:43:25'),
(27, 'session.show', 'Only Can Read', 'session', '2019-08-04 07:43:43', '2019-08-04 07:43:43'),
(28, 'session.edit', 'Only Can edit', 'session', '2019-08-04 07:44:05', '2019-08-04 07:44:05'),
(29, 'session.destroy', 'Only Can Delete', 'session', '2019-08-04 07:44:29', '2019-08-04 07:44:29'),
(30, 'term.index', 'All Data View', 'term', '2019-08-04 07:54:16', '2019-08-04 07:54:16'),
(31, 'term.create', 'Only Can Create', 'term', '2019-08-04 07:54:42', '2019-08-04 07:54:42'),
(32, 'term.show', 'Only Can Read', 'term', '2019-08-04 07:55:06', '2019-08-04 07:55:06'),
(33, 'term.edit', 'Only Can Edit', 'term', '2019-08-04 07:55:27', '2019-08-04 07:55:27'),
(34, 'term.destroy', 'Only Can Delete', 'term', '2019-08-04 07:55:54', '2019-08-04 07:55:54'),
(35, 'shift.index', 'All Data View', 'shift', '2019-08-04 07:57:05', '2019-08-04 07:57:05'),
(36, 'shift.create', 'Only Can Create', 'shift', '2019-08-04 07:57:33', '2019-08-04 07:57:33'),
(37, 'shift.show', 'Only Can Read', 'shift', '2019-08-04 07:57:56', '2019-08-04 07:57:56'),
(38, 'shift.edit', 'Only Can Edit', 'shift', '2019-08-04 07:58:22', '2019-08-04 07:58:22'),
(39, 'Shift.destroy', 'Only Can Delete', 'shift', '2019-08-04 07:58:54', '2019-08-04 07:58:54'),
(40, 'teacher.index', 'All Data View', 'teacher', '2019-08-04 08:00:24', '2019-08-04 08:00:24'),
(41, 'teacher.create', 'Only Can Create', 'teacher', '2019-08-04 08:00:43', '2019-08-04 08:00:43'),
(42, 'teacher.show', 'Only Can Read', 'teacher', '2019-08-04 08:01:08', '2019-08-04 08:01:08'),
(43, 'teacher.edit', 'Only Can Edit', 'teacher', '2019-08-04 08:01:31', '2019-08-04 08:01:31'),
(44, 'teacher.destroy', 'Only Can Delete', 'teacher', '2019-08-04 08:02:05', '2019-08-04 08:02:05'),
(45, 'level.index', 'All Data View', 'level', '2019-08-04 08:04:48', '2019-08-04 08:04:48'),
(46, 'level.create', 'Only Can Create', 'level', '2019-08-04 08:05:07', '2019-08-04 08:05:07'),
(47, 'level.show', 'Only Can Read', 'level', '2019-08-04 08:05:35', '2019-08-04 08:05:35'),
(48, 'level.edit', 'Only Can Edit', 'level', '2019-08-04 08:06:01', '2019-08-04 08:06:01'),
(49, 'level.destroy', 'Only Can Delete', 'level', '2019-08-04 08:06:45', '2019-08-04 08:06:45'),
(50, 'section.index', 'All Data View', 'section', '2019-08-04 09:39:24', '2019-08-04 09:39:24'),
(51, 'section.create', 'Only Can Create', 'section', '2019-08-04 09:39:45', '2019-08-04 09:39:45'),
(52, 'section.show', 'Only Can Read', 'section', '2019-08-04 09:40:06', '2019-08-04 09:40:06'),
(53, 'section.edit', 'Only Can Edit', 'section', '2019-08-04 09:40:25', '2019-08-04 09:40:25'),
(54, 'section.destroy', 'Only Can Delete', 'section', '2019-08-04 09:40:59', '2019-08-04 09:40:59'),
(55, 'student.index', 'All Data View', 'student', '2019-08-04 09:41:53', '2019-08-04 09:41:53'),
(56, 'student.create', 'Only Can Create', 'student', '2019-08-04 09:42:14', '2019-08-04 09:42:14'),
(57, 'student.show', 'Only Can Read', 'student', '2019-08-04 09:42:39', '2019-08-04 09:42:39'),
(58, 'student.edit', 'Only Can Edit', 'student', '2019-08-04 09:43:40', '2019-08-04 09:43:40'),
(59, 'student.destroy', 'Only Can Delete', 'student', '2019-08-04 09:44:02', '2019-08-04 09:44:02'),
(60, 'subject.index', 'All Data View', 'subject', '2019-08-04 09:45:20', '2019-08-04 09:45:20'),
(61, 'subject.create', 'Only Can Create', 'subject', '2019-08-04 09:45:44', '2019-08-04 09:45:44'),
(62, 'subject.show', 'Only Can Read', 'subject', '2019-08-04 09:46:11', '2019-08-04 09:46:11'),
(63, 'subject.edit', 'Only Can Edit', 'subject', '2019-08-04 09:46:33', '2019-08-04 09:46:33'),
(64, 'subject.destroy', 'Only Can Delete', 'subject', '2019-08-04 09:46:55', '2019-08-04 09:46:55'),
(65, 'weekly_test.index', 'All Data View', 'weekly_test', '2019-08-04 09:47:38', '2019-08-04 09:47:38'),
(66, 'weekly_test.create', 'Only Can Create', 'weekly_test', '2019-08-04 09:48:01', '2019-08-04 09:48:01'),
(67, 'weekly_test.show', 'Only Can Read', 'weekly_test', '2019-08-04 09:48:20', '2019-08-04 09:48:20'),
(68, 'weekly_test.edit', 'Only Can Edit', 'weekly_test', '2019-08-04 09:48:46', '2019-08-04 09:48:46'),
(69, 'weekly_test.destroy', 'Only Can Delete', 'weekly_test', '2019-08-04 09:49:05', '2019-08-04 09:49:05'),
(70, 'report.index', 'All Data View', 'report', '2019-08-04 09:50:39', '2019-08-04 09:50:39'),
(71, 'report.create', 'Only Can Create', 'report', '2019-08-04 09:51:10', '2019-08-04 09:51:10'),
(72, 'report.show', 'Only Can Read', 'report', '2019-08-04 09:51:35', '2019-08-04 09:51:35'),
(73, 'report.edit', 'Only Can Edit', 'report', '2019-08-04 09:51:55', '2019-08-04 09:51:55'),
(74, 'report.destroy', 'Only Can Delete', 'report', '2019-08-04 09:53:02', '2019-08-04 09:53:02'),
(75, 'fiscal_year.index', 'All Data View', 'fiscal_year', '2019-08-04 10:04:45', '2019-08-04 10:04:45'),
(76, 'fiscal_year.create', 'Only Can Create', 'fiscal_year', '2019-08-04 10:05:02', '2019-08-04 10:05:02'),
(77, 'fiscal_year.show', 'Only Can Read', 'fiscal_year', '2019-08-04 10:05:24', '2019-08-04 10:05:24'),
(78, 'fiscal_year.edit', 'Only Can Edit', 'fiscal_year', '2019-08-04 10:10:41', '2019-08-04 10:10:41'),
(79, 'fiscal_year.destroy', 'Only Can Delete', 'fiscal_year', '2019-08-04 10:11:32', '2019-08-04 10:11:32'),
(80, 'business_month.index', 'All Data View', 'business_month', '2019-08-04 10:12:58', '2019-08-04 10:12:58'),
(81, 'business_month.create', 'Only Can Create', 'business_month', '2019-08-04 10:13:21', '2019-08-04 10:13:21'),
(82, 'business_month.show', 'Only Can Read', 'business_month', '2019-08-04 10:17:20', '2019-08-04 10:17:20'),
(83, 'business_month.edit', 'Only Can Edit', 'business_month', '2019-08-04 10:17:39', '2019-08-04 10:17:39'),
(84, 'business_month.destroy', 'Only Can Delete', 'business_month', '2019-08-04 10:18:20', '2019-08-04 10:18:20'),
(85, 'prefix.index', 'All Data View', 'prefix', '2019-08-04 10:20:39', '2019-08-04 10:20:39'),
(86, 'prefix.create', 'Only Can Create', 'prefix', '2019-08-04 10:20:59', '2019-08-04 10:20:59'),
(87, 'prefix.show', 'Only Can Read', 'prefix', '2019-08-04 10:21:19', '2019-08-04 10:21:19'),
(88, 'prefix.edit', 'Only Can Edit', 'prefix', '2019-08-04 10:21:39', '2019-08-04 10:21:39'),
(89, 'prefix.destroy', 'Only Can Delete', 'prefix', '2019-08-04 10:21:58', '2019-08-04 10:21:58'),
(90, 'fees_book.index', 'All Data View', 'fees_book', '2019-08-04 10:24:14', '2019-08-04 10:24:14'),
(91, 'fees_book.create', 'Only Can Create', 'fees_book', '2019-08-04 10:24:28', '2019-08-04 10:24:28'),
(92, 'fees_book.show', 'Only Can Read', 'fees_book', '2019-08-04 10:24:47', '2019-08-04 10:24:47'),
(93, 'fees_book.edit', 'Only Can Edit', 'fees_book', '2019-08-04 10:25:03', '2019-08-04 10:25:03'),
(94, 'fees_book.destroy', 'Only Can Delete', 'fees_book', '2019-08-04 10:25:19', '2019-08-04 10:25:19'),
(95, 'fees_type.index', 'All Data View', 'fees_type', '2019-08-05 02:42:08', '2019-08-05 02:43:05'),
(96, 'fees_type.create', 'Only Can Create', 'fees_type', '2019-08-05 02:43:57', '2019-08-05 02:43:57'),
(97, 'fees_type.show', 'Only Can Read', 'fees_type', '2019-08-05 02:45:31', '2019-08-05 02:45:31'),
(98, 'fees_type.edit', 'Only Can Edit', 'fees_type', '2019-08-05 02:45:53', '2019-08-05 02:45:53'),
(99, 'fees_type.destroy', 'Only Can Delete', 'fees_type', '2019-08-05 02:46:14', '2019-08-05 02:46:14'),
(100, 'section_wise_fees.index', 'All Data View', 'section_wise_fees', '2019-08-05 02:48:27', '2019-08-05 02:48:27'),
(101, 'section_wise_fees.create', 'Only Can Create', 'section_wise_fees', '2019-08-05 02:48:46', '2019-08-05 02:48:46'),
(102, 'section_wise_fees.show', 'Only Can Read', 'section_wise_fees', '2019-08-05 02:49:04', '2019-08-05 02:49:04'),
(103, 'section_wise_fees.edit', 'Only Can Edit', 'section_wise_fees', '2019-08-05 02:49:22', '2019-08-05 02:49:22'),
(104, 'section_wise_fees.destroy', 'Only Can Delete', 'section_wise_fees', '2019-08-05 02:49:39', '2019-08-05 02:49:39'),
(105, 'payment_method.index', 'All Data View', 'payment_method', '2019-08-05 02:51:52', '2019-08-05 02:51:52'),
(106, 'payment_method.create', 'Only Can Create', 'payment_method', '2019-08-05 02:52:32', '2019-08-05 02:52:32'),
(107, 'payment_method.show', 'Only Can Read', 'payment_method', '2019-08-05 02:53:10', '2019-08-05 02:53:10'),
(108, 'payment_method.edit', 'Only Can Edit', 'payment_method', '2019-08-05 02:53:36', '2019-08-05 02:53:36'),
(109, 'payment_method.destroy', 'Only Can Delete', 'payment_method', '2019-08-05 02:53:52', '2019-08-05 02:53:52'),
(110, 'collected_fees.index', 'All Data View', 'collected_fees', '2019-08-05 02:56:14', '2019-08-05 02:56:14'),
(111, 'collected_fees.create', 'Only Can Create', 'collected_fees', '2019-08-05 02:56:32', '2019-08-05 02:56:32'),
(112, 'collected_fees.show', 'Only Can Read', 'collected_fees', '2019-08-05 02:56:53', '2019-08-05 02:56:53'),
(113, 'collected_fees.edit', 'Only Can Edit', 'collected_fees', '2019-08-05 02:57:08', '2019-08-05 02:57:08'),
(114, 'collected_fees,destroy', 'Only Can Delete', 'collected_fees', '2019-08-05 02:57:32', '2019-08-05 02:57:32'),
(115, 'category.index', 'All Data View', 'category', '2019-08-05 03:19:58', '2019-08-05 03:19:58'),
(116, 'category.create', 'Only Can Create', 'category', '2019-08-05 03:20:23', '2019-08-05 03:20:23'),
(117, 'category.show', 'Only Can Read', 'category', '2019-08-05 03:20:47', '2019-08-05 03:20:47'),
(118, 'category.edit', 'Only Can Edit', 'category', '2019-08-05 03:23:35', '2019-08-05 03:23:35'),
(119, 'category.destroy', 'Only Can Delete', 'category', '2019-08-05 03:24:01', '2019-08-05 03:24:01'),
(120, 'supplier.index', 'All Data View', 'supplier', '2019-08-05 03:24:48', '2019-08-05 03:24:48'),
(121, 'supplier.create', 'Only Can Create', 'supplier', '2019-08-05 03:25:17', '2019-08-05 03:25:17'),
(122, 'supplier.show', 'Only Can Read', 'supplier', '2019-08-05 03:26:02', '2019-08-05 03:26:02'),
(123, 'supplier.edit', 'Only Can Edit', 'supplier', '2019-08-05 03:26:29', '2019-08-05 03:26:29'),
(124, 'supplier.destroy', 'Only Can Delete', 'supplier', '2019-08-05 03:27:24', '2019-08-05 03:27:24'),
(125, 'voucher.index', 'All Data View', 'voucher', '2019-08-05 03:29:20', '2019-08-05 03:29:20'),
(126, 'voucher.create', 'Only Can Create', 'voucher', '2019-08-05 03:29:38', '2019-08-05 03:29:38'),
(127, 'voucher.show', 'Only Can Read', 'voucher', '2019-08-05 03:29:56', '2019-08-05 03:29:56'),
(128, 'voucher.edit', 'Only Can Edit', 'voucher', '2019-08-05 03:30:17', '2019-08-05 03:30:17'),
(129, 'voucher.destroy', 'Only Can Delete', 'voucher', '2019-08-05 03:30:32', '2019-08-05 03:30:32'),
(130, 'final_report.index', 'All Data View', 'final_report', '2019-08-05 03:32:09', '2019-08-05 03:32:09'),
(131, 'final_report.create', 'Only Can Create', 'final_report', '2019-08-05 03:32:42', '2019-08-05 03:32:42'),
(132, 'final_report.show', 'Only Can Read', 'final_report', '2019-08-05 03:34:52', '2019-08-05 03:34:52'),
(133, 'final_report.edit', 'Only Can Edit', 'final_report', '2019-08-05 03:35:09', '2019-08-05 03:35:09'),
(134, 'final_report.destroy', 'Only Can Delete', 'final_report', '2019-08-05 03:35:37', '2019-08-05 03:35:37'),
(135, 'role.index', 'All Data View', 'role', '2019-08-05 03:40:09', '2019-08-05 03:40:09'),
(136, 'role.create', 'Only Can Create', 'role', '2019-08-05 03:40:58', '2019-08-05 03:40:58'),
(137, 'role.show', 'Only Can Read', 'role', '2019-08-05 03:41:20', '2019-08-05 03:41:20'),
(138, 'role.edit', 'Only Can Edit', 'role', '2019-08-05 03:42:04', '2019-08-05 03:42:04'),
(139, 'role.destroy', 'Only Can Delete', 'role', '2019-08-05 03:42:26', '2019-08-05 03:42:26'),
(140, 'user.index', 'All Data View', 'user', '2019-08-05 03:47:10', '2019-08-05 03:47:10'),
(141, 'user.create', 'Only Can Create', 'user', '2019-08-05 03:47:37', '2019-08-05 03:47:37'),
(142, 'user.show', 'Only Can Read', 'user', '2019-08-05 03:48:04', '2019-08-05 03:48:04'),
(143, 'user.edit', 'Only Can Edit', 'user', '2019-08-05 03:48:32', '2019-08-05 03:48:32'),
(144, 'user.destroy', 'Only Can Delete', 'user', '2019-08-05 03:52:56', '2019-08-05 03:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prefixes`
--

CREATE TABLE `prefixes` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prefixes`
--

INSERT INTO `prefixes` (`id`, `prefix`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'GV', 1, '2019-07-03 00:35:09', '2019-07-03 00:35:09'),
(2, 'GK', 1, '2019-07-06 23:08:44', '2019-07-06 23:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(18, 'Writer', 'user', '2019-07-31 03:51:14', '2019-07-31 03:51:14'),
(19, 'Editor', 'user', '2019-07-31 03:51:32', '2019-07-31 03:51:32'),
(20, 'Publisher', 'user', '2019-07-31 03:51:51', '2019-07-31 03:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(1, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `level_enroll_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `level_enroll_id`, `teacher_id`, `section_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 13, 2, 'Section A', NULL, '2019-06-22 00:23:42', '2019-06-22 00:23:42'),
(2, 12, 10, 'Section A', NULL, '2019-06-22 23:49:58', '2019-06-22 23:49:58'),
(3, 11, 5, 'Section A', NULL, '2019-06-22 23:50:24', '2019-06-22 23:50:24'),
(4, 10, 3, 'Section A', NULL, '2019-06-22 23:50:48', '2019-06-22 23:50:48'),
(5, 9, 8, 'Section A', NULL, '2019-06-22 23:51:12', '2019-06-22 23:51:12'),
(6, 8, 5, 'Section A', NULL, '2019-06-22 23:51:46', '2019-06-22 23:51:46'),
(7, 7, 3, 'Section A', NULL, '2019-06-22 23:52:27', '2019-06-22 23:52:27'),
(9, 5, 8, 'Section A', NULL, '2019-06-22 23:53:24', '2019-06-22 23:53:24'),
(10, 4, 6, 'Section A', NULL, '2019-06-22 23:54:07', '2019-06-22 23:54:07'),
(11, 3, 9, 'Section A', NULL, '2019-06-22 23:54:37', '2019-06-22 23:54:37'),
(12, 6, 10, 'Section A', NULL, '2019-06-23 23:54:00', '2019-06-23 23:54:00'),
(15, 14, 16, 'Section A (Khilbarirtake)', NULL, '2019-07-03 03:51:38', '2019-07-08 03:41:22'),
(16, 15, 13, 'Section A (Khilbarirtake)', NULL, '2019-07-03 03:59:08', '2019-07-08 03:40:58'),
(17, 16, 14, 'Section A (Khilbarirtake)', NULL, '2019-07-03 03:59:52', '2019-07-08 03:39:44'),
(18, 17, 15, 'Section A (Khilbarirtake)', NULL, '2019-07-03 04:05:17', '2019-07-08 03:38:41'),
(19, 19, 14, 'Section A (Khilbarirtake)', NULL, '2019-07-03 04:17:14', '2019-07-08 03:38:02'),
(20, 20, 15, 'Section A (Khilbarirtake)', NULL, '2019-07-03 04:19:32', '2019-07-08 03:37:25'),
(21, 21, 13, 'Section A (Khilbarirtake)', NULL, '2019-07-03 04:20:38', '2019-07-08 03:36:47'),
(22, 22, 17, 'Section A (Khilbarirtake)', NULL, '2019-07-03 04:21:19', '2019-07-08 03:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `section_students`
--

CREATE TABLE `section_students` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_students`
--

INSERT INTO `section_students` (`id`, `section_id`, `student_id`, `created_at`, `updated_at`) VALUES
(3, 5, 3, '2019-06-25 23:52:18', '2019-06-25 23:52:18'),
(4, 3, 4, '2019-06-25 23:54:30', '2019-06-25 23:54:30'),
(5, 3, 5, '2019-06-26 00:15:11', '2019-06-26 00:15:11'),
(6, 3, 7, '2019-06-26 00:35:40', '2019-06-26 00:35:40'),
(7, 6, 8, '2019-06-26 00:36:42', '2019-06-26 00:36:42'),
(8, 6, 10, '2019-06-26 00:46:53', '2019-06-26 00:46:53'),
(9, 6, 12, '2019-06-26 00:53:38', '2019-06-26 00:53:38'),
(10, 3, 14, '2019-06-26 01:09:34', '2019-06-26 01:09:34'),
(11, 6, 15, '2019-06-26 02:36:42', '2019-06-26 02:36:42'),
(12, 3, 16, '2019-06-26 02:37:29', '2019-06-26 02:37:29'),
(14, 6, 17, '2019-06-26 02:44:48', '2019-06-26 02:44:48'),
(15, 6, 18, '2019-06-26 02:56:30', '2019-06-26 02:56:30'),
(16, 2, 19, '2019-06-26 03:21:59', '2019-06-26 03:21:59'),
(17, 9, 13, '2019-06-26 03:33:20', '2019-06-26 03:33:20'),
(18, 9, 6, '2019-06-26 03:34:33', '2019-06-26 03:34:33'),
(19, 9, 9, '2019-06-26 03:35:30', '2019-06-26 03:35:30'),
(20, 9, 11, '2019-06-26 03:35:53', '2019-06-26 03:35:53'),
(21, 9, 20, '2019-06-26 03:36:51', '2019-06-26 03:36:51'),
(22, 2, 21, '2019-06-26 03:44:14', '2019-06-26 03:44:14'),
(23, 9, 24, '2019-06-26 03:53:39', '2019-06-26 03:53:39'),
(24, 6, 27, '2019-06-26 04:00:58', '2019-06-26 04:00:58'),
(25, 2, 28, '2019-06-26 04:08:11', '2019-06-26 04:08:11'),
(26, 6, 32, '2019-06-26 04:35:26', '2019-06-26 04:35:26'),
(27, 2, 33, '2019-06-26 04:38:48', '2019-06-26 04:38:48'),
(28, 2, 31, '2019-06-26 04:39:27', '2019-06-26 04:39:27'),
(29, 2, 30, '2019-06-26 04:40:25', '2019-06-26 04:40:25'),
(30, 2, 29, '2019-06-26 04:41:15', '2019-06-26 04:41:15'),
(31, 2, 34, '2019-06-26 04:49:32', '2019-06-26 04:49:32'),
(32, 2, 35, '2019-06-26 05:01:10', '2019-06-26 05:01:10'),
(33, 2, 36, '2019-06-26 05:11:10', '2019-06-26 05:11:10'),
(34, 6, 37, '2019-06-26 05:27:40', '2019-06-26 05:27:40'),
(35, 6, 38, '2019-06-26 22:26:22', '2019-06-26 22:26:22'),
(36, 6, 39, '2019-06-26 22:26:45', '2019-06-26 22:26:45'),
(37, 6, 40, '2019-06-26 23:03:40', '2019-06-26 23:03:40'),
(38, 6, 41, '2019-06-26 23:22:43', '2019-06-26 23:22:43'),
(39, 6, 42, '2019-06-26 23:38:37', '2019-06-26 23:38:37'),
(40, 6, 43, '2019-06-27 00:29:08', '2019-06-27 00:29:08'),
(41, 10, 44, '2019-06-27 00:45:12', '2019-06-27 00:45:12'),
(42, 10, 45, '2019-06-27 02:34:45', '2019-06-27 02:34:45'),
(43, 3, 46, '2019-06-27 02:35:21', '2019-06-27 02:35:21'),
(44, 10, 47, '2019-06-27 02:38:53', '2019-06-27 02:38:53'),
(45, 3, 48, '2019-06-27 02:39:24', '2019-06-27 02:39:24'),
(46, 10, 49, '2019-06-27 02:52:11', '2019-06-27 02:52:11'),
(47, 2, 50, '2019-06-29 03:02:40', '2019-06-29 03:02:40'),
(48, 2, 51, '2019-06-29 03:07:45', '2019-06-29 03:07:45'),
(49, 2, 52, '2019-06-29 03:13:42', '2019-06-29 03:13:42'),
(50, 2, 53, '2019-06-29 03:20:33', '2019-06-29 03:20:33'),
(51, 2, 54, '2019-06-29 04:54:29', '2019-06-29 04:54:29'),
(52, 2, 55, '2019-06-29 04:59:36', '2019-06-29 04:59:36'),
(53, 2, 56, '2019-06-29 05:05:23', '2019-06-29 05:05:23'),
(54, 10, 57, '2019-06-29 22:01:23', '2019-06-29 22:01:23'),
(55, 10, 58, '2019-06-29 22:09:27', '2019-06-29 22:09:27'),
(56, 10, 59, '2019-06-29 22:30:27', '2019-06-29 22:30:27'),
(57, 10, 60, '2019-06-29 22:41:52', '2019-06-29 22:41:52'),
(58, 10, 61, '2019-06-29 22:50:53', '2019-06-29 22:50:53'),
(59, 10, 62, '2019-06-29 22:55:48', '2019-06-29 22:55:48'),
(60, 10, 63, '2019-06-29 23:30:29', '2019-06-29 23:30:29'),
(61, 7, 65, '2019-06-30 00:07:16', '2019-06-30 00:07:16'),
(62, 4, 66, '2019-06-30 00:09:17', '2019-06-30 00:09:17'),
(63, 7, 67, '2019-06-30 00:22:14', '2019-06-30 00:22:14'),
(64, 7, 68, '2019-06-30 00:29:02', '2019-06-30 00:29:02'),
(65, 9, 69, '2019-06-30 03:13:31', '2019-06-30 03:13:31'),
(66, 9, 70, '2019-06-30 03:44:46', '2019-06-30 03:44:46'),
(67, 2, 73, '2019-06-30 04:24:36', '2019-06-30 04:24:36'),
(68, 3, 74, '2019-06-30 04:32:14', '2019-06-30 04:32:14'),
(69, 3, 75, '2019-06-30 04:40:10', '2019-06-30 04:40:10'),
(70, 4, 77, '2019-06-30 05:07:03', '2019-06-30 05:07:03'),
(71, 12, 76, '2019-06-30 05:12:15', '2019-06-30 05:12:15'),
(73, 5, 78, '2019-06-30 05:19:13', '2019-06-30 05:19:13'),
(74, 4, 79, '2019-06-30 05:40:17', '2019-06-30 05:40:17'),
(75, 7, 81, '2019-06-30 22:27:45', '2019-06-30 22:27:45'),
(76, 7, 82, '2019-06-30 22:31:37', '2019-06-30 22:31:37'),
(77, 7, 83, '2019-06-30 22:38:15', '2019-06-30 22:38:15'),
(78, 7, 84, '2019-06-30 22:47:25', '2019-06-30 22:47:25'),
(79, 7, 85, '2019-06-30 23:10:23', '2019-06-30 23:10:23'),
(80, 7, 86, '2019-06-30 23:15:01', '2019-06-30 23:15:01'),
(81, 7, 87, '2019-06-30 23:19:23', '2019-06-30 23:19:23'),
(82, 5, 88, '2019-06-30 23:31:50', '2019-06-30 23:31:50'),
(83, 5, 90, '2019-07-01 00:14:33', '2019-07-01 00:14:33'),
(84, 5, 91, '2019-07-01 00:21:06', '2019-07-01 00:21:06'),
(85, 5, 92, '2019-07-01 00:26:38', '2019-07-01 00:26:38'),
(86, 4, 93, '2019-07-01 00:37:13', '2019-07-01 00:37:13'),
(87, 4, 94, '2019-07-01 00:44:18', '2019-07-01 00:44:18'),
(88, 7, 89, '2019-07-01 00:47:15', '2019-07-01 00:47:15'),
(89, 4, 95, '2019-07-01 00:51:06', '2019-07-01 00:51:06'),
(90, 5, 96, '2019-07-01 00:52:36', '2019-07-01 00:52:36'),
(91, 7, 97, '2019-07-01 00:55:57', '2019-07-01 00:55:57'),
(92, 4, 98, '2019-07-01 00:57:05', '2019-07-01 00:57:05'),
(93, 5, 99, '2019-07-01 00:57:30', '2019-07-01 00:57:30'),
(94, 4, 100, '2019-07-01 01:05:03', '2019-07-01 01:05:03'),
(95, 5, 101, '2019-07-01 02:25:06', '2019-07-01 02:25:06'),
(96, 4, 103, '2019-07-01 03:02:24', '2019-07-01 03:02:24'),
(97, 5, 102, '2019-07-01 03:03:14', '2019-07-01 03:03:14'),
(98, 7, 104, '2019-07-01 03:04:11', '2019-07-01 03:04:11'),
(99, 4, 105, '2019-07-01 03:10:54', '2019-07-01 03:10:54'),
(100, 5, 106, '2019-07-01 03:11:06', '2019-07-01 03:11:06'),
(101, 7, 107, '2019-07-01 03:18:46', '2019-07-01 03:18:46'),
(102, 5, 108, '2019-07-01 03:23:24', '2019-07-01 03:23:24'),
(103, 5, 109, '2019-07-01 03:37:23', '2019-07-01 03:37:23'),
(104, 5, 110, '2019-07-01 03:48:34', '2019-07-01 03:48:34'),
(105, 7, 111, '2019-07-01 04:02:12', '2019-07-01 04:02:12'),
(106, 5, 112, '2019-07-01 04:05:24', '2019-07-01 04:05:24'),
(107, 5, 113, '2019-07-01 04:45:40', '2019-07-01 04:45:40'),
(108, 7, 114, '2019-07-01 06:10:03', '2019-07-01 06:10:03'),
(109, 9, 71, '2019-07-01 22:55:03', '2019-07-01 22:55:03'),
(110, 9, 72, '2019-07-01 22:55:31', '2019-07-01 22:55:31'),
(111, 5, 115, '2019-07-01 23:08:58', '2019-07-01 23:08:58'),
(112, 5, 116, '2019-07-01 23:24:53', '2019-07-01 23:24:53'),
(113, 5, 118, '2019-07-01 23:35:21', '2019-07-01 23:35:21'),
(114, 12, 117, '2019-07-01 23:39:40', '2019-07-01 23:39:40'),
(115, 5, 119, '2019-07-01 23:41:35', '2019-07-01 23:41:35'),
(116, 12, 120, '2019-07-01 23:43:08', '2019-07-01 23:43:08'),
(117, 5, 121, '2019-07-01 23:53:20', '2019-07-01 23:53:20'),
(118, 12, 122, '2019-07-02 00:28:55', '2019-07-02 00:28:55'),
(119, 4, 123, '2019-07-02 02:39:22', '2019-07-02 02:39:22'),
(120, 12, 124, '2019-07-02 02:57:37', '2019-07-02 02:57:37'),
(121, 9, 125, '2019-07-02 03:26:51', '2019-07-02 03:26:51'),
(122, 9, 126, '2019-07-02 03:31:51', '2019-07-02 03:31:51'),
(123, 12, 127, '2019-07-02 03:43:37', '2019-07-02 03:43:37'),
(124, 12, 128, '2019-07-02 03:51:54', '2019-07-02 03:51:54'),
(125, 12, 129, '2019-07-02 03:57:33', '2019-07-02 03:57:33'),
(126, 1, 131, '2019-07-02 05:58:25', '2019-07-02 05:58:25'),
(127, 1, 132, '2019-07-02 05:58:53', '2019-07-02 05:58:53'),
(128, 1, 133, '2019-07-02 05:59:37', '2019-07-02 05:59:37'),
(129, 1, 134, '2019-07-02 05:59:58', '2019-07-02 05:59:58'),
(130, 1, 135, '2019-07-02 06:00:17', '2019-07-02 06:00:17'),
(131, 1, 136, '2019-07-02 06:00:36', '2019-07-02 06:00:36'),
(132, 1, 137, '2019-07-02 06:02:02', '2019-07-02 06:02:02'),
(133, 1, 139, '2019-07-02 06:02:58', '2019-07-02 06:02:58'),
(134, 1, 140, '2019-07-02 06:03:26', '2019-07-02 06:03:26'),
(135, 1, 141, '2019-07-02 06:04:40', '2019-07-02 06:04:40'),
(136, 1, 142, '2019-07-02 06:05:00', '2019-07-02 06:05:00'),
(137, 1, 143, '2019-07-02 06:05:24', '2019-07-02 06:05:24'),
(138, 1, 144, '2019-07-02 06:05:45', '2019-07-02 06:05:45'),
(139, 1, 138, '2019-07-02 21:07:40', '2019-07-02 21:07:40'),
(140, 12, 130, '2019-07-02 21:43:05', '2019-07-02 21:43:05'),
(141, 10, 64, '2019-07-02 23:08:21', '2019-07-02 23:08:21'),
(142, 12, 145, '2019-07-03 22:47:58', '2019-07-03 22:47:58'),
(143, 12, 146, '2019-07-03 23:53:55', '2019-07-03 23:53:55'),
(144, 17, 148, '2019-07-04 03:20:55', '2019-07-04 03:20:55'),
(145, 17, 149, '2019-07-04 03:33:39', '2019-07-04 03:33:39'),
(146, 17, 150, '2019-07-04 03:44:29', '2019-07-04 03:44:29'),
(147, 17, 151, '2019-07-04 03:55:22', '2019-07-04 03:55:22'),
(148, 17, 152, '2019-07-04 04:09:47', '2019-07-04 04:09:47'),
(149, 20, 153, '2019-07-05 21:40:46', '2019-07-05 21:40:46'),
(150, 21, 154, '2019-07-05 21:51:16', '2019-07-05 21:51:16'),
(151, 20, 155, '2019-07-05 21:56:23', '2019-07-05 21:56:23'),
(152, 20, 156, '2019-07-05 22:09:36', '2019-07-05 22:09:36'),
(153, 21, 157, '2019-07-05 22:12:43', '2019-07-05 22:12:43'),
(154, 20, 158, '2019-07-05 22:23:53', '2019-07-05 22:23:53'),
(155, 21, 159, '2019-07-05 22:33:44', '2019-07-05 22:33:44'),
(156, 20, 160, '2019-07-05 22:51:45', '2019-07-05 22:51:45'),
(157, 18, 161, '2019-07-05 22:58:45', '2019-07-05 22:58:45'),
(158, 20, 162, '2019-07-05 23:00:51', '2019-07-05 23:00:51'),
(159, 20, 163, '2019-07-05 23:10:12', '2019-07-05 23:10:12'),
(160, 20, 164, '2019-07-05 23:16:55', '2019-07-05 23:16:55'),
(161, 20, 165, '2019-07-05 23:26:01', '2019-07-05 23:26:01'),
(162, 21, 166, '2019-07-05 23:39:53', '2019-07-05 23:39:53'),
(163, 21, 167, '2019-07-05 23:44:07', '2019-07-05 23:44:07'),
(164, 20, 168, '2019-07-05 23:46:30', '2019-07-05 23:46:30'),
(165, 20, 169, '2019-07-05 23:54:00', '2019-07-05 23:54:00'),
(166, 22, 171, '2019-07-06 00:11:26', '2019-07-06 00:11:26'),
(167, 22, 174, '2019-07-06 00:23:37', '2019-07-06 00:23:37'),
(168, 18, 176, '2019-07-06 00:36:46', '2019-07-06 00:36:46'),
(169, 22, 177, '2019-07-06 00:36:55', '2019-07-06 00:36:55'),
(170, 18, 179, '2019-07-06 00:41:30', '2019-07-06 00:41:30'),
(171, 22, 181, '2019-07-06 00:49:29', '2019-07-06 00:49:29'),
(172, 18, 183, '2019-07-06 00:58:43', '2019-07-06 00:58:43'),
(173, 22, 184, '2019-07-06 01:03:29', '2019-07-06 01:03:29'),
(174, 15, 185, '2019-07-06 02:13:32', '2019-07-06 02:13:32'),
(175, 15, 187, '2019-07-06 02:23:55', '2019-07-06 02:23:55'),
(176, 18, 188, '2019-07-06 02:28:58', '2019-07-06 02:28:58'),
(177, 15, 189, '2019-07-06 02:29:47', '2019-07-06 02:29:47'),
(178, 18, 186, '2019-07-06 02:29:52', '2019-07-06 02:29:52'),
(179, 15, 190, '2019-07-06 02:36:33', '2019-07-06 02:36:33'),
(180, 18, 191, '2019-07-06 02:38:31', '2019-07-06 02:38:31'),
(181, 15, 192, '2019-07-06 02:44:05', '2019-07-06 02:44:05'),
(182, 22, 193, '2019-07-06 02:47:09', '2019-07-06 02:47:09'),
(183, 18, 194, '2019-07-06 02:49:53', '2019-07-06 02:49:53'),
(184, 22, 196, '2019-07-06 02:57:12', '2019-07-06 02:57:12'),
(185, 15, 195, '2019-07-06 02:58:42', '2019-07-06 02:58:42'),
(186, 18, 197, '2019-07-06 03:02:14', '2019-07-06 03:02:14'),
(187, 18, 198, '2019-07-06 03:08:12', '2019-07-06 03:08:12'),
(188, 22, 199, '2019-07-06 03:11:12', '2019-07-06 03:11:12'),
(189, 18, 200, '2019-07-06 03:12:31', '2019-07-06 03:12:31'),
(190, 15, 201, '2019-07-06 03:29:52', '2019-07-06 03:29:52'),
(191, 16, 170, '2019-07-06 03:39:07', '2019-07-06 03:39:07'),
(192, 16, 172, '2019-07-06 04:33:29', '2019-07-06 04:33:29'),
(193, 16, 173, '2019-07-06 04:34:43', '2019-07-06 04:34:43'),
(194, 16, 175, '2019-07-06 04:35:35', '2019-07-06 04:35:35'),
(195, 16, 178, '2019-07-06 04:36:08', '2019-07-06 04:36:08'),
(196, 16, 180, '2019-07-06 04:37:05', '2019-07-06 04:37:05'),
(197, 16, 182, '2019-07-06 04:37:40', '2019-07-06 04:37:40'),
(198, 19, 202, '2019-07-08 03:07:21', '2019-07-08 03:07:21'),
(199, 19, 203, '2019-07-08 03:07:44', '2019-07-08 03:07:44'),
(200, 19, 204, '2019-07-08 03:08:08', '2019-07-08 03:08:08'),
(201, 19, 205, '2019-07-08 03:33:55', '2019-07-08 03:33:55'),
(202, 19, 206, '2019-07-08 03:37:20', '2019-07-08 03:37:20'),
(203, 19, 207, '2019-07-08 03:37:54', '2019-07-08 03:37:54'),
(204, 19, 208, '2019-07-08 03:39:33', '2019-07-08 03:39:33'),
(205, 19, 209, '2019-07-08 03:45:57', '2019-07-08 03:45:57'),
(206, 19, 210, '2019-07-08 03:47:40', '2019-07-08 03:47:40'),
(207, 19, 211, '2019-07-08 03:49:13', '2019-07-08 03:49:13'),
(208, 19, 212, '2019-07-08 03:54:29', '2019-07-08 03:54:29'),
(209, 19, 213, '2019-07-08 03:55:23', '2019-07-08 03:55:23'),
(210, 19, 214, '2019-07-08 04:01:55', '2019-07-08 04:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `section_subject_teachers`
--

CREATE TABLE `section_subject_teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_subject_teachers`
--

INSERT INTO `section_subject_teachers` (`id`, `subject_id`, `teacher_id`, `section_id`, `created_at`, `updated_at`) VALUES
(2, 3, 2, 11, '2019-06-23 22:39:33', '2019-06-23 22:39:33'),
(4, 6, 9, 11, '2019-06-23 23:07:02', '2019-06-23 23:07:02'),
(5, 9, 7, 11, '2019-06-23 23:07:47', '2019-06-23 23:07:47'),
(6, 10, 7, 11, '2019-06-23 23:08:39', '2019-06-23 23:08:39'),
(7, 11, 7, 11, '2019-06-23 23:09:12', '2019-06-23 23:09:12'),
(8, 12, 7, 11, '2019-06-23 23:09:57', '2019-06-23 23:09:57'),
(13, 3, 6, 10, '2019-06-23 23:35:40', '2019-06-23 23:35:40'),
(14, 6, 6, 10, '2019-06-23 23:36:25', '2019-06-23 23:36:25'),
(15, 9, 6, 10, '2019-06-23 23:37:50', '2019-06-23 23:37:50'),
(16, 10, 6, 10, '2019-06-23 23:38:56', '2019-06-23 23:38:56'),
(17, 11, 2, 10, '2019-06-23 23:39:51', '2019-06-23 23:39:51'),
(18, 12, 6, 10, '2019-06-23 23:40:55', '2019-06-23 23:40:55'),
(19, 3, 8, 9, '2019-06-23 23:42:23', '2019-06-23 23:42:23'),
(20, 6, 8, 9, '2019-06-23 23:43:39', '2019-06-23 23:43:39'),
(21, 9, 8, 9, '2019-06-23 23:45:09', '2019-06-23 23:45:09'),
(22, 10, 8, 9, '2019-06-23 23:46:21', '2019-06-23 23:46:21'),
(23, 13, 8, 9, '2019-06-23 23:48:55', '2019-06-23 23:48:55'),
(24, 11, 2, 9, '2019-06-23 23:49:37', '2019-06-23 23:49:37'),
(25, 12, 8, 9, '2019-06-23 23:50:35', '2019-06-23 23:50:35'),
(26, 3, 10, 12, '2019-06-23 23:55:27', '2019-06-23 23:55:27'),
(27, 6, 10, 12, '2019-06-24 00:17:33', '2019-06-24 00:17:33'),
(28, 9, 10, 12, '2019-06-24 00:19:30', '2019-06-24 00:19:30'),
(29, 10, 10, 12, '2019-06-24 00:20:26', '2019-06-24 00:20:26'),
(30, 13, 2, 12, '2019-06-24 00:21:20', '2019-06-24 00:21:20'),
(31, 11, 2, 12, '2019-06-24 00:22:01', '2019-06-24 00:22:01'),
(32, 12, 10, 12, '2019-06-24 00:22:59', '2019-06-24 00:22:59'),
(33, 17, 9, 12, '2019-06-24 00:30:21', '2019-06-24 00:30:21'),
(34, 4, 3, 7, '2019-06-24 02:37:30', '2019-06-24 02:37:30'),
(35, 5, 7, 7, '2019-06-24 02:38:18', '2019-06-24 02:38:18'),
(36, 7, 3, 7, '2019-06-24 02:39:15', '2019-06-24 02:39:15'),
(37, 8, 3, 7, '2019-06-24 02:39:53', '2019-06-24 02:39:53'),
(38, 9, 3, 7, '2019-06-24 02:40:27', '2019-06-24 02:40:27'),
(39, 13, 7, 7, '2019-06-24 02:41:17', '2019-06-24 02:41:17'),
(40, 10, 7, 7, '2019-06-24 02:41:51', '2019-06-24 02:41:51'),
(41, 11, 2, 7, '2019-06-24 02:44:17', '2019-06-24 02:44:17'),
(42, 12, 4, 7, '2019-06-24 02:44:47', '2019-06-24 02:44:47'),
(43, 17, 2, 7, '2019-06-24 02:45:12', '2019-06-24 02:45:12'),
(44, 4, 5, 6, '2019-06-24 03:02:52', '2019-06-24 03:02:52'),
(45, 5, 9, 6, '2019-06-24 03:04:04', '2019-06-24 03:04:04'),
(46, 7, 5, 6, '2019-06-24 03:07:20', '2019-06-24 03:07:20'),
(47, 8, 5, 6, '2019-06-24 03:10:01', '2019-06-24 03:10:01'),
(48, 9, 5, 6, '2019-06-24 03:10:45', '2019-06-24 03:10:45'),
(49, 14, 7, 6, '2019-06-24 03:12:09', '2019-06-24 03:12:09'),
(50, 15, 7, 6, '2019-06-24 03:12:55', '2019-06-24 03:12:55'),
(51, 10, 7, 6, '2019-06-24 03:13:32', '2019-06-24 03:13:32'),
(52, 11, 2, 6, '2019-06-24 04:22:00', '2019-06-24 04:22:00'),
(53, 12, 3, 6, '2019-06-24 04:22:59', '2019-06-24 04:22:59'),
(54, 17, 2, 6, '2019-06-24 04:26:13', '2019-06-24 04:26:13'),
(55, 4, 8, 5, '2019-06-24 04:35:21', '2019-06-24 04:35:21'),
(56, 5, 8, 5, '2019-06-24 04:36:08', '2019-06-24 04:36:08'),
(57, 7, 8, 5, '2019-06-24 04:37:18', '2019-06-24 04:37:18'),
(58, 8, 8, 5, '2019-06-25 03:22:28', '2019-06-25 03:22:28'),
(59, 9, 3, 5, '2019-06-25 03:23:03', '2019-06-25 03:23:03'),
(60, 14, 6, 5, '2019-06-25 03:24:00', '2019-06-25 03:24:00'),
(61, 15, 9, 5, '2019-06-25 03:25:25', '2019-06-25 03:25:25'),
(62, 10, 3, 5, '2019-06-25 03:26:15', '2019-06-25 03:26:15'),
(63, 11, 9, 5, '2019-06-25 03:27:55', '2019-06-25 03:27:55'),
(64, 12, 9, 5, '2019-06-25 03:28:34', '2019-06-25 03:28:34'),
(65, 17, 8, 5, '2019-06-25 03:29:37', '2019-06-25 03:29:37'),
(66, 16, 8, 5, '2019-06-25 03:30:17', '2019-06-25 03:30:17'),
(67, 3, 3, 4, '2019-06-25 03:32:03', '2019-06-25 03:32:03'),
(68, 6, 4, 4, '2019-06-25 03:36:49', '2019-06-25 03:36:49'),
(69, 9, 2, 4, '2019-06-25 03:37:20', '2019-06-25 03:37:20'),
(70, 14, 3, 4, '2019-06-25 03:38:06', '2019-06-25 03:38:06'),
(71, 15, 6, 4, '2019-06-25 03:38:59', '2019-06-25 03:38:59'),
(72, 10, 10, 4, '2019-06-25 03:39:46', '2019-06-25 03:39:46'),
(73, 16, 6, 4, '2019-06-25 03:40:32', '2019-06-25 03:40:32'),
(74, 4, 8, 3, '2019-06-25 03:48:40', '2019-06-25 03:48:40'),
(75, 5, 9, 3, '2019-06-25 03:49:12', '2019-06-25 03:49:12'),
(76, 7, 10, 3, '2019-06-25 03:50:01', '2019-06-25 03:50:01'),
(77, 8, 10, 3, '2019-06-25 03:50:41', '2019-06-25 03:50:41'),
(78, 9, 5, 3, '2019-06-25 03:52:05', '2019-06-25 03:52:05'),
(79, 10, 10, 3, '2019-06-25 03:53:02', '2019-06-25 03:53:02'),
(80, 14, 5, 3, '2019-06-25 03:53:41', '2019-06-25 03:53:41'),
(81, 15, 6, 3, '2019-06-25 03:54:14', '2019-06-25 03:54:14'),
(82, 18, 11, 3, '2019-06-25 04:27:17', '2019-06-25 04:27:17'),
(83, 4, 6, 2, '2019-06-25 04:30:28', '2019-06-25 04:30:28'),
(84, 5, 5, 2, '2019-06-25 04:31:08', '2019-06-25 04:31:08'),
(85, 7, 10, 2, '2019-06-25 04:46:10', '2019-06-25 04:46:10'),
(86, 8, 10, 2, '2019-06-25 04:47:12', '2019-06-25 04:47:12'),
(87, 9, 5, 2, '2019-06-25 04:47:49', '2019-06-25 04:47:49'),
(88, 10, 8, 2, '2019-06-25 05:15:16', '2019-06-25 05:15:16'),
(89, 14, 8, 2, '2019-06-25 05:15:57', '2019-06-25 05:15:57'),
(90, 15, 5, 2, '2019-06-25 05:17:10', '2019-06-25 05:17:10'),
(91, 18, 11, 2, '2019-06-25 05:17:43', '2019-06-25 05:17:43'),
(92, 4, 10, 1, '2019-06-25 05:26:53', '2019-06-25 05:26:53'),
(93, 5, 6, 1, '2019-06-25 05:27:22', '2019-06-25 05:27:22'),
(94, 7, 2, 1, '2019-06-25 05:27:55', '2019-06-25 05:27:55'),
(95, 8, 2, 1, '2019-06-25 05:28:15', '2019-06-25 05:28:15'),
(96, 9, 2, 1, '2019-06-25 05:28:49', '2019-06-25 05:28:49'),
(97, 10, 10, 1, '2019-06-25 05:29:20', '2019-06-25 05:29:20'),
(98, 14, 3, 1, '2019-06-25 05:30:03', '2019-06-25 05:30:03'),
(99, 15, 3, 1, '2019-06-25 05:30:38', '2019-06-25 05:30:38'),
(100, 18, 12, 1, '2019-06-25 05:31:07', '2019-06-25 05:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `section_wise_fees`
--

CREATE TABLE `section_wise_fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `session_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `fees_type_id` int(10) UNSIGNED NOT NULL,
  `business_month_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_wise_fees`
--

INSERT INTO `section_wise_fees` (`id`, `user_id`, `session_id`, `section_id`, `fees_type_id`, `business_month_id`, `amount`, `created_at`, `updated_at`) VALUES
(5, 1, 4, 12, 1, 2, '100.00', '2019-08-03 04:46:53', '2019-08-03 04:46:53'),
(6, 1, 3, 9, 4, 16, '50.00', '2019-08-03 04:47:15', '2019-08-03 04:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `selected_ids`
--

CREATE TABLE `selected_ids` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_subject_result_id` int(10) UNSIGNED NOT NULL,
  `term_result_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_from` date NOT NULL,
  `ends_to` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `starts_from`, `ends_to`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Khilbari 2019 Lotus', '2019-01-03', '2019-12-22', NULL, '2019-06-12 04:05:04', '2019-07-03 04:23:41'),
(4, 'Vatara 2019 Rose', '2019-01-03', '2019-12-22', NULL, '2019-06-12 04:06:54', '2019-07-03 04:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_id` int(10) UNSIGNED NOT NULL,
  `shift_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `branch_id`, `shift_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Morning Shift Vatara', NULL, '2019-06-12 04:31:15', '2019-06-12 04:31:15'),
(2, 1, 'Day Shift Vatara', NULL, '2019-06-12 04:33:38', '2019-06-12 04:33:38'),
(3, 2, 'Morning Shift Khilbari', NULL, '2019-06-12 04:36:07', '2019-06-12 04:36:07'),
(4, 2, 'Day Shift Khilbari', NULL, '2019-06-12 04:36:40', '2019-06-12 04:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roll_no` int(11) NOT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `admission_date` date NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_cell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_cell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_photo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll_no`, `fathers_name`, `mothers_name`, `date_of_birth`, `admission_date`, `nationality`, `religion`, `gender`, `present_address`, `permanent_address`, `mothers_cell`, `contact_no`, `fathers_cell`, `student_photo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Afroza Naznin Prity', 1, 'Abdul Aziz Shah', 'Hosneara Khatun', '2007-11-15', '2019-01-02', 'Bangladeshi', 'Islam', 'Female', 'Vatara, Dhaka', 'Razshahi', NULL, '01615395544', NULL, 'public/img/2019-06-26Afroza Naznin Prity.JPG', NULL, '2019-06-25 23:51:23', '2019-06-25 23:51:23'),
(4, 'Mimi Tripura', 1, 'Bahaduram', 'Dorothi', '2006-12-23', '2019-01-12', 'Bangladeshi', 'Christian', 'Female', 'H# 1, B# A, Ward-2, R#A, P.O:Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Durnidoi, P.O:Rohangdhori, P.S: Bandarban, Dist: Bandarban', '01737304468', '01706627137', '01706627137', 'public/img/2019-06-26Mimi Tripura.JPG', NULL, '2019-06-25 23:52:10', '2019-06-25 23:52:10'),
(5, 'Premelika Tripura', 2, 'Jotindra Tripura', 'Ganerung Tripura', '2007-01-01', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, Ward-2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Pukur Para, P.O: Ruma, P.S: Ruma, Dist: Bandarban', NULL, '01706627922', '01865024215', 'public/img/2019-06-26Premilika Tripura.JPG', NULL, '2019-06-26 00:08:28', '2019-06-26 00:08:28'),
(6, 'Mohasheta Joydhar', 1, 'Manindra Nath Joydhar', 'Mitu Halder', '2013-12-12', '2019-01-06', 'Bangladeshi', 'Hindu', 'Female', 'House# 25, Flat# 2 North, Road # 03, East Noyanagor, Vatara, Dhaka-1212.', 'Baromagra, Jobarpar, Agiljhara, Barishal', '01747697626', '01747697626', '01911908149', 'public/img/2019-06-26Mohasheta Joydhar.JPG', NULL, '2019-06-26 00:25:29', '2019-06-26 00:25:29'),
(7, 'Samia Akter', 3, 'Md. Samim Hossain', 'Tahmina Begum', '2007-10-28', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'Samiruddin Market, Vatara, Dhaka-1212', 'Vill: Sahebnagar, P.O: Choynabad, P.S: Bancharampur, Dist: Brahmanbaria', '01772157079', '01749285455', '01749285455', 'public/img/2019-06-26Samia Akter.JPG', NULL, '2019-06-26 00:34:58', '2019-06-26 00:34:58'),
(8, 'Sanget Kumar Sarker', 1, 'Mr. Sanjoy Kumar Sarker', 'Doli Rani', '2011-05-02', '2019-01-03', 'Bangladeshi', 'Hindu', 'Male', 'Vatara Dhaka 1212', 'Hutkhile, Hutkhile , Sojanogor, Pabna', '01728918547', '01728918547', '01728699761', 'public/img/2019-06-26Sangeet Kumar Sarker.JPG', NULL, '2019-06-26 00:35:42', '2019-07-02 00:41:05'),
(9, 'Ajit Chondro Roy', 2, 'Roton Chondro Roy', 'Putul Rani', '2012-05-12', '2019-01-03', 'Bangladeshi', 'Muslim', 'Male', 'Vatata Road, Vatara, Dhaka-1212', 'Shankarpur, Biral, Biral, Dinajpur.', NULL, '01759387798', NULL, 'public/img/2019-06-26Ajit Chandra Roy.JPG', NULL, '2019-06-26 00:38:48', '2019-06-26 00:38:48'),
(10, 'Sharnele Falia', 2, 'Mr. Shawpon K. Folia', 'Bulu Sarker', '2010-06-10', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', '12/4 West Vatara, Natun Bazar, Gulshan-2, Dhaka 1212', 'Lakhirpar , Radhaganj, Kotalipara, Gopalganj', '01930089577', '01930089577', '0168730397', 'public/img/2019-06-26Sharnil Folia.JPG', NULL, '2019-06-26 00:46:15', '2019-06-26 00:46:15'),
(11, 'Zahid Islam Towhid', 3, 'Md Ibrahim Hossain', 'Josna', '2013-05-23', '2019-01-03', 'Bangladeshi', 'Muslim', 'Male', 'South Nayanagar 720, Road# 2, House # 9, Dhaka -1212', 'Kaliartec, Nishatnagar, Turag, Dhaka', NULL, '01683655685', '01683387551', 'public/img/2019-06-26Zihad Islam Towhid.JPG', NULL, '2019-06-26 00:48:03', '2019-06-26 00:48:03'),
(12, 'Anika Tripura', 3, 'Mr. Anil Tripura', 'Hameli', '2008-01-05', '2019-01-02', 'Bangladeshi', 'Christian', 'Female', 'House 1, Block A , Ward 40, vatara Dhaka 1212', 'Satish para, Lama, Lama Bandorban', '01737304468', '01865024215', '01737304468', 'public/img/2019-06-26Anika Tripura.JPG', NULL, '2019-06-26 00:53:08', '2019-07-02 00:49:02'),
(13, 'Sapoyon Siddiki', 7, 'Abu Bakkor', 'Shahinur Akter', '2013-05-13', '2019-01-02', 'Bangladeshi', 'Muslim', 'Male', 'House# 31, Block # A, Wazuddin Road, Vatara, Dhaka', 'Holidhani, Holidhani, Jhinaidaho, Jhinaidaho.', NULL, '01987841203', '01926153414', 'public/img/2019-06-26Sapoyon Siddiki.JPG', NULL, '2019-06-26 00:57:42', '2019-06-26 00:57:42'),
(14, 'Sujana Akter', 5, 'Sujon Miah', 'Nasima Akter', '2006-03-18', '2019-01-07', 'Bangladeshi', 'Islam', 'Female', 'Nurerchala,100 fit, Vatara, Dhaka.', 'Vill: Itna, P.O: Itna, P.S: Lohagara, Dist: Narail', '01992056255', '01872771782', '01872771782', 'public/img/2019-06-26Sujana Akter.JPG', NULL, '2019-06-26 01:08:15', '2019-06-26 01:08:15'),
(15, 'Abir Ahamed Evaan', 4, 'Md. Anower Hossain', 'Fatema', '2009-09-03', '2019-01-04', 'Bangladeshi', 'Islam', 'Male', 'Fasher Tak, Vatara Dhaka 1212', 'Fasher Tak, Vatara Dhaka 1212', '01756153486', '01756153486', '01756153486', 'public/img/2019-06-26Abir Ahamed Evaan.JPG', NULL, '2019-06-26 02:36:17', '2019-06-26 02:48:51'),
(16, 'Sheuli Tripura', 4, 'Bataowha Tripura', 'Harmaeti', '2009-04-01', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, Road-4, P.O: Gulshan, P.S: Vatara, Dhaka-1212.', 'Vill: Manikjon, P.O: Lama, P.S: Lama, Dist: Bandarban', '01737304468', '01833296152', '01833296152', 'public/img/2019-06-26Sheuli Tripura.JPG', NULL, '2019-06-26 02:36:32', '2019-06-26 02:36:32'),
(17, 'Afsara Adiba Chaity', 5, 'Md. Al-Amin', 'Champa', '2010-07-12', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'Vatara Gulshan Dhaka 1212', 'Aklaspur, Aklaspur, Motlob Uttur , Chatpur', '01906320161', '01912742644', '01912742644', 'public/img/2019-06-26Afsara Adiba Chaity.JPG', NULL, '2019-06-26 02:40:15', '2019-06-26 02:47:16'),
(18, 'Khuku Moni', 6, 'Md. Khokon Mia', 'Hamufa Begum', '2009-12-12', '2019-01-11', 'Bangladeshi', 'Islam', 'Female', 'Vatara, Gulshan 2, Dhaka 1212', 'Doribelanogor,  Choifullah, Kandi,   Bancharampur, B-Bariya,', '01631950571', '01631950571', '01631950571', 'public/img/2019-06-26Khuku Moni.JPG', NULL, '2019-06-26 02:55:57', '2019-06-26 02:55:57'),
(19, 'Dosinu', 3, 'Mong Changla', 'Menusing', '2006-10-27', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A,W#2, R# 4, P.O:Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Baispari, P.O: Lama, P.S: Lama, Dist: Bandarban', '01737304468', '01852452795', '01852452795', 'public/img/2019-06-26Dosinu Marma.JPG', NULL, '2019-06-26 03:21:25', '2019-06-26 03:21:25'),
(20, 'Md. Abdullah', 6, 'Raihan Mia', 'Rahima Begum', '2013-07-10', '2019-01-08', 'Bangladeshi', 'Muslim', 'Male', 'East Nurerchala, Vatara, Dhaka- 1212', 'Bancharampur, Bramanbaria', NULL, '01683815745', NULL, 'public/img/2019-06-26Abdullah.JPG', NULL, '2019-06-26 03:32:43', '2019-06-26 03:32:43'),
(21, 'Jasmin Tripura', 5, 'Mijoram Tripura', 'Maloti Tripura', '2001-05-02', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Phopachori, P.O: Bikrompur, P.S: Chondonice para, Dist: Chittagong', '01737304468', '01737304468', '01737304468', 'public/img/2019-06-26Jasmin Tripura.JPG', NULL, '2019-06-26 03:43:14', '2019-06-26 03:43:14'),
(24, 'Yeasin Islam Tahomid', 10, 'Nasir Uddin', 'Taslima Begum', '2013-01-14', '2019-01-07', 'Bangladeshi', 'Muslim', 'Male', 'Nurerchala Vatara, Dhaka', 'Mitpur, Soinabaz, Bansarampur, Brahmanbaria', NULL, '01902979683', NULL, 'public/img/2019-06-26Yeasin Islam Tahomid.JPG', NULL, '2019-06-26 03:49:11', '2019-06-26 03:49:11'),
(27, 'Sheuli Tripura', 7, 'Mr. Joy Chandra', 'Hanarung', '2007-08-24', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'House 1 , Block A , Ward 40. Vatara Dhaka 1212', 'Lemojery, Chandonise, Bandorban', '01737304468', '01865024215', '01865024215', 'public/img/2019-06-26Sheuli Tripura 1.JPG', NULL, '2019-06-26 03:57:38', '2019-07-02 02:37:20'),
(28, 'Motherung Tripura', 7, 'Bir Mohon Tripura', 'Mariha Tripura', '2006-08-08', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshsan, P.S: Vatara, Dhaka-1212', 'Vill: Satichandro Para, P.O: Thanchi, P.S: Thanchi, Dist : Bandharban', '01737304468', '01737304468', '01737304468', 'public/img/2019-06-26Motheerung Tripura.JPG', NULL, '2019-06-26 04:06:59', '2019-06-26 04:07:31'),
(29, 'Eamati Tripura', 8, 'Kharindro', 'Naronti', '2007-04-06', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Kistopara, P.O: Rajasthali, P.S: Rajasthali, Dist: Bandarban', '01737304468', '01737304468', '01737304468', 'public/img/2019-06-26Emati Tripura.JPG', NULL, '2019-06-26 04:16:28', '2019-06-26 04:17:13'),
(30, 'Prohalika', 9, 'Dinobondhu', 'Mary', '2008-02-12', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212.', 'Vill: Satish, P.O: Lama, P.S: Lama, Dist: Bandharban.', '01737304468', '01849922412', '01849922412', 'public/img/2019-06-26Prohelika Tripura.JPG', NULL, '2019-06-26 04:23:25', '2019-06-26 04:23:25'),
(31, 'Veronika  Tripura', 11, 'Adhi Chandra', 'Hajaru', '2007-03-12', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212.', 'Vill: Mungohapara, P.O: Roma, P.S: Roma, Dist: Bandarban.', '01737304468', '01737304468', '01737304468', 'public/img/2019-06-26Veronica Tripura.JPG', NULL, '2019-06-26 04:29:30', '2019-06-26 04:29:53'),
(32, 'Nusrat Jahan', 8, 'Md. Nurazzaman Mia', 'Mohasina', '2010-10-02', '2019-01-14', 'Bangladeshi', 'Islam', 'Female', 'House 4, Road 4, Vatara, Dhaka 1212', 'Mohisasur, Gajaghnta, Gangachra, Rangpur', '01960868766', '01749654668', '01749654668', 'public/img/2019-06-26Nusrat Jahan.JPG', NULL, '2019-06-26 04:34:49', '2019-06-26 04:34:49'),
(33, 'Mongbati Tripura', 12, 'Ongsha Tripura', 'Shongkhilipi Tripura', '2007-12-23', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212.', 'Vill: Kistopara, P.O: Rajasthali, P.S: Rajasthali, Dist: Bandarban.', '01737304468', '01737304468', '01737304468', 'public/img/2019-06-26Mongbati Tripura.JPG', NULL, '2019-06-26 04:37:50', '2019-06-26 04:38:18'),
(34, 'Rakhel Rehana', 13, 'Birbahu Tripura', 'Tulabi Tripura', '2005-12-05', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212.', 'Vill: Dhopachori para, P.O: Bikrompur, P.S: Chandonice, Dist: Chittagong.', '01737304468', '01777750956', '01777750956', 'public/img/2019-06-26Rakhel Rahana Tripura.JPG', NULL, '2019-06-26 04:48:55', '2019-06-26 04:48:55'),
(35, 'Agnesh Tripura', 14, 'Johon Tripura', 'Lokkhima Tripura', '2007-03-28', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Satish Para, P.O: Lama, P.S: Lama, Dist: Bandarban', '01866020957', '01737304468', '01737304468', 'public/img/2019-06-26Agnesh tripura.JPG', NULL, '2019-06-26 05:00:19', '2019-06-26 05:00:38'),
(36, 'Happy Tripura', 17, 'Satish Tripura', 'Parboti Tripura', '2009-11-03', '2019-01-13', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Manikjon para, P.O:Lama, P.S: Lama, Dist: Bandarban', '01737304468', '01835269532', '01835269532', 'public/img/2019-06-26Happy Tripura.JPG', NULL, '2019-06-26 05:10:25', '2019-06-26 05:10:25'),
(37, 'Ifrat Jahan Mahiya', 9, 'Md. Nurul Islam', 'Muslima', '2009-02-05', '2019-01-18', 'Bangladeshi', 'Islam', 'Female', 'House 36, Road 2, ward 4, Block B \r\nSouth Nayanagar, Vatara, Dhaka1212', 'House 36, Road 2, ward 4, Block B \r\nSouth Nayanagar, Vatara, Dhaka1212', '01685093736', '01685093736', '01685093736', 'public/img/2019-06-26Ifrat Jahan Mahiya.JPG', NULL, '2019-06-26 05:25:30', '2019-06-26 05:25:30'),
(38, 'Mahamud Hassan', 11, 'Md. Chunnu Talukdar', 'Momtaj', '2011-05-11', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'House 4, Road 4, Vatara, Badda, Dhaka', 'Muradia, Muradia, Dumki , Patuakhali', '01633060221', '01633060221', '01633060221', 'public/img/2019-06-27Mahamud Hasan.JPG', NULL, '2019-06-26 22:14:19', '2019-06-26 22:14:19'),
(39, 'Jannat Akter', 12, 'Md. Omar Farque', 'Sufia Akter', '2009-06-03', '2019-01-17', 'Bangladeshi', 'Islam', 'Female', 'House 31, Block A, Owazuddin road, vatara, Dhaka', 'Beoline, Adda Bazar Borura Comilla', '01926153414', '01926153414', '01987841203', 'public/img/2019-06-27Jannat Akter.JPG', NULL, '2019-06-26 22:25:35', '2019-06-26 22:25:35'),
(40, 'Araf Hossain Golpo', 13, 'Md. Moinul Hossain', 'Laboni Akter', '2010-02-21', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01977917777', '01977917777', '01977917777', 'public/img/2019-06-27Araf Hossain Galpo.JPG', NULL, '2019-06-26 23:03:15', '2019-06-26 23:03:15'),
(41, 'Zinia Kisku', 15, 'Mr. James Kisku', 'Aroti Soren', '2010-03-19', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'A', 'B', '01865024215', '01865024215', '01865024215', 'public/img/2019-06-27Zinia Kisku 111.JPG', NULL, '2019-06-26 23:21:56', '2019-06-26 23:22:23'),
(42, 'Rakibul Islam Sabbir', 16, 'Md. Edris Ali', 'Rina Begum', '2010-12-04', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01933061446', '01933061446', '01933061446', 'public/img/2019-06-27Rakibul Islam Sabbir.JPG', NULL, '2019-06-26 23:38:05', '2019-06-26 23:38:05'),
(43, 'Shayan Siddiki', 10, 'Md. Abu Bakor', 'Shahinur Akter', '2009-03-13', '2009-03-13', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01987841203', '01987841203', '01987841203', 'public/img/2019-06-27Abi.JPG', NULL, '2019-06-27 00:27:39', '2019-06-27 00:28:06'),
(44, 'Apon Rozario', 1, 'Mr. Sohel Rozario', 'Jolly Corraya', '2013-09-18', '2019-01-17', 'Bangladeshi', 'Christian', 'Male', 'House 4/A , Shanto nir,  School road, Nurerchala', 'Goalbaria, Mothurapur, Chatmohor \r\nPabna', '01721497584', '01721497584', '01721497584', 'public/img/2019-06-27Apon Rozario.JPG', NULL, '2019-06-27 00:44:44', '2019-06-27 02:29:09'),
(45, 'Alifa Akter', 2, 'Md.  Alamgir Hossain', 'Sunayia Akter', '2014-01-31', '2019-01-03', 'Bangladeshi', 'Islam', 'Female', 'Khane Khadai Road, Vatara, Badda, Dhaka 1212', 'Kuschiachor, Malechi, Horerampur, Manikjang', '01832189798', '01832189798', '01832189798', 'public/img/2019-06-27Alifa Akter.JPG', NULL, '2019-06-27 02:34:12', '2019-06-27 02:34:12'),
(46, 'Othai Talukder', 6, 'Donald Talukder', 'Shilpi Talukder', '2009-06-10', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', 'H#01, R#4, W#40, Dhaka-1212', 'Vill: Koligram, P.O: Jolilpar, P.S: Muksatpur, Dist: Gopalgonj', '01776520965', '01776520965', '01776520965', 'public/img/2019-06-27Othai Talukder.JPG', NULL, '2019-06-27 02:34:54', '2019-07-01 22:42:09'),
(47, 'Morsalin Islam', 3, 'Md. Zia', 'Shahi', '2014-02-03', '2019-01-07', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01916332894', '01916332894', '01916332894', 'public/img/2019-06-27Morsalin Islam.JPG', NULL, '2019-06-27 02:38:04', '2019-06-27 02:38:04'),
(48, 'Srabonti Mridha', 8, 'Md. Abul Kalam', 'Liza Begum', '2007-07-12', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'H#28, W#2, R#4, P.O: Vatara, Dhaka-1212', 'Vill: Anggar para, P.o: Ayla, P.S: Barguna, Dist: Barisal', '01980337319', '01980337319', '01980337319', 'public/img/2019-06-27Srabonti Mridha.JPG', NULL, '2019-06-27 02:38:59', '2019-06-30 00:40:26'),
(49, 'Md. Samiul Basir', 4, 'Md. Habibur Rahman', 'Lovely Khatun', '2013-05-15', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'Khane Khadai  Road , Vatara, Badda, Dhaka 1212', 'Mirar para, Kachihara, Gandail, Sirajganj', '01753081314', '01753081314', '01753081314', 'public/img/2019-06-27Md. Samiul Basir.JPG', NULL, '2019-06-27 02:51:48', '2019-06-27 02:51:48'),
(50, 'Shapna Tripura', 1, 'Debashish', 'Maloti', '2006-10-20', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Anondo Para, P.O: Ruma, P.S: Ruma, Dist: Bandarban', '01737304468', '01884141201', '01884141201', 'public/img/2019-06-29Shapna Tripura.JPG', NULL, '2019-06-29 03:01:34', '2019-06-30 03:36:07'),
(51, 'Akash Sikder', 2, 'Md. Kislu Sikder', 'Amena Akter', '2005-11-28', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Baridara J-Block, Dhaka-1212', 'Vill: Purbo Patikel, P.O: Bashkati, P.S: Pirojpur, Dist: Borisal', '01731808615', '01731808615', '01718311921', 'public/img/2019-06-29Akash Sikder.JPG', NULL, '2019-06-29 03:07:07', '2019-06-30 03:32:36'),
(52, 'Mitali Tripura', 4, 'Benadikt Tripura', 'Nobawrung', '2007-01-10', '2019-01-13', 'Bangladeshi', 'Christian', 'Female', 'Notun Bazar, Vatara, Dhaka-1212', 'Vill: Bashiram, P.O: Ruma, P.S: Ruma, Dist: Bandarban', '01585287216', '01585287216', '01585287216', 'public/img/2019-06-29Mitali Tripura.JPG', NULL, '2019-06-29 03:12:59', '2019-06-30 03:29:17'),
(53, 'Smrity Tripura', 6, 'Saitomanik Tripura', 'Sebati Tripura', '2006-09-19', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#1, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Sabijon, P.O: Lama P.S: Lama Dist: Bandorban', '01737304468', '01855058327', '01855058327', 'public/img/2019-06-29Smrity Tripura.JPG', NULL, '2019-06-29 03:19:50', '2019-06-30 03:14:28'),
(54, 'Trina Halder', 10, 'Swapon Halder', 'Parul', '2006-05-27', '2019-01-13', 'Bangladeshi', 'Christian', 'Female', 'Notun Bazar, Vatara, Dhaka-1212', 'Vill: Gopalgaonj, P.O: Kotalipara Burabari, P.S: Kotalipara, Dist: Gopalgaonj', '01400376130', '01937565777', '01937565777', 'public/img/2019-06-29Trina Halder.JPG', NULL, '2019-06-29 04:53:06', '2019-06-30 03:23:55'),
(55, 'Md. Arafat Hussain', 15, 'Md. Romjan Ali', 'Sathi', '2004-11-04', '2015-01-08', 'Bangladeshi', 'Islam', 'Male', 'W#2, R#8, Vatara, Dhaka-1212', 'Vill: Paskata, P.O: Paskata Bazar, P.S: Kolmakanda, Dista; Netrokona.', '01922189307', '01935683674', '01922189307', 'public/img/2019-06-29Md. Arafat Hussain.JPG', NULL, '2019-06-29 04:58:45', '2019-07-01 23:07:53'),
(56, 'Sakib Khan', 16, 'Md. Basir Mia', 'Lucky Begum', '2006-10-26', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Nurerchala, Vatara, Dhaka-1212', 'Vill: Satbila, P.O: Bancharampur, P.S: Cholimabad, Dist: Bramanbaria', '01793234022', '01992656255', '01992656255', 'public/img/2019-06-29Sakib Khan.JPG', NULL, '2019-06-29 05:04:12', '2019-06-30 03:18:01'),
(57, 'Ismail Hossain Siam', 5, 'Md. Bellaa Hossain', 'Nur Nahar', '2013-12-04', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01821936900', '01821936900', '01821936900', 'public/img/2019-06-30Ismail Islam Siam.JPG', NULL, '2019-06-29 22:00:55', '2019-06-29 22:00:55'),
(58, 'Md. Suraem Sabid', 6, 'Md. Al Mamun', 'Suma Akter', '2013-07-08', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01680288610', '01680288610', '01680288610', 'public/img/2019-06-30Md. Suraem Sabid.JPG', NULL, '2019-06-29 22:08:31', '2019-06-29 22:08:31'),
(59, 'Raha Moni', 7, 'Md. Mamun Islam', 'Lucky Akter', '2014-12-23', '2019-01-18', 'Bangladeshi', 'Islam', 'Female', 'House 13, Vatara Khane Khodai road 1294', 'B', '01703655532', '01703655532', '01703655532', 'public/img/2019-06-30Raha Moni.JPG', NULL, '2019-06-29 22:25:40', '2019-06-29 22:25:40'),
(60, 'Rabia Akter Mim', 8, 'Md. Abdur Rahman', 'Rokiya Akter', '2014-01-01', '2019-01-07', 'Bangladeshi', 'Islam', 'Female', 'Samiruddin Market, Notunbazar, Dhaka-1212', 'Shampur, Bishampur, Kolmakanda, Netrokono', '01986300197', '01986300197', '01986300197', 'public/img/2019-06-30Rabia Boshri Mim.JPG', NULL, '2019-06-29 22:40:04', '2019-06-29 22:40:04'),
(61, 'Ayan Hossain Kabba', 9, 'Md. Moinul Hossain', 'Laboni Akter', '2013-02-21', '2019-01-16', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01977917777', '01977917777', '01977917777', 'public/img/2019-06-30Ayan Hossain Kabba.JPG', NULL, '2019-06-29 22:50:03', '2019-06-29 22:50:19'),
(62, 'Shifa Islam', 10, 'Md. Samiul Islam', 'Lamia Akter', '2013-09-09', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'A', 'B', '01641510480', '01641510480', '01641510480', 'public/img/2019-06-30Shifa Islam.JPG', NULL, '2019-06-29 22:55:32', '2019-06-29 22:55:32'),
(63, 'Muztahid Islam Nazeef', 11, 'Md. Nazrul Islam', 'Mun Mun Islam', '2013-12-04', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', '1206 Madani  Avenue, Notun Bazar,', 'Gopalpur, Chandai, Sherpur, Bogura', '01552335439', '01715566730', '01924616080', 'public/img/2019-06-30Muztahid Islam Nazeef.JPG', NULL, '2019-06-29 23:06:15', '2019-06-29 23:17:56'),
(64, 'Abid Al Hasan Noman', 12, 'Md. Ashraful Alam', 'Ruma Begum', '2013-12-26', '2019-01-21', 'Bangladeshi', 'Islam', 'Male', 'Solmaid , Dhalibari, Vatara, Dhaka 1229', 'Karitola, Kutubpur , Sharikandi , Bogra', '01767839366', '01916644053', '01757487805', 'public/img/2019-07-03Abid Al Hasan Noman.jpg', NULL, '2019-06-29 23:26:35', '2019-07-02 23:27:32'),
(65, 'Al Zian Islam Sahil', 1, 'Md. Monir Hossen', 'Sabia Akther', '2012-10-05', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'House  no 23, Road no 2, Baridhara, Notun Bazar', 'House  no 23, Road no 2, Baridhara, Notun Bazar', '01777080455', '01681961531', '01681961531', 'public/img/2019-06-30Al Zian Islam Sahil.JPG', NULL, '2019-06-30 00:06:49', '2019-06-30 00:06:49'),
(66, 'Sanchita Halder', 1, 'Sajib Halder', 'Dipali Halder', '2009-03-30', '2019-01-14', 'Bangladeshi', 'Christian', 'Female', 'H#4, R#Wajuddin Road, P.O: Vatara, P.S: Vatara, Dhaka-1212', 'Vill: Latangga, P.O: Vangar hat, Dist: Gopalgaonj', '01712526492', '01742381136', '01742381136', 'public/img/2019-06-30Sanchita Halder.JPG', NULL, '2019-06-30 00:08:39', '2019-06-30 00:10:37'),
(67, 'Mim Akter', 2, 'Md. Mitu', 'Nargis Begum', '2011-10-25', '2019-01-24', 'Bangladeshi', 'Islam', 'Female', 'Vatara', 'Ananpur, Nanapur, Ajmeriganj, Kishorgonj', '01760230275', '01760230275', '01869534161', 'public/img/2019-06-30Mim Akter.JPG', NULL, '2019-06-30 00:19:48', '2019-06-30 00:19:48'),
(68, 'Samiul Akram', 3, 'Md. Akram Hossain', 'Shahin', '2011-04-06', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'House , Road 48, Ward 18, dhaka 1212', 'Tiket, Kuripara , Thanpur, Jessour', '01772298541', '01772298541', '01772298541', 'public/img/2019-06-30Samiul Akram.JPG', NULL, '2019-06-30 00:28:34', '2019-07-02 00:16:44'),
(69, 'Shresto Halder', 12, 'Wilson Mintu Halder', 'Rinku Biswas', '2015-10-10', '2019-01-03', 'Bangladeshi', 'Christian', 'Male', 'H# 14, R# 3, B# B, East Nayanagor, Vatara, Dhaka.', 'Kanainagor, Chila, Mongla, Bagerhat.', NULL, '01944440301', '01762550154', 'public/img/2019-06-30Shresto Haldar.JPG', NULL, '2019-06-30 03:12:44', '2019-06-30 03:12:44'),
(70, 'Rafi Islam Abir', 4, 'Md Al Amin', 'Champa', '2012-11-20', '2019-01-08', 'Bangladeshi', 'Christian', 'Male', 'H#31/A, R# 7, W# 40, Dhaka1212', 'Aklaspur, Aklashpur, Motlabuttur, Chadpur.', NULL, '01625281628', '01912742644', 'public/img/2019-06-30Abir.JPG', NULL, '2019-06-30 03:44:20', '2019-06-30 03:44:20'),
(71, 'Farzana Akter Munni', 8, 'Md. Farhad', 'Nazma', '2013-03-07', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'R#4, W# 40, Dhaka-1212', 'Purbolokhi, Maizdi, Maizdi, Maizdi', NULL, '01928271090', '01980302067', 'public/img/2019-06-30Farzana Akter Munni.JPG', NULL, '2019-06-30 03:57:51', '2019-06-30 03:57:51'),
(72, 'Israt Jahan Mihi', 9, 'Md Mofazzal Islam', 'Fazilatunesa', '2013-09-20', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'H# 1295, R# Khanekhodi, W#40, Dhaka 1212.', 'Kasimnagor, Daspara, Ramjong, Lokhipur', NULL, '01766913731', NULL, 'public/img/2019-06-30Israt Jahan Mihi.JPG', NULL, '2019-06-30 04:06:35', '2019-06-30 04:06:35'),
(73, 'Alifa Akter Urmi', 18, 'Md. Ashraful Alom', 'Ruma Begum', '2007-08-25', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'W#40, Chapra Mosjid, Dhaka-1212', 'Vill: Koritola, P.O: Kutupur, P.S: Saria Kandi, Dist: Bagra', '01757487805', '01757487805', '01916644053', 'public/img/2019-06-30Alifa Akter Urmi.JPG', NULL, '2019-06-30 04:24:06', '2019-07-01 23:11:15'),
(74, 'Afroza Aziz Roshne', 7, 'Abdul Aziz', 'Nusrat', '2007-03-08', '2019-01-13', 'Bangladeshi', 'Islam', 'Female', 'H#10, R#4, W#2, Vatara, Dhaka-1212', 'Vill: Sonapur, P.O: Soder, P.S:  Sonapur, Dist: Noksaly', '01924915023', '01933352023', '01933352023', 'public/img/2019-06-30Afroza Aziz Roshni.JPG', NULL, '2019-06-30 04:31:41', '2019-06-30 04:33:20'),
(75, 'Bless Joy Baroi', 9, 'Bivash Baroi', 'Sumi Modhu', '2008-07-24', '2019-01-15', 'Bangladeshi', 'Christian', 'Male', 'Delowar Monjil, Khane-e-Khodai road, Vatara, Dhaka-1212', 'Vill: Satla, P.O: Satla, P.S: Ujirpur, Dist: Barishal.', '01733218551', '01733218551', '01733218551', 'public/img/2019-06-30Bless Joy.JPG', NULL, '2019-06-30 04:39:37', '2019-07-01 04:28:56'),
(76, 'Md. Sifat Hossain', 5, 'Md. Billal Hossain', 'Shila Akter', '2010-01-27', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Ward 4, Vatara , Dhaka 1216', 'Village: Bishnupur, PO :Gonga, PS :Debidwar\r\nDistrict :Comilla', '0170146755', '01915907266', '01915907266', 'public/img/2019-06-30Md. Sifat Hossain.JPG', NULL, '2019-06-30 04:59:35', '2019-06-30 04:59:35'),
(77, 'Sumaiya Akter Bristy', 2, 'Adv. Belal Hossain', 'Nazma Akter', '2008-11-11', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'H# 48, R#4, W#2, Khane Khodai Road, West Vatara, Dhaka-1212', 'Vill: Chithulia, P.O: Gusaibari, P.S: Dhonut, Dist: Bogra', '01914708485', '01911712580', '01911712580', 'public/img/2019-06-30Sumaiya Akter Bisty.JPG', NULL, '2019-06-30 05:05:56', '2019-06-30 05:05:56'),
(78, 'Sakib Al Hasan', 3, 'Alomgir Hossain', 'Rohima Akter', '2010-03-16', '2019-01-02', 'Bangladeshi', 'Christian', 'Male', 'H#6, B# A, R# 4, W#2 Dhaka-1212', 'Fatehpur, Sofulakandhi,B. Baria', NULL, '01742505071', '01718434327', 'public/img/2019-06-30Sakib Al Hasan.JPG', NULL, '2019-06-30 05:18:18', '2019-06-30 05:18:18'),
(79, 'Hastima Tripura', 3, 'Shigram', 'Martha', '2008-07-05', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Gajon, P.O: Lama, P.S: Lama, Dist: Bandarban', '01737304468', '01865024215', '01865024215', 'public/img/2019-06-30Hastima Tripura.JPG', NULL, '2019-06-30 05:38:57', '2019-06-30 05:39:25'),
(81, 'Md. Abrar Tanjim', 4, 'Md. Uzzal Mia', 'Beauty', '2011-03-17', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Noyanagar, Notun Bazar, Gulshan -2, Road 4, Ward, 48', 'Bowla, Fulpur, Maymenshing', '01920277669', '01914582213', '01914582213', 'public/img/2019-07-01Abrar Tanjim.JPG', NULL, '2019-06-30 22:27:14', '2019-07-02 00:14:03'),
(82, 'Elivis Halder', 5, 'Mr. Elious Halder', 'Monika', '2011-10-31', '2019-01-08', 'Bangladeshi', 'Christian', 'Male', 'House 12, Road 4, ward 45, vatara Dhaka 1212', 'Nolchira , Kandopasha, Gornodi, Barisal', '01777492877', '01793534409', '01777492877', 'public/img/2019-07-01Elivis Halder.JPG', NULL, '2019-06-30 22:31:15', '2019-07-02 00:08:12'),
(83, 'Md. Hasib All Gofur Himel', 6, 'Md. Mottasim Billh', 'Halima Begum', '2010-07-30', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', '1295 Wazuddin  Road Vatara, ward 2, Road 4, Vatara , Dhaka 1212', 'Vaznirkhamar, Tulshighat, Gaibandha ,', '01715800984', '01911450082', '01712585998', 'public/img/2019-07-01Md. Hasib Al Gofur Himel.JPG', NULL, '2019-06-30 22:37:57', '2019-07-01 23:30:55'),
(84, 'Md. Siam Islam', 7, 'Md. Shimul Islam', 'Mukta Akter', '2011-02-10', '2019-01-17', 'Bangladeshi', 'Islam', 'Male', 'House 27, Road 4, Ward 39, Vatara Dhaka 1212', 'Harivana, Norapur, Norapur, Komilla', '01920089406', '01920089406', '01920089406', 'public/img/2019-07-01Md. Siam Islam.JPG', NULL, '2019-06-30 22:46:58', '2019-07-01 23:23:39'),
(85, 'Terasa Bayddya', 8, 'Mr. Istifan Bayddya', 'Sulakha', '2011-12-18', '2019-01-24', 'Bangladeshi', 'Christian', 'Female', 'House 46/ A , Road 4, Ward 40, vatara Dhaka 1212', 'Nonipur, Bandha, Bandha, Barisal', '01748755611', '01748755611', '01748755611', 'public/img/2019-07-01Teresa Buyddya.JPG', NULL, '2019-06-30 23:09:07', '2019-07-01 22:55:50'),
(86, 'Zunayed Hossain', 9, 'Md. Kamal Hossen', 'Nazma Begum', '2010-09-10', '2019-01-15', 'Bangladeshi', 'Islam', 'Male', 'House 25, Vatara, Dhaka 1212', 'Ilisha Shada , Bhola , Bhola, Dhola', '01845760653', '01915252423', '01915252423', 'public/img/2019-07-01Zunayed Hossain.JPG', NULL, '2019-06-30 23:14:25', '2019-07-01 22:43:32'),
(87, 'Fatema Akter Beli', 10, 'Md. Belal Hossain', 'Nasima', '2010-12-30', '2019-01-07', 'Bangladeshi', 'Islam', 'Female', 'House 4, Road 2, Ward 4, Vatara Dhaka 1212', 'Bishopur, Chandaish, Nangol Kot , Komilla', '01747347659', '01950507865', '01950507865', 'public/img/2019-07-01Fatema Akter Beli.JPG', NULL, '2019-06-30 23:18:51', '2019-07-01 22:46:52'),
(88, 'Md. Rabbi Hasan', 2, 'Md. Jamal Hossen', 'Mrs. Asma Begum', '2008-09-20', '2019-01-03', 'Bangladeshi', 'Muslim', 'Male', 'H# 03, B# A, R# 4, W# 39, Dhaka-1212', 'Noapara, Golpasha, Chaddahgram, Cumilla.', NULL, '01936004414', NULL, 'public/img/2019-07-01Md. Rabbi Hasan.JPG', NULL, '2019-06-30 23:23:48', '2019-06-30 23:23:48'),
(89, 'Md. Sabbir Rahman', 11, 'Md. Sajib Uddin', 'Shimuli', '2011-11-30', '2019-01-23', 'Bangladeshi', 'Islam', 'Male', 'House 1, Soilmaid high School road , Ward 4, Vatara  Dhaka 1212', 'Dhakhin Durga pur, Vate Gram, Sadullahpur, Gaibandha', '01773769548', '01720548291', '01720548291', 'public/img/2019-07-01Md. Sabbir Rahman.JPG', NULL, '2019-07-01 00:00:42', '2019-07-01 21:42:19'),
(90, 'Shihab Uddin', 5, 'Md. Abdul Salam', 'Salma Begum', '2009-08-25', '2019-01-07', 'Bangladeshi', 'Muslim', 'Male', 'H# 1272, R# West Vatara, W# 40, Dhaka-1212.', 'Netrokona', NULL, '01929610922', NULL, 'public/img/2019-07-01Md. Shihab Uddin.JPG', NULL, '2019-07-01 00:13:27', '2019-07-01 00:13:27'),
(91, 'Joya Maria Malo', 7, 'Jacob Malo', 'Dipali Malo', '2008-02-21', '2019-01-02', 'Bangladeshi', 'Christian', 'Female', 'Wazuddin Road, Vatara, Dhaka 1212', 'Gopalgonj', NULL, '01733218604', '01755024466', 'public/img/2019-07-01Jaya Maria Malo.JPG', NULL, '2019-07-01 00:19:50', '2019-07-01 00:20:21'),
(92, 'Sadiya Akther Urmi', 8, 'Yeasin Howlader', 'Rashida Begum', '2010-07-02', '2019-01-08', 'Bangladeshi', 'Muslim', 'Female', 'Vatara Dhaka-1212', 'Dhaka', NULL, '01631587943', '01402397378', 'public/img/2019-07-01Sadia Akter.JPG', NULL, '2019-07-01 00:26:17', '2019-07-01 00:26:17'),
(93, 'Julia Tripura', 4, 'Shibla', 'Oterun', '2009-06-01', '2019-01-10', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Kistipara, P.O: Rajasthali, P.S: Rajasthali, Dist: Bandorban', '017373304468', '017373304468', '017373304468', 'public/img/2019-07-01Julia Tripura.JPG', NULL, '2019-07-01 00:36:36', '2019-07-01 22:33:00'),
(94, 'Sporshi Baroi', 5, 'James Poul Baroi', 'Subra Baroi', '2008-09-18', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'Maa villa, 11/1, B#A, West Vatara, Dhaka-1212', 'Vill: Mandartoli, P.O: Ghosegaon, P.S: Dhobaura, Dist: Mymensingh', '01964436580', '01718808794', '01718808794', 'public/img/2019-07-01Sporshi Baroi.JPG', NULL, '2019-07-01 00:43:35', '2019-07-01 00:43:35'),
(95, 'Nayem Hossain', 6, 'Rofiqul Islam', 'Jahanara Begum', '2006-12-11', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'W#2, R#4, P.O: Vatara, P.S: Vatara, Dhaka-1212', 'Vill: Bishara, P.O: Kolmakanda, Dist: Netrokona.', '01912047139', '01912047139', '01945568398', 'public/img/2019-07-01Nyeem Hossain.JPG', NULL, '2019-07-01 00:50:39', '2019-07-01 22:37:46'),
(96, 'Dalipru Marma', 9, 'Rapru Marma', 'Painu Marma', '2009-12-20', '2019-01-03', 'Bangladeshi', 'Boiddho', 'Female', 'H#718, South Noyanagor, Vatara, Dhaka-1212', 'Dhaka', NULL, '01839337766', '01839100500', 'public/img/2019-07-01Dalipru Marma.JPG', NULL, '2019-07-01 00:52:11', '2019-07-01 00:52:11'),
(97, 'Angel Joze Baroi', 12, 'Mr. Bidhan Baroi', 'Lipika Baroi', '2011-12-04', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H 1, W 2, R 4, Vatara Dhaka 1212', 'Alidanga, Ulapur, Baula, Sylet', '01689065499', '01944142772', '01944142772', 'public/img/2019-07-01Angel Joze Baroi.JPG', NULL, '2019-07-01 00:55:28', '2019-07-01 21:37:41'),
(98, 'Chandrika Tripura', 7, 'Nokul', 'Jonapati', '2007-11-07', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Kistopara, P.O: Rajasthali, P.S: Rajasthali, Dist: Bandarban.', '01737304468', '01737304468', '01737304468', 'public/img/2019-07-01Chandrika Tripura.JPG', NULL, '2019-07-01 00:56:16', '2019-07-01 22:34:13'),
(99, 'Shifat Khan', 14, 'Monir Khan', 'Shifali', '2007-12-07', '2019-01-06', 'Bangladeshi', 'Muslim', 'Male', 'Nuton Bazar, Gulshan, South Noyanagor, Dhaka', 'Dhaka', NULL, '01914745060', NULL, 'public/img/2019-07-01Sifat Khan.JPG', NULL, '2019-07-01 00:57:08', '2019-07-01 00:57:08'),
(100, 'Silima Tripura', 8, 'Maliram Tripura', 'Chirobi', '2009-12-05', '2019-01-14', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, W#2, R#4, P.O: Gulshan, P.S: Vatara, Dhaka-1212', 'Vill: Dhopachori, P.O: Bicrompur, P.S: Chandonice, Dist: Chitagaong', '01737304468', '01737304468', '01737304468', 'public/img/2019-07-01Silima Tripura.JPG', NULL, '2019-07-01 01:04:24', '2019-07-01 03:53:09'),
(101, 'Md. Lemon Matbor', 4, 'Md. Yousuf Matbor', 'Sume Begum', '2009-02-10', '2019-01-03', 'Bangladeshi', 'Muslim', 'Male', 'Wazuddin Road, Vatara, Dhaka 1212', 'Sirkhara, Madaripur', NULL, '01745281147', '01741739778', 'public/img/2019-07-01Limon.JPG', NULL, '2019-07-01 02:24:46', '2019-07-01 02:24:46'),
(102, 'Taksina Itty', 12, 'Md. Bulbul Islam', 'Sallma', '2008-02-10', '2019-01-08', 'Bangladeshi', 'Muslim', 'Female', 'Vatara, Dhaka 1212', 'Domar, Rongpur', NULL, '01912461233', '01975523322', 'public/img/2019-07-01Taksina Itty.JPG', NULL, '2019-07-01 02:45:36', '2019-07-01 02:45:36'),
(103, 'Anik Hassan Khondokar', 9, 'Jahangir Alom Khondokar', 'Kulsum Akter', '2007-01-03', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Mannan Market, Badda, Dhaka-1212', 'Mannan Market, Badda, Dhaka-1212', '01821673805', '01712753901', '01712753901', 'public/img/2019-07-01Anik Hassan.JPG', NULL, '2019-07-01 03:02:01', '2019-07-01 22:35:23'),
(104, 'Endrity Tripura', 13, 'Mr. Kalu', 'Jaloma', '2008-03-27', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'Children Home Vatara', 'Alikadom, Bandorban', '01965024215', '01965024216', '01965024215', 'public/img/2019-07-01Indriti Tripura.JPG', NULL, '2019-07-01 03:03:46', '2019-07-01 21:28:46'),
(105, 'Logno Mondol', 10, 'Babul Mondol', 'Sobi Mondol', '2007-06-09', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'H#1, B#A, R#vatara, W#2, Dhaka-1212.', 'Vill : Khara, P.O : Digina, Dist : Chaddigna.', '01999643370', '01956673924', '01956673924', 'public/img/2019-07-01Logno Mondol.JPG', NULL, '2019-07-01 03:10:02', '2019-07-01 04:11:48'),
(106, 'Joana Tina Sarkar', 13, 'Simon Sarkar', 'Rina Sarkar', '2008-11-26', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'Vatara, Dhaka-1212', 'Endvrkany, Pererpar, Wauirvr, Barisar', NULL, '01674929389', '01712732316', 'public/img/2019-07-01Joana Tina Sarker.JPG', NULL, '2019-07-01 03:10:17', '2019-07-01 03:10:17'),
(107, 'Smrity Rani Tripura', 14, 'Mr. Hakila Tripura', 'Purdati', '2009-07-02', '2009-07-02', 'Bangladeshi', 'Christian', 'Female', 'Children Home Vatara', 'Ritom Para, Alikadom, Bandorban', '01865024215', '01865024215', '01737304468', 'public/img/2019-07-01Smrity Rani Tripura.JPG', NULL, '2019-07-01 03:17:56', '2019-07-01 21:27:45'),
(108, 'Nadia Akter', 18, 'Helal Mia', 'Salina Begum', '2008-10-01', '2019-01-07', 'Bangladeshi', 'Muslim', 'Female', 'Vatara, Dhaka-1212', 'Dhaka', NULL, '01687759268', '01957502964', 'public/img/2019-07-01Nadia Akter.JPG', NULL, '2019-07-01 03:22:54', '2019-07-01 03:22:54'),
(109, 'Piue Halder', 19, 'Samuel Halder', 'Shuvashini Dango', '2011-03-22', '2019-01-06', 'Bangladeshi', 'Christian', 'Female', 'Vatara, Dhaka-1212', 'Lokirpar, Radogonj, Gopalgonj', NULL, '01923753110', '01925476114', 'public/img/2019-07-01Piue Halder.JPG', NULL, '2019-07-01 03:37:07', '2019-07-01 03:37:07'),
(110, 'Angela Promi Biswas', 20, 'Ruben Simon Biswas', 'Pola Barikder', '2011-03-26', '2019-01-06', 'Bangladeshi', 'Christian', 'Female', 'H# 1273, R# 4, B# A, W# 40, Dhaka1212', 'Shelabunia, Mongla, Bagerhat', NULL, '01989422971', '01989422972', 'public/img/2019-07-01Angela Promi Biswas.JPG', NULL, '2019-07-01 03:47:50', '2019-07-01 03:47:50'),
(111, 'Laikhoma Tripura', 15, 'Mr. Banchandra', 'Showti', '2007-01-01', '2019-01-04', 'Bangladeshi', 'Christian', 'Female', 'Children home Vatara', 'Hatoram para, Hatoram para , Alikadom, Bandorban', '01865024215', '01737304468', '01865024215', 'public/img/2019-07-01Laikhoma Tripura.JPG', NULL, '2019-07-01 03:59:56', '2019-07-01 21:26:05'),
(112, 'Ayesha Akter', 21, 'Asikul Rahman', 'Asman Begum', '2007-12-11', '2019-01-08', 'Bangladeshi', 'Muslim', 'Female', 'Vatara, Dhaka', 'Jattrabari, Sodurpur, Foridpur.', NULL, '01766913884', '01931134826', 'public/img/2019-07-01Ayesha Akter.JPG', NULL, '2019-07-01 04:05:00', '2019-07-01 04:05:00'),
(113, 'Sanjida Akter', 15, 'Owazid', 'Sefali Akter', '2008-05-02', '2019-01-07', 'Bangladeshi', 'Muslim', 'Female', 'Nutun Bazar, Vatara, Dhaka', 'Comilla', NULL, '01764129035', '01798096978', 'public/img/2019-07-01Sanjida Akter.JPG', NULL, '2019-07-01 04:43:28', '2019-07-01 04:43:28'),
(114, 'Srabonti Akter', 16, 'Md. Mainuddin', 'Renu Begum', '2010-12-26', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'House 3, Road 4, Ward 2, Vatara 1212', 'Andar Manik , Shafipur, Kaliakoir, Gazipur', '01793383652', '01725664230', '01793383652', 'public/img/2019-07-01Srabonti Akter.JPG', NULL, '2019-07-01 06:08:28', '2019-07-01 21:25:42'),
(115, 'Marjoni Tripura', 6, 'Rumajon', 'Saderug', '2008-10-02', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', 'H# 1, B# A, W# 2, R# 4, Vatara, Dhaka-1212', 'Lemojeri, Bicrompur para, Bandorban.', NULL, '01737304468', NULL, 'public/img/2019-07-02Marjoni Tripura.JPG', NULL, '2019-07-01 23:07:57', '2019-07-01 23:08:38'),
(116, 'Sreemoti Tripura', 10, 'Sadu Chandra', 'Gunggati', '2008-11-10', '2019-01-08', 'Bangladeshi', 'Christian', 'Female', 'H# 1, B# A, W#40, Vatara, Dhaka-1212', 'Durnidoi, Rohangchori, Bandorban', NULL, '01865024215', NULL, 'public/img/2019-07-02Sreemoti Tripura.JPG', NULL, '2019-07-01 23:23:46', '2019-07-01 23:24:01'),
(117, 'Robiul', 9, 'Nur Islam', 'Ranu', '2011-07-15', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'House-2, ward - 40, Dhaka 1212', 'V-Sovarampur, P.O - Bansa \r\nBramonbaria, comilla', '01881655423', '01872594903', '01872594903', 'public/img/2019-07-02Robiul Hossain.JPG', NULL, '2019-07-01 23:28:10', '2019-07-01 23:28:10'),
(118, 'Nusaikhing Marma', 11, 'Thoaikanu', 'Hlachingwong', '2008-05-06', '2019-01-07', 'Bangladeshi', 'Christian', 'Female', 'H#1, B# A, W# 40, R# 4 Vatara, Dhaka-1212.', 'Lama, Bandorban.', NULL, '01845668378', NULL, 'public/img/2019-07-02Nusaikhing Marma.JPG', NULL, '2019-07-01 23:34:01', '2019-07-01 23:34:01'),
(119, 'Abu Jayed Tuhin', 16, 'Belal Hossain', 'Nazma Akter', '2010-11-11', '2019-01-07', 'Bangladeshi', 'Christian', 'Male', 'Khane Khodai Road, West Vatara, Dhaka-1212', 'Chithulia, Gusaibari, Dhonut, Bogura', NULL, '01914708485', '01911712580', 'public/img/2019-07-02Abu Zayed Tuhin.JPG', NULL, '2019-07-01 23:41:10', '2019-07-01 23:41:10'),
(120, 'Moriom Akter', 8, 'Mohor ali', 'Hosneara', '2012-03-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'House : 3, Road: 06, Ward :2 , Dhaka 1216', 'Village: Gopalnogor, P.O : Chorgagra, P.S : Kotuali\r\nDistrict: Myminsing', '01765544395', '01743824982', '01743824982', 'public/img/2019-07-02Moriom Akter.JPG', NULL, '2019-07-01 23:42:48', '2019-07-01 23:42:48'),
(121, 'Israt Jahan Hafsa', 17, 'Hossain', 'Beauty Begum', '2010-08-20', '2019-01-09', 'Bangladeshi', 'Muslim', 'Female', 'Grasp Market, Vatara, Dhaka-1212', 'Dhaka', NULL, '01737240667', NULL, 'public/img/2019-07-02Israt Jahan Hafsa.JPG', NULL, '2019-07-01 23:53:03', '2019-07-01 23:53:03'),
(122, 'Mehedi Hasan', 3, 'Md. Kamal', 'Sahanaz Begum', '2010-11-04', '2019-01-02', 'Bangladeshi', 'Islam', 'Male', 'House: 12, Ward : 4, Road : 2, Dhaka-1212', 'Vill : Balugram, P.O : Rupapata, P.S : Kasiani, District: Gopalgonj', '01717213633', '01617213633', '01617213633', 'public/img/2019-07-02Mahedi Hasan.JPG', NULL, '2019-07-02 00:18:37', '2019-07-02 00:18:37'),
(123, 'Rohan Hossain', 11, 'Md. Abdul Mannan', 'Begum Rahana', '2008-04-25', '2019-01-14', 'Bangladeshi', 'Islam', 'Male', 'House-37/2, Road - Vatara, Ward - 40, Dhaka-1212.', 'Vill: Chultuli, P.O: Raipura, P.S: Norshingdi, Dist: Norshingdi.', '01670666517', '01670666517', '01670666517', 'public/img/2019-07-02Rohan Hossain.jpg', NULL, '2019-07-02 02:38:57', '2019-07-02 02:38:57'),
(124, 'Rufsan', 4, 'Md. Abul Basher', 'Ms. Kakoly Akter', '2012-01-02', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'H- 13, Block-A, Ward - 2, Solimuddin Road, Vatara, Dhaka', 'H- 13, Block-A, Ward - 2, Solimuddin Road, Vatara, Dhaka Gulsan', '01726465534', '01755550571', '01755550571', 'public/img/2019-07-02Md. Rafsan.JPG', NULL, '2019-07-02 02:57:18', '2019-07-02 02:57:18'),
(125, 'Md. Nayeem', 5, 'Ruman Howlader', 'Yesmin', '2011-08-30', '2019-01-07', 'Bangladeshi', 'Muslim', 'Male', 'Vatara', 'Dhaka', NULL, '01836708730', NULL, 'public/img/2019-07-02Elora.jpg', NULL, '2019-07-02 03:26:05', '2019-07-02 03:26:05'),
(126, 'Morium Akter Hridy', 11, 'Masud Koriim', 'Salma Akter', '2013-07-02', '2019-01-07', 'Bangladeshi', 'Muslim', 'Female', 'Vatara', 'Dhaka', NULL, '01717838084', NULL, 'public/img/2019-07-02Hridy.jpg', NULL, '2019-07-02 03:31:25', '2019-07-02 03:31:25'),
(127, 'Habibur Rahman Safayet', 2, 'Samiul Islam', 'Salma Begum', '2010-10-09', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'H; 12, Road : 02, Ward-4, South Nayanagar, Notunbazar, Dhaka', 'Village: Tariapara, Po: Sarishabari, Jamalpur', '01916251221', '01916251221', '01730190159', 'public/img/2019-07-02Habibur Rahman Safayet.JPG', NULL, '2019-07-02 03:43:18', '2019-07-02 03:43:18'),
(128, 'Sabira Akther', 12, 'Md. Parves', 'Mrs. Salma Begum', '2009-01-20', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'House - 3, VataraRoad, Block ; A, Ward :40, DHaka', 'Shampur, Bisampur, Netrokona', '01913954998', '01610338342', '01610338342', 'public/img/2019-07-02Sabira Akter.JPG', NULL, '2019-07-02 03:51:39', '2019-07-02 03:51:39'),
(129, 'Chandni Kormokar', 7, 'Monir Kormokar', 'Joymoni Kormokar', '2010-02-20', '2019-01-01', 'Bangladeshi', 'Christian', 'Female', 'Vatara, Dhaka 1212', 'Kashpur, Pachbibi, Joypurhat', '01989445438', '01989445438', '01989445438', 'public/img/2019-07-02Chadni Karmoker.JPG', NULL, '2019-07-02 03:57:17', '2019-07-02 03:57:17'),
(130, 'Fahim Hossan', 6, 'Rofiqul Islam', 'Jahanara Begum', '2009-06-20', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'House : 3, Vatara Road, Block - A, Ward ; 40, dhaka 1212', 'Bishara, Kolmakanda, Netrokona', '01912047139', '01945568398', '01945568398', 'public/img/2019-07-02Fahim Islam.JPG', NULL, '2019-07-02 04:40:27', '2019-07-02 04:40:27'),
(131, 'Fahmida Habib', 1, 'Md. Habibur Rahman', 'Dil Afroz', '2005-11-17', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H:28, Road:03, ward: 4, Dhaka :1212', 'Lemubari, Manikgong', '01783927901', '01711951878', '01711951878', 'public/img/2019-07-02Fahmida Habib.JPG', NULL, '2019-07-02 04:45:49', '2019-07-02 04:45:49'),
(132, 'Aysha Akter Samia', 2, 'Samiul Islam', 'Salma Begum', '2005-03-24', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H-12, R-2, Ward-4, South nayanagar, Vatara, Dhaka', 'Tariapara, Sarishabara, Jamalpur', '01916251221', '01730190159', '01730190159', 'public/img/2019-07-02Aysha Akter Samia.JPG', NULL, '2019-07-02 04:54:30', '2019-07-02 04:54:30'),
(133, 'Nadia Akter Nishi', 3, 'Nilu Hossain', 'Parul Begum', '2007-12-15', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H; 50, Ward : 7, Road; 3, block :C, VAtara', 'Vatara, Gulsan', '01981272129', '01916032829', '01730190159', 'public/img/2019-07-02Nadia Akter Nishi.JPG', NULL, '2019-07-02 05:00:36', '2019-07-02 05:00:36'),
(134, 'Sadia Akter Nitu', 4, 'Nilu Hossain', 'Parul Begum', '2007-09-16', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H-50, Ward-7, Road: 3, block- C, Vatara, Gulsan', 'Vatara. Gulsan Dhaka', '01981272129', '01981272129', '01916032829', 'public/img/2019-07-02Sadia Akter Nitu.JPG', NULL, '2019-07-02 05:07:41', '2019-07-02 05:07:53'),
(135, 'Dewan Fariq Habib', 5, 'Md. Habibur Rahman', 'Dil Afroz', '2006-11-28', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'H-28, R-3, Ward-4, Fasertek, Vatara', 'Lemubari, Manikgonj', '01783927901', '01783927901', '01711951878', 'public/img/2019-07-02Dewan Farik Habib.JPG', NULL, '2019-07-02 05:23:12', '2019-07-02 05:23:12'),
(136, 'Jharna Tripura', 6, 'Nagachoron Tripura', 'Rajerung Tripura', '2005-06-03', '2019-01-01', 'Bangladeshi', 'Christian', 'Female', 'H-1, Block-A, Ward- 2, Road4, Vatara, Dhaka', 'Manikjon, Lama, Bandorbon', '01737304468', '8833920', '01737304468', 'public/img/2019-07-02Jharna Tripura.JPG', NULL, '2019-07-02 05:27:24', '2019-07-02 05:27:24'),
(137, 'Mollika Tripura', 8, 'Jhonbahadur', 'Shoinabi', '2007-01-26', '2019-01-01', 'Bangladeshi', 'Christian', 'Female', 'Vatara, Dhaka', 'Satish, Lama, Bandorban', '01737304468', '8833921', '01737304468', 'public/img/2019-07-02Mallika Tripura.JPG', NULL, '2019-07-02 05:30:20', '2019-07-02 05:30:20'),
(138, 'Veronica Tripura 1', 9, 'Bichandar Tripura', 'Hatherung Tripura', '2005-04-03', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Vatara, Dhaka', 'Rashongo, Lama, Bandarban', '01737304468', '01737304468', '01737304468', 'public/img/2019-07-02Veronica Tripura.JPG', NULL, '2019-07-02 05:34:11', '2019-07-02 21:06:41'),
(139, 'Sheuly', 10, 'Sogormoni', 'Malerun', '2005-07-15', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Vatara , Dhaka', 'Najiram, LAma, Bandarban', '018559630106', '018559630106', '01737304468', 'public/img/2019-07-02Sheuli Tripura.JPG', NULL, '2019-07-02 05:43:20', '2019-07-02 05:43:20'),
(140, 'Benita Tripura', 11, 'Noutha', 'Jumrung', '2007-07-27', '2019-01-01', 'Bangladeshi', 'Christian', 'Female', 'vatara, Dhaka', 'Najirampara,Lama, Bandorban', '01737304468', '09611351351', '01737304468', 'public/img/2019-07-02Banita Tripura.JPG', NULL, '2019-07-02 05:46:45', '2019-07-02 05:46:45'),
(141, 'Abu Sayed Tomal', 12, 'Khorshed ALom', 'Asma Begum', '2005-08-04', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Nayanagar, Notunbazar, VAtara, Dhaka', 'Nayanagar, Notunbazar, VAtara, Dhaka', '01925794325', '01925794325', '01925794325', 'public/img/2019-07-02Abu Sayed Tomal.JPG', NULL, '2019-07-02 05:49:38', '2019-07-02 05:49:53'),
(142, 'Md. Rakib Islam', 13, 'Liton Mredha', 'Minara Begum', '2003-07-06', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'H-88, Harunorrasid road, war-1, vatara Dhaka', 'Anggarpara, Ayla, Barguna, Barisal', '019806000914', '01998548906', '01998548906', 'public/img/2019-07-02Md. Rakib Islam.JPG', NULL, '2019-07-02 05:52:44', '2019-07-02 05:52:44'),
(143, 'Thassen Islam Jiyon', 14, 'Mir. Ariful Rahaman Mizan', 'Taslima Begum', '2005-11-11', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Akota sorok, Nurer chala', 'dorandi, 8600, Potuakhali Sadar, Potuakhali', '01777016588', '01777016588', '01933204551', 'public/img/2019-07-02Tahosin Islam Zion.JPG', NULL, '2019-07-02 05:55:24', '2019-07-02 05:55:24'),
(144, 'Sadia ISlam', 7, 'Helal Mia', 'Selina Begum', '2006-03-02', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'East Nurer chala, Gulsan Dhaka', 'Satbila,Solimabad, Bancharampur, Brammonbaria', '01957502964', '01957502964', '01777324356', 'public/img/2019-07-02Sadia Islam.JPG', NULL, '2019-07-02 05:57:52', '2019-07-02 05:57:52'),
(145, 'Jui Akter', 1, 'Md. Bulbul Islam', 'Salma Begum', '2011-10-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H; 720, Road- 2, Ward -4, Dhaka', 'Purbo ghaturia, Farmhut, Domar, Nilfamari', '01975523322', '01975523322', '01912461233', 'public/img/2019-07-04Jui Akter.JPG', NULL, '2019-07-03 22:47:23', '2019-07-03 22:47:23'),
(146, 'Mehajabin Taima', 10, 'Md. Shahidul Alam', 'Rafiza Akter', '2012-06-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'H-9350, Road-1204, Ward-40 Dhaka', 'Rosulpur, Khankhanapur,Rajbari', '01723959398', '01716480508', '01716480508', 'public/img/2019-07-08Taima Class one.jpg', NULL, '2019-07-03 23:52:13', '2019-07-07 21:58:27'),
(147, 'Nusrat Jahan Nafisa', 11, 'Md. Hossen', 'Beauty Begum', '2012-12-17', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Road 4, Ward 40, Dhaka 1212', 'Gawsia, Dhaka', '01716480508', '01010101010', '01716480508', 'public/img/2019-07-04Nusrat Jahan Nafisa.JPG', NULL, '2019-07-04 00:16:06', '2019-07-04 00:16:06'),
(148, 'Md. Abir Shekh', 1, 'Md. Faruk Shek', 'Chameli', '2011-11-27', '2019-01-02', 'Bangladeshi', 'Islam', 'Male', 'Boroitola, Khilbarirtek, Dhaka.', 'Vill: Shree Krishnodi, P.S: Rajour, Dist: Madaripur.', '01906319763', '01723321003', '01723321003', 'public/img/2019-07-04Abir Shek.JPG', NULL, '2019-07-04 03:19:33', '2019-07-06 00:18:48'),
(149, 'Rubina Akter', 2, 'Md. Rubel', 'Hajera Begum', '2012-10-07', '2019-01-08', 'Bangladeshi', 'Islam', 'Female', 'Boroitola, Khilbarirtek, Dhaka.', 'Vill: Ariya Mohon, P.O: Kalir Horipur Hajera, P.S: Sirajgaonj, Dist: Sirajgaonj.', '01912852708', '01942340454', '01942340454', 'public/img/2019-07-04Rubina.JPG', NULL, '2019-07-04 03:32:57', '2019-07-04 03:32:57'),
(150, 'Md. Murchalin Khan', 3, 'Md. Mukter Hossain', 'Khadija Begum', '2013-01-01', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Boroitola, Khilbarirtek, Dhaka.', 'Vill: Chatni, P.S: Natore, Dist: Natore.', '01716777242', '01718797843', '01718797843', 'public/img/2019-07-04Md. Murchalin.JPG', NULL, '2019-07-04 03:43:57', '2019-07-04 03:43:57'),
(151, 'Manik Ghotok', 5, 'Ujjol Ghotok', 'Juthi Ghotok', '2014-08-01', '2019-01-07', 'Bangladeshi', 'Christian', 'Male', 'Boroitola, Khilbarirtek, Dhaka.', 'Vill: Piol Para, P.O: Chitkibari, P.S: Kotali Para, Dist: Gopalgaonj.', '01779012018', '01717473854', '01717473854', 'public/img/2019-07-04Manik Ghotok.JPG', NULL, '2019-07-04 03:54:58', '2019-07-04 03:54:58'),
(152, 'Lila Kormokar', 6, 'Lodib Kormoker', 'Shilpi Kormoker', '2013-02-28', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'Khilbarirtek, Badda, Gulshan, Dhaka-1212.', 'Vill: Kashpur, P.O: Patchbibi, P.S: Patchbibi, Dist: Joypurhat.', '01718762918', '01718762918', '01718762918', 'public/img/2019-07-04Nila.JPG', NULL, '2019-07-04 04:09:11', '2019-07-04 04:09:11');
INSERT INTO `students` (`id`, `name`, `roll_no`, `fathers_name`, `mothers_name`, `date_of_birth`, `admission_date`, `nationality`, `religion`, `gender`, `present_address`, `permanent_address`, `mothers_cell`, `contact_no`, `fathers_cell`, `student_photo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(153, 'Mim Akter', 1, 'Md. Atiqur Rahman', 'Mrs. Jannat Begum', '2011-02-09', '2019-01-08', 'Bangladeshi', 'Islam', 'Female', 'Purbapara, Khilbarirtek, Dhaka-1212.', 'Vill: Grakul, P.O: Kasemabad, P.S: Goronodi, Dist: Borisal.', '01643400151', '01725588381', '01725588381', 'public/img/2019-07-06Mim Akter.JPG', NULL, '2019-07-05 21:40:01', '2019-07-05 21:40:01'),
(154, 'Apon Baroi', 1, 'Ashish Baroi', 'Nipa Baroi', '2010-09-10', '2019-01-10', 'Bangladeshi', 'Christian', 'Male', 'Khilbarirtek, Vatara-1212 Dhaka', 'Gopalganj Tungipara', '01635395657', '01635395657', '01635395657', 'public/img/2019-07-06Apon Baroi.JPG', NULL, '2019-07-05 21:50:48', '2019-07-05 21:50:48'),
(155, 'Sinha Akter', 2, 'Md. Sikim Ali Sheek', 'Mst. Nasima Begum', '2011-08-16', '2019-01-09', 'Bangladeshi', 'Islam', 'Female', 'Shahjadpur, Khilbarirtek, Dhaka-1212.', 'Vill: Kobirajpur, P.O: Rajoir, Dist: Madaripur.', '01710683372', '01710683372', '01710683372', 'public/img/2019-07-06Sinha Akter.JPG', NULL, '2019-07-05 21:55:54', '2019-07-05 21:55:54'),
(156, 'Shanta Akter', 3, 'Md. Salim Mia', 'Mst. Lipi Khanam', '2009-05-07', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', '63/11 Khilbarirtek, Shajedpur, Dhaka-1212.', 'Vill: Dangapara, P.O: Kanchon, P.S: Verail, Dist: Dinajpur.', '01747958225', '01947943166', '01947943166', 'public/img/2019-07-06Shanta Akter.JPG', NULL, '2019-07-05 22:09:09', '2019-07-05 22:09:09'),
(157, 'Nazmin Akter', 2, 'Nazar Shekh', 'Asma Begum', '2009-11-18', '2019-01-08', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake , Dhaka 1212', 'V: Gozaria, post: Kodom Bari 7911, Thana: Rajoir, District: Madaripur', '01902120624', '01902120624', '01902120624', 'public/img/2019-07-06Nazmin Akter.JPG', NULL, '2019-07-05 22:12:03', '2019-07-05 22:12:03'),
(158, 'Nahid', 4, 'Abdul Salam', 'Nur Nahar', '2009-08-23', '2019-01-03', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Vatara, Dhaka-1212', 'Vill: Pilgiri, P.S: Boruya, Dist: Comilla.', '01625176191', '01625075987', '01625075987', 'public/img/2019-07-06Md. Nahid Hossin.JPG', NULL, '2019-07-05 22:23:23', '2019-07-05 22:23:23'),
(159, 'Anisa Akther', 3, 'Md. Abbs', 'Rashida Begam', '2009-01-11', '2019-01-17', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake , Vatara', 'Kolagasla, Borguna', '0139509118', '0139509118', '01753000625', 'public/img/2019-07-06Anisa Akther.JPG', NULL, '2019-07-05 22:26:35', '2019-07-05 22:26:35'),
(160, 'Tithi Mohori', 5, 'Suvash Chandra Mohori', 'Rina Mohori', '2011-05-23', '2019-01-10', 'Bangladeshi', 'Hindu', 'Female', '63/11, Khilbarirtek, Vatara, Dhaka-1212.', 'Vill: Narikelbari, P.O: Narikelbari, P.S: Katalipara, Dist: Gopalgonj.', '01746232381', '01712625988', '01712625988', 'public/img/2019-07-06Tithi muhuri.JPG', NULL, '2019-07-05 22:50:20', '2019-07-05 22:50:20'),
(161, 'Madona Tithi Baroi', 1, 'Gilbart Baroi', 'Aduri Baroi', '2012-06-26', '2019-01-03', 'Bangladeshi', 'Christian', 'Female', 'D. SAS, Castle, P#1141, R#1, B# B, Queens Garden, Nurerchala, Vatara, Dhaka-1212.', 'Koligram, Jolirpar, Muksudpur, Gopalgonj.', NULL, '01796180689', '01781634014', 'public/img/2019-07-062N8A0638.JPG', NULL, '2019-07-05 22:58:01', '2019-07-05 22:58:01'),
(162, 'Junayed Hossain Ruman', 6, 'Arju Hossain', 'Ruma Akter', '2012-01-12', '2019-01-13', 'Bangladeshi', 'Islam', 'Male', 'Boroitala, Khilbairitek, Dhaka-1212.', 'Vill: Berbaradi, P.O: Horinarayanpur, P.S: Kusti, Dist: Kustiya.', '01982936469', '01957502505', '01957502505', 'public/img/2019-07-06Junayed Hossain Ruman.JPG', NULL, '2019-07-05 23:00:21', '2019-07-05 23:00:21'),
(163, 'Md. Nur Mohammad', 7, 'Md. Babul', 'Rasma', '2011-07-07', '2019-01-09', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Dhaka-1212.', 'Vill; Kudbarchar, P.O: Potuyakhali.', '01795819828', '01795819828', '01795819828', 'public/img/2019-07-06Nur Muhamad.JPG', NULL, '2019-07-05 23:09:38', '2019-07-05 23:09:38'),
(164, 'Md. Akash', 9, 'Md. Abul Hossain', 'Mst. Rabea Begum', '2008-08-20', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Dhaka-1212.', 'Gajipur', '01985788079', '01985788079', '01985788079', 'public/img/2019-07-06Md. Akkash.JPG', NULL, '2019-07-05 23:16:26', '2019-07-05 23:16:26'),
(165, 'Md. Jobaed', 8, 'Md. Monir Hossain', 'Mrs. Shirin Begum', '2009-09-08', '2019-01-09', 'Bangladeshi', 'Islam', 'Male', 'Uttor Badda, Hazipara, Dhaka-1212.', 'Amtoli, Borgona', '01718763757', '01718763757', '01718763757', 'public/img/2019-07-06Md. Jubayed Hosasin.JPG', NULL, '2019-07-05 23:25:01', '2019-07-05 23:57:28'),
(166, 'Riya Moni', 4, 'A', 'B', '2010-07-22', '2019-01-23', 'Bangladeshi', 'Islam', 'Female', 'A', 'B', '01977917774', '01977917774', '01977917774', 'public/img/2019-07-06Riya Moni.JPG', NULL, '2019-07-05 23:35:54', '2019-07-05 23:35:54'),
(167, 'Fatema', 5, 'A', 'B', '2010-07-23', '2019-01-15', 'Bangladeshi', 'Islam', 'Female', 'A', 'B', '01977917727', '01977917727', '01977917727', 'public/img/2019-07-0633.jpg', NULL, '2019-07-05 23:43:39', '2019-07-05 23:43:39'),
(168, 'Yeasin Arafat', 10, 'Md. Shalim Sardar', 'Runa Akter', '2011-08-09', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Shajadpur, Dhaka-1212.', 'Vill: Mohisha, P.O: Sharikal, P.S: Gournadi, Dist: Barisal.', '01955085867', '01716643283', '01716643283', 'public/img/2019-07-06Flower 1.jpg', NULL, '2019-07-05 23:45:36', '2019-07-05 23:45:36'),
(169, 'Jannatul Fardous Borsha', 11, 'Md. Shalim Sardar', 'Runa Akter', '2011-08-09', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtek, Shajadpur, Dhaka-1212.', 'Vill: Mohisha, P.O: Shanikal, P.S: Gournadi, Dist: Barishal.', '01955085867', '01716643282', '01716643283', 'public/img/2019-07-06Flower 4.jpg', NULL, '2019-07-05 23:53:37', '2019-07-05 23:53:37'),
(170, 'Shuvo Halder', 1, 'Md.Liton Halder', 'Rita Begum', '2014-07-30', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Boroitola, Vatara, Dhaka-1212.', 'Village: Sukhai, Thana: Jamalgong,\r\nPost: Dhormopasha,Dis: Sunamgong.', '01867369935', '01738091211', '01738091211', 'public/img/2019-07-062N8A0616.JPG', NULL, '2019-07-06 00:00:14', '2019-07-06 00:00:14'),
(171, 'Md. Esha Khan', 1, 'Md. Suruj Hossen Khan', 'Ariful Nahar', '2009-09-09', '2019-01-09', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtake Purbo Para, Vatara, Dhaka 1212', 'Sothikhola, Choramondi, Baker ganj, Barishal', '01916760050', '01916760050', '01718797934', 'public/img/2019-07-06Md. Esha Khan.JPG', NULL, '2019-07-06 00:11:06', '2019-07-06 00:12:37'),
(172, 'Habib Khan', 2, 'Md.Maksudur Rahman', 'Honufa Begum', '2014-11-30', '2019-01-09', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, East para, Gulshan, Dhaka-1212.', 'Village: Dhowya, Post: Dhowya, Thana: Vandariya, Dis: Pirojpur.', '01765082645', '0170774732', '0170774732', 'public/img/2019-07-06download.jpg', NULL, '2019-07-06 00:13:04', '2019-07-06 00:13:04'),
(173, 'Nandini Adhikary', 3, 'Dulal Adhikary', 'China Roy', '2014-12-12', '2019-01-09', 'Bangladeshi', 'Christian', 'Female', 'Khilbarirtek, Baoroitola.', 'Vill: Madhabpasha, P.O: Madhabpasha, Thana: Babugong, Dis: Barisal.', '01688651775', '01688651638', '01688651638', 'public/img/2019-07-062N8A0618.JPG', NULL, '2019-07-06 00:21:27', '2019-07-06 00:21:27'),
(174, 'Saiful Islam ( Anik)', 2, 'Md. Anis Hossain', 'Sheuly Akter', '2009-11-28', '2019-01-16', 'Bangladeshi', 'Islam', 'Male', 'A', 'B', '01786474237', '01786474237', '01936580287', 'public/img/2019-07-06Saiful.JPG', NULL, '2019-07-06 00:22:51', '2019-07-06 00:22:51'),
(175, 'Md.Rifat', 4, 'Md.Bipon Mia', 'Furkan', '2014-01-25', '2019-01-14', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Boroitola.', 'Dist: Kishorgong, Thana: Kotiyadi, Vill: Paishka, P.O: Modhopara.', '01763095633', '01628001576', '01628001576', 'public/img/2019-07-062N8A0620.JPG', NULL, '2019-07-06 00:26:20', '2019-07-06 00:26:20'),
(176, 'Yeasin Khan', 2, 'Sujon Khan', 'Shetu Begum', '2012-06-16', '2019-01-02', 'Bangladeshi', 'Muslim', 'Male', 'Shahajadpur, Khilbarirtak, Dhaka', 'Sholapur, Shibchor, Mabaripur.', NULL, '01718479780', NULL, 'public/img/2019-07-062N8A0640.JPG', NULL, '2019-07-06 00:36:17', '2019-07-06 00:36:17'),
(177, 'Imam Hossan Yousuf', 3, 'Md. Sha Alam Khan', 'Hossna Ara Begum', '2010-09-10', '2019-01-07', 'Bangladeshi', 'Islam', 'Male', 'Shajadpur, Gulshan Dhaka 1212', 'UorshaKati, UorshaKati, Ozirpur, Barsisal', '01838066904', '01838066904', '017104611592', 'public/img/2019-07-06Imam Hossan Yousuf.JPG', NULL, '2019-07-06 00:36:33', '2019-07-06 00:36:33'),
(178, 'All Abrar Arian', 5, 'Md.Razib', 'Beauty Aktar', '2014-05-28', '2019-01-13', 'Bangladeshi', 'Islam', 'Male', '1/1 Khalbarirtek, Badda, Dhaka.', 'Vill- Islampur, P.O: Islampur, P.S: Babugonj,Dist: Barisal.', '01647630892', '01642091073', '01642091073', 'public/img/2019-07-062N8A0622.JPG', NULL, '2019-07-06 00:40:15', '2019-07-06 00:40:15'),
(179, 'Sumaiya Akter', 3, 'Abdur Salam', 'Nurnahar', '2011-05-08', '2019-01-02', 'Bangladeshi', 'Muslim', 'Female', 'Nurerchala', 'Pilgiri, Borurha, Camilla.', NULL, '01625176191', NULL, 'public/img/2019-07-062N8A0642.JPG', NULL, '2019-07-06 00:40:27', '2019-07-06 00:40:27'),
(180, 'Md.Ashik Mia', 6, 'Md.Masud Mia', 'Mst.Asma Begum', '2011-08-14', '2019-01-09', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Boroitola.', 'Vill: Moheshtuli, Thana: Eshoregonj, Dist:Mymensingh.', '00000000000', '01910389213', '01910389213', 'public/img/2019-07-062N8A0625.JPG', NULL, '2019-07-06 00:48:13', '2019-07-06 00:48:13'),
(181, 'Rimi Akter Ety', 4, 'Md. Yousuf', 'Chameli Begum', '2010-08-15', '2019-01-09', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake Purbo Para', 'Patchim Soydebpur, Kochuya, Chadpur, Kochuya', '01951406647', '01951406647', '01918730938', 'public/img/2019-07-06Rimi Akter.JPG', NULL, '2019-07-06 00:49:08', '2019-07-06 00:49:08'),
(182, 'Md.Onik Mia', 7, 'Md.Fozlu Mia', 'Mst.Khalada Akter', '2014-12-20', '2019-01-03', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Boroitola.', 'Vill: Konapara, P.O: Usmanpur,\r\nThana: Kuliyarchore, Dist: Kishoregonj.', '00000000000', '01928347063', '01928347063', 'public/img/2019-07-062N8A0626.JPG', NULL, '2019-07-06 00:53:52', '2019-07-06 00:53:52'),
(183, 'Rima Khatun', 4, 'Md. Khairul Islam', 'Sima Begum', '2010-02-10', '2019-01-02', 'Bangladeshi', 'Muslim', 'Female', 'Boroitola, Khilbarirtak.', 'Alinagor, Esshor, Moymanshing.', NULL, '01743886664', '01948437185', 'public/img/2019-07-062N8A0645.JPG', NULL, '2019-07-06 00:58:19', '2019-07-06 00:58:19'),
(184, 'Sonaly Akter', 5, 'Harun Talukder', 'Anoyara Begum', '2010-11-17', '2019-01-08', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake Dhaka 1212', 'Bibichini, Betagi, Borguna,', '01742488525', '01742488525', '01929291659', 'public/img/2019-07-06Sonali Akter.JPG', NULL, '2019-07-06 01:03:10', '2019-07-06 01:03:10'),
(185, 'Amena Akter Taspiya', 3, 'Md. Salim', 'Khadija Akter', '2014-10-10', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'Boroitola, Khilbariryek, Dhaka-1212.', 'Vill: Purbo Mondrodi, P.O: Kobirajpur, P.S: Rajoir, Dist: Madaripur.', '01999976977', '01725133103', '01725133103', 'public/img/2019-07-06image-4.jpeg', NULL, '2019-07-06 02:12:59', '2019-07-06 02:12:59'),
(186, 'Habibur Rahman Hamim', 5, 'Harun  Hawladar', 'Khadija Begum', '2011-07-31', '2019-01-02', 'Bangladeshi', 'Muslim', 'Male', 'Khilbarirtak, Boroitola, Vatara, Dhaka.', 'Jhatra, Chomki, Patuyakhali', NULL, '01718295435', NULL, 'public/img/2019-07-06Koala.jpg', NULL, '2019-07-06 02:22:23', '2019-07-06 02:22:23'),
(187, 'Hafija Akter', 4, 'Tipu Munshi', 'Shilpi Begum', '2012-02-01', '2019-01-08', 'Bangladeshi', 'Islam', 'Female', 'Boroitola, Khilbarirtek, Dhaka-1212.', 'Vill: Hossainpur, P.O: Hossainpur, P.S: Rajoir, Dist: Madaripur.', '01982936469', '01982936469', '01982936469', 'public/img/2019-07-06image-2.jpg', NULL, '2019-07-06 02:23:13', '2019-07-06 02:23:13'),
(188, 'Joy Biswas', 6, 'Asim Biswas', 'Proti Biswas', '2010-10-12', '2019-01-03', 'Bangladeshi', 'Christian', 'Male', 'Khilbarirtak, Shahajatpur, Vatara, Dhaka-1212', 'Shimuliya,Jigorgasa, Jassore.', NULL, '01741836816', NULL, 'public/img/2019-07-062N8A0647.JPG', NULL, '2019-07-06 02:27:19', '2019-07-06 02:27:19'),
(189, 'Md. Arafat Islam', 5, 'Abu Taher', 'Shefali', '2014-10-01', '2019-01-07', 'Bangladeshi', 'Islam', 'Male', 'Boroitala, Khilbarirtek, Dhaka-1212', 'Vill: Alinagar P.O: Uma Khela, P.S: Issorgaonj, Dist: Mymensing.', '01905130231', '01997134957', '01997134957', 'public/img/2019-07-06Arafat.JPG', NULL, '2019-07-06 02:29:19', '2019-07-06 02:29:19'),
(190, 'Tajdika', 6, 'Md. Oliullaha Fokir', 'Kulsum Begum', '2013-11-20', '2019-01-10', 'Bangladeshi', 'Islam', 'Female', 'Boroitala, Khilbarirtek, Dhaka-1212', 'Vill: Kumrakhali, P.O: Payerpur, P.S: Madaripur, Dist: Madaripur.', '01709051507', '01709051507', '00+30646254136', 'public/img/2019-07-06Tajdika.JPG', NULL, '2019-07-06 02:36:03', '2019-07-06 02:36:03'),
(191, 'Israt Jahan', 8, 'Md. Shajahan', 'Mst. Shirina Khatun', '2012-12-19', '2019-01-06', 'Bangladeshi', 'Muslim', 'Female', 'Khilbarirtak, Shahajatpur, Dhaka.', 'Bakribi, Bakribi, Moymanshig.', NULL, '01704536046', NULL, 'public/img/2019-07-062N8A0651.JPG', NULL, '2019-07-06 02:38:13', '2019-07-06 02:38:13'),
(192, 'Md. Sadhin', 9, 'Md. Raju', 'Mukta Begum', '2011-10-26', '2019-01-14', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtek, Dhaka-1212', 'Vill: Boiyar Gudi Katha, P.S: Kakchira, P.S: Pathorgatha, Dist: Borguna.', '01780076521', '01718644294', '01718644294', 'public/img/2019-07-06Sadhin.JPG', NULL, '2019-07-06 02:42:59', '2019-07-06 02:42:59'),
(193, 'Jeet Gharami', 7, 'Shimson Gharami', 'Shima Garami', '2008-10-17', '2019-01-09', 'Bangladeshi', 'Christian', 'Male', 'Khilbarirtake , Shahajatpur, Vatara, Dhaka 1212', 'Kolabari, Hajipara, Gornodi, Barishal.', '01304037470', '01304037470', '01304037470', 'public/img/2019-07-06Jeet Ghorami.JPG', NULL, '2019-07-06 02:46:10', '2019-07-06 02:46:10'),
(194, 'Sumaiya Akter', 10, 'Md. Labu Mondol', 'Mst. Tania Akter', '2011-02-14', '2019-01-06', 'Bangladeshi', 'Muslim', 'Female', 'Khilbarirtak, Purbopara, Vatara, Dhaka', 'Chamurpara, Sonatala, Bagura.', NULL, '01758738540', '01830761479', 'public/img/2019-07-062N8A0655.JPG', NULL, '2019-07-06 02:48:41', '2019-07-06 02:48:41'),
(195, 'Md. Rakibul Islam', 10, 'Md. Khairul Islam', 'Sima Begum', '2014-12-01', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'Boroitala, Khilbarirtek, Dhaka-1212', 'Vill: Alinagar P.O: Uchakhila, P.S: Issorgaonj, Dist: Mymensing.', '01948437185', '01743886663', '01743886664', 'public/img/2019-07-06image-5.jpg', NULL, '2019-07-06 02:53:20', '2019-07-06 03:01:19'),
(196, 'Jitu Biswas', 8, 'Asim Biswas', 'Proti Biswas', '2007-06-08', '2019-01-10', 'Bangladeshi', 'Christian', 'Male', 'Khilbarirtake, Shahajatpur, Vatara, Dhaka 1212', 'Shimuliya, Jigorgasa, Jassor', '01741836816', '01741836816', '01741836816', 'public/img/2019-07-06Jitu.JPG', NULL, '2019-07-06 02:56:29', '2019-07-06 02:56:52'),
(197, 'Lamiya Akter Roz', 11, 'Md. Jahangir Alom', 'Hasna', '2011-01-19', '2019-01-07', 'Bangladeshi', 'Muslim', 'Female', 'Khilbarirtak, Shahajatpur, Dhaka', 'Paikpara, Tarail, Kishorgonj.', NULL, '01782245761', NULL, 'public/img/2019-07-062N8A0657.JPG', NULL, '2019-07-06 03:00:32', '2019-07-06 03:00:32'),
(198, 'Mahim Howladar', 12, 'Md. Shalom Hawladar', 'Mukta Akter', '2012-12-15', '2019-01-03', 'Bangladeshi', 'Muslim', 'Male', 'Khilbarirtak, Dhaka', 'Jhalokathi', NULL, '01716986610', '01797184195', 'public/img/2019-07-062N8A0659.JPG', NULL, '2019-07-06 03:07:43', '2019-07-06 03:07:43'),
(199, 'Md. Mahibulla Fakir', 9, 'Md. Dlliulla', 'Kulsum', '2009-07-22', '2019-01-03', 'Bangladeshi', 'Islam', 'Male', 'Khilbarirtake', 'Kumra Khali,  Peyarpur, Madaripur, Madaripur', '01702051507', '01702051507', '01702051507', 'public/img/2019-07-06Mahibulla.JPG', NULL, '2019-07-06 03:09:32', '2019-07-06 03:09:32'),
(200, 'Ariful Islam', 7, 'Md. Khokon', 'Umme Habiba', '2015-01-15', '2019-01-07', 'Bangladeshi', 'Muslim', 'Male', 'Khilbarirtak, Shahajatpur, Dhaka.', 'Kalikapur, Bramonpara, Varagram, Natore.', NULL, '01932831741', NULL, 'public/img/2019-07-062N8A0649.JPG', NULL, '2019-07-06 03:12:15', '2019-07-06 03:12:15'),
(201, 'Israf Hawladar', 1, 'H', 'M', '2014-03-03', '2019-01-10', 'Bangladeshi', 'Islam', 'Male', 'X', 'Y', '01982936469', '01982936469', '01982936469', 'public/img/2019-07-06Israf Hawladar.JPG', NULL, '2019-07-06 03:28:58', '2019-07-06 03:30:37'),
(202, 'Lamia Akter Aisha', 1, 'Md. Yousuf', 'Mrs. Nazma', '2012-01-01', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake', 'Gazipur', '00000000000', '01623412163', '01623412163', 'public/img/2019-07-07Lamia672.JPG', NULL, '2019-07-06 22:59:36', '2019-07-06 22:59:36'),
(203, 'Umme Jaheda Bithi', 2, 'Md. Gias Uddin', 'Sahida Begum', '2011-09-06', '2019-01-02', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake, Rahim Road, Badda Dhaka', 'Islamabad, Matlab, Chandpur', '01718512864', '01718512864', '01916741566', 'public/img/2019-07-07umme jaheda664.JPG', NULL, '2019-07-07 02:28:21', '2019-07-07 02:28:21'),
(204, 'Md. Shakib Hoshin', 3, 'Md. Faruk Ahomed Shopon', 'Laky Bagme', '2012-04-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Khilbarit ake Badda Dhaka', 'village : Baigoney shirpara, Gobtoli, Bogra', '01700802849', '01700802849', '01762266696', 'public/img/2019-07-072N8A0666.JPG', NULL, '2019-07-07 03:42:19', '2019-07-07 03:42:19'),
(205, 'Nurani Akter', 4, 'Md. Nazrul Islam', 'Munjuara Begum', '2011-05-11', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake, Badda, Dhaka', 'Dokkhin Trilai, Vurungamari, Charvurungamari, Kurigram', '01744706579', '01866203271', '01866203271', 'public/img/2019-07-072N8A0668.JPG', NULL, '2019-07-07 03:51:36', '2019-07-07 03:51:36'),
(206, 'Ananda Hazra Jerry', 5, 'Santidan Hazra John', 'Swapna Hazra', '2012-05-20', '2019-01-01', 'Bangladeshi', 'Christian', 'Male', 'Baridhara Bapist Church, Khilbarirtake, Baddda, Gulsan', 'Labubari, machastara, Kotalipara, Gopalgonj', '01960073147', '01920138172', '01920138172', 'public/img/2019-07-07close-up-of-water-drops-on-pink-flower-royalty-free-image-1129286570-1550867689.jpg', NULL, '2019-07-07 04:22:07', '2019-07-07 04:22:07'),
(207, 'Zhuma Akter', 6, 'Sohidul', 'Shamoli Begum', '2012-01-01', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake, Shajahadpur', 'Saiwodnur, Bolloudi , Madaripur, Madaripur', '12121212121', '01724772356', '01724772356', 'public/img/2019-07-072N8A0670.JPG', NULL, '2019-07-07 04:25:23', '2019-07-07 04:25:23'),
(208, 'Sajid Mahmud Anik', 7, 'Ohidul Kazi', 'Rezena Khanom', '2011-08-11', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Abdullah Bag', 'Orakandi , Kasiani, gopalgonj', '01743547352', '01758856503', '01758856503', 'public/img/2019-07-082N8A0673.JPG', NULL, '2019-07-07 22:43:04', '2019-07-07 22:43:04'),
(209, 'Arno Baroi', 8, 'Andrew Litu Baroi', 'Sagorika Biswas', '2010-05-06', '2019-01-01', 'Bangladeshi', 'Christian', 'Male', '1118/7 Rebecca Nir, azi Jamir Ali Road, Gulsan, Badda, Dhaka', 'Chaksing, School Bedgram, Muksudour, Gopalgonj', '01726978905', '01715873370', '01715873370', 'public/img/2019-07-082N8A0676.JPG', NULL, '2019-07-07 22:46:42', '2019-07-07 22:46:42'),
(210, 'Supto Bapary', 9, 'Sudhason Bapary', 'Archona Bapary', '2012-08-22', '2019-01-01', 'Bangladeshi', 'Christian', 'Male', 'Khilbarirtake, Boroitola Bazar, Bhatra, Dhaka 1212', 'Nalchira, Gournadi-Barisal', '01964351252', '01711703758', '01711703758', 'public/img/2019-07-082N8A0678.JPG', NULL, '2019-07-07 22:49:48', '2019-07-07 22:49:48'),
(211, 'Md. Rohidul Islam Nahid', 10, 'Md. Jalal Uddin', 'Hasina Begum', '2012-12-03', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Khilbaritake, Badda, Dhaka', 'Village- Deripara, Thana-EB\r\nKushtia', '01850430592', '01712163678', '01712163678', 'public/img/2019-07-082N8A0679.JPG', NULL, '2019-07-07 22:54:17', '2019-07-07 22:54:17'),
(212, 'Md. Rabbi Hossan', 11, 'Md. Gunjar Hossan', 'Rabina Begum', '2010-10-09', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Rajdhani, Khilbarirtake, Vatara, Dhaka-1212\r\n\r\n\r\nNote: His father is Carpenter and he has no phn', 'Dinajpur', '01010101011', '01010101011', '01010101011', 'public/img/2019-07-082N8A0681.JPG', NULL, '2019-07-07 23:09:35', '2019-07-07 23:09:35'),
(213, 'Md. Sobuj', 13, 'Late Billal Hossain', 'Mrs. Laila', '2012-01-01', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'Boroitola , Khilbarirtake', 'Lobongola, Borguna-8700', '01753442464', '01753442464', '00000001010', 'public/img/2019-07-082N8A0685.JPG', NULL, '2019-07-07 23:13:17', '2019-07-07 23:13:17'),
(214, 'Diya Mozumdar', 14, 'Samuel Majhi', 'Monika Majhi', '2011-05-12', '2019-01-01', 'Bangladeshi', 'Christian', 'Male', 'Boroitola , Khilbarirtake', 'Koligram , Muksudpur, Gopalgonj', '01767851771', '01767851771', '01845185742', 'public/img/2019-07-082N8A0696.JPG', NULL, '2019-07-08 02:23:44', '2019-07-08 02:23:44'),
(215, 'Rabbi Seikh', 15, 'Najir Seikh', 'Asma Begom', '2012-10-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake, Dhaka', 'Gozaria, Kodombari, Rajoir,Madaripur', '01902120624', '001902120624', '012101210120', 'public/img/2019-07-082N8A0687.JPG', NULL, '2019-07-08 02:34:12', '2019-07-08 02:34:12'),
(216, 'Jihad Islam', 16, 'Khokon Howlader', 'Luna Akter', '2011-09-05', '2019-01-01', 'Bangladeshi', 'Islam', 'Male', 'H-06, R-08, Khilbarirtake , Vatara', 'Rakudia, Babugonj, Barisal', '01828043779', '01828043779', '01828043779', 'public/img/2019-07-082N8A0690.JPG', NULL, '2019-07-08 02:38:03', '2019-07-08 02:38:03'),
(217, 'Afsana Mimi', 17, 'Rafiqul Islam Akash', 'Shahinor AKter Asha', '2011-11-15', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake , Vatara, Dhaka', 'Berakhola, B.Para, Comilla', '01923659826', '01923659826', '01923659826', 'public/img/2019-07-082N8A0692.JPG', NULL, '2019-07-08 02:45:56', '2019-07-08 02:45:56'),
(218, 'Monira Akther', 18, 'Kabir Howlader', 'Kohinur Begum', '2012-02-15', '2019-01-01', 'Bangladeshi', 'Islam', 'Female', 'Khilbarirtake , Badda, Dhaka', 'Rupsha. Ddipur, Khulna', '01910232328', '01910232328', '01910232328', 'public/img/2019-07-082N8A0694.JPG', NULL, '2019-07-08 02:59:08', '2019-07-08 02:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_results`
--

CREATE TABLE `student_subject_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `weekly_test_number` int(11) NOT NULL,
  `weekly_test_marks` decimal(4,2) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `section_subject_teacher_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'Bangla', NULL, '2019-06-22 00:45:29', '2019-06-22 00:45:29'),
(4, 'Bangla 1', NULL, '2019-06-22 00:45:50', '2019-06-22 00:45:50'),
(5, 'Bangla 2', NULL, '2019-06-22 00:46:06', '2019-06-22 00:46:06'),
(6, 'English', NULL, '2019-06-22 00:46:37', '2019-06-22 00:46:37'),
(7, 'English 1', NULL, '2019-06-22 00:46:53', '2019-06-22 00:46:53'),
(8, 'English 2', NULL, '2019-06-22 00:47:08', '2019-06-22 00:47:08'),
(9, 'Math', NULL, '2019-06-22 00:47:34', '2019-06-22 00:47:34'),
(10, 'Religion', NULL, '2019-06-22 00:48:01', '2019-06-22 00:48:01'),
(11, 'Gknowledge', NULL, '2019-06-22 00:48:34', '2019-06-22 00:48:34'),
(12, 'Drawing', NULL, '2019-06-22 00:49:11', '2019-06-22 00:49:11'),
(13, 'Social', NULL, '2019-06-22 00:49:45', '2019-06-22 00:49:45'),
(14, 'Science', NULL, '2019-06-22 00:50:18', '2019-06-22 00:50:18'),
(15, 'BGS', NULL, '2019-06-22 00:50:41', '2019-06-22 00:50:41'),
(16, 'Computer', NULL, '2019-06-22 00:51:35', '2019-06-22 00:51:35'),
(17, 'Moral Value', NULL, '2019-06-22 00:52:07', '2019-06-22 00:52:07'),
(18, 'Information Communication & Technolgy (ICT)', NULL, '2019-06-22 00:52:32', '2019-06-22 23:39:12'),
(19, 'Agriculture Studies', NULL, '2019-06-22 00:54:17', '2019-06-22 00:54:17'),
(20, 'Home Science (Garhostho)', NULL, '2019-06-22 00:54:35', '2019-06-22 23:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `category_id`, `supplier_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'mr x', 1, '2019-07-03 00:50:13', '2019-07-03 00:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('Married','Single') COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `present_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permanent_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_photo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_name`, `fathers_name`, `mothers_name`, `marital_status`, `spouse_name`, `date_of_birth`, `nationality`, `religion`, `present_address`, `permanent_address`, `contact_no`, `salary`, `teacher_photo`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Mr. Ruben Simon Biswas (Vatara)', 'Late Bilash Biswas', 'Late Promita Biswas', 'Married', 'Mrs Pola Barikder', '1979-02-10', '1935301422', 'Christian', '1273 Vatara, Block -A, Ward-40, Vatara, Dhaka1212', 'Vatara', '01989422971', '20000', 'public/img/1561290252Simon Ruben Biswas.JPG', NULL, '2019-06-21 23:02:00', '2019-07-02 03:20:08'),
(3, 'Asit Kumar Dhali (Vatara)', 'Kanai Lal Dhali', 'Gita Rani Dhali', 'Single', NULL, '1992-03-12', '19928712531000045', 'Hindu', 'Vatara, Natun Bazar, Dhaka 1212', 'A', '01735859866', '5000', 'public/img/15614551762N8A0598.JPG', NULL, '2019-06-21 23:19:47', '2019-07-02 03:19:43'),
(4, 'Douglas Joseph Robertson (Vatara))', 'Late Joseph Sydney Robertson', 'Late Joyce Robertson (Dolly)', 'Married', 'Mrs Shareen Hussain Srithi', '1956-01-01', '0000000000', 'Christian', 'House 56, Road 5, Ward No 1, masjid road , vatara, 100 fit, Dhaka 1212', 'B', '01905192365', '5000', 'public/img/1561290190Douglas.JPG', NULL, '2019-06-21 23:29:23', '2019-07-02 03:19:25'),
(5, 'Samir Gharami (Vatara)', 'Ranjit Gharami', 'Gholapi Gharami', 'Single', NULL, '1994-10-25', '19940623201000049', 'Christian', 'Mohammadpur L.td , Road 07 , House 113 Dhaka', 'B', '01857655890', '5000', 'public/img/1561290169Samir.JPG', NULL, '2019-06-21 23:36:58', '2019-07-02 03:18:39'),
(6, 'Rita Mondol (Vatara)', 'Late Nirjol Mondol', 'Late Asima Mondol', 'Married', 'Mr. James Halder', '1992-07-15', '19923323001000184', 'Christian', 'Vatara, Notunbazar, Dhaka 1212', 'A', '01610694899', '5000', 'public/img/15614552552N8A0600.JPG', NULL, '2019-06-21 23:43:54', '2019-07-02 03:18:22'),
(7, 'Bulu Sarker (vatara)', 'Ajit Sarker', 'Chaya Sarker', 'Married', 'Swapon Kumar Falia', '1974-05-15', '4124705065916', 'Christian', '12/ 4 West Vatara', 'A', '01687630397', '5000', 'public/img/15614552862N8A0602.JPG', NULL, '2019-06-21 23:46:56', '2019-07-02 03:17:27'),
(8, 'Lima Das (Vatara)', 'Pijush Das', 'Urmila Das', 'Married', 'Rony Biswas', '1995-07-10', '0000000000', 'Christian', 'A', 'B', '01994923231', '5000', 'public/img/1561290141Lima.JPG', NULL, '2019-06-21 23:53:49', '2019-07-02 03:09:34'),
(9, 'Protima Barman (Vatara)', 'Swapan Barmon', 'Beauty Barman', 'Single', NULL, '1991-10-24', '0000000000', 'Christian', 'A', 'B', '01781530058', '5000', 'public/img/1561290106Protima.JPG', NULL, '2019-06-22 00:01:12', '2019-07-02 03:09:18'),
(10, 'Tasnuba Shadmer (Vatara)', 'Md.Mamun Al Rashid', 'Tahmina Akhter', 'Married', 'Foysal Bappy', '1990-12-31', '4197244660', 'Islam', 'A', 'B', '01622262617', '5000', 'public/img/1561289945Tasnuba.JPG', NULL, '2019-06-22 00:05:41', '2019-07-02 03:09:04'),
(11, 'Lablo Hassan (Vatara)', 'Siful Islam', 'Rajia Begum', 'Married', 'Jesmin Akter', '1991-08-14', 'Bangladishi', 'Islam', 'Vatara ,  Notunbazar', 'Vill: Akua, P.O: South Chamuria\r\nP.S: Kalihati , D.S.: Tangail', '01856996913', '5000', 'public/img/1561457843mmmmm.JPG', NULL, '2019-06-25 04:17:23', '2019-07-02 03:08:49'),
(12, 'Md. Riaz Morshed (Vatara)', 'Md. Sirajul Islam', 'Marium Nessa', 'Married', 'Afrin Jahan', '1987-10-08', 'Bangladishi', 'Islam', '155 no Sangbadic R/A\r\nRoad-5, Block -F \r\nMirpur-11, Dhaka1216', '155 no Sangbadic R/A\r\nRoad-5, Block -F \r\nMirpur-11, Dhaka1216', '01680107224', '5000', 'public/img/156145831301111.JPG', NULL, '2019-06-25 04:25:13', '2019-07-02 03:08:31'),
(13, 'Dilshad Begum Rupali (K)', 'Late Iftakhair Hossain Khan', 'Late Fazilatunnessa', 'Married', 'Md. Tamzidur Rahoncon Khan', '1978-11-05', 'B', 'Islam', 'Satarkul Road, North Baddha, Dhaka 1212, Bangladesh.', 'Village: Ghoradia, Post: Narsingdigovt college, PS: Narsingdi, Distic: Narshingdi, Bangladesh', '01913117411', '5000', 'public/img/15620596042N8A0743.JPG', NULL, '2019-07-02 03:26:44', '2019-07-02 03:33:51'),
(14, 'Shara Bormon (K)', 'Late Sornokamol Biswas', 'Ms. Monicca Biswas', 'Married', 'Bipul Barmon', '1979-12-31', 'Bangladeshi', 'Christian', 'C/O Md. Jahingir Alam , House 1097, F 502, Khilbarirket, Boroitola Bazar, Shahazedpur Badda, Dhaka 1212', 'Village : Bhabanipur, P.O. Shisha-hat , Pauthintolla 6540, Porsha, Naogaon', '01718762918', '5000', 'public/img/1562060558Shara.JPG', NULL, '2019-07-02 03:42:38', '2019-07-02 03:42:49'),
(15, 'Arifun Nahar (K)', 'SK Ahaduzzaman', 'Monoara Begum', 'Married', 'Md. Shurij Hossen Khan', '1980-06-22', 'Bangladeshi', 'Islam', 'Khilbarirtek, Boroitala Bazar, Shahazadpur, Badda, Dhaka 1212', 'Gonopati, Basantopur, Kaligonj, Satkhira', '01916760050', '5000', 'public/img/1562061161Arifun Nahar.JPG', NULL, '2019-07-02 03:52:41', '2019-07-02 03:52:41'),
(16, 'Ruma Akter (K)', 'Late: Md. Abdul Razzak', 'Mrs. Monoara Begum', 'Married', 'Mr. Arzu Hossain', '1995-10-01', 'Bangladeshi', 'Islam', 'House 1205, Khilbarirtake, Boraitola Bazar, Dhaka 1212', 'Village: Berabari, Harianapur, Kustia', '01982936469', '5000', 'public/img/1562061760Ruma.JPG', NULL, '2019-07-02 04:02:40', '2019-07-02 04:02:57'),
(17, 'Md. Bappi Howlader (K)', 'Md. Mostofa Howlader', 'Mst. Fatema Yeasmin', 'Single', NULL, '2000-12-14', 'Bangladeshi', 'Islam', 'Khilbarirtek , Vatara, Dhaka 1212', 'Manpasha, Birkathi, Jhalokathi, Barisall', '01634135328', '5000', 'public/img/1562062290IMG_20190702_160450(1).jpg', NULL, '2019-07-02 04:11:30', '2019-07-02 04:11:47'),
(19, 'Habiba (Admin 2)', 'A', 'B', 'Married', 'A', '1992-07-17', 'Bangladeshi', 'Islam', 'A', 'B', '01733219406', '00', 'public/img/1562566439pp.jpg', NULL, '2019-07-08 00:04:19', '2019-07-08 00:13:59'),
(20, 'Jenney Moushumi Adhikary (Admin 1)', 'Sujit Kumar Boiragee', 'Tulika Boiragee', 'Married', 'Samuel Manik Adhikary', '1989-08-18', 'Bangladeshi', 'Christian', 'House 1, Block A,  Word 40, Vatara road , Vatara , Dhaka 1212', 'House 1, Block A,  Word 40, Vatara road , Vatara , Dhaka 1212', '01777750960', '00', 'public/img/1562566208IMG_1803.JPG', NULL, '2019-07-08 00:10:08', '2019-07-08 00:14:47'),
(21, 'Cashier 1', 'A', 'B', 'Married', 'Jorge', '1994-04-16', 'Bangladeshi', 'Christian', 'Vatara', 'Khulna', '01882118750', '00', 'public/img/156256774401.JPG', NULL, '2019-07-08 00:35:44', '2019-07-08 00:39:48'),
(22, 'Cashier 2', 'Hetis Chisim', 'Anupoma', 'Single', NULL, '1993-07-12', 'Bangladeshi', 'Christian', 'Badda', 'Mymenshing', '01910222444', '00', 'public/img/15625679222.JPG', NULL, '2019-07-08 00:38:42', '2019-07-08 00:38:42'),
(23, 'Cashier 3', 'A', 'B', 'Married', 'Riad', '1990-05-24', 'Bangladeshi', 'Islam', 'Dhaka', 'Dhaka', '01946999222', '00', 'public/img/156256824321.JPG', NULL, '2019-07-08 00:44:03', '2019-07-08 00:44:03'),
(24, 'Cashier 4', 'A', 'B', 'Single', NULL, '1991-07-26', 'Bangladeshi', 'Christian', 'A', 'B', '01910222666', '00', 'public/img/15625684103.JPG', NULL, '2019-07-08 00:46:50', '2019-07-08 00:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `term_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `term_name`, `created_at`, `updated_at`) VALUES
(1, 'First Terms Vatara', '2019-06-12 04:07:40', '2019-06-12 04:16:20'),
(2, 'Second Terms Vatara', '2019-06-12 04:16:11', '2019-06-12 04:16:11'),
(3, 'Final exam  Vatara', '2019-06-12 04:16:56', '2019-06-22 23:32:55'),
(4, 'First Terms Khilbarirtake', '2019-06-12 04:17:35', '2019-06-12 04:17:35'),
(5, 'Second Terms Khilbarirtake', '2019-06-12 04:17:55', '2019-06-12 04:17:55'),
(7, 'Final Exam Khilbari', '2019-07-06 03:45:38', '2019-07-06 03:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `term_results`
--

CREATE TABLE `term_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `term_marks` decimal(5,2) NOT NULL,
  `weekly_avg` decimal(5,2) NOT NULL,
  `total_marks` decimal(5,2) NOT NULL,
  `section_student_id` int(10) UNSIGNED NOT NULL,
  `section_subject_teacher_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 1, NULL, '$2y$10$NtiZEh.BU69SVfa9.1zuyO5MfCoz0GDuRluPim3im10L2L9yhv/LG', 'aFG2hUuGgwrLODC7UdrZqaZQeCRzv4fEV5bio15tGvT461QYmbFUFn00QVLv', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `action_date` date NOT NULL,
  `account_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `created_by`, `category_id`, `supplier_id`, `action_date`, `account_name`, `description`, `amount`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2019-07-03', 'pen', 'dhfkjdhfkjdafdf', '100.00', NULL, '2019-07-03 00:51:10', '2019-07-03 00:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_tests`
--

CREATE TABLE `weekly_tests` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_subject_teacher_id` int(10) UNSIGNED NOT NULL,
  `Weekly_test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weekly_test_results`
--

CREATE TABLE `weekly_test_results` (
  `id` int(10) UNSIGNED NOT NULL,
  `weekly_test_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `weekly_test_marks` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branches_area_id_foreign` (`area_id`);

--
-- Indexes for table `business_months`
--
ALTER TABLE `business_months`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_months_fiscal_year_id_foreign` (`fiscal_year_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collected_fees`
--
ALTER TABLE `collected_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collected_fees_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `collected_fees_section_student_id_foreign` (`section_student_id`),
  ADD KEY `collected_fees_student_id_foreign` (`student_id`);

--
-- Indexes for table `fees_books`
--
ALTER TABLE `fees_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_books_branch_id_foreign` (`branch_id`),
  ADD KEY `fees_books_assigned_user_id_foreign` (`teacher_id`),
  ADD KEY `fees_books_prefix_id_foreign` (`prefix_id`);

--
-- Indexes for table `fees_types`
--
ALTER TABLE `fees_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_reports_student_id_foreign` (`student_id`),
  ADD KEY `final_reports_final_result_id_foreign` (`final_result_id`),
  ADD KEY `final_reports_section_subject_teacher_id_foreign` (`section_subject_teacher_id`);

--
-- Indexes for table `final_results`
--
ALTER TABLE `final_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_results_section_id_foreign` (`section_id`);

--
-- Indexes for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fiscal_years_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_enrolls`
--
ALTER TABLE `level_enrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_enrolls_level_id_foreign` (`level_id`),
  ADD KEY `level_enrolls_session_id_foreign` (`session_id`),
  ADD KEY `level_enrolls_branch_id_foreign` (`branch_id`),
  ADD KEY `level_enrolls_shift_id_foreign` (`shift_id`);

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
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `prefixes`
--
ALTER TABLE `prefixes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_level_enroll_id_foreign` (`level_enroll_id`),
  ADD KEY `sections_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `section_students`
--
ALTER TABLE `section_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_students_section_id_foreign` (`section_id`),
  ADD KEY `section_students_student_id_foreign` (`student_id`);

--
-- Indexes for table `section_subject_teachers`
--
ALTER TABLE `section_subject_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_subject_teachers_subject_id_foreign` (`subject_id`),
  ADD KEY `section_subject_teachers_teacher_id_foreign` (`teacher_id`),
  ADD KEY `section_subject_teachers_section_id_foreign` (`section_id`);

--
-- Indexes for table `section_wise_fees`
--
ALTER TABLE `section_wise_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_wise_fees_session_id_foreign` (`session_id`),
  ADD KEY `section_wise_fees_section_id_foreign` (`section_id`),
  ADD KEY `section_wise_fees_fees_type_id_foreign` (`fees_type_id`),
  ADD KEY `section_wise_fees_business_month_id_foreign` (`business_month_id`);

--
-- Indexes for table `selected_ids`
--
ALTER TABLE `selected_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selected_ids_student_subject_result_id_foreign` (`student_subject_result_id`),
  ADD KEY `selected_ids_term_result_id_foreign` (`term_result_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shifts_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_student_photo_unique` (`student_photo`);

--
-- Indexes for table `student_subject_results`
--
ALTER TABLE `student_subject_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_subject_results_student_id_foreign` (`student_id`),
  ADD KEY `student_subject_results_section_subject_teacher_id_foreign` (`section_subject_teacher_id`),
  ADD KEY `student_subject_results_term_id_foreign` (`term_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_category_id_foreign` (`category_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_teacher_photo_unique` (`teacher_photo`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `term_results`
--
ALTER TABLE `term_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `term_results_section_student_id_foreign` (`section_student_id`),
  ADD KEY `term_results_section_subject_teacher_id_foreign` (`section_subject_teacher_id`),
  ADD KEY `term_results_term_id_foreign` (`term_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vouchers_category_id_foreign` (`category_id`),
  ADD KEY `vouchers_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `weekly_tests`
--
ALTER TABLE `weekly_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weekly_tests_section_subject_teacher_id_foreign` (`section_subject_teacher_id`);

--
-- Indexes for table `weekly_test_results`
--
ALTER TABLE `weekly_test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weekly_test_results_weekly_test_id_foreign` (`weekly_test_id`),
  ADD KEY `weekly_test_results_student_id_foreign` (`student_id`),
  ADD KEY `weekly_test_results_teacher_id_foreign` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_months`
--
ALTER TABLE `business_months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `collected_fees`
--
ALTER TABLE `collected_fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fees_books`
--
ALTER TABLE `fees_books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fees_types`
--
ALTER TABLE `fees_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `final_reports`
--
ALTER TABLE `final_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_results`
--
ALTER TABLE `final_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `level_enrolls`
--
ALTER TABLE `level_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `prefixes`
--
ALTER TABLE `prefixes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `section_students`
--
ALTER TABLE `section_students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `section_subject_teachers`
--
ALTER TABLE `section_subject_teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `section_wise_fees`
--
ALTER TABLE `section_wise_fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `selected_ids`
--
ALTER TABLE `selected_ids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `student_subject_results`
--
ALTER TABLE `student_subject_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `term_results`
--
ALTER TABLE `term_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weekly_tests`
--
ALTER TABLE `weekly_tests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weekly_test_results`
--
ALTER TABLE `weekly_test_results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `branches_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_months`
--
ALTER TABLE `business_months`
  ADD CONSTRAINT `business_months_fiscal_year_id_foreign` FOREIGN KEY (`fiscal_year_id`) REFERENCES `fiscal_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collected_fees`
--
ALTER TABLE `collected_fees`
  ADD CONSTRAINT `collected_fees_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collected_fees_section_student_id_foreign` FOREIGN KEY (`section_student_id`) REFERENCES `section_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collected_fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees_books`
--
ALTER TABLE `fees_books`
  ADD CONSTRAINT `fees_books_assigned_user_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_books_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_books_prefix_id_foreign` FOREIGN KEY (`prefix_id`) REFERENCES `prefixes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_reports`
--
ALTER TABLE `final_reports`
  ADD CONSTRAINT `final_reports_final_result_id_foreign` FOREIGN KEY (`final_result_id`) REFERENCES `final_results` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `final_reports_section_subject_teacher_id_foreign` FOREIGN KEY (`section_subject_teacher_id`) REFERENCES `section_subject_teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `final_reports_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `final_results`
--
ALTER TABLE `final_results`
  ADD CONSTRAINT `final_results_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fiscal_years`
--
ALTER TABLE `fiscal_years`
  ADD CONSTRAINT `fiscal_years_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `level_enrolls`
--
ALTER TABLE `level_enrolls`
  ADD CONSTRAINT `level_enrolls_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `level_enrolls_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `level_enrolls_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `level_enrolls_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_level_enroll_id_foreign` FOREIGN KEY (`level_enroll_id`) REFERENCES `level_enrolls` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sections_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_students`
--
ALTER TABLE `section_students`
  ADD CONSTRAINT `section_students_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_subject_teachers`
--
ALTER TABLE `section_subject_teachers`
  ADD CONSTRAINT `section_subject_teachers_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_subject_teachers_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_subject_teachers_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_wise_fees`
--
ALTER TABLE `section_wise_fees`
  ADD CONSTRAINT `section_wise_fees_business_month_id_foreign` FOREIGN KEY (`business_month_id`) REFERENCES `business_months` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_wise_fees_fees_type_id_foreign` FOREIGN KEY (`fees_type_id`) REFERENCES `fees_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_wise_fees_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_wise_fees_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selected_ids`
--
ALTER TABLE `selected_ids`
  ADD CONSTRAINT `selected_ids_student_subject_result_id_foreign` FOREIGN KEY (`student_subject_result_id`) REFERENCES `student_subject_results` (`id`),
  ADD CONSTRAINT `selected_ids_term_result_id_foreign` FOREIGN KEY (`term_result_id`) REFERENCES `term_results` (`id`);

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_subject_results`
--
ALTER TABLE `student_subject_results`
  ADD CONSTRAINT `student_subject_results_section_subject_teacher_id_foreign` FOREIGN KEY (`section_subject_teacher_id`) REFERENCES `section_subject_teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_subject_results_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `term_results`
--
ALTER TABLE `term_results`
  ADD CONSTRAINT `term_results_section_student_id_foreign` FOREIGN KEY (`section_student_id`) REFERENCES `section_students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `term_results_section_subject_teacher_id_foreign` FOREIGN KEY (`section_subject_teacher_id`) REFERENCES `section_subject_teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `term_results_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vouchers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `weekly_tests`
--
ALTER TABLE `weekly_tests`
  ADD CONSTRAINT `weekly_tests_section_subject_teacher_id_foreign` FOREIGN KEY (`section_subject_teacher_id`) REFERENCES `section_subject_teachers` (`id`);

--
-- Constraints for table `weekly_test_results`
--
ALTER TABLE `weekly_test_results`
  ADD CONSTRAINT `weekly_test_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `weekly_test_results_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `weekly_test_results_weekly_test_id_foreign` FOREIGN KEY (`weekly_test_id`) REFERENCES `weekly_tests` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
