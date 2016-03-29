-- phpMyAdmin SQL Dump
-- version 4.5.5.1deb2.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2016 at 12:34 PM
-- Server version: 5.6.29
-- PHP Version: 5.6.19-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_users`
--

CREATE TABLE IF NOT EXISTS `tm_users` (
  `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '-2',
  `balance` decimal(6,2) NOT NULL DEFAULT '0.00',
  `name` varchar(50) NOT NULL,
  `phone` char(13) NOT NULL,
  `sex` char(1) NOT NULL,
  `birthdate` date NOT NULL,
  `services` tinyint(1) UNSIGNED NOT NULL,
  `country` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `region` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `city` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `purpose` tinyint(1) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `size` tinyint(1) UNSIGNED NOT NULL,
  `height` tinyint(1) UNSIGNED NOT NULL,
  `weight` tinyint(1) UNSIGNED NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `dt_create` datetime NOT NULL,
  `dt_publish` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tm_user_pictures`
--

CREATE TABLE IF NOT EXISTS `tm_user_pictures` (
  `id` bigint(30) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(30) UNSIGNED NOT NULL,
  `key_code` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `dt_create` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
