-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 03:10 PM
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
  `client_fingerprint` varchar(40) CHARACTER SET ascii NOT NULL,
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
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_ip` (`client_ip`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_agent` (`client_agent`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_fingerprint` (`client_fingerprint`);
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
