-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 11, 2016 at 11:14 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zaidiart`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_config_mail`
--

CREATE TABLE `t_config_mail` (
`id` int(11) NOT NULL,
  `FROM` varchar(100) NOT NULL,
  `HOST` varchar(100) NOT NULL,
  `PORT` varchar(100) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_config_mail`
--

INSERT INTO `t_config_mail` (`id`, `FROM`, `HOST`, `PORT`, `USERNAME`, `PASSWORD`) VALUES
(1, 'zaidiartinternational@gmail.com', 'smtp.gmail.com', '465', 'zaidiartinternational@gmail.com', 'Zaidiart1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_config_mail`
--
ALTER TABLE `t_config_mail`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_config_mail`
--
ALTER TABLE `t_config_mail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
