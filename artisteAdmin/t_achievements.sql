-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 20 Octobre 2016 à 19:08
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zaidiart`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_achievements`
--

CREATE TABLE `t_achievements` (
  `ID_ACHIEV` bigint(32) NOT NULL,
  `ID_ARTIST` bigint(32) NOT NULL,
  `TITLE` varchar(200) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  `UPDATE_DATE` datetime NOT NULL,
  `IMAGE` varchar(32) DEFAULT NULL,
  `IMAGE_THUMB` varchar(200) DEFAULT NULL,
  `PATH` varchar(200) NOT NULL,
  `YEAR` varchar(10) DEFAULT NULL,
  `CHARACTERISTICS` varchar(128) DEFAULT NULL,
  `DESCRIPTION1` varchar(2048) DEFAULT NULL,
  `DESCRIPTION2` varchar(1024) DEFAULT NULL,
  `LENGTH` varchar(10) NOT NULL,
  `HEIGHT` varchar(10) NOT NULL,
  `WIDTH` varchar(10) NOT NULL,
  `TECHNIQUE` varchar(50) NOT NULL,
  `POIDS` varchar(10) NOT NULL,
  `CATEGORY` varchar(200) NOT NULL,
  `MEDIA` varchar(200) NOT NULL,
  `USE_DATA` varchar(10) NOT NULL,
  `VUE` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_achievements`
--
ALTER TABLE `t_achievements`
  ADD PRIMARY KEY (`ID_ACHIEV`),
  ADD KEY `FK_ARTIST` (`ID_ARTIST`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_achievements`
--
ALTER TABLE `t_achievements`
  MODIFY `ID_ACHIEV` bigint(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
