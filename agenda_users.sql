-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 07, 2019 at 08:37 PM
-- Server version: 10.2.25-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinguspa_phpAgenda`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda_users`
--

CREATE TABLE `agenda_users` (
  `id` int(60) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda_users`
--

INSERT INTO `agenda_users` (`id`, `name`, `email`, `website`, `comment`) VALUES
(1, 'Pepe', 'pepe@pepe.com', 'pepe.com', 'el pepe pecas'),
(2, 'pecas', 'pecas@gmail.com', 'pecas.com', 'esta picando papas '),
(3, 'Pepe', 'pepe@pepe.com', 'pepe.com', 'el pepe pecas'),
(4, 'pecas', 'pecas@gmail.com', 'pecas.com', 'esta picando papas ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda_users`
--
ALTER TABLE `agenda_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda_users`
--
ALTER TABLE `agenda_users`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
