-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2020 at 12:05 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cscam`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_pending_user_confirmations`
--

CREATE TABLE `acc_pending_user_confirmations` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `passphrase` text CHARACTER SET ascii NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_suspended_users`
--

CREATE TABLE `acc_suspended_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_users`
--

CREATE TABLE `acc_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(128) CHARACTER SET ascii COLLATE ascii_general_nopad_ci NOT NULL,
  `phone` varchar(128) CHARACTER SET ascii COLLATE ascii_general_nopad_ci NOT NULL,
  `password` varchar(90) CHARACTER SET ascii COLLATE ascii_general_nopad_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acc_user_role`
--

CREATE TABLE `acc_user_role` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cry_addresses`
--

CREATE TABLE `cry_addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `address` varchar(2047) CHARACTER SET ascii NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cry_reports`
--

CREATE TABLE `cry_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `client_ip` varchar(45) CHARACTER SET ascii DEFAULT NULL,
  `client_agent` varchar(2047) CHARACTER SET ascii DEFAULT NULL,
  `client_fingerprint` varchar(40) CHARACTER SET armscii8 DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cry_report_address`
--

CREATE TABLE `cry_report_address` (
  `report_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Table structure for table `acc_password_resets`
--

CREATE TABLE `acc_password_resets` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `passphrase` text CHARACTER SET armscii8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_pending_user_confirmations`
--
ALTER TABLE `acc_pending_user_confirmations`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `acc_suspended_users`
--
ALTER TABLE `acc_suspended_users`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `acc_users`
--
ALTER TABLE `acc_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `acc_user_role`
--
ALTER TABLE `acc_user_role`
  ADD KEY `user_id` (`user_id`,`role_id`);

--
-- Indexes for table `cry_addresses`
--
ALTER TABLE `cry_addresses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `cry_reports`
--
ALTER TABLE `cry_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_fingerprint` (`client_fingerprint`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_ip` (`client_ip`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_agent` (`client_agent`);

--
-- Indexes for table `cry_report_address`
--
ALTER TABLE `cry_report_address`
  ADD KEY `address_id` (`address_id`),
  ADD KEY `report_id` (`report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_users`
--
ALTER TABLE `acc_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cry_addresses`
--
ALTER TABLE `cry_addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cry_reports`
--
ALTER TABLE `cry_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Indexes for table `acc_password_resets`
--
ALTER TABLE `acc_password_resets`
  ADD PRIMARY KEY (`user_id`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
