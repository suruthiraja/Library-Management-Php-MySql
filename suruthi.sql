-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 04:52 AM
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
-- Database: `suruthi`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `available` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `available`) VALUES
(1001, 'Effective Java', 'Joshua Bloch', 1),
(1002, 'Java: The Complete Reference', 'Herbert Schildt', 0),
(1003, 'Head First Java', 'Kathy Sierra and Bert Bates', 0),
(1004, 'Java Concurrency in Practice', 'Brian Goetz', 1),
(1005, 'Core Java Volume I - Fundamentals', 'Cay S. Horstmann', 1),
(1006, 'Python Crash Course', 'Eric Matthes', 1),
(1007, 'Automate the Boring Stuff with Python', 'Al Sweigart', 1),
(1008, 'Fluent Python', 'Luciano Ramalho', 1),
(1009, 'Learning Python', 'Mark Lutz', 1),
(1010, 'Python for Data Analysis', 'Wes McKinney', 1),
(1011, 'Mathematics', 'Srinivasa Samanujan', 0),
(1012, 'HTML', 'Suruthi', 0),
(1013, 'Java', 'Priya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `book_id`, `student_id`, `issue_date`, `return_date`) VALUES
(3, 1003, 3, '2024-10-26', NULL),
(6, 1011, 12, '2024-11-05', NULL),
(7, 1012, 11, '2024-11-05', NULL),
(9, 1002, 10, '2024-11-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `email`) VALUES
(1, 'abi', 'abi@example.com'),
(2, 'anu', 'anu@example.com'),
(3, 'babu', 'babu@example.com'),
(4, 'charli', 'charlie@example.com'),
(5, 'robin', 'rajesh@example.com'),
(6, 'rajesh', 'rajesh@example.com'),
(7, 'suba', 'suba@example.com'),
(8, 'siva', 'suba@example.com'),
(9, 'suruthi', 'suruthi@example.com'),
(10, 'vishnu', 'vishnu@example.com'),
(11, 'vicky', 'vicky@example.com'),
(12, 'priya', 'priya@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
