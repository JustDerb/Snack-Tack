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

INSERT INTO category (id, name, description) VALUES (1, 'Food', 'Food-based sales');
INSERT INTO category (id, name, description) VALUES (2, 'Apparel', 'Apparel-based sales');
INSERT INTO category (id, name, description) VALUES (3, 'Concert', 'Concert events');
INSERT INTO category (id, name, description) VALUES (4, 'Other', 'Misc sales');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
