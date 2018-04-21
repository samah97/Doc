-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2016 at 06:49 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbline`
--

-- --------------------------------------------------------

--
-- Table structure for table `comodity`
--

CREATE TABLE IF NOT EXISTS `comodity` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `month` varchar(20) NOT NULL,
  `sugar` int(11) NOT NULL,
  `rice` int(11) NOT NULL,
  `wheat_flour` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comodity`
--

INSERT INTO `comodity` (`id`, `month`, `sugar`, `rice`, `wheat_flour`) VALUES
(1, 'Jan', 6415, 5442, 6759),
(2, 'Feb', 6430, 5457, 7921),
(3, 'Mar', 6437, 5376, 7291),
(4, 'Apr', 6301, 5398, 7627),
(5, 'May', 6440, 5363, 7641),
(6, 'Jun', 6502, 5501, 7704),
(7, 'Jul', 6441, 5471, 7744),
(8, 'Aug', 6465, 5400, 7820),
(9, 'Sep', 6446, 5420, 7790),
(10, 'Oct', 6700, 5900, 7850),
(11, 'Nov', 6650, 5460, 7320),
(12, 'Dec', 6680, 5789, 7867);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
