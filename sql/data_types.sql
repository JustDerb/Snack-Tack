-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 10:30 AM
-- Server version: 5.5.15
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snacktack`
--

--
-- Dumping data for table `types`
--

UPDATE `types` SET `id` = 3,`name` = 'Pizza',`description` = 'Everybody loves pizza!',`category` = 1,`icon` = 'img/types/pizza.png' WHERE `types`.`id` = 3;
UPDATE `types` SET `id` = 4,`name` = 'Ice Cream',`description` = 'Vanilla, or chocolate?',`category` = 1,`icon` = 'img/types/icecream.png' WHERE `types`.`id` = 4;
UPDATE `types` SET `id` = 5,`name` = 'T-Shirts',`description` = 'Don''t worry, we got your size!',`category` = 2,`icon` = 'img/types/default.png' WHERE `types`.`id` = 5;
UPDATE `types` SET `id` = 6,`name` = 'Venue',`description` = 'Should be a good show!',`category` = 3,`icon` = 'img/types/default.png' WHERE `types`.`id` = 6;
UPDATE `types` SET `id` = 7,`name` = 'Other',`description` = 'See the description for more info.',`category` = 4,`icon` = 'img/types/default.png' WHERE `types`.`id` = 7;
UPDATE `types` SET `id` = 8,`name` = 'Other',`description` = 'See the description for more info.',`category` = 1,`icon` = 'img/types/sandwich.png' WHERE `types`.`id` = 8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
