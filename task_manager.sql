-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2024 at 11:03 PM
-- Server version: 8.0.39
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Tyler Koger', 'chase1bballer@yahoo.com', 'HELLLPPP!!!!!!!!!!', '2024-12-11 18:39:58'),
(4, 'Liam Carter', 'liam.carter@example.com', 'I need clarification on how to implement foreign keys properly in the database.', '2024-12-11 22:41:27'),
(5, 'Emma Davis', 'emma.davis@example.com', 'Could you provide feedback on the AI system proposal by this evening? It’s quite urgent.', '2024-12-11 22:41:27'),
(6, 'Oliver Brown', 'oliver.brown@example.com', 'I am encountering errors in the quarterly budget analysis spreadsheet. Can you review it?', '2024-12-11 22:41:27'),
(7, 'Sophia Wilson', 'sophia.wilson@example.com', 'Can we schedule a meeting to finalize the cybersecurity training outline?', '2024-12-11 22:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `task` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `due_date` date NOT NULL,
  `is_completed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `task`, `due_date`, `is_completed`) VALUES
(1, 1, 'Complete PHP task manager project', '2024-12-15', 0),
(2, 1, 'Review SQL queries for optimization', '2024-12-10', 0),
(3, 2, 'Prepare for meeting with team', '2024-12-09', 1),
(4, 2, 'Finish reading book for class', '2024-12-11', 0),
(5, 3, 'Submit project proposal for new AI system', '2024-12-20', 0),
(7, 5, 'Plan cybersecurity training for staff', '2024-12-18', 0),
(8, 1, 'Update task manager documentation', '2024-12-16', 0),
(9, 6, 'Change the smoke alarm battery', '2025-02-23', 0),
(10, 4, 'New set of contacts', '2025-01-04', 0),
(12, 2, 'Prepare presentation on team objectives', '2024-12-14', 0),
(17, 4, 'Study For Prof Lonnie Final Exam - Computer Security (CS 232)', '2024-12-10', 1),
(18, 4, 'Take The Prof Lonnie Final Exam -  (CS 232)', '2024-12-11', 1),
(19, 4, 'Present My Web Development Final (CS 351)', '2024-12-12', 0),
(83, 3, 'New Year\'s Day', '2025-01-01', 0),
(84, 5, 'New Year\'s Day', '2025-01-01', 0),
(85, 7, 'New Year\'s Day', '2025-01-01', 0),
(86, 2, 'New Year\'s Day', '2025-01-01', 0),
(87, 1, 'New Year\'s Day', '2025-01-01', 0),
(88, 6, 'New Year\'s Day', '2025-01-01', 0),
(89, 4, 'New Year\'s Day', '2025-01-01', 0),
(90, 3, 'Valentine\'s Day', '2025-02-14', 0),
(91, 5, 'Valentine\'s Day', '2025-02-14', 0),
(92, 7, 'Valentine\'s Day', '2025-02-14', 0),
(93, 2, 'Valentine\'s Day', '2025-02-14', 0),
(94, 1, 'Valentine\'s Day', '2025-02-14', 0),
(95, 6, 'Valentine\'s Day', '2025-02-14', 0),
(96, 4, 'Valentine\'s Day', '2025-02-14', 0),
(97, 3, 'Labor Day', '2025-05-01', 0),
(98, 5, 'Labor Day', '2025-05-01', 0),
(99, 7, 'Labor Day', '2025-05-01', 0),
(100, 2, 'Labor Day', '2025-05-01', 0),
(101, 1, 'Labor Day', '2025-05-01', 0),
(102, 6, 'Labor Day', '2025-05-01', 0),
(103, 4, 'Labor Day', '2025-05-01', 0),
(104, 3, 'Halloween', '2025-10-31', 0),
(105, 5, 'Halloween', '2025-10-31', 0),
(106, 7, 'Halloween', '2025-10-31', 0),
(107, 2, 'Halloween', '2025-10-31', 0),
(108, 1, 'Halloween', '2025-10-31', 0),
(109, 6, 'Halloween', '2025-10-31', 0),
(110, 4, 'Halloween', '2025-10-31', 0),
(111, 3, 'Christmas Day', '2024-12-25', 0),
(112, 5, 'Christmas Day', '2024-12-25', 0),
(113, 7, 'Christmas Day', '2024-12-25', 0),
(114, 2, 'Christmas Day', '2024-12-25', 0),
(115, 1, 'Christmas Day', '2024-12-25', 0),
(116, 6, 'Christmas Day', '2024-12-25', 0),
(117, 4, 'Christmas Day', '2024-12-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'john_doe', 'password123'),
(2, 'jane_smith', 'securepassword456'),
(3, 'alice_green', 'aliceSecure789'),
(4, 'tylerk', '$2y$10$xwbWnuWpPbKBVp11acW/Qupnf/Ektt11iZdMNCwkKNnuX.vDJJMji'),
(5, 'bob_brown', 'password789'),
(6, 'secret', '$2y$10$nGEdS916mzYOWhNs9ndC..1osEPiWfOZhAzase1903lriNcQQ2.Oa'),
(7, 'charlie_wilson', 'charlieSecure999'),
(8, 'yesitsme123', '$2y$10$.a8kg1QdAR/wRWrAt9rcdexi1xh.7TwyDvzlrVm0ggmgCvpoBloOm');

--
-- Triggers `users`
--
-- Used a LLM to make all acounts get these tasks
DELIMITER $$
CREATE TRIGGER `add_holidays_to_new_user` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO `tasks` (`user_id`, `task`, `due_date`, `is_completed`) VALUES
    (NEW.id, 'New Year's Day', '2025-01-01', 0),
    (NEW.id, 'Valentine's Day', '2025-02-14', 0),
    (NEW.id, 'Labor Day', '2025-05-01', 0),
    (NEW.id, 'Halloween', '2025-10-31', 0),
    (NEW.id, 'Christmas Day', '2024-12-25', 0);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
