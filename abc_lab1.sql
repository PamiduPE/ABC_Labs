-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 11:53 AM
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
-- Database: `abc_lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `test_type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('accepted','declined','pending') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `date`, `time`, `test_type`, `created_at`, `status`, `note`) VALUES
(1, 1, '2024-03-20', '01:42:00', 'mri', '2024-03-17 05:09:45', 'declined', 'sorry MRI machine is not available right now'),
(2, 1, '2024-03-21', '03:54:00', 'mri', '2024-03-17 06:22:05', 'declined', 'dd'),
(3, 4, '2024-03-13', '12:49:00', 'blood', '2024-03-17 07:15:25', 'accepted', 'Dear customer,your appointment schedule changed to 2024/03/14 at 10:AM'),
(4, 4, '2024-03-13', '12:50:00', 'mri', '2024-03-17 07:15:40', 'declined', ''),
(5, 4, '2024-03-28', '13:59:00', 'urine', '2024-03-17 08:25:28', 'accepted', ''),
(6, 7, '2024-03-13', '02:18:00', 'Blood Test', '2024-03-21 05:45:00', 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_test_results`
--

CREATE TABLE `blood_test_results` (
  `id` int(11) NOT NULL,
  `lab_report_id` int(11) NOT NULL,
  `blood_sugar` decimal(10,2) DEFAULT NULL,
  `rbc_count` decimal(10,2) DEFAULT NULL,
  `platelet_count` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lab_report`
--

CREATE TABLE `lab_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `report_file` varchar(255) DEFAULT NULL,
  `doctor_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_report`
--

INSERT INTO `lab_report` (`id`, `user_id`, `test_type`, `created_at`, `report_file`, `doctor_response`) VALUES
(1, 1, 'Blood Test', '2024-03-22 21:19:29', '', 'dfsvsd'),
(2, 6, 'Urine Test', '2024-03-22 21:25:52', '', 'xgvsxdvsd'),
(3, 5, 'Blood Test', '2024-03-22 21:32:18', NULL, 'uhhihu'),
(4, 9, 'Urine Test', '2024-03-22 21:35:07', '1711143307_technical documentation for developers section.pdf', 'sda'),
(5, 9, 'Urine Test', '2024-03-22 21:39:36', '1711143576_technical documentation for developers section.pdf', 'sd'),
(6, 7, 'Blood Test', '2024-03-22 21:39:53', '1711143593_technical documentation for developers section.pdf', 'Your blood sugar is normal '),
(7, 1, 'Blood Test', '2024-03-23 08:46:02', '1711183562_selenium tutorial 01.pdf', 'Your blood sugar is normal '),
(8, 8, 'Blood Test', '2024-03-24 17:55:00', '1711302900_technical documentation for developers section-1.pdf', NULL),
(9, 7, 'Blood Test', '2024-03-25 07:35:47', '1711352147_technical documentation for developers section-1.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab_reports`
--

CREATE TABLE `lab_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `test_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `technician_id` int(11) DEFAULT NULL,
  `report_file` varchar(255) NOT NULL,
  `doctor_response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `urine_test_results`
--

CREATE TABLE `urine_test_results` (
  `id` int(11) NOT NULL,
  `lab_report_id` int(11) NOT NULL,
  `glucose_level` decimal(10,2) DEFAULT NULL,
  `protein_level` decimal(10,2) DEFAULT NULL,
  `nitrite_level` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('patient','doctor','technician') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `created_at`, `updated_at`, `email`, `profile_picture`) VALUES
(1, 'emma', '$2y$10$BH0Z/JIT3aEi/mqWVciAVeQKTI/DA/Hv9lsJxDUJ/SIwlhgva/0Um', 'patient', '2024-03-17 05:07:28', '2024-03-17 05:07:28', 'nxjejsjnrjdfn@gmail.com', NULL),
(2, 'kipi', '$2y$10$DlGW/oUO.9eakRl1vpASEOr9Zn2EYyq5N08nqNIJVu0tsnP9W79D.', 'patient', '2024-03-17 06:34:45', '2024-03-17 06:34:45', 'nxjejsjnrjdfn@gmail.com', 'uploads/416170764_869246395209198_5361834734286765397_n.jpg'),
(3, 'lisa', '$2y$10$jyirvDn3WBk/tFaFKKUVA.vGE/l9.5uJOch8P8e8Ck25lR65bIqSq', 'patient', '2024-03-17 06:43:41', '2024-03-17 06:43:41', 'lisa@gmai.c', 'uploads/353907076_6382043441903224_7437373217188453790_n.jpg'),
(4, 'pipi', '$2y$10$mGJQQTdSZ8X9p07CHzjw2./cVMR8wNk0PmmbiAtJyXD.oKZXJdXbG', 'patient', '2024-03-17 06:59:38', '2024-03-17 06:59:38', 'nxjejsjnrjdfn@gmail.com', 'uploads/302170347_637130904427613_2579308129937602932_n.jpg'),
(5, 'julie', '$2y$10$sOVMS3UESQ6e0Qp/cfS8ZOov/ct0GlgKkUZXxqOqpyNXrRj7P5NES', 'patient', '2024-03-17 08:33:01', '2024-03-17 08:33:01', 'nxjejsjnrjdfn@gmail.com', 'uploads/426635940_919208149712622_3780588927874722178_n(1).jpg'),
(6, 'loli', '$2y$10$LDtQcw6fEbfn16klfGd1V.nEsi0nOC2FudTFa./0MHGsid5rqvLNG', 'patient', '2024-03-17 13:02:32', '2024-03-17 13:02:32', 'nxjejsjnrjdfn@gmail.com', 'uploads/422590814_726972202743820_4883662661153844087_n.jpg'),
(7, 'loli1', '$2y$10$hJjRcBYcjOW0I.KauUZZNOZ.TPzSW.pLB2pXB1tK2.SW14Q4iBoMG', 'patient', '2024-03-17 13:05:33', '2024-03-17 13:05:33', 'nxjejsjnrjdfn@gmail.com', 'uploads/422590814_726972202743820_4883662661153844087_n.jpg'),
(8, 'emili', '$2y$10$o3nWKZ4qCywTpUek4G1AMevp6NGjTRJ.ouwMoojYog3JCKv2.Bvjy', 'patient', '2024-03-17 13:20:58', '2024-03-17 13:20:58', 'nxjejsjnrjdfn@gmail.com', 'uploads/281887646_410772870895339_7453308616289492115_n.jpg'),
(9, 'jenny', '$2y$10$/7WMXz9PPff.1UyV8Ff2yeEXkge0K0.GXxfS7dVfn1Nqtpl22Mk5.', 'technician', '2024-03-17 13:21:20', '2024-03-17 13:21:20', 'nxjejsjnrjdfn@gmail.com', 'uploads/281887646_410772870895339_7453308616289492115_n.jpg'),
(10, 'nikitha', '$2y$10$MbLCN9mSIfCF.0lVze7Q2urh2oRTBN4hQo.0i6547eWuBY2F5qKLC', 'patient', '2024-03-18 08:26:41', '2024-03-18 08:26:41', 'kylie@gmail.com', 'uploads/403901826_3682363791995906_7448272981944797863_n(2).jpg'),
(11, 'emi', '$2y$10$jxZvCJLWlZFhJET/jw8uDeSZUAUBgwHq5ea.TfJwJ2Msnm37mU3hu', 'doctor', '2024-03-24 14:56:55', '2024-03-24 14:57:06', 'nxjejsjnrjdfn@gmail.com', 'uploads/426635940_919208149712622_3780588927874722178_n(2).jpg'),
(12, 'mariooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo', '$2y$10$ja7eiKQZG1IzGwgf8c38QODsZL1oaCnzSSewz8OkMNbCtjM9LbLPu', 'patient', '2024-03-25 08:30:11', '2024-03-25 08:30:11', 'nxjejsjnrjdfn@gmail.com', 'uploads/403901826_3682363791995906_7448272981944797863_n(2).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `blood_test_results`
--
ALTER TABLE `blood_test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_report_id` (`lab_report_id`);

--
-- Indexes for table `lab_report`
--
ALTER TABLE `lab_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `technician_id` (`technician_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urine_test_results`
--
ALTER TABLE `urine_test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_report_id` (`lab_report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_test_results`
--
ALTER TABLE `blood_test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lab_report`
--
ALTER TABLE `lab_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lab_reports`
--
ALTER TABLE `lab_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `urine_test_results`
--
ALTER TABLE `urine_test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blood_test_results`
--
ALTER TABLE `blood_test_results`
  ADD CONSTRAINT `blood_test_results_ibfk_1` FOREIGN KEY (`lab_report_id`) REFERENCES `lab_reports` (`id`);

--
-- Constraints for table `lab_report`
--
ALTER TABLE `lab_report`
  ADD CONSTRAINT `lab_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lab_reports`
--
ALTER TABLE `lab_reports`
  ADD CONSTRAINT `lab_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lab_reports_ibfk_2` FOREIGN KEY (`technician_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `urine_test_results`
--
ALTER TABLE `urine_test_results`
  ADD CONSTRAINT `urine_test_results_ibfk_1` FOREIGN KEY (`lab_report_id`) REFERENCES `lab_reports` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
