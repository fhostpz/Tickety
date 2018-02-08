-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 08, 2018 at 01:09 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickety`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `event_id` int(4) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(60) NOT NULL,
  `event_description` text NOT NULL,
  `event_url` varchar(80) NOT NULL,
  `event_alt` varchar(50) NOT NULL,
  `event_date` date NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_title`, `event_description`, `event_url`, `event_alt`, `event_date`) VALUES
(1, 'Celebrate the New Year', 'Tickety is your one stop solution to all your event management problems! What you don\'t like it? What the fuck did you just fucking say about me, you little bitch? I\'ll have you know I graduated top of my class in the Navy Seals, and I\'ve been involved in numerous secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I\'m the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the USA and your IP is being traced right now so you better prepare for the storm, maggot. The storm that wipes out the pathetic little thing you call your life. You\'re fucking dead, kid. I can be anywhere, anytime,', 'cheers.jpg', 'Drinks together', '2018-01-01'),
(2, 'That time of the Night', 'Well, you know what I mean', 'eclipse.jpg', 'Watch the eclipse', '2018-11-17'),
(3, 'The sex ed you missed out on', 'It\'s never too late to learn about stuff you will never do for the rest of your life!', 'presentation.jpg', 'Important presentation', '2008-09-21'),
(4, 'Party Time', 'What do we do right before finals? It\'s EXACTLY what you\'re thinking!', 'festival.jpg', 'Hype fest', '2019-09-21'),
(5, 'Trip of Dreams', 'Fulfill your childhood dreams of by realizing your cosplayer fetishes and meeting characters from Five-Nights-at-Freddy\'s', 'disneyland.jpg', 'Disneyland', '2018-07-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
