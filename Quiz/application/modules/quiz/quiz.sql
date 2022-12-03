-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2022 at 02:47 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz_option`
--

CREATE TABLE `quiz_option` (
  `id` int(11) NOT NULL,
  `option_a` varchar(60) NOT NULL,
  `option_b` varchar(60) NOT NULL,
  `option_c` varchar(60) NOT NULL,
  `option_d` varchar(60) NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct_option` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_option`
--

INSERT INTO `quiz_option` (`id`, `option_a`, `option_b`, `option_c`, `option_d`, `question_id`, `correct_option`) VALUES
(1, '1850s', '1880s', '1930s', '1950s', 1, '2'),
(2, 'Report', 'Field', 'Record', 'File', 2, '2'),
(3, 'Order of Significance', 'Open Software', 'Operating System', 'Optical Sensor', 3, '3'),
(4, '1850s', '1860s', '1870s', '1900s', 4, '4'),
(5, 'Image file', 'Animation/movie file', 'Audio file', 'MS Office document', 5, '2'),
(6, 'Pumping', 'Exciting', 'Priming', 'Raising', 6, '1'),
(7, 'Kalidasa', 'Charak', 'Panini', 'Aryabhatt', 7, '3'),
(8, 'Zinc', 'Silver', 'Copper', 'Aluminum', 8, '2'),
(9, 'Mercury', 'Venus', 'Mars', 'Jupiter', 9, '2'),
(10, 'China and Egypt', 'China and Greek', 'China and Britain', 'China and France', 10, '3');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_played`
--

CREATE TABLE `quiz_played` (
  `id` int(11) NOT NULL,
  `playername` varchar(60) NOT NULL,
  `totalquestions` varchar(60) DEFAULT NULL,
  `attemptedquestions` varchar(60) DEFAULT NULL,
  `correctquestions` varchar(60) DEFAULT NULL,
  `date` varchar(60) DEFAULT NULL,
  `timeconsumed` int(11) DEFAULT NULL,
  `selectedoption` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_played`
--

INSERT INTO `quiz_played` (`id`, `playername`, `totalquestions`, `attemptedquestions`, `correctquestions`, `date`, `timeconsumed`, `selectedoption`) VALUES
(75, 'sakshyam', '10', '4', '3', 'Sat Dec 03 2022 07:30:58 GMT+0545 (Nepal Time)', 23, '2,,2,,3,,3,,null,,null,,null,,null,,null,,null,');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `question`) VALUES
(1, ' In which decade was the American Institute of Electrical Engineers (AIEE) founded?'),
(2, 'What is part of a database that holds only one type of information?'),
(3, '\'OS\' computer abbreviation usually means ?'),
(4, ' In which decade with the first transatlantic radio broadcast occur?'),
(5, '\'.MOV\' extension refers usually to what kind of file?'),
(6, 'The first step to getting output from a laser is to excite an active medium. What is this process called?'),
(7, ' Who among the following wrote Sanskrit grammar?'),
(8, 'The metal whose salts are sensitive to light is?'),
(9, 'The hottest planet in the solar system?'),
(10, 'First China War was fought between');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz_option`
--
ALTER TABLE `quiz_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_played`
--
ALTER TABLE `quiz_played`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz_option`
--
ALTER TABLE `quiz_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quiz_played`
--
ALTER TABLE `quiz_played`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
