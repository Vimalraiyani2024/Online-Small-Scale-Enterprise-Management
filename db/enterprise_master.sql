-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2015 at 08:25 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enterprise_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `enterprise_id` int(10) NOT NULL AUTO_INCREMENT,
  `enterprise_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `img` varchar(200) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `db_name` varchar(50) NOT NULL,
  `is_verified` int(1) NOT NULL,
  `user_type` int(1) NOT NULL,
  `login_status` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `vat_tin_no` varchar(13) NOT NULL,
  `cst_no` varchar(13) NOT NULL,
  `plan_type` int(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`enterprise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`enterprise_id`, `enterprise_name`, `address`, `city`, `state`, `password`, `img`, `email_id`, `mobile`, `db_name`, `is_verified`, `user_type`, `login_status`, `is_deleted`, `vat_tin_no`, `cst_no`, `plan_type`, `entry_date`) VALUES
(19, 'Global Computers', 'Meghani Circle,', 'Bhavnagar', 'Gujrat', '81dc9bdb52d04dc20036dbd8313ed055', 'images.jpg', 'global@gmail.com', '8012457845', 'db_19', 1, 0, 1, 0, '5845874152312', '0', 1, '2015-11-30 01:20:20'),
(22, 'Smith Hardware', 'Munlight Marbal, SG Road,', 'Rajkot', 'Gujrat', '81dc9bdb52d04dc20036dbd8313ed055', 'logo.gif', 'scomputer@gmail.com', '9845781265', 'db_22', 1, 0, 0, 0, '2548515154512', '0', 1, '2013-11-30 02:01:20'),
(28, 'Yogesh Kanojiya', 'Bhavnagar', 'Bhavnagar', 'Gujarat', '202cb962ac59075b964b07152d234b70', '', 'yogesh@gmail.com', '9558012423', 'enterprise_master', 1, 10, 1, 0, '5478985478563', '0', 0, '2015-04-06 11:31:02'),
(29, 'ram computer', 'kalanala', 'bhavagar', 'gujrat', '81dc9bdb52d04dc20036dbd8313ed055', '2941428148446url.jpg', 'ramcomputer@gmail.com', '9558012428', 'aaa', 1, 2, 0, 0, '5874585212354', '25555255', 1, '2015-04-01 08:20:17'),
(31, 'Harsh Software', 'Shishuvihar\r\n108- Terning', 'Sihor', 'Gujrat', '81dc9bdb52d04dc20036dbd8313ed055', 'imagesw.jpg', 'sanjay.solanki2000@gmail.com', '8132784152', 'db_31', 1, 0, 1, 0, '8547854125452', '54785478', 1, '2015-04-01 10:40:36'),
(32, 'Sparrow Softtech', '108- Yash Complex,SG Road', 'Bhavnagar', 'Gujarat', '81dc9bdb52d04dc20036dbd8313ed055', '32514282119453241428146981Sparrow logo.png', 'demo@sparrow.com', '8545786532', 'db_32', 1, 0, 0, 0, '214785412', '25254245', 1, '2015-04-02 15:40:49'),
(35, 'Om Sai Enterprise', 'Opp. SBI Bank,\r\nSardar Patel Park,\r\nBhavnagar ', 'Bhavnagar', 'Gujarat', '81dc9bdb52d04dc20036dbd8313ed055', '3541428133443OSSEM1.png', 'yogeshkanojiya07@gmail.com', '9558012423', 'db_33', 1, 0, 1, 0, '890545444', '466767676', 4, '2015-04-04 12:50:30'),
(36, 'Shanki Sales ', 'Panvadi,\r\nHarikrishna complex,\r\nBhavnagar', 'Bhavnagar', 'Gujarat', '81dc9bdb52d04dc20036dbd8313ed055', 'Vanamo_Logo.png', 'shaktisales@gmail.com', '8554859898', 'db_36', 1, 0, 0, 0, '7878787', '7878787', 1, '2015-04-04 21:56:27'),
(37, 'Shree Ganesh Sales Egency', 'Opp. SBI Bank,\r\nRammantra Mandir,\r\nBhavnagar.', 'Rajkot', 'Gujarat', '81dc9bdb52d04dc20036dbd8313ed055', '3751428209941url.png', 'ganesh@sales.co.in', '8548547878', 'db_37', 1, 0, 0, 0, '898989899898', '7878787878787', 1, '2015-04-05 10:17:07'),
(38, 'Marshal Infotech', 'Kalanala,\r\nMeghani Circle,\r\nBhavnagar', 'Bhavnagar', 'Gujarat', '1234', '', 'marshal@gmail.com', '9856458752', 'db_38', 0, 0, 0, 0, '3343444443333', '3333333333333', 3, '2015-04-06 11:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE IF NOT EXISTS `suggestion` (
  `sug_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message1` text NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`sug_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`sug_id`, `sender_name`, `email`, `subject`, `message1`, `entry_date`) VALUES
(11, 'Yash Patel', 'softworld07@gmail.com', 'Thanks..', 'Now i can access my account..', '2015-04-03 17:50:12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
