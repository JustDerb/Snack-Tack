-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2012 at 08:16 PM
-- Server version: 5.5.15
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `snacktack`
--

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(128) NOT NULL DEFAULT 'img/awards/template.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `networkid` varchar(30) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` longtext NOT NULL,
  `dateStart` datetime NOT NULL,
  `dateEnd` datetime NOT NULL,
  `locationstr` varchar(64) NOT NULL,
  `organizationid` int(11) DEFAULT '-1',
  `fbEvent` text,
  PRIMARY KEY (`id`),
  KEY `ownerIdx` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventsratings`
--

CREATE TABLE IF NOT EXISTS `eventsratings` (
  `eventid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`eventid`,`userid`),
  KEY `eventid` (`eventid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventstypes`
--

CREATE TABLE IF NOT EXISTS `eventstypes` (
  `eventid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  PRIMARY KEY (`eventid`,`typeid`),
  KEY `typeid` (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `networkid` varchar(30) NOT NULL,
  `name` text NOT NULL,
  `room` varchar(10) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownerid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ownerId` (`ownerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `icon` varchar(128) NOT NULL DEFAULT 'img/types/default.png',
  PRIMARY KEY (`id`),
  KEY `Category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `userawards`
--

CREATE TABLE IF NOT EXISTS `userawards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `awardid` int(11) NOT NULL,
  `received` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userAward` (`user`,`awardid`),
  KEY `awardid` (`awardid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbid` varchar(30) NOT NULL,
  `registered` datetime NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `networkid` varchar(30) NOT NULL,
  `numberpin` int(11) NOT NULL DEFAULT '-9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventsratings`
--
ALTER TABLE `eventsratings`
  ADD CONSTRAINT `eventsratings_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `eventsratings_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `eventstypes`
--
ALTER TABLE `eventstypes`
  ADD CONSTRAINT `eventstypes_ibfk_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `eventstypes_ibfk_2` FOREIGN KEY (`typeid`) REFERENCES `types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `types_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userawards`
--
ALTER TABLE `userawards`
  ADD CONSTRAINT `userawards_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userawards_ibfk_2` FOREIGN KEY (`awardid`) REFERENCES `awards` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
