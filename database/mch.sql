-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 06:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mch`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `appointment_date` datetime DEFAULT NULL,
  `status` enum('pending','approved','cancelled') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `mother_id`, `doctor_id`, `appointment_date`, `status`, `notes`) VALUES
(8, 8, 4, '2025-04-14 03:16:00', 'approved', 'So noqosha 7 maalin kadib'),
(9, 6, 7, '2025-04-14 03:28:00', 'cancelled', 'balan');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_time` time DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `complications` text DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `mother_id`, `name`, `birth_date`, `birth_time`, `weight`, `complications`, `gender`) VALUES
(5, 6, 'yasiin', '2025-04-12', '20:16:00', 0.21, 'caqabad qaliin', 'male'),
(6, 7, 'cali', '2025-04-14', '04:04:00', 0.12, 'qabad ma jirto', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `do_id` int(11) NOT NULL,
  `do_Name` varchar(255) NOT NULL,
  `fee` varchar(255) NOT NULL,
  `sp_id` int(100) DEFAULT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`do_id`, `do_Name`, `fee`, `sp_id`, `mobile`, `address`, `email`, `created_at`, `status`) VALUES
(3, 'Dr sadaq', '700', 2, '61233223', 'taleex', 'dadaq12@gmail.com', '2025-04-14 00:23:30', 'Verified'),
(4, 'Drs hadan', '650', 2, '6134456', 'xamarweyne', 'hodan12@mail.com', '2025-04-14 00:25:05', 'Verified'),
(7, 'xassan ', '700', 1, '61344', 'hiliwa', 'xassan@gmail.com', '2025-04-14 02:55:05', 'Unverified'),
(8, 'Dr.hayaat', '900', 1, '634456', 'taleex', 'hayat@gmail.com', '2025-04-14 09:51:45', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `growth_records`
--

CREATE TABLE `growth_records` (
  `id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `head_circumference` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `growth_records`
--

INSERT INTO `growth_records` (`id`, `child_id`, `record_date`, `weight`, `height`, `head_circumference`) VALUES
(4, 5, '2025-04-13', 0.34, 0.08, 0.07);

-- --------------------------------------------------------

--
-- Table structure for table `health_checks`
--

CREATE TABLE `health_checks` (
  `id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `check_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_checks`
--

INSERT INTO `health_checks` (`id`, `child_id`, `doctor_id`, `check_date`, `notes`) VALUES
(4, 5, 3, '2025-04-14', 'malaria');

-- --------------------------------------------------------

--
-- Table structure for table `maternal_health_records`
--

CREATE TABLE `maternal_health_records` (
  `id` int(11) NOT NULL,
  `pregnancy_id` int(11) DEFAULT NULL,
  `checkup_date` date DEFAULT NULL,
  `blood_pressure` varchar(20) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `blood_sugar` decimal(5,2) DEFAULT NULL,
  `ultrasound_report` text DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sent_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(5, 11, 15, 'caqabad la soo xeriir mamulka', '2025-04-14 14:44:24');

--
-- Triggers `messages`
--
DELIMITER $$
CREATE TRIGGER `after_delete_message` AFTER DELETE ON `messages` FOR EACH ROW BEGIN
  UPDATE users
  SET Massage = NULL
  WHERE id = OLD.receiver_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_messages` AFTER INSERT ON `messages` FOR EACH ROW BEGIN
  UPDATE users
  SET Massage = NEW.message
  WHERE id = NEW.receiver_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_messag` AFTER UPDATE ON `messages` FOR EACH ROW BEGIN
  IF OLD.receiver_id <> NEW.receiver_id THEN
    UPDATE users
    SET Massage = NULL
    WHERE id = OLD.receiver_id;

    UPDATE users
    SET Massage = NEW.message
    WHERE id = NEW.receiver_id;
  ELSE
    UPDATE users
    SET Massage = NEW.message
    WHERE id = NEW.receiver_id;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_messages` AFTER UPDATE ON `messages` FOR EACH ROW BEGIN
  UPDATE users
  SET Massage = NEW.message
  WHERE id = NEW.receiver_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mother_name` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `Massage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mothers`
--

INSERT INTO `mothers` (`id`, `user_id`, `mother_name`, `date_of_birth`, `address`, `blood_type`, `medical_history`, `Massage`) VALUES
(6, NULL, 'fartuun', '2025-04-12', 'madiino', 'B+', '25/7/2025', ''),
(7, NULL, 'zanab', '2025-04-13', 'waberi', 'A+', '24 BISHA', 'talalalka waa ina qadata'),
(8, NULL, 'xamdi', '2025-04-14', 'km4', 'B+', '25/9/2025', '');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancies`
--

CREATE TABLE `pregnancies` (
  `id` int(11) NOT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `trimester` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pregnancies`
--

INSERT INTO `pregnancies` (`id`, `mother_id`, `start_date`, `due_date`, `trimester`, `notes`) VALUES
(15, 6, '2025-04-12', '2025-04-12', 3, 'iska daxadar');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `reminder_type` enum('appointment','vaccination','checkup') DEFAULT NULL,
  `reminder_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `reminders`
--
DELIMITER $$
CREATE TRIGGER `after_delete_reme` AFTER DELETE ON `reminders` FOR EACH ROW BEGIN
  UPDATE mothers
  SET Massage = NULL
  WHERE id = OLD.mother_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_reminder` AFTER INSERT ON `reminders` FOR EACH ROW BEGIN
  UPDATE mothers
  SET Massage = NEW.description
  WHERE id = NEW.mother_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_reminder` AFTER UPDATE ON `reminders` FOR EACH ROW BEGIN
  UPDATE mothers
  SET Massage = NEW.description
  WHERE id = NEW.mother_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_updatereminder` AFTER UPDATE ON `reminders` FOR EACH ROW BEGIN
  -- Haddii mother_id la beddelay
  IF OLD.mother_id != NEW.mother_id THEN

    -- Update new mother_id: ku dar description
    UPDATE mothers
    SET Massage = NEW.description
    WHERE id = NEW.mother_id;

    -- Clear old mother_id: ka dhig Massage = NULL
    UPDATE mothers
    SET Massage = NULL
    WHERE id = OLD.mother_id;

  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('article','video') DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `type`, `content`, `link`, `created_at`) VALUES
(4, 'hooyada iyo dhalaanka', 'video', 'muqaal hooyada iyo dhalaanka', 'https://www.facebook.com/share/v/1DhJYtBn9W/', '2025-04-12 21:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `sp_id` int(50) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`sp_id`, `Name`) VALUES
(1, 'Dhaqtarka haweenka'),
(2, 'cudurada guud');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `User_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','doctor','mother') DEFAULT NULL,
  `user_photo` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `Massage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `User_name`, `password`, `role`, `user_photo`, `created_at`, `Massage`) VALUES
(11, 'sakariye', 'zaki', '123', 'admin', 'img/no-img.PNG', '2025-04-11 00:00:00', ''),
(13, 'fartuun', 'fartuun', '123', 'mother', 'img/no-img.PNG', '2025-04-11 00:00:00', ''),
(15, 'Dr cali cabdi', 'cali', '123', 'doctor', 'img/no-img.PNG', '2025-04-14 00:00:00', 'caqabad la soo xeriir mamulka');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(11) NOT NULL,
  `child_id` int(11) DEFAULT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL,
  `scheduled_date` date DEFAULT NULL,
  `given_date` date DEFAULT NULL,
  `status` enum('pending','given','missed') DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinations`
--

INSERT INTO `vaccinations` (`id`, `child_id`, `vaccine_name`, `scheduled_date`, `given_date`, `status`, `notes`) VALUES
(6, 5, 'talaalka boliyayaha', '2025-04-12', '2025-04-12', 'given', 'sedex goojo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mother_id` (`mother_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`do_id`),
  ADD KEY `sp_id` (`sp_id`);

--
-- Indexes for table `growth_records`
--
ALTER TABLE `growth_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `health_checks`
--
ALTER TABLE `health_checks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `maternal_health_records`
--
ALTER TABLE `maternal_health_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregnancy_id` (`pregnancy_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `mothers`
--
ALTER TABLE `mothers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mother_id` (`mother_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`mother_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `growth_records`
--
ALTER TABLE `growth_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `health_checks`
--
ALTER TABLE `health_checks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maternal_health_records`
--
ALTER TABLE `maternal_health_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mothers`
--
ALTER TABLE `mothers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pregnancies`
--
ALTER TABLE `pregnancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `sp_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`do_id`);

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`);

--
-- Constraints for table `growth_records`
--
ALTER TABLE `growth_records`
  ADD CONSTRAINT `growth_records_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);

--
-- Constraints for table `health_checks`
--
ALTER TABLE `health_checks`
  ADD CONSTRAINT `health_checks_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`),
  ADD CONSTRAINT `health_checks_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`do_id`);

--
-- Constraints for table `maternal_health_records`
--
ALTER TABLE `maternal_health_records`
  ADD CONSTRAINT `maternal_health_records_ibfk_1` FOREIGN KEY (`pregnancy_id`) REFERENCES `pregnancies` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mothers`
--
ALTER TABLE `mothers`
  ADD CONSTRAINT `mothers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD CONSTRAINT `pregnancies_ibfk_1` FOREIGN KEY (`mother_id`) REFERENCES `mothers` (`id`);

--
-- Constraints for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `vaccinations_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
