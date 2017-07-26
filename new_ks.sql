-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2017 at 08:37 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_ks`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sayuran', 'Sayuran', '2017-02-12 22:47:46', '2017-02-12 22:47:46'),
(2, 'Buah', 'Buah-buahan', '2017-02-12 22:47:53', '2017-02-12 22:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_type` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `highlight`
--

CREATE TABLE `highlight` (
  `id` int(10) UNSIGNED NOT NULL,
  `highlight_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `highlight_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `highlight`
--

INSERT INTO `highlight` (`id`, `highlight_name`, `highlight_color`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sayuran', '#B8F612', 'Sayuran', '2017-02-12 22:48:35', '2017-02-12 22:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_date` date NOT NULL,
  `voucher` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_code`, `invoice_date`, `customer_name`, `customer_phone`, `customer_address_1`, `customer_address_2`, `customer_address_3`, `payment_method`, `shipping_date`, `voucher`, `description`, `description_2`, `is_paid`, `total`, `created_at`, `updated_at`) VALUES
(1, 'RU/1/1', '2017-02-13', 'GHAZI', '083870451820', 'Jl. Anggrek 2 RT01/04', 'Meruya Utara', 'Jakarta Barat', '2', '2017-02-14', 0, 'test', 'test', 0, 0, '2017-02-12 22:56:17', '2017-02-12 22:56:17'),
(2, 'RU/1/1', '2017-02-13', 'Annazmy', '083870451821', 'Jl. Anggrek 2 RT01/04', 'Meruya Utara', 'Jakarta Barat', '2', '2017-02-14', 0, 'test', 'test', 0, 0, '2017-02-12 22:58:33', '2017-02-12 22:58:33'),
(3, 'RU/1/1', '2017-02-14', 'ARHAB', '083870451820', 'TEST', 'TEST', 'TEST', '1', '2017-02-15', 0, 'TEST', 'TEST', 0, 0, '2017-02-12 23:51:22', '2017-02-12 23:51:22'),
(4, 'RU/1/2', '2017-02-13', 'Ghazi Fadil Ramadhan', '083870451820', 'Jl. Anggrek 2 RT01/04', 'Meruya Utara', 'Jakarta Barat', '1', '2017-02-14', 0, 'Test', 'Test', 0, 0, '2017-02-13 04:41:50', '2017-02-13 04:41:50'),
(5, 'RU/1/2', '2017-02-13', 'Ghazi Fadil Ramadhan', '083870451820', 'Jl. Anggrek 2 RT01/04', 'Meruya Utara', 'Jakarta Barat', '1', '2017-02-14', 0, 'Test', 'Test', 0, 0, '2017-02-13 04:42:12', '2017-02-13 04:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_code`
--

CREATE TABLE `invoice_code` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_code_1` int(11) NOT NULL,
  `invoice_code_2` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_code`
--

INSERT INTO `invoice_code` (`id`, `sku`, `invoice_code_1`, `invoice_code_2`, `date`, `created_at`, `updated_at`) VALUES
(1, 'RU', 1, 2, '2017-02-13', NULL, '2017-02-13 04:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `onqty` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `real_price` double NOT NULL,
  `highlight_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name`, `category_id`, `unit_id`, `price`, `onqty`, `description`, `real_price`, `highlight_id`, `created_at`, `updated_at`) VALUES
(1, 'Bayam', 1, 1, 5000, 500, 'Bayam', 10, 1, '2017-02-12 22:48:59', '2017-02-12 22:48:59'),
(2, 'Brokoli', 1, 1, 10000, 500, 'Brokoli', 20, 1, '2017-02-13 20:15:58', '2017-02-13 20:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_02_11_023134_create_table_category', 1),
(4, '2017_02_11_023931_create_table_unit', 1),
(5, '2017_02_11_024103_create_table_highlight', 1),
(6, '2017_02_11_024615_create_table_item', 1),
(7, '2017_02_11_025939_create_table_payment_method', 1),
(8, '2017_02_12_111600_create_table_invoice_code', 1),
(9, '2017_02_12_111856_create_table_invoice', 1),
(10, '2017_02_12_125442_create_table_customer', 1),
(11, '2017_02_12_125727_create_table_customer_type', 1),
(12, '2017_02_12_130154_modify_table_customer', 1),
(13, '2017_02_12_141015_create_table_voucher', 1),
(14, '2017_02_12_142428_modify_table_voucher', 1),
(15, '2017_02_13_033453_modify_table_users', 2),
(16, '2017_02_13_045958_modify_table_users_2', 3),
(17, '2017_02_13_115912_create_table_transaction', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Bank Transfer', 'Bank Transfer', NULL, NULL),
(2, 'Bayar Ditempat', 'Bayar Ditempat', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_qty` double NOT NULL DEFAULT '0',
  `discount` float DEFAULT NULL,
  `deduction` float DEFAULT NULL,
  `item_price` float NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Gram', 'Gram', '2017-02-12 22:48:01', '2017-02-12 22:48:01'),
(2, 'Kilogram', 'Kilogram', '2017-02-12 22:48:10', '2017-02-12 22:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `level`, `username`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$oTnSnYc8wkfhmqVBawUOu.BxN0EatoN81zt3jeZ2Gv4Pfa7SlUQhW', 'J76Rsi7DWZOPNOsvUnEAXGWCCBYrkvsI9zlEDN4u4pUEUUpGje95HZKCoz1c', '2017-02-12 21:44:23', '2017-02-13 04:24:41', 3, 'admin'),
(5, 'Ghazi Fadil Ramadhan', 'ghaziradhan@gmail.com', '$2y$10$CkQHD.P17LU3wbSnhQxvgOFyMG9MYM2hyDNiDYVX9S2u1zGAdaKUy', 'ZTIQSDMDRfzcMi5w4OYsW0xjUaTWgQhJDQrzpX0opIsRoK3Ssywej671YzlF', '2017-02-13 04:24:38', '2017-02-13 05:14:18', 1, 'ghazi');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `credit` double NOT NULL,
  `is_used` tinyint(1) NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_debit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_customer_type_foreign` (`customer_type`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `highlight`
--
ALTER TABLE `highlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_code`
--
ALTER TABLE `invoice_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_category_id_foreign` (`category_id`),
  ADD KEY `item_unit_id_foreign` (`unit_id`),
  ADD KEY `item_highlight_id_foreign` (`highlight_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_invoice_id_foreign` (`invoice_id`),
  ADD KEY `transaction_item_id_foreign` (`item_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voucher_customer_id_foreign` (`customer_id`),
  ADD KEY `voucher_invoice_id_foreign` (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `highlight`
--
ALTER TABLE `highlight`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `invoice_code`
--
ALTER TABLE `invoice_code`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_customer_type_foreign` FOREIGN KEY (`customer_type`) REFERENCES `customer_type` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `item_highlight_id_foreign` FOREIGN KEY (`highlight_id`) REFERENCES `highlight` (`id`),
  ADD CONSTRAINT `item_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  ADD CONSTRAINT `transaction_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `voucher_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `voucher_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
