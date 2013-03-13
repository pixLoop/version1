-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 13-03-2013 a les 04:50:05
-- Versió del servidor: 5.5.29
-- Versió de PHP : 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de dades: `pixloop`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `id` int(8) NOT NULL,
  `user` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `news` int(8) NOT NULL,
  `parent` int(8) DEFAULT NULL,
  `comment` text COLLATE utf8_spanish_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`,`news`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Comments_votes`
--

CREATE TABLE IF NOT EXISTS `Comments_votes` (
  `c_id` int(8) NOT NULL,
  `c_news` int(8) NOT NULL,
  `user` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`c_id`,`c_news`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `site` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `font` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `link` varchar(192) COLLATE utf8_spanish_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  `title` text COLLATE utf8_spanish_ci NOT NULL,
  `resume` text COLLATE utf8_spanish_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `font` (`font`,`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `News_views`
--

CREATE TABLE IF NOT EXISTS `News_views` (
  `news` int(8) NOT NULL,
  `ip` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `news` (`news`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `News_votes`
--

CREATE TABLE IF NOT EXISTS `News_votes` (
  `news` int(8) NOT NULL,
  `user` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `news` (`news`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `page` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `id` varchar(24) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `image` varchar(256) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`page`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
