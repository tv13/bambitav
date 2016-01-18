-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2016 at 07:22 PM
-- Server version: 5.5.29-0ubuntu0.12.04.2
-- PHP Version: 5.5.27-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tm_users`
--

CREATE TABLE IF NOT EXISTS `tm_users` (
`id` bigint(30) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '-1',
  `balance` decimal(6,2) NOT NULL DEFAULT '0.00',
  `name` varchar(50) NOT NULL,
  `phone` char(13) NOT NULL,
  `sex` char(1) NOT NULL,
  `birthdate` date NOT NULL,
  `services` tinyint(1) unsigned NOT NULL,
  `city` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `size` tinyint(1) unsigned NOT NULL,
  `height` tinyint(1) unsigned NOT NULL,
  `weight` tinyint(1) unsigned NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `dt_create` datetime NOT NULL,
  `dt_publish` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tm_users`
--
ALTER TABLE `tm_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tm_users`
--
ALTER TABLE `tm_users`
MODIFY `id` bigint(30) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE IF NOT EXISTS `tm_user_pictures` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `userId` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `key_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `useLocal` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;