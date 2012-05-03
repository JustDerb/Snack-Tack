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

INSERT INTO types (id, name, description, category, icon) VALUES (3, 'Pizza', 'Everybody loves pizza!', 1, 'img/types/pizza.png');
INSERT INTO types (id, name, description, category, icon) VALUES (4, 'Ice Cream', 'Vanilla, or chocolate?', 1, 'img/types/icecream.png');
INSERT INTO types (id, name, description, category, icon) VALUES (5, 'T-Shirts', 'Don''t worry, we got your size!', 2, 'img/types/default.png');
INSERT INTO types (id, name, description, category, icon) VALUES (6, 'Venue', 'Should be a good show!', 3, 'img/types/default.png');
INSERT INTO types (id, name, description, category, icon) VALUES (7, 'Other', 'See the description for more info.', 4, 'img/types/default.png');
INSERT INTO types (id, name, description, category, icon) VALUES (8, 'Other', 'See the description for more info.', 1, 'img/types/sandwich.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
