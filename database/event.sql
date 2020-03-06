-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 02:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$BQXEaBYF/vOovQLCxV4zX.94oG14G1cANy905E4F30fsN.qW79/a2', '2020-02-17 15:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_b2b`
--

CREATE TABLE `tbl_b2b` (
  `id` int(11) NOT NULL,
  `register_id` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `expectation` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(225) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `register_id` varchar(255) NOT NULL,
  `address1` text NOT NULL,
  `designation` varchar(255) NOT NULL,
  `organisation` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `organisation_turnover` varchar(255) NOT NULL,
  `organisation_profile` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `activation_status` varchar(255) NOT NULL,
  `delegates_category` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pin` varchar(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `government_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fname`, `mname`, `lname`, `mobile`, `email`, `register_id`, `address1`, `designation`, `organisation`, `photo`, `sector`, `organisation_turnover`, `organisation_profile`, `address2`, `activation_status`, `delegates_category`, `created_at`, `city`, `state`, `pin`, `country`, `government_id`) VALUES
(59, 'Jitumani', '', 'Bhagabati', '8876072223', 'jitumani.b@mobisofttech.co.in', 'AHSXXXXXXXX315', 'F Fort Building', 'System Engineer', 'Mobisoft Technology', '', 'Agri Business Consultants / IT services', '500000', 'IT Services', 'Lachit Nagar', '0', 'Blue', '2020-02-18 14:38:22', 'Guwahati', 'Assam', '781310', 'India', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_b2b`
--
ALTER TABLE `tbl_b2b`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `register_id` (`register_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `register_id` (`register_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_b2b`
--
ALTER TABLE `tbl_b2b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
