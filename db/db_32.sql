-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2015 at 06:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_32`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_master`
--

CREATE TABLE IF NOT EXISTS `attendance_master` (
  `att_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_id` int(10) NOT NULL,
  `month_name` varchar(10) NOT NULL,
  `month_year` varchar(4) NOT NULL,
  `attendance` varchar(100) NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1102 ;

--
-- Dumping data for table `attendance_master`
--

INSERT INTO `attendance_master` (`att_id`, `emp_id`, `month_name`, `month_year`, `attendance`) VALUES
(1086, 1, 'January', '2015', '0,0,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1'),
(1087, 3, 'January', '2015', '0,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1'),
(1088, 4, 'January', '2015', '0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1089, 5, 'January', '2015', '0,0,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1090, 1, 'February', '2015', '0,0,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1'),
(1091, 3, 'February', '2015', '0,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1'),
(1092, 4, 'February', '2015', '0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1093, 5, 'February', '2015', '0,0,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1094, 1, 'May', '2015', '0,0,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1'),
(1095, 3, 'May', '2015', '0,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1'),
(1096, 4, 'May', '2015', '0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1097, 5, 'May', '2015', '0,0,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1098, 1, 'December', '2014', '0,0,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1'),
(1099, 3, 'December', '2014', '0,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1'),
(1100, 4, 'December', '2014', '0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(1101, 5, 'December', '2014', '0,0,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE IF NOT EXISTS `customer_master` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `vat_tin_no` int(11) NOT NULL,
  `cst_no` int(11) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `iscompany` varchar(1) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`customer_id`, `customer_name`, `address`, `city`, `state`, `pincode`, `mobile_no`, `contact_name`, `email_id`, `vat_tin_no`, `cst_no`, `designation`, `phone_no`, `iscompany`, `is_deleted`, `entry_date`) VALUES
(28, 'Pramukh Info Tech', 'Meghani Circle,\r\n', 'Bhavnagar', 'Gujarat', 364001, '9564545676', 'A. B. Mehra', 'softworld07@gmail.com', 344556454, 655565564, 'Ownner', '0278-254566', '0', '0', '2015-03-29 00:00:00'),
(29, 'Uday Software', 'Sanskar Mandal,', 'Bhavnagar', 'Gujarat', 364001, '9833433888', 'Jayeshbhai', 'aaa@gmail.com', 0, 0, 'Manager', '0278-254544', '1', '0', '0000-00-00 00:00:00'),
(30, 'Jay Bhavani Enterprise', 'Nr. Parimal Chowk,\r\nShreeji Complex,\r\n', 'Bhavnagar', 'Gujarat', 364001, '9090999999', 'Mr. Atul Parmar', 'jaybhavani@gmail.com', 24140000, 24149999, 'Ownner', '', '1', '0', '2015-04-01 21:45:49'),
(31, 'SR Softtech', '242/A,\r\n2nd Floor, JB Chamber,\r\nNr. Atabhai Road,', 'Veraval', 'Gujarat', 364001, '8460000000', 'Mr. Shiv Vyas', 'srsofttech@yahoo.com', 0, 0, 'Ownner', '', '0', '0', '2015-04-01 21:47:56'),
(32, 'Square Infocom', '222/D, 3rd floor,\r\nNr. Tintanium Building,\r\nM. R. Road,', 'Ahmedabad', 'Gujarat', 349099, '7383999999', 'Mr. Nikunj Gohel', 'squares@rediffmail.com', 0, 0, 'Manager', '', '0', '0', '2015-04-01 21:50:24'),
(33, 'WebTech Services', '11th Lane, 4th floor,\r\nJay Ganesh Chamber,\r\nM. G. Road,', 'Mumbai', 'Maharastra', 440001, '9088776655', 'Mr. Nilesh Mandalia', 'webservices@yahoo.in', 0, 0, 'Ownner', '022-2456776', '0', '0', '2015-04-01 21:56:42'),
(34, 'Promis Computer Services', 'Infocom Complex,\r\nTaleti Road, Nr. Bus Stand', 'Palitana', 'Gujarat', 364545, '8877996677', 'Mr. Sunil Mehta', 'promiscom@yahoo.com', 0, 0, 'Ownner', '', '1', '0', '2015-04-01 21:59:13'),
(35, 'Gujarat Computers', '333 , G I D C ,\r\nChitra,\r\n', 'Bhavnagar', 'Gujarat', 364001, '9429009900', 'Mr. Anil Mehta', 'gujaratcomputers@gmail.com', 0, 0, 'Ownner', '', '1', '0', '2015-04-01 22:00:17'),
(36, 'Shiv Computer Shop', 'Bhavnagar - Rajkot Road,\r\nNr. Vartej Bus Stand,\r\nVartej', 'Bhavnagar', 'Gujarat', 364040, '9924009900', 'Mr. Rajendra Vakani', 'shivcomp@yahoo.com', 0, 0, 'Ownner', '', '1', '0', '2015-04-01 22:01:28'),
(37, 'Vardhaman Infotech', 'Muni Chowk,\r\nNr. Nagar Palika,\r\nTalaja Road,', 'TALAJA', 'Gujarat', 364333, '9924887788', 'Mr. Chintan Shah', 'vardhaman2014@gmail.com', 0, 0, 'Ownner', '', '1', '0', '2015-04-01 22:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `department_master`
--

CREATE TABLE IF NOT EXISTS `department_master` (
  `dept_id` int(10) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department_master`
--

INSERT INTO `department_master` (`dept_id`, `dept_name`) VALUES
(1, 'Sales'),
(2, 'Marketing'),
(3, 'Purchase'),
(4, 'Account');

-- --------------------------------------------------------

--
-- Table structure for table `employee_master`
--

CREATE TABLE IF NOT EXISTS `employee_master` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(100) NOT NULL,
  `doj` date NOT NULL,
  `address` varchar(300) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `sex` char(1) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `basic_salary` double(10,2) NOT NULL,
  `reference_by` varchar(50) NOT NULL,
  `emp_img` varchar(200) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `employee_master`
--

INSERT INTO `employee_master` (`emp_id`, `emp_name`, `doj`, `address`, `address1`, `phone`, `mob`, `email`, `dob`, `sex`, `marital_status`, `dept_id`, `job_title`, `basic_salary`, `reference_by`, `emp_img`) VALUES
(1, 'Prakash Rathod', '1990-01-02', 'Nr. Parimal Chowk,\r\nWaghawdi Road,\r\nBhavnagar ', 'Nr. Parimal Chowk,\r\nWaghawdi Road,\r\nBhavnagar ', '0278-258145023', '9898009898', 'prakash@abc.com', '2014-01-02', 'm', 'single', 1, 'Worker', 5000.00, 'Nikunjbhai', 'employee.jpg'),
(2, 'Rakesh Waghela', '1970-11-01', 'ST Bus Stand,\r\nBhavnagar', 'ST Bus Stand,\r\nBhavnagar', '', '9088995566', 'rakesh@gmail.com', '2015-01-01', 'm', 'married', 2, 'Sales Man', 5600.00, 'Nikunjbhai', 'unhappybusiness.png'),
(3, 'Mithilesh Patel', '1995-01-01', 'Sankarmandal,Bhavnagar', 'Sankarmandal,Bhavnagar', '', '7979797979', 'mithilesh@abc.com', '2014-01-01', 'm', '', 3, 'Sales Man', 5600.00, 'Rohitbhai', ''),
(4, 'Jayesh Vyas', '1980-01-01', 'Top-3 circle, Bhavnagar-Talaja road,', 'Top-3 circle, Bhavnagar-Talaja road,', '', '8756894521', 'jayesh@abc.com', '2011-01-01', 'm', 'single', 2, 'Worker', 10000.00, 'Ketanbhai', '1241427189431product12.jpg'),
(7, 'Uday Ghori', '1981-03-29', 'Parimal ,Bhavnagar', 'Parimal ,Bhavnagar', '0278-88140755', '9856458974', 'uday@gmail.com', '2015-03-29', 'm', '', 1, 'Worker', 5000.00, 'Lalajibhai', 'images (2).jpg'),
(8, 'Mayur Chitroda', '1986-03-29', 'Aanandnagar, Lila Nano Circle,Bhavnagar', 'Aanandnagar, Lila Nano Circle,Bhavnagar', '0278-2588150', '8478459851', 'mayur@gmail.com', '2015-03-29', 'm', 'married', 1, 'Worker', 5500.00, 'Pareshbhai', ''),
(9, 'Jignesh Jalota', '1990-02-03', 'Vora Bazar,\r\nMuni Chowk,,', 'Vora Bazar,\r\nMuni Chowk,,', '0278-2598711', '9898989898', 'jignesh@gmail.com', '2011-05-06', 'm', 'single', 4, 'Manager', 25000.00, 'Prakabhai Parmar', '2911427909746img.png');

-- --------------------------------------------------------

--
-- Table structure for table `entry_master`
--

CREATE TABLE IF NOT EXISTS `entry_master` (
  `e_id` int(10) NOT NULL AUTO_INCREMENT,
  `entry_id` int(10) NOT NULL,
  `entry_date` date NOT NULL,
  `credit_ledger_id` int(10) NOT NULL,
  `debit_ledger_id` int(10) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `entry_type` char(1) NOT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `entry_master`
--

INSERT INTO `entry_master` (`e_id`, `entry_id`, `entry_date`, `credit_ledger_id`, `debit_ledger_id`, `amount`, `remark`, `entry_type`) VALUES
(10, 1, '2015-02-18', 21, 3, 16500.00, 'first installment', 'r'),
(11, 1, '2015-03-11', 2, 23, 5400.00, 'first installment', 'p'),
(12, 1, '2015-03-03', 4, 21, 4000.00, 'payment', 'j'),
(13, 1, '2015-02-10', 3, 7, 5500.00, 'other expense', 'c'),
(14, 2, '2015-02-18', 22, 2, 1900.00, 'REMARK', 'r'),
(15, 2, '2015-03-05', 2, 23, 1500.00, 'payment ', 'p'),
(16, 3, '2015-03-13', 24, 2, 500.00, 'interest', 'r'),
(17, 3, '2015-03-25', 2, 25, 100.00, 'atm charges', 'p'),
(18, 4, '2015-03-09', 14, 3, 1200.00, '100000', 'r'),
(20, 2, '2015-03-28', 6, 18, 2200.00, 'payment', 'j'),
(22, 5, '2014-12-25', 2, 49, 10000.00, '', 'p'),
(23, 6, '2015-02-10', 2, 52, 1400.00, 'New Share Purchase', 'p'),
(24, 7, '2015-01-12', 2, 53, 9000.00, 'New Mu. Fund Investment', 'p'),
(25, 5, '2015-03-03', 46, 3, 15000.00, '', 'r'),
(26, 3, '2015-04-03', 50, 52, 15000.00, '', 'j'),
(27, 2, '2015-02-17', 2, 3, 150.00, '', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `group_master`
--

CREATE TABLE IF NOT EXISTS `group_master` (
  `group_id` int(4) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `group_master`
--

INSERT INTO `group_master` (`group_id`, `group_name`) VALUES
(1, 'Asset'),
(2, 'Bank Account'),
(3, 'Cash On Hand'),
(4, 'Purchase Account'),
(5, 'Sales Account'),
(6, 'Indirect Income'),
(7, 'Indirect Expense'),
(8, 'Direct Income'),
(9, 'Direct Expense'),
(10, 'Sundry Debtors'),
(11, 'Sundry Creditors'),
(12, 'Capital Account'),
(13, 'Loans (Liability)'),
(14, 'Loans & Advances (Asset)'),
(15, 'Suspense A/c'),
(16, 'Profit Loss A/c'),
(18, 'Current Assets'),
(20, 'Current Liabilities'),
(21, 'Duties & Taxes'),
(22, 'Investments');

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `ledger_id` int(10) NOT NULL AUTO_INCREMENT,
  `ledger_name` varchar(100) NOT NULL,
  `opening_bal` double(8,2) NOT NULL,
  `ledger_date` date NOT NULL,
  `group_id` int(4) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`ledger_id`, `ledger_name`, `opening_bal`, `ledger_date`, `group_id`) VALUES
(2, 'Bank of India', 10000.00, '2015-01-21', 2),
(3, 'Cash', 5000.00, '2015-01-21', 3),
(4, 'Raw Material', 10000.00, '2015-01-21', 4),
(5, 'Sales 4.00%', 5000.00, '2015-01-21', 5),
(6, 'Packing Material', 4000.00, '2015-01-21', 4),
(7, 'SBI', 5000.00, '2015-01-21', 2),
(13, 'Sales 12.50%', 0.00, '2015-03-07', 5),
(14, 'Sales 15.00%', 0.00, '2015-03-07', 5),
(15, 'Interstate Sales 2.00%', 0.00, '2015-03-07', 5),
(16, 'Interstate Sales 5.00%', 0.00, '2015-03-07', 5),
(17, 'Purchase 4.00%', 0.00, '2015-03-12', 4),
(18, 'Purchase 12.50%', 0.00, '2015-03-12', 4),
(19, 'Interstate Purchase 2.00%', 0.00, '2015-03-12', 4),
(20, 'Interstate Purchase 5.00%', 0.00, '2015-03-12', 4),
(21, 'Pramukh Info Tech', 0.00, '0000-00-00', 10),
(22, 'Uday Software', 0.00, '0000-00-00', 10),
(23, 'Soft Marchant', 0.00, '2015-03-12', 11),
(24, 'Bank Interest', 0.00, '2015-03-25', 6),
(25, 'Bank Charges', 0.00, '2015-03-25', 7),
(29, 'Jay Bhavani Enterprise', 0.00, '2015-04-01', 10),
(30, 'SR Softtech', 0.00, '2015-04-01', 10),
(31, 'Square Infocom', 0.00, '2015-04-01', 10),
(32, 'WebTech Services', 0.00, '2015-04-01', 10),
(33, 'Promis Computer Services', 0.00, '2015-04-01', 10),
(34, 'Gujarat Computers', 0.00, '2015-04-01', 10),
(35, 'Shiv Computer Shop', 0.00, '2015-04-01', 10),
(36, 'Vardhaman Infotech', 0.00, '2015-04-01', 10),
(37, 'Libas Computers', 0.00, '2015-04-01', 11),
(38, 'Pramukha Computer & Network', 0.00, '2015-04-01', 11),
(39, 'J. B. Computers', 0.00, '2015-04-01', 11),
(40, 'Hi-tech Computers', 0.00, '2015-04-01', 11),
(41, 'Patel & Patel Computers', 0.00, '2015-04-01', 11),
(42, 'Riddhi Infotech', 0.00, '2015-04-01', 11),
(43, 'Accurate Computers', 0.00, '2015-04-01', 11),
(44, 'Accurate Computers', 0.00, '2015-04-01', 11),
(45, 'Five Star Computers', 0.00, '2015-04-01', 11),
(46, 'Cruz Car', 750000.00, '2015-04-01', 1),
(47, 'New Factory ', 250000.00, '2015-04-01', 1),
(48, 'Gold Jwellerys', 50000.00, '2015-04-01', 1),
(49, 'Gold Coin', 0.00, '2015-04-01', 1),
(50, 'Capital Account', 5000.00, '2015-04-02', 12),
(51, 'Loans From Banks', 120000.00, '2015-04-02', 13),
(52, 'Share Capital', 30000.00, '2015-01-01', 22),
(53, 'Mutual Fund Investment', 35000.00, '2015-03-01', 22);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`) VALUES
(1, 'Hardware'),
(2, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE IF NOT EXISTS `product_master` (
  `item_id` int(8) NOT NULL AUTO_INCREMENT,
  `item_name` text NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(10) NOT NULL,
  `item_rate` double(8,2) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `image_name` varchar(150) NOT NULL,
  `category_id` int(4) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`item_id`, `item_name`, `item_desc`, `item_unit`, `item_rate`, `item_price`, `image_name`, `category_id`, `entry_date`) VALUES
(34, 'Desktop', 'Apple Remote Desktop\r\nLED 21` ', 'Unit', 5400.00, 6000.00, '1301422633921Apple Remote Desktop.png', 1, '0000-00-00 00:00:00'),
(35, 'Apple Laptop', 'Apple-Air-MC968-laptop', 'Unit', 15000.00, 1700.00, '1301422634025Apple-Air-MC968-laptop.png', 1, '0000-00-00 00:00:00'),
(36, 'Printer', 'Canon Printer \r\n', 'Unit', 14000.00, 15000.00, '1301422634084Printer.png', 1, '0000-00-00 00:00:00'),
(37, 'Apple Desktop -21 `', 'Apple Desktop \r\n21` LED', 'Unit', 4500.00, 5200.00, '1301422634144apple-desktop-png.png', 1, '2015-03-28 00:00:00'),
(38, 'Iphone mobile', 'apple_4g headphones iphone mobile', 'Unit', 8000.00, 8900.00, '1301422634201apple_4g_headphones_iphone_mobile.png', 1, '0000-00-00 00:00:00'),
(39, 'Samsung TV', 'nothing special', 'Unit', 12500.00, 15000.00, '1121426168212abstract-silk-background.png', 1, '0000-00-00 00:00:00'),
(40, 'Computer UPS', '', 'Unit', 4000.00, 5000.00, '11427906657homeups4.jpg', 0, '2015-04-01 22:14:17'),
(41, 'Home UPS', '', 'Unit', 4500.00, 5500.00, '2911427906835homeups1.jpg', 0, '2015-04-01 22:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE IF NOT EXISTS `purchase_detail` (
  `pur_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pur_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`pur_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`pur_detail_id`, `pur_id`, `item_name`, `item_desc`, `item_unit`, `item_qty`, `item_price`, `is_deleted`) VALUES
(45, '10', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00, '0'),
(46, '120', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 2, 6000.00, ''),
(47, '1', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 2, 6000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE IF NOT EXISTS `purchase_master` (
  `pur_id` varchar(20) NOT NULL,
  `pur_date` date NOT NULL,
  `reference` varchar(10) NOT NULL,
  `ref_date` date NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `tax` varchar(15) NOT NULL,
  `despatch_by` varchar(100) NOT NULL,
  `despatch_date` date NOT NULL,
  `lr_no` int(10) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `pur_type` varchar(10) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`pur_id`, `pur_date`, `reference`, `ref_date`, `supplier_id`, `tax`, `despatch_by`, `despatch_date`, `lr_no`, `remark`, `pur_type`, `is_deleted`, `entry_date`) VALUES
('1', '2015-03-28', 'GH3343/44', '2015-03-28', 8, '4.00,1.00,VAT', 'Van', '2015-03-28', 0, 'Payment', '', '0', '2015-03-28 17:51:07'),
('10', '2015-01-02', 'DDg/4454/4', '2015-01-01', 8, '4.00,1.00,VAT', 'Auto', '2015-02-02', 0, 'Payment halg', '', '0', '1899-11-30 08:19:11'),
('120', '2015-03-28', 'FHF/33', '2015-03-28', 8, '4.00,1.00,VAT', 'Auto', '2015-03-28', 0, 'Cash Discount''', '', '0', '2015-03-28 17:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `pur_entry_master`
--

CREATE TABLE IF NOT EXISTS `pur_entry_master` (
  `pur_entry_id` int(10) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(12) NOT NULL,
  `purchase_date` date NOT NULL,
  `remark` varchar(200) NOT NULL,
  `credit_ledger_id` int(10) NOT NULL,
  `debit_ledger_id` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`pur_entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pur_entry_master`
--

INSERT INTO `pur_entry_master` (`pur_entry_id`, `purchase_id`, `purchase_date`, `remark`, `credit_ledger_id`, `debit_ledger_id`, `amount`, `is_deleted`) VALUES
(10, '10', '0000-00-00', 'dd', 23, 17, 300000.00, '0'),
(11, '120', '2015-03-28', 'ss', 23, 17, 301000.00, '0'),
(12, '1', '2015-03-28', 'ss', 23, 17, 24000.00, '0');

-- --------------------------------------------------------

--
-- Table structure for table `pur_order_detail`
--

CREATE TABLE IF NOT EXISTS `pur_order_detail` (
  `po_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(100) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_qty` int(10) NOT NULL,
  PRIMARY KEY (`po_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pur_order_detail`
--

INSERT INTO `pur_order_detail` (`po_detail_id`, `po_id`, `item_name`, `item_desc`, `item_unit`, `item_price`, `item_qty`) VALUES
(2, 'PORA14150001', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 5),
(3, 'PORA14150001', 'Printer', 'Canon Printer ', '', 15000.00, 1),
(4, 'PORA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pur_order_master`
--

CREATE TABLE IF NOT EXISTS `pur_order_master` (
  `po_id` varchar(20) NOT NULL,
  `po_date` varchar(12) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `reference` varchar(10) NOT NULL,
  `reference_date` varchar(12) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `delivery_date` varchar(12) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pur_order_master`
--

INSERT INTO `pur_order_master` (`po_id`, `po_date`, `supplier_id`, `reference`, `reference_date`, `tax`, `is_deleted`, `status`, `delivery_date`, `remark`, `entry_date`) VALUES
('PORA14150001', '12/03/2015', 8, 'order no G', '12/03/2015', '12.50,2.50,VAT', '0', '0', '12/03/2015', 'payment within 4 days pay', '0000-00-00 00:00:00'),
('PORA14150002', '2015-03-28', 8, 'dd', '2015-03-28', '4.00,1.00,VAT', '0', '0', '2015-03-28', 'd', '2015-03-28 15:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `pur_qua_detail`
--

CREATE TABLE IF NOT EXISTS `pur_qua_detail` (
  `pur_qua_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `pur_qua_id` varchar(15) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `other_exp` double(8,2) NOT NULL,
  PRIMARY KEY (`pur_qua_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pur_qua_detail`
--

INSERT INTO `pur_qua_detail` (`pur_qua_detail_id`, `pur_qua_id`, `item_name`, `item_desc`, `item_unit`, `item_qty`, `item_price`, `other_exp`) VALUES
(11, 'GH0125204', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 2, 6000.00, 0.00),
(12, 'GH0125204', 'Apple Desktop -21 `', 'Apple Desktop 21` LED', '', 5, 5200.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `pur_qua_master`
--

CREATE TABLE IF NOT EXISTS `pur_qua_master` (
  `pur_qua_id` varchar(15) NOT NULL,
  `quo_date` varchar(12) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `reference_date` varchar(12) NOT NULL,
  `tax` varchar(20) NOT NULL,
  `expiry_date` varchar(12) NOT NULL,
  `status` varchar(1) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`pur_qua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pur_qua_master`
--

INSERT INTO `pur_qua_master` (`pur_qua_id`, `quo_date`, `supplier_id`, `reference`, `reference_date`, `tax`, `expiry_date`, `status`, `remark`, `is_deleted`, `entry_date`) VALUES
('55', '2015-03-28', 8, 'dd', '2015-03-28', '4.00,1.00,VAT', '2015-03-28', '0', 'd', 0, '2015-03-28 17:07:47'),
('GH0125204', '12/03/2015', 8, 'order no GH02155', '12/03/2015', '4.00,1.00,VAT', '12/03/2015', '0', 'ref to order 005333', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pur_return`
--

CREATE TABLE IF NOT EXISTS `pur_return` (
  `pur_return_id` int(10) NOT NULL,
  `pur_return_date` date NOT NULL,
  `reference` varchar(100) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `ref_date` date NOT NULL,
  `tax` varchar(15) NOT NULL,
  `despatch_by` varchar(100) NOT NULL,
  `despatch_date` date NOT NULL,
  `lr_no` int(11) NOT NULL,
  `from_city` varchar(50) NOT NULL,
  `to_city` varchar(50) NOT NULL,
  `no_of_cases` int(8) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `pur_return_type` varchar(10) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`pur_return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pur_return`
--

INSERT INTO `pur_return` (`pur_return_id`, `pur_return_date`, `reference`, `supplier_id`, `ref_date`, `tax`, `despatch_by`, `despatch_date`, `lr_no`, `from_city`, `to_city`, `no_of_cases`, `remark`, `pur_return_type`, `is_deleted`) VALUES
(1, '2015-01-01', 'order no FR0120', 8, '2014-01-01', '4.00,1.00,VAT', 'Van', '2014-01-01', 0, '', '', 0, 'defective peices', '', '0'),
(2, '2015-03-28', 'dd', 8, '2015-03-28', '12.50,2.50,VAT', 'kk', '2015-03-28', 0, '', '', 0, 'sss', '', '0'),
(3, '2015-04-04', 'GA102510', 14, '2015-04-04', '4.00,1.00,VAT', 'van', '2015-04-04', 0, '', '', 0, 'damanged goods', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pur_return_detail`
--

CREATE TABLE IF NOT EXISTS `pur_return_detail` (
  `pur_return_detail_id` int(10) NOT NULL AUTO_INCREMENT,
  `pur_return_id` int(10) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  PRIMARY KEY (`pur_return_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pur_return_detail`
--

INSERT INTO `pur_return_detail` (`pur_return_detail_id`, `pur_return_id`, `item_name`, `item_desc`, `item_qty`, `item_price`) VALUES
(2, 1, 'Iphone mobile', 'apple_4g headphones iphone mobile', 2, 8900.00),
(3, 1, 'Apple Laptop', 'Apple-Air-MC968-laptop', 1, 1700.00),
(4, 2, 'Desktop', 'Apple Remote DesktopLED 21` ', 4, 6000.00),
(5, 3, 'Desktop', 'Apple Remote DesktopLED 21` ', 4, 6000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE IF NOT EXISTS `sales_detail` (
  `invoice_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  PRIMARY KEY (`invoice_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`invoice_detail_id`, `invoice_id`, `item_name`, `item_desc`, `item_unit`, `item_qty`, `item_price`) VALUES
(43, 'RA14150001', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00),
(44, 'RA14150001', 'Apple Desktop -21 `', 'Apple Desktop 21` LED', '', 2, 5200.00),
(45, 'RA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00),
(46, 'RA14150002', 'Printer', 'Canon Printer ', '', 1, 15000.00),
(47, 'RA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00),
(48, 'RA14150002', 'Printer', 'Canon Printer ', '', 1, 15000.00),
(49, 'RA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00),
(50, 'RA14150002', 'Printer', 'Canon Printer ', '', 2, 15000.00),
(51, 'RA14150001', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00),
(52, 'RA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 2, 6000.00),
(53, 'RA14150003', 'Desktop', 'Apple Remote Desktop LED 21` ', '', 2, 6000.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_entry_master`
--

CREATE TABLE IF NOT EXISTS `sales_entry_master` (
  `sales_entry_id` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `credit_ledger_id` int(10) NOT NULL,
  `debit_ledger_id` int(10) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`sales_entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sales_entry_master`
--

INSERT INTO `sales_entry_master` (`sales_entry_id`, `invoice_id`, `invoice_date`, `credit_ledger_id`, `debit_ledger_id`, `amount`, `remark`, `is_deleted`) VALUES
(12, 'RA14150001', '0000-00-00', 21, 13, 56000.00, 'payment within 3 days', '0'),
(13, 'RA14150002', '2015-03-01', 22, 13, 10500.00, 'ss', '0'),
(14, 'RA14150002', '2015-03-01', 22, 13, 90000.00, 'ss', '0'),
(15, 'RA14150002', '2015-03-01', 22, 13, 10000.00, 'ss', '0'),
(16, 'RA14150001', '2015-03-28', 21, 13, 33000.00, 'dd', '0'),
(17, 'RA14150002', '2015-03-28', 21, 15, 330000.00, 'kk', '0'),
(18, 'RA14150003', '2015-01-06', 30, 5, 30000.00, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_master`
--

CREATE TABLE IF NOT EXISTS `sales_master` (
  `inv_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(20) NOT NULL,
  `invoice_date` date NOT NULL,
  `reference` varchar(10) NOT NULL,
  `ref_date` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `tax` varchar(20) NOT NULL,
  `despatch_by` varchar(100) NOT NULL,
  `despatch_date` date NOT NULL,
  `lr_no` varchar(20) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `from_city` varchar(50) NOT NULL,
  `to_city` varchar(50) DEFAULT NULL,
  `no_of_cases` varchar(20) NOT NULL,
  `sales_type` varchar(10) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`inv_id`),
  UNIQUE KEY `invoice_id_3` (`invoice_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `invoice_id_2` (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `sales_master`
--

INSERT INTO `sales_master` (`inv_id`, `invoice_id`, `invoice_date`, `reference`, `ref_date`, `customer_id`, `tax`, `despatch_by`, `despatch_date`, `lr_no`, `remark`, `from_city`, `to_city`, `no_of_cases`, `sales_type`, `is_deleted`, `entry_date`) VALUES
(23, 'RA14150001', '2015-03-28', 'dd', '2015-03-28', 28, '12.50,2.50,VAT', 's', '2015-03-28', '', 'dd', '', NULL, '', '', 0, '2015-03-28 14:15:19'),
(24, 'RA14150002', '2015-03-28', 'ss', '2015-03-28', 28, '2.00,0.00,CST', 'kk', '2015-03-28', '', 'kk', '', NULL, '', '', 0, '2015-03-28 14:15:38'),
(25, 'RA14150003', '2015-01-06', 'Order', '2014-11-04', 31, '4.00,1.00,VAT', 'Courier', '2015-01-06', '', '', '', NULL, '', '', 0, '2015-04-01 22:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_detail`
--

CREATE TABLE IF NOT EXISTS `sales_order_detail` (
  `sales_order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `other_exp` double(8,2) NOT NULL,
  PRIMARY KEY (`sales_order_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `sales_order_detail`
--

INSERT INTO `sales_order_detail` (`sales_order_detail_id`, `sales_order_id`, `item_name`, `item_desc`, `item_unit`, `item_qty`, `item_price`, `other_exp`) VALUES
(33, 'RO14150210', 'Desktop', 'Apple Remote Desktop\r\nLED 21` ', '', 2, 6000.00, 0.00),
(35, 'RO14150210', 'Apple Desktop -21 `', 'Apple Desktop \r\n21` LED', '', 3, 5200.00, 0.00),
(36, 'RO14150210', 'Printer', 'Canon Printer \r\n', '', 3, 15000.00, 0.00),
(37, 'spo222', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 4, 6000.00, 0.00),
(38, 'RO14150210', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 12, 1700.00, 0.00),
(39, 'SR14150045', 'Desktop', 'Apple Remote Desktop LED 21` ', '', 5, 6000.00, 0.00),
(40, 'SR14150045', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 10, 1700.00, 0.00),
(41, 'SQR14150088', 'Printer', 'Canon Printer ', '', 10, 15000.00, 0.00),
(42, 'SQR14150088', 'Samsung TV', 'nothing special', '', 50, 15000.00, 0.00),
(43, 'WEB/1415/43', 'Desktop', 'Apple Remote Desktop LED 21` ', '', 10, 6000.00, 0.00),
(44, 'WEB/1415/43', 'Home UPS', '', '', 5, 5500.00, 0.00),
(45, 'SCS/ORDER/133', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 12, 1700.00, 0.00),
(46, 'order/002134', 'Printer', 'Canon Printer ', '', 8, 15000.00, 0.00),
(47, 'order/002134', 'Computer UPS', '', '', 5, 5000.00, 0.00),
(48, 'GC/ORD/1415/99', 'Desktop', 'Apple Remote Desktop LED 21` ', '', 10, 6000.00, 0.00),
(49, 'GC/ORD/1415/99', 'Printer', 'Canon Printer ', '', 11, 15000.00, 0.00),
(50, '1415/000456', 'Desktop', 'Apple Remote Desktop LED 21` ', '', 10, 6000.00, 0.00),
(51, '1415/000456', 'Printer', 'Canon Printer ', '', 10, 15000.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_master`
--

CREATE TABLE IF NOT EXISTS `sales_order_master` (
  `sales_order_id` varchar(20) NOT NULL,
  `order_date` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `reference_date` date NOT NULL,
  `tax` varchar(50) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `delivery_date` date NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`sales_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_master`
--

INSERT INTO `sales_order_master` (`sales_order_id`, `order_date`, `customer_id`, `reference`, `reference_date`, `tax`, `is_deleted`, `status`, `delivery_date`, `remark`) VALUES
('1415/000456', '2015-03-19', 37, 'Against Mail', '2015-03-19', '4.00,1.00,VAT', '0', '0', '2015-03-19', ''),
('GC/ORD/1415/99', '2015-03-04', 35, 'Tele Talk', '2015-02-18', '', '0', '0', '2015-03-05', ''),
('order/002134', '2015-02-28', 34, 'Email', '2015-02-24', '4.00,1.00,VAT', '0', '0', '2015-02-28', ''),
('RO14150210', '0000-00-00', 28, 'GA102510', '0000-00-00', '4.00,1.00,VAT', '0', '0', '0000-00-00', 'Valid till 30 days'),
('RO141502103', '0000-00-00', 28, 'reference', '0000-00-00', '12.50,2.50,VAT', '0', '0', '0000-00-00', 'dd'),
('SCS/ORDER/133', '2015-02-20', 36, 'Telephonic Talk', '2015-01-06', '4.00,1.00,VAT', '0', '0', '2015-02-11', 'Packing Charges 200.00'),
('spo222', '2015-03-28', 28, 'dd', '2015-03-28', '4.00,1.00,VAT', '0', '0', '2015-03-28', '50% discount'),
('SQR14150088', '2015-02-05', 32, 'Via Email', '2015-01-06', '', '0', '0', '2015-02-05', '50% Advance Payment,\r\nanother 50% against Invoice'),
('SR14150045', '2015-02-03', 31, 'Your Email', '2014-12-01', '4.00,1.00,VAT', '0', '0', '2015-02-03', ''),
('WEB/1415/43', '2015-02-11', 33, 'Quatation', '2015-02-11', '2.00,0.00,CST', '0', '0', '2015-02-11', 'Against "C" Form,\r\n100% Payment Advance Against Order');

-- --------------------------------------------------------

--
-- Table structure for table `sales_qua_detail`
--

CREATE TABLE IF NOT EXISTS `sales_qua_detail` (
  `sales_qua_detail_id` int(10) NOT NULL AUTO_INCREMENT,
  `sales_qua_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(10) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `item_qty` int(8) NOT NULL,
  PRIMARY KEY (`sales_qua_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `sales_qua_detail`
--

INSERT INTO `sales_qua_detail` (`sales_qua_detail_id`, `sales_qua_id`, `item_name`, `item_desc`, `item_unit`, `item_price`, `item_qty`) VALUES
(126, 'QUORA14150001', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 5),
(127, 'QUORA14150001', 'Apple Desktop -21 `', 'Apple Desktop 21` LED', '', 5200.00, 5),
(128, 'QUORA14150002', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 5),
(129, 'QUORA14150002', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 1700.00, 5),
(130, 'QUORA14150003', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 5),
(131, 'QUORA14150003', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 1700.00, 5),
(132, 'QUORA14150004', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 6000.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales_qua_master`
--

CREATE TABLE IF NOT EXISTS `sales_qua_master` (
  `sales_qua_id` varchar(15) NOT NULL,
  `quo_date` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `reference_date` date NOT NULL,
  `tax` varchar(30) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` varchar(1) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`sales_qua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_qua_master`
--

INSERT INTO `sales_qua_master` (`sales_qua_id`, `quo_date`, `customer_id`, `reference`, `reference_date`, `tax`, `expiry_date`, `status`, `remark`, `is_deleted`) VALUES
('QUORA14150001', '0000-00-00', 28, 'order no GH02155', '0000-00-00', '4.00,1.00,VAT', '0000-00-00', '0', 'payment policy check on agreement', '0'),
('QUORA14150002', '0000-00-00', 28, 'order no 1010', '0000-00-00', '12.50,2.50,VAT', '0000-00-00', '0', 'payment in 3 month', '0'),
('QUORA14150003', '0000-00-00', 28, 'order no 1010', '0000-00-00', '4.00,1.00,VAT', '0000-00-00', '0', 'payment in 3 month', '0'),
('QUORA14150004', '2015-03-28', 29, 'or', '2015-03-28', '4.00,1.00,VAT', '2015-03-28', '0', 'dd', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE IF NOT EXISTS `sales_return` (
  `sales_return_id` varchar(20) NOT NULL,
  `return_date` date NOT NULL,
  `customer_id` int(10) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `ref_date` date NOT NULL,
  `tax` varchar(30) NOT NULL,
  `despatch_by` varchar(100) NOT NULL,
  `despatch_date` date NOT NULL,
  `lr_no` varchar(20) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `from_city` varchar(50) NOT NULL,
  `to_city` varchar(50) NOT NULL,
  `no_of_cases` varchar(20) NOT NULL,
  `sales_return_type` varchar(10) NOT NULL,
  `is_deleted` varchar(2) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`sales_return_id`),
  UNIQUE KEY `sales_return_id` (`sales_return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`sales_return_id`, `return_date`, `customer_id`, `reference`, `ref_date`, `tax`, `despatch_by`, `despatch_date`, `lr_no`, `remark`, `from_city`, `to_city`, `no_of_cases`, `sales_return_type`, `is_deleted`, `entry_date`) VALUES
('12340', '2015-04-04', 31, 'Invoice No. RA141500', '2015-01-06', '4.00,1.00,VAT', '', '0000-00-00', '', 'bad condition', '', '', '', '', '0', '2015-04-04 16:51:14'),
('1250100', '2015-04-04', 28, 'Invoice No. RA141500', '2015-03-28', '12.50,2.50,VAT', '', '0000-00-00', '', 'demanged goods', '', '', '', '', '0', '2015-04-04 16:51:58'),
('21540', '2015-04-04', 28, 'Invoice No. RA141500', '2015-03-28', '2.00,0.00,CST', '', '0000-00-00', '', 'incorrect piece', '', '', '', '', '0', '2015-04-04 16:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_detail`
--

CREATE TABLE IF NOT EXISTS `sales_return_detail` (
  `sales_return_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_return_id` varchar(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `item_unit` varchar(50) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `is_deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`sales_return_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sales_return_detail`
--

INSERT INTO `sales_return_detail` (`sales_return_detail_id`, `sales_return_id`, `item_name`, `item_desc`, `item_unit`, `item_qty`, `item_price`, `is_deleted`) VALUES
(12, '12340', 'Apple Laptop', 'Apple-Air-MC968-laptop', '', 1, 1700.00, ''),
(13, '12340', 'Iphone Mobile', 'apple_4g headphones iphone mobile', '', 1, 8900.00, ''),
(14, '1250100', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00, ''),
(15, '21540', 'Desktop', 'Apple Remote DesktopLED 21` ', '', 1, 6000.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `stock_id` int(10) NOT NULL,
  `entry_date` date NOT NULL,
  `item_id` int(10) NOT NULL,
  `open_qty` int(8) NOT NULL,
  `open_price` double(8,2) NOT NULL,
  `item_qty` int(8) NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_master`
--

CREATE TABLE IF NOT EXISTS `supplier_master` (
  `supplier_id` int(10) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(6) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `vat_tin_no` int(11) NOT NULL,
  `cst_no` int(11) NOT NULL,
  `iscompany` varchar(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`supplier_id`, `supplier_name`, `address`, `city`, `state`, `pincode`, `mobile_no`, `phone_no`, `designation`, `email_id`, `contact_name`, `vat_tin_no`, `cst_no`, `iscompany`, `is_deleted`, `entry_date`) VALUES
(8, 'Soft Marchant', 'Meghani Road,\r\n', 'Surat', 'Gujarat', 5555555, '9876556432', '0278-254566', 'Manager', 'softworld07@gmail.com', 'Mr. Rakesh Vyas', 444525554, 558288888, '1', 0, '2015-03-29 00:00:00'),
(12, 'Libas Computers', 'Shop No. 15,\r\nChaturved Complex,\r\nKalanala, ', 'Bhavnagar', 'Gujarat', 364001, '9900888888', '0278-25252525', 'Manager', 'libascomps@yahoo.com', 'Mr. Hem Kapoor', 0, 0, '1', 0, '2015-04-01 22:29:37'),
(13, 'Pramukha Computer & Network', 'Nr. Mahila College Circle,\r\nPark View Complex,\r\n', 'Bhavnagar', 'Gujarat', 364001, '8877665544', '0278-2245678', 'Manager', 'pramnet@yahoo.co.in', 'Mr. Ajay Jadeja', 0, 0, '1', 0, '2015-04-01 22:31:30'),
(14, 'J. B. Computers', 'J. B. Chamber,\r\nM.R. Road,', 'Ahmedabad', 'Gujarat', 364545, '8866559900', '', 'Ownner', 'jbandsons@gmail.com', 'Mr. Jayesh Buch', 0, 0, '1', 0, '2015-04-01 22:33:21'),
(15, 'Hi-tech Computers', 'Ghanghli Road,\r\nNr. Bhavnagar Rajkot Road,\r\nGhanghli Gam,', 'SHIHOR', 'Gujarat', 364249, '9994778899', '', 'Ownner', 'hitechcom@hitech.net', 'Mr. Amit Parekh', 0, 0, '1', 0, '2015-04-01 22:35:14'),
(16, 'Patel & Patel Computers', 'G. I. D. C,\r\nPlot No. 340, M.G. Road,\r\n', 'Ahmedabad', 'Gujarat', 364545, '9429008800', '', 'Ownner', 'pppatel@gmail.com', 'Mr. Prakash Patel', 0, 0, '1', 0, '2015-04-01 22:36:41'),
(17, 'Riddhi Infotech', 'Nr. Radheshayam Hotel,\r\nOpp. Radha Krishana Temple', 'Baroda', 'Gujarat', 364400, '9812078956', '', 'Ownner', 'riddhiinfotech2013@gmail.com', 'Mr. Amrish Patel', 0, 0, '1', 0, '2015-04-01 22:40:27'),
(18, 'Accurate Computers', 'Nr, Bus Stand,\r\nOpp. Nagar Palika Office,', 'Rajkot', 'Gujarat', 364433, '9228998877', '', 'Ownner', 'accuratecomputers14@yahoo.com', 'Mr. A. C. Mehta', 0, 0, '1', 0, '2015-04-01 22:45:07'),
(19, 'Accurate Computers', 'Nr, Bus Stand,\r\nOpp. Nagar Palika Office,', 'Rajkot', 'Gujarat', 364433, '9228998877', '', 'Ownner', 'accuratecomputers14@yahoo.com', 'Mr. A. C. Mehta', 0, 0, '1', 0, '2015-04-01 22:47:02'),
(20, 'Five Star Computers', 'Opp. Five Star Hotel,\r\nBus Stand Road,', 'Bhavnagar', 'Gujarat', 364001, '8866234567', '', 'Ownner', 'fivestar2011@gmail.com', 'Mr. Firoz Khan', 0, 0, '1', 0, '2015-04-01 22:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `tax_master`
--

CREATE TABLE IF NOT EXISTS `tax_master` (
  `tax_id` int(10) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(20) NOT NULL,
  `tax_per` double(4,2) NOT NULL,
  `additional_per` double(4,2) NOT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tax_master`
--

INSERT INTO `tax_master` (`tax_id`, `tax_name`, `tax_per`, `additional_per`) VALUES
(1, 'VAT 4%', 4.00, 1.00),
(2, 'VAT 12.5%', 12.50, 2.50),
(3, 'CST 2%', 2.00, 0.00),
(4, 'CST 5 %', 5.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `user_id` int(8) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `is_active` varchar(1) NOT NULL,
  `image_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
