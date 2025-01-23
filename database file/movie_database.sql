-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 04, 2023 at 06:30 AM
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
-- Database: `movie_database`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_movies` ()   SELECT * FROM movies$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_movies_logo` ()   SELECT movie_logo FROM movies$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin1', 'admin1@gmail.com', 'admin1#123');

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `check_emailaddadmins` BEFORE INSERT ON `admins` FOR EACH ROW IF NOT (NEW.admin_email REGEXP '^[A-Za-z0-9._%+-]+@gmail.com$') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid email address';
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `allbookings`
-- (See below for the actual view)
--
CREATE TABLE `allbookings` (
`booking_id` int(10)
,`booking_user_id` int(11)
,`booking_movie_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) NOT NULL,
  `booking_booked_seats` varchar(255) NOT NULL,
  `booking_user_id` int(11) NOT NULL,
  `booking_movie_name` varchar(250) NOT NULL,
  `booking_show_time` varchar(250) NOT NULL,
  `booking_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `booking_is_cancel` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_booked_seats`, `booking_user_id`, `booking_movie_name`, `booking_show_time`, `booking_time`, `booking_is_cancel`) VALUES
(1, 'a:2:{i:0;s:2:\"A2\";i:1;s:2:\"A3\";}', 1, '3 idiots', '8:30 AM', '2023-05-04 03:07:23', 1),
(2, 'a:2:{i:0;s:2:\"A1\";i:1;s:2:\"A3\";}', 1, 'ae dil ee mushkil', '3:30 PM', '2023-05-04 00:21:11', 0),
(3, 'a:2:{i:0;s:2:\"A1\";i:1;s:2:\"A2\";}', 1, 'Bahubali', '12:30 AM', '2023-05-04 00:21:39', 0);

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `set_is_cancel` AFTER DELETE ON `booking` FOR EACH ROW UPDATE booking SET booking_is_cancel = 1 WHERE booking_id = OLD.booking_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(10) NOT NULL,
  `movie_name` varchar(100) NOT NULL,
  `movie_description` text NOT NULL,
  `movie_logo` varchar(250) NOT NULL,
  `movie_releasedate` date DEFAULT NULL,
  `movie_rating` int(10) UNSIGNED NOT NULL,
  `movie_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `movie_description`, `movie_logo`, `movie_releasedate`, `movie_rating`, `movie_time`) VALUES
(1, 'Bahubali', 'Baahubali is a Tollywood movie.', 'movie1.jpg', '2022-11-09', 5, '12:30 AM'),
(2, 'RRR', 'RRR is a Tollywood movie.', 'movie2.jpg', '2023-10-10', 4, '9:30 PM'),
(3, 'Pathaan', 'Pathaan is a Bollywood movie.', 'movie3.jpg', '2023-07-10', 3, '7:20 AM'),
(4, '3 idiots', '3 idiots is a Bollywood movie.', 'movie4.jpg', '2022-06-08', 5, '8:30 AM'),
(5, 'ae dil ee mushkil', 'ae dil ee mushkil is a Bollywood movie.', 'movie5.jpg', '2023-08-10', 4, '3:30 PM'),
(6, 'Vikram', 'Vikram is a Tollywood movie.', 'movie6.jpg', '2022-09-30', 2, '1:30 PM'),
(7, 'Spiderman', 'Spiderman is a Hollywood movie.', 'movie7.jpg', '2021-01-06', 5, '4:30 PM'),
(8, 'Batman', 'Batman is a Hollywood movie.', 'movie8.jpg', '2022-03-15', 5, '7:30 PM');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` int(10) NOT NULL,
  `show_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `show_time`) VALUES
(1, '10:30 AM'),
(2, '12:30 PM'),
(3, '03:30 PM'),
(4, '07:30 PM'),
(5, '10:00 PM'),
(6, '12:30 AM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_mobile` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile`) VALUES
(1, 'user1', 'user1@gmail.com', 'user1#123', 9898989898),
(2, 'user2', 'user2@gmail.com', 'user2#123', 7878787878);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `check_emailaddusers` BEFORE INSERT ON `users` FOR EACH ROW IF NOT (NEW.user_email REGEXP '^[A-Za-z0-9._%+-]+@gmail.com$') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid email address';
    END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `unique_email` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE count INT;
    SELECT COUNT(*) INTO count FROM `users` WHERE `user_email` = NEW.user_email;
    IF count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email address must be unique';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `allbookings`
--
DROP TABLE IF EXISTS `allbookings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allbookings`  AS SELECT `booking`.`booking_id` AS `booking_id`, `booking`.`booking_user_id` AS `booking_user_id`, `booking`.`booking_movie_name` AS `booking_movie_name` FROM `booking` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
