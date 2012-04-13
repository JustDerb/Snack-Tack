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
-- Dumping data for table `category`
--

UPDATE `category` SET `id` = 1,`name` = 'Food',`description` = 'Food-based sales' WHERE `category`.`id` = 1;
UPDATE `category` SET `id` = 2,`name` = 'Apparel',`description` = 'Apparel-based sales.' WHERE `category`.`id` = 2;
UPDATE `category` SET `id` = 3,`name` = 'Concert',`description` = 'Concert events' WHERE `category`.`id` = 3;
UPDATE `category` SET `id` = 4,`name` = 'Other',`description` = 'Misc events' WHERE `category`.`id` = 4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
