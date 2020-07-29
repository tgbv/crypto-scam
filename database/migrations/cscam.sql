-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2020 at 09:48 PM
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
-- Table structure for table `cry_fps_list`
--

CREATE TABLE `cry_fps_list` (
  `address_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `client_ip` varchar(45) CHARACTER SET ascii NOT NULL,
  `client_agent` varchar(2047) CHARACTER SET ascii NOT NULL,
  `pending` tinyint(1) NOT NULL DEFAULT 1,
  `state` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cry_list`
--

CREATE TABLE `cry_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `report_id` int(10) UNSIGNED NOT NULL,
  `address_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `address` varchar(2047) CHARACTER SET ascii NOT NULL,
  `state` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cry_reports`
--

CREATE TABLE `cry_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `addresses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`addresses`)),
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `client_ip` varchar(45) CHARACTER SET ascii NOT NULL,
  `client_agent` varchar(2047) CHARACTER SET ascii NOT NULL,
  `pending` tinyint(1) NOT NULL DEFAULT 1,
  `state` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cry_fps_list`
--
ALTER TABLE `cry_fps_list`
  ADD KEY `address_id` (`address_id`);
ALTER TABLE `cry_fps_list` ADD FULLTEXT KEY `client_ip` (`client_ip`);
ALTER TABLE `cry_fps_list` ADD FULLTEXT KEY `client_agent` (`client_agent`);

--
-- Indexes for table `cry_list`
--
ALTER TABLE `cry_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `address` (`address`),
  ADD KEY `report_id` (`report_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `cry_reports`
--
ALTER TABLE `cry_reports`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_ip` (`client_ip`);
ALTER TABLE `cry_reports` ADD FULLTEXT KEY `client_agent` (`client_agent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cry_list`
--
ALTER TABLE `cry_list`
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
