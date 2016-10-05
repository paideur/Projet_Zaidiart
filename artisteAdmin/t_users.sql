-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 05, 2016 at 09:50 PM
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
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
`ID_USER` bigint(32) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `PASSWORD` varchar(128) NOT NULL,
  `SALT` varchar(300) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime DEFAULT NULL,
  `LAST_NAME` varchar(32) NOT NULL,
  `BLOG_NAME` varchar(50) DEFAULT NULL,
  `PROF_ARTISTIQUE` varchar(30) DEFAULT NULL,
  `FIRST_NAME` varchar(32) NOT NULL,
  `CATEGORY` varchar(200) NOT NULL,
  `LANGUAGE` varchar(20) DEFAULT NULL,
  `TEL` varchar(50) DEFAULT NULL,
  `GENRE` varchar(200) DEFAULT NULL,
  `GENDER` varchar(16) NOT NULL,
  `BORN_DATE` datetime DEFAULT NULL,
  `ADDRESS` varchar(128) DEFAULT NULL,
  `ZIP_CODE` varchar(16) DEFAULT NULL,
  `CITY` varchar(32) DEFAULT NULL,
  `COUNTRY` varchar(16) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `photo_thumb` varchar(200) DEFAULT NULL,
  `PATH` varchar(200) DEFAULT NULL,
  `STATUT_COMPTE` tinyint(1) DEFAULT NULL,
  `ARTISTE_NAME` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`ID_USER`, `EMAIL`, `PASSWORD`, `SALT`, `CREATE_DATE`, `UPDATE_DATE`, `LAST_NAME`, `BLOG_NAME`, `PROF_ARTISTIQUE`, `FIRST_NAME`, `CATEGORY`, `LANGUAGE`, `TEL`, `GENRE`, `GENDER`, `BORN_DATE`, `ADDRESS`, `ZIP_CODE`, `CITY`, `COUNTRY`, `photo`, `photo_thumb`, `PATH`, `STATUT_COMPTE`, `ARTISTE_NAME`) VALUES
(1, 'opclaver@gmail.com', '$2y$10$8.w1/op86riNqpUsv14g.O9MsN2I0fcfNZlH.Mh3RZdzn3yfb9PAe', '', '2016-10-05 20:37:40', '2016-10-05 00:00:00', 'OUEDRAOGO', NULL, NULL, 'Pierre Claver', 'Professionel', NULL, NULL, NULL, 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'opc'),
(32, 'aristide@yahoo.fr', 'aristide', '', '2016-08-26 00:00:00', '0000-00-00 00:00:00', 'OUEDRAOGO', 'Aritide', 'Artiste Plasticien', 'Aristides', '', 'fr', '0765355353', '', 'M', '1989-04-04 00:00:00', '11 Allee du prof ', '31400', 'Toulouse', 'France', 'images/profil1.jpg', '', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
 ADD PRIMARY KEY (`ID_USER`,`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
MODIFY `ID_USER` bigint(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
