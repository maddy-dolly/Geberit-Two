-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2020 at 02:49 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gebritt`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 'India', 'IN', NULL, NULL),
(2, 'Bangladesh', 'BD', NULL, NULL),
(3, 'Qutar', 'QA', NULL, NULL),
(4, 'Hong Kong', 'HK', NULL, NULL),
(5, 'Brunei ', 'BN', NULL, NULL),
(6, 'China', 'CN', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_terms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_number` bigint(20) NOT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `customer_code`, `currency`, `payment_terms`, `customer_number`, `customer_address`, `countries_id`, `created_at`, `updated_at`) VALUES
(1, 'United Supplies Co.', 'USC', 'SGD', '000B CIA - Cash in Advance', 534894, '2 Kallang pudding Road\n#02-003 Mactech Industrail Building\nTelephone: 578985645\nSingapore 349307', 3, '2020-02-26 23:59:09', '2020-02-26 23:59:09'),
(2, 'Evergreen Trading International Ltd', 'ETI', 'USD', '030 within 30 days, net', 534895, '2 Kallang pudding Road\n#02-003 Mactech Industrail Building\nTelephone: 578985645\nSingapore 349307', 2, '2020-02-26 23:59:09', '2020-02-26 23:59:09'),
(3, 'Arnhold & Co., Ltd.', 'ACL', 'USD', '000B CIA - Cash in Advance', 534896, '2 Kallang pudding Road\n#02-003 Mactech Industrail Building\nTelephone: 578985645\nSingapore 349307', 4, '2020-02-26 23:59:09', '2020-02-26 23:59:09'),
(4, 'T S B Sendirian Bhd.', 'TSB', 'SGD', '000B CIA - Cash in Advance', 534897, '2 Kallang pudding Road\n#02-003 Mactech Industrail Building\nTelephone: 578985645\nSingapore 349307', 5, '2020-02-26 23:59:09', '2020-02-26 23:59:09'),
(5, 'Valseal Fluid Technology', 'VFT', 'USD', '030 within 30 days, net', 534898, '2 Kallang pudding Road\n#02-003 Mactech Industrail Building\nTelephone: 578985645\nSingapore 349307', 6, '2020-02-26 23:59:09', '2020-02-26 23:59:09'),
(6, 'Ranosys Technology', 'RT', 'USD', 'Online', 7014652475, 'dhrnidher colony', 1, '2020-02-27 00:53:13', '2020-02-27 00:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_02_06_054141_create_roles_table', 2),
(4, '2014_10_12_000000_create_users_table', 3),
(5, '2020_02_07_070701_create_countries_table', 4),
(6, '2020_02_07_070739_create_usercountries_table', 5),
(7, '2020_02_10_132115_create_customers_table', 6),
(8, '2020_02_12_045336_create_product_types_table', 7),
(9, '2020_02_13_095436_create_products_table', 8),
(10, '2020_02_19_110827_create_quotations', 9),
(11, '2020_02_19_110959_create_product_quotations', 10);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_types_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `list_price_usd` double(8,2) DEFAULT NULL,
  `list_price_sgd` double(8,2) DEFAULT NULL,
  `product_line` int(11) DEFAULT NULL,
  `countries_id` int(10) UNSIGNED DEFAULT NULL,
  `origin_company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_status` int(11) NOT NULL,
  `st51_since` date DEFAULT NULL,
  `st52_since` date DEFAULT NULL,
  `sales_replaced_by` text COLLATE utf8mb4_unicode_ci,
  `no_sales_in` text COLLATE utf8mb4_unicode_ci,
  `quantity_pu_1` int(11) DEFAULT NULL,
  `quantity_pu_2` int(11) DEFAULT NULL,
  `quantity_pu_3` int(11) DEFAULT NULL,
  `quantity_pu_4` int(11) DEFAULT NULL,
  `net_weight` double(8,2) DEFAULT NULL,
  `gross_weight` double(8,2) DEFAULT NULL,
  `volume_pu_1` double(8,2) DEFAULT NULL,
  `volume_pu_2` double(8,2) DEFAULT NULL,
  `volume_pu_3` double(8,2) DEFAULT NULL,
  `volume_pu_4` double(8,2) DEFAULT NULL,
  `unit_volume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step_relevant` text COLLATE utf8mb4_unicode_ci,
  `product_hierarchy` text COLLATE utf8mb4_unicode_ci,
  `pm` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `material_number`, `product_types_id`, `description`, `list_price_usd`, `list_price_sgd`, `product_line`, `countries_id`, `origin_company`, `material_status`, `st51_since`, `st52_since`, `sales_replaced_by`, `no_sales_in`, `quantity_pu_1`, `quantity_pu_2`, `quantity_pu_3`, `quantity_pu_4`, `net_weight`, `gross_weight`, `volume_pu_1`, `volume_pu_2`, `volume_pu_3`, `volume_pu_4`, `unit_volume`, `base_unit`, `weight_unit`, `step_relevant`, `product_hierarchy`, `pm`, `created_at`, `updated_at`) VALUES
(2, '515010000', 1, 'Sanitary module for wall hung WC, black', 694.00, 947.00, 11, 2, '6303 F DE Logistics Ratingen', 52, '2020-12-15', '2020-12-15', '1', NULL, 1, 0, 0, 6, 30.00, 33.60, 194.86, 0.00, 0.00, 1411.20, 'CDM', 'PC', 'KG', 'seco', '...11..870....8706', 'VBM', '2020-02-27 00:04:30', '2020-03-17 06:50:35'),
(3, '515015000', 1, 'Sanitary module for wall hung WC, taupe', 694.00, 947.00, 11, 2, '6303 F DE Logistics Ratingen', 52, '2020-12-15', '2020-12-15', '1', '', 1, 0, 0, 6, 30.00, 33.60, 196.50, 0.00, 0.00, 1411.20, 'CDM', 'PC', 'KG', 'seco', '...11..870....8706', 'VBM', '2020-02-27 00:04:30', '2020-02-27 00:04:30'),
(4, '515060000', 1, 'Sanitary module for standing WC, black', 694.00, 947.00, 11, 2, '6303 F DE Logistics Ratingen', 51, '2020-12-15', '2020-12-15', '1', '', 1, 0, 0, 6, 30.00, 33.60, 196.50, 0.00, 0.00, 1411.20, 'CDM', 'PC', 'KG', 'seco', '...11..870....8706', 'VBM', '2020-02-27 00:04:30', '2020-02-27 00:04:30'),
(5, '515200000', 1, 'Classic operating plate, chrome shining', 74.00, 101.00, 11, 2, '6303 F DE Logistics Ratingen', 51, '2020-12-15', '2020-12-15', '1', NULL, 1, 0, 0, 0, 0.26, 0.37, 3.24, 0.00, 0.00, 0.00, 'CDM', 'PC', 'KG', 'seco', '...11..870....8704', 'VBM', '2020-02-27 00:04:30', '2020-03-17 06:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `product_quotations`
--

CREATE TABLE `product_quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotations_id` int(10) UNSIGNED DEFAULT NULL,
  `products_id` int(10) UNSIGNED DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` double(8,2) DEFAULT NULL,
  `discount_unit_price` double(8,2) DEFAULT NULL,
  `total_cost` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_quotations`
--

INSERT INTO `product_quotations` (`id`, `quotations_id`, `products_id`, `product_description`, `quantity`, `discount`, `unit_price`, `discount_unit_price`, `total_cost`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 947.00, 284.10, 662.90, '2020-02-28 02:05:29', '2020-02-28 02:05:29'),
(8, 1, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-02 06:43:16', '2020-03-02 06:43:16'),
(9, 1, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-02 06:43:16', '2020-03-02 06:43:16'),
(16, 5, 5, 'Classic operating plate, chrome shining', '1', '60', 101.00, 60.60, 40.40, '2020-03-05 06:44:35', '2020-03-05 06:44:35'),
(17, 6, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 694.00, 471.92, 222.08, '2020-03-05 07:07:07', '2020-03-05 07:07:07'),
(22, 11, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 947.00, 643.96, 303.04, '2020-03-05 07:17:55', '2020-03-05 07:17:55'),
(23, 12, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 694.00, 471.92, 222.08, '2020-03-05 23:17:34', '2020-03-05 23:17:34'),
(24, 12, 3, 'Sanitary module for wall hung WC, taupe', '1', '50', 694.00, 347.00, 347.00, '2020-03-05 23:17:34', '2020-03-05 23:17:34'),
(25, 13, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 694.00, 471.92, 222.08, '2020-03-05 23:19:15', '2020-03-05 23:19:15'),
(26, 13, 3, 'Sanitary module for wall hung WC, taupe', '1', '50', 694.00, 347.00, 347.00, '2020-03-05 23:19:15', '2020-03-05 23:19:15'),
(27, 14, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 694.00, 471.92, 222.08, '2020-03-05 23:40:43', '2020-03-05 23:40:43'),
(28, 14, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-05 23:40:43', '2020-03-05 23:40:43'),
(51, NULL, 3, 'Sanitary module for wall hung WC, taupe', '1', '0', 694.00, 0.00, 694.00, '2020-03-06 03:56:36', '2020-03-06 03:56:36'),
(86, 60, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-06 06:35:27', '2020-03-06 06:35:27'),
(89, 63, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-06 06:43:28', '2020-03-06 06:43:28'),
(94, 68, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-06 06:51:31', '2020-03-06 06:51:31'),
(95, 69, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-06 06:59:58', '2020-03-06 06:59:58'),
(100, 74, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-06 07:18:56', '2020-03-06 07:18:56'),
(116, 90, 4, 'Sanitary module for standing WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 00:37:49', '2020-03-11 00:37:49'),
(117, 91, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 00:46:16', '2020-03-11 00:46:16'),
(118, 92, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 00:56:19', '2020-03-11 00:56:19'),
(119, 93, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 01:01:08', '2020-03-11 01:01:08'),
(120, 94, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 01:05:53', '2020-03-11 01:05:53'),
(121, 95, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 01:07:04', '2020-03-11 01:07:04'),
(122, 96, 2, 'Sanitary module for wall hung WC, black', '1', '20', 694.00, 138.80, 555.20, '2020-03-11 01:09:35', '2020-03-11 01:09:35'),
(123, 97, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:24:05', '2020-03-11 01:24:05'),
(124, 98, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:25:40', '2020-03-11 01:25:40'),
(125, 99, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:27:24', '2020-03-11 01:27:24'),
(126, 100, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:32:41', '2020-03-11 01:32:41'),
(127, 101, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:35:47', '2020-03-11 01:35:47'),
(128, 102, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:37:09', '2020-03-11 01:37:09'),
(129, 103, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:40:15', '2020-03-11 01:40:15'),
(130, 104, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:43:15', '2020-03-11 01:43:15'),
(131, 105, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:43:28', '2020-03-11 01:43:28'),
(132, 106, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 01:50:23', '2020-03-11 01:50:23'),
(133, 107, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:08:03', '2020-03-11 03:08:03'),
(134, 108, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:10:13', '2020-03-11 03:10:13'),
(135, 109, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:12:22', '2020-03-11 03:12:22'),
(136, 110, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:20:01', '2020-03-11 03:20:01'),
(137, 111, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:22:35', '2020-03-11 03:22:35'),
(138, 112, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:37:26', '2020-03-11 03:37:26'),
(139, 113, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:40:41', '2020-03-11 03:40:41'),
(140, 114, 4, 'Sanitary module for standing WC, black', '1', '0', 694.00, 0.00, 694.00, '2020-03-11 03:43:42', '2020-03-11 03:43:42'),
(141, 118, 3, 'Sanitary module for wall hung WC, taupe', '1', '60', 694.00, 416.40, 277.60, '2020-03-12 07:09:13', '2020-03-12 07:09:13'),
(142, 118, 4, 'Sanitary module for standing WC, black', '1', '35', 694.00, 242.90, 451.10, '2020-03-12 07:09:13', '2020-03-12 07:09:13'),
(143, 119, 3, 'Sanitary module for wall hung WC, taupe', '1', '60', 947.00, 568.20, 378.80, '2020-03-12 07:10:14', '2020-03-12 07:10:14'),
(144, 119, 4, 'Sanitary module for standing WC, black', '1', '35', 947.00, 331.45, 615.55, '2020-03-12 07:10:14', '2020-03-12 07:10:14'),
(145, 119, 2, 'Sanitary module for wall hung WC, black', '1', '20', 947.00, 189.40, 757.60, '2020-03-12 07:10:14', '2020-03-12 07:10:14'),
(146, 120, 4, 'Sanitary module for standing WC, black', '1', '50', 694.00, 347.00, 347.00, '2020-03-12 07:15:58', '2020-03-12 07:15:58'),
(147, 120, 4, 'Sanitary module for standing WC, black', '1', '80', 694.00, 555.20, 138.80, '2020-03-12 07:15:58', '2020-03-12 07:15:58'),
(148, 121, 4, 'Sanitary module for standing WC, black', '1', '50', 694.00, 347.00, 347.00, '2020-03-12 07:16:10', '2020-03-12 07:16:10'),
(149, 121, 4, 'Sanitary module for standing WC, black', '1', '80', 694.00, 555.20, 138.80, '2020-03-12 07:16:10', '2020-03-12 07:16:10'),
(150, 122, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-16 08:01:07', '2020-03-16 08:01:07'),
(151, 122, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-16 08:01:07', '2020-03-16 08:01:07'),
(152, 123, 3, 'Sanitary module for wall hung WC, taupe', '1', '60', 694.00, 416.40, 277.60, '2020-03-17 06:56:16', '2020-03-17 06:56:16'),
(153, 123, 4, 'Sanitary module for standing WC, black', '1', '35', 694.00, 242.90, 451.10, '2020-03-17 06:56:16', '2020-03-17 06:56:16'),
(154, 124, 3, 'Sanitary module for wall hung WC, taupe', '1', '60', 694.00, 416.40, 277.60, '2020-03-17 06:56:53', '2020-03-17 06:56:53'),
(155, 124, 4, 'Sanitary module for standing WC, black', '1', '35', 694.00, 242.90, 451.10, '2020-03-17 06:56:53', '2020-03-17 06:56:53'),
(156, 3, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-17 06:58:43', '2020-03-17 06:58:43'),
(157, 3, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-17 06:58:43', '2020-03-17 06:58:43'),
(158, 125, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-17 07:03:18', '2020-03-17 07:03:18'),
(159, 125, 3, 'Sanitary module for wall hung WC, taupe', '1', '30', 694.00, 208.20, 485.80, '2020-03-17 07:03:18', '2020-03-17 07:03:18'),
(160, 126, 3, 'Sanitary module for wall hung WC, taupe', '1', '68', 694.00, 471.92, 222.08, '2020-03-20 03:43:21', '2020-03-20 03:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sanitary', NULL, NULL),
(2, 'piping', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customers_id` int(10) UNSIGNED DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refrence_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `project_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `validity` date DEFAULT NULL,
  `incoterm` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_cost` double(8,2) DEFAULT NULL,
  `status` enum('DRAFTED','PENDING','APPROVED','REJECTED') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `project_detail` text COLLATE utf8mb4_unicode_ci,
  `project_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strategic_reason` text COLLATE utf8mb4_unicode_ci,
  `competition` text COLLATE utf8mb4_unicode_ci,
  `chance_improvement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_schedule` date DEFAULT NULL,
  `distributor_margin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `assigned_to` tinytext COLLATE utf8mb4_unicode_ci,
  `approved_by` tinytext COLLATE utf8mb4_unicode_ci,
  `last_updated_by` int(11) DEFAULT NULL,
  `deleted_at` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT 'true',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `quotation_for`, `customers_id`, `currency`, `refrence_number`, `revision`, `project_name`, `remarks`, `validity`, `incoterm`, `payment`, `quotation_cost`, `status`, `reason`, `project_detail`, `project_location`, `strategic_reason`, `competition`, `chance_improvement`, `delivery_schedule`, `distributor_margin`, `created_by`, `assigned_to`, `approved_by`, `last_updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Project', 6, 'USD', 'IN/MA/20001', '0', 'Ranosys', 'Testing purpose', NULL, NULL, NULL, 970.00, 'APPROVED', 'Testing purpose', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '6,7', '6,7', 7, 'true', '2020-02-28 02:05:27', '2020-03-05 06:27:38'),
(2, 'Retail', 6, 'USD', 'IN/MA/20002', '0', 'Ranosys', 'Testing purpose', NULL, NULL, NULL, 662.00, 'PENDING', 'That is very bad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '6,7', NULL, NULL, 'true', '2020-02-28 02:05:29', '2020-03-05 00:52:02'),
(3, 'Project', 6, 'USD', 'IN/MA/20002', '1', 'Ranosys', 'Testing purpose', '2020-03-19', 'Ex-Work', 'Cash in Advance', 970.00, 'PENDING', 'Testing purpose', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '6,7', NULL, NULL, 'true', '2020-03-02 06:43:46', '2020-03-17 06:58:43'),
(5, 'Project', 1, 'SGD', 'QA/MA/20004', '0', 'United Supplies', 'Testing of PMS', NULL, NULL, NULL, 40.00, 'PENDING', 'Testing of PMS', 'Testing', 'Qutar', 'test', 'test', 'test', '2020-03-19', 'test', 3, '10,11', '10', 10, 'true', '2020-03-05 06:44:35', '2020-03-11 05:35:40'),
(6, 'Project', 6, 'USD', 'IN/MA/20006', '0', 'Rano Net', 'MD PMS PMP Testing', NULL, NULL, NULL, 222.00, 'REJECTED', 'testing puropose', 'TEST MD', 'test', 'test', 'test', 'test', '2020-03-25', 'test', 3, '10,11', NULL, 10, 'true', '2020-03-05 07:07:07', '2020-03-11 06:29:33'),
(11, 'Project', 1, 'SGD', 'QA/MA/200011', '0', 'UNITED', 'Testing', NULL, NULL, NULL, 303.00, 'REJECTED', 'hello g', 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', '2020-03-19', 'Testing', 3, '10,11', NULL, 10, 'true', '2020-03-05 07:17:55', '2020-03-11 06:31:21'),
(12, 'Project', 6, 'USD', 'IN/MA/20006', '2', 'Rano Net', 'MD PMS PMP Testing', NULL, NULL, NULL, 569.00, 'REJECTED', 'ab bilkul right g', 'TEST MD', 'test', 'test', 'test', 'test', '2020-03-25', 'test', 3, '10', NULL, 10, 'true', '2020-03-05 23:17:34', '2020-03-11 06:33:15'),
(13, 'Project', 6, 'USD', 'IN/MA/20006', '3', 'Rano Net', 'MD PMS PMP Testing', NULL, NULL, NULL, 569.00, 'APPROVED', 'MD PMS PMP Testing', 'TEST MD', 'test', 'test', 'test', 'test', '2020-03-25', 'test', 3, '10,12', '10,12', 12, 'true', '2020-03-05 23:19:15', '2020-03-11 06:05:01'),
(14, 'Project', 6, 'USD', 'IN/MA/20006', '4', 'Rano Net', 'MD PMS PMP Testing', NULL, NULL, NULL, 916.00, 'APPROVED', 'MD PMS PMP Testing', 'TEST MD', 'test', 'test', 'test', 'test', '2020-03-25', 'test', 3, '10,12', '10,12', 12, 'true', '2020-03-05 23:40:43', '2020-03-11 06:06:14'),
(60, 'Project', 6, 'USD', 'IN/KA/200015', '0', NULL, 'hyyy', NULL, NULL, NULL, 485.00, 'APPROVED', 'hyyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', '6,7', 7, 'true', '2020-03-06 06:35:27', '2020-03-17 03:16:23'),
(63, 'Project', 6, 'USD', 'IN/KA/200063', '0', NULL, 'hyyy', NULL, NULL, NULL, 485.00, 'PENDING', 'hyyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', '6', 6, 'true', '2020-03-06 06:43:28', '2020-03-17 03:13:33'),
(68, 'Project', 6, 'USD', 'IN/KA/200068', '0', NULL, 'hyyy', NULL, NULL, NULL, 485.00, 'REJECTED', 'for some reson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', NULL, 6, 'true', '2020-03-06 06:51:31', '2020-03-17 03:14:02'),
(69, 'Project', 6, 'USD', 'IN/KA/200069', '0', NULL, 'hyyy', NULL, NULL, NULL, 485.00, 'PENDING', 'hyyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', '6', 6, 'true', '2020-03-06 06:59:58', '2020-03-17 03:13:44'),
(74, 'Project', 6, 'USD', 'IN/KA/200074', '0', NULL, 'hyyy', NULL, NULL, NULL, 485.00, 'PENDING', 'hyyy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', '6', 6, 'true', '2020-03-06 07:18:56', '2020-03-17 03:15:24'),
(90, 'Retail', 6, 'USD', 'IN/KA/200090', '0', 'Ranosys', 'Hyy test', NULL, NULL, NULL, 555.00, 'PENDING', 'Hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6,7', NULL, NULL, 'true', '2020-03-11 00:37:49', '2020-03-11 00:37:58'),
(91, 'Project', 2, 'USD', 'BD/KA/200091', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 00:46:16', '2020-03-11 00:46:21'),
(92, 'Project', 2, 'USD', 'BD/KA/200092', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 00:56:19', '2020-03-11 00:56:24'),
(93, 'Project', 2, 'USD', 'BD/KA/200093', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 01:01:08', '2020-03-11 01:01:13'),
(94, 'Project', 2, 'USD', 'BD/KA/200094', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 01:05:53', '2020-03-11 01:05:58'),
(95, 'Project', 2, 'USD', 'BD/KA/200095', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 01:07:04', '2020-03-11 01:07:08'),
(96, 'Project', 2, 'USD', 'BD/KA/200096', '0', 'Evergreen', 'testing', NULL, NULL, NULL, 555.00, 'PENDING', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '6', NULL, NULL, 'true', '2020-03-11 01:09:35', '2020-03-11 01:09:39'),
(97, 'Project', 2, 'USD', 'BD/KA/200097', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:24:05', '2020-03-11 01:24:17'),
(98, 'Project', 2, 'USD', 'BD/KA/200098', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:25:40', '2020-03-11 01:25:53'),
(99, 'Project', 2, 'USD', 'BD/KA/200099', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:27:24', '2020-03-11 01:27:37'),
(100, 'Project', 2, 'USD', 'BD/KA/2000100', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:32:41', '2020-03-11 01:32:54'),
(101, 'Project', 2, 'USD', 'BD/KA/2000101', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:35:47', '2020-03-11 01:36:00'),
(102, 'Project', 2, 'USD', 'BD/KA/2000102', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:37:09', '2020-03-11 01:37:22'),
(103, 'Project', 2, 'USD', 'BD/KA/2000103', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:40:15', '2020-03-11 01:40:28'),
(104, 'Project', 2, 'USD', 'BD/KA/2000104', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:43:15', '2020-03-11 01:43:28'),
(105, 'Project', 2, 'USD', 'BD/KA/2000105', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:43:28', '2020-03-11 01:43:41'),
(106, 'Project', 2, 'USD', 'BD/KA/2000106', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 01:50:23', '2020-03-11 01:50:38'),
(107, 'Project', 2, 'USD', 'BD/KA/2000107', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:08:03', '2020-03-11 03:08:17'),
(108, 'Project', 2, 'USD', 'BD/KA/2000108', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:10:13', '2020-03-11 03:10:25'),
(109, 'Project', 2, 'USD', 'BD/KA/2000109', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:12:22', '2020-03-11 03:12:34'),
(110, 'Project', 2, 'USD', 'BD/KA/2000110', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:20:01', '2020-03-11 03:20:14'),
(111, 'Project', 2, 'USD', 'BD/KA/2000111', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:22:35', '2020-03-11 03:22:47'),
(112, 'Project', 2, 'USD', 'BD/KA/2000112', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:37:26', '2020-03-11 03:37:39'),
(113, 'Project', 2, 'USD', 'BD/KA/2000113', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:40:41', '2020-03-11 03:40:55'),
(114, 'Project', 2, 'USD', 'BD/KA/2000114', '0', 'Ever', 'hyy test', NULL, NULL, NULL, 694.00, 'PENDING', 'hyy test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '4,5,6', NULL, NULL, 'true', '2020-03-11 03:43:42', '2020-03-11 03:43:56'),
(118, 'Retail', 6, 'USD', 'IN/MA/2000118', '0', 'Last Testing', 'For the last test', NULL, NULL, NULL, 1269.00, 'PENDING', 'For the last test', 'Last Testing', 'India', 'Nothing', 'Nothing', 'Nothing', '2020-03-26', 'yes', 3, '10', NULL, NULL, 'true', '2020-03-12 07:09:13', '2020-03-12 07:09:17'),
(119, 'Retail', 1, 'SGD', 'QA/MA/2000119', '0', 'United Last Testing', 'For the last test', NULL, NULL, NULL, 1750.00, 'PENDING', 'For the last test', 'Last Testing', 'India', 'Nothing', 'Nothing', 'Nothing', '2020-03-26', 'yes', 3, '10,11', NULL, NULL, 'true', '2020-03-12 07:10:14', '2020-03-12 07:10:23'),
(120, 'Project', 6, 'USD', 'IN/MA/2000120', '0', 'Nice To Meet You', 'Good', NULL, NULL, NULL, 485.00, 'PENDING', 'Good', 'Nothing', 'Nope', 'Nope', 'Nope', 'Nope', '2020-03-24', 'nope', 3, '10', NULL, NULL, 'true', '2020-03-12 07:15:58', '2020-03-12 07:16:03'),
(121, 'Project', 6, 'USD', 'IN/MA/2000121', '0', 'Nice To Meet You', 'Good', NULL, NULL, NULL, 485.00, 'APPROVED', 'Good', 'Nothing', 'Nope', 'Nope', 'Nope', 'Nope', '2020-03-24', 'nope', 3, '10,12', '10,12', 12, 'true', '2020-03-12 07:16:10', '2020-03-12 07:23:28'),
(122, 'Project', 6, 'USD', 'IN/MA/20001', '5', 'Ranosys', 'Testing purpose', NULL, NULL, NULL, 970.00, 'PENDING', 'Testing purpose', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '6,7', NULL, NULL, 'true', '2020-03-16 08:01:07', '2020-03-16 08:01:07'),
(123, 'Retail', 6, 'USD', 'IN/MA/2000118', '6', 'Last Testing', 'For the last test', NULL, NULL, NULL, 728.00, 'PENDING', 'For the last test', 'Last Testing', 'India', 'Nothing', 'Nothing', 'Nothing', '2020-03-26', 'yes', 3, '10', NULL, NULL, 'true', '2020-03-17 06:56:16', '2020-03-17 06:56:16'),
(124, 'Retail', 6, 'USD', 'IN/MA/2000118', '7', 'Last Testing', 'For the last test', NULL, NULL, NULL, 728.00, 'PENDING', 'For the last test', 'Last Testing', 'India', 'Nothing', 'Nothing', 'Nothing', '2020-03-26', 'yes', 3, '10', NULL, NULL, 'true', '2020-03-17 06:56:53', '2020-03-17 06:56:53'),
(125, 'Project', 6, 'USD', 'IN/MA/20001', '8', 'Ranosys', 'Testing purpose', NULL, NULL, NULL, 970.00, 'DRAFTED', 'Testing purpose', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '6,7', NULL, NULL, 'true', '2020-03-17 07:03:18', '2020-03-17 07:03:18'),
(126, 'Project', 6, 'USD', 'IN/MA/20006', '5', 'Rano Net', 'MD PMS PMP Testing', NULL, NULL, NULL, 222.00, 'PENDING', 'MD PMS PMP Testing', 'TEST MD', 'test', 'test', 'test', 'test', '2020-03-25', 'test', 3, '10', NULL, NULL, 'true', '2020-03-20 03:43:21', '2020-03-20 03:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_1` int(11) NOT NULL,
  `discount_1` double(8,2) NOT NULL,
  `year_2` int(11) NOT NULL,
  `discount_2` double(8,2) NOT NULL,
  `year_3` int(11) NOT NULL,
  `discount_3` double(8,2) NOT NULL,
  `year_4` int(11) NOT NULL,
  `discount_4` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `discount`, `year_1`, `discount_1`, `year_2`, `discount_2`, `year_3`, `discount_3`, `year_4`, `discount_4`, `created_at`, `updated_at`) VALUES
(1, 'Project Developer', 'PD', NULL, 2020, 1.00, 2021, 2.00, 2022, 2.00, 2023, 1.00, NULL, '2020-03-16 07:36:14'),
(2, 'Super Admin', 'SA', '0-0', 2020, 1.00, 2021, 1.00, 2023, 2.00, 2024, 2.10, '2020-02-26 23:50:50', '2020-02-26 23:50:50'),
(3, 'General Manager', 'GM', '0-0', 2020, 1.00, 2021, 1.00, 2023, 2.00, 2024, 2.10, '2020-02-26 23:52:54', '2020-02-26 23:52:54'),
(4, 'Sales Engineer', 'SE', '0-50', 2025, 2.00, 2021, 1.00, 2020, 1.00, 2022, 2.10, '2020-02-26 23:53:37', '2020-02-26 23:58:05'),
(5, 'Sales Manager', 'SM', '0-50', 2025, 2.00, 2021, 1.00, 2020, 1.00, 2022, 2.10, '2020-02-26 23:54:01', '2020-02-26 23:58:45'),
(6, 'Country Manager', 'CM', '50.1-55', 2020, 2.00, 2021, 1.00, 2024, 1.00, 2022, 2.10, '2020-02-26 23:54:51', '2020-02-26 23:54:51'),
(7, 'Product Manager(OEM)', 'PMO', '55.1-65', 2020, 2.00, 2021, 2.00, 2022, 1.00, 2023, 2.10, '2020-02-26 23:56:31', '2020-02-26 23:56:31'),
(8, 'Product Manager(Sanitary)', 'PMS', '55.1-65', 2020, 2.00, 2021, 2.00, 2022, 1.00, 2023, 2.10, '2020-02-26 23:57:04', '2020-02-26 23:57:04'),
(9, 'Product Manager(Piping)', 'PMP', '55.1-65', 2020, 2.00, 2021, 2.00, 2022, 1.00, 2023, 2.10, '2020-02-26 23:57:19', '2020-02-26 23:57:19'),
(10, 'Managing Director', 'MD', '65.1-100', 2020, 1.00, 2021, 2.00, 2022, 3.00, 2023, 1.00, '2020-02-27 00:34:04', '2020-02-27 00:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `usercountries`
--

CREATE TABLE `usercountries` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `countries_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usercountries`
--

INSERT INTO `usercountries` (`id`, `user_id`, `countries_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2020-02-26 23:45:58', '2020-02-26 23:45:58'),
(2, 3, 3, '2020-02-26 23:45:58', '2020-02-26 23:45:58'),
(9, 5, 2, '2020-02-27 07:56:49', '2020-02-27 07:56:49'),
(10, 5, 1, '2020-02-27 07:56:49', '2020-02-27 07:56:49'),
(13, 7, 1, '2020-02-27 07:58:34', '2020-02-27 07:58:34'),
(14, 7, 5, '2020-02-27 07:58:34', '2020-02-27 07:58:34'),
(15, 8, 1, '2020-02-27 07:59:48', '2020-02-27 07:59:48'),
(16, 8, 5, '2020-02-27 07:59:49', '2020-02-27 07:59:49'),
(17, 9, 4, '2020-02-27 08:00:23', '2020-02-27 08:00:23'),
(20, 10, 1, '2020-02-27 08:02:02', '2020-02-27 08:02:02'),
(21, 10, 3, '2020-02-27 08:02:02', '2020-02-27 08:02:02'),
(22, 11, 3, '2020-02-27 08:04:58', '2020-02-27 08:04:58'),
(23, 11, 2, '2020-02-27 08:04:58', '2020-02-27 08:04:58'),
(26, 6, 2, '2020-02-28 01:30:14', '2020-02-28 01:30:14'),
(27, 6, 1, '2020-02-28 01:30:14', '2020-02-28 01:30:14'),
(28, 13, 6, '2020-03-11 08:02:36', '2020-03-11 08:02:36'),
(32, 17, 2, '2020-03-12 06:29:41', '2020-03-12 06:29:41'),
(37, 12, 2, '2020-03-16 07:41:07', '2020-03-16 07:41:07'),
(38, 12, 1, '2020-03-16 07:41:07', '2020-03-16 07:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `saluation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` bigint(11) NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `saluation`, `name`, `abbreviation`, `email`, `email_verified_at`, `password`, `remember_token`, `contact_number`, `profile_picture`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'Miss.', 'Madhu Acharya', 'MA', 'madhu.acharya@ranosys.com', NULL, '$2y$10$Ug0uj0Z9875wJmM04lNu5uvy8uamvg.Y9vP7cGHa6PQdJxN.E9sP.', NULL, 7014652475, '1459817789.jpg', 'Deactive', 1, NULL, '2020-03-17 06:24:07'),
(5, 'Mr.', 'Aayushi Gupta', 'AG', 'madhu.acharya+02@ranosys.com', NULL, '$2y$10$.35dyf7ADk3Oby.IW9hvnep2QlYUr7pdiBzgXI.KOwqhAhQGORUYa', NULL, 7014652475, '948925709.png', 'Active', 3, '2020-02-27 07:56:49', '2020-03-17 06:07:39'),
(6, 'Mr.', 'Atul Tiwari', 'AT', 'madhu.acharya+03@ranosys.com', NULL, '$2y$10$YHTR5EYS2Ek4BK8X1wCRm.WDNZMqZj3PADVIQeVhw18wH5nmJaIZW', NULL, 7014652475, '1913284921.jpg', 'Deactive', 4, '2020-02-27 07:57:44', '2020-03-17 06:03:50'),
(7, 'Miss', 'Pooja Dassani', 'PD', 'madhu.acharya+04@ranosys.com', NULL, '$2y$10$7Tbe4SkYe0h3BFaeMU6tfeuG8ga9ylUGYL6hTMX5Lo.HL4L5YAaNW', NULL, 7014652475, '812882354.png', 'Active', 5, '2020-02-27 07:58:34', '2020-03-17 06:04:06'),
(8, 'Miss', 'Harsh Kumar', 'HK', 'harsh.gehlot@ranosys.com', NULL, '$2y$10$qy4WIywYJ4oSq0tA/ncgL.SAs5dFs4R2yjU6hKV2zMaZGigIPTq4C', NULL, 7014652475, '1254636717.png', 'Active', 6, '2020-02-27 07:59:48', '2020-03-17 06:04:03'),
(9, 'Miss', 'Rahul Kumar', 'RK', 'madhu.acharya+05@ranosys.com', NULL, '$2y$10$3Xx2qNWhlSLH1fq.fvYcN.PGXH8AF68uSiiq5E7GgCFrbDh9C/kBG', NULL, 7014652475, '2057375064.png', 'Active', 7, '2020-02-27 08:00:23', '2020-02-27 08:00:23'),
(10, 'Miss', 'Monu Acharya', 'MA', 'madhu.acharya+06@ranosys.com', NULL, '$2y$10$eWz245INMDJ27urGo55M7eKqKqzAxB/vyh1JlyTVtyTKqVRSRWziC', NULL, 7014652475, '1887104324.png', 'Active', 8, '2020-02-27 08:01:24', '2020-03-18 01:49:09'),
(11, 'Miss', 'Dolly Acharya', 'DA', 'madhu.acharya+07@ranosys.com', NULL, '$2y$10$YHTR5EYS2Ek4BK8X1wCRm.WDNZMqZj3PADVIQeVhw18wH5nmJaIZW', NULL, 7014652475, '1101039211.jpg', 'Active', 9, '2020-02-27 08:04:58', '2020-02-27 08:04:58'),
(12, 'Mr.', 'Kailash Acharya', 'KA', 'madhu.acharya+08@ranosys.com', NULL, '$2y$10$rw.Hu79Xeuqb8bzH0hcUk.QLgfji5JpzqzExGbCIA//q.Nz4cFNDK', NULL, 7014652475, '1446826585.jpg', 'Active', 10, '2020-02-27 08:05:40', '2020-03-16 07:41:07'),
(13, 'Mr.', 'Aayushi Gupta', 'AG', 'madhu@gmail.com', NULL, '$2y$10$WL5NPEf4LHNibLU9R/mQyekK9yT0VX8jjIOujYIoZxljHsuERKMZy', NULL, 7014652475, '1202026816.png', 'Active', 3, '2020-03-11 08:02:36', '2020-03-11 08:02:36'),
(17, 'Mr.', 'Nilesh Gupta', 'NG', 'madhu.acharya+9@ranosys.com', NULL, '$2y$10$66fFmrp/Hccb35QolH5oS.KkRkR/LvX4G5stAHYRytX.5HCUx99KC', NULL, 7014652475, '58322017.jpeg', 'Deactive', 5, '2020-03-12 06:29:41', '2020-03-17 06:05:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_countries_id_foreign` (`countries_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_countries_id_foreign` (`countries_id`),
  ADD KEY `products_product_types_id_foreign` (`product_types_id`);

--
-- Indexes for table `product_quotations`
--
ALTER TABLE `product_quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_quotations_products_id_foreign` (`products_id`),
  ADD KEY `product_quotations_quotations_id_foreign` (`quotations_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotations_customers_id_foreign` (`customers_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usercountries`
--
ALTER TABLE `usercountries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usercountries_countries_id_foreign` (`countries_id`),
  ADD KEY `usercountries_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_quotations`
--
ALTER TABLE `product_quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usercountries`
--
ALTER TABLE `usercountries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_product_types_id_foreign` FOREIGN KEY (`product_types_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_quotations`
--
ALTER TABLE `product_quotations`
  ADD CONSTRAINT `product_quotations_products_id_foreign` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_quotations_quotations_id_foreign` FOREIGN KEY (`quotations_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_customers_id_foreign` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `usercountries`
--
ALTER TABLE `usercountries`
  ADD CONSTRAINT `usercountries_countries_id_foreign` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usercountries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
