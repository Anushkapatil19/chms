-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2024 at 05:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardiovascular_system_assessments`
--

CREATE TABLE `cardiovascular_system_assessments` (
  `id` int NOT NULL,
  `case_number` int NOT NULL,
  `breathlessness` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `abdominal_distension` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `swelling` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `swelling_duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `anomaly_scanning` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `anomaly_report` text COLLATE utf8mb4_general_ci,
  `respiratory_rate` int NOT NULL,
  `pulse_rate` int NOT NULL,
  `blood_pressure` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `spO2` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `central_nervous_system_assessments`
--

CREATE TABLE `central_nervous_system_assessments` (
  `id` int NOT NULL,
  `case_number` int NOT NULL,
  `duration_of_illness` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `condition_in_family` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `previous_medicine` text COLLATE utf8mb4_general_ci,
  `medicine_names` text COLLATE utf8mb4_general_ci,
  `food_intake_past_hours` text COLLATE utf8mb4_general_ci NOT NULL,
  `intoxication_duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `abnormal_movement` text COLLATE utf8mb4_general_ci NOT NULL,
  `movement_duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_notes`
--

CREATE TABLE `doctor_notes` (
  `id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `case_number` int DEFAULT NULL,
  `case_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `comments` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint NOT NULL,
  `case_number` int NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('Male','Female','Other') COLLATE utf8mb4_general_ci NOT NULL,
  `dob` date NOT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `report` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perabdominal_assessments`
--

CREATE TABLE `perabdominal_assessments` (
  `id` int NOT NULL,
  `case_number` int NOT NULL,
  `duration_of_illness` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `condition_in_family` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `previous_medicine` text COLLATE utf8mb4_general_ci,
  `medicine_names` text COLLATE utf8mb4_general_ci,
  `consciousness_state` enum('Conscious','Oriented','Disoriented','Completely unconscious') COLLATE utf8mb4_general_ci NOT NULL,
  `complaint` text COLLATE utf8mb4_general_ci NOT NULL,
  `complaint_duration` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `similar_episode` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `similar_in_siblings` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `past_urine_stool` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `urine_stool_frequency` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `abdominal_swelling` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `abdominal_distention` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `abdominal_girth` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vomiting` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `vomiting_frequency` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vomiting_type` enum('Projectile','Non-projectile') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vomiting_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `loose_motion` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `loose_motion_blood` enum('Yes','No') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `loose_motion_color` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pulse_rate` int NOT NULL,
  `respiratory_rate` int NOT NULL,
  `spO2` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `respiratory_system_assessments`
--

CREATE TABLE `respiratory_system_assessments` (
  `id` int NOT NULL,
  `case_number` int NOT NULL,
  `age` int NOT NULL,
  `respiratory_rate` int NOT NULL,
  `heart_rate` int NOT NULL,
  `child_state` enum('Conscious','Subconscious','Alert','Disorient') COLLATE utf8mb4_general_ci NOT NULL,
  `taking_feed` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `irritable` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `duration_of_illness` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `symptom_trend` enum('Increasing','Decreasing') COLLATE utf8mb4_general_ci NOT NULL,
  `similar_episode` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `condition_in_siblings` enum('Yes','No') COLLATE utf8mb4_general_ci NOT NULL,
  `previous_medicine` text COLLATE utf8mb4_general_ci,
  `medicine_names` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL COMMENT '1.Admin, 2.subuser, 3.docter',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `type`, `created_at`) VALUES
(1, 'user', 'user@gmail.com', 'user@123', 2, '2024-09-19 20:02:59'),
(2, 'Admin', 'admin@gmail.com', 'admin@123', 1, '2024-09-19 20:02:59'),
(3, 'Doctor', 'doctor@gmail.com', 'doctor@123', 3, '2024-09-19 20:02:59'),
(4, 'Sundarraj', 'sundarark@gmail.com', 'Sundar@123', 2, '2024-09-19 20:02:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardiovascular_system_assessments`
--
ALTER TABLE `cardiovascular_system_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_number` (`case_number`);

--
-- Indexes for table `central_nervous_system_assessments`
--
ALTER TABLE `central_nervous_system_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_number` (`case_number`);

--
-- Indexes for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_number` (`case_number`),
  ADD KEY `user_id` (`doctor_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_number` (`case_number`);

--
-- Indexes for table `perabdominal_assessments`
--
ALTER TABLE `perabdominal_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_number` (`case_number`);

--
-- Indexes for table `respiratory_system_assessments`
--
ALTER TABLE `respiratory_system_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_case_number` (`case_number`);

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
-- AUTO_INCREMENT for table `cardiovascular_system_assessments`
--
ALTER TABLE `cardiovascular_system_assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `central_nervous_system_assessments`
--
ALTER TABLE `central_nervous_system_assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perabdominal_assessments`
--
ALTER TABLE `perabdominal_assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `respiratory_system_assessments`
--
ALTER TABLE `respiratory_system_assessments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cardiovascular_system_assessments`
--
ALTER TABLE `cardiovascular_system_assessments`
  ADD CONSTRAINT `cardiovascular_system_assessments_ibfk_1` FOREIGN KEY (`case_number`) REFERENCES `patients` (`case_number`);

--
-- Constraints for table `central_nervous_system_assessments`
--
ALTER TABLE `central_nervous_system_assessments`
  ADD CONSTRAINT `central_nervous_system_assessments_ibfk_1` FOREIGN KEY (`case_number`) REFERENCES `patients` (`case_number`);

--
-- Constraints for table `doctor_notes`
--
ALTER TABLE `doctor_notes`
  ADD CONSTRAINT `doctor_notes_ibfk_1` FOREIGN KEY (`case_number`) REFERENCES `patients` (`case_number`),
  ADD CONSTRAINT `doctor_notes_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `perabdominal_assessments`
--
ALTER TABLE `perabdominal_assessments`
  ADD CONSTRAINT `perabdominal_assessments_ibfk_1` FOREIGN KEY (`case_number`) REFERENCES `patients` (`case_number`);

--
-- Constraints for table `respiratory_system_assessments`
--
ALTER TABLE `respiratory_system_assessments`
  ADD CONSTRAINT `fk_case_number` FOREIGN KEY (`case_number`) REFERENCES `patients` (`case_number`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
